<?php
/**
 * Server-side handler for the partner enquiry form.
 *
 * Sits between partner.php and the Kuruier API so the browser never makes a
 * cross-origin request and the API base lives in one server-side place.
 *
 * The important property is that a lead is never silently lost. The API is the
 * system of record; if it is unreachable, this falls back to emailing the enquiry
 * and — failing even that — appends it to a local file. A visitor who sees the
 * success message must always be reachable by someone.
 *
 * Configuration comes from the environment, never from literals in this file:
 *   KURUIER_API_BASE   default https://api.kuruier.com
 *   LEAD_FALLBACK_TO   address for the failure-path email
 *   SMTP_HOST / SMTP_PORT / SMTP_USER / SMTP_PASS
 */

header('Content-Type: application/json');

// Buffer everything. On a host with display_errors on, a single PHP notice printed
// before the JSON makes the response unparseable — the browser then shows "something
// went wrong" for a lead that was in fact saved, and the visitor submits again or
// gives up. lead_respond() discards any such stray output before replying.
ob_start();

/** Emit the JSON response, discarding anything PHP printed before it. */
function lead_respond($success, $message, $statusCode = 200)
{
    if (ob_get_level() > 0) {
        ob_end_clean();
    }
    http_response_code($statusCode);
    echo json_encode(['success' => $success, 'message' => $message]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    lead_respond(false, 'Method not allowed', 405);
}

$raw = file_get_contents('php://input');
$input = json_decode($raw, true);
if (!is_array($input)) {
    // Fall back to a normal form POST so the page still works without JavaScript.
    $input = $_POST;
}

/** Trim, cap, and treat empty strings as absent. */
function lead_str($input, $key, $max)
{
    if (!isset($input[$key]) || !is_string($input[$key])) {
        return null;
    }
    $value = trim($input[$key]);
    if ($value === '') {
        return null;
    }
    return mb_substr($value, 0, $max);
}

$name = lead_str($input, 'name', 120);
$mobile = lead_str($input, 'mobileNumber', 20);
$category = strtoupper((string) lead_str($input, 'category', 20));

$allowedCategories = ['SHIPPER', 'FLEET_OWNER', 'RIDER', 'OTHER'];
if (!in_array($category, $allowedCategories, true)) {
    $category = 'OTHER';
}

if ($name === null) {
    lead_respond(false, 'Please tell us your name', 400);
}

if ($mobile === null || strlen(preg_replace('/\D/', '', $mobile)) < 10) {
    lead_respond(false, 'Please enter a valid mobile number', 400);
}

$payload = [
    'name'         => $name,
    'mobileNumber' => $mobile,
    'category'     => $category,
    'email'        => lead_str($input, 'email', 160),
    'city'         => lead_str($input, 'city', 80),
    'vehicleCount' => lead_str($input, 'vehicleCount', 40),
    'vehicleTypes' => lead_str($input, 'vehicleTypes', 120),
    'fromCity'     => lead_str($input, 'fromCity', 80),
    'toCity'       => lead_str($input, 'toCity', 80),
    'message'      => lead_str($input, 'message', 1000),
    'source'       => lead_str($input, 'source', 120),
];

$apiBase = getenv('KURUIER_API_BASE') ?: 'https://api.kuruier.com';
$endpoint = rtrim($apiBase, '/') . '/api/leads';

$body = json_encode(array_filter($payload, function ($value) {
    return $value !== null;
}));

$ch = curl_init($endpoint);
curl_setopt_array($ch, [
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => $body,
    CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT        => 8,
    CURLOPT_CONNECTTIMEOUT => 4,
]);
$response = curl_exec($ch);
$httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
unset($ch);

if ($httpCode >= 200 && $httpCode < 300) {
    lead_respond(true, 'Enquiry received');
}

// A 4xx is the API rejecting the data — the visitor can fix that, so pass the
// message through rather than pretending it worked.
if ($httpCode >= 400 && $httpCode < 500 && $response) {
    $decoded = json_decode($response, true);
    if (is_array($decoded) && !empty($decoded['message'])) {
        lead_respond(false, $decoded['message'], $httpCode);
    }
}

// Everything below is the API being unreachable or broken. The visitor is not at
// fault and must not be turned away, so capture the lead by other means.
error_log(sprintf(
    '[leads] API unreachable (HTTP %d, %s) — falling back for %s / %s',
    $httpCode,
    $curlError ?: 'no curl error',
    $name,
    $mobile
));

lead_fallback_capture($payload);

lead_respond(true, 'Enquiry received');

/**
 * Last-resort capture: email if SMTP is configured, and always append to a log file
 * outside the web root so nothing depends on a single channel working.
 */
function lead_fallback_capture(array $payload)
{
    // Deliberately NOT next to this file: anything under the web root is served, and
    // this log holds names and mobile numbers. The temp directory is outside it and
    // is writable wherever the site runs.
    $line = date('c') . ' ' . json_encode($payload) . PHP_EOL;
    @file_put_contents(
        rtrim(sys_get_temp_dir(), '/\\') . DIRECTORY_SEPARATOR . 'kuruier_leads_fallback.log',
        $line,
        FILE_APPEND | LOCK_EX
    );

    $to = getenv('LEAD_FALLBACK_TO');
    $user = getenv('SMTP_USER');
    $pass = getenv('SMTP_PASS');
    if (!$to || !$user || !$pass) {
        return;
    }

    $autoload = __DIR__ . '/vendor/phpmailer/phpmailer/src/PHPMailer.php';
    if (!file_exists($autoload)) {
        return;
    }
    require_once __DIR__ . '/vendor/phpmailer/phpmailer/src/Exception.php';
    require_once $autoload;
    require_once __DIR__ . '/vendor/phpmailer/phpmailer/src/SMTP.php';

    try {
        $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = getenv('SMTP_HOST') ?: 'smtp.gmail.com';
        $mail->Port = (int) (getenv('SMTP_PORT') ?: 587);
        $mail->SMTPAuth = true;
        $mail->Username = $user;
        $mail->Password = $pass;
        $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->setFrom($user, 'Kuruier Website');
        $mail->addAddress($to);
        $mail->Subject = 'FALLBACK: ' . $payload['category'] . ' enquiry — ' . $payload['name'];

        $rows = '';
        foreach ($payload as $key => $value) {
            if ($value === null) {
                continue;
            }
            $rows .= '<tr><td><b>' . htmlspecialchars($key) . '</b></td><td>'
                . htmlspecialchars($value) . '</td></tr>';
        }

        $mail->isHTML(true);
        $mail->Body = '<p>The Kuruier API was unreachable, so this enquiry was not saved '
            . 'to the admin panel. Enter it manually.</p><table border="1" cellpadding="6">'
            . $rows . '</table>';
        $mail->send();
    } catch (\Throwable $e) {
        error_log('[leads] Fallback email failed: ' . $e->getMessage());
    }
}
