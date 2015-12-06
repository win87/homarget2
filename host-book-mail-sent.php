

<?php

    require_once 'include.php';
    require_once 'header.php';
    checkProfileSession();

//     @$sql="select user_type from tg_user_login where user_id={'$_SESSION['user_id']'}";
//     @$row=fetchOne($sql);
//     @$type=$row['user_type'];

?>


    <!-- Page Content -->
    <div class="container" style="margin-top:50px;">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <small>Your request has been sent</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.html">Home</a>
                    </li>
                    <li class="active">Request</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">
            <div class="col-lg-12">
                <h4>
                    Thank you for using our service, the guest will respond to your request as soon as possbile.
                </h4>
            </div>

            <div class="col-md-12" style="margin:30px 0;">
                <div class="col-md-3">
                </div>
                <div class="col-md-3">
                    <a href="host-search-result.php" class="btn btn-lg btn-success btn-block fr">Guest Finder</a>
                </div>
                <div class="col-md-3">
                    <a href="host-reservation-list.php" class="btn btn-lg btn-danger btn-block fr">Your Reservations</a>
                </div>
                <div class="col-md-3">
                </div>
            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- Page Content end -->

<?php
    require_once 'footer.php';
?>