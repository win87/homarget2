
<?php

    require_once 'include.php';
    require_once 'header.php';
    checkProfileSession();

?>


    <!-- Page Content -->
    <div class="container" style="margin-top:50px;">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <small>Your reservation has been sent</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.html">Home</a>
                    </li>
                    <li class="active">Booking request</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">
            <div class="col-lg-12">
                <h4>
                    Thank you for using our service, the host family will respond to your request as soon as possible.
                </h4>
            </div>

           <div class="col-md-12" style="margin:30px 0;">
                <div class="col-md-3">
                </div>
                <div class="col-md-3">
                    <a href="guest-search-result.php" class="btn btn-lg btn-success btn-block fr">Homestay Finder</a>
                </div>
                <div class="col-md-3">
                    <a href="guest-reservation-list.php" class="btn btn-lg btn-danger btn-block fr">Your Reservations</a>
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