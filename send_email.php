<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    if (!filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.";
        exit;
    }
    
    $to = "kuruier05@gmail.com";
    $subject = "Landing page customer";
    $body = "Customer email: " . $customer_email;
    $headers = "From: kuruier05@gmail.com\r\n";
    $headers .= "Reply-To: " . $customer_email . "\r\n";
    
    if (mail($to, $subject, $body, $headers)) {
        echo "Thank you! Your email has been sent.";
    } else {
        echo "Sorry, there was an error sending your message.";
    }
} else {
    echo "Invalid request.";
}
?>