<?php

require_once 'include.php';

$sql="select lat,lng from tg_house_location where location_id={$_SESSION['user_id']}";
$row=fetchOne($sql);
print_r($row);
echo json_encode($row);


?>