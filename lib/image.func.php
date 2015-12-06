<?php
require_once 'string.func.php';
//通锟斤拷GD锟斤拷锟斤拷锟斤拷证锟斤拷
function verifyImage($type=1,$length=4,$pixel=0,$line=0,$sess_name = "verify"){
    if(!isset($_SESSION)){
        session_start();
    }
	//锟斤拷锟斤拷锟斤拷锟斤拷
	$width = 100;
	$height = 65;
	$image = imagecreatetruecolor ( $width, $height );
	$white = imagecolorallocate ( $image, 255, 255, 255 );
	$black = imagecolorallocate ( $image, 0, 0, 0 );
	//锟斤拷锟斤拷锟斤拷锟斤拷锟斤拷浠拷锟�
	imagefilledrectangle ( $image, 1, 1, $width - 2, $height - 2, $white );
	$chars = buildRandomString ( $type, $length );
	$_SESSION [$sess_name] = $chars;
	//$fontfiles = array ("MSYH.TTF", "MSYHBD.TTF", "SIMLI.TTF", "SIMSUN.TTC", "SIMYOU.TTF", "STZHONGS.TTF" );
	$fontfiles = array ("SIMYOU.TTF" );
	//锟斤拷锟斤拷锟斤拷锟斤拷锟侥硷拷锟饺较大，撅拷只锟斤拷锟斤拷一锟斤拷锟斤拷锟藉，锟斤拷锟斤拷锟斤拷锟揭拷锟酵э拷锟斤拷锟斤拷约锟斤拷锟斤拷锟斤拷锟藉，锟斤拷锟斤拷锟斤拷锟斤拷牡锟斤拷锟斤拷械锟絝onts锟侥硷拷锟斤拷锟斤拷锟叫ｏ拷直锟斤拷锟斤拷锟斤拷锟斤拷锟斤拷fonts锟斤拷锟杰匡拷锟斤拷锟斤拷应锟斤拷锟斤拷
	for($i = 0; $i < $length; $i ++) {
		$size = mt_rand ( 14, 18 );
		$angle = mt_rand ( - 15, 15 );
		$x = 5 + $i * $size;
		$y = mt_rand ( 20, 26 );
		$fontfile = "../fonts/" . $fontfiles [mt_rand ( 0, count ( $fontfiles ) - 1 )];
		$color = imagecolorallocate ( $image, mt_rand ( 50, 90 ), mt_rand ( 80, 200 ), mt_rand ( 90, 180 ) );
		$text = substr ( $chars, $i, 1 );
		imagettftext ( $image, $size, $angle, $x, $y, $color, $fontfile, $text );
	}
	if ($pixel) {
		for($i = 0; $i < 50; $i ++) {
			imagesetpixel ( $image, mt_rand ( 0, $width - 1 ), mt_rand ( 0, $height - 1 ), $black );
		}
	}
	if ($line) {
		for($i = 1; $i < $line; $i ++) {
			$color = imagecolorallocate ( $image, mt_rand ( 50, 90 ), mt_rand ( 80, 200 ), mt_rand ( 90, 180 ) );
			imageline ( $image, mt_rand ( 0, $width - 1 ), mt_rand ( 0, $height - 1 ), mt_rand ( 0, $width - 1 ), mt_rand ( 0, $height - 1 ), $color );
		}
	}
	header ( "content-type:image/gif" );
	imagegif ( $image );
	imagedestroy ( $image );
}
/**
 * 锟斤拷锟斤拷锟斤拷锟酵�
 * @param string $filename
 * @param string $destination
 * @param int $dst_w
 * @param int $dst_h
 * @param bool $isReservedSource
 * @param number $scale
 * @return string
 */
function thumb($filename,$destination=null,$dst_w=null,$dst_h=null,$isReservedSource=true,$scale=0.5){
	list($src_w,$src_h,$imagetype)=getimagesize($filename);
	if(is_null($dst_w)||is_null($dst_h)){
		$dst_w=ceil($src_w*$scale);
		$dst_h=ceil($src_h*$scale);
	}
	$mime=image_type_to_mime_type($imagetype);
	$createFun=str_replace("/", "createfrom", $mime);
	$outFun=str_replace("/", null, $mime);
	$src_image=$createFun($filename);
	$dst_image=imagecreatetruecolor($dst_w, $dst_h);
	imagecopyresampled($dst_image, $src_image, 0,0,0,0, $dst_w, $dst_h, $src_w, $src_h);
	if($destination && !file_exists(dirname($destination))){
		mkdir(dirname($destination),0777,true);
	}
	$dstFilename=$destination==null?getUniName().".".getExt($filename):$destination;
	$outFun($dst_image,$dstFilename);
	imagedestroy($src_image);
	imagedestroy($dst_image);
	if(!$isReservedSource){
		unlink($filename);
	}
	return $dstFilename;
}

/**
 *锟斤拷锟斤拷锟斤拷锟剿�
 * @param string $filename
 * @param string $text
 * @param string  $fontfile
 */
function waterText($filename,$text="imooc.com",$fontfile="MSYH.TTF"){
	$fileInfo = getimagesize ( $filename );
	$mime = $fileInfo ['mime'];
	$createFun = str_replace ( "/", "createfrom", $mime );
	$outFun = str_replace ( "/", null, $mime );
	$image = $createFun ( $filename );
	$color = imagecolorallocatealpha ( $image, 255, 0, 0, 50 );
	$fontfile = "../fonts/{$fontfile}";
	imagettftext ( $image, 14, 0, 0, 14, $color, $fontfile, $text );
	$outFun ( $image, $filename );
	imagedestroy ( $image );
}

/**
 *锟斤拷锟酵计�
 * @param string $dstFile
 * @param string $srcFile
 * @param int $pct
 */
function waterPic($dstFile,$srcFile="../images/logo.jpg",$pct=30){
	$srcFileInfo = getimagesize ( $srcFile );
	$src_w = $srcFileInfo [0];
	$src_h = $srcFileInfo [1];
	$dstFileInfo = getimagesize ( $dstFile );
	$srcMime = $srcFileInfo ['mime'];
	$dstMime = $dstFileInfo ['mime'];
	$createSrcFun = str_replace ( "/", "createfrom", $srcMime );
	$createDstFun = str_replace ( "/", "createfrom", $dstMime );
	$outDstFun = str_replace ( "/", null, $dstMime );
	$dst_im = $createDstFun ( $dstFile );
	$src_im = $createSrcFun ( $srcFile );
	imagecopymerge ( $dst_im, $src_im, 0, 0, 0, 0, $src_w, $src_h, $pct );
//	header ( "content-type:" . $dstMime );
	$outDstFun ( $dst_im, $dstFile );
	imagedestroy ( $src_im );
	imagedestroy ( $dst_im );
}


function delImg($album_id, $img_path){

    $sql="delete from tg_house_img where album_id = $album_id and img_path='$img_path'";
    $res=mysql_query($sql);
    if ($res){
        echo "Delete Success!<br/><a href='listHouse.php'>View admin list</a>";
    }else {
        echo "Delete failed!<br/><a href='listHouse.php'>Try again</a>";
    }
}

function addImgs($id){

    $path="../uploads/House_Album/user_id_".$id;

    $uploadFiles=uploadFile($path);

    if(is_array($uploadFiles)&&$uploadFiles){
        foreach($uploadFiles as $key=>$uploadFile){
            thumb($path."/".$uploadFile['name'],"image_50/user_id_".$id."/".$uploadFile['name'],50,50);
        }
    }

    $album_id=$id;


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

