
//listUser.php
function addUser(){
		window.location="addUser.php";
}
function editUser(id){
		window.location="editUser.php?id="+id;
}
function delUser(id){
		if(window.confirm("Ready to delete, confirm?")){
			window.location="doAdminAction.php?act=delUser&id="+id;
		}
}




//listInfo.php
//function addUser(){
//	window.location="addUser.php";
//}
function editHostInfo(id){
		window.location="editHostInfo.php?id="+id;
}
////function delUser(id){
////		if(window.confirm("Ready to delete, confirm?")){
////			window.location="doAdminAction.php?act=delUser&id="+id;
//		}
function delHostInfo(id){
	if(window.confirm("Ready to delete, confirm?")){
		window.location="doAdminAction.php?act=delHostInfo&id="+id;
	}
}