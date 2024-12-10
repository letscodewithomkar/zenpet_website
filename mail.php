<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                          
        $mail->Host       = 'smtp.elasticemail.com';                
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'omkarjambhale2450@gmail.com';     
        $mail->Password   = 'D96F8539D8BFFDAFE33676D5AD1683ED8755';      
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
        $mail->Port       = 2525;                                   

        //Recipients
        $mail->setFrom('omkarjambhale2450@gmail.com', 'Contact Form');
        $mail->addAddress('omkarjambhale2450@gmail.com');           // Send to registered email

        // Content
        $mail->isHTML(true);                                      
        $mail->Subject = 'New Contact Form Submission';

        // Body content with user input
        $mail->Body    = "<h3>Contact Form Submission</h3>
                          <p><strong>Name:</strong> $name</p>
                          <p><strong>Email:</strong> $email</p>
                          <p><strong>Message:</strong><br> $message</p>";

        $mail->send();
        echo 'Message has been sent';
        ?>
        <meta http-equiv ='refresh' content ='0; url= ./contact.php'/>
        <?php
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
