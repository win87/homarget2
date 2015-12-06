<?php
require_once '../include.php';
$id=$_REQUEST['id'];
checkLogined();
$sql="select * from tg_host_services where services_id='{$id}'";
$row=fetchOne($sql);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
</head>
<body>
<h3>Edit Administrator</h3>
<form action="doAdminAction.php?act=editServices&id=<?php echo $id;?>" method="post">

<table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
	<tr>
		<td align="right">Provide meals</td>
		<td>
		<select name="meals">
		    <option value="1" <?php echo $row['meals']=="1"?"selected":Null; ?> >Yes</option>
		    <option value="0" <?php echo $row['meals']=="0"?"selected":Null; ?> >No</option>
		</select>
		</td>
	</tr>

	<tr>
		<td align="right">Commute</td>
		<td>
		<select name="commute">
		    <option value="1" <?php echo $row['commute']=="1"?"selected":Null; ?> >Yes</option>
		    <option value="0" <?php echo $row['commute']=="0"?"selected":Null; ?> >No</option>
		</select>
		</td>
	</tr>

	<tr>
		<td align="right">Laundry</td>
		<td>
		<select name="laundry">
		    <option value="1" <?php echo $row['laundry']=="1"?"selected":Null; ?> >Yes</option>
		    <option value="0" <?php echo $row['laundry']=="0"?"selected":Null; ?> >No</option>
		</select>
		</td>
	</tr>

	<tr>
		<td align="right">Airport commute</td>
		<td>
		<select name="airport_commute">
		    <option value="1" <?php echo $row['airport_commute']=="1"?"selected":Null; ?> >Yes</option>
		    <option value="0" <?php echo $row['airport_commute']=="0"?"selected":Null; ?> >No</option>
		</select>
		</td>
	</tr>

    <tr>
		<td align="right">Lesson</td>
		<td>
		<select name="lesson">
		    <option value="1" <?php echo $row['laundry']=="1"?"selected":Null; ?> >Yes</option>
		    <option value="0" <?php echo $row['laundry']=="0"?"selected":Null; ?> >No</option>
		</select>
		</td>
	</tr>

	<tr>
		<td align="right">Common</td>
		<td>
		    <input type="checkbox" name="common[]" value="<?php echo $row['common']=="Tv"?"checked":null; ?>" />TV
		    <input type="checkbox" name="common[]" value="<?php echo $row['common']=="Air_condition"?"checked":null; ?>" />Air Conditioning
		    <input type="checkbox" name="common[]" value="<?php echo $row['common']=="Heating"?"checked":null; ?>" />Heating
		    <input type="checkbox" name="common[]" value="<?php echo $row['common']=="Kitchen"?"checked":null; ?>" />Kitchen
		    <input type="checkbox" name="common[]" value="<?php echo $row['common']=="Internet"?"checked":null; ?>" />Internet
		    <input type="checkbox" name="common[]" value="<?php echo $row['common']=="wifi"?"checked":null; ?>" />Wifi
		    <input type="checkbox" name="common[]" value="<?php echo $row['common']=="7"?"checked":null; ?>" />7
		    <input type="checkbox" name="common[]" value="<?php echo $row['common']=="8"?"checked":null; ?>" />8
		</td>
	</tr>

	<tr>
		<td align="right">Extras</td>
		<td>
		    <input type="checkbox" name="extras[]" value="<?php echo $row['extras']=="Hot"?"checked":null; ?>" />Hot
		    <input type="checkbox" name="extras[]" value="<?php echo $row['extras']=="Tub"?"checked":null; ?>" />Tub
		    <input type="checkbox" name="extras[]" value="<?php echo $row['extras']=="Pool"?"checked":null; ?>" />Pool
		    <input type="checkbox" name="extras[]" value="<?php echo $row['extras']=="Dryer"?"checked":null; ?>" />Dryer
		    <input type="checkbox" name="extras[]" value="<?php echo $row['extras']=="Free Parking Premises"?"checked":null; ?>" />Free Parking Premises
		    <input type="checkbox" name="extras[]" value="<?php echo $row['extras']=="Gym"?"checked":null; ?>" />Gym
		    <input type="checkbox" name="extras[]" value="<?php echo $row['extras']=="Elevator in Building"?"checked":null; ?>" />Elevator in Building
		    <input type="checkbox" name="extras[]" value="<?php echo $row['extras']=="Indoor Fireplace"?"checked":null; ?>" />Indoor Fireplace
		</td>
	</tr>

	<tr>
		<td align="right">Safety</td>
		<td>
		    <input type="checkbox" name="safety[]" value="<?php echo $row['safety']=="Smoke Detector"?"checked":null; ?>" />Smoke Detector
		    <input type="checkbox" name="safety[]" value="<?php echo $row['safety']=="Carbon Monoxide Detector"?"checked":null; ?>" />Carbon Monoxide Detector
		    <input type="checkbox" name="safety[]" value="<?php echo $row['safety']=="First Aid Kit"?"checked":null; ?>" />First Aid Kit
		    <input type="checkbox" name="safety[]" value="<?php echo $row['safety']=="Safety Card"?"checked":null; ?>" />Safety Card
		    <input type="checkbox" name="safety[]" value="<?php echo $row['safety']=="Fire Extinguisher"?"checked":null; ?>" />Fire Extinguisher
		    <input type="checkbox" name="safety[]" value="<?php echo $row['safety']=="6"?"checked":null; ?>" />6
		    <input type="checkbox" name="safety[]" value="<?php echo $row['safety']=="7"?"checked":null; ?>" />7
		    <input type="checkbox" name="safety[]" value="<?php echo $row['safety']=="8"?"checked":null; ?>" />8
		</td>
	</tr>

	<tr>
		<td colspan="2"><input type="submit"  value="Edit"/></td>
	</tr>

</table>
</form>
</body>
</html>