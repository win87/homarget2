	//indirect ajax
	//file collection array
	var fileCollection = new Array();



	$('#images').on('change',function(e){

    	var files = e.target.files;

    	$.each(files, function(i,file){

    		fileCollection.push(file);

    		var reader = new FileReader();

    		reader.readAsDataURL(file);

    		reader.onload=function(e){

			var template = '<form id="houseImgs" class="houseImgs" method="POST" enctype="multipart/form-data">'+
			    			   '<div class="fl" style="width:150px;margin-right:20px;">'+
			    				   '<img src="'+e.target.result+'" style="width:150px;height:150px;">'+
			    				   //'<div><a href="#" class="btn btn-sm btn-danger cancel fl cancelImg" id="cancelImg" onclick="rmOneImg();">Cancel</a></div>'+
			    				   '<div class="progress progress-striped" style="height:30px;border-radius:0px;">'+
			    				   '<div class="progress-bar" style="line-height:30px;"></div>'+
				    			   '</div>'+
				    		   '</div>'+
				    		   '</form>';

			$("#images-area").append(template);

		};

	});

});


	//form upload ... delegation
	$(document).on('submit','#images-upload',function(e){

		e.preventDefault();
		//this form index
		var index = $(this).index();

		var formdata = new FormData($(this)[0]); //direct form not object

		//append the file
		formdata.append('images[]', fileCollection[index]);

		var request = new XMLHttpRequest();
		request.open('post', 'doAction.php?act=addPhotos');

		request.send(formdata);


		//progress bar
		$form=$(this);

		uploadImage($form);

	});

	function uploadImage($form){
		$form.find('.progress-bar').removeClass('progress-bar-success')
								   .removeClass('progress-bar-danger');

		var formdata = new FormData($(this)[0]); //form element

		var index = $(this).index();
		formdata.append('images[]', fileCollection[index]);

		var request = new XMLHttpRequest();

		//progress event ...
		request.upload.addEventListener('progress',function(e){
			var percent = Math.round(e.loaded/e.total * 100);

			$form.find('.progress-bar').width(percent+'%').html(percent+'%');
		});

		//progress completed load event
		request.addEventListener('load',function(e){
			$form.find('.progress-bar').addClass('progress-bar-success').html('completed');
		});

		request.open('post', 'doAction.php?act=addPhotos');
		request.send(formdata);


		$form.on('click','.cancel',function(){
			request.abort();

			$form.find('.progress-bar').addClass('progress-bar-danger')
									   .removeClass('progress-bar-success')
									   .html('upload cancelled');

		});

	}

	$('#houseImgs').click(function(e){
		$(this).remove();
	});


	// active upload button when click choose files
	function chFile(){
		$('#houseImgs').attr({display:"block"});
		$('#upAllBtn').removeAttr('disabled');
	}

	// disable upload all button when click remove all button
	function rmAllImg(){
		// remove all images that haven't upload
		$('.houseImgs').remove();
		// clear the array of images
		document.getElementById('images').value="";
		document.getElementById('upAllBtn').disabled="disabled";
	}

