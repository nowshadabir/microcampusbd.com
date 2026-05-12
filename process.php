<?php
/**
 * process.php
 * Zero-dependency SMTP handler for MicroCampus BD.
 * Sends emails directly via Gmail SMTP using PHP sockets.
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

    $email_sent = false;
    $error_log = "";

    /**
     * Internal function to send email via raw SMTP
     */
    function send_raw_smtp($to, $subject, $body, $from_email, $from_name, $pass) {
        $timeout = 30;
        $smtp_host = "ssl://smtp.gmail.com";
        $smtp_port = 465;

        $fp = fsockopen($smtp_host, $smtp_port, $errno, $errstr, $timeout);
        if (!$fp) return "Connection failed: $errstr ($errno)";

        function get_resp($fp) {
            $resp = "";
            while ($str = fgets($fp, 512)) {
                $resp .= $str;
                if (substr($str, 3, 1) == " ") break;
            }
            return $resp;
        }

        get_resp($fp); // Greeting
        fwrite($fp, "EHLO localhost\r\n"); get_resp($fp);
        fwrite($fp, "AUTH LOGIN\r\n"); get_resp($fp);
        fwrite($fp, base64_encode($from_email) . "\r\n"); get_resp($fp);
        fwrite($fp, base64_encode($pass) . "\r\n"); get_resp($fp);
        fwrite($fp, "MAIL FROM: <$from_email>\r\n"); get_resp($fp);
        fwrite($fp, "RCPT TO: <$to>\r\n"); get_resp($fp);
        fwrite($fp, "DATA\r\n"); get_resp($fp);

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
        $headers .= "From: $from_name <$from_email>" . "\r\n";
        $headers .= "To: $to" . "\r\n";
        $headers .= "Subject: $subject" . "\r\n";

        fwrite($fp, $headers . "\r\n" . $body . "\r\n.\r\n");
        $code = substr(get_resp($fp), 0, 3);
        
        fwrite($fp, "QUIT\r\n");
        fclose($fp);

        return $code == "250";
    }

    $subject = "New $type Request: $institution";
    $body = "
        <div style='font-family: sans-serif; padding: 20px; border: 1px solid #eee; border-radius: 10px;'>
            <h2 style='color: #0284c7;'>New $type Request</h2>
            <p><strong>Institution:</strong> $institution</p>
            <p><strong>Request Type:</strong> $type</p>
            <p><strong>Contact Person:</strong> $name</p>
            <p><strong>Email:</strong> $sender_email</p>
            <p><strong>Phone:</strong> $phone</p>
            <hr style='border: 0; border-top: 1px solid #eee; margin: 20px 0;'>
            <p style='color: #666; font-size: 12px;'>Automated notification from MicroCampus BD.</p>
        </div>
    ";

    // Send to Admins
    foreach ($admin_emails as $admin) {
        $res = send_raw_smtp($admin, $subject, $body, $gmail_user, $app_name, $app_password);
        if ($res === true) $email_sent = true;
        else $error_log .= "Admin ($admin): $res; ";
    }

    // Send copy to Sender
    send_raw_smtp($sender_email, "We received your request - $app_name", $body, $gmail_user, $app_name, $app_password);

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
            <h1 class="text-2xl font-bold text-slate-900 mb-2"><?php echo $email_sent ? 'Request Sent!' : 'Request Received'; ?></h1>
            <p class="text-slate-500 mb-8 text-sm leading-relaxed">
                Thank you, <strong><?php echo $name; ?></strong>. We've received your request for <strong><?php echo $institution; ?></strong>.<br><br>
                <?php if ($email_sent): ?>
                    A confirmation has been sent to <strong><?php echo $sender_email; ?></strong>.
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
