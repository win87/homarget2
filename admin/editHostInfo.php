<?php

require_once '../include.php';
checkLogined();
$id=$_REQUEST['id'];
$sql="select * from tg_host_info where host_id='{$id}'";
$row=fetchOne($sql);


?>


<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
</head>
<body>
<h3>Edit User</h3>
<form action="doAdminAction.php?act=editHostInfo&id=<?php echo $id;?>" method="post">
<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td align="right">First Name</td>
		<td><input type="text" name="first_name" value="<?php echo $row['first_name'];?>" /></td>
	</tr>
	<tr>
		<td align="right">Last Name</td>
		<td><input type="text" name="last_name" value="<?php echo $row['last_name'];?>" /></td>
	</tr>
	<tr>
		<td align="right">Gender</td>
		<td>
		    <select class="form-control list-space-input" id="list-space-gender" name="gender" >
    			<option value="1" <?php echo $row['gender']=="1"?"selected":null;?> >Male</option>
    			<option value="0" <?php echo $row['gender']=="0"?"selected":null;?> >Female</option>
    		</select>
		</td>
	</tr>
	<tr>
		<td align="right">Age</td>
		<td><input type="text" name="age" value="<?php echo $row['age'];?>" /></td>
	</tr>
	<tr>
		<td align="right">Ethnicity</td>
		<td>
		    <select class="form-control list-space-input" name="ethnicity" id="ethnicity">
    		    <option value=""> - Select - </option>
    			<option value="Hispanic" <?php echo $row['ethnicity']=="Hispanic"?"selected":null;?> >Hispanic</option>
    			<option value="Asian" <?php echo $row['ethnicity']=="Asian"?"selected":null;?> >Asian</option>
    			<option value="White" <?php echo $row['ethnicity']=="White"?"selected":null;?> >White</option>
    			<option value="Black" <?php echo $row['ethnicity']=="Black"?"selected":null;?> >Black</option>
    			<option value="Pacific Islander" <?php echo $row['ethnicity']=="Pacific Islander"?"selected":null;?> >Pacific Islander</option>
    			<option value="Two or more races" <?php echo $row['ethnicity']=="Two or more races"?"selected":null;?> >Two or more races</option>
    			<option value="Other" <?php echo $row['ethnicity']=="Other"?"selected":null;?> >Other</option>
    		</select>
		</td>
	</tr>
	<tr>
		<td align="right">Occupation</td>
		<td>
		    <select name="occupation">
		        <option value=""> - Select - </option>
				<option value="1" <?php echo $row['occupation']=="1"?"selected":null;?> >Office worker</option>
				<option value="2" <?php echo $row['occupation']=="2"?"selected":null;?> >Manual worker</option>
				<option value="3" <?php echo $row['occupation']=="3"?"selected":null;?> >Self-employed</option>
				<option value="4" <?php echo $row['occupation']=="4"?"selected":null;?> >Executive/Professional</option>
				<option value="5" <?php echo $row['occupation']=="5"?"selected":null;?> >Housewife</option>
				<option value="6" <?php echo $row['occupation']=="6"?"selected":null;?> >Retired</option>
				<option value="7" <?php echo $row['occupation']=="7"?"selected":null;?> >Student</option>
				<option value="8" <?php echo $row['occupation']=="8"?"selected":null;?> >Other</option>
		    </select>

		</td>
	</tr>
	<tr>
		<td align="right">Language</td>
		<td><input type="text" name="language" value="<?php echo $row['language'];?>" style="width:60%;" /></td>
	</tr>
	<tr>
		<td align="right">Phone_code</td>
		<td><input type="text" name="phone_code" value="<?php echo $row['phone_code'];?>" /></td>
	</tr>
	<tr>
		<td align="right">Phone</td>
		<td><input type="text" name="phone" value="<?php echo $row['phone'];?>" /></td>
	</tr>
	<tr>
		<td align="right">Mobile_code</td>
		<td><input type="text" name="mobile_code" value="<?php echo $row['mobile_code'];?>" /></td>
	</tr>
	<tr>
		<td align="right">Mobile</td>
		<td><input type="text" name="mobile" value="<?php echo $row['mobile'];?>" /></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit"  value="Edit"/></td>
	</tr>

</table>
</form>
</body>
</html>