<?php
require_once '../include.php';
$id=$_REQUEST['id'];
checkLogined();
$sql="select is_avail,start_day,end_day,min_days,max_days from tg_host_calendar where calendar_id='{$id}'";
$row=fetchOne($sql);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
</head>
<body>
<h3>Edit Calendar</h3>
<form action="doAdminAction.php?act=editCalendar&id=<?php echo $id;?>" method="post">
<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td align="right">Available</td>
		<td>
		<select name="is_avail">
		    <option value="0" <?php echo $row['is_avail']=="0"?"selected":null; ?> >No</option>
		    <option value="1" <?php echo $row['is_avail']=="1"?"selected":null; ?> >Yes</option>
		</select>
		</td>
	</tr>

	<tr>
		<td align="right">Start day</td>
		<td><input type="date" name="start_day" value="<?php echo $row['start_day'];?>"/></td>
	</tr>

	<tr>
		<td align="right">End day</td>
		<td><input type="date" name="end_day" value="<?php echo $row['end_day'];?>"/></td>
	</tr>

	<tr>
		<td align="right">Min. day</td>
		<td><input type="text" name="min_days"  value="<?php echo $row['min_days']; ?>"/></td>
	</tr>

	<tr>
		<td align="right">Max. day</td>
		<td><input type="text" name="max_days"  value="<?php echo $row['max_days']; ?>"/></td>
	</tr>

	<tr>
		<td colspan="2"><input type="submit"  value="Edit"/></td>
	</tr>

</table>
</form>
</body>
</html>