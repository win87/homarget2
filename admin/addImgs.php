<?php

require_once '../include.php';

checkLogined();

$id=$_REQUEST['id'];

$sql="select * from tg_house_img where album_id={$id}";
$rows=fetchAll($sql);


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>-.-</title>
<link href="./styles/global.css"  rel="stylesheet"  type="text/css" media="all" />


<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">



<link href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet"  />

<!-- file upload -->
<link href="../css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="../js/fileinput.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>




</head>
<body>

<!-- Multiple images upload begin -->
    				<h2> Upload your house & family photos (multiple uploads) </h2>
    				<span style="color:red">(up to 20 images, not to exceed 2MB per image)</span>
    				<ul style="list-style:none;">
    				   <li>1. Click the 'Pick Image' button to select your images that you want to upload;</li>
    				   <li>2. Make sure that all images are displayed correctly;</li>
    				   <li>3.click the 'upload' button once to upload the all images;</li>
    				</ul>
                    <form enctype="multipart/form-data">
                    <div class="container fl col-md-12 col-sm-12 col-xs-12">
                        <div>
                            <input id="house-imgs" type="file" name=images[] multiple accept="image/*" >
                        </div>
                        <hr>
                    </div>

                    </form>
    			    <!-- Multiple images upload for end -->


                    <script>
                        $("#house-imgs").fileinput({
                            uploadUrl: "doAdminAction.php?act=addImgs&album_id=<?php echo $id; ?>",
                            allowedFileExtensions : ['jpg','jpeg','png','gif','wbmp'],
                            overwriteInitial: false,
                            maxFileSize: 2097152,
                            maxFilesNum: 20,
                            allowedFileTypes: ['image'],
                            previewFileType: "image",
                        	browseClass: "btn btn-success",
                        	browseLabel: "Pick Image",
                        	browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
                        	removeClass: "btn btn-danger",
                        	removeLabel: "Delete",
                        	removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
                        	uploadClass: "btn btn-info",
                        	uploadLabel: "Upload",
                        	uploadIcon: '<i class="glyphicon glyphicon-upload"></i>',
                        });
</script>
</body>
</html>
