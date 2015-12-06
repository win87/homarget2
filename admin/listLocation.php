<?php
require_once '../include.php';
checkLogined();
$sql="select * from tg_house_location";

$rows=fetchAll($sql);

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
        <!--表格-->
        <table class="table" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th width="3%">ID</th>
                    <th width="3%">Location ID</th>
                    <th width="10%">Country</th>
                    <th width="20%">State</th>
                    <th width="10%">City</th>
                    <th width="10%">Street Name</th>
                    <th width="10%">Street #</th>
                    <th width="10%">ZIP</th>
                    <th>Edit | Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php  foreach($rows as $row):?>
                <tr>
                    <!--这里的id和for里面的c1 需要循环出来-->
                    <td><input type="checkbox" id="c1" class="check"><label for="c1" class="label"><?php echo $row['id'];?></label></td>
                    <td><input type="checkbox" id="c1" class="check"><label for="c1" class="label"><?php echo $row['location_id'];?></label></td>
                    <td><?php echo $row['country'] ;?></td>
                    <td><?php echo $row['administrative_area_level_1'] ;?></td>
                    <td><?php echo $row['locality'] ;?></td>
                    <td><?php echo $row['route'] ;?></td>
                    <td><?php echo $row['street_number'] ;?></td>
                    <td><?php echo $row['postal_code'] ;?></td>

                    <td align="center"><input type="button" value="Edit" class="btn" onclick="editLocation(<?php echo $row['location_id'];?>)"><input type="button" value="Delete" class="btn"  onclick="delLocation(<?php echo $row['location_id'];?>)"></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</body>

<script type="text/javascript">

	function addAdmin(){
		window.location="addAdmin.php";
	}
	function editLocation(id){
			window.location="editLocation.php?id="+id;
	}
	function delLocation(id){
			if(window.confirm("Ready to delete! Confirm?")){
				window.location="doAdminAction.php?act=delLocation&id="+id;
			}
	}
</script>


</html>