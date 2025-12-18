<?php

// ==================================================================================
// 1. CONFIGURATION & PHPMailer Setup
// ==================================================================================

// NOTE: You must include the PHPMailer library files.
// Assuming PHPMailer is installed via Composer or manually placed in a vendor directory.
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Path adjustments may be needed based on where you place the PHPMailer files
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

// --- Gmail SMTP Configuration ---
const SMTP_HOST = 'smtp.gmail.com';
const SMTP_PORT = 587;
const SMTP_USERNAME = 'kuruier05@gmail.com';
const SMTP_PASSWORD = 'mbdntzumqvleyxnt'; // Gmail App Password
const RECIPIENT_EMAIL = 'kuruier05@gmail.com';

// ==================================================================================
// 2. FORM DATA VALIDATION & EXTRACTION
// ==================================================================================

// Only proceed if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo "Method Not Allowed.";
    exit;
}

// Check if this is a newsletter subscription
$is_newsletter = isset($_POST['form_type']) && $_POST['form_type'] === 'newsletter';

// Basic input sanitation and extraction
$email = isset($_POST['email']) ? htmlspecialchars(strip_tags(trim($_POST['email']))) : '';

if ($is_newsletter) {
    // Newsletter subscription - only email required
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Error: A valid Email address is required.";
        exit;
    }
    
    $subject = "New Newsletter Subscription from kuruier.com";
    $body_html = "
    <html>
    <body style='font-family: Arial, sans-serif; line-height: 1.6;'>
        <h2 style='color: #4CAF50;'>New Newsletter Subscription</h2>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Subscribed at:</strong> " . date('Y-m-d H:i:s') . "</p>
        <hr style='border: 0; border-top: 1px solid #eee;'>
        <p style='font-size: 0.9em; color: #666;'>This subscription was submitted from kuruier.com</p>
    </body>
    </html>
    ";
    $reply_name = 'Newsletter Subscriber';
    
} else {
    // Contact form - requires name, email, etc.
    $name = isset($_POST['name']) ? htmlspecialchars(strip_tags(trim($_POST['name']))) : '';
    $phone = isset($_POST['phone']) ? htmlspecialchars(strip_tags(trim($_POST['phone']))) : 'Not provided';
    $comments = isset($_POST['comments']) ? htmlspecialchars(strip_tags(trim($_POST['comments']))) : 'No comments provided';
    $agree_terms = isset($_POST['agree_terms']) ? 'Yes' : 'No';

    // Mandatory field validation
    if (empty($name) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Error: Name and a valid Email address are required fields.";
        exit;
    }

    $subject = "New Contact Message from kuruier.com - By: $name";
    $body_html = "
    <html>
    <body style='font-family: Arial, sans-serif; line-height: 1.6;'>
        <h2 style='color: #4CAF50;'>New Contact Inquiry</h2>
        <p><strong>Sender Name:</strong> {$name}</p>
        <p><strong>Sender Email:</strong> {$email}</p>
        <p><strong>Phone:</strong> {$phone}</p>
        <hr style='border: 0; border-top: 1px solid #eee;'>
        <p><strong>Message:</strong></p>
        <div style='padding: 15px; border-left: 3px solid #007bff; background-color: #f8f9fa;'>
            <p>{$comments}</p>
        </div>
        <hr style='border: 0; border-top: 1px solid #eee;'>
        <p style='font-size: 0.9em; color: #666;'>
            Agreed to receive promotional messages: <strong>{$agree_terms}</strong>
        </p>
    </body>
    </html>
    ";
    $reply_name = $name;
}

// ==================================================================================
// 3. PHPMailer Sending Logic
// ==================================================================================

$mail = new PHPMailer(true); // Passing `true` enables exceptions

try {
    // Server settings
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = SMTP_HOST;                              // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = SMTP_USERNAME;                          // SMTP username
    $mail->Password   = SMTP_PASSWORD;                          // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Gmail uses STARTTLS on port 587
    $mail->Port       = SMTP_PORT;                              // TCP port to connect to (465 for SMTPS)
    $mail->CharSet    = 'UTF-8';                                // Set character set

    // Sender and Reply-To
    // Set 'From' address to the authenticated SMTP user to pass SPF checks on Plesk
    $mail->setFrom(SMTP_USERNAME, 'kuruier.com Contact Form');
    // Set the user's email as the 'Reply-To' for easy response
    $mail->addReplyTo($email, $reply_name);

    // Recipient
    $mail->addAddress(RECIPIENT_EMAIL, 'Kuruier Support');

    // Content
    $mail->isHTML(true);                                        // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $body_html;
    $mail->AltBody = strip_tags(str_replace(['<br>', '<br/>', '<br />'], "\n", $body_html));

    // Attempt to send the email
    $mail->send();

    // Success response: Redirect back with success message and anchor
    if ($is_newsletter) {
        $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
        $base_url = parse_url($referer, PHP_URL_PATH) ?: 'index.php';
        header('Location: ' . $base_url . '?subscribed=1#newsletter-form');
    } else {
        header('Location: contact.php?success=1#contact-form');
    }
    exit;

} catch (Exception $e) {
    // Log the error for debugging purposes (check your server logs)
    error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
    
    // User-friendly response on failure
    http_response_code(500);
    echo "There was an issue sending your message. Please try again or contact us directly. Error: " . $mail->ErrorInfo;
}
?>