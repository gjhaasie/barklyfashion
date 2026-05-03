<?php
/*
 * Barkly Leads — appends every newsletter and notify-me submission
 * to a CSV file on the server. Runs alongside the existing
 * formsubmit.co email relay; this is the persistent record.
 *
 * CSV columns: timestamp_utc, type, email, product_name, product_slug, source_page, ip, user_agent
 *
 * The CSV lives outside the public web root when possible; falls back
 * to public_html with an .htaccess deny rule (added to barklyfashion's
 * top-level .htaccess).
 *
 * Download anytime via cPanel File Manager → /home/barkgjug/barkly-leads.csv
 * (or /home/barkgjug/public_html/barkly-leads.csv if outside-the-root failed).
 */

header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(204); exit; }
if ($_SERVER['REQUEST_METHOD'] !== 'POST')    { http_response_code(405); echo json_encode(['error' => 'POST only']); exit; }

/* ── Read input — accept form-encoded OR JSON body ── */
$raw = file_get_contents('php://input');
$body = $_POST;
if (empty($body) && $raw && ($body[0] ?? '') !== '') {
    $j = json_decode($raw, true);
    if (is_array($j)) { $body = $j; }
}
if (empty($body)) {
    $j = json_decode($raw, true);
    if (is_array($j)) { $body = $j; }
}

$email = isset($body['email']) ? trim($body['email']) : '';
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400); echo json_encode(['error' => 'Invalid email']); exit;
}

/* Honeypot — silently accept and discard if filled */
$honey = isset($body['_honey']) ? trim($body['_honey']) : '';
if ($honey !== '') { echo json_encode(['ok' => true]); exit; }

$type    = isset($body['type'])    ? substr(trim($body['type']),    0, 32)  : 'newsletter';
$product = isset($body['product']) ? substr(trim($body['product']), 0, 100) : '';
$slug    = isset($body['slug'])    ? substr(trim($body['slug']),    0, 80)  : '';
$source  = isset($body['source'])  ? substr(trim($body['source']),  0, 120) : '';

$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
$ua = isset($_SERVER['HTTP_USER_AGENT']) ? substr($_SERVER['HTTP_USER_AGENT'], 0, 240) : '';
$ts = gmdate('Y-m-d\TH:i:s\Z');

/* ── Pick a CSV path that PHP can actually write to ──
 * Preferred: outside the web root. Fallback: inside public_html
 * (Apache deny rule in .htaccess prevents direct download). */
$candidates = [
    dirname(__FILE__) . '/../../barkly-leads.csv',  /* /home/barkgjug/barkly-leads.csv */
    dirname(__FILE__) . '/../barkly-leads.csv',     /* /home/barkgjug/public_html/barkly-leads.csv */
    dirname(__FILE__) . '/barkly-leads.csv',        /* /home/barkgjug/public_html/ncsitebuilder/barkly-leads.csv */
];

$csvPath = null;
foreach ($candidates as $p) {
    if (is_file($p) && is_writable($p)) { $csvPath = $p; break; }
    if (!is_file($p) && is_writable(dirname($p))) { $csvPath = $p; break; }
}
if ($csvPath === null) {
    http_response_code(500); echo json_encode(['error' => 'No writable location for leads file']); exit;
}

$isNew = !is_file($csvPath);
$fp = @fopen($csvPath, 'a');
if (!$fp) { http_response_code(500); echo json_encode(['error' => 'Could not open leads file']); exit; }

@flock($fp, LOCK_EX);
if ($isNew) {
    fputcsv($fp, ['timestamp_utc','type','email','product_name','product_slug','source_page','ip','user_agent'], ',', '"', '');
}
fputcsv($fp, [$ts, $type, $email, $product, $slug, $source, $ip, $ua], ',', '"', '');
@flock($fp, LOCK_UN);
fclose($fp);

echo json_encode(['ok' => true]);
