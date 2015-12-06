<?php

    require_once 'include.php';
    require_once 'header.php';

?>

 <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <small>forget password</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a>
                    </li>
                    <li class="active">forget password</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">
            <!-- Contact Details Column -->
            <div class="col-md-4">

            </div>
        </div>
        <!-- /.row -->

        <div class="row" style="height:365px;">
            <div class="col-md-8">

                <form action="reset-password-sent.php" method="post">

                    <div class="control-group form-group">

                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <h4><label>Email Address:</label></h4>
                            <small>Enter your sign up email address, we will send you a link to reset your password.</small>
                            <input type="email" class="form-control list-space-input" name="email" id="email" required placeholder="Enter your email address">
                        </div>
                    </div>

                    <!-- For success/fail messages -->
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">submit</button>
                </form>
            </div>

        </div>
        <!-- /.row -->
</div>


<?php
    require_once 'footer.php';
?>