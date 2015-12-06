<?php
    require_once 'include.php';
    require_once 'header.php';
    checkProfileSession();

    $id=$_SESSION['user_id'];
    $email=$_SESSION['email'];

    $_POST['last_login']=date('Y-m-d H:i:s');
    $last_login=$_POST['last_login'];
    $sql="UPDATE tg_user_login SET last_login='{$last_login}' where user_id='{$id}'";
    mysql_query($sql);

    $sql="SELECT *
            FROM tg_user_login as l

            where l.user_id = {$id}";
    $row=fetchOne($sql);
    //print_r($rows);exit;
    $type=$row['user_type'];

?>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                   <!--  <li><a href="index.php">Home</a>
                    </li>
                    <li class="active"><a href="host-search-result.php">Guest Finder</a></li> -->
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">

        <!-- Tab col-md-3 left side-->
		<div class="col-md-3" id="list-col">
	        <ul class="nav nav-pills nav-stacked text-left" id="list-space-col3">
	            <?php if ($type==1):?>
	            <li class="active" style="position: relative;">
				    <a href="#photos-tab" data-toggle="tab">Photo Management</a>
				</li>
				<?php endif; ?>
				<li>
				    <a href="#profileImg-tab" data-toggle="tab">Edit profile picture</a>
				</li>
				<li>
				    <a href="#security-tab" data-toggle="tab">Security</a>
				</li>
			</ul>
        </div>
		<!-- Tab col-md-3 left side end-->

        <div class="col-md-9">
            <div id="myTabContent" class="tab-content">

            <!-- photo manamgement tab begin -->
            <?php if ($type==1):?>
    		<div class="tab-pane fade in active" id="photos-tab">
                <div class="col-md-12">
                    <table class="table table-condensed table-hover">
                        <caption style="padding:10px 0 10px 20px;border:1px solid #ccc;margin-top:20px;background:#ccc;color:white;">Photo Management</caption>
                        <tbody>
                        <tr>
                            <td>
                                <h3>1. Click the image that you want to delete;</h3>
                                <h3>2. Click "Yes" on the pop up window to delete the image.</h3>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <?php
                			$houseImgs=getAllImgsByHouseId($id);
                			foreach($houseImgs as $img):
                			    if(!empty($img['img_path'])){
                			?>
                			    <img style="cursor:pointer;width:150px;height:150px;margin-bottom:10px;" src="uploads/House_Album/user_id_<?php echo $id."/". $img['img_path']; ?>" onclick="delImg('<?php echo $img['album_id'];?>','<?php echo $img['img_path'];?>')" /> &nbsp;
                			<?php } endforeach;?>
                             </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
    		</div>
    		<!-- photo management tab end -->

    		<!-- Edit profile image tab begin-->
    		<div class="tab-pane fade" id="profileImg-tab" >
    		    <div class="col-md-9">
                    <table class="table table-condensed table-hover">

                        <caption style="padding:10px 0 10px 20px;border:1px solid #ccc;margin-top:20px;background:#ccc;color:white;">Profile Photo</caption>

                        <tbody>
                        <tr>
                           <td>
                               <h2> Upload your profile picture </h2>
                			   <ul style="list-style:none;">
                    			   <li>1. Click the 'Pick Image' button to select your profile image that you want to upload;</li>
                    			   <li>2. Make sure that the profile image is displayed correctly;</li>
                    			   <li>3. click the 'upload' button once to upload the profile image;</li>
                			   </ul>

                               <form enctype="multipart/form-data">
                                   <input id="picImg" type="file" name="picture" accept="image/*" >
                                   <br>
                               </form>
                           </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="thumbnail col-md-3" style="margin-top:62px;">
                    <?php if($row['picture']){ ?>
                        <img src="uploads/profile_img/user_id_<?php echo $id."/".$row['picture'];?>" >
                        <?php }else{ ?>
                        <img src="images/default/profile-img.png" >
                    <?php } ?>
                </div>
    	    </div>
    		<!-- Edit profile image tab end -->
    		<?php endif; ?>

    		<?php if ($type==2):?>
                <!-- Edit profile image tab begin-->
    		<div class="tab-pane fade in active" id="profileImg-tab" >
    		    <div class="col-md-9">
                    <table class="table table-condensed table-hover">

                        <caption style="padding:10px 0 10px 20px;border:1px solid #ccc;margin-top:20px;background:#ccc;color:white;">Profile Photo</caption>

                        <tbody>
                        <tr>
                           <td>
                               <h2> Upload your profile picture </h2>
                			   <ul style="list-style:none;">
                    			   <li>1. Click the 'Pick Image' button to select your profile image that you want to upload;</li>
                    			   <li>2. Make sure that the profile image is displayed correctly;</li>
                    			   <li>3. click the 'upload' button once to upload the profile image;</li>
                			   </ul>

                               <form enctype="multipart/form-data">
                                   <input id="picImg" type="file" name="picture" accept="image/*" >
                                   <br>
                               </form>
                           </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="thumbnail col-md-3" style="margin-top:62px;">
                    <?php if($row['picture']){ ?>
                        <img src="uploads/profile_img/user_id_<?php echo $id."/".$row['picture'];?>" >
                        <?php }else{ ?>
                        <img src="images/default/profile-img.png" >
                    <?php } ?>
                </div>
    	    </div>
    		<!-- Edit profile image tab end -->
    		<?php endif; ?>

    		<script>
  		        $("#picImg").fileinput({
        			uploadUrl: 'doAction.php?act=addPic',
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

    		      function delImg(album_id, img_path){
    	  		        if(window.confirm("Ready to delete this image? it can't be recovered!")){
    	  		              window.location="doAction.php?act=udelImg&album_id="+album_id+"&img_path="+img_path;
    	  		        }
    	  		    }
            </script>

    		<!-- Security tab begin -->
    		<div class="tab-pane fade" id="security-tab">
                <div class="col-md-12">
                <form action="doAction.php?act=changePwd&email=<?php echo $email ;?>" method="post">
                    <table class="table table-condensed table-hover">
                        <caption style="padding:10px 0 10px 20px;border:1px solid #ccc;margin-top:20px;background:#ccc;color:white;">Photo Management</caption>
                        <tbody>
                        <tr>
                            <td>
                                <!-- <input type="password" class="form-control list-space-input" name="oldPwd" id="oldPwd" required placeholder="Enter current password"> -->
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h3>New Password:</h3>
                                <input type="password" class="form-control list-space-input" name="password1" id="pwd1" required placeholder="Enter new password">
                                <p id="pwdErr1"></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h3>Re-type Password:</h3>
                                <input type="password" class="form-control list-space-input" name="password2" id="pwd2" required placeholder="Re-type new password">
                                <p id="pwdErr2"></p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <button type="submit" name="submit" value="submit" class="btn btn-danger fr" style="margin-bottom:20px;">Update Password</button>
                </form>
                </div>
    		</div>
    		<!-- Security tab end -->

            </div>
        </div>
        <!-- /.col-md-9 -->
        </div>
        <!-- /.row -->

        <hr>

    </div>
    <!-- Page container end -->


<?php
    include_once 'footer.php';
?>

