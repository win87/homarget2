function click_country(){

	var val=document.getElementById('gpCountry').value;
		window.location="guestSearchResult.php?country="+val;
}

function index_search(){

	var val=document.getElementById('index-country').value;
	window.location="guestSearchResult.php?country="+val;
}

function viewHouse(id){
	window.location='view-house.php?house_id='+id;
}

function viewGuest(id){
	window.location='view-guest.php?guest_id='+id;
}

function viewHost(id){
	window.location='view-house.php?house_id='+id;
}

function confirmHouse(id){
	window.location='guest-book-mail.php?house_id='+id;
}

function confirmGuest(id){
	window.location='host-book-mail.php?guest_id='+id;
}

function confirmHost(id){
	window.location='guest-book-mail.php?guest_id='+id;
}