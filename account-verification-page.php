
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
                <h1 class="page-header"> Congratulation
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a>
                    </li>
                    <li class="active">Email verification</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row" style="height:400px;">
            <div class="col-lg-12">
                <h4><p>
                  Your account has been activated. Thank you.
                </p></h4>
            </div>
            <div class="text-right">
                <p><b><a href="index.php">homestayguest.com</a></b></p>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- Page Content end -->

<?php
    require_once 'footer.php';
?>