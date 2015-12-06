<?php
require_once '../include.php';
checkLogined();
$sql="select * from tg_house_location";
$rows=fetchAll($sql);
// if(!$rows){
//     alertMes("sorry,the user doesn't exist!","addUser.php");
//     exit;
// }
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>User  </title>
<link rel="stylesheet" href="styles/backstage.css">
</head>

<body>
    <div class="details">
        <div class="details_operation clearfix">
            <div class="bui_select">
                <input type="button" value="Add user" class="add"  onclick="addUser()">
            </div>

        </div>
        <!--表格-->
        <table class="table" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th width="5%">ID</th>
                    <th width="5%">Location_ID</th>
                    <th width="10%">Country</th>
                    <th width="20%">Address 1</th>
                    <th width="10%">Address 2</th>
                    <th width="10%">City</th>
                    <th width="10%">State</th>
                    <th width="10%">Zip</th>
                    <th>Edit | Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php  foreach($rows as $row):?>
                <tr>
                    <!--这里的id和for里面的c1 需要循环出来-->
                    <td><input type="checkbox" id="c1" class="check"><label for="c1" class="label"><?php echo $row['id'];?></label></td>
                    <td><?php echo $row['user_type']==1?"Host Family":"Guest";?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['join_date'];?></td>
                    <td>
                 		<?php
                 		echo $row['active_flag']==0?"Not actived":"Actived";
                 		?>
                    </td>
                    <td align="center"><input type="button" value="Edit" class="btn" onclick="editUser(<?php echo $row['user_id'];?>)"><input type="button" value="Delete" class="btn"  onclick="delUser(<?php echo $row['user_id'];?>)"></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</body>
<script type="text/javascript">

	function addUser(){
		window.location="addUser.php";
	}
	function editUser(id){
			window.location="editUser.php?id="+id;
	}
	function delUser(id){
			if(window.confirm("Ready to delete, confirm?")){
				window.location="doAdminAction.php?act=delUser&id="+id;
			}
	}
</script>
</html>