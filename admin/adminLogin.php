<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin login</title>

<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- main.css -->
<link href="css/main.css" rel="stylesheet">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<!-- Nav bar begin!-->
<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
  <div class="container"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> 
        <span class="sr-only">Toggle navigation</span> 
        <span class="icon-bar"></span> 
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> </button>
        <a class="navbar-brand" href="#">Brand</a> </div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Find homestay <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Find guest</a></li>
        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-right" role="search">
        
        <button type="submit" class="btn btn-default btn btn-primary">List your space</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Register<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">As host family</a></li>
            <li><a href="#">As guest</a></li>
            <li><a href="#">As instituition</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
<!--Nav bar end-->


  <div class="login_cont">
    <ul class="login">
    <li>
      <div class="loginBox">
        <div class="login_cont">
          <ul class="login">
            <li class="l_tit">Email/Username</li>
            <li class="mb_10">
              <input type="text" class="login_input user_icon">
            </li>
            <li class="l_tit">Password</li>
            <li class="mb_10">
              <input type="text" class="login_input pwd_icon">
            </li>
            <li class="autoLogin">
              <input type="checkbox" id="a1" class="checked">
              <label for="a1"> Auto login</label>
            </li>
            <li>
              <input type="button" value="" class="login_btn">
            </li>
          </ul>
          <div class="login_partners">
            <p class="l_tit">login as other accounts</p>
            <ul class="login_list clearfix">
              <li><a href="#">facebook</a></li>
              <li><span>|</span></li>
              <li><a href="#">Twitter</a></li>
              <li><span>|</span></li>
              <li><a href="#">Google</a></li>
              <li><span>|</span></li>
            </ul>
          </div>
        </div>
        <a class="reg_link" href=""></a> </div>
    </li>
    </ul>
  </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.min.js"></script>
</body>
</html>
