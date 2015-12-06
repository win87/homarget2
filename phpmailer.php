<?php

require 'phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$arr=$_POST;
$email_from=$arr['c-email'];
$name=$arr['c-name'];
$phone=$arr['c-phone'];
$sub=$arr['c-sub'];
$msg=$arr['c-msg'];

//$mail->SMTPDebug = 1;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.ipage.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'test@homestayguest.com';                 // SMTP username
$mail->Password = "Showme1983";                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->From = $email_from;
$mail->FromName = $name;
$mail->addAddress('admin@homestayguest.com', 'admin');     // Add a recipient

//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('http://www.homestayguest.com/images/map.jpg', 'map.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $sub;
$mail->Body    = $msg;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    header('location: email-sent.php');
}

?>