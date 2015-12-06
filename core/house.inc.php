<?php
/**
 * ��������Ա�˺�ͨ��user_id�����Ϣ
 * @return string
 */
function addHouse(){
	$arr=$_POST;
	$arr['pub_time']=date('Y-m-d H:i:s');
	//$path="../uploads";

	//��������һ��user_id����Ϊ�ù���Աװ�Ź������û���
	$user_id=$arr['user_id'];
    print_r($user_id);exit;
	$path="uploads/house_images/user_id_".$user_id;

	$uploadFiles=uploadFile($path);

	if(is_array($uploadFiles) && $uploadFiles){
		foreach($uploadFiles as $key=>$uploadFile){
			thumb($path."/".$uploadFile['name'],"../image_50/".$uploadFile['name'],50,50);
// 			thumb($path."/".$uploadFile['name'],"../image_220/".$uploadFile['name'],220,220);
// 			thumb($path."/".$uploadFile['name'],"../image_350/".$uploadFile['name'],350,350);
// 			thumb($path."/".$uploadFile['name'],"../image_800/".$uploadFile['name'],800,800);
		}
	}
	$res=insert("tigris_house_info",$arr);
	//print_r($res);exit;
	//����õ�����tigris_user_profile���primary key(house_id), �Դ������������?��ÿһ��house����Ψһalbum
	$album_id=getInsertId();
	//print_r($album_id);exit;
	if($res && $album_id){
		foreach($uploadFiles as $uploadFile){
			$arr1['album_id']=$album_id;
			$arr1['img_path']=$uploadFile['name'];
			addAlbum($arr1);
		}

		$mes="<p>Add success!</p><a href='addHouse.php' target='mainFrame'>Add more</a>|<a href='listHouse.php' target='mainFrame'>View house list</a>";
	}else{
		foreach($uploadFiles as $uploadFile){
// 			if(file_exists("../image_800/".$uploadFile['name'])){
// 				unlink("../image_800/".$uploadFile['name']);
// 			}
			if(file_exists("../image_50/".$uploadFile['name'])){
				unlink("../image_50/".$uploadFile['name']);
			}
// 			if(file_exists("../image_220/".$uploadFile['name'])){
// 				unlink("../image_220/".$uploadFile['name']);
// 			}
// 			if(file_exists("../image_350/".$uploadFile['name'])){
// 				unlink("../image_350/".$uploadFile['name']);
// 			}
		}
		$mes="<p>Failed!</p><a href='addHouse.php' target='mainFrame'>Add</a>";
	}
	return $mes;
}
/**
 *�༭��Ʒ
 * @param int $id
 * @return string
 */
function editHouse($id){

	$arr=$_POST;
	$arr['update_time']=date("Y-m-d H:i:s");
	$sql="select house_id from tg_host_house where id={$id}";
	$row=fetchOne($sql);

	//��house_id������album_id
	$album_id=$row['house_id'];
	$path="../uploads/House_Album/user_id_".$album_id;

    //����û�жϾ��ϴ�ͼƬ���ļ��У�ͼƬ��ݲ�һ���ɹ�������ݿ�
	$uploadFiles=uploadFile($path);

	if(is_array($uploadFiles)&&$uploadFiles){
		foreach($uploadFiles as $key=>$uploadFile){
			thumb($path."/".$uploadFile['name'],"../image_50/user_id_".$album_id."/".$uploadFile['name'],50,50);
		}
	}

	//����host_house�����
	$where="house_id={$id}";
	$res=update("tg_host_house",$arr,$where); //ע�⣺����ֻ�ܸ�����ݱ������е��ֶΣ����post�����ݸ�table����ֶβ�ƥ�䣬����ʧ�ܣ�����
	$house_id=$row['house_id'];

	//����ȡ�� house_id ����Ӧ album_id
	$sql_img="select i.album_id from tg_house_img as i left join tg_host_house h on h.house_id=i.album_id where i.album_id={$house_id}";
	$row_img=fetchOne($sql_img);

	//��img_path ��ӵ� tg_house_img��
	if($res && $house_id){
		if($uploadFiles && is_array($uploadFiles)){
			foreach($uploadFiles as $uploadFile){
				$arr1['album_id']=$house_id;
				$arr1['img_path']=$uploadFile['name'];
				//print_r($arr1['img_path']);exit;
				addAlbum($arr1);
			}
		}

		$mes="<p>Edit success!</p><a href='listHouse.php' target='mainFrame'>View house list</a>";

	}else{
    	if(is_array($uploadFiles) && $uploadFiles){
    		foreach($uploadFiles as $uploadFile){
    			if(file_exists("../image_50/user_id_".$_SESSION['user_id']."/".$uploadFile['name'])){
    				unlink("../image_50/user_id_".$_SESSION['user_id']."/".$uploadFile['name']);
    			}
    			if(file_exists("../uploads/House_Album/user_id_".$_SESSION['user_id']."/".$uploadFile['name'])){
    			    unlink("../uploads/House_Album/user_id_".$_SESSION['user_id']."/".$uploadFile['name']);
    			}
    		}
    	}
    		$mes="<p>Failed!</p><a href='listHouse.php' target='mainFrame'>Edit again</a>";
	}

	return $mes;
}


/**
 * Edit calendar
 * @param  $id
 * @return string
 */
function editCalendar($id){
    $arr=$_POST;
    //print_r($arr);
    if(update("tg_host_calendar",$arr,"calendar_id={$id}")){
        $mes="<h3>Edit Success!</h3><br/><a href='listCalendar.php'> View Calendar lists </a>";
    }else{
        $mes="<h3>Edit Failed!</h3><br/><a href='listCalendar.php'> Edit </a>";
    }
    return $mes;
}


/**
 * Edit Location
 * @param $id
 * @return string
 */
function editLocation($id){
    $arr=$_POST;
    //print_r($arr);
    if(update("tg_house_location",$arr,"location_id={$id}")){
        $mes="<h3>Edit Success!</h3><br/><a href='listLocation.php'> View Location lists </a>";
    }else{
        $mes="<h3>Edit Failed!</h3><br/><a href='listLocation.php'> Edit </a>";
    }
    return $mes;
}


function editServices($id){
    $arr=$_POST;
    @$common=$arr['common'];
    @$extras=$arr['extras'];
    @$safety=$arr['safety'];
    @$arr['common']=implode(",", $common);
    @$arr['extras']=implode(",", $extras);
    @$arr['safety']=implode(",", $safety);
    print_r($arr);

    if(update("tg_host_services",$arr,"services_id={$id}")){
        $mes="<h3>Edit Success!</h3><br/><a href='listServices.php'> View Services lists </a>";
    }else{
        $mes="<h3>Edit ��ailed!</h3><br/><a href='listServices.php'> Edit </a>";
    }
}


/**
 *
 * @param unknown $id
 * @return string
 */
function delHouse($id){
	$where="id=$id";
	$res=delete("homarget_house",$where);
	$houseImgs=getAllImgsByHouseId($id);
	if($houseImgs && is_array($houseImgs)){
		foreach($houseImgs as $houseImg){
			if(file_exists("uploads/".$houseImg['img_path'])){
				unlink("uploads/".$proImg['img_path']);
			}
			if(file_exists("../image_50/".$houseImg['img_path'])){
				unlink("../image_50/".$proImg['img_path']);
			}
// 			if(file_exists("../image_220/".$houseImg['img_path'])){
// 				unlink("../image_220/".$proImg['img_path']);
// 			}
// 			if(file_exists("../image_350/".$houseImg['img_path'])){
// 				unlink("../image_350/".$proImg['img_path']);
// 			}
// 			if(file_exists("../image_800/".$houseImg['img_path'])){
// 				unlink("../image_800/".$houseImg['img_path']);
// 			}

		}
	}
	$where1="album_id={$id}";
	$res1=delete("tigris_album",$where1);
	if($res && $res1){
		$mes="Delete success!<br/><a href='listHouse.php' target='mainFrame'>View house list</a>";
	}else{
		$mes="Failed!<br/><a href='listHouse.php' target='mainFrame'>Delete</a>";
	}
	return $mes;
}


/**
 * �õ���Ʒ��������Ϣ
 * @return array
 */
function getAllHousesByAdmin(){
	$sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName from homarget_house as p join imooc_cate c on p.cId=c.id";
	$rows=fetchAll($sql);
	return $rows;
}

/**
 *�����Ʒid�õ���ƷͼƬ
 * @param int $id
 * @return array
 */
function getAllImgsByHouseId($id){
    //��������
	$sql="select i.album_id,i.img_path from tg_house_img i where album_id={$id} order by id desc";
	$rows=fetchAll($sql);
	return $rows;
}

/**
 * ���id�õ�
 * @param int $id
 * @return array
 */
function getHouseById($id){
	//$sql="select * from tg_host_house where house_id={$id}";
    //$sql="select * from tg_host_house as h join tg_house_img i on house_id=i.album_id where h.house_id={$id}";
    $sql="select * from tg_host_house as h join tg_host_calendar c on house_id=c.calendar_id where h.house_id={$id}";
    $row=fetchOne($sql);
	return $row;
}


/**
 * @param int $cid
 * @return array
 */
function checkProExist($cid){
	$sql="select * from homarget_house where cId={$cid}";
	$rows=fetchAll($sql);
	return $rows;
}

/**
 * fetch all houses
 * @return array
 */
function getAllHouses(){
	$sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName,p.cId from homarget_house as p join imooc_cate c on p.cId=c.id ";
	$rows=fetchAll($sql);
	return $rows;
}

/**
 * @param int $cid
 * @return Array
 */
function getProsByCid($cid){
	$sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName,p.cId from homarget_house as p join imooc_cate c on p.cId=c.id where p.cId={$cid} limit 4";
	$rows=fetchAll($sql);
	return $rows;
}

/**
 * @param int $cid
 * @return array
 */
function getSmallProsByCid($cid){
	$sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName,p.cId from homarget_house as p join imooc_cate c on p.cId=c.id where p.cId={$cid} limit 4,4";
	$rows=fetchAll($sql);
	return $rows;
}

/**
 * @return array
 */
function getHouseInfo(){
	$sql="select house_id,house_title from tg_host_house order by house_id asc";
	$rows=fetchAll($sql);
	return $rows;
}

function unShowHouse(){
    $arr=$_POST;
    $start=$arr['start_day'];
    $timestamp_start=date('Y-m-d',strtotime($start));
    $arr['start_day']=$timestamp_start;
    $res=update("tg_host_calendar",$arr,"calendar_id='{$_SESSION['user_id']}'");
    $sql="select is_avail from tg_host_calendar where calendar_id='{$_SESSION['user_id']}'";
    $row=fetchOne($sql);
    switch ($row['is_avail']){
        case 1:
            echo "<h5>Your listing has been set to <b style='color:rgb(92,184,92);'>Visable</b>.</h5>";
            break;
        case 0;
            echo "<h5>Your listing has been set to <b style='color:red;'>Disabled</b>.</h5>";
            break;
    }
}

function unShowRequest(){
    $arr=$_POST;
    $arrival=$arr['arrival'];
    $departure=$arr['departure'];
    $timestamp_arrival=date('Y-m-d',strtotime($arrival));
    $arr['arrival']=$timestamp_arrival;
    $timestamp_departure=date('Y-m-d',strtotime($departure));
    $arr['departure']=$timestamp_departure;
    $res=update("tg_guest_request",$arr,"guest_id='{$_SESSION['user_id']}'");
    $sql="select is_avail from tg_guest_request where guest_id='{$_SESSION['user_id']}'";
    $row=fetchOne($sql);
    switch ($row['is_avail']){
        case 1:
            echo "<h5>Your listing has been set to <b style='color:rgb(92,184,92);'>Visable</b>.</h5>";
            break;
        case 0;
            echo "<h5>Your listing has been set to <b style='color:red;'>Disabled</b>.</h5>";
            break;
    }
}