<?php
require_once '../include.php';
$id=$_REQUEST['id'];
checkLogined();
$sql="select country,address1,address2,city,state,zip from tg_house_location where location_id='{$id}'";
$row=fetchOne($sql);
print_r($row);
print_r($id);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
</head>
<body>
<h3>Edit Administrator</h3>
<form action="doAdminAction.php?act=editLocation&id=<?php echo $id;?>" method="post">
<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td align="right">Country</td>
		<td>
		<select name="country">
		    <option value="USA">USA</option>
		    <option value="China">China</option>
		</select>
		</td>
	</tr>
	<tr>
		<td align="right">Address 1</td>
		<td><input type="text" name="address1"  value="<?php echo $row['address1']; ?>" ></td>
	</tr>
	<tr>
		<td align="right">Address 2</td>
		<td><input type="text" name="address2"  value="<?php echo $row['address2']; ?>" ></td>
	</tr>
	<tr>
		<td align="right">City</td>
		<td><input type="text" name="city"  value="<?php echo $row['city']; ?>" ></td>
	</tr>
	<tr>
		<td align="right">State</td>
		<td><input type="text" name="state"  value="<?php echo $row['state']; ?>" ></td>
	</tr>
	<tr>
		<td align="right">ZIP</td>
		<td><input type="text" name="zip"  value="<?php echo $row['zip']; ?>" ></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit"  value="Edit"/></td>
	</tr>

</table>
</form>
</body>
</html>