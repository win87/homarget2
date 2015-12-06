<?php

require_once 'include.php';


//
if(isset($_POST['email'])){

    $email = mysql_real_escape_string($_POST['email']);

    if(!empty($email)){

        $query = mysql_query("select id from tg_user_login where email='{$email}'");
        $email_result = mysql_num_rows($query);

        if($email_result==1){
            echo " This email has been registerd";
        }
    }
}


//
if(isset($_POST['loginEmail'])){

    $loginEmail = mysql_real_escape_string($_POST['loginEmail']);

    if(!empty($loginEmail)){

        $query = mysql_query("select * from tg_user_login where email='{$loginEmail}'");
        $email_result = mysql_num_rows($query);

        if($email_result==0){
            echo "Invalid email address";
        }
    }
}


// ǰ�˼���¼pwd�Ƿ�Ϸ�
if(isset($_POST['password1'])){

    $password1 = sha1($_POST['password1']);

    if(!empty($password1)){

        $query = mysql_query("select * from tg_user_login where password1='{$password1}'");
        $pwd_res = mysql_num_rows($query);

        if($pwd_res == 0){
            echo "Invalid password";
        }
    }
}

// reset pwd
if(isset($_POST['oldPwd'])){

    $oldPwd = sha1($_POST['oldPwd']);

    if(!empty($oldPwd)){

        $query = mysql_query("select * from tg_user_login where password1='{$oldPwd}'");
        $pwd_res = mysql_num_rows($query);

        if($pwd_res == 0){
            echo "Invalid password";
        }
    }
}

?>