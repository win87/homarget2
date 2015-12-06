<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Homarget Management System</title>
</head>
<body>
<h3>Add Guest</h3>
<form action="doAdminAction.php?act=addGuest" method="post" enctype="multipart/form-data">
<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
<tr>
    <td align="right">Admin's Email</td>
    <td><input type="email" name="email" /></td>
</tr>
<tr>
    <td align="right">User type</td>
    <td>
    <input type="radio" checked="checked" name="user_type" value="2" />Guest
    </td>
</tr>
<tr>
    <td align="right">Email verify</td>
    <td>
    <input type="radio" checked="checked" name="active_flag" value="1" />Yes
    <input type="radio" name="active_flag" value="0" />No
    </td>
</tr>
<tr>
<td align="right">Profile photo</td>
<td><input type="file" name="picture" /></td>
</tr>
<tr>
<td colspan="2"><input type="submit"  value="Add Guest"/></td>
</tr>

</table>
</form>
</body>
</html>