<?php
require_once '../include.php';
checkLogined();

// Fetch row numbers of houses
$sql="select * from tg_guest_info";
$totalRows=getResultNum($sql);
$pageSize=20;

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
            $where=$keywords_title?"where i.last_name like '%{$keywords_title}%'":null;
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
$sql = "SELECT * FROM tg_guest_info as i
        JOIN tg_guest_request r on i.guest_id = r.guest_id
        JOIN tg_user_login l on i.guest_id = l.user_id
        {$where}
        order by l.id desc
        limit {$offset},{$pageSize}";

$rows=fetchAll($sql);

//print_r($rows);

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
            <input type="button" value="Add Guest" class="add" onclick="addGuest()">
        </div>
        <div class="fr">
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

            <div class="text">
                <span>Search By Email</span>
                <input type="text" class="search" name="search_email" id="search_email" onkeypress="search_email()" >
            </div>

            <div class="text">
                <span>Search By Last name</span>
                <input type="text" class="search" name="search_lName" id="search_lName" onkeypress="search_lName()" >
            </div>

        </div>
    </div>
    <!-- Add house end -->

    <!--���-->
    <table class="table" cellspacing="0" cellpadding="0">
        <thead>

            <tr>
                <th width="5%">ID</th>
                <th width="5%">Guest ID</th>
                <th width="5%">Email</th>
                <th width="7%">First name</th>
                <th width="7%">Last name</th>
                <th width="3%">Gender</th>
                <th width="3%">Age</th>
                <th width="3%">Listing</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($rows as $row):?>
            <tr>
                <!--�����id��for�����c1 ��Ҫѭ������-->
                <td align="center"><input type="checkbox" id="<?php echo $row['id'];?>" class="check" value=<?php echo $row['id'];?>><label for="c1" class="label"><?php echo $row['id'];?></label></td>
                <td align="center"><?php echo $row['guest_id']; ?></td>
                <td align="center"><?php echo $row['email']; ?></td>
                <td align="center"><?php echo $row['first_name'];?></td>
                <td align="center"><?php echo $row['last_name'];?></td>
                <td align="center"><?php echo $row['gender']==1?'M':'F';?></td>
                <td align="center"><?php echo $row['age'] ;?></td>
                <td align="center"><?php echo $row['is_avail']==1?"Yes":"No" ;?></td>
                <td align="center">
    				<input type="button" value="Detail" class="btn" onclick="showDetail(<?php echo $row['id'];?>,'<?php echo $row['first_name'];?>')">
    				<input type="button" value="Edit Info" class="btn" onclick="editGuestInfo(<?php echo $row['id'];?>)">
    				<input type="button" value="Edit Request" class="btn" onclick="editGuestRequest(<?php echo $row['id'];?>)">
    				<input type="button" value="Delete" class="btn" onclick="delGuest(<?php echo $row['id'];?>)">

                    <!-- Detail page -->
                    <div id="showDetail<?php echo $row['id']; ?>" style="display:none;">

                	<table class="table" cellspacing="0" cellpadding="0">
                	    <tr>
                            <td width="20%" align="right">Ethnicity</td>
                            <td><?php echo $row['ethnicity'];?></td>
                        </tr>
                        <tr>
                            <td width="20%" align="right">Language</td>
                            <td><?php echo $row['language'];?></td>
                        </tr>
                        <tr>
                            <td width="20%" align="right">Mobile</td>
                            <td>(<?php echo $row['mobile_code'];?>)<?php echo $row['mobile'];?></td>
                        </tr>
                        <tr>
                            <td width="20%" align="right">Purpose</td>
                            <td><?php echo $row['purpose'];?></td>
                        </tr>
                		<tr>
                			<td width="20%" align="right">From Country</td>
                			<td><?php echo $row['from_country'];?></td>
                		</tr>
                		<tr>
                			<td width="20%" align="right">To Country</td>
                			<td><?php echo $row['country'];?></td>
                		</tr>
                		<tr>
                			<td width="20%" align="right">Street #</td>
                			<td><?php echo $row['street_number'];?></td>
                		</tr>
                		<tr>
                			<td width="20%"  align="right">Address</td>
                			<td><?php echo $row['route'];?></td>
                		</tr>
                		<tr>
                			<td width="20%"  align="right">City</td>
                			<td><?php echo $row['locality'];?></td>
                		</tr>
                		<tr>
                			<td width="20%"  align="right">State</td>
                			<td><?php echo $row['administrative_area_level_1'];?></td>
                		</tr>
                		<tr>
                			<td width="20%"  align="right">ZIP</td>
                			<td><?php echo $row['postal_code'];?></td>
                		</tr>
                		<tr>
                			<td width="20%"  align="right">Name of school/company</td>
                			<td><?php echo $row['name_dest'];?></td>
                		</tr>
                		<tr>
                			<td width="20%"  align="right">Lat</td>
                			<td><?php echo $row['lat'];?></td>
                		</tr>
                		<tr>
                			<td width="20%"  align="right">lng</td>
                			<td><?php echo $row['lng'];?></td>
                		</tr>
                		<tr>
                			<td width="20%"  align="right">Arrival date</td>
                			<td><?php echo $row['arrival'];?></td>
                		</tr>
                		<tr>
                			<td  width="20%"  align="right">Departure date</td>
                			<td><?php echo $row['departure'];?></td>
                		</tr>
                		<tr>
                			<td  width="20%"  align="right">Monthly price</td>
                			<td><?php echo $row['m_price'];?></td>
                		</tr>
                		<tr>
                			<td  width="20%"  align="right">Daily price</td>
                			<td><?php echo $row['d_price'];?></td>
                		</tr>
                		<tr>
                			<td  width="20%"  align="right">join date</td>
                			<td><?php echo $row['join_date'];?></td>
                		</tr>
                		<tr>
                			<td  width="20%"  align="right">Services required</td>
                			<td><?php echo $row['preferred_services'];?></td>
                		</tr>

                		<tr>
                			<td width="20%"  align="right">introdution</td>
                			<td>
                				<?php echo $row['intro'];?>
                			</td>
                		</tr>

                		<tr>
                			<td width="20%"  align="right">Profile Image</td>
                			<td>
                			    <img width="100" height="100" src="../uploads/profile_img/user_id_<?php echo $row['user_id']."/". $row['picture']; ?>" alt=""/> &nbsp;
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
            	<td colspan="13"><?php echo @showPage($page, $totalPage,"keywords={$keywords}&order={$order}");?></td>
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
	      modal:false,//�Ƿ�ģʽ�Ի���
	      draggable:true,//�Ƿ�������ק
	      resizable:true,//�Ƿ������϶�
	      title:"House Title: "+t, //�Ի������
	      show:"slide",
	      hide:"slide"
	});
}
	function addGuest(){
		window.location='addGuest.php';
	}
	function editGuestInfo(id){
		window.location='editGuestInfo.php?id='+id;
	}
	function editGuestRequest(id){
		window.location='editGuestRequest.php?id='+id;
	}
	function delGuest(id){
	        if(window.confirm("Are you sure to confirm this guest, it can't be recovered! confirm?")){
    		window.location="doAdminAction.php?act=delGuest&id="+id;
    	}
    }
	function delHouse(id){
		if(window.confirm("Ready to delete! confirm?")){
			window.location="doAdminAction.php?act=delHouse&id="+id;
		}
	}
	function search_email(){
		if(event.keyCode==13){
			var val=document.getElementById("search_email").value;
			window.location="listGuest.php?keywords_email="+val;
		}
	}
	function search_lName(){
		if(event.keyCode==13){
			var val=document.getElementById("search_lName").value;
			window.location="listGuest.php?keywords_title="+val;
		}
	}
	function change(val){
		window.location="listPro.php?order="+val;
	}
</script>
</body>
</html>