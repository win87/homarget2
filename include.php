<?php


require_once 'startsession.php';
// if(!isset($_SESSION)){
//     session_start();
// }

// ���������Ļ�����վ�򲻿� internal error
//header("content/text charset=utf8");


define("ROOT",dirname(__FILE__));
set_include_path(".".PATH_SEPARATOR.ROOT."/lib".PATH_SEPARATOR.ROOT."/core".PATH_SEPARATOR.ROOT."/configs".PATH_SEPARATOR.get_include_path());

require_once 'auth.inc.php';
require_once 'mysql.func.php';
require_once 'image.func.php';
require_once 'common.func.php';
require_once 'string.func.php';
require_once 'page.func.php';
require_once "configs.php";
require_once 'admin.inc.php';
require_once 'cate.inc.php';
require_once 'house.inc.php';
require_once 'album.inc.php';
require_once 'upload.func.php';
require_once 'user.inc.php';
//require_once 'search.php';
connect();
