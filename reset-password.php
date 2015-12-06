<?php

    require_once 'include.php';
    require_once 'header.php';
    @$email=$_REQUEST['email'];

?>

 <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <small>Change password</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a>
                    </li>
                    <li class="active">change password</li>
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

        <div class="row">
            <div class="col-md-8">

                <form action="doAction.php?act=changePwd&email=<?php echo $email ;?>" method="post">

                   <!-- <div class="control-group form-group">

                    </div>


                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Old password:</label>
                            <input type="password" class="form-control list-space-input" name="oldPwd" id="oldPwd" required placeholder="Enter current password">
                            <p id="pwdErr"></p>
                        </div>

                    </div>-->

                    <div class="control-group form-group">
                        <div class="controls">
                            <label>New password:</label>
                            <input type="password" class="form-control list-space-input" name="password1" id="pwd1" required placeholder="Enter new password">
                            <p id="pwdErr1"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Re-type password:</label>
                            <input type="password" class="form-control list-space-input" name="password2" id="pwd2" required placeholder="Re-type new password">
                            <p id="pwdErr2"></p>
                        </div>
                    </div>


                    <!-- For success/fail messages -->
                    <button type="submit" name="submit" value="submit" class="btn btn-primary" style="margin-bottom:20px;">submit</button>
                </form>
            </div>

        </div>
        <!-- /.row -->
</div>


<?php
    require_once 'footer.php';
?>