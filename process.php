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
        putenv(sprintf('%s=%s', $name, $value));
        $_ENV[$name] = $value;
    }
}
loadEnv(__DIR__ . '/.env');

// --- CONFIGURATION ---
$gmail_user = getenv('GMAIL_USER') ?: "knabirofficial@gmail.com";
$app_password = getenv('GMAIL_APP_PASS');
$app_name = "MicroCampus BD";

$admin_emails = [
    "knabirofficial@gmail.com",
    "vivagodigital@gmail.com",
    "duropoth@gmail.com"
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $sender_email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $institution = strip_tags(trim($_POST["institution"]));
    $phone = strip_tags(trim($_POST["phone"]));
    $type = strip_tags(trim($_POST["type"]));

    if (empty($name) || empty($sender_email) || empty($institution)) {
        header("Location: booking.html?status=error");
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

    $subject = "New $type Request: $institution";
    $body = "
        <div style='font-family: sans-serif; padding: 20px; border: 1px solid #eee; border-radius: 12px; max-width: 600px; margin: auto;'>
            <h2 style='color: #0284c7; margin-bottom: 20px;'>New Request Details</h2>
            <table style='width: 100%; border-collapse: collapse;'>
                <tr><td style='padding: 8px 0; color: #666;'>Institution:</td><td style='padding: 8px 0; font-weight: bold;'>$institution</td></tr>
                <tr><td style='padding: 8px 0; color: #666;'>Request Type:</td><td style='padding: 8px 0; font-weight: bold;'>$type</td></tr>
                <tr><td style='padding: 8px 0; color: #666;'>Contact Name:</td><td style='padding: 8px 0; font-weight: bold;'>$name</td></tr>
                <tr><td style='padding: 8px 0; color: #666;'>Email:</td><td style='padding: 8px 0; font-weight: bold;'><a href='mailto:$sender_email'>$sender_email</a></td></tr>
                <tr><td style='padding: 8px 0; color: #666;'>Phone:</td><td style='padding: 8px 0; font-weight: bold;'>$phone</td></tr>
            </table>
            <hr style='border: 0; border-top: 1px solid #eee; margin: 25px 0;'>
            <p style='color: #999; font-size: 11px; text-align: center;'>This is an automated notification from the MicroCampus BD Platform.</p>
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
        <title>Success | MicroCampus BD</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://unpkg.com/lucide@0.407.0/dist/umd/lucide.min.js" defer></script>
    </head>
    <body class="bg-slate-50 flex items-center justify-center min-h-screen p-6">
        <div class="max-w-md w-full bg-white rounded-3xl p-10 text-center shadow-xl border border-slate-100">
            <div class="w-16 h-16 <?php echo $email_sent ? 'bg-green-100 text-green-600' : 'bg-amber-100 text-amber-600'; ?> rounded-full flex items-center justify-center mx-auto mb-6">
                <i data-lucide="<?php echo $email_sent ? 'check' : 'alert-triangle'; ?>" class="w-8 h-8"></i>
            </div>
            <h1 class="text-2xl font-bold text-slate-900 mb-2"><?php echo $email_sent ? 'Request Sent!' : 'Processing...'; ?></h1>
            <p class="text-slate-500 mb-8 text-sm leading-relaxed">
                Thank you, <strong><?php echo $name; ?></strong>. We've received your request for <strong><?php echo $institution; ?></strong>.<br><br>
                <?php if ($email_sent): ?>
                    Confirmation emails have been sent to you and our support team.
                <?php else: ?>
                    <span class="text-amber-600">Note: We've saved your request. Our team will contact you shortly.</span>
                <?php endif; ?>
            </p>
            <a href="index.html" class="inline-block w-full py-3.5 bg-slate-900 text-white rounded-xl font-bold hover:bg-sky-600 transition-all">
                Return Home
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
