<?php
/*
 * Barkly Virtual Try-On — PHP backend
 *
 * Three-stage pipeline:
 *   1) UPLOAD SECURITY GAUNTLET — extension + MIME + dimensions + GD
 *      re-encode strips polyglot payloads. Only JPG / PNG / WebP allowed.
 *   2) GEMINI VISION  (gemini-2.5-flash) — confirms the photo is a dog
 *      and (in auto mode) picks the best jacket for the breed.
 *   3) IMAGE EDIT     — Gemini 2.5 Flash Image (Nano Banana) edits the
 *      uploaded photo to ADD the jacket onto the same dog. If Gemini
 *      image-edit is unavailable, falls back to Stability AI
 *      search-and-replace.
 *
 * SECRETS — barkly-secrets.php (one of: /home/barkgjug/, /public_html/,
 * /public_html/ncsitebuilder/) — looks like:
 *
 *   <?php
 *   define('STABILITY_KEY', 'sk-...');     // platform.stability.ai (fallback)
 *   define('GEMINI_KEY',    'AIza...');    // aistudio.google.com/app/apikey
 *
 * GEMINI_KEY is now PRIMARY — Stability is a fallback only.
 */

$secretsCandidates = [
    dirname(__FILE__) . '/../../barkly-secrets.php',  /* /home/barkgjug/barkly-secrets.php */
    dirname(__FILE__) . '/../barkly-secrets.php',     /* /home/barkgjug/public_html/barkly-secrets.php */
    dirname(__FILE__) . '/barkly-secrets.php',        /* /home/barkgjug/public_html/ncsitebuilder/barkly-secrets.php */
];
foreach ($secretsCandidates as $sp) {
    if (@is_file($sp)) { @require_once $sp; if (defined('GEMINI_KEY') || defined('STABILITY_KEY')) break; }
}
if (!defined('STABILITY_KEY')) { define('STABILITY_KEY', ''); }
if (!defined('GEMINI_KEY'))    { define('GEMINI_KEY',    ''); }

header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(204); exit; }
if ($_SERVER['REQUEST_METHOD'] !== 'POST')    { http_response_code(405); echo json_encode(['error' => 'POST only']); exit; }

$geminiKey   = (GEMINI_KEY    !== '' && strpos(GEMINI_KEY,    'REPLACE') === false) ? GEMINI_KEY    : '';
$stabilityKey= (STABILITY_KEY !== '' && strpos(STABILITY_KEY, 'REPLACE') === false) ? STABILITY_KEY : '';
if ($geminiKey === '' && $stabilityKey === '') {
    http_response_code(503);
    echo json_encode(['error' => 'setup_needed', 'message' => 'No AI keys configured. Set GEMINI_KEY (preferred) or STABILITY_KEY in barkly-secrets.php.']);
    exit;
}

$jacket = isset($_POST['jacket']) ? trim($_POST['jacket']) : '';
$img    = isset($_FILES['image']) ? $_FILES['image'] : null;

/* ──────── Upload security gauntlet ────────
 * Defense in depth — every check below must pass before bytes are
 * touched again. Goal: reject malware / polyglot uploads.
 *   1. Real PHP-managed upload (not a forged $_FILES entry)
 *   2. No upload-level error
 *   3. Size ≤ 10 MB (DoS guard)
 *   4. Extension is one of jpg/jpeg/png/webp (block .php, .svg, .exe…)
 *   5. libmagic-sniffed MIME is JPEG/PNG/WebP
 *   6. Sniffed MIME matches the claimed extension (no MIME spoofing)
 *   7. getimagesize() decodes it (real image, not just claimed)
 *   8. IMAGETYPE constant matches MIME (no container mislabeling)
 *   9. Dimensions sane (decompression-bomb guard, ≤10k × 10k, ≤50 MP)
 *  10. Re-encoded through GD before being sent anywhere — strips EXIF,
 *      ICC profiles, embedded scripts, and any polyglot payload.
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

/* ──────── MANDATORY GD re-encode ────────
 * Always rebuild the image through GD before we send it anywhere. If a
 * polyglot file slipped past every check above, decoding then
 * re-encoding to a fresh JPEG strips any embedded payload. The bytes we
 * send to the AI provider are bytes GD itself just generated. */
$tmpPath      = $img['tmp_name'];
$tmpToCleanup = null;
$sw = $dims[0]; $sh = $dims[1];
if (max($sw, $sh) > 1024) {
    if ($sw >= $sh) { $dw = 1024; $dh = intval($sh * 1024 / $sw); }
    else            { $dh = 1024; $dw = intval($sw * 1024 / $sh); }
} else {
    $dw = $sw; $dh = $sh;
}
/* round to multiples of 64 (preferred by SD models) */
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

/* ──────── Jacket catalog ──────── */
$jackets = [
    'santa-fe' => [
        'name' => 'Santa Fe Jacket',
        'edit' => 'block-printed cotton jacket with bold geometric patterns in terracotta, indigo and cream — South Asian artisan hand-print style',
        /* Stability fallback fields */
        'search' => 'the back and torso of the dog between the neck and tail',
        'prompt' => 'a fitted block-printed cotton jacket with bold geometric patterns in terracotta, indigo and cream, South Asian artisan hand-print, garment only',
    ],
    'scarlet-brocade' => [
        'name' => 'Scarlet Brocade Coat',
        'edit' => 'fitted scarlet red brocade coat with intricate damask pattern in luxurious crimson silk fabric',
        'search' => 'the back and torso of the dog between the neck and tail',
        'prompt' => 'a fitted scarlet red brocade coat with intricate damask pattern, luxurious crimson silk fabric, garment only',
    ],
    'midnight-floral' => [
        'name' => 'Midnight Floral Hoodie',
        'edit' => 'midnight navy blue hoodie with delicate white and pink floral print, soft cotton',
        'search' => 'the back and torso of the dog between the neck and tail',
        'prompt' => 'a fitted midnight navy blue hoodie with delicate white and pink floral print, soft cotton, garment only',
    ],
    'nordic-fairisle' => [
        'name' => 'Nordic Fairisle',
        'edit' => 'cream and multicolor Nordic fairisle knit sweater with classic geometric diamond patterns in warm wool',
        'search' => 'the back and torso of the dog between the neck and tail',
        'prompt' => 'a fitted cream and multicolor Nordic fairisle knit sweater with classic geometric diamond patterns, warm wool, garment only',
    ],
    'lunar-cheongsam' => [
        'name' => 'Lunar Cheongsam',
        'edit' => 'red and gold cheongsam-style coat with Chinese floral embroidery and gold mandarin trim, festive lunar new year style',
        'search' => 'the back and torso of the dog between the neck and tail',
        'prompt' => 'a fitted red and gold cheongsam-style coat with Chinese floral embroidery and gold mandarin trim, festive lunar new year style, garment only',
    ],
];

/* ──────── Stage 2: Gemini Vision — is_dog + auto-pick ──────── */
$autoPicked = false;
$autoBreed  = null;
$autoReason = null;

if ($geminiKey !== '') {
    $b64 = base64_encode(file_get_contents($tmpPath));
    $sysPrompt =
        "You are the Barkly Fashion AI stylist. Look at the uploaded photo.\n\n" .
        "FIRST: decide if the photo's main subject is a dog (any breed, any pose, with or without clothing). " .
        "Cats, humans, other animals, screenshots, drawings, empty rooms etc. all count as NOT a dog.\n\n" .
        "If NOT a dog, respond ONLY with:\n" .
        "{\"is_dog\": false, \"not_dog_message\": \"one short polite sentence describing what you see and asking the user to upload a clear dog photo\"}\n\n" .
        "If YES a dog, ALSO pick exactly one jacket from:\n" .
        "- santa-fe : bold block-print cotton, terracotta + indigo, casual chic. Suits playful, scruffy, or active dogs.\n" .
        "- scarlet-brocade : crimson brocade with damask weave, formal & elegant. Suits poised, fluffy, or refined dogs.\n" .
        "- midnight-floral : navy blue floral hoodie, relaxed everyday. Suits friendly, casual dogs of any size.\n" .
        "- nordic-fairisle : cream wool fairisle knit, cozy. Suits stocky or fluffy cold-weather dogs.\n" .
        "- lunar-cheongsam : red + gold festive cheongsam. Suits striking, ceremonial-looking dogs.\n\n" .
        "Then respond ONLY with:\n" .
        "{\"is_dog\": true, \"slug\": \"...\", \"breed\": \"best breed guess\", \"reason\": \"one short sentence\"}";
    $body = [
        'contents' => [[ 'parts' => [
            ['text' => $sysPrompt],
            ['inline_data' => ['mime_type' => $mime, 'data' => $b64]],
        ] ]],
        'generationConfig' => [
            'temperature'      => 0.3,
            /* Gemini 2.5 Flash uses hidden "thinking" tokens that count against
             * the budget — give it room or the visible response gets clipped. */
            'maxOutputTokens'  => 1200,
            'responseMimeType' => 'application/json',
        ],
    ];
    $gch = curl_init('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=' . $geminiKey);
    curl_setopt_array($gch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_TIMEOUT        => 20,
        CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
        CURLOPT_POSTFIELDS     => json_encode($body),
    ]);
    $graw  = curl_exec($gch);
    $gcode = curl_getinfo($gch, CURLINFO_HTTP_CODE);
    $gresp = ($gcode === 200) ? @json_decode($graw, true) : null;
    $gtext = isset($gresp['candidates'][0]['content']['parts'][0]['text']) ? $gresp['candidates'][0]['content']['parts'][0]['text'] : '';
    $gtext = preg_replace('/^```json\s*|\s*```$/i', '', trim($gtext));
    $gpick = @json_decode($gtext, true);

    /* Dog-photo guard: if Gemini says no dog, refuse politely and stop. */
    if (is_array($gpick) && isset($gpick['is_dog']) && $gpick['is_dog'] === false) {
        $msg = !empty($gpick['not_dog_message'])
            ? $gpick['not_dog_message']
            : 'That doesn\'t look like a dog photo — please upload a clear photo of your dog.';
        if ($tmpToCleanup && file_exists($tmpToCleanup)) @unlink($tmpToCleanup);
        http_response_code(400);
        echo json_encode(['error' => $msg, 'not_a_dog' => true]);
        exit;
    }

    $picked = isset($gpick['slug']) ? trim(strtolower($gpick['slug'])) : '';
    if ($jacket === 'auto') {
        $jacket = isset($jackets[$picked]) ? $picked : 'scarlet-brocade';
        $autoPicked = true;
    }
    $autoBreed  = isset($gpick['breed'])  ? $gpick['breed']  : null;
    $autoReason = isset($gpick['reason']) ? $gpick['reason'] : null;
}

if ($jacket === 'auto') {
    $jacket = 'scarlet-brocade';
    $autoPicked = true;
    $autoReason = 'Default style (Gemini key not configured).';
}

if (!isset($jackets[$jacket])) {
    if ($tmpToCleanup && file_exists($tmpToCleanup)) @unlink($tmpToCleanup);
    http_response_code(400); echo json_encode(['error' => 'Unknown jacket.']); exit;
}
$j = $jackets[$jacket];

/* ──────── Stage 3a: PRIMARY — Gemini 2.5 Flash Image (Nano Banana)
 *
 * Why Gemini and not Stability for the actual edit:
 * Stability search-and-replace was sometimes returning fully-generated
 * stock images (random humans, random dogs) instead of editing the
 * uploaded photo. Gemini 2.5 Flash Image is purpose-built for
 * instruction-based image editing that PRESERVES the input subject.
 *
 * Returns:
 *   On success → $editedB64  = base64 JPEG (set below, JSON encoded out)
 *   On failure → falls through to the Stability fallback
 */
$editedB64    = null;
$editProvider = null;
$editError    = null;

if ($geminiKey !== '') {
    /* The instruction is intentionally heavy on "keep the same dog" —
     * Gemini 2.5 Flash Image follows edit instructions literally. */
    $editText =
        "Edit this exact photo: dress the dog in a fitted " . $j['edit'] . ".\n\n" .
        "CRITICAL RULES — read carefully:\n" .
        "1. Use the SAME dog from the uploaded photo. Do NOT replace the dog with a different dog or a human.\n" .
        "2. Preserve the dog's breed, face, eyes, ears, fur color, fur texture, and pose EXACTLY as in the original.\n" .
        "3. Keep the SAME background, lighting, camera angle, and image composition.\n" .
        "4. Only ADD the garment fitted to the dog's back and torso — do not change anything else.\n" .
        "5. The garment should look natural on the dog — folds where the body curves, shadow underneath.\n" .
        "6. Output a single edited photo with no text or watermark.";

    $b64Edit = base64_encode(file_get_contents($tmpPath));
    $editBody = [
        'contents' => [[ 'parts' => [
            ['text' => $editText],
            ['inline_data' => ['mime_type' => $mime, 'data' => $b64Edit]],
        ] ]],
        'generationConfig' => [
            'temperature'        => 0.4,
            'responseModalities' => ['IMAGE'],
        ],
    ];

    /* Try the stable model first, then preview as a fallback (Google
     * sometimes ships features under -preview before promotion). */
    $imageModels = ['gemini-2.5-flash-image', 'gemini-2.5-flash-image-preview'];
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
                if (isset($part['inline_data']['data'])) {
                    $editedB64    = $part['inline_data']['data'];
                    $editProvider = 'gemini-2.5-flash-image';
                    break 2;
                }
                if (isset($part['inlineData']['data'])) { /* camelCase variant */
                    $editedB64    = $part['inlineData']['data'];
                    $editProvider = 'gemini-2.5-flash-image';
                    break 2;
                }
            }
            /* 200 but no image returned — capture any text reason and keep trying */
            if (isset($parts[0]['text'])) { $editError = $parts[0]['text']; }
        } else {
            $errJson = @json_decode($eraw, true);
            $editError = isset($errJson['error']['message']) ? $errJson['error']['message'] : ('Gemini image-edit error ' . $ecode);
        }
    }
}

/* ──────── Stage 3b: FALLBACK — Stability search-and-replace
 *
 * Only runs if Gemini image edit didn't produce an image. Kept around
 * because the user has paid Stability credits — but no longer the
 * default since it tends to hallucinate full stock images. */
if ($editedB64 === null && $stabilityKey !== '') {
    $negativePrompt = 'different dog, new dog, replaced dog, change of breed, different face, different head, altered fur color, altered eyes, distorted anatomy, extra legs, low quality, blurry, human, person';

    $ch = curl_init('https://api.stability.ai/v2beta/stable-image/edit/search-and-replace');
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_TIMEOUT        => 120,
        CURLOPT_HTTPHEADER     => [
            'Authorization: Bearer ' . $stabilityKey,
            'Accept: image/*',
        ],
        CURLOPT_POSTFIELDS => [
            'image'           => new CURLFile($tmpPath, $mime, 'dog.jpg'),
            'prompt'          => $j['prompt'],
            'search_prompt'   => $j['search'],
            'negative_prompt' => $negativePrompt,
            'grow_mask'       => '3',
            'output_format'   => 'jpeg',
        ],
    ]);
    $sraw  = curl_exec($ch);
    $scode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($scode === 200) {
        $editedB64    = base64_encode($sraw);
        $editProvider = 'stability-search-and-replace';
    } else {
        $errJson = @json_decode($sraw, true);
        $editError = isset($errJson['errors'][0]) ? $errJson['errors'][0]
                   : (isset($errJson['name']) ? $errJson['name'] : ('Stability error ' . $scode));
    }
}

/* Cleanup */
if ($tmpToCleanup && file_exists($tmpToCleanup)) @unlink($tmpToCleanup);

if ($editedB64 === null) {
    http_response_code(500);
    echo json_encode([
        'error' => $editError ? ('AI couldn\'t edit your photo: ' . $editError) : 'AI couldn\'t edit your photo. Please try a different photo.',
    ]);
    exit;
}

echo json_encode([
    'image'       => 'data:image/jpeg;base64,' . $editedB64,
    'jacket'      => $j['name'],
    'slug'        => $jacket,
    'auto_picked' => $autoPicked,
    'breed'       => $autoBreed,
    'reason'      => $autoReason,
    'provider'    => $editProvider,
]);
