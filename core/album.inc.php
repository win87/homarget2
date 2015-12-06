<?php


/**
 *
 * @param unknown $arr
 */
function addAlbum($arr){
    insert("tg_house_img",$arr);
}

function addProfile($arr){
    insert("tg_host_info",$arr);
}


/**
 * 根据user_id（info_id）得到用户头像的路径
 * @param unknown $id
 * @return Ambigous <multitype:, multitype:>
 */
function getProfileImgById($id){
    $sql="select picture from tg_user_login where user_id='{$id}'";
    $row=fetchOne($sql);
    return $row;
}

