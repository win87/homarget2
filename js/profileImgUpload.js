	//indirect ajax
	//file collection array
	var fileCollectionImg = new Array();



	$('#picture').on('change',function(e){

    	var files = e.target.files;

    	$.each(files, function(i,file){

    		fileCollectionImg.push(file);

    		var reader = new FileReader();

    		reader.readAsDataURL(file);

    		reader.onload=function(e){

    			var template = '<form method="POST" enctype="multipart/form-data" class="profileImg">'+
    						   '<div style="width:116px;position:absolute;top:50px;right:0px;">'+
    					            '<img src="'+e.target.result+'" style="width:116px;height:116px;margin-bottom:5px;">'+
    					            '<a href="#" class="btn btn-sm btn-danger cancel fl" id="picCancel" style="width:100%;" onclick="rmProfileImg()">Cancel</a>'+
    					            '<div class="progress progress-striped fr" style="width:100%;height:30px;border-radius:0px;">'+
    	                            '<div class="progress-bar" style="line-height:30px;"></div>'+
    	                            '</div>'+
    	                        '</div>'+
    				            '</form>';

    			$("#pic-area").append(template);
    		};
    	});
    });

	//form upload ... delegation
	$(document).on('submit','#pic-upload',function(e){

		e.preventDefault();
		//this form index
		var index = $(this).index();

		var formdata = new FormData($(this)[0]); //direct form not object

		//append the file
		formdata.append('picture', fileCollectionImg[index]);

		var request = new XMLHttpRequest();
		request.open('post', 'doAction.php?act=addPic');

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
		formdata.append('picture', fileCollectionImg[index]);

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

		request.open('post', 'doAction.php?act=addPic');
		request.send(formdata);


		$form.on('click','.cancel',function(){
			request.abort();

			$form.find('.progress-bar').addClass('progress-bar-danger')
									   .removeClass('progress-bar-success')
									   .html('upload cancelled');

		});

	}

	function chProfileImg(){
		$('#upPicBtn').removeAttr('disabled');
	}

	function rmProfileImg(){

		document.getElementById('pic-upload').value="";
		$('#upPicBtn').attr('disabled',true);
		$('.profileImg').remove();
	}

	function hideCancel(){
		$('#picCancel').remove();
	}
