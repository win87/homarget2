<?php

require_once 'include.php';
require 'phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$id=$_REQUEST['house_id'];
$arr=$_POST;
$arrival=$arr['arrival'];
$depart=$arr['depart'];

$time=date("Y-m-d");
$guest_id = $_SESSION['user_id'];

@$sql_guest = "SELECT *
                FROM tg_guest_info as i
                JOIN tg_guest_request as r ON r.guest_id = i.guest_id
                JOIN tg_user_login l ON l.user_id = i.guest_id
                where i.guest_id={$_SESSION['user_id']}";
$row_guest=fetchOne($sql_guest);

@$sql_host = "SELECT first_name,email
                FROM tg_host_info as i
                JOIN tg_user_login l ON l.user_id = i.host_id
                where i.host_id = {$id}";
$row_host=fetchOne($sql_host);

//Guest booking logic
$sql_book = "SELECT * from tg_booking where host_id={$id} and guest_id={$guest_id}";
$row_num=getResultNum($sql_book);
$row=fetchOne($sql_book);
$status=$row['status'];

    if($row_num==0){
        $sql="INSERT INTO tg_booking (host_id,guest_id,who_book,book_time) VALUES ('$id','$guest_id','2','$time')";
        mysql_query($sql);
    }else{
        if($status==2){
            $sql="UPDATE tg_booking SET status=0, who_book=2 where guest_id={$_SESSION['user_id']} and host_id={$id}";
            mysql_query($sql);
        }else{
            alertMes('You have booked the host family.', 'guest-reservation-list.php');
        return false;
    }
    }

//mail content
$g_ID=$row_guest['guest_id'];
$g_name=$row_guest['first_name'];
$g_age=$row_guest['age'];
$g_ethnicity=$row_guest['ethnicity'];
$g_fromCountry=$row_guest['from_country'];
$g_street=$row_guest['route'];
$g_city=$row_guest['locality'];
$g_state=$row_guest['administrative_area_level_1'];
$g_country=$row_guest['country'];
$g_dPrice=$row_guest['d_price'];
$g_mPrice=$row_guest['m_price'];
$g_nameDest=$row_guest['name_dest'];

$h_name=$row_host['first_name'];
$h_ID=$id;
$h_email=$row_host['email'];

$sub = 'Booking reservation received -- HomestayGuest.com  ';

$msg="
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
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
                <p style='height:30px;line-height:30px;font-size:16px;'><b>Dear $h_name,<br/> you've received a service reservation from the following guest: </b></p>
                <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                <tr>
                <td width='400' valign='top'>
                <table border='0' cellpadding='0' cellspacing='0' width='100%'>

            <tr>
                <td style='padding: 20px 0 10px 20px;height:20px;line-height:20px;font-size:14px;'>
                <b>Name:</b>  $g_name <br />
                <b>Age:</b>  $g_age <br />
                <b>Gender:</b>  $g_fromCountry <br />
                <b>Ethnicity:</b>  $g_ethnicity <br />
                <b>Daily($):</b>  $g_dPrice <br />
                <b>Monthly($):</b>  $g_mPrice <br />
                <b>Name of school/company:</b>  $g_nameDest <br />
                <b>Destination:</b>  $g_street $g_city $g_state $g_country <br />
                <p>
                For detailed information of the guest, and to complete the booking process, please follow the steps below:
                </p>
                <ol>
                <b>
                <li>Go to <a href='www.homestayguest.com'>www.homestayguest.com</a></li>
                <li>Login to your account</li>
                <li>Click the <b>'Your Reservation'</b> tab under the dropdown menu</li>
                <li>'Accept' or 'Reject' the booking </li>
                </b>
                </ol>
                <p>Should you have any questions, please <a href='http://www.homestayguest.com/contact.php'>contact us</a></p>
                <p>
                <a style='float:center;border:1px solid #ee4c50;background:#ee4c50;padding:7px 10px;text-decoration:none;color:white;' href='www.homestayguest.com'>Login</a>
                </p>
                <p>
                    Please note that It will be your responsibility to contact the guest and negotiate a contract.  The website solely serves as a free platform to connect you to the guest, and it shall not be used as an contract agreement.
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
            Reservation-ID(HG): $h_ID-$g_ID
            <p><a href='www.homestayguest.com' style='text-decoration:none;color:white;'> HomestayGuest.com</a></p>
            </td>
        </tr>
    </table>
</body>
</html>
";


$email_from='admin@homestayguest.com';
$name='HomestayGuest';

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
$mail->addAddress($h_email, $h_name);     // Add a recipient
$mail->addBCC('devwei816@gmail.com');
$mail->addBCC('guest_booking@homestayguest.com');
$mail->addBCC('booking_backup@homestayguest.com');


//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $sub;
$mail->Body    = $msg;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    header('location: guest-book-mail-confirm.php');
}

?>