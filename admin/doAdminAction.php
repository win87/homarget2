<?php

require_once '../include.php';
checkLogined();
$act=$_REQUEST['act'];
@$id=$_REQUEST['id'];
@$album_id=$_REQUEST['album_id'];
@$img_path=$_REQUEST['img_path'];

if($act=="logout"){
    logout();
}elseif($act=="addAdmin"){
    $mes=addAdmin();
}elseif($act=="editAdmin"){
    $mes=editAdmin($id);
}elseif($act=="delAdmin"){
    $mes=delAdmin($id);
}elseif($act=="editHostInfo"){
    $mes=editHostInfo($id);
}elseif($act=="addCate"){
    $mes=addCate();
}elseif($act=="editCate"){
    $where="id={$id}";
    $mes=editCate($where);
}elseif($act=="delCate"){
    $mes=delCate($id);
}elseif($act=="addHouse"){
    $mes=addHouse();
}elseif($act=="editHouse"){
    $mes=editHouse($id);
}elseif($act=="editCalendar"){
    $mes=editCalendar($id);
}elseif($act=="editLocation"){
    $mes=editLocation($id);
}elseif($act=="editServices"){
    $mes=editServices($id);
}elseif($act=="delPro"){
    $mes=delPro($id);
}elseif($act=="addUser"){
    $mes=addUser();
}elseif($act=="delUser"){
    $mes=delUser($id);
}elseif($act=="delHostInfo"){
    $mes=delHostInfo($id);
}elseif($act=="editUser"){
    $mes=editUser($id);
}elseif($act=="waterText"){
    $mes=doWaterText($id);
}elseif($act=="waterPic"){
    $mes=doWaterPic($id);
}elseif($act=="addGuest"){
    $mes=addGuest();
}elseif($act=="addGuestInfo"){
    $mes=addGuestInfo();
}elseif($act=="editGuestInfo"){
    $mes=editGuestInfo($id);
}elseif($act=="editGuestRequest"){
    $mes=editGuestRequest($id);
}elseif($act=="delGuest"){
     $mes=delGuest($id);
}elseif($act=="delImg"){
     $mes=delImg($album_id, $img_path);
}elseif($act=="addImgs"){
     $mes=addImgs($album_id);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
</head>
<body>
<?php
	if($mes){
		echo $mes;
	}
?>
</body>
</html>