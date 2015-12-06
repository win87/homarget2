<?php
require_once '../include.php';

/* $filename=$_FILE['myFile']['name'];
$type=$_FILES['myFile']['type'];
$error=$_FILES['myFile']['error'];
$tmp_name=$_FILES['myFile']['tmp_name'];
$size=$_FILES['myFile']['size'];
$allowExt=array("jpg","png");
$path="upload";

if($error==UPLOAD_ERR_OK){
    if(!in_array($ext, $allowExt)){
        exit("Extension incorrect!");
    }

    $ext=getExt($filename);
    $filename=getUniName().".".$ext;
    $destination=$path."/".$filename;
    if(is_uploaded_file($tmp_name)){
        if(move_uploaded_file($tmp_name, $destination)){
        }
    }else{
        $mes="The file is not uploaded thru HTTP";
    }

}else{
    switch ($error){
        case 1:
            break;
        case 2:
            break;
        case 3:
            break;
        case 4:
            break;
        case 6:
            break;
        case 7:
            break;
        case 8:
            break;

    }
} */

$fileInfo=$_FILES['myFile'];
$info=uploadFile($fileInfo);
if($info){
    alertMes("Upload success!", "../listYourSpace.php");
}else{
    alertMes("Upload failed!", "../listYourSpace.php");
}