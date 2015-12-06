<?php
require_once '../include.php';
checkLogined();
$id=$_REQUEST['id'];
$sql="select * from tg_user_login where user_id='{$id}'";
$row=fetchOne($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
</head>
<body>
<h3>Edit User</h3>
<form action="doAdminAction.php?act=editUser&id=<?php echo $id;?>" method="post">
<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td align="right">Email</td>
		<td><input type="text" name="email" value="<?php echo $row['email'];?>" placeholder="<?php echo $row['email'];?>" /></td>
	</tr>
	<tr>
		<td align="right">password</td>
		<td><input type="password" name="password1" /></td>
	</tr>
	<tr>
		<td align="right">Re-password</td>
		<td><input type="password" name="password2" /></td>
	</tr>
	<tr>
		<td align="right">User type</td>
		<td>
		<input type="radio" name="user_type" value="1" <?php echo $row['user_type']==1?"checked='checked'":null;?> />Host
		<input type="radio" name="user_type" value="2" <?php echo $row['user_type']==2?"checked='checked'":null;?> />Guest
		<input type="radio" name="user_type" value="3" <?php echo $row['user_type']==3?"checked='checked'":null;?> />placeholder
		</td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit"  value="Edit"/></td>
	</tr>

</table>
</form>
</body>
</html>