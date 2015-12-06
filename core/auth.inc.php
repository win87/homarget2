<?php


/**
 * Login
 */
function login(){

//     if(!isset($_SESSION['email']) || !isset($_COOKIE['email'])){

        if(isset($_POST['submit'])){

            $email=mysql_escape_string(trim($_POST['loginEmail']));
            $password=sha1($_POST['password1']);
            $auto_flag=$_POST['auto_flag'];

            if(!empty($email) && !empty($password)){

                $sql="select user_id,email,password1,user_type,auto_flag from tg_user_login where email='{$email}' and password1='{$password}'";
                $row=fetchOne($sql);
                $_POST['last_login']=date('Y-m-d H:i:s');
                $last_login=$_POST['last_login'];

                if($row){

                     $_SESSION['email']=$row['email'];
                     $_SESSION['user_id']=$row['user_id'];
                     $user_id=$_SESSION['user_id'];
                     $sql="UPDATE tg_user_login SET last_login='{$last_login}' where user_id='{$user_id}'";
                     mysql_query($sql);

                    if($auto_flag){
                        setcookie("user_id",$row['user_id'],time()+30*24*3600);
                        setcookie("email",$row['email'],time()+30*24*3600);
                    }

                    switch ($row['user_type']){
                        case 1:
                            header("location:index.php");
                            break;
                        case 2:
                            header("location:index.php");
                            break;
                    }
                }else{
                    alertMes('Invalid email or password, please try again',"index.php");
                }
            }else{
                alertMes('Please enter Email and Passord', "index.php");
            }
        }else{
            alertMes('Please Login', "index.php");
        }
//     }else{
//         alertMes('Please Login', "index.php");
//     }
}



/**
 * Registration
 * @return string
 */
function register(){

    $arr=$_POST;
    $arr['password1'] = sha1($_POST['password1']);
    $arr['password2'] = sha1($_POST['password2']);
    $email=mysql_escape_string(trim($_POST['email']));
    $arr['join_date']=date('Y-m-d H:i:s');
    $arr['verify_code']=md5(rand(0,1000));

    if (!empty($email)
        && !empty($arr['password1'])
        && ($arr['password2']==$arr['password1'])
        && ($arr['user_type']!==0)){

        $sql="select email from tg_user_login where email='{$email}'";
        $row=fetchOne($sql);

        if(empty($row)){

            $user_id = strtotime("now");
            $arr['user_id']= $user_id;

            // email娑撴椽鏁撶粔闈╃秶閹风兘鏁撻弬銈嗗闁跨喐鏋婚幏鐑芥晸闁惧府鎷�
            insert("tg_user_login",$arr);

            // 闁跨喐鏋婚幏宄板絿闁跨喐鏋婚幏绌峬ail闁跨喐鏋婚幏宄扮秿
            $sql="select * from tg_user_login where email='{$email}'";
            $row=fetchOne($sql);

            // Set session, 闁跨喐鏋婚幏閿嬫暈闁跨喐鏋婚幏鐑芥晸缂佺偞鍞婚幏鐑芥晸閿熶粙鏁撻弬銈嗗閸欘亪鏁撻弬銈嗗session闁跨喐鏋婚幏鐑芥晸閺傘倖瀚瑰▽锟犳晸閺傘倖瀚筩ookie
            if($row){
                $_SESSION['user_id']=$row['user_id'];
                $_SESSION['email']=$row['email'];
                //$_COOKIE['user_id']=$_SESSION['user_id'];
                //$_COOKIE['email']=$_SESSION['email'];

                $id=$_SESSION['user_id'];

//                 // For php5.4
//                 switch ($row['user_type']){
//                     case 1:
//                         // 闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔虹叓娴兼瑦瀚归柨鐔告灮閹烽攱浼呴柨鐕傛嫹 闁岸鏁撻弬銈嗗 user_id + info_id 闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔告灮閹风兘鏁撻弬銈嗗闁跨喐鏋婚幏鐑芥晸閿燂拷
//                         insert("tg_host_info",['host_id'=>$id]);

//                         // 闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔告灮閹风兘鏁撻弬銈嗗闁跨喐鏋婚幏閿嬩紖闁跨噦鎷�闁岸鏁撻弬銈嗗 user_id + house_id 闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔告灮閹风兘鏁撻弬銈嗗闁跨喐鏋婚幏鐑芥晸閿燂拷闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔告灮閹凤拷闁跨喐鏋婚幏鐑芥晸閼存碍鍞婚幏鐤洣闁跨喐鏋婚幏铚傜闁跨喐鏋婚幏鐑芥晸鐞涙顔愰幏绌抎闁跨喐鏋婚幏鐑芥晸閺傘倖瀚规稉娲晸閺傘倖瀚归柨鐔告灮閹风兘鏁撻惌顐＄串閹风兘鏁撻弬銈嗗闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔告灮閹风兘鏁撻弬銈嗗闁跨喐鏋婚幏鐑芥晸鏉堝啰娈戦崙銈嗗濠ф劙鏁撻弬銈嗗閹垶鏁撻弬銈嗗闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔告灮閹风兘鏁撻弬銈嗗闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔告灮閹凤拷
//                         insert("tg_host_house",['house_id'=>$id]);

//                         // 闁跨喐鏋婚幏鐑芥晸閺傘倖瀚规担宥夋晸閻偓鎷�闁岸鏁撻弬銈嗗 user_id + location_id 闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔告灮閹风兘鏁撻弬銈嗗闁跨喐鏋婚幏鐑芥晸閿燂拷
//                         insert("tg_house_location",['location_id'=>$id]);

//                         // 闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔告灮閹风兘鏁撻弬銈嗗闁跨喐鏋婚幏椋庢窗闁跨噦鎷�闁岸鏁撻弬銈嗗 user_id + services_id 闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔告灮閹风兘鏁撻弬銈嗗闁跨喐鏋婚幏鐑芥晸閿燂拷
//                         insert("tg_host_services",['services_id'=>$id]);

//                         //闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔告灮閹风兘鏁撻弬銈嗗闁跨噦鎷�
//                         insert("tg_host_calendar",['calendar_id'=>$id]);

//                         //闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔告灮閹风兘鏁撻弬銈嗗
//                         //insert("tg_house_img",['album_id'=>$id]);
//                         break;
//                     case 2:
//                         insert("tg_guest_info", ['guest_id'=>$id]);
//                         insert("tg_guest_request", ['guest_id'=>$id]);
//                         break;
//                 }

                   // For php 5.3 and below
                switch ($row['user_type']){
                    case 1:
                        // 闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔虹叓娴兼瑦瀚归柨鐔告灮閹烽攱浼呴柨鐕傛嫹 闁岸鏁撻弬銈嗗 user_id + info_id 闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔告灮閹风兘鏁撻弬銈嗗闁跨喐鏋婚幏鐑芥晸閿燂拷
                        //insert("tg_host_info",'host_id'=>$id);
                        $sql="INSERT INTO tg_host_info (host_id) VALUES ('$id')";
                        mysql_query($sql);

                        // 闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔告灮閹风兘鏁撻弬銈嗗闁跨喐鏋婚幏閿嬩紖闁跨噦鎷�闁岸鏁撻弬銈嗗 user_id + house_id 闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔告灮閹风兘鏁撻弬銈嗗闁跨喐鏋婚幏鐑芥晸閿燂拷闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔告灮閹凤拷闁跨喐鏋婚幏鐑芥晸閼存碍鍞婚幏鐤洣闁跨喐鏋婚幏铚傜闁跨喐鏋婚幏鐑芥晸鐞涙顔愰幏绌抎闁跨喐鏋婚幏鐑芥晸閺傘倖瀚规稉娲晸閺傘倖瀚归柨鐔告灮閹风兘鏁撻惌顐＄串閹风兘鏁撻弬銈嗗闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔告灮閹风兘鏁撻弬銈嗗闁跨喐鏋婚幏鐑芥晸鏉堝啰娈戦崙銈嗗濠ф劙鏁撻弬銈嗗閹垶鏁撻弬銈嗗闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔告灮閹风兘鏁撻弬銈嗗闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔告灮閹凤拷
                        //insert("tg_host_house",['house_id'=>$id]);
                        $sql="INSERT INTO tg_host_house (house_id) VALUES ('$id')";
                        mysql_query($sql);

                        // 闁跨喐鏋婚幏鐑芥晸閺傘倖瀚规担宥夋晸閻偓鎷�闁岸鏁撻弬銈嗗 user_id + location_id 闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔告灮閹风兘鏁撻弬銈嗗闁跨喐鏋婚幏鐑芥晸閿燂拷
                        //insert("tg_house_location",['location_id'=>$id]);
                        $sql="INSERT INTO tg_house_location (location_id) VALUES ('$id')";
                        mysql_query($sql);

                        // 闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔告灮閹风兘鏁撻弬銈嗗闁跨喐鏋婚幏椋庢窗闁跨噦鎷�闁岸鏁撻弬銈嗗 user_id + services_id 闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔告灮閹风兘鏁撻弬銈嗗闁跨喐鏋婚幏鐑芥晸閿燂拷
                        //insert("tg_host_services",['services_id'=>$id]);
                        $sql="INSERT INTO tg_host_services (services_id) VALUES ('$id')";
                        mysql_query($sql);

                        //闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔告灮閹风兘鏁撻弬銈嗗闁跨噦鎷�
                        //insert("tg_host_calendar",['calendar_id'=>$id]);
                        $sql="INSERT INTO tg_host_calendar (calendar_id) VALUES ('$id')";
                        mysql_query($sql);


                        //闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔告灮閹风兘鏁撻弬銈嗗
                        //insert("tg_house_img",['album_id'=>$id]);
                        $sql="INSERT INTO tg_house_img (album_id) VALUES ('$id')";
                        mysql_query($sql);
                        break;
                    case 2:
                        //insert("tg_guest_info", ['guest_id'=>$id]);
                        $sql="INSERT INTO tg_guest_info (guest_id) VALUES ('$id')";
                        mysql_query($sql);
                        //insert("tg_guest_request", ['guest_id'=>$id]);
                        $sql="INSERT INTO tg_guest_request (guest_id) VALUES ('$id')";
                        mysql_query($sql);
                        break;
                }

                switch ($row['user_type']){
                    case 1:
                        header("location:list-space.php");
                        break;
                    case 2:
                        header("location:list-request.php");
                        break;
                }

            }else{
                alertMes("The email is exists!", "index.php");
                return false;
            }
        }else{
            alertMes("This email has registerd, please choose another!", "index.php");
        }
    }
}


/**
 * Check if an user logined
 */
function checkUserLogined(){
    if($_SESSION['user_id']=="" && $_COOKIE['user_id']==""){
        alertMes("Please login", "index.php");
    }else{
        exit;
    }
}


/**
 * check is there an user session
 * @param $sql
 */
function checkProfileSession(){

    if(empty($_SESSION['user_id']) && empty($_COOKIE['user_id'])){
        alertMes("Please login first", 'index.php');
    }
}


/**
 * User logout
 */
function userOut(){
    if(isset($_SESSION['user_id'])){
        $_SESSION=array();
    }

    if(isset($_COOKIE[session_name()])){
        setcookie(session_name(),"",time()-1);
    }

    session_destroy();
    setcookie('user_id', '', time()-1);
    setcookie('email', '', time()-1);

    header("location:index.php");
}

function changePwd(){
    $email=$_REQUEST['email'];

    $arr=$_POST;
    //$arr['oldPwd'] = sha1($_POST['oldPwd']);
    $arr['password1'] = sha1($_POST['password1']);
    $arr['password2'] = sha1($_POST['password2']);
    //$oldPwd=$arr['oldPwd'];
    $pwd1=$arr['password1'];
    $pwd2=$arr['password2'];

    $sql="select password1 from tg_user_login where email='$email'";
    $row=fetchOne($sql);

    //if($oldPwd != $row['password1']){
    //    echo 'Your old password is incorrect. Please enter again.';
    //    exit;
    //}else{
        if(!empty($arr['password1']) && $arr['password1'] == $arr['password2']){

            $sql="UPDATE tg_user_login SET password1='$pwd1', password2='$pwd2' where email='$email'";
            mysql_query($sql);
            alertMes('Your password has been changed', 'index.php');
        }else{
            echo 'Password change failed. Please try again.';
        }
    //}
}


?>