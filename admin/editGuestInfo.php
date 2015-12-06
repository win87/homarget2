<?php

require_once '../include.php';
checkLogined();

$id=$_REQUEST['id'];

$sql="select * from tg_user_login as l
      join tg_guest_info i on l.user_id=i.guest_id
        where l.id={$id}";
$row=fetchOne($sql);
$row['language']=explode(",", $row['language']);
//$houseInfo_cal['update_time']=date("Y-m-d H:i:s");
$user_id=$row['user_id'];


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>-.-</title>
<link href="./styles/global.css"  rel="stylesheet"  type="text/css" media="all" />
<script type="text/javascript" charset="utf-8" src="../plugins/kindeditor/kindeditor.js"></script>
<script type="text/javascript" charset="utf-8" src="../plugins/kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript" src="./scripts/jquery-1.6.4.js"></script>
<script>
        KindEditor.ready(function(K) {
                window.editor = K.create('#editor_id');
        });
        $(document).ready(function(){
        	$("#selectFileBtn").click(function(){
        		$fileField = $('<input type="file" name="thumbs[]"/>');
        		$fileField.hide();
        		$("#attachList").append($fileField);
        		$fileField.trigger("click");
        		$fileField.change(function(){
        		$path = $(this).val();
        		$filename = $path.substring($path.lastIndexOf("\\")+1);
        		$attachItem = $('<div class="attachItem"><div class="left">a.gif</div><div class="right"><a href="#" title="ɾ���">ɾ��</a></div></div>');
        		$attachItem.find(".left").html($filename);
        		$("#attachList").append($attachItem);
        		});
        	});
        	$("#attachList>.attachItem").find('a').live('click',function(obj,i){
        		$(this).parents('.attachItem').prev('input').remove();
        		$(this).parents('.attachItem').remove();
        	});
        });
</script>
</head>
<body>
<h3>Edit guest infomation</h3>
<form action="doAdminAction.php?act=editGuestInfo&id=<?php echo $user_id;?>" method="post" enctype="multipart/form-data">
<table width="70%"  border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">

    <tr>
		<td align="right">First name</td>
		<td><input type="text" name="first_name" value=<?php echo $row['first_name'] ;?> ></td>
	</tr>

	<tr>
		<td align="right">Last name</td>
		<td><input type="text" name="last_name" value=<?php echo $row['last_name'] ;?> ></td>
	</tr>

	<tr>
		<td align="right">Gender</td>
		<td>
		    <select name="gender" required>
			    <option value=""> - select - </option>
				<option value=1 <?php echo $row['gender']==1?"selected":null;?> >Male</option>
				<option value=0 <?php echo $row['gender']==0?"selected":null;?> >Female</option>
			</select>
		</td>
	</tr>

	<tr>
		<td align="right">Age</td>
		<td><input type="text" name="age" value=<?php echo $row['age'] ;?> ></td>
	</tr>

	<tr>
		<td align="right">Ethnicity</td>
		<td>
		    <select name="ethnicity" required>
			    <option value=""> - select - </option>
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
		<td align="right">From country</td>
		<td><input type="text" name="from_country" value=<?php echo $row['from_country'] ;?> ></td>
	</tr>

	<tr>
		<td align="right">Occupation</td>
		<td>
		    <select name="occupation" required>
				<option value=""> - select - </option>
				<option value=1 <?php echo $row['occupation']==1?"selected":null; ?> >Student</option>
				<option value=2 <?php echo $row['occupation']==2?"selected":null; ?> >Office worker</option>
				<option value=3 <?php echo $row['occupation']==3?"selected":null; ?> >Self employed</option>
				<option value=4 <?php echo $row['occupation']==4?"selected":null; ?> >Other</option>
			</select>
		</td>
	</tr>

	<tr>
		<td align="right">Mobile</td>
		<td><input type="text" name="mobile_code" value=<?php echo $row['mobile_code'] ;?> ><input type="text" name="mobile" value=<?php echo $row['mobile'] ;?> ></td>
	</tr>

	<tr>
		<td align="right">Purpose of traveling</td>
		<td>
		    <select name="purpose" required>
				<option value=""> - select - </option>
				<option value=1 <?php echo $row['purpose']==1?"selected":null; ?> >Study abroad</option>
				<option value=2 <?php echo $row['purpose']==2?"selected":null; ?> >Travel</option>
				<option value=3 <?php echo $row['purpose']==3?"selected":null; ?> >Business</option>
				<option value=4 <?php echo $row['purpose']==5?"selected":null; ?> >Other</option>
			</select>
		</td>
	</tr>

	<tr>
		<td align="right">Name of school/company</td>
		<td><input type="text" style="width:100%" name="name_dest" value="<?php echo $row['name_dest']?$row['name_dest']:null; ?>" ></td>
	</tr>

	<tr>
		<td align="right">Language</td>
		<td>
		    <div style="width:200px;height:110px;overflow-y:scroll;">
                <div class="checkbox">
                   <label><input type="checkbox" value=1 name="language[]" checked <?php if(isset($row['language']) && is_array($row['language']) && in_array(1, $row['language'])) echo 'checked="checked"'; ?> />English</label>
                </div>
                <div class="checkbox">
                   <label><input type="checkbox" value=2 name="language[]" <?php if(isset($row['language']) && is_array($row['language']) && in_array(2, $row['language'])) echo 'checked="checked"'; ?> />Spanish</label>
                </div>
                <div class="checkbox">
                   <label><input type="checkbox" value=3 name="language[]" <?php if(isset($row['language']) && is_array($row['language']) && in_array(3, $row['language'])) echo 'checked="checked"'; ?> />Chinese</label>
                </div>
                <div class="checkbox">
                   <label><input type="checkbox" value=4 name="language[]" <?php if(isset($row['language']) && is_array($row['language']) && in_array(4, $row['language'])) echo 'checked="checked"'; ?> />Vietnamese</label>
                </div>
                <div class="checkbox">
                   <label><input type="checkbox" value=5 name="language[]" <?php if(isset($row['language']) && is_array($row['language']) && in_array(5, $row['language'])) echo 'checked="checked"'; ?> />Filipino</label>
                </div>
                <div class="checkbox">
                   <label><input type="checkbox" value=6 name="language[]" <?php if(isset($row['language']) && is_array($row['language']) && in_array(6, $row['language'])) echo 'checked="checked"'; ?> />French</label>
                </div>
                <div class="checkbox">
                   <label><input type="checkbox" value=7 name="language[]" <?php if(isset($row['language']) && is_array($row['language']) && in_array(7, $row['language'])) echo 'checked="checked"'; ?> />German</label>
                </div>
                <div class="checkbox">
                   <label><input type="checkbox" value=8 name="language[]" <?php if(isset($row['language']) && is_array($row['language']) && in_array(8, $row['language'])) echo 'checked="checked"'; ?> />Indian</label>
                </div>
                <div class="checkbox">
                   <label><input type="checkbox" value=9 name="language[]" <?php if(isset($row['language']) && is_array($row['language']) && in_array(9, $row['language'])) echo 'checked="checked"'; ?> />Arabic</label>
                </div>
                <div class="checkbox">
                   <label><input type="checkbox" value="a" name="language[]" <?php if(isset($row['language']) && is_array($row['language']) && in_array('a', $row['language'])) echo 'checked="checked"'; ?> />Korean</label>
                </div>
                <div class="checkbox">
                   <label><input type="checkbox" value="b" name="language[]" <?php if(isset($row['language']) && is_array($row['language']) && in_array('b', $row['language'])) echo 'checked="checked"'; ?> />Japanese</label>
                </div>
                <div class="checkbox">
                   <label><input type="checkbox" value="c" name="language[]" <?php if(isset($row['language']) && is_array($row['language']) && in_array('c', $row['language'])) echo 'checked="checked"'; ?> />Portuguese</label>
                </div>
            </div>
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