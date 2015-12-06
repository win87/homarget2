<?php

require_once 'include.php';
require 'phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$guest_id = $_SESSION['user_id'];

@$sql_guest = "SELECT first_name
            FROM tg_guest_info
            where guest_id = {$_SESSION['user_id']}";
$row_guest=fetchOne($sql_guest);

$g_email=$_SESSION['email'];
$g_name=$row_guest['first_name'];


//*******************************************************************************************************
// Mail that send to Host
//*******************************************************************************************************

$sub = 'Booking reservation sent -- HomestayGuest.com ';

$msg="
    <!DOCTYPE html>
    <html>
    <head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    <title>Demystifying Email Design</title>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
    </head>

    <body style='margin: 0; padding: 0;'>

    <table align='center' border='0' cellpadding='0' cellspacing='0' width='600' style='border:1px solid #CCCCCC;'>
    <tr>
    <td align='center' bgcolor='#5cb85c' style='padding: 20px 0 15px 0;color:white;'>
    <h1>HomestayGuest.com</h1>
    </td>
    </tr>

    <tr>
    <td bgcolor='#f2f2f2' style='padding: 40px 30px 40px 30px; border-top:none;'>
    <table border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tr>
    <td>
    <p style='height:30px;line-height:30px;font-size:16px;'><b>Dear $g_name,<br/> you've sent a service reservation to a host family. </b></p>
    <table border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tr>
    <td width='400' valign='top'>
    <table border='0' cellpadding='0' cellspacing='0' width='100%'>

    <tr>
    <td style='padding: 20px 0 10px 20px;height:20px;line-height:20px;font-size:14px;'>
    <p>
    For detailed information of the reservation, please follow the steps below:
    </p>
    <ol>
    <b>
    <li>Go to <a href='www.homestayguest.com'>homestayguest.com</a></li>
    <li>Login to your account</li>
    <li>Click the <b>'Your Reservation'</b> tab under the dropdown menu</li>
    <li>Check status of the reservation </li>
    <li>If the host family accepts your service reservation, click the 'Contact information' button to obtain the host family's contact </li>
    </b>
    </ol>
    <p>Should you have any questions, please <a href='http://www.homestayguest.com/contact.php'>contact us</a></p>
    <p>
    <a style='float:center;border:1px solid #ee4c50;background:#ee4c50;padding:7px 10px;text-decoration:none;color:white;' href='www.homestayguest.com'>Login</a>
    </p>
    <p>
    Please note that It will be your responsibility to contact the host and negotiate a contract.  The website solely serves as a free platform to connect you to the host, and it shall not be used as an contract agreement.
    </p>
    </td>
    </tr>
    </table>
    </td>
    </tr>
    </table>
    </td>
    </tr>
    </table>
    </td>
    </tr>

    <tr>
    <td align='center' bgcolor='#ee4c50' style='padding: 30px 30px 20px 30px;color:#ffffff;font-family:Arial,sans-serif;font-size:14;'>
    Reservation-ID(HG): $guest_id
    <p><a href='www.homestayguest.com' style='text-decoration:none;color:white;'> HomestayGuest.com</a></p>
    </td>
    </tr>
    </table>
    </body>
    </html>
    ";

$email_from='admin@homestayguest.com';
$name='HomestayGuest';

//$mailGuest->SMTPDebug = 1;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.ipage.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'test@homestayguest.com';                 // SMTP username
$mail->Password = "Showme1983";                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->From = $email_from;
$mail->FromName = $name;
$mail->addAddress($g_email, $g_name);          // Add a recipient
$mail->addBCC('zengwei816@gmail.com');
//$mailHost->addBCC('host_booking@homestayguest.com');
//$mailHost->addBCC('booking_backup@homestayguest.com');

$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = $sub;
$mail->Body    = $msg;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    header('location: guest-book-mail-sent.php');
}

?>