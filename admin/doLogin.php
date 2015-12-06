<?php
require_once '../include.php';

$email=addslashes($_POST['email']);
$password=sha1($_POST['password']);

$sql="select * from tg_admin where email='{$email}' and password='{$password}'";
$row=checkAdmin($sql);
//var_dump($row);

if($row){
    $_SESSION['email']=$row['email'];
    $_SESSION['admin_id']=$row['admin_id'];
    //alertMes("Login success!","index.php");
    header("location:index.php");
}else{
    alertMes("Login failed~ Please enter username and password","login.php");

}

