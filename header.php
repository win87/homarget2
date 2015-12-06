<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="American Host Family & Guest">

<title>Homestay and Guest | a way to find host families and guests for free </title>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">
<link href="css/animate.min.css" rel="stylesheet">
<link href="css/prettyPhoto.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<link href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet"  />

<link rel="shortcut icon" href="images/default/logo-black-sm.ico">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">

<!-- file upload -->
<link href="css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="js/fileinput.min.js" type="text/javascript"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

<!-- Css of Album display in reviewPage -->

<style>

    .jssora05l, .jssora05r, .jssora05ldn, .jssora05rdn
    {
    	position: absolute;
    	cursor: pointer;
    	display: block;
    	background: url(images/album_slide/a17.png) no-repeat;
    	overflow:hidden;
    }
    .jssora05l { background-position: -10px -40px; }
    .jssora05r { background-position: -70px -40px; }
    .jssora05l:hover { background-position: -130px -40px; }
    .jssora05r:hover { background-position: -190px -40px; }
    .jssora05ldn { background-position: -250px -40px; }
    .jssora05rdn { background-position: -310px -40px; }

    .jssort01 .w {
    	position: absolute;
    	top: 0px;
    	left: 0px;
    	width: 100%;
    	height: 100%;
    }

    .jssort01 .c {
    	position: absolute;
    	top: 0px;
    	left: 0px;
    	width: 68px;
    	height: 68px;
    	border: #000 2px solid;
    }

    .jssort01 .p:hover .c, .jssort01 .pav:hover .c, .jssort01 .pav .c {
    	background: url(images/album_slide/t01.png) center center;
    	border-width: 0px;
    	top: 0px;
    	left: 0px;
    	width: 68px;
    	height: 68px;
    }

    .jssort01 .p:hover .c, .jssort01 .pav:hover .c {
    	top: 0px;
    	left: 0px;
    	width: 70px;
    	height: 70px;
    	border: #fff 1px solid;
    }

</style>

</head>

<body class="homepage">

    <header id="header">

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><img src="images/default/logo-black-sm.png" alt="Homestay logo" style="margin-top:-3px;width:70px;height:50px;"></a>
                </div>

                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
					    <li>
					    <?php if(empty($_SESSION['user_id'])){ ?>
					        <a href="#" data-toggle="modal" data-target=".myModal-login">Find Homestay</a>
					    <?php } else { ?>
					        <a href="guest-search-result.php">Find Homestay</a>
					    <?php } ?>
    					</li>
    					<li>
    					<?php if(empty($_SESSION['user_id'])){ ?>
      						<a href="#" data-toggle="modal" data-target=".myModal-login">Find Guest</a>
      				    <?php } else { ?>
      				        <a href="host-search-result.php">Find Guest</a>
      				    <?php } ?>
    					</li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Help <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="faq.php">FAQ</a></li>
                                <li><a href="contact.php">Contact us</a></li>
                            </ul>
                        </li>
                        <?php if(empty($_SESSION['user_id']) && empty($_SESSION['email']) && empty($_COOKIE['user_id']) && empty($_COOKIE['email'])){ ?>
                            <li><a href="#" data-toggle="modal" data-target=".myModal-login">Login</a></li>
    						<li><a href="#" data-toggle="modal" data-target=".myModal-reg">Sign up</a></li>
    						<li class="hidden-xs">
        					    <a href="#" data-toggle="modal" data-target=".myModal-login"><button class="btn btn-success" style="margin-top: -10px;"><b>List your space</b></button></a>
        					</li>
    				    <?php }else {
    				            $sql = "select user_type from tg_user_login where user_id={$_SESSION['user_id']}";
    				            $row = fetchOne($sql);
    				            $type = $row['user_type'];
    				            if($type==2){
    				        ?>
    				        <li class="dropdown">
            					<a href="#" class="dropdown-toggle" data-toggle="dropdown">

            					<?php $profileImg=getProfileImgById($_SESSION['user_id']);
            					if(!empty($profileImg['picture'])){ ?>
            					<img class="img-responsive fl" id="navbar-img" src="uploads/profile_img/user_id_<?php echo $_SESSION['user_id']."/".$profileImg['picture'];?>" />
            					<?php } else{ ?>
            					<img class="img-responsive fl" id="navbar-img" src="images/default/profile-img.png">
                                <?php } ?>
            					<?php echo $_SESSION['email']; ?> <b class="caret"></b>
            					</a>
            					<ul class="dropdown-menu">
                					<li><a href="review-request.php">View Your Request</a></li>
                					<li><a href="list-request.php">Edit Your Request</a></li>
                					<li><a href="guest-reservation-list.php">Your Reservations</a></li>
                					<li><a href="edit-profile.php">Edit Profile</a></li>
                					<li><a href="doAction.php?act=userOut">Logout</a></li>
            					</ul>
        					</li>
        					<li class="hidden-xs">
        					    <a href="list-request.php"><button class="btn btn-danger" style="margin-top: -10px;"><b>List you request</b></button></a>
        					</li>
        					<li class="visible-xs">
        					    <a href="list-request.php">List your request</a>
        					</li>
        					<?php } else { ?>
        					<li class="dropdown">
            					<a href="#" class="dropdown-toggle" data-toggle="dropdown">

            					<?php $profileImg=getProfileImgById($_SESSION['user_id']);
            					if(!empty($profileImg['picture'])){ ?>
            					<img class="img-responsive fl" id="navbar-img" src="uploads/profile_img/user_id_<?php echo $_SESSION['user_id']."/".$profileImg['picture'];?>" style="margin-right:10px;" />
            					<?php } else{ ?>
            					<img class="img-responsive fl" id="navbar-img" src="images/default/profile-img.png" style="margin-right:10px;">
                                <?php } ?>

            					<?php echo $_SESSION['email']; ?> <b class="caret"></b>
        					    </a>
            					<ul class="dropdown-menu">
            					   <li><a href="review-profile.php">Review Your Listing</a></li>
            					   <li><a href="list-space.php">Edit Your Listing</a></li>
            					   <li><a href="host-reservation-list.php">Your Reservations</a></li>
            					   <li><a href="edit-profile.php">Edit Profile</a></li>
            					   <li><a href="doAction.php?act=userOut">Logout</a></li>
            					</ul>
        					</li>
        					<li class="hidden-xs">
        					   <a href="list-space.php"><button class="btn btn-success" style="margin-top: -10px;"><b>List your space</b></button></a>
        					</li>
        					<li class="visible-xs">
        					    <a href="list-space.php">List your space</a>
        					</li>

        					<?php } ?>
    				    <?php } ?>
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->

    </header><!--/header-->

    <!-- Trigger Whole Sign up modal -->
	<!--Login Modal begin -->
	<div class="modal fade myModal-login" tabindex="-1">
		<div class="modal-dialog" id="modal-dialog-sign-up">
			<div class="modal-content">
				<div class="modal-header" style="background:#f2f2f2;">

					<!-- Top Right corner "X" sign -->
					<button type="button" class="close" data-dismiss="modal">
						<span>&times;</span>
					</button>
					<h4 class="modal-title text-center">Login</h4>
				</div>
				<div class="modal-body">

					<!-- Form action -->
					<form id="sign-up-input-box" method="post" action="doAction.php?act=login">

						<div class="form-group">
							<label for="email" class="control-label"></label>
							<input type="email" class="form-control modal-input" id="loginEmail" name="loginEmail" required placeholder="Email Address" >
							<b><span class="fa fa-envelope-o" style="position:absolute;top:21px;left:275px;"></span></b>
							<p id="lEmailStatus"></p>
						</div>

						<div class="form-group">
							<label for="password" class="control-label"></label>
							<input type="password" class="form-control modal-input" id="password1" name="password1" required placeholder="Password">
							<span class="fa fa-unlock-alt" style="position:absolute;top:69px;left:277px;"></span>
							<p id="pwdErr"></p>
						</div>

						<div class="form-group" id="sign-up-checkbox">
							<div class="checkbox">
							    <input type="hidden" name="auto_flag" value=0>
								<label><input type="checkbox" checked="checked" name="auto_flag" id="auto_flag" value=1> Remember me </label>
								<a href="forget-password.php" class="fr a-text-red">Forget password?</a>
							</div>
						</div>

						<button type="submit" name="submit" id="loginBtn" class="btn btn-danger btn-block">
							<strong>Log in</strong>

						</button>
					</form>
				</div>
				<!-- Modal footer button -->
				<div class="modal-footer" style="background:#f2f2f2;">
					<h5 class="text-center">
						Don't have an account? <a href="#" class="a-text-red" data-dismiss="modal" data-toggle="modal" data-target=".myModal-reg">Sign up</a>
					</h5>
				</div>
			</div>
		</div>
	</div>
	<!-- Login Modal end -->


	<!--Reg Modal begin -->
	<div class="modal fade myModal-reg" tabindex="-1">
		<div class="modal-dialog" id="modal-dialog-sign-up">
			<div class="modal-content">
				<div class="modal-header" style="background:#f2f2f2;">
					<!-- Top Right corner "X" sign -->
					<button type="button" class="close" data-dismiss="modal">
						<span>&times;</span>
					</button>
					<h4 class="modal-title text-center" id="myModalLabel">Registration</h4>
				</div>
				<div class="modal-body">

					<!-- Form action -->

					<form id="sign-up-input-box" method="post" action="doAction.php?act=register">
						<div class="form-group">
							<label for="user_type"></label>
							<select class="form-control" name="user_type" required>
								<option value="">- Select type of User -</option>
								<option value=1> I am a Host </option>
								<option value=2> I am a Guest </option>
							</select>
							<b><span class="fa fa-user-plus" style="position:absolute;top:42px;left:262px;"></span></b>
						</div>

						<div class="form-group">
							<label for="email"></label>
							<input type="email" class="form-control modal-input" name="email" id="email" required placeholder="Email address">
                            <span class="fa fa-envelope-o" style="position:absolute;top:88px;left:262px;"></span>
                            <p id="emailStatus"></p>
						</div>

						<div class="form-group">
							<label for="password1"></label>
							<input type="password" class="form-control modal-input" name="password1" id="pwd1" required placeholder="Password">
							<span class="fa fa-unlock-alt" style="position:absolute;top:134px;left:264px;"></span>
							<p id="pwdErr1"></p>
						</div>

						<div class="form-group">
							<label for="password2"></label>
							<input type="password" class="form-control modal-input" disabled="" name="password2" id="pwd2" required placeholder="Confirm-password">
							<p id="pwdErr2"></p>
						</div>


						<div class="form-group">
							<h6>
								By signing up, I agree to Homestayguest's <a href="terms-of-conditions.php" class="a-text-red">Terms of Service</a>, <a href="privacy-policy.php" class="a-text-red">Privacy Police.</a>
							</h6>
						</div>

						<button type="submit" id="signupBtn" class="btn btn-danger btn-block">
							<strong>Sign up</strong>
						</button>

					</form>
				</div>
				<!-- Modal footer button -->
				<div class="modal-footer" style="background:#f2f2f2;">
					<h5 class="text-center">
						Already a member? <a href="#" class="a-text-red" data-dismiss="modal" data-toggle="modal" data-target=".myModal-login">Login</a>
					</h5>
				</div>
			</div>
		</div>
	</div>
	<!-- Reg Modal end -->
	<!-- Whole Trigger Registration modal end -->

