<?php

require_once 'include.php';
require 'phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$id=$_REQUEST['guest_id'];
$time=date("Y-m-d");
$host_id = $_SESSION['user_id'];

@$sql_guest = "SELECT guest_id,first_name,last_name,email
            FROM tg_guest_info as i
            JOIN tg_user_login l ON l.user_id = i.guest_id
            where i.guest_id={$id}";
$row_guest=fetchOne($sql_guest);

@$sql_host = "SELECT host_id,first_name,age,ethnicity,d_price,m_price,route,locality,administrative_area_level_1,country
            FROM tg_host_info as i
            JOIN tg_house_location l ON i.host_id = l.location_id
            JOIN tg_host_house h ON h.house_id = i.host_id
            where i.host_id = {$_SESSION['user_id']}";
$row_host=fetchOne($sql_host);


//Host booking logic
$sql_book = "SELECT * from tg_booking where guest_id={$id} and host_id={$_SESSION['user_id']}";
$row_num=getResultNum($sql_book);
$row=fetchOne($sql_book);
$status=$row['status'];

    if($row_num==0){
        $sql="INSERT INTO tg_booking (host_id,guest_id,who_book,book_time) VALUES ('$host_id','$id','1','$time')";
        mysql_query($sql);
    }else{
        if($status==2){
            $sql="UPDATE tg_booking SET status=0,who_book=1 where host_id={$_SESSION['user_id']} and guest_id={$id}";
            mysql_query($sql);
        }else{
            alertMes('You have booked the Guest.', 'host-reservation-list.php');
        return false;
    }
    }

$h_email=$_SESSION['email'];
$h_ID=$row_host['host_id'];
$h_name=$row_host['first_name'];
$h_age=$row_host['age'];
$h_ethnicity=$row_host['ethnicity'];
$h_street=$row_host['route'];
$h_city=$row_host['locality'];
$h_state=$row_host['administrative_area_level_1'];
$h_country=$row_host['country'];
$h_dPrice=$row_host['d_price'];
$h_mPrice=$row_host['m_price'];

$g_name=$row_guest['first_name'];
$g_ID=$row_guest['guest_id'];
$g_email=$row_guest['email'];


//*******************************************************************************************************
// Mail that send to Guest
//*******************************************************************************************************
$sub = 'Booking request received -- HomestayGuest.com ';

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
                                 <p style='height:30px;line-height:30px;font-size:16px;'><b>Dear $g_name,<br/> you've received a service offer from the following host family: </b></p>
                                 <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                                 <tr>
                                 <td width='400' valign='top'>
                                 <table border='0' cellpadding='0' cellspacing='0' width='100%'>

                                 <tr>
                                     <td style='padding: 20px 0 10px 20px;height:20px;line-height:20px;font-size:14px;'>
                                         <b>Name:</b>  $h_name <br />
                                         <b>Age:</b>  $h_age <br />
                                         <b>Ethnicity:</b>  $h_ethnicity <br />
                                         <b>Daily($):</b>  $h_dPrice <br />
                                         <b>Monthly($):</b>  $h_mPrice <br />
                                         <b>Location:</b>  $h_street $h_city $h_state $h_country <br />
                                         <p>
                                             For detailed information of the host family, and to complete the booking process, please follow the steps below:
                                         </p>
                                         <ol>
                                             <b>
                                             <li>Go to <a href='homestayguest.com'>www.homestayguest.com</a></li>
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
$mail->addBCC('devwei816@gmail.com');
$mail->addBCC('host_booking@homestayguest.com');
$mail->addBCC('booking_backup@homestayguest.com');


//$mailGuest->addAddress('ellen@example.com');               // Name is optional
//$mailGuest->addReplyTo('info@example.com', 'Information');
//$mailGuest->addBCC('bcc@example.com');

//$mailGuest->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mailGuest->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $sub;
$mail->Body    = $msg;
//$mailGuest->AltBody = 'This is the body in plain text for non-HTML mailGuest clients';



if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    header('location: host-book-mail-confirm.php');
}

?>