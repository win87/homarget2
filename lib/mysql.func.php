<?php
/**
 * Connect to database
 * @return resource
 */
function connect(){
	$link=mysql_connect(HOST,USER,PWD) or die("Error:".mysql_errno().":".mysql_error());
	mysql_set_charset(DB_CHARSET);
	mysql_select_db(DATABASE) or die("Connect MySQL failed!");
	return $link;
}

/**
 * Do an insert query
 * @param string $table
 * @param array $array
 * @return number
 */
function insert($table,$array){
    global $link;
	//$where=$where==null?null:" where ".$where;
	$keys=join(",",array_keys($array));
	$vals="'".join("','",array_values($array))."'";
	//$sql="delete from {$table} {$where}";
	$sql="insert {$table}($keys) values({$vals})";
	mysql_query($sql);
	return mysql_insert_id();
	mysql_close($link);
}


/**
 * Do a upadte query
 * @param string $table
 * @param array $array
 * @param string $where
 * @return number
 */
function update($table,$array,$where=null){
    global $link;
    $str="";
	foreach($array as $key=>$val){
	    //update homarget_admin set username='king',passwor='king' where id=1
	    //�ж��Ƿ��ǵ�һ��$key=>val������ǣ�ƴ�Ӳ���Ҫ�����������磬��һ��$key=>val(username=��king��)������Ҫ��,�����ڶ��ԣ�����Ҫ�ˣ�
 		if($str==null){
 			$sep="";
 		}else{
 			$sep=",";
 		}
 		$str.=$sep.$key."='".$val."'";
	}
 		$sql="update {$table} set {$str} ".($where==null?null:" where ".$where);
 		$result=mysql_query($sql);
		//print_r($sql);exit;
		//var_dump(mysql_affected_rows());exit;
		if($result){
			return mysql_affected_rows();
		}else{
			return false;
		}
	mysql_close($link);
}

/**
 * Do a delete query
 * @param string $table
 * @param string $where
 * @return number
 */
function delete($table,$where=null){
    global $link;
	$where=$where==null?null:" where ".$where;
	$sql="delete from {$table} {$where}";
	mysql_query($sql);
	return mysql_affected_rows();
	mysql_close($link);
}

/**
 * fetch one specific record
 * @param string $sql
 * @param string $result_type
 * @return multitype:
 */
function fetchOne($sql,$result_type=MYSQL_ASSOC){
	$result=mysql_query($sql);
	@$row=mysql_fetch_array($result,$result_type);
	return $row;
}

/**
 * fetch all records
 * @param string $sql
 * @param string $result_type
 * @return multitype:
 */
function fetchAll($sql,$result_type=MYSQL_ASSOC){
	$result=mysql_query($sql);
	while(@$row=mysql_fetch_array($result,$result_type)){
		$rows[]=$row;
	}
	return @$rows;
}

/**
 * fecth number of rows
 * @param unknown_type $sql
 * @return number
 */
function getResultNum($sql){
	$result=mysql_query($sql);
	return mysql_num_rows($result);
}

/**
 *  ȡ����һ�� INSERT ��������� ID
 * @return number
 */
function getInsertId(){
	return mysql_insert_id();
}
