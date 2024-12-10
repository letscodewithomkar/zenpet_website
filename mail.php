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

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                          
        $mail->Host       = getenv('SMTP_HOST');                  // SMTP host from environment variable
        $mail->SMTPAuth   = true;                                
        $mail->Username   = getenv('SMTP_USER');                  // SMTP username from environment variable
        $mail->Password   = getenv('SMTP_PASS');                  // SMTP password from environment variable
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;       
        $mail->Port       = getenv('SMTP_PORT');                  // SMTP port from environment variable

        // Recipients
        $mail->setFrom(getenv('SMTP_FROM_EMAIL'), 'Contact Form'); // Sender email from environment variable
        $mail->addAddress(getenv('SMTP_TO_EMAIL'));               // Recipient email from environment variable

        // Content
        $mail->isHTML(true);                                      
        $mail->Subject = 'New Contact Form Submission';

        // Body content with user input
        $mail->Body = "<h3>Contact Form Submission</h3>
                       <p><strong>Name:</strong> $name</p>
                       <p><strong>Email:</strong> $email</p>
                       <p><strong>Message:</strong><br> $message</p>";

        $mail->send();
        echo 'Message has been sent';
        ?>
        <meta http-equiv='refresh' content='0; url= ./contact.php'/>
        <?php
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
