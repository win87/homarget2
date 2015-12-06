<?php
require_once '../include.php';
checkLogined();

//取了tigris_user_type里的内容
//$rows=getAllCate();
//print_r($rows);
//if(!$rows){
//    alertMes("No type of user being selected!", "addCate.php");
//}
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
        		$attachItem = $('<div class="attachItem"><div class="left">a.gif</div><div class="right"><a href="#" title="删除附件">删除</a></div></div>');
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
<h3>Add House Information</h3>
<form action="doAdminAction.php?act=addHouse" method="post" enctype="multipart/form-data">
<table width="70%"  border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
    <tr>
		<td align="right">User_id</td>
		<td><input type="text" name="user_id"  placeholder="please enter the User ID"/></td>
	</tr>

	<tr>
		<td align="right">House name</td>
		<td><input type="text" name="house_name"  placeholder="please enter house name"/></td>
	</tr>

	<tr>
		<td align="right">House type</td>
		<td>
		    <input type="radio" name="house_type" value="house" placeholder="please enter house number"/>House
		    <input type="radio" name="house_type" value="apartment" placeholder="please enter house number"/>Apartment
		    <input type="radio" name="house_type" value="condo" placeholder="please enter house number"/>Condo
		    <input type="radio" name="house_type" value="others" placeholder="please enter house number"/>Others
		</td>
	</tr>
	<tr>
		<td align="right">Room type</td>
		<td>
		    <input type="checkbox" name="room_type" value="private_room" placeholder="please enter house number"/>Private room
		    <input type="checkbox" name="room_type" value="shared_room" placeholder="please enter house number"/>Shared room
		    <input type="checkbox" name="room_type" value="entired_home"  placeholder="please enter house number"/>Entired house
		</td>
	</tr>
	<tr>
		<td align="right">Daily price</td>
		<td><input type="text" name="daily_price"  placeholder="please enter monthly price"/></td>
	</tr>
	<tr>
		<td align="right">Monthly price</td>
		<td><input type="text" name="monthly_price"  placeholder="please enter daily price"/></td>
	</tr>
	<tr>
		<td align="right">House description</td>
		<td>
			<textarea name="house_desc" id="editor_id" style="width:100%;height:150px;"></textarea>
		</td>
	</tr>
	<tr>
		<td align="right">House images</td>
		<td>
			<a href="javascript:void(0)" id="selectFileBtn">Add files</a>
			<div id="attachList" class="clear"></div>
		</td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit"  value="Submit"/></td>
	</tr>
</table>
</form>
</body>
</html>