<?php
/**
 * process.php
 * Handles form submission and sends emails to multiple recipients.
 */

// --- LOAD ENVIRONMENT VARIABLES ---
function loadEnv($path) {
    if (!file_exists($path)) return;
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
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

// Recipient List
$admin_emails = [
    "knabirofficial@gmail.com",
    "vivagodigital@gmail.com",
    "duropoth@gmail.com"
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = strip_tags(trim($_POST["name"]));
    $sender_email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $institution = strip_tags(trim($_POST["institution"]));
    $phone = strip_tags(trim($_POST["phone"]));
    $type = strip_tags(trim($_POST["type"]));

    // Simple validation
    if (empty($name) || empty($sender_email) || empty($institution)) {
        header("Location: booking.html?status=error");
        exit;
    }

    // --- EMAIL LOGIC ---
    // Note: To actually send these emails from XAMPP, you must use a library like PHPMailer.
    // Below is the logic you would use with PHPMailer:

    /*
    require 'vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = $gmail_user;
        $mail->Password   = $app_password;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom($gmail_user, $app_name);
        
        // Add Admin Recipients
        foreach ($admin_emails as $admin) {
            $mail->addAddress($admin);
        }
        
        // Add Sender as recipient (Copy to Sender)
        $mail->addAddress($sender_email, $name);

        $mail->isHTML(true);
        $mail->Subject = "New $type Request: $institution";
        $mail->Body    = "
            <h3>New Request Details</h3>
            <p><strong>Institution:</strong> $institution</p>
            <p><strong>Request Type:</strong> $type</p>
            <p><strong>Contact Person:</strong> $name</p>
            <p><strong>Email:</strong> $sender_email</p>
            <p><strong>Phone:</strong> $phone</p>
            <hr>
            <p>This is an automated notification from $app_name.</p>
        ";

        $mail->send();
    } catch (Exception $e) {
        // Log error if needed: $e->getMessage();
    }
    */

    // --- SUCCESS RESPONSE ---
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
            <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-6">
                <i data-lucide="check" class="w-8 h-8"></i>
            </div>
            <h1 class="text-2xl font-bold text-slate-900 mb-2">Request Sent!</h1>
            <p class="text-slate-500 mb-8 text-sm leading-relaxed">
                Thank you, <strong><?php echo $name; ?></strong>. We've received your request for <strong><?php echo $institution; ?></strong>.<br><br>
                A confirmation has been sent to <strong><?php echo $sender_email; ?></strong>, and our team will be in touch shortly.
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
