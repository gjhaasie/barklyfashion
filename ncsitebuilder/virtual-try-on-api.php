<?php
/*
 * Barkly Virtual Try-On — PHP backend
 * Uses Stability AI Search-and-Replace (real AI inpainting on your dog photo).
 *
 * SETUP (one-time, 2 minutes):
 *   1. Sign up at https://platform.stability.ai (no credit card needed)
 *   2. Account → API Keys → Create API key → copy
 *   3. Paste below in place of "sk-REPLACE_WITH_YOUR_KEY"
 *   4. Deploy (git push)
 *
 * Free credits: $10 on signup ≈ 300+ generations (3 credits each).
 */
define('STABILITY_KEY', 'sk-REPLACE_WITH_YOUR_KEY');

header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(204); exit; }
if ($_SERVER['REQUEST_METHOD'] !== 'POST')    { http_response_code(405); echo json_encode(['error' => 'POST only']); exit; }

if (strpos(STABILITY_KEY, 'REPLACE') !== false) {
    http_response_code(503);
    echo json_encode(['error' => 'setup_needed', 'message' => 'API key not set. See virtual-try-on-api.php line 14 for setup (2 minutes, no credit card).']);
    exit;
}

$jacket = isset($_POST['jacket']) ? trim($_POST['jacket']) : '';
$img    = isset($_FILES['image']) ? $_FILES['image'] : null;

if (!$img || $img['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400); echo json_encode(['error' => 'Upload your dog\'s photo first.']); exit;
}
if (!$jacket) { http_response_code(400); echo json_encode(['error' => 'Pick a jacket first.']); exit; }

$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime  = finfo_file($finfo, $img['tmp_name']);
finfo_close($finfo);
if (!in_array($mime, ['image/jpeg','image/png','image/webp'], true)) {
    http_response_code(400); echo json_encode(['error' => 'Upload a JPG, PNG, or WebP.']); exit;
}
if ($img['size'] > 10 * 1024 * 1024) {
    http_response_code(400); echo json_encode(['error' => 'Photo too large — max 10 MB.']); exit;
}

/* Jacket → search target + replacement prompt */
$jackets = [
    'santa-fe' => [
        'name'   => 'Santa Fe Jacket',
        'search' => 'dog body torso',
        'prompt' => 'a dog wearing a vibrant block-printed cotton jacket with bold geometric patterns in terracotta, indigo and cream, South Asian artisan craft, intricate hand-printed motifs, well-fitted dog coat',
    ],
    'scarlet-brocade' => [
        'name'   => 'Scarlet Brocade Coat',
        'search' => 'dog body torso',
        'prompt' => 'a dog wearing an elegant scarlet red brocade coat with intricate woven damask patterns, luxurious crimson silk-like fabric, formal heirloom dog coat',
    ],
    'midnight-floral' => [
        'name'   => 'Midnight Floral Hoodie',
        'search' => 'dog body torso',
        'prompt' => 'a dog wearing a midnight navy blue hoodie with delicate white and pink floral print, soft cotton fabric, casual chic dog hoodie with hood',
    ],
    'nordic-fairisle' => [
        'name'   => 'Nordic Fairisle',
        'search' => 'dog body torso',
        'prompt' => 'a dog wearing a cream and multicolor Nordic fairisle knit sweater with classic geometric diamond patterns, warm cozy wool sweater on the dog',
    ],
    'lunar-cheongsam' => [
        'name'   => 'Lunar Cheongsam',
        'search' => 'dog body torso',
        'prompt' => 'a dog wearing a red and gold cheongsam-style coat with Chinese floral embroidery and gold mandarin trim, festive lunar new year dog coat',
    ],
];
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
            imagedestroy($src); imagedestroy($dst);
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
        'image'         => new CURLFile($tmpPath, $mime, 'dog.jpg'),
        'prompt'        => $j['prompt'],
        'search_prompt' => $j['search'],
        'output_format' => 'jpeg',
    ],
]);

$raw  = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$ctype= curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
$cerr = curl_error($ch);
curl_close($ch);

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
    'image'  => 'data:image/jpeg;base64,' . base64_encode($raw),
    'jacket' => $j['name'],
    'slug'   => $jacket,
]);
