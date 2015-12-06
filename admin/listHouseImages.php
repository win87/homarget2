<?php
require_once '../include.php';
checkLogined();
$rows=getHouseInfo();
//print_r($rows);exit;

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Hose images management</title>
<link rel="stylesheet" href="styles/backstage.css">
</head>

<body>

<div class="details">
    <div class="details_operation clearfix">
        <div class="bui_select">
            <input type="button" value="Add images" class="add" onclick="">
        </div>
        <div class="fr">
            <div class="text">
                <span>House price:</span>
                <div class="bui_select">
                    <select id="" class="select" onchange="change(this.value)">
                    	<option>- select -</option>
                        <option value="iPrice asc" >from low to high</option>
                        <option value="iPrice desc">from high to low</option>
                    </select>
                </div>
            </div>
            <div class="text">
                <span>pub-time:</span>
                <div class="bui_select">
                 <select id="" class="select" onchange="change(this.value)">
                 	<option>- select -</option>
                        <option value="pubTime desc" >latest</option>
                        <option value="pubTime asc">history</option>
                    </select>
                </div>
            </div>
            <div class="text">
                <span>search by Album_id</span>
                <input type="text" value="" class="search"  id="search" onkeypress="search()" >
            </div>
            <div class="text">
                <span>search by img_path</span>
                <input type="text" value="" class="search"  id="search" onkeypress="search()" >
            </div>
        </div>
    </div>
    <!--���-->
    <table class="table" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th width="10%">House ID</th>
                <th width="10%">House title</th>
                <th>House pictures</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($rows as $row):?>
            <tr>
                <!--�����id��for�����c1 ��Ҫѭ������-->
                <td><input  type="checkbox" id="c<?php echo $row['house_id'];?>" class="check" value=<?php echo $row['house_id'];?>><label for="c1" class="label"><?php echo $row['house_id'];?></label></td>

                <td><?php echo $row['house_title']; ?></td>
				<td>
        			<?php
        			$houseImgs=getAllImgsByHouseId($row['house_id']);

        			foreach($houseImgs as $img):

        			?>
        			<img width="100" height="100" src="../uploads/House_Album/user_id_<?php echo $img['album_id']."/".$img['img_path'];?>" onclick="delImg('<?php echo $img['album_id'];?>','<?php echo $img['img_path'];?>')" /> &nbsp;
        			<?php endforeach;?>
	             </td>
	             <td>

	             	<input type="button" value="Add watermark" onclick="doImg('<?php echo $row['house_id'];?>','waterText')" class="btn"/>

	             	<br/>
	             		<input type="button" value="Add watermark" onclick="doImg('<?php echo $row['house_id'];?>','waterPic')" class="btn"/>
	             </td>
            </tr>
           <?php  endforeach;?>
        </tbody>
    </table>
</div>
 <script type="text/javascript">
 		function doImg(id,act){
			window.location="doAdminAction.php?act="+act+"&id="+id;
 	 	}
 	    function delImg(album_id, img_path){
 	    	if(window.confirm("Ready to delete this image? it can't be recovered!")){
	    		  window.location="doAdminAction.php?act=delImg&album_id="+album_id+"&img_path="+img_path;
 	 	    }
 	    }

 </script>
</body>
</html>