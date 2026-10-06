<?php
// Explicit code handoff only. No cookies, fingerprinting or deferred-install claim.
$code = strtoupper($_GET['code'] ?? '');
if (!preg_match('/^[A-Z0-9_-]{3,40}$/', $code)) { http_response_code(400); $code = ''; }
$deep = 'kuruier://launch-source?code=' . rawurlencode($code);
?>
<!doctype html><html lang="en"><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Kuruier local launch</title>
<style>body{font:18px system-ui;background:#f4f6fa;color:#172133;max-width:640px;margin:60px auto;padding:24px}main{background:white;padding:28px;border-radius:16px}a{display:block;margin:18px 0;color:#162beb}</style>
<main><h1>Kuruier local launch</h1>
<?php if ($code): ?><a href="<?php echo htmlspecialchars($deep, ENT_QUOTES, 'UTF-8'); ?>">Open installed app / செயலியைத் திற / ऐप खोलें</a><?php endif; ?>
<a href="https://play.google.com/store/apps/details?id=com.marseltechlabs.kuruier">Install on Android / Android-இல் நிறுவு / Android पर इंस्टॉल करें</a>
<p>Free onboarding · 0% launch commission · no mandatory rider recharge.</p><p lang="ta">இலவச பதிவு · தொடக்க கமிஷன் 0% · கட்டாய ரீசார்ஜ் இல்லை.</p><p lang="hi">निःशुल्क पंजीकरण · लॉन्च कमीशन 0% · अनिवार्य रिचार्ज नहीं।</p></main></html>
