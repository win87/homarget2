<?php

require_once 'include.php';
require_once 'header.php';
checkProfileSession();

$id=$_SESSION['user_id'];

$sql_info = "select * from tg_guest_info where guest_id = '{$id}'";
$guestInfo = fetchOne($sql_info);
$guestInfo['language']=explode(",",$guestInfo['language']);

$sql_request = "select * from tg_guest_request where guest_id = '{$id}'";
$guestRequest = fetchOne($sql_request);
$guestRequest['preferred_services']=explode(",",$guestRequest['preferred_services']);

?>

<!-- Page Content -->
<div class="container">
    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
        <div class="col-lg-12">
            <?php if($guestRequest['is_avail']==0):?>
            <div class="breadcrumb text-center" style="padding:10px 0;color:rgb(217,83,79);background:#fff;">
                <span class="fa fa-file-text-o" style="margin-right:20px;"></span>
                This is an unlisted draft
            </div>
            <?php endif; ?>

            <?php  if($guestRequest['is_avail']==1):?>
            <div class="breadcrumb text-center" style="padding:10px 0; color:rgb(92,184,92);background:#fff;">
                <span class="fa fa-file-text-o" style="margin-right:20px;"></span>
                Your space is listed
            </div>
            <?php endif; ?>

            <h1 class="page-header text-center" style="border-bottom:none; margin-top:5px;">
                <small>Make it easy for host family to fin you</small>
            </h1>

            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li class="active"><a href="review-request.php">Preview your request</a></li>
                     <span class="fr">Don't want to list yet? see <a href="guest-search-result.php" style="color:red;"> Host Family List</a> first</span>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <!-- Content Row -->
	<div class="row" style="margin-bottom:20px;">

		<!-- <div>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-list" style="background: red;">
    			<span class="sr-only"></span>
    			<span class="icon-bar"></span>
    			<span class="icon-bar"></span>
    			<span class="icon-bar"></span>
    		</button>
		</div>  -->

        <!-- Tab col-md-3 left side-->
		<div class="col-md-3" id="list-col">

<!--     		<div class="collapse navbar-collapse" id="nav-list"> -->

			<ul class="nav nav-pills nav-stacked text-left list-col-len" id="list-space-col3">

				<li class="active" id="info-tab">
				    <a href="#info" data-toggle="tab">Information</a>
                    <div id="info-res" class="save-style"></div>
				</li>

				<li id="acco-tab" style="position: relative;">
				    <a href="#acco" data-toggle="tab">Preferences</a>
				    <span id="acco-res" class="save-style"></span>
				</li>

				<li id="loca-tab" style="position: relative;">
				    <a href="#loca" data-toggle="tab" id="locaMap">Destination</a>
				    <span id="loca-res" class="save-style"></span>
				</li>
			</ul>

            <form method="post" id="avail-form" action="doAction.php?act=unShowRequest">
                 <table class="table table-bordered">
                    <caption><b>Manage Listing</b></caption>
                    <tbody>
                        <tr>
                           <td width="50%">Want host to view your request?</td>
                           <td>
                              <select class="form-control" name="is_avail" >
                                  <option value=1 <?php echo $guestRequest['is_avail']==1?"selected":null;?> >Yes</option>
                                  <option value=0 <?php echo $guestRequest['is_avail']==0?"selected":null;?> >No</option>
                              </select>
                            </td>
                        </tr>
                    <hr>
                    </tbody>
                 </table>
                 <button class="btn btn-primary "><b>Change Listing Status</b></button>
            </form>
            <div id="avail-res"></div>

<!--            </div> -->
        </div>
		<!-- Tab col-md-3 left side end-->

		<!-- Tab contents col-md-9 right side -->
		<div class="col-md-9">
			<div id="myTabContent" class="tab-content">

			<!-- Basic info tab begin-->
			<div class="tab-pane fade in active" id="info" >

			    <!-- Guest profile img upload-->
			    <form method="post" enctype="multipart/form-data" id="pic-upload">

		        <table class="table table-condensed">
					<tbody>
    					<tr>
    					    <label for="">Upload your profile image</label>
    						<td class="text-center" style="width:34%;">
    						<?php $profileImg=getProfileImgById($_SESSION['user_id']);
                                  if(!empty($profileImg['picture'])){
                            ?>
                            <img src="uploads/profile_img/user_id_<?php echo $_SESSION['user_id']."/".$profileImg['picture'];?>" class="img-thumbnail" id="guest-img">
                            <?php } else{ ?>
                            <img src="images/default/profile-img.png" class="img-thumbnail" id="guest-img" >
                            <?php } ?>

    						</td>
    						<td style="position:relative;">

    							<label for="picture">
    				                <img src="images/default/cam.png" id="pic-upload-btn" alt="choose file" onclick="chProfileImg()" />
    				            </label>
            				<input type="file" name="picture" id="picture">

                            <button type="submit" class="btn btn-success" id="upPicBtn" disabled onclick="hideCancel();" >Upload picture</button>
                            <div id="pic-area">
                                <!-- pic will be appended here -->
                            </div>

    						</td>
    					</tr>
					</tbody>
			    </table>
		        </form>
                <!-- Guest profile img upload end -->

                <form method="post" action="doAction.php?act=guestAllInfo" id="info-form">

					<table class="table table-condensed" style="margin-left:85px;">
						<tbody>
							<tr>
								<td width="30%;">
								    <label for="">First Name</label>
									<input type="text" class="form-control list-space-input" value="<?php echo $guestInfo['first_name']?$guestInfo['first_name']:null; ?>" name="first_name" id="first_name" required>
								    <!-- <span class="hidden-xs" id="lsLnameStatus" style="position:absolute;top:3px;right:63px;"></span>-->
								</td>
								<td>
								    <label for="">Last Name</label>
									<input type="text" class="form-control list-space-input" value="<?php echo $guestInfo['last_name']?$guestInfo['last_name']:null; ?>" name="last_name" id="last_name" required>
								</td>
							</tr>

							<tr>

								<td>
								    <label for="">Gender</label>
									<select class="form-control list-space-input" name="gender" id="gender" required>
									    <option value=""> - select - </option>
										<option value=1 <?php echo $guestInfo['gender']==1?"selected":null;?> >Male</option>
										<option value=0 <?php echo $guestInfo['gender']===0?"selected":null;?> >Female</option>
									</select>
								</td>
								<td>
								    <label for="">Age</label>
									<input type="text" class="form-control list-space-input" value="<?php echo $guestInfo['age']?$guestInfo['age']:null; ?>" name="age" id="age" required>
								</td>
							</tr><!-- gender selection end -->
							<tr><!-- ethnicity -->
								<td>
								    <label for="">Ethnicity</label>
									<select class="form-control list-space-input" name="ethnicity" id="ethnicity" required>
									    <option value=""> - Select - </option>
										<option value="Hispanic" <?php echo $guestInfo['ethnicity']=="Hispanic"?"selected":null;?> >Hispanic</option>
										<option value="Asian" <?php echo $guestInfo['ethnicity']=="Asian"?"selected":null;?> >Asian</option>
										<option value="White" <?php echo $guestInfo['ethnicity']=="White"?"selected":null;?> >White</option>
										<option value="Black" <?php echo $guestInfo['ethnicity']=="Black"?"selected":null;?> >Black</option>
										<option value="Pacific Islander" <?php echo $guestInfo['ethnicity']=="Pacific Islander"?"selected":null;?> >Pacific Islander</option>
										<option value="Two or more races" <?php echo $guestInfo['ethnicity']=="Two or more races"?"selected":null;?> >Two or more races</option>
										<option value="Other" <?php echo $guestInfo['ethnicity']=="Other"?"selected":null;?> >Other</option>
									</select>
								</td>
								<td>
								    <label for="">Occupation</label>
									<select class="form-control list-space-input" id="list-space-occupation" name="occupation" required>
										<option value=""> - Select - </option>
										<option value=1 <?php echo $guestInfo['occupation']==1?"selected":null; ?> >Student</option>
										<option value=2 <?php echo $guestInfo['occupation']==2?"selected":null; ?> >Office worker</option>
										<option value=3 <?php echo $guestInfo['occupation']==3?"selected":null; ?> >Self employed</option>
										<option value=4 <?php echo $guestInfo['occupation']==4?"selected":null; ?> >Other</option>
									</select>
								</td>
							</tr><!-- ethnicity end -->

							<tr><!-- from country -->
								<td>
								    <label for="">Which country are you from</label>
									<input type="text" class="form-control list-space-input" value="<?php echo $guestInfo['from_country']?$guestInfo['from_country']:null; ?>" name="from_country" id="from_country" required>
								</td>
								<td>
								    <label for="">Mobile</label>
									<input type="text" class="form-control list-space-input" id="list-space-mobile-input" value="<?php echo $guestInfo['mobile']?$guestInfo['mobile']:null; ?>" placeholder="Phone Number" name="mobile" id="mobile" required>
								</td>
							</tr><!-- from country end -->

							<tr>
								<td>
								    <label for="">Purpose of travelling</label>
									<select class="form-control list-space-input" id="purpose" name="purpose" required>
										<option value=""> - Select - </option>
										<option value=1 <?php echo $guestInfo['purpose']==1?"selected":null; ?> >Study abroad</option>
										<option value=2 <?php echo $guestInfo['purpose']==2?"selected":null; ?> >Travel</option>
										<option value=3 <?php echo $guestInfo['purpose']==3?"selected":null; ?> >Business</option>
										<option value=4 <?php echo $guestInfo['purpose']==5?"selected":null; ?> >Other</option>
									</select>
								</td>
								<td>
								    <label for="">Name of school/company</label>
									<input type="text" class="form-control list-space-input" placeholder="e.g. Moreau high school" name="name_dest" id="name_dest" value="<?php echo $guestInfo['name_dest']?$guestInfo['name_dest']:null; ?>" >
								</td>
							</tr>

							<tr><!-- Language skills begin -->
								<td>
                                    <label for="">Language</label>
								<div class="scrollField">
									<div class="checkbox">
									   <label><input type="checkbox" value=1 name="language[]" checked <?php if(in_array(1, $guestInfo['language'])) echo 'checked="checked"'; ?> />English</label>
									</div>
									<div class="checkbox">
									   <label><input type="checkbox" value=2 name="language[]" <?php if(in_array(2, $guestInfo['language'])) echo 'checked="checked"'; ?> />Spanish</label>
									</div>
									<div class="checkbox">
									   <label><input type="checkbox" value=3 name="language[]" <?php if(in_array(3, $guestInfo['language'])) echo 'checked="checked"'; ?> />Chinese</label>
									</div>
									<div class="checkbox">
									   <label><input type="checkbox" value=4 name="language[]" <?php if(in_array(4, $guestInfo['language'])) echo 'checked="checked"'; ?> />Vietnamese</label>
									</div>
									<div class="checkbox">
									   <label><input type="checkbox" value=5 name="language[]" <?php if(in_array(5, $guestInfo['language'])) echo 'checked="checked"'; ?> />Filipino</label>
									</div>
									<div class="checkbox">
									   <label><input type="checkbox" value=6 name="language[]" <?php if(in_array(6, $guestInfo['language'])) echo 'checked="checked"'; ?> />French</label>
									</div>
									<div class="checkbox">
									   <label><input type="checkbox" value=7 name="language[]" <?php if(in_array(7, $guestInfo['language'])) echo 'checked="checked"'; ?> />German</label>
									</div>
									<div class="checkbox">
									   <label><input type="checkbox" value=8 name="language[]" <?php if(in_array(8, $guestInfo['language'])) echo 'checked="checked"'; ?> />Indian</label>
									</div>
									<div class="checkbox">
									   <label><input type="checkbox" value=9 name="language[]" <?php if(in_array(9, $guestInfo['language'])) echo 'checked="checked"'; ?> />Arabic</label>
									</div>
									<div class="checkbox">
									   <label><input type="checkbox" value="a" name="language[]" <?php if(in_array('a', $guestInfo['language'])) echo 'checked="checked"'; ?> />Korean</label>
									</div>
									<div class="checkbox">
									   <label><input type="checkbox" value="b" name="language[]" <?php if(in_array('b', $guestInfo['language'])) echo 'checked="checked"'; ?> />Japanese</label>
									</div>
									<div class="checkbox">
									   <label><input type="checkbox" value="c" name="language[]" <?php if(in_array('c', $guestInfo['language'])) echo 'checked="checked"'; ?> />Portuguese</label>
									</div>
								</div>
								</td>
							</tr>
					   </tbody>
			     </table>


                    <!-- 鍜宭ist-space 鍏变韩涓�釜jquery event -->
                    <a href="#acco" data-toggle="tab" class="btn btn-primary fr marginL-20" type="button" onclick="infoAcco();"> Next step</a>
		            <button id="guest-btn" class="btn btn-success fr">Save</button>
		        </form>

		    </div>
			<!-- Basic info tab end -->

			<!-- Preferred tab begin-->
			<div class="tab-pane fade" id="acco">

				<!-- Form begin -->
				<form action="doAction.php?act=guestPre" method="post" id="acco-form">

					<table class="table table-condensed">
						<tbody>
							<!-- arrival date -->
							<tr>
							    <td class="text-right" width="30%">Arrival date</td>
								<td>
								   <div class="form-group">
										<input type="text" class="form-control list-space-input from" id="from" name="arrival" value="<?php echo $guestRequest['arrival']?$guestRequest['arrival']:null; ?>" placeholder="mm/dd/yyyy" required />
									</div>
								</td>
						    </tr>
						    <tr>
						        <td class="text-right">Departure date</td>
								<td>
								   <div class="form-group">
								       <input type="text" class="form-control list-space-input to" id="to" name="departure" value="<?php echo $guestRequest['departure']?$guestRequest['departure']:null; ?>" placeholder="mm/dd/yyyy" required />
								   </div>
								</td>
							</tr>
							<!-- arrival date end -->

							<!-- monthly price -->
							<tr>
								<td class="text-right">Monthly price max. </td>
								<td>
								<select class="form-control" id="currency-daily">
									<option>$</option>
								</select>
								<input type="text" class="form-control" id="monthly" name="m_price" value="<?php echo $guestRequest['m_price']?$guestRequest['m_price']:null; ?>" required />
								</td>
							</tr>
							<!-- monthly price end -->

							<tr><!-- daily price -->
								<td class="text-right">Daily price max. </td>
								<td>
								<select class="form-control" id="currency-daily">
									<option>$</option>
								</select>
								<input type="text" class="form-control" id="daily" name="d_price" value="<?php echo $guestRequest['d_price']?$guestRequest['d_price']:null; ?>" />
								Provide max. daily price if duration of stay is less than a month. )
								</td>
							</tr>
							<!-- daily price end -->

							<tr><!-- Services required begin -->
								<td class="text-right">Services required</td>
								<td>
								<div class="scrollField">
									<div class="checkbox">
									   <label><input type="checkbox" value=1 name="preferred_services[]" checked="checked" <?php if(in_array(1, $guestRequest['preferred_services'])) echo 'checked="checked"'; ?> >Meals</label>
									</div>
									<div class="checkbox">
									   <label><input type="checkbox" value=2 name="preferred_services[]" <?php if(in_array(2, $guestRequest['preferred_services'])) echo 'checked="checked"'; ?> >transportation</label>
									</div>
									<div class="checkbox">
									   <label><input type="checkbox" value=3 name="preferred_services[]" <?php if(in_array(3, $guestRequest['preferred_services'])) echo 'checked="checked"'; ?> >Laundry</label>
									</div>
									<div class="checkbox">
									   <label><input type="checkbox" value=4 name="preferred_services[]" <?php if(in_array(4, $guestRequest['preferred_services'])) echo 'checked="checked"'; ?> >Room cleaning</label>
									</div>
									<div class="checkbox">
									   <label><input type="checkbox" value=5 name="preferred_services[]" <?php if(in_array(5, $guestRequest['preferred_services'])) echo 'checked="checked"'; ?> >Internet</label>
									</div>
									<div class="checkbox">
									   <label><input type="checkbox" value=8 name="preferred_services[]" <?php if(in_array(8, $guestRequest['preferred_services'])) echo 'checked="checked"'; ?> >Wifi</label>
									</div>
									<div class="checkbox">
									   <label><input type="checkbox" value=6 name="preferred_services[]" <?php if(in_array(6, $guestRequest['preferred_services'])) echo 'checked="checked"'; ?> >Language Lesson</label>
									</div>
									<div class="checkbox">
									   <label><input type="checkbox" value=7 name="preferred_services[]" <?php if(in_array(7, $guestRequest['preferred_services'])) echo 'checked="checked"'; ?> >Airport pick-up</label>
									</div>
									<div class="checkbox">
                                       <label><input type="checkbox" value=9 name="preferred_services[]" <?php if(in_array(9, $guestRequest['preferred_services'])) echo 'checked="checked"'; ?> >Legal guardianship</label>
                                    </div>

								</div>
								</td>
							</tr>

							<!-- Introduction -->
							<tr>
								<td class="text-right">Introduction </td>
								<td>
									<textarea class="form-control" rows="5" name="intro" id="intro" placeholder="e.g. Your background, interest, field of study and etc." ><?php echo $guestRequest['intro']?$guestRequest['intro']:null; ?></textarea>
								</td>
							</tr>
							<!-- Introduction end -->

						</tbody>
					</table>
					<hr>

				    <a href="#loca" data-toggle="tab" class="btn btn-primary fr marginL-20" type="button" onclick="accoLoca();">Next step</a>
				    <button id="acco-btn" class="btn btn-success fr">Save</button>
				    <a href="#info" data-toggle="tab" class="btn btn-primary" type="button" onclick="accoInfo();">Previous</a>

				</form>

			</div>
			<!-- preferred tab end -->


			<!-- Destination tab begin -->
			<div class="tab-pane fade col-md-offset-1" id="loca">

					<form method="post" action="doAction.php?act=addDest" id="loca-form" >
						<table class="table table-condensed">
							<tbody>

							    <tr>
									<td>
									    <label for="">Enter your destination</label>
										<input type="text" class="form-control" style="width:152%" placeholder="e.g. 1600 Moutain View CA 94600" id="geocomplete" onblur="modify_add();formAddress();">
									</td>
								</tr>

								<tr><!-- Country -->

									<td>
									    <label for="">Country</label>
										<input type="text" class="form-control list-space-input" disabled="disabled" name="country" id="country" onkeyup="formAddress()" value="<?php echo $guestRequest['country']?$guestRequest['country']:null; ?>" required />
									</td>
									<td>
									    <label for="">City</label>
										<input type="text" class="form-control list-space-input" disabled="disabled" name="locality" id="city" onkeyup="formAddress()" value="<?php echo $guestRequest['locality']?$guestRequest['locality']:null; ?>" required />
									</td>
								</tr><!-- country end -->
								<tr>
                                    <td>
									    <label for="">Street number</label>
										<input type="text" class="form-control list-space-input" disabled="disabled" name="street_number" id="street_number" onkeyup="formAddress()" value="<?php echo $guestRequest['street_number']?$guestRequest['street_number']:null; ?>" />
									</td>
									<td>
									    <label for="">Street Address</label>
										<input type="text" class="form-control list-space-input" disabled="disabled" name="route" id="route" onkeyup="formAddress()" value="<?php echo $guestRequest['route']?$guestRequest['route']:null; ?>" />
									</td>

								<tr><!-- State -->
									<td>
									    <label for="">State</label>
										<input type="text" class="form-control list-space-input" disabled="disabled" name="administrative_area_level_1" id="state" onkeyup="formAddress()" value="<?php echo $guestRequest['administrative_area_level_1']?$guestRequest['administrative_area_level_1']:null; ?>" required />
									</td>
									<td>
									    <label for="">ZIP</label>
										<input type="text" class="form-control list-space-input" disabled="disabled" name="postal_code" id="zip" onkeyup="formAddress()" value="<?php echo $guestRequest['postal_code']?$guestRequest['postal_code']:null; ?>" />
									</td>
								</tr>
								<!-- ZIP end -->

								<!-- lat hide -->
								<tr class="search-hide">
									<td class="text-right">Lat</td>
									<td>
										<input type="text" name="lat" id="lat" value="<?php echo $guestRequest['lat']?$guestRequest['lat']:null; ?>" />
									</td>
								</tr>
								<!-- lat hide end -->

								<!-- lng hide end -->
								<tr class="search-hide"><!-- lng -->
									<td class="text-right">Lng</td>
									<td>
										<input type="text" name="lng" id="lng" value="<?php echo $guestRequest['lng']?$guestRequest['lng']:null; ?>" />
									</td>
								</tr>
								<!-- lng hide end -->

							</tbody>
						</table>

				    <input type="button" class="btn btn-danger" id="findMe" style="margin-bottom:10px;" value="Check your address" onclick="formAddress(); codeAddress();">
                    <!-- A hidden input area to get location -->
	                <b><i><input id="pac-input" type="text" readonly style="width:70%;border:none;text-indent:10px;font-size:20px;" /></i></b>
                    <p>Please click <b>"Save"</b> button to save your address.</p>

                    <!-- Google map display panel -->
                    <div>
                        <div id="map-canvas" style="width:100%;height:300px;"></div>
                    </div>

                    <hr>

                    <a href="review-request.php" class="btn btn-success fr marginL-20" type="button">Preview request</a>
                    <button id="loca-btn" class="btn btn-success fr" >Save</button>
				    <a href="#acco" data-toggle="tab" class="btn btn-primary" type="button" onclick="locaAcco();">Previous</a>
			    </form>
			</div>
			<!-- Destination tab end -->
			</div><!-- Tab contents col-md-9 -->
		</div><!-- Tab col-md-9 end-->
	</div>
	<!-- row -->
</div>
<!-- outside container -->


<?php

	require_once 'footer.php';

?>
