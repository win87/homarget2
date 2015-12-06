<?php
/**
 * ������֤��
 * @param int $type
 * @param int $length
 * @return string
 */
function buildRandomString($type=1,$length=4){
	if ($type == 1) {
		$chars = join ( "", range ( 0, 9 ) );
	} elseif ($type == 2) {
		$chars = join ( "", array_merge ( range ( "a", "z" ), range ( "A", "Z" ) ) );
	} elseif ($type == 3) {
		$chars = join ( "", array_merge ( range ( "a", "z" ), range ( "A", "Z" ), range ( 0, 9 ) ) );
	}
	if ($length > strlen ( $chars )) {
		exit ( "�ַ������Ȳ���" );
	}
	$chars = str_shuffle ( $chars );
	return substr ( $chars, 0, $length );
}

/**
 * ����Ψһ�ַ���
 * @return string
 */
function getUniName(){
	return md5(uniqid(microtime(true),true));
}

/**
 * �õ��ļ�����չ��
 * @param string $filename
 * @return string
 */
function getExt($filename){
	return strtolower(end(explode(".",$filename)));
}
