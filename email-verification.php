<?php

    require_once 'include.php';
    require_once 'header.php';
    checkProfileSession();

    if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['verify_code']) && !empty($_GET['verify_code'])){
        $email_to=mysql_escape_string($_GET['email']);
        $verify_code=mysql_escape_string($_GET['verify_code']);

        $search=mysql_query("SELECT email,verify_code,active_flag FROM tg_user_login WHERE email='".$email_to."' AND verify_code='".$verify_code."' AND active_flag=0") or die(mysql_error());
        $match=mysql_num_rows($search);
    print_r($match);
        if($match>0){
            mysql_query("UPDATE tg_user_login SET active_flag=1 WHERE email='".$email_to."' AND verify_code='".$verify_code."' AND active_flag=0");
        }else{
            echo '<div><h3>The link is expired, or you have already activated your email.</h3></div>';
            exit;
        }
    }else{
        echo '<div>The link is invalid, or you have already activated your email.</div>';
        echo '<a href="index.php">Home page</a>';
        exit;
    }

?>

    <!-- Page Content -->
    <div class="container" style="margin-top:50px;">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <small>Congratulation</small>
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
        <div class="row" style="height:400px;">
            <div class="col-lg-12">
                <h4><p>
                  Your account has been activated.
                </p></h4>
            </div>
            <div class="text-right">
                <p><a href="index.php"><h4>HomestayGuest.com</h4></a></p>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- Page Content end -->

<?php
    require_once 'footer.php';
?>