<?php
require_once '../include.php';
$id=$_REQUEST['id'];
checkLogined();
$sql="select email,password from tg_admin where admin_id='{$id}'";
$row=fetchOne($sql);
//print_r($id);exit;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
</head>
<body>
<h3>Edit Administrator</h3>
<form action="doAdminAction.php?act=editAdmin&id=<?php echo $id;?>" method="post">
<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td align="right">Email</td>
		<td><input type="email" name="email" value="<?php echo $row['email'];?>"/></td>
	</tr>
	<tr>
		<td align="right">Password</td>
		<td><input type="password" name="password"  value=""/></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit"  value="Edit"/></td>
	</tr>

</table>
</form>
</body>
</html>