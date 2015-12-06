<?php

require_once '../include.php';
require_once 'header.php';
checkLogined();

$id=$_REQUEST['id'];

$sql="select * from tg_user_login as l
      join tg_guest_request r on l.user_id=r.guest_id
        where l.id={$id}";
$row=fetchOne($sql);
$row['preferred_services']=explode(",", $row['preferred_services']);

//$houseInfo_cal['update_time']=date("Y-m-d H:i:s");
$user_id=$row['user_id'];


?>


<h3>Edit Guest Request</h3>
<form action="doAdminAction.php?act=editGuestRequest&id=<?php echo $user_id;?>" method="post" enctype="multipart/form-data">
<table width="70%"  border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">

    <tr>
        <td align="right">Show / unShow</td>
        <td>
            <select class="form-control" name="is_avail" >
                <option value=1 <?php echo $row['is_avail']==1?"selected":null;?> >Yes</option>
                <option value=0 <?php echo $row['is_avail']==0?"selected":null;?> >No</option>
            </select>
        </td>
    </tr>

    <tr>
        <td align="right">Enter full address here</td>
        <td><input type="text" style="width:100%" placeholder="e.g. 1600 Moutain View CA 94600" id="geocomplete" onblur="modify_add();"></td>
    </tr>

    <tr>
		<td align="right">Country</td>
		<td><input type="text" name="country" id="geocomplete" value="<?php echo $row['country']?$row['country']:null; ?>" ></td>
	</tr>

	<tr>
		<td align="right">Street #</td>
		<td><input type="text" name="street_number" value="<?php echo $row['street_number']?$row['street_number']:null; ?>" ></td>
	</tr>

	<tr>
		<td align="right">Address</td>
		<td><input type="text" name="route" value="<?php echo $row['route']?$row['route']:null; ?>" ></td>
	</tr>

	<tr>
		<td align="right">City</td>
		<td><input type="text" name="locality" value="<?php echo $row['locality']?$row['locality']:null; ?>" ></td>
	</tr>

	<tr>
		<td align="right">State</td>
		<td>
		    <input type="text" name="administrative_area_level_1" value="<?php echo $row['administrative_area_level_1']?$row['administrative_area_level_1']:null; ?>" >
		</td>
	</tr>

	<tr>
		<td align="right">ZIP</td>
		<td><input type="text" name="postal_code" value="<?php echo $row['postal_code']?$row['postal_code']:null; ?>" ></td>
	</tr>

	<tr>
        <td align="right">Lat</td>
        <td><input type="text" name="lat" id="lat" value="<?php echo $row['lat']?$row['lat']:null; ?>" /></td>
    </tr>

    <tr>
            <td align="right">Lng</td>
            <td><input type="text" name="lng" id="lng" value="<?php echo $row['lng']?$row['lng']:null; ?>" /></td>
        </tr>

	<tr>
		<td align="right">Arrival date</td>
		<td>
		    <input type="text" class="from" id="from" name="arrival" value="<?php echo $row['arrival']?$row['arrival']:null; ?>" placeholder="mm/dd/yyyy" />
		</td>
	</tr>

	<tr>
		<td align="right">Departure date</td>
		<td><input type="text" class="to" id="to" name="departure" value="<?php echo $row['departure']?$row['departure']:null; ?>" placeholder="mm/dd/yyyy" /></td>
	</tr>

	<tr>
		<td align="right">Services</td>
		<td>
		    <div class="scrollField">
				<div class="checkbox">
				   <label><input type="checkbox" value=1 name="preferred_services[]" checked="checked" <?php if(isset($row['preferred_services']) && is_array($row['preferred_services']) && in_array(1, $row['preferred_services'])) echo 'checked="checked"'; ?> >Meals</label>
				</div>
				<div class="checkbox">
				   <label><input type="checkbox" value=2 name="preferred_services[]" <?php if(isset($row['preferred_services']) && is_array($row['preferred_services']) && in_array(2, $row['preferred_services'])) echo 'checked="checked"'; ?> >transportation</label>
				</div>
				<div class="checkbox">
				   <label><input type="checkbox" value=3 name="preferred_services[]" <?php if(isset($row['preferred_services']) && is_array($row['preferred_services']) && in_array(3, $row['preferred_services'])) echo 'checked="checked"'; ?> >Laundry</label>
				</div>
				<div class="checkbox">
				   <label><input type="checkbox" value=4 name="preferred_services[]" <?php if(isset($row['preferred_services']) && is_array($row['preferred_services']) && in_array(4, $row['preferred_services'])) echo 'checked="checked"'; ?> >Room cleaning</label>
				</div>
				<div class="checkbox">
				   <label><input type="checkbox" value=5 name="preferred_services[]" <?php if(isset($row['preferred_services']) && is_array($row['preferred_services']) && in_array(5, $row['preferred_services'])) echo 'checked="checked"'; ?> >Internet</label>
				</div>
				<div class="checkbox">
				   <label><input type="checkbox" value=6 name="preferred_services[]" <?php if(isset($row['preferred_services']) && is_array($row['preferred_services']) && in_array(6, $row['preferred_services'])) echo 'checked="checked"'; ?> >Language Lesson</label>
				</div>
				<div class="checkbox">
				   <label><input type="checkbox" value=7 name="preferred_services[]" <?php if(isset($row['preferred_services']) && is_array($row['preferred_services']) && in_array(7, $row['preferred_services'])) echo 'checked="checked"'; ?> >Airport pick-up</label>
				</div>
				<div class="checkbox">
                   <label><input type="checkbox" value=8 name="preferred_services[]" <?php if(isset($row['preferred_services']) && is_array($row['preferred_services']) && in_array(8, $row['preferred_services'])) echo 'checked="checked"'; ?> >Wifi</label>
                </div>
                <div class="checkbox">
                   <label><input type="checkbox" value=9 name="preferred_services[]" <?php if(isset($row['preferred_services']) && is_array($row['preferred_services']) && in_array(9, $row['preferred_services'])) echo 'checked="checked"'; ?> >Legal guardianship</label>
                </div>
			</div>
		</td>
	</tr>

	<tr>
		<td align="right">Monthly price</td>
		<td><input type="text" name="m_price" value=<?php echo $row['m_price'] ;?> ></td>
	</tr>

	<tr>
		<td align="right">Daily price</td>
		<td><input type="text" name="d_price" value=<?php echo $row['d_price'] ;?> ></td>
	</tr>

	<tr>
		<td align="right">Introduction</td>
		<td>
		    <textarea rows="6" cols="100" name="intro" placeholder="e.g. Your background, interest, field of study and etc." ><?php echo $row['intro']?$row['intro']:null; ?></textarea>
		</td>
	</tr>

<!--  	<tr>
		<td align="right">Images</td>
		<td>
			<a href="javascript:void(0)" id="selectFileBtn">Add images</a>
			<div id="attachList" class="clear"></div>
		</td>
	</tr>   -->
	<tr>
		<td colspan="2"><input type="submit" value="Edit"/> | <a href="listGuest.php">Back</a></td>
	</tr>
</table>
</form>
</body>
</html>