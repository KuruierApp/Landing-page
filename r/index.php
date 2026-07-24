<?php
/**
 * Referral link fallback: https://kuruier.com/r/{code}
 *
 * When the Kuruier app is installed, iOS/Android intercept this URL as a
 * Universal Link / App Link and open the app directly — this PHP page never
 * renders. It only runs when the app is NOT installed (or on desktop), where
 * its job is to send the visitor to the correct app store.
 *
 * The rewrite rule in web.config maps /r/{code} -> /r/index.php?code={code}.
 */

$code = isset($_GET['code']) ? preg_replace('/[^A-Za-z0-9_-]/', '', $_GET['code']) : '';

$ua = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';

$androidPackage = 'com.marseltechlabs.kuruier';
// Android install referrer carries the referral code through the Play Store install.
$playStoreUrl = 'https://play.google.com/store/apps/details?id=' . $androidPackage
    . '&referrer=' . rawurlencode('utm_source=referral&code=' . $code);

// TODO: replace 0000000000 with the numeric App Store ID for Kuruier.
$appStoreUrl = 'https://apps.apple.com/app/kuruier/id0000000000';

$isAndroid = stripos($ua, 'Android') !== false;
$isIOS = (stripos($ua, 'iPhone') !== false)
    || (stripos($ua, 'iPad') !== false)
    || (stripos($ua, 'iPod') !== false);

if ($isAndroid) {
    header('Location: ' . $playStoreUrl, true, 302);
    exit;
}
if ($isIOS) {
    header('Location: ' . $appStoreUrl, true, 302);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Kuruier</title>
    <style>
        body { font-family: -apple-system, Segoe UI, Roboto, sans-serif; background: #162BEB; color: #fff;
               display: flex; min-height: 100vh; margin: 0; align-items: center; justify-content: center; text-align: center; }
        .card { padding: 32px; max-width: 420px; }
        h1 { font-size: 24px; margin-bottom: 12px; }
        p { opacity: .9; line-height: 1.5; }
        .btns { margin-top: 24px; display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }
        a.btn { display: inline-block; background: #fff; color: #162BEB; text-decoration: none;
                padding: 12px 20px; border-radius: 12px; font-weight: 700; }
    </style>
</head>
<body>
    <div class="card">
        <h1>You've been invited to Kuruier!</h1>
        <p>Install the app to sign up<?php echo $code ? ' with referral code <strong>' . htmlspecialchars($code) . '</strong>' : ''; ?> and start earning.</p>
        <div class="btns">
            <a class="btn" href="<?php echo htmlspecialchars($appStoreUrl); ?>">App Store</a>
            <a class="btn" href="<?php echo htmlspecialchars($playStoreUrl); ?>">Google Play</a>
        </div>
    </div>
</body>
</html>
