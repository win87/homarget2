<?php

require_once 'include.php';

$act=$_REQUEST['act'];
@$id=$_REQUEST['id'];
@$id_guest=$_REQUEST['id_guest'];
@$id_host=$_REQUEST['id_host'];
@$album_id=$_REQUEST['album_id'];
@$img_path=$_REQUEST['img_path'];

if($act=="register"){
    $mes=register();
}
elseif($act=="addInfo"){
    $mes=addInfo();
}
elseif($act=="addLanguage"){
    $mes=addLanguage();
}
elseif($act=="addAcco"){
    $mes=addAcco();
}
elseif($act=="addAllAcco"){
    $mes=addAllAcco();
}
elseif($act=="addLocation"){
    $mes=addLocation();
}
elseif($act=="addCalendar"){
    $mes=addCalendar();
}
elseif($act=="addFromDate"){
    $mes=addFromDate();
}
elseif($act=="addMinDays"){
    $mes=addMinDays();
}
elseif($act=="addPrice"){
    $mes=addPrice();
}
elseif($act=="addPhotos"){
    $mes=addPhotos();
}
elseif($act=="addPic"){
    $mes=addPic();
}
elseif($act=="addGuestPic"){
    $mes=addGuestPic;
}
elseif($act=="addAmen"){
    $mes=addAmen();
}
elseif($act=="login"){
    $mes=login();
}
elseif($act=="userOut"){
    $mes=userOut();
}
elseif($act=="guestInfo"){
    $mes=guestInfo();
}
elseif($act=="guestAllInfo"){
    $mes=guestAllInfo();
}
elseif($act=="guestPre"){
    $mes=guestPre();
}
elseif($act=="guestArrival"){
    $mes=guestArrival();
}
elseif($act=="guestDeparture"){
    $mes=guestDeparture();
}
elseif($act=="guestPriceIntro"){
    $mes=guestPriceIntro();
}
elseif($act=="addDest"){
    $mes=addDest();
}
elseif($act=="viewProfile"){
    $mes=viewProfile();
}
elseif($act=="changePwd"){
    $mes=changePwd();
}
elseif($act=="unShowHouse"){
    $mes=unShowHouse();
}
elseif($act=="unShowRequest"){
    $mes=unShowRequest();
}
elseif($act=="delBookGuest"){
    $mes=delBookGuest($id_guest,$id_host);
}
elseif($act=="delBookHost"){
    $mes=delBookHost($id_host,$id_guest);
}
elseif($act=="cancelGuestBook"){
    $mes=cancelGuestBook($id_guest,$id_host);
}
elseif($act=="cancelHostBook"){
    $mes=cancelHostBook($id_host,$id_guest);
}
elseif($act=="acceptGuestBook"){
    $mes=acceptGuestBook($id_guest,$id_host);
}
elseif($act=="acceptHostBook"){
    $mes=acceptHostBook($id_host,$id_guest);
}
elseif($act=="udelImg"){
    $mes=udelImg($album_id, $img_path);
}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Welcome</title>
</head>
<body>
<?php
	if($mes){
		echo $mes;
	}
?>
</body>
</html>