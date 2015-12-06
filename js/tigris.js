//**********************************
//Guest & Host booking logic
//**********************************
function delBookGuest(id_guest,id_host){
    if(window.confirm("Are you sure to cancel this reservation?")){
	window.location="doAction.php?act=delBookGuest&id_guest="+id_guest+"&id_host="+id_host;
	}
}

function delBookHost(id_host,id_guest){
    if(window.confirm("Are you sure to cancel this reservation?")){
	window.location="doAction.php?act=delBookHost&id_host="+id_host+"&id_guest="+id_guest;
	}
}

function cancelGuestBook(id_guest,id_host){
    if(window.confirm("Are you sure to reject this reservation?")){
	window.location="doAction.php?act=cancelGuestBook&id_guest="+id_guest+"&id_host="+id_host;
	}
}

function cancelHostBook(id_host,id_guest){
    if(window.confirm("Are you sure to reject this reservation?")){
	window.location="doAction.php?act=cancelHostBook&id_host="+id_host+"&id_guest="+id_guest;
	}
}

function acceptGuestBook(id_guest,id_host){
    if(window.confirm("Are you sure to accept this reservation?")){
	window.location="doAction.php?act=acceptGuestBook&id_guest="+id_guest+"&id_host="+id_host;
	}
}

function acceptHostBook(id_host,id_guest){
    if(window.confirm("Are you sure to accept this reservation?")){
	window.location="doAction.php?act=acceptHostBook&id_host="+id_host+"&id_guest="+id_guest;
	}
}

//**********************************
//onchange ajax feature
//**********************************

//onchange save ls-fName
$('#first_name').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=addInfo",
        data: $(this).serialize(),
        success: function (data) {
            $("#lsNameStatus").html(data);
        }
    });
});

//onchange save ls-lName
$('#last_name').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=addInfo",
        data: $(this).serialize(),
        success: function (data) {
            $("#lsLnameStatus").html(data);
        }
    });
});

//onchange save ls-gender
$('#gender').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=addInfo",
        data: $(this).serialize(),
        success: function (data) {
            $("#genderStatus").html(data);
        }
    });
});

//onchange save ls-age
$('#age').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=addInfo",
        data: $(this).serialize(),
        success: function (data) {
            $("#ageStatus").html(data);
        }
    });
});

//onchange save ls-ethnicity
$('#ethnicity').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=addInfo",
        data: $(this).serialize(),
        success: function (data) {
            $("#ethnicityStatus").html(data);
        }
    });
});

//onchange save ls-occupation
$('#list-space-occupation').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=addInfo",
        data: $(this).serialize(),
        success: function (data) {
            $("#occupationStatus").html(data);
        }
    });
});

//onchange save ls-phone
$('#list-space-phone-input').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=addInfo",
        data: $(this).serialize(),
        success: function (data) {
            $("#phoneStatus").html(data);
        }
    });
});

//onchange save ls-mobile
$('#list-space-mobile-input').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=addInfo",
        data: $(this).serialize(),
        success: function (data) {
            $("#mobileStatus").html(data);
        }
    });
});

//onchange save adult_no
$('#adult_no').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=addAcco",
        data: $(this).serialize(),
        success: function (data) {
            $("#adultStatus").html(data);
        }
    });
});

//onchange save child_no
$('#child_no').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=addAcco",
        data: $(this).serialize(),
        success: function (data) {
            $("#childStatus").html(data);
        }
    });
});

//onchange save house_type
$('#house_type').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=addAcco",
        data: $(this).serialize(),
        success: function (data) {
            $("#houseTypeStatus").html(data);
        }
    });
});

//onchange save room_type
$('#room_type').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=addAcco",
        data: $(this).serialize(),
        success: function (data) {
            $("#roomTypeStatus").html(data);
        }
    });
});

//onchange save bedroom
$('#bedroom').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=addAcco",
        data: $(this).serialize(),
        success: function (data) {
            $("#bedroomStatus").html(data);
        }
    });
});

//onchange save bathroom
$('#bathroom').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=addAcco",
        data: $(this).serialize(),
        success: function (data) {
            $("#bathroomStatus").html(data);
        }
    });
});

//onchange save bathroom
$('#house_title').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=addAcco",
        data: $(this).serialize(),
        success: function (data) {
            $("#titleStatus").html(data);
        }
    });
});

//onchange save bathroom
$('#summary').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=addAcco",
        data: $(this).serialize(),
        success: function (data) {
            $("#introStatus").html(data);
        }
    });
});

//onchange save country
$('#country').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=addLocation",
        data: $(this).serialize(),
        success: function (data) {
            $("#countryStatus").html(data);
        }
    });
});

//onchange save city
$('#city').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=addLocation",
        data: $(this).serialize(),
        success: function (data) {
            $("#cityStatus").html(data);
        }
    });
});

//onchange save street_number
$('#street_number').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=addLocation",
        data: $(this).serialize(),
        success: function (data) {
            $("#numberStatus").html(data);
        }
    });
});

//onchange save route
$('#route').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=addLocation",
        data: $(this).serialize(),
        success: function (data) {
            $("#routeStatus").html(data);
        }
    });
});

//onchange save state
$('#state').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=addLocation",
        data: $(this).serialize(),
        success: function (data) {
            $("#stateStatus").html(data);
        }
    });
});

//onchange save zip
$('#zip').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=addLocation",
        data: $(this).serialize(),
        success: function (data) {
            $("#zipStatus").html(data);
        }
    });
});

//onchange save from date
$('#from').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=addFromDate",
        data: $(this).serialize(),
        success: function (data) {
            $("#fromStatus").html(data);
        }
    });
});

//onchange save min_days
$('#min_days').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=addMinDays",
        data: $(this).serialize(),
        success: function (data) {
            $("#minDaysStatus").html(data);
        }
    });
});

//onchange save monthly_price
$('#monthly').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=addPrice",
        data: $(this).serialize(),
        success: function (data) {
            $("#mPriceStatus").html(data);
        }
    });
});

//onchange save min_days
$('#daily').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=addPrice",
        data: $(this).serialize(),
        success: function (data) {
            $("#dPriceStatus").html(data);
        }
    });
});

//onchange save Guest-fName
$('#first_name').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=guestInfo",
        data: $(this).serialize(),
        success: function (data) {
            $("#").html(data);
        }
    });
});

//onchange save Guest-lName
$('#last_name').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=guestInfo",
        data: $(this).serialize(),
        success: function (data) {
            $("#").html(data);
        }
    });
});

//onchange save Guest-gender
$('#gender').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=guestInfo",
        data: $(this).serialize(),
        success: function (data) {
            $("#").html(data);
        }
    });
});

//onchange save Guest-age
$('#age').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=guestInfo",
        data: $(this).serialize(),
        success: function (data) {
            $("#").html(data);
        }
    });
});

//onchange save Guest-ethnicity
$('#ethnicity').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=guestInfo",
        data: $(this).serialize(),
        success: function (data) {
            $("#").html(data);
        }
    });
});

//onchange save Guest-occupation
$('#list-space-occupation').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=guestInfo",
        data: $(this).serialize(),
        success: function (data) {
            $("#").html(data);
        }
    });
});

//onchange save Guest-from_country
$('#from_country').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=guestInfo",
        data: $(this).serialize(),
        success: function (data) {
            $("#").html(data);
        }
    });
});

//onchange save Guest-mobile
$('#mobile').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=guestInfo",
        data: $(this).serialize(),
        success: function (data) {
            $("#").html(data);
        }
    });
});

//onchange save Guest-purpose
$('#purpose').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=guestInfo",
        data: $(this).serialize(),
        success: function (data) {
            $("#").html(data);
        }
    });
});

//onchange save Guest-name_dest
$('#name_dest').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=guestInfo",
        data: $(this).serialize(),
        success: function (data) {
            $("#").html(data);
        }
    });
});

//onchange save Guest-Arrival
$('#from').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=guestArrival",
        data: $(this).serialize(),
        success: function (data) {
            $("#").html(data);
        }
    });
});

//onchange save Guest-Departure
$('#to').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=guestDeparture",
        data: $(this).serialize(),
        success: function (data) {
            $("#").html(data);
        }
    });
});

//onchange save Guest-Monthly_price
$('#monthly').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=guestPriceIntro",
        data: $(this).serialize(),
        success: function (data) {
            $("#").html(data);
        }
    });
});

//onchange save Guest-Daily_price
$('#daily').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=guestPriceIntro",
        data: $(this).serialize(),
        success: function (data) {
            $("#").html(data);
        }
    });
});

//onchange save Guest-Departure
$('#intro').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=guestPriceIntro",
        data: $(this).serialize(),
        success: function (data) {
            $("#").html(data);
        }
    });
});

//onchange save guest country
$('#country').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=addDest",
        data: $(this).serialize(),
        success: function (data) {
            $("#").html(data);
        }
    });
});

//onchange save city
$('#city').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=addDest",
        data: $(this).serialize(),
        success: function (data) {
            $("").html(data);
        }
    });
});

//onchange save street_number
$('#street_number').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=addDest",
        data: $(this).serialize(),
        success: function (data) {
            $("#").html(data);
        }
    });
});

//onchange save route
$('#route').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=addDest",
        data: $(this).serialize(),
        success: function (data) {
            $("#").html(data);
        }
    });
});

//onchange save state
$('#state').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=addDest",
        data: $(this).serialize(),
        success: function (data) {
            $("#").html(data);
        }
    });
});

//onchange save zip
$('#zip').change(function(){
	$.ajax({
        type: "POST",
        url: "doAction.php?act=addDest",
        data: $(this).serialize(),
        success: function (data) {
            $("#").html(data);
        }
    });
});





//**********************************
//
//**********************************






//info-form
$(function () {
    $("#info-form").submit(function (e) {
        e.preventDefault(); //STOP default action
        $.ajax({
            cache: false,
            url: $(this).attr("action"),
            type: "POST",
            data: $(this).serialize(),
            success: function (data) {
                $("#info-res").html(data);
            }
        });
        return false;
    });
});


$(function () {
    $("#avail-form").submit(function (e) {
        e.preventDefault(); //STOP default action
        $.ajax({
            cache: false,
            url: $(this).attr("action"),
            type: "POST",
            data: $(this).serialize(),
            success: function (data) {
                $("#avail-res").html(data);
            }
        });
        return false;
    });
});


//acco-form
$(function () {
    $("#acco-form").submit(function (e) {
        e.preventDefault(); //STOP default action
        $.ajax({
            cache: false,
            url: $(this).attr("action"),
            type: "POST",
            data: $(this).serialize(),
            success: function (data) {
                $("#acco-res").html(data);
            }
        });
        return false;
    });
});


//loca-form
$(function () {
    $("#loca-form").submit(function (e) {
        e.preventDefault(); //STOP default action
        $.ajax({
            cache: false,
            url: $(this).attr("action"),
            type: "POST",
            data: $(this).serialize(),
            success: function (data) {
            	$("#loca-res").html(data);
            }
        });
        return false;
    });
});

//cale-form
$(function () {
    $("#cale-form").submit(function (e) {
        e.preventDefault(); //STOP default action
        $.ajax({
            cache: false,
            url: $(this).attr("action"),
            type: "POST",
            data: $(this).serialize(),
            success: function (data) {
                $("#cale-res").html(data);
            }
        });
        return false;
    });
});


//price-form
$(function () {
    $("#price-form").submit(function (e) {
        e.preventDefault(); //STOP default action
        $.ajax({
            cache: false,
            url: $(this).attr("action"),
            type: "POST",
            data: $(this).serialize(),
            success: function (data) {
                $("#price-res").html(data);
            }
        });
        return false;
    });
});

//pic-form
$(function () {
    $("#picForm").submit(function (e) {
        e.preventDefault(); //STOP default action
        $.ajax({
            url: $(this).attr("action"),
            type: "POST",
            data: $(this).serialize(),
            success: function (data) {
                $("#pic1-res").html(data);
            }
        });
        return false;
    });
});


//photo-form
function showCheckIcon(){
	document.getElementById('photoCheck').style.display="block";
	$('#cancelImg').remove();
}


//serv-form
$(function () {
    $("#serv-form").submit(function (e) {
        e.preventDefault(); //STOP default action
        $.ajax({
            cache: false,
            url: $(this).attr("action"),
            type: "POST",
            data: $(this).serialize(),
            success: function (data) {
                $("#serv-res").html(data);
            }
        });
        return false;
    });
});



//Datepicker
$(function() {
    $( ".from" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      changeYear:true,
      numberOfMonths: 1,
      minDate:0,
      showButtonPanel:true,
      onClose: function( selectedDate ) {
        $( ".to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( ".to" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      changeYear:true,
      numberOfMonths: 2,
      showButtonPanel:true,
      onClose: function( selectedDate ) {
        $( ".from" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });


function infoAcco(){
    $('#info-tab').removeClass('active');
    $('#acco-tab').addClass('active');
}

function accoInfo(){
    $('#acco-tab').removeClass('active');
    $('#info-tab').addClass('active');
}

function accoLoca(){
    $('#acco-tab').removeClass('active');
    $('#loca-tab').addClass('active');
}

function locaAcco(){
    $('#loca-tab').removeClass('active');
    $('#acco-tab').addClass('active');
}

function locaCale(){
    $('#loca-tab').removeClass('active');
    $('#cale-tab').addClass('active');
}

function caleLoca(){
    $('#cale-tab').removeClass('active');
    $('#loca-tab').addClass('active');
}

function calePrice(){
    $('#cale-tab').removeClass('active');
    $('#price-tab').addClass('active');
}

function priceCale(){
    $('#price-tab').removeClass('active');
    $('#cale-tab').addClass('active');
}

function pricePhoto(){
    $('#price-tab').removeClass('active');
    $('#photo-tab').addClass('active');
}

function photoPrice(){
    $('#photo-tab').removeClass('active');
    $('#price-tab').addClass('active');
}

function photoAmen(){
    $('#photo-tab').removeClass('active');
    $('#amen-tab').addClass('active');
}

function amenPhoto(){
    $('#amen-tab').removeClass('active');
    $('#photo-tab').addClass('active');
}



//window onload
jQuery(document).ready(function ($) {



	//Carouel images
	$('.carousel').carousel({
	    interval: 5000 //changes the speed
	});


	//Images gallery in reviwPage
    var _SlideshowTransitions = [
    //Fade in L
        {$Duration: 1200, x: 0.3, $During: { $Left: [0.3, 0.7] }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
    //Fade out R
        , { $Duration: 1200, x: -0.3, $SlideOut: true, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
    //Fade in R
        , { $Duration: 1200, x: -0.3, $During: { $Left: [0.3, 0.7] }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
    //Fade out L
        , { $Duration: 1200, x: 0.3, $SlideOut: true, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }

    //Fade in T
        , { $Duration: 1200, y: 0.3, $During: { $Top: [0.3, 0.7] }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
    //Fade out B
        , { $Duration: 1200, y: -0.3, $SlideOut: true, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
    //Fade in B
        , { $Duration: 1200, y: -0.3, $During: { $Top: [0.3, 0.7] }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
    //Fade out T
        , { $Duration: 1200, y: 0.3, $SlideOut: true, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }

    //Fade in LR
        , { $Duration: 1200, x: 0.3, $Cols: 2, $During: { $Left: [0.3, 0.7] }, $ChessMode: { $Column: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
    //Fade out LR
        , { $Duration: 1200, x: 0.3, $Cols: 2, $SlideOut: true, $ChessMode: { $Column: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
    //Fade in TB
        , { $Duration: 1200, y: 0.3, $Rows: 2, $During: { $Top: [0.3, 0.7] }, $ChessMode: { $Row: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
    //Fade out TB
        , { $Duration: 1200, y: 0.3, $Rows: 2, $SlideOut: true, $ChessMode: { $Row: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }

    //Fade in LR Chess
        , { $Duration: 1200, y: 0.3, $Cols: 2, $During: { $Top: [0.3, 0.7] }, $ChessMode: { $Column: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
    //Fade out LR Chess
        , { $Duration: 1200, y: -0.3, $Cols: 2, $SlideOut: true, $ChessMode: { $Column: 12 }, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
    //Fade in TB Chess
        , { $Duration: 1200, x: 0.3, $Rows: 2, $During: { $Left: [0.3, 0.7] }, $ChessMode: { $Row: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
    //Fade out TB Chess
        , { $Duration: 1200, x: -0.3, $Rows: 2, $SlideOut: true, $ChessMode: { $Row: 3 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }

    //Fade in Corners
        , { $Duration: 1200, x: 0.3, y: 0.3, $Cols: 2, $Rows: 2, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $ChessMode: { $Column: 3, $Row: 12 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }
    //Fade out Corners
        , { $Duration: 1200, x: 0.3, y: 0.3, $Cols: 2, $Rows: 2, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $SlideOut: true, $ChessMode: { $Column: 3, $Row: 12 }, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true }

    //Fade Clip in H
        , { $Duration: 1200, $Delay: 20, $Clip: 3, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
    //Fade Clip out H
        , { $Duration: 1200, $Delay: 20, $Clip: 3, $SlideOut: true, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseOutCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
    //Fade Clip in V
        , { $Duration: 1200, $Delay: 20, $Clip: 12, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
    //Fade Clip out V
        , { $Duration: 1200, $Delay: 20, $Clip: 12, $SlideOut: true, $Assembly: 260, $Easing: { $Clip: $JssorEasing$.$EaseOutCubic, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 }
        ];

    //Images gallery in reviwPage
    var options = {
        $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
        $AutoPlayInterval: 1500,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
        $PauseOnHover: 1,                                //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

        $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
        $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
        $SlideDuration: 800,                                //Specifies default duration (swipe) for slide in milliseconds

        $SlideshowOptions: {                                //[Optional] Options to specify and enable slideshow or not
            $Class: $JssorSlideshowRunner$,                 //[Required] Class to create instance of slideshow
            $Transitions: _SlideshowTransitions,            //[Required] An array of slideshow transitions to play slideshow
            $TransitionsOrder: 1,                           //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
            $ShowLink: true                                    //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
        },

        $ArrowNavigatorOptions: {                       //[Optional] Options to specify and enable arrow navigator or not
            $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
            $ChanceToShow: 1                               //[Required] 0 Never, 1 Mouse Over, 2 Always
        },

        $ThumbnailNavigatorOptions: {                       //[Optional] Options to specify and enable thumbnail navigator or not
            $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
            $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always

            $ActionMode: 1,                                 //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
            $SpacingX: 8,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
            $DisplayPieces: 10,                             //[Optional] Number of pieces to display, default value is 1
            $ParkingPosition: 360                          //[Optional] The offset position to park thumbnail
        }
    };

  //Images gallery in reviwPage
    var jssor_slider1 = new $JssorSlider$("slider1_container", options);
    //responsive code begin
    //you can remove responsive code if you don't want the slider scales while window resizes
    function ScaleSlider() {
        var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
        if (parentWidth)
            jssor_slider1.$ScaleWidth(Math.max(Math.min(parentWidth, 800), 300));
        else
            window.setTimeout(ScaleSlider, 30);
    }
    ScaleSlider();

    $(window).bind("load", ScaleSlider);
    $(window).bind("resize", ScaleSlider);
    $(window).bind("orientationchange", ScaleSlider);
    //responsive code end


});
//window onload


