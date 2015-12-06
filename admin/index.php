<?php
require_once '../include.php';
checkLogined();
?>
<!doctype html>
<html>
<head>

<title>HomestayGuest Management System</title>
<link rel="stylesheet" href="styles/backstage.css">
</head>

<body>
    <div class="head">
        <div class="logo fl"><a href="#"></a></div>
        <h3 class="head_text fr">HomestayGuest Management System</h3>
    </div>
    <div class="operation_user clearfix">
       <!--   <div class="link fl"><a href="#">HomestayGuest</a><span>&gt;&gt;</span><a href="#">House management</a><span>&gt;&gt;</span>House modify</div>-->
        <div class="link fr">
            Welcome
            <b><?php
				if(isset($_SESSION['email'])){
					echo $_SESSION['email'];
				}
 				elseif(isset($_COOKIE['email'])){
 					echo $_COOKIE['email'];
 				}
            ?>

            </b>&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php" class="icon icon_i">Home</a><span></span><a href="doAdminAction.php?act=logout" class="icon icon_e">Logout</a>
        </div>
    </div>
    <div class="content clearfix">
        <div class="main">
            <!---->
            <div class="cont">
                <div class="title">House management system</div>
      	 		<!-- -->
                <iframe src="main.php"  frameborder="0" name="mainFrame" width="100%" height="722"></iframe>
                <!--  -->
            </div>
        </div>

        <div class="menu">
            <div class="cont">
                <div class="title">Administrator
                </div>
                <ul class="mList">

                    <li>
                        <h3><span onclick="show('menu1','change1')" id="change1">+</span>Host Infomation</h3>
                        <dl id="menu1" style="display:none;">
                        	<dd><a href="addUser.php" target="mainFrame">Add User</a></dd>
                            <dd><a href="listUser.php" target="mainFrame">List_login_info.</a></dd>
                            <dd><a href="listInfo.php" target="mainFrame">List_host_info.</a></dd>
                        </dl>
                    </li>

                    <li>
                        <h3><span onclick="show('menu2','change2')" id="change2">+</span>Host House Info</h3>
                        <dl id="menu2" style="display:none;">
                        	<dd><a href="addHouse.php" target="mainFrame">Add new house</a></dd>
                            <dd><a href="listHouse.php" target="mainFrame">List | Edit detail</a></dd>
                        </dl>
                    </li>

                    <li>
                        <h3><span onclick="show('menu3','change3')" id="change3">+</span>House Calendar</h3>
                        <dl id="menu3" style="display:none;">
                        	<dd><a href="#" target="mainFrame">Add new house</a></dd>
                            <dd><a href="listCalendar.php" target="mainFrame">List | Edit calendar</a></dd>
                        </dl>
                    </li>

                    <li>
                        <h3><span onclick="show('menu4','change4')" id="change4">+</span>House Location</h3>
                        <dl id="menu4" style="display:none;">
                        	<dd><a href="#" target="mainFrame">Add new house</a></dd>
                            <dd><a href="listLocation.php" target="mainFrame">List | Edit location</a></dd>
                        </dl>
                    </li>

                    <li>
                        <h3><span onclick="show('menu5','change5')" id="change5">+</span>House Services</h3>
                        <dl id="menu5" style="display:none;">
                        	<dd><a href="#" target="mainFrame">Add new house</a></dd>
                            <dd><a href="listServices.php" target="mainFrame">List | Edit services</a></dd>
                        </dl>
                    </li>

                    <!--
                    <li>
                        <h3><span onclick="show('menu6','change6')" id="change6">+</span>House cate</h3>
                        <dl id="menu6" style="display:none;">
                        	<dd><a href="addCate.php" target="mainFrame">Add user type</a></dd>
                            <dd><a href="listCate.php" target="mainFrame">cate lists</a></dd>
                        </dl>
                    </li>



                    <li>
                        <h3><span  onclick="show('menu7','change7')" id="change7" >+</span>Order</h3>
                        <dl id="menu7" style="display:none;">
                            <dd><a href="#">Order confirm</a></dd>
                            <dd><a href="#">Order modify</a></dd>
                            <dd><a href="#">Order cancel</a></dd>
                            <dd><a href="#">placeholder</a></dd>
                        </dl>
                    </li>


                    <li>
                        <h3><span onclick="show('menu8','change8')" id="change8">+</span>tg_admin</h3>
                        <dl id="menu8" style="display:none;">
                        	<dd><a href="addAdmin.php" target="mainFrame">Add admin</a></dd>
                            <dd><a href="listAdmin.php" target="mainFrame">List | Edit admins</a></dd>
                        </dl>
                    </li>
                    <li>
                        <h3><span onclick="show('menu9','change9')" id="change9">+</span>photos management</h3>
                        <dl id="menu9" style="display:none;">
                            <dd><a href="listHouseImages.php" target="mainFrame">photo lists</a></dd>
                        </dl>
                    </li>

                    <li>
                        <h3><span onclick="show('menu10','change10')" id="change10">+</span>Login infomation</h3>
                        <dl id="menu10" style="display:none;">
                            <dd><a href="listHouseImages.php" target="mainFrame">photo lists</a></dd>
                        </dl>
                    </li>
                     -->

                    <li>
                        <h3><span onclick="show('menu11','change11')" id="change11">+</span>Guest Infomation</h3>
                        <dl id="menu11" style="display:none;">
                            <dd><a href="addGuest.php" target="mainFrame">Add Guest</a></dd>
                            <dd><a href="listGuest.php" target="mainFrame">Guests List</a></dd>
                        </dl>
                    </li>
                </ul>
            </div>
        </div>

    </div>
    <script type="text/javascript">
    	function show(num,change){
	    		var menu=document.getElementById(num);
	    		var change=document.getElementById(change);
	    		if(change.innerHTML=="+"){
	    				change.innerHTML="-";
	        	}else{
						change.innerHTML="+";
	            }
    		   if(menu.style.display=='none'){
    	             menu.style.display='';
    		    }else{
    		         menu.style.display='none';
    		    }
        }
    </script>
</body>
</html>