<?php

require_once '../include.php';
checkLogined();
$pageSize=5;
$rows=getAdminByPage($pageSize);


//$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
//$sql="select * from imooc_admin";
//$totalRows=getResultNum($sql);
//$pageSize=2;
//$totalPage=ceil($totalRows/$pageSize);
//$pageSize=2;
//$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
//if($page<1||$page==null||!is_numeric($page)){
//	$page=1;
//}
//if($page>=$totalPage)$page=$totalPage;
//$offset=($page-1)*$pageSize;
//$sql="select id,username,email from imooc_admin limit {$offset},{$pageSize}";
//$rows=fetchAll($sql);

//$rows=getAllAdmin();

if(!$rows){
    alertMes("sorry,the admin does not exist!","addAdmin.php");
    exit;
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>-.-</title>
<link rel="stylesheet" href="styles/backstage.css">
</head>

<body>
<div class="details">
                    <div class="details_operation clearfix">
                        <div class="bui_select">
                            <input type="button" value="Add" class="add"  onclick="addAdmin()">
                        </div>

                    </div>
                    <!--表格-->
                    <table class="table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th width="2%">ID</th>
                                <th width="10%">Email</th>
                                <th width="15%">Privileges</th>
                                <th width="10%">Created time</th>
                                <th width="5%">Edit | Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  foreach($rows as $row):?>
                            <tr>
                                <!--这里的id和for里面的c1 需要循环出来-->
                                <td style="text-align:center"><input type="checkbox" id="c1" class="check"><label for="c1" class="label"><?php echo $row['admin_id'];?></label></td>
                                <td style="text-align:center"><?php echo $row['email'];?></td>
                                <td style="text-align:center"><?php echo "privilege" ?></td>
                                <td style="text-align:center"><?php echo $row['reg_time'];?></td>
                                <td align="center"><input type="button" value="Edit" class="btn" onclick="editAdmin(<?php echo $row['admin_id'];?>)"><input type="button" value="Delete" class="btn"  onclick="delAdmin(<?php echo $row['admin_id'];?>)"></td>
                            </tr>
                            <?php endforeach;?>
                            <?php if($rows>$pageSize):?>
                            <tr>
                            	<td colspan="6"><?php echo @showPage($page, $totalPage);?></td>
                            </tr>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
</body>
<script type="text/javascript">

	function addAdmin(){
		window.location="addAdmin.php";
	}
	function editAdmin(id){
			window.location="editAdmin.php?id="+id;
	}
	function delAdmin(id){
			if(window.confirm("Ready to delete! Confirm?")){
				window.location="doAdminAction.php?act=delAdmin&id="+id;
			}
	}
</script>
</html>