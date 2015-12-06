<?php
require_once '../include.php';
checkLogined();
$sql="select * from tg_user_login order by last_login desc";

$rows=fetchAll($sql);
if(!$rows){
    alertMes("sorry,the user doesn't exist!","addUser.php");
    exit;
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>User  </title>
<link rel="stylesheet" href="styles/backstage.css">

<script type ="text/javascript" src="../js/jquery-1.11.0.js"></script>
<script src="js/tg_admin.js"></script>

</head>

<body>
    <div class="details">
        <div class="details_operation clearfix">
            <div class="bui_select">
                <input type="button" value="Add user" class="add"  onclick="addUser()">
            </div>

        </div>
        <!--���-->
        <table class="table" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th width="10%">User ID</th>
                    <th width="7%">User type</th>
                    <th width="10%">Email</th>
                    <th width="10%">Join date</th>
                    <th width="10%">Last login</th>
                    <th width="10%">Activated</th>
                    <th>Edit | Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php  foreach($rows as $row):?>
                <tr>
                    <!-- -->
                    <td><input type="checkbox" id="c1" class="check"><label for="c1" class="label"><?php echo $row['user_id'];?></label></td>
                    <td><?php echo $row['user_type']==1?"Host Family":"Guest";?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['join_date'];?></td>
                    <td><?php echo $row['last_login'];?></td>
                    <td>
                 		<?php
                 		echo $row['active_flag']==0?"No":"Yes";
                 		?>
                    </td>
                    <td align="center"><input type="button" value="Edit" class="btn" onclick="editUser(<?php echo $row['user_id'];?>)"><input type="button" value="Delete" class="btn"  onclick="delUser(<?php echo $row['user_id'];?>)"></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</body>


</html>