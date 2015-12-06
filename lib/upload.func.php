<?php

/**
 * 构建上传文件信息
 * @return array
 */
function buildInfo(){
	if(!$_FILES){
		return ;
	}
	$i=0;
	foreach($_FILES as $v){
		//单文件
		if(is_string($v['name'])){
		    //把name,error,size,tmp，type放进数组
			$files[$i]=$v;
			$i++;
		}else{
			//多文件
			foreach($v['name'] as $key=>$val){
				$files[$i]['name']=$val;
				$files[$i]['size']=$v['size'][$key];
				$files[$i]['tmp_name']=$v['tmp_name'][$key];
				$files[$i]['error']=$v['error'][$key];
				$files[$i]['type']=$v['type'][$key];
				$i++;
			}
		}
	}
	return $files;
}


/**
 * 单文件封装
 * @param string $path
 * @param array $allowExt
 * @param number $maxSize
 * @param string $imgFlag
 * @return void|Ambigous <string, multi
 * type:, void, unknown>
 */

//function uploadFile($fileInfo,$path,$allowExt=array("gif","jpeg","png","jpg","wbmp"),$maxSize=2097152,$imgFlag=true){
function uploadFile($path,$allowExt=array("gif","jpeg","png","jpg","wbmp"),$maxSize=2097152,$imgFlag=true){
	$mes="";
	if(!file_exists($path)){
		mkdir($path,0755,true);
	}
	$i=0;
	$files=buildInfo();

	if(!($files && is_array($files))){
		return ;
	}
	foreach($files as $file){
		if($file['error']===UPLOAD_ERR_OK){
			$ext=getExt($file['name']);
			//检测文件的扩展名
			if(!in_array($ext,$allowExt)){
				exit("Not a file!");
			}
			//校验是否是一个真正的图片类型
			if($imgFlag){
				if(!getimagesize($file['tmp_name'])){
					exit("Not a real image type!");
				}
			}
			//上传文件的大小
			if($file['size']>$maxSize){
				exit("Err_MaxSize!");
			}
			if(!is_uploaded_file($file['tmp_name'])){
				exit("Not post by HTTP!");
			}
			$filename=getUniName().".".$ext;
			$destination=$path."/".$filename;

			if(move_uploaded_file($file['tmp_name'], $destination)){

				$file['name']=$filename;
				//discharge temporary file
				unset($file['tmp_name'],$file['size'],$file['type']);
				$uploadedFiles[$i]=$file;
				$i++;
			}
		}else{
			switch($file['error']){
					case 1:
						$mes="Error: upload_ERR_INI_SIZE";//UPLOAD_ERR_INI_SIZE
						break;
					case 2:
						$mes="UPLOAD_ERR_FORM_SIZE";			//UPLOAD_ERR_FORM_SIZE
						break;
					case 3:
						$mes="UPLOAD_ERR_PARTIAL";//UPLOAD_ERR_PARTIAL
						break;
				/*	case 4:
						$mes="UPLOAD_ERR_NO_FILE";//UPLOAD_ERR_NO_FILE
						break;
				*/
					case 6:
						$mes="UPLOAD_ERR_NO_TMP_DIR";//UPLOAD_ERR_NO_TMP_DIR
						break;
					case 7:
						$mes="UPLOAD_ERR_CANT_WRITE";//UPLOAD_ERR_CANT_WRITE;
						break;
					case 8:
						$mes="UPLOAD_ERR_EXTENSION";//UPLOAD_ERR_EXTENSION
						break;
				}
				echo $mes;
			}
	}
	return $uploadedFiles;
}
