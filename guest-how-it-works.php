
<?php

    require_once 'include.php';
    require_once 'header.php';

    @$sql="select user_type from tg_user_login where user_id='{$_SESSION['user_id']}'";
    @$row=fetchOne($sql);
    @$type=$row['user_type'];

?>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">How it works
                    <small>Guest</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a>
                    </li>
                    <li class="active">How it works (guest)</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

    <div class="row">
        <a href="host-how-it-works.php" class="btn btn-success fr">I am a Host</a>
    </div>

        <!-- Content Row -->
        <div class="row how-works-pic">

            <!-- Content Column -->
            <div class="col-md-9">
                <div class="col-md-3">
                    <img class="img-responsive img-portfolio img-hover" src="images/guest-search.png" alt="guest-search-icon">
                </div>

                <div class="col-md-9">
                    <div class="caption">
                        <h4><b>1.	Registration - List your Request</b></h4>
                        <p>
                            Please tell us details about what you expect from the host family, including but not limited to meal options and transportation needs.  Tell us about yourself, share on your profile page your interest and background to better the chance to find the right host. We highly encourage you to upload your profile picture.  Our hosts would like to know who you are before making the contact.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="col-md-3">
                    <img class="img-responsive img-portfolio img-hover" src="images/guest-list.png" alt="guest-list-icon">
                </div>

                <div class="col-md-9">
                    <div class="caption">
                        <h4><b>2.	Search and Match - Match you to the right host</b></h4>
                        <p>
                            Our one click search engine enables you to find host families within the vicinity of your destination.  The more detailed information you provide, the better the match!  You will be able to view the profile page of the hosts and pick the right one instantly.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="col-md-3">
                    <img class="img-responsive img-portfolio img-hover" src="images/guest-match.png" alt="guest-match-icon">
                </div>

                <div class="col-md-9">
                    <div class="caption">
                        <h4><b>3.	 Contact Guest - Reach out to the host family</b></h4>
                        <p>
                            Once the "Contact Guest" request is submitted, the host family will receive instant notification to view your profile.  The host can either accept or reject your request based on the info you provide on the website.  If they accept your offer, a link containing the host's direct contact info will be sent to you via email.  It will be your job to contact the host via telephone or email to secure the booking!  The host's direct contact will not be released if they reject your booking request.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="col-md-3">
                    <img class="img-responsive img-portfolio img-hover" src="images/guest-calendar.png" alt="guest-calendar-icon">
                </div>

                <div class="col-md-9">
                    <div class="caption">
                        <h4><b>4.	Confirm booking - Final step to complete the process</b></h4>
                        <p>
                            If you have found yourself the right host family, you may choose to disable your listing to avoid receiving more offer service request from other hosts by clicking the confirm booking button.  Once booking is confirmed, further instructions and useful contract templates will be sent to both parties via email.
                        </p>
                    </div>
                </div>
            </div>

            </div>

            <div class="col-md-12 marginT-20">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <a href="#" data-toggle="modal" data-target=".myModal-reg" class="btn btn-lg btn-danger btn-block">JOIN NOW !</a>
                </div>
                <div class="col-md-4">
                </div>
            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

<?php
    require_once 'footer.php';
?>