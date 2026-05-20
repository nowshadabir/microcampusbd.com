<?php
/**
 * process.php
 * Zero-dependency SMTP handler for MicroCampus BD.
 * Optimized for multi-recipient delivery in a single session.
 */

// --- LOAD ENVIRONMENT VARIABLES ---
function loadEnv($path) {
    if (!file_exists($path)) return;
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0 || strpos($line, '=') === false) continue;
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value, " \t\n\r\0\x0B\"'");
        @putenv(sprintf('%s=%s', $name, $value));
        $_ENV[$name] = $value;
        $_SERVER[$name] = $value;
    }
}
loadEnv(__DIR__ . '/.env');

// --- CONFIGURATION ---
$gmail_user = ($_ENV['GMAIL_USER'] ?? $_SERVER['GMAIL_USER'] ?? getenv('GMAIL_USER')) ?: "knabirofficial@gmail.com";
$app_password = $_ENV['GMAIL_APP_PASS'] ?? $_SERVER['GMAIL_APP_PASS'] ?? getenv('GMAIL_APP_PASS');
$app_name = "MicroCampus BD";

$admin_emails = [
    "knabirofficial@gmail.com",
    "vivagodigital@gmail.com"
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ---- Honeypot Check ----
    $honeypot = isset($_POST["website_verification"]) ? $_POST["website_verification"] : "";
    if (!empty($honeypot)) {
        // Silently reject or redirect spam bots
        header("Location: booking.html?status=spam");
        exit;
    }

    $name = strip_tags(trim($_POST["name"]));
    $sender_email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $institution = strip_tags(trim($_POST["institution"]));
    $phone = strip_tags(trim($_POST["phone"]));
    $type = strip_tags(trim($_POST["type"]));
    $message = isset($_POST["message"]) ? strip_tags(trim($_POST["message"])) : "";

    // Required fields check
    if (empty($name) || empty($sender_email) || empty($institution)) {
        header("Location: booking.html?status=error");
        exit;
    }

    // ---- Rate Limiting (max 3 submissions per hour per IP) ----
    $rateFile = __DIR__ . '/rate_limit.json';
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $now = time();
    $limit = 3; // submissions per hour
    $window = 3600; // 1 hour in seconds

    // Load existing rate‑limit data
    $rateData = [];
    if (file_exists($rateFile)) {
        $json = @file_get_contents($rateFile);
        $rateData = json_decode($json, true) ?? [];
    }

    // Remove timestamps older than 1 hour
    if (isset($rateData[$ip])) {
        $rateData[$ip] = array_filter($rateData[$ip], function($ts) use ($now, $window) {
            return ($now - $ts) < $window;
        });
    }

    // Enforce limit
    if (isset($rateData[$ip]) && count($rateData[$ip]) >= $limit) {
        header("Location: booking.html?status=rate_limit");
        exit;
    }

    // Record this submission timestamp
    $rateData[$ip][] = $now;
    file_put_contents($rateFile, json_encode($rateData));

    // ---- Spam Detection: Link Prevention ----
    // Do not allow links (e.g. http://, https://, www., [url]) in name, institution/school, or message
    $linkPattern = '/https?:\/\/|www\.|\[url\]|\b[a-z0-9-]+\.(com|net|org|xyz|info|co|io|bd|edu|click|top|club|online|site)\b/i';
    if (preg_match($linkPattern, $name) || preg_match($linkPattern, $institution) || preg_match($linkPattern, $message)) {
        header("Location: booking.html?status=spam");
        exit;
    }

    /**
     * Sends a single email to multiple recipients in one SMTP transaction.
     */
    function send_multi_smtp($recipients, $sender_email, $subject, $body, $from_user, $from_name, $pass) {
        $timeout = 30;
        $smtp_host = "ssl://smtp.gmail.com";
        $smtp_port = 465;

        $fp = fsockopen($smtp_host, $smtp_port, $errno, $errstr, $timeout);
        if (!$fp) return false;

        function get_resp($fp) {
            $resp = "";
            while ($str = fgets($fp, 512)) {
                $resp .= $str;
                if (substr($str, 3, 1) == " ") break;
            }
            return $resp;
        }

        get_resp($fp); 
        fwrite($fp, "EHLO localhost\r\n"); get_resp($fp);
        fwrite($fp, "AUTH LOGIN\r\n"); get_resp($fp);
        fwrite($fp, base64_encode($from_user) . "\r\n"); get_resp($fp);
        fwrite($fp, base64_encode($pass) . "\r\n"); get_resp($fp);
        
        // Envelope From
        fwrite($fp, "MAIL FROM: <$from_user>\r\n"); get_resp($fp);
        
        // Envelope To (Multiple)
        foreach ($recipients as $to) {
            fwrite($fp, "RCPT TO: <$to>\r\n"); get_resp($fp);
        }

        fwrite($fp, "DATA\r\n"); get_resp($fp);

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
        $headers .= "From: $from_name <$from_user>" . "\r\n";
        $headers .= "To: $sender_email" . "\r\n"; // Visible To
        $headers .= "Subject: $subject" . "\r\n";
        $headers .= "Reply-To: $sender_email" . "\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

        fwrite($fp, $headers . "\r\n" . $body . "\r\n.\r\n");
        $code = substr(get_resp($fp), 0, 3);
        
        fwrite($fp, "QUIT\r\n");
        fclose($fp);

        return $code == "250";
    }

    $subject = "নতুন বুকিং রিকোয়েস্ট: $type - $institution";
    $message_row = "";
    if (!empty($message)) {
        $message_row = "<tr><td style='padding: 8px 0; color: #666; vertical-align: top;'>বার্তা:</td><td style='padding: 8px 0; font-weight: bold; white-space: pre-wrap;'>" . nl2br(htmlspecialchars($message)) . "</td></tr>";
    }

    $body = "
        <div style='font-family: sans-serif; padding: 20px; border: 1px solid #eee; border-radius: 12px; max-width: 600px; margin: auto;'>
            <h2 style='color: #0284c7; margin-bottom: 20px;'>নতুন রিকোয়েস্টের বিবরণ</h2>
            <table style='width: 100%; border-collapse: collapse;'>
                <tr><td style='padding: 8px 0; color: #666;'>প্রতিষ্ঠানের নাম:</td><td style='padding: 8px 0; font-weight: bold;'>$institution</td></tr>
                <tr><td style='padding: 8px 0; color: #666;'>রিকোয়েস্টের ধরন:</td><td style='padding: 8px 0; font-weight: bold;'>$type</td></tr>
                <tr><td style='padding: 8px 0; color: #666;'>যোগাযোগকারী:</td><td style='padding: 8px 0; font-weight: bold;'>$name</td></tr>
                <tr><td style='padding: 8px 0; color: #666;'>ইমেইল:</td><td style='padding: 8px 0; font-weight: bold;'><a href='mailto:$sender_email'>$sender_email</a></td></tr>
                <tr><td style='padding: 8px 0; color: #666;'>ফোন নম্বর:</td><td style='padding: 8px 0; font-weight: bold;'>$phone</td></tr>
                $message_row
            </table>
            <hr style='border: 0; border-top: 1px solid #eee; margin: 25px 0;'>
            <p style='color: #999; font-size: 11px; text-align: center;'>এটি মাইক্রোক্যাম্পাস বিডি প্ল্যাটফর্ম থেকে একটি অটোমেটেড নোটিফিকেশন।</p>
        </div>
    ";

    // Prepare all recipients (Admins + Sender)
    $all_recipients = array_unique(array_merge($admin_emails, [$sender_email]));

    // Send in one single SMTP transaction
    $email_sent = send_multi_smtp($all_recipients, $sender_email, $subject, $body, $gmail_user, $app_name, $app_password);

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>সফল হয়েছে | মাইক্রোক্যাম্পাস বিডি</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Anek+Bangla:wght@400;700&family=Hind+Siliguri:wght@400;700&display=swap" rel="stylesheet">
        <style>body { font-family: 'Hind Siliguri', 'Inter', sans-serif; } h1 { font-family: 'Anek Bangla', sans-serif; }</style>
        <script src="https://unpkg.com/lucide@0.407.0/dist/umd/lucide.min.js" defer></script>
    </head>
    <body class="bg-slate-50 flex items-center justify-center min-h-screen p-6">
        <div class="max-w-md w-full bg-white rounded-3xl p-10 text-center shadow-xl border border-slate-100">
            <div class="w-16 h-16 <?php echo $email_sent ? 'bg-green-100 text-green-600' : 'bg-amber-100 text-amber-600'; ?> rounded-full flex items-center justify-center mx-auto mb-6">
                <i data-lucide="<?php echo $email_sent ? 'check' : 'alert-triangle'; ?>" class="w-8 h-8"></i>
            </div>
            <h1 class="text-2xl font-bold text-slate-900 mb-2"><?php echo $email_sent ? 'সফলভাবে পাঠানো হয়েছে!' : 'প্রসেস করা হচ্ছে...'; ?></h1>
            <p class="text-slate-500 mb-8 text-sm leading-relaxed">
                ধন্যবাদ, <strong><?php echo $name; ?></strong>। আমরা আপনার রিকোয়েস্টটি (<strong><?php echo $institution; ?></strong>) সফলভাবে পেয়েছি।<br><br>
                <?php if ($email_sent): ?>
                    একটি কনফার্মেশন ইমেইল আপনার ঠিকানায় এবং আমাদের সাপোর্ট টিমের কাছে পাঠানো হয়েছে।
                <?php else: ?>
                    <span class="text-amber-600">দ্রষ্টব্য: আপনার তথ্য আমাদের কাছে জমা আছে। আমাদের টিম খুব শীঘ্রই আপনার সাথে যোগাযোগ করবে।</span>
                <?php endif; ?>
            </p>
            <a href="index.html" class="inline-block w-full py-3.5 bg-slate-900 text-white rounded-xl font-bold hover:bg-sky-600 transition-all">
                হোম পেজে ফিরে যান
            </a>
        </div>
        <script>window.onload = () => { lucide.createIcons(); }</script>
    </body>
    </html>
    <?php
} else {
    header("Location: booking.html");
}
?>
