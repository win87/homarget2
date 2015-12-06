<?php
require_once '../include.php';
checkLogined();
//$rows=getAllCate();
// if(!$rows){
// 	alertMes("No type of user being selected!", "addCate.php");
// }
$id=$_REQUEST['id'];

// �����house_id��ȷ������idȡ����tg_house_img��id��ֵ���������������
// ��Ϊ�� request ��һ��ҳ�������id����ˣ��������ֱ����$id, �������п���ʡ��
$sql="select * from tg_host_house where house_id={$id}";
$row=fetchOne($sql);

//get the house information by house_id
$houseInfo_cal=getHouseById($id);
$houseInfo_cal['update_time']=date("Y-m-d H:i:s");

//print_r($row);


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
<h3>Edit house infomation</h3>
<form action="doAdminAction.php?act=editHouse&id=<?php echo $id;?>" method="post" enctype="multipart/form-data">
<table width="70%"  border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">

    <tr>
		<td align="right">No. of Adults house</td>
		<td>
		    <select name="adult_no">
    		    <option value="1" <?php echo $row['adult_no']=="1"?"selected":null; ?> >1</option>
    			<option value="2" <?php echo $row['adult_no']=="2"?"selected":null; ?> >2</option>
    			<option value="3" <?php echo $row['adult_no']=="3"?"selected":null; ?> >3</option>
    			<option value="4" <?php echo $row['adult_no']=="4"?"selected":null; ?> >4</option>
    			<option value="5+" <?php echo $row['adult_no']=="5+"?"selected":null; ?> >5+</option>
		    </select>
		</td>
	</tr>

	<tr>
		<td align="right">No. of Children house</td>
		<td>
		    <select name="child_no">
		        <option value="0" <?php echo $row['child_no']=="0"?"selected":null; ?> >0</option>
    		    <option value="1" <?php echo $row['child_no']=="1"?"selected":null; ?> >1</option>
    			<option value="2" <?php echo $row['child_no']=="2"?"selected":null; ?> >2</option>
    			<option value="3" <?php echo $row['child_no']=="3"?"selected":null; ?> >3</option>
    			<option value="4" <?php echo $row['child_no']=="4"?"selected":null; ?> >4</option>
    			<option value="5+" <?php echo $row['child_no']=="5+"?"selected":null; ?> >5+</option>
		    </select>
		</td>
	</tr>

	<tr>
		<td align="right">House title</td>
		<td><input type="text" name="house_title"  value="<?php echo $houseInfo_cal['house_title'];?>" style="width:100%"></td>
	</tr>

	<tr>
		<td align="right">House type</td>
		<td>
		    <select name="house_type">
		        <option value=""> - select - </option>
                <option value=1 <?php echo $row['house_type']==1?"selected":null;?> >House</option>
                <option value=2 <?php echo $row['house_type']==2?"selected":null;?> >Apartment</option>
                <option value=3 <?php echo $row['house_type']==3?"selected":null;?> >Condo</option>
                <option value=4 <?php echo $row['house_type']==4?"selected":null;?> >Town house</option>
                <option value=5 <?php echo $row['house_type']==5?"selected":null;?> >Other</option>
		    </select>
		</td>
	</tr>

	<tr>
		<td align="right">Room type</td>
		<td>
		    <select name="room_type">
		        <option value=""> - select - </option>
                <option value=1 <?php echo $row['room_type']==1?"selected":null;?> >Private Room</option>
                <option value=2 <?php echo $row['room_type']==2?"selected":null;?> >Shared Room</option>
                <option value=3 <?php echo $row['room_type']==3?"selected":null;?> >Entire Home</option>
		    </select>
		</td>
	</tr>

	<tr>
		<td align="right">No. of Bedroom</td>
		<td>
		    <select name="bedroom">
			    <option value="1" <?php echo $houseInfo_cal['bedroom']=="1"?"selected":null; ?> >1</option>
				<option value="1.5" <?php echo $houseInfo_cal['bedroom']=="1.5"?"selected":null; ?> >1.5</option>
				<option value="2" <?php echo $houseInfo_cal['bedroom']=="2"?"selected":null; ?> >2</option>
				<option value="2.5" <?php echo $houseInfo_cal['bedroom']=="2.5"?"selected":null; ?> >2.5</option>
				<option value="3+" <?php echo $houseInfo_cal['bedroom']=="3+"?"selected":null; ?> >3+</option>
			</select>
		</td>
	</tr>

	<tr>
		<td align="right">No. of Bathroom</td>
		<td>
		    <select name="bathroom">
			    <option value="1" <?php echo $houseInfo_cal['bathroom']=="1"?"selected":null; ?> >1</option>
				<option value="1.5" <?php echo $houseInfo_cal['bathroom']=="1.5"?"selected":null; ?> >1.5</option>
				<option value="2+" <?php echo $houseInfo_cal['bathroom']=="2+"?"selected":null; ?> >2+</option>
			</select>
		</td>
	</tr>

	<tr>
		<td align="right">Daily price</td>
		<td><input type="text" name="d_price" value="<?php echo $houseInfo_cal['d_price'];?>"/></td>
	</tr>

	<tr>
		<td align="right">Monthly price</td>
		<td><input type="text" name="m_price" value="<?php echo $houseInfo_cal['m_price'];?>"/></td>
	</tr>
	<tr>
		<td align="right">Summary</td>
		<td>
			<textarea name="summary" id="editor_id" style="width:100%;height:150px;"><?php echo $houseInfo_cal['summary'];?></textarea>
		</td>
	</tr>
	<tr>
		<td align="right">Images</td>
		<td>
			<a href="javascript:void(0)" id="selectFileBtn">Add images</a>
			<div id="attachList" class="clear"></div>
		</td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit"  value="Edit"/></td>
	</tr>
</table>
</form>
</body>
</html>