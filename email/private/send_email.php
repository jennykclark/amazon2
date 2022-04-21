<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once(__DIR__.'/../email/Exception.php');
require_once(__DIR__.'/../email/PHPMailer.php');
require_once(__DIR__.'/../email/SMTP.php');


// Load Composer's autoloader
// require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);


try {

  $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
  );


    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    // $mail->Username   = 'YOUR EMAIL HERE';                     // SMTP username
    $mail->Username   = 'magfriiss@gmail.com';                     // SMTP username // needs to match setFrom ****
    $mail->Password   = 'Whar48klMa$';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    // $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    // $mail->Port       = 465;                                    // TCP port to connect to
    // $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('magfriiss@gmail.com', 'Amazon'); // match username *****
    $mail->addAddress($_to_email,);     // Add a recipient
    // $mail->addAddress('magfriiss@gmail.com', 'Rasmus'); // the email address it is sent to ******
    // $mail->addAddress('ellen@example.com');               // Name is optional
    // $mail->addReplyTo('DUMMY_EMAIL_HERE_XXXXXXXXXXXXXXXXXX', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Check Email';
    $mail->Body    = $_message;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
     //echo 'Message has been sent';

     echo json_encode(array(
      "info" => "Message has been sent"
  ));

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}