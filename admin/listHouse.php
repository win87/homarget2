<?php
require_once '../include.php';
checkLogined();

// Fetch row numbers of houses
$sql="select * from tg_host_house";
$totalRows=getResultNum($sql);
$pageSize=50;

//it has to be set to GLOBAL!!
global $totalPage;
$totalPage=ceil($totalRows/$pageSize);
@$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;

    if($page<1 || $page==null || !is_numeric($page)){
        $page=1;
    }

    if($page>=$totalPage) $page=$totalPage;
    $offset=($page-1)*$pageSize;
//$arr=$_POST;
@$order=$_REQUEST['order']?$_REQUEST['order']:null;
@$orderBy=$order?"order by h.".$order:null;

@$keywords_email=$_REQUEST['keywords_email']?$_REQUEST['keywords_email']:null;
@$keywords_title=$_REQUEST['keywords_title']?$_REQUEST['keywords_title']:null;
@$keywords=$keywords_email?$keywords_email:$keywords_title;

    switch($keywords){
        case $keywords_email:
            $where=$keywords_email?"where l.email like '%{$keywords_email}%'":null;
            break;
        case $keywords_title:
            $where=$keywords_title?"where h.house_title like '%{$keywords_title}%'":null;
    }

//Search house via email
//$where=$keywords?"where l.email like '%{$keywords}%'":null;
//$where=$keywords?"like '%{$keywords}%'":null;

//Connect table "tg_host_house" and "tg_host_calendar" to fetch relatived data from them
//$sql="select * from tg_host_house as h join tg_host_calendar c on h.house_id = c.calendar_id {$where} limit {$offset},{$pageSize}";

//Connet 3 tables ("tg_host_house, tg_host_calendar, tg_user_login")
//$sql_email = "SELECT * FROM tg_host_house as h INNER JOIN tg_host_calendar c on h.house_id = c.calendar_id JOIN tg_user_login l on h.house_id = l.user_id where l.email {$where} limit {$offset},{$pageSize}";


//Search via email or house_title;
// $rows_email=fetchAll($sql_email);
// $rows_title=fetchAll($sql_title);
// $rows_house=$rows_email?$rows_email:$rows_title;

//$sql=$sql_email?$sql_email:$sql_title;
$sql = "SELECT * FROM tg_host_house as h
        JOIN tg_host_calendar c on h.house_id = c.calendar_id
        JOIN tg_user_login l on h.house_id = l.user_id
        {$where}
        order by l.id desc
        limit {$offset},{$pageSize}";

$rows=fetchAll($sql);
//$pageSize=2;
// $rows_house = getHouseByPage($pageSize);



?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>House manangement</title>
<link rel="stylesheet" href="styles/backstage.css">
<link rel="stylesheet" href="scripts/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
<script src="scripts/jquery-ui/js/jquery-1.10.2.js"></script>
<script src="scripts/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
<script src="scripts/jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>
</head>

<body>
<div id="showDetail"  style="display:none;">

</div>
<div class="details">
    <!-- Add house -->
    <div class="details_operation clearfix">
        <div class="bui_select">
            <input type="button" value="Add" class="add" onclick="addHouse()">
        </div>

        <div class="fr">
        <!--
            <div class="text">
                <span>House price:</span>
                <div class="bui_select">
                    <select id="" class="select" onchange="change(this.value)">
                    	<option>- select -</option>
                        <option value="iPrice asc" >Low to high</option>
                        <option value="iPrice desc">High to low</option>
                    </select>
                </div>
            </div>

            <div class="text">
                <span>pub-time:</span>
                <div class="bui_select">
                 <select id="" class="select" onchange="change(this.value)">
                 	<option>- select -</option>
                        <option value="pubTime desc" >Latest</option>
                        <option value="pubTime asc">History</option>
                    </select>
                </div>
            </div>
        -->
            <div class="text">
                <span>Search By Email</span>
                <input type="text" class="search" name="search_email" id="search_email" onkeypress="search_email()" >
            </div>

            <div class="text">
                <span>Search By House_title</span>
                <input type="text" class="search" name="search_title" id="search_title" onkeypress="search_title()" >
            </div>
        </div>

    </div>
    <!-- Add house end -->


    <table class="table" cellspacing="0" cellpadding="0">
        <thead>

            <tr>
                <th width="5%">ID</th>
                <th width="5%">House ID</th>
                <th width="5%">Email</th>
                <th width="10%">House Title</th>
                <th width="10%">Start day</th>
                <th width="5%">Available</th>
                <th width="10%">Pub Time</th>
                <th width="10%">Update Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($rows as $row):?>
            <tr>

                <td align="center"><input type="checkbox" id="<?php echo $row['id'];?>" class="check" value=<?php echo $row['id'];?>><label for="c1" class="label"><?php echo $row['id'];?></label></td>
                <td align="center"><?php echo $row['house_id']; ?></td>
                <td align="center"><?php echo $row['email']; ?></td>
                <td align="center"><?php echo $row['house_title'];?></td>
                <td align="center"><?php echo $row['start_day'];?></td>
                <td align="center"><?php echo $row['is_avail']==1?"Yes":"No"; ?></td>
                <td align="center"><?php echo $row['pub_time'];?></td>
                <td align="center"><?php echo $row['update_time'];?></td>
                <td align="center">
    				<input type="button" value="Detail" class="btn" onclick="showDetail(<?php echo $row['id'];?>,'<?php echo $row['house_title'];?>')">
    				<input type="button" value="Add images" class="btn" onclick="addImgs(<?php echo $row['house_id'];?>)">
    				<input type="button" value="Edit" class="btn" onclick="editHouse(<?php echo $row['house_id'];?>)">
    				<input type="button" value="Delete" class="btn"onclick="delHouse(<?php echo $row['id'];?>)">

                    <!-- Detail page -->
                    <div id="showDetail<?php echo $row['id']; ?>" style="display:none;">

                	<table class="table" cellspacing="0" cellpadding="0">
                		<tr>
                			<td width="20%" align="right">House ID</td>
                			<td><?php echo $row['house_id'];?></td>
                		</tr>
                		<tr>
                			<td width="20%" align="right">House title</td>
                			<td><?php echo $row['house_title'];?></td>
                		</tr>
                		<tr>
                			<td width="20%"  align="right">House type</td>
                			<td><?php echo $row['house_type'];?></td>
                		</tr>
                		<tr>
                			<td width="20%"  align="right">Room type</td>
                			<td><?php echo $row['room_type'];?></td>
                		</tr>
                		<tr>
                            <td width="20%"  align="right">Bedroom</td>
                            <td><?php echo $row['bedroom'];?></td>
                        </tr>
                		<tr>
                			<td width="20%"  align="right">Bathroom</td>
                			<td><?php echo $row['bathroom'];?></td>
                		</tr>
                		<tr>
                			<td width="20%"  align="right">Adult No.</td>
                			<td><?php echo $row['adult_no'];?></td>
                		</tr>
                		<tr>
                			<td width="20%"  align="right">Child No.</td>
                			<td><?php echo $row['child_no'];?></td>
                		</tr>
                		<tr>
                			<td  width="20%"  align="right">Daily price</td>
                			<td><?php echo $row['d_price'];?></td>
                		</tr>
                		<tr>
                			<td  width="20%"  align="right">Monthly price</td>
                			<td><?php echo $row['m_price'];?></td>
                		</tr>
                		<tr>
                			<td  width="20%"  align="right">Pub time</td>
                			<td><?php echo $row['pub_time'];?></td>
                		</tr>
                		<tr>
                			<td  width="20%"  align="right">Update time</td>
                			<td><?php echo $row['update_time'];?></td>
                		</tr>

                		<tr>
                			<td width="20%"  align="right">Summary</td>
                			<td>
                				<?php echo $row['summary'];?>
                			</td>
                		</tr>

                		<tr>
                			<td width="20%"  align="right">House imags</td>
                			<td>
                			<?php
                			//ͨ��house_id�ĵ�album_id
                			$houseImgs=getAllImgsByHouseId($row['house_id']);
                			//$album_id=$houseImgs['album_id'];

                			foreach($houseImgs as $img):
                			//No displaying if the img_path is empty
                			 if(!empty($img['img_path'])){
                			?>
                			<img width="100" height="100" src="../uploads/House_Album/user_id_<?php echo $row['house_id']."/". $img['img_path']; ?>" onclick="delImg('<?php echo $img['album_id'];?>','<?php echo $img['img_path'];?>')" /> &nbsp;
                			<?php } endforeach;?>
                			</td>
                		</tr>
                	</table>
                	<!-- Detail page end -->

                	<span style="display:block;width:80%; "></span>

                </div>
                </td>
            </tr>
           <?php  endforeach;?>

           <?php if($rows>$pageSize):?>
            <tr>
            	<td colspan="10"><?php echo @showPage($page, $totalPage,"keywords={$keywords}&order={$order}");?></td>
            </tr>
            <?php endif;?>
        </tbody>
    </table>

</div>


<script type="text/javascript">
function showDetail(id,t){
	$("#showDetail"+id).dialog({
		  height:"auto",
	      width: "auto",
	      position: {my: "center", at: "center",  collision:"fit"},
	      modal:false,
	      draggable:true,
	      resizable:true,
	      title:"House Title: "+t,
	      show:"slide",
	      hide:"slide"
	});
}
	function addHouse(){
		window.location='addHouse.php';
	}
	function editHouse(id){
		window.location='editHouse.php?id='+id;
	}
	function addImgs(id){
		window.location='addImgs.php?id='+id;
	}
	function delHouse(id){
		if(window.confirm("Ready to delete! confirm?")){
			window.location="doAdminAction.php?act=delHouse&id="+id;
		}
	}
	function search_email(){
		if(event.keyCode==13){
			var val=document.getElementById("search_email").value;
			window.location="listHouse.php?keywords_email="+val;
		}
	}
	function search_title(){
		if(event.keyCode==13){
			var val=document.getElementById("search_title").value;
			window.location="listHouse.php?keywords_title="+val;
		}
	}
	function change(val){
		window.location="listPro.php?order="+val;
	}
	function delImg(album_id, img_path){
        if(window.confirm("Ready to delete this image? it can't be recovered!")){
              window.location="doAdminAction.php?act=delImg&album_id="+album_id+"&img_path="+img_path;
        }
    }
</script>
</body>
</html>