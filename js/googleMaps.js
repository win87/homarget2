

// Autocomplete address
$(function(){

	//All id with #geocomplete can inherit it
    $("#geocomplete").geocomplete({
      //map: ".map_canvas",
      details: "form",
      types: ["geocode", "establishment"],
    });


    $("#findMe").click(function(){
      $("#geocomplete").trigger("geocode");
    });
  });


function modify_add(){
	$('#country').removeAttr('disabled');
	$('#street_number').removeAttr('disabled');
	$('#route').removeAttr('disabled');
	$('#address2').removeAttr('disabled');
	$('#city').removeAttr('disabled');
	$('#state').removeAttr('disabled');
	$('#zip').removeAttr('disabled');
}


// Google maps API
var geocoder;
var map;


function initialize() {

  var lat=$('#lat').val();
  var lng=$('#lng').val();
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(lat, lng);
  var mapOptions = {
	scrollwheel:false,
	streetViewControl: true,
    zoom: 15,
    center: latlng,
    disableDefaultUI: false,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

  var my_marker = new google.maps.Marker({
	 position: latlng,
	 map: map
  });
}

function formAddress(){
	  document.getElementById('pac-input').value =
		  document.getElementById('street_number').value + ' ' +
		  document.getElementById('route').value + ' ' +
		  document.getElementById('city').value + ' ' +
		  document.getElementById('state').value + ' ' +
		  document.getElementById('zip').value + ' ' +
		  document.getElementById('country').value;
}

function codeAddress(){

  // Fix the bug that map displays partialy
  google.maps.event.trigger(map, "resize");

  var address = document.getElementById('pac-input').value;
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location
      });
    } else {
      alert('We can not get your location, please make sure enter all information');
    }
  });

}


google.maps.event.addDomListener(window, 'load', initialize);



