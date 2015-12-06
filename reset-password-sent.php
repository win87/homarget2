

<?php

    require_once 'include.php';
    require_once 'header.php';

    require 'phpmailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;
    $email_to=$_POST['email'];
    $name='homestayguest.com';

    $email_from='no_reply@homestayguest.com';
    $sql="select first_name from tg_user_login where email='$email_to'";
    $row=fetchOne($sql);

    $sub='Reset password';
    $msg='
        Dear User '.$row['first_name'].': <br />
        Please click the below link to reset your password: <br /><br />
        <a href="https://homestayguest.com/reset-password.php?email='.$email_to.'">Change Password</a>

            ';

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
                    <small>Reset password</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.html">Home</a>
                    </li>
                    <li class="active">Reset password</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row" style="height:400px;">
            <div class="col-lg-12">
                <h4>
                    A reset-password link for the account has been sent to your email, please check your email to finish the process.
                </h4>
            </div>
            <div class="text-right">
                <a href="index.php"><h4>homestayguest.com</h4></a>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- Page Content end -->

<?php
    require_once 'footer.php';
?>