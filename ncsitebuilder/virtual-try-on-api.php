<?php
/*
 * Barkly Virtual Try-On — PHP backend
 *
 * Pipeline (all stages mandatory — fail closed at any step):
 *   1) UPLOAD SECURITY GAUNTLET
 *      Whitelist extension + MIME match + getimagesize + decompression
 *      bomb guard + GD re-encode (strips polyglot payloads).
 *
 *   2) GEMINI VISION  (gemini-2.5-flash)
 *      Hard gate: photo MUST be a dog. Also auto-picks a Barkly jacket
 *      when jacket="auto". If the gate fails for ANY reason — key
 *      missing, network error, malformed response, is_dog != true —
 *      we REJECT and never call the image model.
 *
 *   3) GEMINI IMAGE  (gemini-2.5-flash-image-preview)
 *      Receives TWO inputs: the user's dog photo AND the actual Barkly
 *      product photo from gallery/. Instructed to dress the dog in
 *      THAT specific jacket. This is what makes the jacket on the
 *      output an actual Barkly piece, not a stock generation.
 *
 * SECRETS — barkly-secrets.php (one of: /home/barkgjug/, /public_html/,
 * /public_html/ncsitebuilder/) — looks like:
 *
 *   <?php
 *   define('GEMINI_KEY', 'AIza...');   // aistudio.google.com/app/apikey
 *
 * STABILITY_KEY is no longer used. It was text-to-inpaint, so it
 * generated random jacket designs, not Barkly's actual products.
 */

$secretsCandidates = [
    dirname(__FILE__) . '/../../barkly-secrets.php',
    dirname(__FILE__) . '/../barkly-secrets.php',
    dirname(__FILE__) . '/barkly-secrets.php',
];
foreach ($secretsCandidates as $sp) {
    if (@is_file($sp)) { @require_once $sp; if (defined('GEMINI_KEY')) break; }
}
if (!defined('GEMINI_KEY')) { define('GEMINI_KEY', ''); }

header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(204); exit; }
if ($_SERVER['REQUEST_METHOD'] !== 'POST')    { http_response_code(405); echo json_encode(['error' => 'POST only']); exit; }

$geminiKey = (GEMINI_KEY !== '' && strpos(GEMINI_KEY, 'REPLACE') === false) ? GEMINI_KEY : '';

/* HARD GATE #0 — feature is offline if no key is configured */
if ($geminiKey === '') {
    http_response_code(503);
    echo json_encode([
        'error' => 'setup_needed',
        'message' => 'AI try-on temporarily unavailable. Please contact support.',
    ]);
    exit;
}

$jacket = isset($_POST['jacket']) ? trim($_POST['jacket']) : '';
$img    = isset($_FILES['image']) ? $_FILES['image'] : null;

/* ──────── Upload security gauntlet ────────
 * Same as before — every check must pass before bytes go anywhere.
 *   1. is_uploaded_file (no forged $_FILES)
 *   2. No upload error
 *   3. ≤ 10 MB
 *   4. Extension ∈ {jpg, jpeg, png, webp}
 *   5. libmagic MIME ∈ {jpeg, png, webp}
 *   6. MIME ↔ extension match (no MIME spoofing)
 *   7. getimagesize decodes
 *   8. IMAGETYPE matches MIME
 *   9. ≤ 10k × 10k and ≤ 50 MP (decompression bomb)
 *  10. Mandatory GD re-encode → strips EXIF / scripts / polyglot
 */

if (!$img || $img['error'] !== UPLOAD_ERR_OK || empty($img['tmp_name']) || !is_uploaded_file($img['tmp_name'])) {
    http_response_code(400); echo json_encode(['error' => 'Upload your dog\'s photo first.']); exit;
}
if (!$jacket) { $jacket = 'auto'; }

if ($img['size'] > 10 * 1024 * 1024) {
    http_response_code(413); echo json_encode(['error' => 'Photo too large — max 10 MB.']); exit;
}

$origName     = isset($img['name']) ? basename($img['name']) : '';
$ext          = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
$allowedExts  = ['jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png', 'webp' => 'image/webp'];
if (!isset($allowedExts[$ext])) {
    http_response_code(400); echo json_encode(['error' => 'Only JPG, PNG, or WebP photos are allowed.']); exit;
}

$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime  = finfo_file($finfo, $img['tmp_name']);
if (!in_array($mime, ['image/jpeg','image/png','image/webp'], true)) {
    http_response_code(400); echo json_encode(['error' => 'That doesn\'t look like a real photo — please upload a JPG, PNG, or WebP.']); exit;
}
if ($mime !== $allowedExts[$ext]) {
    http_response_code(400); echo json_encode(['error' => 'File extension doesn\'t match its contents — please re-export your photo.']); exit;
}

$dims = @getimagesize($img['tmp_name']);
$expectedTypes = ['image/jpeg' => IMAGETYPE_JPEG, 'image/png' => IMAGETYPE_PNG, 'image/webp' => IMAGETYPE_WEBP];
if (!$dims || empty($dims[0]) || empty($dims[1]) || !isset($dims[2]) || $dims[2] !== $expectedTypes[$mime]) {
    http_response_code(400); echo json_encode(['error' => 'Couldn\'t read that photo — please upload a standard JPG, PNG, or WebP.']); exit;
}
if ($dims[0] > 10000 || $dims[1] > 10000 || ($dims[0] * $dims[1]) > 50000000) {
    http_response_code(400); echo json_encode(['error' => 'Photo dimensions are too large — please use a normal-sized photo.']); exit;
}

/* MANDATORY GD re-encode + resize to ≤1024px on long edge */
$tmpPath      = $img['tmp_name'];
$tmpToCleanup = null;
$sw = $dims[0]; $sh = $dims[1];
if (max($sw, $sh) > 1024) {
    if ($sw >= $sh) { $dw = 1024; $dh = intval($sh * 1024 / $sw); }
    else            { $dh = 1024; $dw = intval($sw * 1024 / $sh); }
} else {
    $dw = $sw; $dh = $sh;
}
$dw = max(64, intval(round($dw / 64)) * 64);
$dh = max(64, intval(round($dh / 64)) * 64);
$loader = ($mime === 'image/png')  ? 'imagecreatefrompng'  :
          (($mime === 'image/webp') ? 'imagecreatefromwebp' : 'imagecreatefromjpeg');
if (!function_exists($loader)) {
    http_response_code(500); echo json_encode(['error' => 'Server image support missing — please contact support.']); exit;
}
$src = @$loader($tmpPath);
if (!$src) {
    http_response_code(400); echo json_encode(['error' => 'Couldn\'t decode that photo. Please re-export and try again.']); exit;
}
$dst = imagecreatetruecolor($dw, $dh);
imagecopyresampled($dst, $src, 0, 0, 0, 0, $dw, $dh, $sw, $sh);
$resized = tempnam(sys_get_temp_dir(), 'barkly_');
imagejpeg($dst, $resized, 92);
$tmpPath = $resized; $tmpToCleanup = $resized; $mime = 'image/jpeg';

/* ──────── Jacket catalog ────────
 * product_file is a real Barkly product photo from gallery/. The image
 * editor receives THIS file alongside the user's dog photo, and is
 * instructed to use it exactly — that's what guarantees the output
 * jacket is a Barkly piece, not a stock generation. */
$jackets = [
    'santa-fe' => [
        'name'         => 'Santa Fe Jacket',
        'product_file' => 'santa-fe-jacket.jpeg',
        'short'        => 'block-printed cotton coat in terracotta and indigo',
    ],
    'scarlet-brocade' => [
        'name'         => 'Brocade Jacket',
        'product_file' => 'scarlet-brocade-coat.jpeg',
        'short'        => 'scarlet red brocade coat with damask pattern',
    ],
    'midnight-floral' => [
        'name'         => 'Midnight Floral Hoodie',
        'product_file' => 'midnight-floral-hoodie.jpeg',
        'short'        => 'midnight navy floral hoodie',
    ],
    'nordic-fairisle' => [
        'name'         => 'Nordic Fairisle',
        'product_file' => 'nordic-fairisle-sweater.jpeg',
        'short'        => 'cream Nordic fairisle knit sweater',
    ],
    'lunar-cheongsam' => [
        'name'         => 'Lunar Cheongsam',
        'product_file' => 'lunar-cheongsam.jpeg',
        'short'        => 'red and gold cheongsam-style coat',
    ],
];

/* Helper for clean cleanup */
$cleanupAndExit = function ($status, $payload) use ($tmpToCleanup) {
    if ($tmpToCleanup && file_exists($tmpToCleanup)) @unlink($tmpToCleanup);
    http_response_code($status);
    echo json_encode($payload);
    exit;
};

/* ──────── Stage 2: HARD GATE — Gemini Vision dog detection ──────── */
$dogB64    = base64_encode(file_get_contents($tmpPath));
$sysPrompt =
    "You are the Barkly Fashion AI stylist. Analyse this photo carefully.\n\n" .
    "STEP 1 — Is the MAIN, CLEARLY VISIBLE subject of the photo a dog?\n" .
    "- A dog means a real living domestic dog (any breed, any pose, with or without clothing).\n" .
    "- Cats, humans, mannequins, plush toys, drawings, screenshots, UI mockups, websites, " .
    "empty rooms, landscapes, food, products, other animals → NOT a dog.\n" .
    "- Photos that are too dark / blurry / cropped to identify confidently → NOT a dog.\n\n" .
    "If NOT a dog, respond ONLY with this JSON:\n" .
    "{\"is_dog\": false, \"not_dog_message\": \"one short polite sentence describing what you see and asking the user to upload a clear dog photo\"}\n\n" .
    "STEP 2 — If yes a dog, ALSO pick exactly one Barkly jacket:\n" .
    "- santa-fe : bold block-print cotton, terracotta + indigo, casual chic. Suits playful, scruffy, or active dogs.\n" .
    "- scarlet-brocade : crimson brocade with damask weave, formal & elegant. Suits poised, fluffy, or refined dogs.\n" .
    "- midnight-floral : navy blue floral hoodie, relaxed everyday. Suits friendly, casual dogs of any size.\n" .
    "- nordic-fairisle : cream wool fairisle knit, cozy. Suits stocky or fluffy cold-weather dogs.\n" .
    "- lunar-cheongsam : red + gold festive cheongsam. Suits striking, ceremonial-looking dogs.\n\n" .
    "Respond ONLY with this JSON:\n" .
    "{\"is_dog\": true, \"slug\": \"...\", \"breed\": \"best breed guess\", \"reason\": \"one short sentence\"}";

$visionBody = [
    'contents' => [[ 'parts' => [
        ['text' => $sysPrompt],
        ['inline_data' => ['mime_type' => $mime, 'data' => $dogB64]],
    ] ]],
    'generationConfig' => [
        'temperature'      => 0.2,
        'maxOutputTokens'  => 1200,  /* 2.5-flash thinking tokens eat budget */
        'responseMimeType' => 'application/json',
    ],
];
$gch = curl_init('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=' . $geminiKey);
curl_setopt_array($gch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_TIMEOUT        => 25,
    CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
    CURLOPT_POSTFIELDS     => json_encode($visionBody),
]);
$graw  = curl_exec($gch);
$gcode = curl_getinfo($gch, CURLINFO_HTTP_CODE);
$gerr  = curl_error($gch);

if ($gerr || $gcode !== 200) {
    $cleanupAndExit(503, ['error' => 'AI service is busy. Please try again in a moment.']);
}
$gresp = @json_decode($graw, true);
$gtext = isset($gresp['candidates'][0]['content']['parts'][0]['text']) ? $gresp['candidates'][0]['content']['parts'][0]['text'] : '';
$gtext = preg_replace('/^```json\s*|\s*```$/i', '', trim($gtext));
$gpick = @json_decode($gtext, true);

if (!is_array($gpick) || !isset($gpick['is_dog'])) {
    $cleanupAndExit(400, [
        'error' => 'We couldn\'t analyse that photo — please upload a clear, well-lit photo of your dog.',
        'not_a_dog' => true,
    ]);
}

/* Hard gate: anything other than explicit is_dog: true → REJECT */
if ($gpick['is_dog'] !== true) {
    $msg = (!empty($gpick['not_dog_message']))
        ? $gpick['not_dog_message']
        : 'That doesn\'t look like a dog photo — please upload a clear photo of your dog.';
    $cleanupAndExit(400, ['error' => $msg, 'not_a_dog' => true]);
}

/* Resolve jacket */
$autoPicked = false;
$autoBreed  = isset($gpick['breed'])  ? $gpick['breed']  : null;
$autoReason = isset($gpick['reason']) ? $gpick['reason'] : null;
if ($jacket === 'auto') {
    $picked = isset($gpick['slug']) ? trim(strtolower($gpick['slug'])) : '';
    $jacket = isset($jackets[$picked]) ? $picked : 'scarlet-brocade';
    $autoPicked = true;
}
if (!isset($jackets[$jacket])) {
    $cleanupAndExit(400, ['error' => 'Unknown jacket.']);
}
$j = $jackets[$jacket];

/* ──────── Stage 3: Gemini Image — composite the REAL Barkly jacket
 * onto the user's dog ────────
 *
 * Two inputs:
 *   1) the user's dog photo (already cleaned + re-encoded)
 *   2) the actual Barkly product photo from gallery/
 *
 * The instruction explicitly says "use the jacket from image 2"
 * — that's the difference vs text-only generation, which would
 * invent a plausible-but-not-Barkly jacket. */

$productPath = dirname(__FILE__) . '/gallery/' . $j['product_file'];
if (!is_file($productPath)) {
    $cleanupAndExit(500, ['error' => 'Internal: missing product photo for ' . $j['name']]);
}
$productB64 = base64_encode(file_get_contents($productPath));

$editText =
    "You are given two images.\n" .
    "IMAGE 1 = a user's dog photo.\n" .
    "IMAGE 2 = a Barkly Fashion product photo of the \"" . $j['name'] . "\" (a " . $j['short'] . ").\n\n" .
    "TASK: Output ONE edited photo of the dog from IMAGE 1 wearing the EXACT jacket shown in IMAGE 2.\n\n" .
    "STRICT RULES:\n" .
    "1. Use the SAME dog from IMAGE 1 — same breed, face, eyes, ears, fur color, fur texture, pose.\n" .
    "2. Use the SAME background, lighting, camera angle, and composition as IMAGE 1.\n" .
    "3. The jacket on the dog MUST match IMAGE 2 exactly: same fabric, same colors, same pattern, same trim.\n" .
    "4. Do NOT invent a different jacket. Do NOT use a generic stock jacket. Use the one in IMAGE 2.\n" .
    "5. Fit the jacket naturally to the dog's torso — folds where the body curves, soft shadow underneath.\n" .
    "6. Output the edited photo only. No text, no watermark, no mannequin, no human.";

$editBody = [
    'contents' => [[ 'parts' => [
        ['text' => $editText],
        ['inline_data' => ['mime_type' => 'image/jpeg', 'data' => $dogB64]],
        ['inline_data' => ['mime_type' => 'image/jpeg', 'data' => $productB64]],
    ] ]],
    'generationConfig' => [
        'temperature'        => 0.4,
        'responseModalities' => ['IMAGE'],
    ],
];

/* Try the known model name(s). Google has shipped this under both
 * `gemini-2.5-flash-image` and `gemini-2.5-flash-image-preview` at
 * various points — try both so we degrade gracefully. */
$editedB64 = null;
$editError = null;
$imageModels = ['gemini-2.5-flash-image-preview', 'gemini-2.5-flash-image'];
foreach ($imageModels as $modelName) {
    $ech = curl_init('https://generativelanguage.googleapis.com/v1beta/models/' . $modelName . ':generateContent?key=' . $geminiKey);
    curl_setopt_array($ech, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_TIMEOUT        => 90,
        CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
        CURLOPT_POSTFIELDS     => json_encode($editBody),
    ]);
    $eraw  = curl_exec($ech);
    $ecode = curl_getinfo($ech, CURLINFO_HTTP_CODE);

    if ($ecode === 200) {
        $eresp = @json_decode($eraw, true);
        $parts = isset($eresp['candidates'][0]['content']['parts']) ? $eresp['candidates'][0]['content']['parts'] : [];
        foreach ($parts as $part) {
            if (isset($part['inline_data']['data'])) { $editedB64 = $part['inline_data']['data']; break 2; }
            if (isset($part['inlineData']['data']))  { $editedB64 = $part['inlineData']['data'];  break 2; }
        }
        if (isset($parts[0]['text'])) { $editError = trim($parts[0]['text']); }
    } else {
        $errJson = @json_decode($eraw, true);
        $editError = isset($errJson['error']['message']) ? $errJson['error']['message'] : ('AI image error ' . $ecode);
    }
}

if ($editedB64 === null) {
    $cleanupAndExit(503, [
        'error' => 'AI try-on couldn\'t generate this time. Please try again, or try a different photo.',
        'detail' => $editError,
    ]);
}

if ($tmpToCleanup && file_exists($tmpToCleanup)) @unlink($tmpToCleanup);

echo json_encode([
    'image'       => 'data:image/jpeg;base64,' . $editedB64,
    'jacket'      => $j['name'],
    'slug'        => $jacket,
    'auto_picked' => $autoPicked,
    'breed'       => $autoBreed,
    'reason'      => $autoReason,
    'provider'    => 'gemini-2.5-flash-image',
]);
