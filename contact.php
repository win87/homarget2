
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
                    <small>Contact us</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a>
                    </li>
                    <li class="active">Contact us</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->


        <!-- Contact Form -->
        <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
        <section id="contact-page">
            <div class="container">
                <div class="center">
                    <h2>Drop Your Message</h2>
                    <p class="lead">Tell us what you concern</p>
                </div>
                <div class="row contact-wrap">
                    <div class="status alert alert-success" style="display: none"></div>
                    <form name="sentMessage" id="contactForm" action="phpmailer.php" method="post">
                        <div class="col-sm-5 col-sm-offset-1">
                            <div class="form-group">
                                <label>Name *</label>
                                <input type="text" class="form-control" name="c-name" id="c-name" required data-validation-required-message="Please enter your name.">
                            </div>
                            <div class="form-group">
                                <label>Email *</label>
                                <input type="email" class="form-control" name="c-email" id="c-email" required data-validation-required-message="Please enter your email address.">
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="tel" class="form-control" name="c-phone" id="c-phone" data-validation-required-message="Please enter your phone number.">
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label>Subject *</label>
                                <input type="text" class="form-control" name="c-sub" id="c-sub">
                            </div>
                            <div class="form-group">
                                <label>Message *</label>
                                <textarea rows="10" cols="100" class="form-control" name="c-msg" id="c-msg" required data-validation-required-message="Please enter your message" maxlength="999" style="resize:none"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" id="contact-btn" class="btn btn-primary btn-lg" value="submit">Submit Message</button>
                                <div id="loading" style="display:none;"><h2><img src="img/spinner.gif"> Send...</h2></div>
                            </div>
                        </div>
                    </form>
                    <script>
                    (function (d) {
                          d.getElementById('contactForm').onsubmit = function () {
                            d.getElementById('contact-btn').style.display = 'none';
                            d.getElementById('loading').style.display = 'block';
                          };
                    }(document));
                    </script>


                </div><!--/.row-->
            </div><!--/.container-->
        </section><!--/#contact-page-->
</div>

<?php
    require_once 'footer.php';
?>

