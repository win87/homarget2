<?php

/**
 * 添加分类的操作
* @return string
*/
function addCate(){
    $arr=$_POST;
    if(insert("tigris_user_type",$arr)){
        $mes="Add success!<br/><a href='addCate.php'>Add more</a>|<a href='listCate.php'>View list</a>";
    }else{
        $mes="Add failed！<br/><a href='addCate.php'>Add again</a>|<a href='listCate.php'>View list</a>";
    }
    return $mes;
}

/**
 * 根据ID得到指定分类信息
 * @param int $id
 * @return array
 */
function getCateById($id){
    $sql="select type_id,type from tigris_user_type where type_id={$id}";
    return fetchOne($sql);
}

/**
 * 修改分类的操作
 * @param string $where
 * @return string
 */
function editCate($where){
    $arr=$_POST;
    if(update("tigris_user_type", $arr,$where)){
        $mes="Edit success!<br/><a href='listCate.php'>View list</a>";
    }else{
        $mes="Edit failed!<br/><a href='listCate.php'>Edit</a>";
    }
    return $mes;
}

/**
 *删除分类
 * @param string $where
 * @return string
 */
function delCate($id){
    $res=checkProExist($id);
    if(!$res){
        $where="type_id=".$id;
        if(delete("tigris_user_type",$where)){
            $mes="Deleted success!<br/><a href='listCate.php'>View list</a>|<a href='addCate.php'>Add user type</a>";
        }else{
            $mes="Deleted failed！<br/><a href='listCate.php'>View list</a>";
        }
        return $mes;
    }else{
        alertMes("Can't delelte, please delete the content in the cate first!", "listPro.php");
    }
}

/**
 * 得到所有分类
 * @return array
 */
function getAllCate(){
    $sql="select type_id,type from tigris_user_type";
    $rows=fetchAll($sql);
    return $rows;
}



