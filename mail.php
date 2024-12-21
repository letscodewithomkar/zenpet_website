<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address. Please try again.";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = getenv('SMTP_HOST');
        $mail->SMTPAuth = true;
        $mail->Username = getenv('SMTP_USERNAME'); // Replace with your SMTP username
        $mail->Password = getenv('SMTP_PASSWORD'); // Replace with your SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port =getenv('SMTP_PORT');
        // Email Setup
        $mail->setFrom(getenv('SMTP_FROM_EMAIL'), 'ZenPets Website'); // Sender's name (ZenPets Website)
        $mail->addAddress(getenv('SMTP_FROM_EMAIL')); // Recipient email address
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Submission';
        // Body content with user input
        $mail->Body = "<h3>Contact Form Submission</h3>
                       <p><strong>Name:</strong> $name</p>
                       <p><strong>Email:</strong> $email</p>
                       <p><strong>Message:</strong><br> $message</p>";

        $mail->send();
        header('Location: ./contact.php');
        exit; 
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
