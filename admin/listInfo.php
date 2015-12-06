<?php
require_once '../include.php';
checkLogined();

@$order=$_REQUEST['order']?$_REQUEST['order']:null;
@$orderBy=$order?"order by h.".$order:null;

@$keywords_email=$_REQUEST['keywords_email']?$_REQUEST['keywords_email']:null;
@$keywords_title=$_REQUEST['keywords_title']?$_REQUEST['keywords_title']:null;
@$keywords=$keywords_email?$keywords_email:$keywords_title;

switch($keywords){
    case $keywords_email:
        $where=$keywords_email?"where host_id like '%{$keywords_email}%'":null;
        break;
    case $keywords_title:
        $where=$keywords_title?"where last_name like '%{$keywords_title}%'":null;
}

$sql="select * from tg_host_info {$where} order by host_id desc";
$rows=fetchAll($sql);

if(!$rows){
    alertMes("sorry,the user doesn't exist!","addUser.php");
    exit;
}

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

            <div class="fr">

            <div class="text">
                <span>Search By Host ID</span>
                <input type="text" class="search" name="search_email" id="search_email" onkeypress="search_email()" >
            </div>

            <div class="text">
                <span>Search By Last name</span>
                <input type="text" class="search" name="search_lName" id="search_lName" onkeypress="search_lName()" >
            </div>

        </div>

        </div>

        <table class="table" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th width="2%">Host ID</th>
                    <th width="5%">First name</th>
                    <th width="5%">Last name</th>
                    <th width="3%">Gender</th>
                    <th width="3%">Age</th>
                    <th width="5%">Ethnicity</th>
                    <th width="2%">Occupation</th>
                    <th width="5%">Language</th>
                    <th width="2%">Phone_code</th>
                    <th width="7%">Phone</th>
                    <th width="2%">Mobile_code</th>
                    <th width="7%">Mobile</th>
                    <th>Edit | Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php  foreach($rows as $row):?>
                <tr>

                    <td><input type="checkbox" id="c1" class="check"><label for="c1" class="label"><?php echo $row['host_id'];?></label></td>
                    <td><?php echo $row['first_name'];?></td>
                    <td><?php echo $row['last_name'];?></td>
                    <td><?php echo $row['gender']==1?"Male":"Female";?></td>
                    <td><?php echo $row['age'];?></td>
                    <td><?php echo $row['ethnicity'];?></td>
                    <td><?php echo $row['occupation'];?></td>
                    <td><?php echo $row['language'];?></td>
                    <td><?php echo $row['phone_code'];?></td>
                    <td><?php echo $row['phone'];?></td>
                    <td><?php echo $row['mobile_code'];?></td>
                    <td><?php echo $row['mobile'];?></td>
                    <td align="center"><input type="button" value="Edit" class="btn" onclick="editHostInfo(<?php echo $row['host_id'];?>)"><input type="button" value="Delete" class="btn"  onclick="delHostInfo(<?php echo $row['host_id'];?>)"></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <script>
//     function editHostInfo(id){
// 		window.location='editHostInfo.php?id='+id;
// 	    }

//     function delHostInfo(id){
//  	   if(window.confirm("Ready to delete, confirm?")){
//   		  window.location="doAdminAction.php?act=delHostInfo&id="+id;
    function search_email(){
    	if(event.keyCode==13){
    		var val=document.getElementById("search_email").value;
    		window.location="listInfo.php?keywords_email="+val;
    	}
    }
    function search_lName(){
    	if(event.keyCode==13){
    		var val=document.getElementById("search_lName").value;
    		window.location="listInfo.php?keywords_title="+val;
    	}
    }
    </script>

</body>

</html>