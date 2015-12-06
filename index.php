<?php
    require_once 'include.php';
    require_once 'header.php'
?>


    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade in active" id="host-tab" >

            <section id="main-slider" class="no-margin">
                <div class="carousel slide">
                    <div class="carousel-inner">
                        <div class="item active" style="background-image: url(images/bg-img/host-hero-1.png)">
                            <div class="container">
                                <div class="row slide-margin">
                                    <div class="col-sm-6 col-md-offset-1 col-sm-offset-5 col-xs-offset-1">
                                        <div class="carousel-content" style="margin:-10px 0 0 0;">
                                            <h1 class="animation animated-item-1">A Place Where Host Families and Guests Meet</h1>
                                            <h2 class="animation animated-item-2">A New Way Home Abroad</h2>
                                            <a class="btn btn-success animation animated-item-3" data-toggle="tab" href="#host-tab" style="background-color:rgb(92,184,92);width:108px; margin-top:20px;">I am a Host</a>
        									<a class="btn btn-danger animation animated-item-3" data-toggle="tab" href="#guest-tab" style="margin-top:20px;">I am a Guest</a>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 hidden-xs animation animated-item-4">
                                        <div class="slider-img">
                                            <!-- image pop up -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--/.item-->
                    </div><!--/.carousel-inner-->
                </div><!--/.carousel-->
            </section><!--/#main-slider-->

            <!-- Host tab begin -->
            <section id="content">
                <div class="container">
        			<div class="center wow fadeInDown" style="padding-top:50px;">
                        <h2>Host Family - How it works</h2>
                        <p class="lead">4 Steps to Find the Right Guests - Right Away</p>
                    </div>

        			<div class="row" style="margin-bottom:30px;">
                        <div class="col-xs-12 col-sm-8 col-md-offset-2 col-sm-offset-2 wow fadeInDown">
                           <div class="tab-wrap">
                                <div class="media">
                                    <div class="parrent pull-left">
                                        <ul class="nav nav-tabs nav-stacked">
                                            <li class="active"><a href="#host-step-1" data-toggle="tab" class="analistic-01">1.	Registration</a></li>
                                            <li><a href="#host-step-2" data-toggle="tab" class="analistic-02">2.	Search and Match</a></li>
                                            <li><a href="#host-step-3" data-toggle="tab" class="tehnical">3. Contact Guest</a></li>
                                            <li><a href="#host-step-4" data-toggle="tab" class="tehnical">4. Confirm booking</a></li>
                                        </ul>
                                    </div>

                                    <div class="parrent media-body">
                                        <div class="tab-content">
                                            <div class="tab-pane fade active in" id="host-step-1">
                                                <div class="media">
                                                    <div class="media-body">
                                                         <h2>List your space</h2>
                                                         <p>Please tell us details about what you can offer as a host, including but not limited to meal and transportation options. Tell us about yourself, share on your profile page your interest and family background to better the chance to find the right guest. We highly encourage you to upload your profile picture and family photos. Our guests would like to know who you are before making the contact.</p>
                                                    </div>
                                                </div>
                                            </div>

                                             <div class="tab-pane fade" id="host-step-2">
                                                <div class="media">
                                                    <div class="media-body">
                                                         <h2>Match you to the right guest</h2>
                                                         <p>Our one click search engine enables you to find guests within the vicinity of your home. The more detailed information you provide, the better the match! You will be able to view the profile page of the guests and pick the right one instantly.
                                                         </p>
                                                    </div>
                                                </div>
                                             </div>

                                             <div class="tab-pane fade" id="host-step-3">
                                                <div class="media">
                                                    <div class="media-body">
                                                         <h2>Reach out to the potential guest</h2>
                                                         <p>Once the "Contact Guest" request is made, the guest will receive instant notification to view your profile. The guest can either accept or reject your request based on the info you provide on the website. If they accept your offer, a link containing the guest's direct contact info will be sent to you via email. It will be your job to contact the guest via telephone or email to secure the booking! The guest's direct contact will not be released if they reject your offer.</p>
                                                    </div>
                                                </div>
                                            </div>

        									<div class="tab-pane fade" id="host-step-4">
                                                <div class="media">
                                                    <div class="media-body">
                                                         <h2>Verify space availability once booking is confirmed</h2>
                                                         <p>If your space is no longer available after a booking is confirmed, you may choose to disable your listing to avoid receiving more booking requests from other guests by clicking the confirm booking button. You may also go back to your profile page and change the first available date to a future date that your tenant will be moving out. If you have more than one room to offer, no action is required until they are fully booked. Once booking is confirmed by the guest, further instructions and useful contract templates will be sent to both parties via email.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!--/.tab-content-->
                                    </div> <!--/.media-body-->
                                </div> <!--/.media-->
                            </div><!--/.tab-wrap-->

                            <a href="host-how-it-works.php" class="btn btn-default col-md-offset-6 col-sm-offset-6 col-xs-offset-4">Learn more</a>

                        </div><!--/.col-sm-6-->

                    </div><!--/.row-->
                </div><!--/.container-->
            </section><!--/#content-->
        </div><!-- Host tab end -->

        <!-- Guest tab begin -->
        <div class="tab-pane fade in" id="guest-tab" >

            <section id="main-slider" class="no-margin">
                <div class="carousel slide">

                    <div class="carousel-inner">

                        <div class="item active" style="background-image: url(images/bg-img/guest-hero-1.png)">
                            <div class="container">
                                <div class="row slide-margin">
                                    <div class="col-sm-6 col-md-offset-6 col-sm-offset-5 col-xs-offset-1">
                                        <div class="carousel-content">
                                            <h1 class="animation animated-item-1">A Place Where Host Families and Guests Meet</h1>
                                            <h2 class="animation animated-item-2">A New Way Home Abroad</h2>
                                            <a class="btn btn-success animation animated-item-3" data-toggle="tab" href="#host-tab" style="background-color:rgb(92,184,92); width:108px; margin-top:20px;">I am a Host</a>
        									<a class="btn btn-danger animation animated-item-3" data-toggle="tab" href="#guest-tab" style="margin-top:20px;">I am a Guest</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--/.item-->

                    </div><!--/.carousel-inner-->
                </div><!--/.carousel-->
            </section><!--/#main-slider-->

            <section id="content">
                <div class="container">

        			<div class="center wow fadeInDown" style="padding-top:50px;">
                        <h2>Guest - How it works</h2>
                        <p class="lead">4 Steps to Find the Right Host Familty - Right Away</p>
                    </div>

        			<div class="row" style="margin-bottom:30px;">
                        <div class="col-xs-12 col-sm-8 col-md-offset-2 col-sm-offset-2 wow fadeInDown">
                           <div class="tab-wrap">
                                <div class="media">
                                    <div class="parrent pull-left">
                                        <ul class="nav nav-tabs nav-stacked">
                                            <li class="active"><a href="#guest-step-1" data-toggle="tab" class="analistic-01">1.	Registration</a></li>
                                            <li><a href="#guest-step-2" data-toggle="tab" class="analistic-02">2.	Search and Match</a></li>
                                            <li><a href="#guest-step-3" data-toggle="tab" class="tehnical">3. Contact Guest</a></li>
                                            <li><a href="#guest-step-4" data-toggle="tab" class="tehnical">4. Confirm booking</a></li>
                                        </ul>
                                    </div>

                                    <div class="parrent media-body">
                                        <div class="tab-content">
                                            <div class="tab-pane fade active in" id="guest-step-1">
                                                <div class="media">
                                                    <div class="media-body">
                                                         <h2>List your Request</h2>
                                                         <p>Please tell us details about what you expect from the host family, including but not limited to meal options and transportation needs. Tell us about yourself, share on your profile page your interest and background to better the chance to find the right host. We highly encourage you to upload your profile picture. Our hosts would like to know who you are before making the contact.</p>
                                                    </div>
                                                </div>
                                            </div>

                                             <div class="tab-pane fade" id="guest-step-2">
                                                <div class="media">
                                                    <div class="media-body">
                                                         <h2>Match you to the right host</h2>
                                                         <p>Our one click search engine enables you to find host families within the vicinity of your destination. The more detailed information you provide, the better the match! You will be able to view the profile page of the hosts and pick the right one instantly.
                                                         </p>
                                                    </div>
                                                </div>
                                             </div>

                                             <div class="tab-pane fade" id="guest-step-3">
                                                <div class="media">
                                                    <div class="media-body">
                                                         <h2>Reach out to the host family</h2>
                                                         <p>Once the "Contact Guest" request is submitted, the host family will receive instant notification to view your profile. The host can either accept or reject your request based on the info you provide on the website. If they accept your offer, a link containing the host's direct contact info will be sent to you via email. It will be your job to contact the host via telephone or email to secure the booking! The host's direct contact will not be released if they reject your booking request.</p>
                                                    </div>
                                                </div>
                                            </div>

        									<div class="tab-pane fade" id="guest-step-4">
                                                <div class="media">
                                                    <div class="media-body">
                                                         <h2>Final step to complete the process</h2>
                                                         <p>If you have found yourself the right host family, you may choose to disable your listing to avoid receiving more offer service request from other hosts by clicking the confirm booking button. Once booking is confirmed, further instructions and useful contract templates will be sent to both parties via email.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!--/.tab-content-->
                                    </div> <!--/.media-body-->
                                </div> <!--/.media-->
                            </div><!--/.tab-wrap-->
                            <div class="row">
                                <a href="guest-how-it-works.php" class="btn btn-default col-md-offset-6 col-sm-offset-6 col-xs-offset-4">Learn more</a>
                            </div>
                        </div><!--/.col-sm-6-->

                    </div><!--/.row-->
                </div><!--/.container-->
            </section><!--/#content-->
        </div>
    </div><!-- Guest tab end -->

    <section id="feature" >
        <div class="container">
           <div class="center wow fadeInDown">
                <h2>Why HomestayGuest</h2>
                <p class="lead"></p>
            </div>

            <div class="row">
                <div class="features">

                    <div class="col-md-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa fa-heart"></i>
                            <h2>Professional</h2>
                            <h3>Our team will assist you in every way to provide you the best hosting experience.</h3>
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa fa-lock"></i>
                            <h2>Security & Privacy</h2>
                            <h3>Your private information will not be released without your consent.</h3>
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa fa-bolt"></i>
                            <h2>Fast & Easy</h2>
                            <h3>You are only one click away from being connected with your host/guest</h3>
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="row col-md-offset-5 col-sm-offset-9 col-xs-offset-3">
                        <?php if(empty($_SESSION['user_id'])){ ?>
    				        <a href="#" data-toggle="modal" class="btn btn-danger col-xs-12" data-target=".myModal-login" style="width:125px; margin:2px 5px 0 0;">Find Homestay</a>
    				    <?php } else { ?>
    				        <a href="guest-search-result.php" class="btn btn-danger col-xs-12" style="width:125px; margin:2px 5px 0 0;">Find Homestay</a>
    				    <?php } ?>

    				    <?php if(empty($_SESSION['user_id'])){ ?>
    				        <a href="#" data-toggle="modal" class="btn btn-success col-xs-12" data-target=".myModal-login" style="width:125px; margin:2px 5px 0 0;">Find Guest</a>
    				    <?php } else { ?>
    				        <a href="host-search-result.php" class="btn btn-success col-xs-12" style="width:125px; margin:2px 5px 0 0;">Find Guest</a>
    				    <?php } ?>
                    </div>

                </div><!--/.services-->
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#feature-->

    <!-- Project pics begin -->
    <section>
        <div class="center wow fadeInDown">
            <h2>What Our Clients Say</h2>
            <p class="lead">are more than tons of ads...</p>
        </div>

        <div class="container center wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
            <div class="col-md-3 col-sm-6">
                <a class="thumbnail" href="#">
                    <img src="http://placehold.it/800x500" alt="">
                    <div class="caption">
                        <h3>Start Free</h3>
                        <p>Get started and select from HOME.</p>
                    </div>
                </a>
            </div><!--/.col-md-3-->

            <div class="col-md-3 col-sm-6">
                <a class="thumbnail" href="#">
                    <img src="http://placehold.it/800x500" alt="">
                    <div class="caption">
                        <h3>Start Free</h3>
                        <p>Get started and select from HOME.</p>
                    </div>
                </a>
            </div><!--/.col-md-3-->

            <div class="col-md-3 col-sm-6">
                <a class="thumbnail" href="#">
                    <img src="http://placehold.it/800x500" alt="">
                    <div class="caption">
                        <h3>Start Free</h3>
                        <p>Get started and select from HOME.</p>
                    </div>
                </a>
            </div><!--/.col-md-3-->

            <div class="col-md-3 col-sm-6">
                <a class="thumbnail" href="#">
                    <img src="http://placehold.it/800x500" alt="">
                    <div class="caption">
                        <h3>Start Free</h3>
                        <p>Get started and select from HOME.</p>
                    </div>
                </a>
            </div><!--/.col-md-3-->
        </div>
    </section><!-- Project pics end -->


    <!-- Contact us begin -->
    <section id="conatcat-info">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="media contact-info wow fadeInDown col-md-offset-7" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="pull-left">
                            <i class="fa fa-envelope-o"></i>
                        </div>
                        <div class="media-body">
                            <h2>Have a question?</h2>
                            <p><a href="contact.php"><button class="btn btn-block btn-primary"> Contact Us </button></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.container-->
    </section><!-- Contact us end -->

<?php
    require_once 'footer.php';
?>
