<?php

/**
 * Check if the admin exists
 * @param unknown $sql
 * @return Ambigous <multitype:, multitype:>
 */
function checkAdmin($sql){
    return fetchOne($sql);
}

/**
 * check if an admin login
 * @param unknown $sql
 */
// function checkSession(){
//     if(empty($_SESSION['user_id']) && empty($_COOKIE['user_id'])){
//       alertMes("Please login!", '<a href="#" data-toggle="modal" data-target=".myModal-reg">');
//     }
// }


/**
 * Check user login
 */
function checkLogined(){

	if(empty($_SESSION['admin_id']) && empty($_COOKIE['admin_id'])){
		alertMes("Please login","login.php");
	}
}


/**
 * Add a new administrator
 * @return string
 */
function addAdmin(){
    $arr=$_POST;
    $arr['password']=sha1($_POST['password']);
    $arr['reg_time']=date('Y-m-d H:i:s');
    //print_r($arr);exit;
    if(insert("tg_admin", $arr)){
        $mes="<h3>Added!</h3><br/><a href='addAdmin.php'>Add more</a>|<a href='listAdmin.php'>View Admin. list</a>";
    }else{
        $mes="Add failed!<br/><a href='addAdmin.php'>Add again</a>";
    }
    return $mes;
}

/**
 * get all administrators
 * @return array
 */
 function getAllAdmin(){
    $sql = "select * from tg_admin";
    $rows=fetchAll($sql);
    return $rows;
}

/**
 * Get all admin by page
 * @param number $pageSize
 * @return array
 */
function getAdminByPage($pageSize){
    $sql="select * from tg_admin";
    $totalRows=getResultNum($sql);

    //it has to be set to GLOBAL!!
    global $totalPage;
    $totalPage=ceil($totalRows/$pageSize);
    @$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;

    if($page<1 || $page==null || !is_numeric($page)){
        $page=1;
    }

    if($page>=$totalPage) $page=$totalPage;

    $offset=($page-1)*$pageSize;
    $sql="select admin_id,email,reg_time from tg_admin limit {$offset},{$pageSize}";
    $rows=fetchAll($sql);
    return $rows;
}

/**
 * 闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归惄鎾晸閺傘倖瀚归崘娆撴晸閺傘倖瀚筶istHouse.php闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔峰閿濆繑瀚归柨鐔告灮閹风兘鏁撻弬銈嗗
 * Get all house infomation by page (data from different table)
 * @param unknown $pageSize
 * @return Ambigous <multitype:, multitype:>
 */
// function getHouseByPage($pageSize){
//     $sql="select * from tg_host_house";
//     $totalRows=getResultNum($sql);

//     //it has to be set to GLOBAL!!
//     global $totalPage;
//     $totalPage=ceil($totalRows/$pageSize);
//     @$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;

//     if($page<1 || $page==null || !is_numeric($page)){
//         $page=1;
//     }
//     if($page>=$totalPage) $page=$totalPage;
//     $offset=($page-1)*$pageSize;

//     //Connect table "tg_host_house" and "tg_host_calendar" to fetch relatived data from them
//     $sql="select * from tg_host_house as h join tg_host_calendar c on h.house_id = c.calendar_id limit {$offset},{$pageSize}";
//     $rows=fetchAll($sql);
//     return $rows;
// }

/**
 * Get calendart by page
 * @param unknown $pageSize
 * @return Ambigous <multitype:, multitype:>
 */
function getCalendarByPage($pageSize){
    $sql="select * from tg_host_calendar";
    $totalRows=getResultNum($sql);

    //it has to be set to GLOBAL!!
    global $totalPage;
    $totalPage=ceil($totalRows/$pageSize);
    @$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;

    if($page<1 || $page==null || !is_numeric($page)){
        $page=1;
    }
    if($page>=$totalPage) $page=$totalPage;
    $offset = ($page-1)*$pageSize;

    $sql="select * from tg_host_calendar as c join tg_user_login l on c.calendar_id = l.user_id order by c.id desc limit {$offset},{$pageSize}";
    $rows=fetchAll($sql);
    return $rows;
}

function getServicesByPage($pageSize){
    $sql="select * from tg_host_services";
    $totalRows=getResultNum($sql);

    //it has to be set to GLOBAL!!
    global $totalPage;
    $totalPage=ceil($totalRows/$pageSize);
    @$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;

    if($page<1 || $page==null || !is_numeric($page)){
        $page=1;
    }
    if($page>=$totalPage) $page=$totalPage;
    $offset = ($page-1)*$pageSize;

    $sql="select * from tg_host_services as c join tg_user_login l on c.services_id = l.user_id order by c.id desc limit {$offset},{$pageSize}";
    $rows=fetchAll($sql);
    return $rows;
}


/**
 * Edit administrator
 * @param unknown $id
 * @return string
 */
function editAdmin($id){
    $arr=$_POST;
    $arr['password']=sha1($_POST['password']);

    //print_r($arr);exit;
    if(update("tg_admin",$arr,"admin_id={$id}")){
        $mes="<h3>Edit Success!</h3><br/><a href='listAdmin.php'> View administrator lists </a>";
    }else{
        $mes="<h3>Edit Failed!</h3><br/><a href='listAdmin.php'> Edit </a>";
    }
    return $mes;
}

/**
 * Delete administrator
 * @param unknown $id
 * return string
 */
function delAdmin($id){
    if(delete("tg_admin","admin_id={$id}")){
        $mes="Delete Success!<br/><a href='listAdmin.php'>View admin list</a>";
    }else{
        $mes="Delete Failed!<br/><a href='listAdmin.php'> Edit </a>";
    }
    return $mes;
}


/**
 * Admin logout
 */
function logout(){
    //Empty the session
    $_SESSION=array();
    //Empty the cookie
    if(isset($_COOKIE[session_name()])){
        setcookie(session_name(),"",time()-1);
    }
    if(isset($_COOKIE['admin_id'])){
        setcookie("admin_id","",time()-1);
    }
    if(isset($_COOKIE['email'])){
        setcookie("email","",time()-1);
    }
    session_destroy();
    header("location:login.php");
}

/**
 * 闁跨喐鏋婚幏鐑芥晸閺傘倖瀚瑰▽锟犳晸閿燂拷
 * @return string
 */
function addUser(){
    $arr=$_POST;
    $arr['password1']=sha1($_POST['password1']);
    $arr['password2']=sha1($_POST['password2']);
    $arr['join_date']=date('Y-m-d H:i:s');
    $email=mysql_escape_string(trim($_POST['email']));
    //print_r($arr);exit;

    /* //濞夈劑鏁撻弬銈嗗闁跨喓绮搁幉瀣闁跨喐鏋婚幏鐑芥晸閹活収浜烽幏宄伴暱閻撳苯鍤栭幏鐑芥晸閿燂拷
    $uploadFile=uploadFile();

    //print_r($uploadFile);
    if($uploadFile&&is_array($uploadFile)){
        $arr['face']=$uploadFile[0]['name'];
    }else{
        return "Register failed!";
    } */

    //print_r($arr);exit;
    if (!empty($email) && !empty($arr['password1']) && !empty($arr['password2']) && ($arr['password2']==$arr['password1'])){
        //make sure someone isn't already using this email

        $sql="select * from tg_user_login where email='{$email}'";
        $row=fetchOne($sql);
        if($row==0){
            //the email is unique, so insert the data into the database
            insert("tg_user_login",$arr);
            $sql="select * from tg_user_login where email='{$email}'";
            $row=fetchOne($sql);

            if($row){
                $_SESSION['user_id']=$row['user_id'];
                $_SESSION['email']=$row['email'];

                $id=$_SESSION['user_id'];

//                 //闁岸鏁撻弬銈嗗 user_id + info_id 闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔告灮閹风兘鏁撻弬銈嗗闁跨喐鏋婚幏鐑芥晸閿燂拷
//                 insert("tg_host_info",['info_id'=>$id]);
//                 //闁岸鏁撻弬銈嗗 user_id + house_id 闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔告灮閹风兘鏁撻弬銈嗗闁跨喐鏋婚幏鐑芥晸閿燂拷
//                 insert("tg_host_house",['house_id'=>$id]);
//                 //闁岸鏁撻弬銈嗗 user_id + location_id 闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔告灮閹风兘鏁撻弬銈嗗闁跨喐鏋婚幏鐑芥晸閿燂拷
//                 insert("tg_house_location",['location_id'=>$id]);
//                 //闁岸鏁撻弬銈嗗 user_id + services_id 闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔告灮閹风兘鏁撻弬銈嗗闁跨喐鏋婚幏鐑芥晸閿燂拷
//                 insert("tg_host_services",['services_id'=>$id]);
//                 //闁跨喓鐓导娆愬濞夈劑鏁撻弬銈嗗闁跨喓绮搁幉瀣妫板稁鍎ら柨鐔告灮閹风兘鏁撻弬銈嗗闁跨喐鏋婚幏鐑芥晸閿燂拷
//                 insert("tg_house_img",['album_id'=>$id]);


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

                    //insert("tg_guest_info", ['guest_id'=>$id]);
                    $sql="INSERT INTO tg_guest_info (guest_id) VALUES ('$id')";
                    mysql_query($sql);
                    //insert("tg_guest_request", ['guest_id'=>$id]);
                    $sql="INSERT INTO tg_guest_request (guest_id) VALUES ('$id')";
                    mysql_query($sql);


                echo "Congratulation!<br/> <a href='addUser.php'>Add more</a>|<a href='listUser.php'>View list</a>";
            }else{
                alertMes("The data table haven't create correctly, please check it!", "addUser.php");
            }
        }else{

            //print_r($arr);exit;
            echo "The email is exist! Choose another one!<br/><a href='addUser.php'>Try again!</a>|<a href='listUser.php'>View user list</a>";
        }
    }else{
        echo "Please enter all information!<br/> <a href='addUser.php'>Try again</a>|<a href='listUser.php'>View list</a>";
    }

       /*  $filename="uploads/".$uploadFile[0]['name'];
        if(file_exists($filename)){
            unlink($filename);
        }*/


}


/**
 * 闁跨喐纾ユ潏鎴︽晸閻偂绱幏锟�
 * @param unknown $id
 * @return string
 */
function editUser($id){
    $arr=$_POST;
    $arr['password1']=sha1($_POST['password1']);
    $arr['password2']=sha1($_POST['password2']);
    if(update("tg_user_login",$arr,"user_id='{$id}'")){
        $mes="Edit Success!<br/><a href='listUser.php'> View user list </a>";
    }else{
        $mes="Edit Failed!<br/><a href='listUser.php'> Edit </a>";
    }
    return $mes;
}


function editHostInfo($id){
    $arr=$_POST;
    //print_r($arr);exit;
    //$arr['password1']=sha1($_POST['password1']);
    //$arr['password2']=sha1($_POST['password2']);
    if(update("tg_host_info",$arr,"host_id={$id}")){
        $mes="Edit Success!<br/><a href='listInfo.php'> View user list </a>";
    }else{
        $mes="Edit Failed!<br/><a href='listInfo.php'> Edit </a>";
    }
    return $mes;
}


/**
 * Delete User
 * @param unknown $id
 * @return string
 */
function delUser($id){
     //闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归懣姗�晸閺傘倖瀚筯omarget_user闁跨喐鏋婚幏宄板灩闁跨喐鏋婚幏鐑芥晸閻偂绱幏宄般仈闁跨喐鏋婚幏绌歳ofile_img
    $sql="select * from tg_host_info where id=".$id;
    $row=fetchOne($sql);
    $path="uploads/profiles/user_id_".$_SESSION['user_id'];
    $profile_img=$row['picture'];
    if(file_exists($path."/".$profile_img)){
    //if(file_exists("../uploads/".$profile_img)){
        unlink($path."/".$profile_img);
    }

    if(delete("tg_user_login","user_id='{$id}'")){
        $mes="Delete Success!<br/><a href='listUser.php'>View admin list</a>";
    }else{
        $mes="Delete Failed!<br/><a href='listUser.php'> Edit </a>";
    }
    return $mes;
}


function delHostInfo($id){
    //闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归懣姗�晸閺傘倖瀚筯omarget_user闁跨喐鏋婚幏宄板灩闁跨喐鏋婚幏鐑芥晸閻偂绱幏宄般仈闁跨喐鏋婚幏绌歳ofile_img   闁跨喕濞囬崠鈩冨闁跨喐鏋婚幏绌抦ooc chapter5.4 time:2:40"
    $sql="select * from tg_host_info where id=".$id;
    $row=fetchOne($sql);
    $path="uploads/profiles/user_id_".$_SESSION['user_id'];
    $profile_img=$row['picture'];
    if(file_exists($path."/".$profile_img)){
        //if(file_exists("../uploads/".$profile_img)){
        unlink($path."/".$profile_img);
    }

    if(delete("tg_host_info","host_id={$id}")){
        $mes="Delete Success!<br/><a href='listUser.php'>List host info </a>";
    }else{
        $mes="Delete Failed!<br/><a href='listUser.php'> Edit </a>";
    }
    return $mes;
}



/**
 * add guest
 * @return string
 */
function addGuest(){

    $arr=$_POST;
    $arr['join_date']=date('Y-m-d H:i:s');
    $email=mysql_escape_string(trim($_POST['email']));
    $user_id = strtotime("now");
    $arr['user_id']= $user_id;
    $path="../uploads/profile_img/user_id_".$user_id;

     $uploadFile=uploadFile($path);

     //print_r($uploadFile);
     if($uploadFile&&is_array($uploadFile)){
     $arr['picture']=$uploadFile[0]['name'];
     }else{
        return "Add profile picture failed!";
     }

     insert("tg_user_login",$arr);

     $sql="select * from tg_user_login where user_id='{$user_id}'";
     $row=fetchOne($sql);

     if($row){

         $id=$user_id;

         $sql="INSERT INTO tg_guest_info (guest_id) VALUES ('$id')";
         mysql_query($sql);

         $sql="INSERT INTO tg_guest_request (guest_id) VALUES ('$id')";
         mysql_query($sql);

         echo "Congratulation!<br/> <a href='addGuest.php'>Add more</a>|<a href='listGuest.php'>View guests list</a>";
     }else{
         $filename="../uploads/profile_img/user_id_".$user_id."/".$uploadFile[0]['name'];
          if(file_exists($filename)){
          unlink($filename);
          }
          alertMes("Failed!", "index.php");
         return false;
     }
}


/**
 * edit Guest Information
 * @param $id
 * @return string
 */
function editGuestInfo($id){

    $arr=$_POST;
    $language=$arr['language'];
    $arr['name_dest']=mysql_real_escape_string($arr['name_dest']);

    $arr['language']=implode(",",$language);

    if(update("tg_guest_info",$arr,"guest_id='{$id}'")){
        $mes="Edit Success!<br/><a href='listGuest.php'> View guests list </a>";
    }else{
        $mes="Saved, you didn't change anything!<br/><a href='listGuest.php'> Edit again </a>";
    }
    return $mes;
}

/**
 * edit Guest Request
 * @param $id
 * @return string
 */
function editGuestRequest($id){

    $arr=$_POST;
    $arr['arrival']=date('Y-m-d',strtotime($arr['arrival']));
    $arr['departure']=date('Y-m-d',strtotime($arr['departure']));
    $arr['intro']=mysql_real_escape_string($arr['intro']);

    $services=$arr['preferred_services'];
    //闁跨喓鐛ょ拋瑙勫闁鏁撻弬銈嗗闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔告灮閹风兘鏁撻弬銈嗗閸э拷鏁撻弬銈嗗闁跨喐鏋婚幏鐑芥晸缁差槦sql
    $arr['preferred_services']=implode(",",$services);

    if(update("tg_guest_request",$arr,"guest_id='{$id}'")){
        $mes="Edit Success!<br/><a href='listGuest.php'> View guests list </a>";
    }else{
        $mes="Saved, you didn't change anything!<br/><a href='listGuest.php'> Edit again </a>";
    }
    return $mes;
}

/**
 * Delete Guest
 * @param $id
 * @return string
 */
function delGuest($id){

    $sql = "SELECT * FROM tg_guest_info as i
            JOIN tg_guest_request r on i.guest_id = r.guest_id
            JOIN tg_user_login l on i.guest_id = l.user_id
            where l.id='{$id}'";
    $row=fetchOne($sql);

    $path="../uploads/profile_img/user_id_".$row['guest_id'];
    $profile_img=$row['picture'];
    if(file_exists($path."/".$profile_img)){
        unlink($path."/".$profile_img);
    }

    if(delete("tg_user_login","user_id='{$row['guest_id']}'") &&
       delete("tg_guest_info","guest_id='{$row['guest_id']}'") &&
       delete("tg_guest_request","guest_id='{$row['guest_id']}'")
    ){
        $mes="Delete Success!<br/><a href='listGuest.php'>View admin list</a>";
    }else{
        $mes="Delete Failed!<br/><a href='listGuest.php'> Edit </a>";
    }
    return $mes;
}



