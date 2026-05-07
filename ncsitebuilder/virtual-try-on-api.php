<?php
/*
 * Barkly Virtual Try-On — PHP backend
 *
 * Two AIs work together:
 *   1) GEMINI_KEY (free, optional) — analyses the dog and picks the best
 *      jacket from the collection when jacket="auto"
 *   2) STABILITY_KEY — repaints just the dog body wearing that jacket
 *
 * SECRETS — barkly-secrets.php (one of: /home/barkgjug/, /public_html/,
 * /public_html/ncsitebuilder/) — looks like:
 *
 *   <?php
 *   define('STABILITY_KEY', 'sk-...');     // platform.stability.ai
 *   define('GEMINI_KEY',    'AIza...');    // aistudio.google.com/app/apikey (free, no card)
 *
 * If GEMINI_KEY is missing, "AI picks" still works but always defaults to
 * Scarlet Brocade. The 5 manual swatches always work with just STABILITY_KEY.
 */
/* Try several locations — outside web root is preferred, but cPanel
 * open_basedir often blocks that, so we also accept a copy inside
 * ncsitebuilder/ (Apache will deny direct access via the .htaccess rule). */
$secretsCandidates = [
    dirname(__FILE__) . '/../../barkly-secrets.php',  /* /home/barkgjug/barkly-secrets.php */
    dirname(__FILE__) . '/../barkly-secrets.php',     /* /home/barkgjug/public_html/barkly-secrets.php */
    dirname(__FILE__) . '/barkly-secrets.php',        /* /home/barkgjug/public_html/ncsitebuilder/barkly-secrets.php */
];
foreach ($secretsCandidates as $sp) {
    if (@is_file($sp)) { @require_once $sp; if (defined('STABILITY_KEY')) break; }
}
if (!defined('STABILITY_KEY')) { define('STABILITY_KEY', ''); }

header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(204); exit; }
if ($_SERVER['REQUEST_METHOD'] !== 'POST')    { http_response_code(405); echo json_encode(['error' => 'POST only']); exit; }

if (STABILITY_KEY === '' || strpos(STABILITY_KEY, 'REPLACE') !== false) {
    http_response_code(503);
    echo json_encode(['error' => 'setup_needed', 'message' => 'API key not set. Create /home/barkgjug/barkly-secrets.php with: <?php define(\'STABILITY_KEY\', \'sk-...\');']);
    exit;
}

$jacket = isset($_POST['jacket']) ? trim($_POST['jacket']) : '';
$img    = isset($_FILES['image']) ? $_FILES['image'] : null;

if (!$img || $img['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400); echo json_encode(['error' => 'Upload your dog\'s photo first.']); exit;
}
if (!$jacket) { $jacket = 'auto'; }

$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime  = finfo_file($finfo, $img['tmp_name']);
if (!in_array($mime, ['image/jpeg','image/png','image/webp'], true)) {
    http_response_code(400); echo json_encode(['error' => 'Upload a JPG, PNG, or WebP.']); exit;
}
if ($img['size'] > 10 * 1024 * 1024) {
    http_response_code(400); echo json_encode(['error' => 'Photo too large — max 10 MB.']); exit;
}

/* Jacket catalog — search prompt narrowly targets the torso/back ONLY
 * (so head, face, legs, tail, breed and pose are preserved); positive
 * prompt describes only the garment that should appear there.
 * NOTE: avoid "fur" or "dog body" in search — those can mask the whole
 * animal and the AI then regenerates a different dog. */
$jackets = [
    'santa-fe' => [
        'name'   => 'Santa Fe Jacket',
        'search' => 'the back and torso of the dog between the neck and tail',
        'prompt' => 'a fitted block-printed cotton jacket with bold geometric patterns in terracotta, indigo and cream, South Asian artisan hand-print, garment only',
    ],
    'scarlet-brocade' => [
        'name'   => 'Scarlet Brocade Coat',
        'search' => 'the back and torso of the dog between the neck and tail',
        'prompt' => 'a fitted scarlet red brocade coat with intricate damask pattern, luxurious crimson silk fabric, garment only',
    ],
    'midnight-floral' => [
        'name'   => 'Midnight Floral Hoodie',
        'search' => 'the back and torso of the dog between the neck and tail',
        'prompt' => 'a fitted midnight navy blue hoodie with delicate white and pink floral print, soft cotton, garment only',
    ],
    'nordic-fairisle' => [
        'name'   => 'Nordic Fairisle',
        'search' => 'the back and torso of the dog between the neck and tail',
        'prompt' => 'a fitted cream and multicolor Nordic fairisle knit sweater with classic geometric diamond patterns, warm wool, garment only',
    ],
    'lunar-cheongsam' => [
        'name'   => 'Lunar Cheongsam',
        'search' => 'the back and torso of the dog between the neck and tail',
        'prompt' => 'a fitted red and gold cheongsam-style coat with Chinese floral embroidery and gold mandarin trim, festive lunar new year style, garment only',
    ],
];

/* Negative prompt: applied to every jacket — explicitly tell Stability
 * NOT to regenerate the dog itself. Without this, search-and-replace
 * sometimes swaps the dog for a generic stock dog wearing the coat. */
$negativePrompt = 'different dog, new dog, replaced dog, change of breed, different face, different head, altered fur color, altered eyes, distorted anatomy, extra legs, low quality, blurry';

/* GEMINI VISION: dog-photo guard + auto-pick (when jacket="auto").
 * Runs on every upload if GEMINI_KEY is set — saves Stability credits
 * by rejecting non-dog photos before the inpaint call. */
$autoPicked   = false;
$autoBreed    = null;
$autoReason   = null;

$geminiKey = defined('GEMINI_KEY') ? GEMINI_KEY : '';
$useGemini = ($geminiKey !== '' && strpos($geminiKey, 'REPLACE') === false);

if ($useGemini) {
    $b64 = base64_encode(file_get_contents($img['tmp_name']));
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

    /* Dog-photo guard: if Gemini says no dog, refuse politely. */
    if (is_array($gpick) && isset($gpick['is_dog']) && $gpick['is_dog'] === false) {
        $msg = !empty($gpick['not_dog_message'])
            ? $gpick['not_dog_message']
            : 'That doesn\'t look like a dog photo — please upload a clear photo of your dog.';
        http_response_code(400);
        echo json_encode(['error' => $msg, 'not_a_dog' => true]);
        exit;
    }

    /* For auto mode, take Gemini's slug pick. For specific-jacket mode,
     * keep the user's choice and just record breed/reason for display. */
    $picked = isset($gpick['slug']) ? trim(strtolower($gpick['slug'])) : '';
    if ($jacket === 'auto') {
        $jacket = isset($jackets[$picked]) ? $picked : 'scarlet-brocade';
        $autoPicked = true;
    }
    $autoBreed  = isset($gpick['breed'])  ? $gpick['breed']  : null;
    $autoReason = isset($gpick['reason']) ? $gpick['reason'] : null;
}

/* If Gemini wasn't available and jacket is still "auto", default to scarlet-brocade */
if ($jacket === 'auto') {
    $jacket = 'scarlet-brocade';
    $autoPicked = true;
    $autoReason = 'Default style (Gemini key not configured).';
}

if (!isset($jackets[$jacket])) { http_response_code(400); echo json_encode(['error' => 'Unknown jacket.']); exit; }
$j = $jackets[$jacket];

/* Resize to ≤1024px on long edge to stay within API limits + speed up */
$tmpPath = $img['tmp_name'];
$tmpToCleanup = null;
$dims = getimagesize($tmpPath);
if ($dims && max($dims[0], $dims[1]) > 1024) {
    $sw = $dims[0]; $sh = $dims[1];
    if ($sw >= $sh) { $dw = 1024; $dh = intval($sh * 1024 / $sw); }
    else            { $dh = 1024; $dw = intval($sw * 1024 / $sh); }
    /* round to multiples of 64 (preferred by SD models) */
    $dw = max(64, intval(round($dw / 64)) * 64);
    $dh = max(64, intval(round($dh / 64)) * 64);
    $loader = ($mime === 'image/png') ? 'imagecreatefrompng' :
              (($mime === 'image/webp') ? 'imagecreatefromwebp' : 'imagecreatefromjpeg');
    if (function_exists($loader)) {
        $src = @$loader($tmpPath);
        if ($src) {
            $dst = imagecreatetruecolor($dw, $dh);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $dw, $dh, $sw, $sh);
            $resized = tempnam(sys_get_temp_dir(), 'barkly_');
            imagejpeg($dst, $resized, 92);
            $tmpPath = $resized; $tmpToCleanup = $resized; $mime = 'image/jpeg';
        }
    }
}

/* Call Stability AI Search-and-Replace */
$ch = curl_init('https://api.stability.ai/v2beta/stable-image/edit/search-and-replace');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_TIMEOUT        => 120,
    CURLOPT_HTTPHEADER     => [
        'Authorization: Bearer ' . STABILITY_KEY,
        'Accept: image/*',
    ],
    CURLOPT_POSTFIELDS => [
        'image'           => new CURLFile($tmpPath, $mime, 'dog.jpg'),
        'prompt'          => $j['prompt'],
        'search_prompt'   => $j['search'],
        'negative_prompt' => $negativePrompt,
        /* grow_mask kept small so the inpaint hugs the torso and doesn't
         * bleed into the head/face/legs (those must stay original). */
        'grow_mask'       => '3',
        'output_format'   => 'jpeg',
    ],
]);

$raw  = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$ctype= curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
$cerr = curl_error($ch);

if ($tmpToCleanup && file_exists($tmpToCleanup)) @unlink($tmpToCleanup);

if ($cerr) { http_response_code(500); echo json_encode(['error' => 'Network error. Try again.']); exit; }

if ($code === 401) { http_response_code(401); echo json_encode(['error' => 'API key invalid. Check virtual-try-on-api.php.']); exit; }
if ($code === 402) { http_response_code(402); echo json_encode(['error' => 'API credits exhausted. Top up at platform.stability.ai.']); exit; }
if ($code === 403) { http_response_code(403); echo json_encode(['error' => 'API rejected request. Try a different photo.']); exit; }
if ($code === 413) { http_response_code(413); echo json_encode(['error' => 'Photo too large after processing.']); exit; }

if ($code !== 200) {
    /* Error response is JSON, not an image */
    $errJson = @json_decode($raw, true);
    $msg = isset($errJson['errors'][0]) ? $errJson['errors'][0] : (isset($errJson['name']) ? $errJson['name'] : ('AI error ' . $code));
    http_response_code(500); echo json_encode(['error' => $msg]); exit;
}

/* 200 → raw JPEG bytes */
echo json_encode([
    'image'       => 'data:image/jpeg;base64,' . base64_encode($raw),
    'jacket'      => $j['name'],
    'slug'        => $jacket,
    'auto_picked' => $autoPicked,
    'breed'       => $autoBreed,
    'reason'      => $autoReason,
]);
