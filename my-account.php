
<?php

    require_once 'include.php';

    @$sql="select user_type from tg_user_login where user_id='{$_SESSION['user_id']}'";
    $row=fetchOne($sql);
    $type=$row['user_type'];

    switch ($type){
        case 1:
            require_once 'review-profile.php';
            break;
        case 2:
            require_once 'review-request.php';
        default:
            require_once 'index.php';
    }

?>