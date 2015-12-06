<?php


/**
 * Add a user's infomation
 * @return string
 */
function addInfo(){

    $arr=$_POST;

    $res=update("tg_host_info",$arr,"host_id='{$_SESSION['user_id']}'");
    echo "<img src='images/default/check.png' class='check-icon'></img>";

}

/**
 * Add a user's language
 * @return string
 */
function addLanguage(){

    $arr=$_POST;
    $language=$arr['language'];
    $arr['language']=implode(",",$language);

      if($arr['first_name']=='' ||
         $arr['last_name']=='' ||
         $arr['gender']=='' ||
         $arr['age']=='' ||
         $arr['language']=='' ||
         $arr['phone']=='' ||
         $arr['phone_code']=='' ||
         $arr['mobile']=='' ||
         $arr['mobile_code']==''
          ){
          echo "<script>alert('Please fill out all required information');</script>";
      }else{


    $res=update("tg_host_info",$arr,"host_id='{$_SESSION['user_id']}'");
    echo "<img src='images/default/check.png' class='check-icon'></img>";

     }
}

function addAcco(){
    $arr=$_POST;
    $res=update("tg_host_house",$arr,"house_id='{$_SESSION['user_id']}'");
    echo "<img src='images/default/check.png' class='check-icon'></img>";
}

/**
 * Add accommodation
 */
function addAllAcco(){
    $arr=$_POST;
    $arr['summary']=mysql_real_escape_string($arr['summary']);
    $arr['house_title']=mysql_real_escape_string($arr['house_title']);

    // To do list 闁跨喐鏋婚幏绌歶b_time 闁跨喐鏋婚幏鐑芥晸閺傘倖瀚�
    if(empty($arr['pub_time']) && empty($arr['update_time'])){
        $arr['pub_time']=date('Y-m-d H:i:s');
    }
    //$arr['pub_time']=date('Y-m-d H:i:s');
    $arr['update_time']=date('Y-m-d H:i:s');

    if($arr['adult_no']=='' ||
        $arr['child_no']=='' ||
        $arr['house_type']=='' ||
        $arr['room_type']=='' ||
        $arr['bedroom']=='' ||
        $arr['bathroom']=='' ||
        $arr['house_title']==''
    ){
        echo "<script>alert('Please fill out all required information');</script>";
    }else{
        $res=update("tg_host_house",$arr,"house_id='{$_SESSION['user_id']}'");
        echo "<img src='images/default/check.png' class='check-icon'></img>";
    }
}

/**
 * Add location
 */
function addLocation(){
    $arr=$_POST;
    $id=$_SESSION['user_id'];

    $res=update("tg_house_location",$arr,"location_id='{$id}'");
    echo "<img src='images/default/check.png' class='check-icon'></img>";
}

function addCalendar(){

    $arr=$_POST;
    $start=$arr['start_day'];
    $timestamp_start=date('Y-m-d',strtotime($start));
    $arr['start_day']=$timestamp_start;
    $id=$_SESSION['user_id'];

    if(empty($start)){
        echo "<script>alert('Please fill out all required information');</script>";
    }else{
        $res=update("tg_host_calendar",$arr,"calendar_id='{$id}'");
        echo "<img src='images/default/check.png' class='check-icon'></img>";
    }
}

function addFromDate(){

    $arr=$_POST;
    $start=$arr['start_day'];
    $timestamp_start=date('Y-m-d',strtotime($start));
    $arr['start_day']=$timestamp_start;
    $id=$_SESSION['user_id'];

    $res=update("tg_host_calendar",$arr,"calendar_id='{$id}'");
    echo "<img src='images/default/check.png' class='check-icon'></img>";
}

function addMinDays(){

    $arr=$_POST;
    $id=$_SESSION['user_id'];

    $res=update("tg_host_calendar",$arr,"calendar_id='{$id}'");
    echo "<img src='images/default/check.png' class='check-icon'></img>";
}


/**
 * Add price
 */
function addPrice(){
    $arr=$_POST;
    $id=$_SESSION['user_id'];

//     if($arr['m_price']==''){
//         echo "<script>alert('Please fill out all required information');</script>";
//     }else{
        $res=update("tg_host_house",$arr,"house_id='{$id}'");
        echo "<img src='images/default/check.png' class='check-icon'></img>";
//     }
}

/**
 * Add photos
 */
function addPhotos(){

    $arr=$_POST;
    $id=$_SESSION['user_id'];
    $path="uploads/House_Album/user_id_".$id;

    $uploadFiles=uploadFile($path);

    if(is_array($uploadFiles)&&$uploadFiles){
        foreach($uploadFiles as $key=>$uploadFile){
            thumb($path."/".$uploadFile['name'],"image_50/user_id_".$id."/".$uploadFile['name'],50,50);
        }
    }

    $album_id=$id;

    //闁跨喐鏋婚幏绌抦g_path 闁跨喐鏋婚幏閿嬪闁跨噦鎷穞g_house_img闁跨喐鏋婚幏锟�
    if($album_id){
        $sql = "delete from tg_house_img where album_id=$album_id and img_path IS NULL";
        mysql_query($sql);
        if($uploadFiles && is_array($uploadFiles)){
            foreach($uploadFiles as $uploadFile){
                $arr1['album_id']=$album_id;
                $arr1['img_path']=$uploadFile['name'];
                addAlbum($arr1);
            }
        }
    }
}

/**
 Add Host and Guest's profile picture
 */
function addPic(){

    $arr=$_POST;
    $id=$_SESSION['user_id'];
    $path="uploads/profile_img/user_id_".$id;


    $uploadFile=uploadFile($path);

    if($uploadFile && is_array($uploadFile)){
        $arr['picture']=$uploadFile[0]['name'];
        $pic=$arr['picture'];
    }else{
        return "failed!";
    }
    $sql="UPDATE tg_user_login SET picture='$pic' where user_id=$id";
    mysql_query($sql);
    //$res=update("tg_user_login",$arr,"user_id='{$id}'");
}


/**
 * Add services
 */
function addAmen(){
    $arr=$_POST;
    $id=$_SESSION['user_id'];

    @$daily_services=$arr['daily_services'];
    @$common=$arr['common'];
    @$extras=$arr['extras'];

    @$arr['daily_services']=implode(",", $daily_services);
    @$arr['common']=implode(",", $common);
    @$arr['extras']=implode(",", $extras);

    if($daily_services==''){
        echo "<script>alert('Please fill out all required information');</script>";
    }else{
        $res=update("tg_host_services",$arr,"services_id={$id}");
        echo "<img src='images/default/check.png' class='check-icon'></img>";
    }
}



/**
 * Add a guest's infomation
 * @return string
 */
function guestInfo(){

    $arr=$_POST;
    $res=update("tg_guest_info",$arr,"guest_id={$_SESSION['user_id']}");
    echo "<img src='images/default/check.png' class='check-icon'></img>";
}

function guestAllInfo(){

    $arr=$_POST;
    $language=$arr['language'];

    $arr['language']=implode(",",$language);

    if($arr['first_name']=='' ||
        $arr['last_name']=='' ||
        $arr['gender']=='' ||
        $arr['age']=='' ||
        $arr['ethnicity']=='' ||
        $arr['occupation']=='' ||
        $arr['purpose']=='' ||
        $arr['language']=='' ||
        $arr['mobile']==''
        //$arr['mobile_code']==''
    ){
        echo "<script>alert('Please fill out all required information');</script>";
    }else{
        $res=update("tg_guest_info",$arr,"guest_id={$_SESSION['user_id']}");
        echo "<img src='images/default/check.png' class='check-icon'></img>";
    }
}

function guestPre(){
    $arr=$_POST;
    $arr['arrival']=date('Y-m-d',strtotime($arr['arrival']));
    $arr['departure']=date('Y-m-d',strtotime($arr['departure']));
    $arr['intro']=mysql_real_escape_string($arr['intro']);

    $services=$arr['preferred_services'];
    //闁跨喓鐛ょ拋瑙勫闁鏁撻弬銈嗗闁跨喐鏋婚幏鐑芥晸閺傘倖瀚归柨鐔告灮閹风兘鏁撻弬銈嗗閸э拷鏁撻弬銈嗗闁跨喐鏋婚幏鐑芥晸缁差槦sql
    $arr['preferred_services']=implode(",",$services);

    if($arr['m_price']=='' &&
        $arr['d_price']==''
    ){
        echo "<script>alert('Please fill out all required information');</script>";
    }else{
        $res=update("tg_guest_request",$arr,"guest_id={$_SESSION['user_id']}");
        echo "<img src='images/default/check.png' class='check-icon'></img>";
    }
}

function guestPriceIntro(){
    $arr=$_POST;
    $arr['intro']=mysql_real_escape_string($arr['intro']);
    $res=update("tg_guest_request",$arr,"guest_id={$_SESSION['user_id']}");
}

function guestArrival(){
    $arr=$_POST;
    $arr['arrival']=date('Y-m-d',strtotime($arr['arrival']));
    $res=update("tg_guest_request",$arr,"guest_id={$_SESSION['user_id']}");
}

function guestDeparture(){
    $arr=$_POST;
    $arr['departure']=date('Y-m-d',strtotime($arr['departure']));
    $res=update("tg_guest_request",$arr,"guest_id={$_SESSION['user_id']}");
}

function addDest(){
    $arr=$_POST;
    $id=$_SESSION['user_id'];

    $res=update("tg_guest_request",$arr,"guest_id={$id}");
    echo "<img src='images/default/check.png' class='check-icon'></img>";

}

function delBookGuest($id_guest,$id_host){

    $sql="UPDATE tg_booking SET status=2 where guest_id=$id_guest and host_id=$id_host";
    $res=mysql_query($sql);
    if($res){
        header('location: host-reservation-list.php');
    }else{
        echo 'Failed!';
    }
}

function delBookHost($id_host,$id_guest){

    $sql="UPDATE tg_booking SET status=2 where guest_id=$id_guest and host_id=$id_host";
    $res=mysql_query($sql);
    if($res){
        header('location: guest-reservation-list.php');
    }else{
        echo 'Failed!';
    }
}


function cancelGuestBook($id_guest,$id_host){

    $sql="UPDATE tg_booking SET status=2 where guest_id=$id_guest and host_id=$id_host";
    $res=mysql_query($sql);
    if($res){
        header('location: host-reservation-list.php');
    }else{
        echo 'Failed!';
    }
}

function cancelHostBook($id_host,$id_guest){

    $sql="UPDATE tg_booking SET status=2 where guest_id=$id_guest and host_id=$id_host";
    $res=mysql_query($sql);
    if($res){
        header('location: guest-reservation-list.php');
    }else{
        echo 'Failed!';
    }
}

function acceptGuestBook($id_guest,$id_host){

    $sql="UPDATE tg_booking SET status=1 where guest_id=$id_guest and host_id=$id_host";
    $res=mysql_query($sql);
    if($res){
        header('location: host-reservation-list.php');
    }else{
        echo 'Failed!';
    }
}

function acceptHostBook($id_host,$id_guest){

    $sql="UPDATE tg_booking SET status=1 where guest_id=$id_guest and host_id=$id_host";
    $res=mysql_query($sql);
    if($res){
        header('location: guest-reservation-list.php');
    }else{
        echo 'Failed!';
    }
}

function udelImg($album_id, $img_path){

    $sql="delete from tg_house_img where album_id = $album_id and img_path='$img_path'";
    $res=mysql_query($sql);
    if ($res){
        header('location: edit-profile.php');
    }else {
        alertMes('Delete failed!', 'edit-profile.php');
    }
}