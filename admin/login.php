 <!DOCTYPE html>
<html lang="en">
<head>
<!-- <meta charset="utf-8">  -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin login</title>

<!-- Bootstrap -->
<link href="../css/bootstrap.min.css" rel="stylesheet">
<!-- main.css -->
<link href="../css/main.css" rel="stylesheet">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>


  <div class="login_cont">
    <ul class="login">
    <li>
      <div class="loginBox">
        <div class="login_cont">
          <form action="doLogin.php" method="post">
          <ul class="login">
            <li class="l_tit">Administrator email</li>
            <li class="mb_10">
              <input type="text" class="login_input user_icon" name="email">
            </li>
            <li class="l_tit">Password</li>
            <li class="mb_10">
              <input type="password" class="login_input pwd_icon" name="password">
            </li>
            <li>
              <input type="submit" value="submit" class="login_btn">
            </li>
          </ul>
          </form>

        </div>
        <a class="reg_link" href=""></a> </div>
    </li>
    </ul>
  </div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>
