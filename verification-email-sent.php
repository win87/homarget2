

<?php

    require_once 'include.php';
    require_once 'header.php';
    checkProfileSession();

    require 'phpmailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;
    @$email_to=$_REQUEST['email'];
    $name='HomestayGuest';

    $sql="SELECT verify_code from tg_user_login where email='{$email_to}'";
    $row=fetchOne($sql);

    $verify_code=$row['verify_code'];

    $email_from='no_reply@homestayguest.com';

    $sub='Account Verification';

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
    <p style='height:30px;line-height:30px;font-size:16px;'><b> Valued User, <br/> Your account has been created, you can login with the following Email and Password: </b></p>
    <table border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tr>
    <td width='400' valign='top'>
    <table border='0' cellpadding='0' cellspacing='0' width='100%'>

    <tr>
    <td style='padding: 20px 0 10px 20px;height:20px;line-height:20px;font-size:14px;'>
    <b>Email:</b> $email_to <br />
    <b>Password:</b> **************** <br />
    <p>
    To book and receive reservations, Please verify your email address by clicking the link belows:
    </p>
    <p>
        <a href='http://www.homestayguest.com/email-verification.php?email=$email_to&verify_code=$verify_code'>
            Email Verification Link
        </a>
    </p>
    <p>Should you have any questions, please <a href='http://www.homestayguest.com/contact.php'>contact us</a></p>
    <p>
    <a style='float:center;border:1px solid #ee4c50;background:#ee4c50;padding:7px 10px;text-decoration:none;color:white;' href='www.homestayguest.com'>Login</a>
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
    <p><a href='www.homestayguest.com' style='text-decoration:none;color:white;'> HomestayGuest.com</a></p>
    </td>
    </tr>
    </table>
    </body>
    </html>
    ";
//     $msg='
//         Valued User:
//         <br />
//         <br />
//         Thanks for signing up.
//         <br />
//         <br />
//         Your account has been created, you can login with the follow information:
//         <br />
//         <br />
//         ------------------------------------------
//         <br />
//         Email: '.$_SESSION['email'].'
//         <br />
//         <br />
//         Password: **********
//         <br />
//         ------------------------------------------
//         <br />
//         <br />
//         Please click the below link to verify your email address:
//         <br />
//         <br />
//         <a href="http://www.homestayguest.com/email-verification.php?email='.$email_to.'&verify_code='.$verify_code.'">
//             http://www.homestayguest.com/email-verification.php?email='.$email_to.'&verify_code='.$verify_code.'
//         </a>
//         <br />
//         <br />
//         <a href="http://www.homestayguest.com">
//             homestayguest.com
//         </a>
//             ';

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
    $mail->addAddress($email_to, 'Dear user');     // Add a recipient

    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = $sub;
    $mail->Body    = $msg;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
?>


    <!-- Page Content -->
    <div class="container" style="margin-top:50px;">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <small>The verification email has been sent</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a>
                    </li>
                    <li class="active">Email Verification</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <h4>
                    An activation link for your account has been sent to your email, please check your email to complete the process.
                </h4>
            </div>
            <div class="text-right" style="margin:50px 0;">
                <h4><a href="index.php">HomestayGuest.com</a></h4>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- Page Content end -->

<?php
    require_once 'footer.php';
?>