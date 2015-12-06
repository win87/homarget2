<?php

require_once 'include.php';
require_once 'header.php';
checkProfileSession();

$id=$_SESSION['user_id'];

$sql_host = "select * from tg_host_info where host_id = '{$id}'";
$hostInfo = fetchOne($sql_host);
$hostInfo['language']=explode(",",$hostInfo['language']);

$sql_house = "select * from tg_host_house where house_id = '{$id}'";
$hostHouse = fetchOne($sql_house);

$sql_services = "select * from tg_host_services where services_id = '{$id}'";
$hostServices = fetchOne($sql_services);
@$hostServices['daily_services']=explode(",", $hostServices['daily_services']);
@$hostServices['common']=explode(",", $hostServices['common']);
@$hostServices['extras']=explode(",", $hostServices['extras']);

$sql_loca = "select * from tg_house_location where location_id = '{$id}'";
$houseLoca = fetchOne($sql_loca);

$sql_cale = "select * from tg_host_calendar where calendar_id = '{$id}'";
$hostCale = fetchOne($sql_cale);

?>

<!-- Page Content -->
<div class="container" id="list-space-font">
    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
        <div class="col-lg-12">
            <?php if($hostCale['is_avail']==0):?>
            <div class="breadcrumb text-center" style="padding-top:10px;color:rgb(217,83,79);background:#fff;">
                <span class="fa fa-file-text-o" style="margin-right:20px;"></span>
                This is an unlisted draft
            </div>
            <?php endif; ?>

            <?php  if($hostCale['is_avail']==1):?>
            <div class="breadcrumb text-center" style="padding-top:10px; color:rgb(92,184,92);background:#fff;">
                <span class="fa fa-file-text-o" style="margin-right:20px;"></span>
                Your space is listed
            </div>
            <?php endif; ?>
            <h1 class="page-header text-center" style="border-bottom:none; margin-top:5px;">
                <small>Make it Easy for Guests to Find You </small>
            </h1>

            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li class="active"><a href="review-profile.php">Preview Listing</a></li>
                <span class="fr">Don't want to list yet? see <a href="host-search-result.php" style="color:red;"> Guest List</a> first </span>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <!-- Content Row -->
	<div class="row" style="margin-bottom:20px;">

        <!-- Tab col-md-3 left side-->
		<div class="col-md-3">

    		<ul class="nav nav-pills nav-stacked text-left list-col-len" id="list-space-col3">
    			<li class="active" id="info-tab">
    			    <a href="#info" data-toggle="tab">Information</a>
                    <div id="info-res" class="save-style"></div>
    			</li>

    			<li id="acco-tab" style="position: relative;">
    			    <a href="#acco" data-toggle="tab">Accommodation</a>
    			    <span id="acco-res" class="save-style"></span>
    			</li>

    			<li id="loca-tab" style="position: relative;">
    			    <a href="#loca" data-toggle="tab" id="locaMap">Location</a>
    			    <span id="loca-res" class="save-style"></span>
    			</li>

    			<li id="cale-tab" style="position: relative;">
    			    <a href="#cale" data-toggle="tab">Calendar</a>
    			    <span id="cale-res" class="save-style"></span>
    			</li>

    			<li id="price-tab" style="position: relative;">
    			    <a href="#price" data-toggle="tab">Pricing</a>
    			    <span id="price-res" class="save-style"></span>
    			</li>

    			<li id="photo-tab" style="position: relative;">
    			    <a href="#photo" data-toggle="tab">Photos</a>
    			    <img id="photoCheck" src='images/default/check.png' class="save-style" style='display:none;'></img>
    			</li>

    			<li id="amen-tab" style="position: relative;">
    			    <a href="#amen" data-toggle="tab">Amenities</a>
    			    <span id="serv-res" class="save-style"></span>
    			</li>

    		</ul>

    		<hr class="divider">

            <form method="post" id="avail-form" action="doAction.php?act=unShowHouse">
            <table class="table table-bordered">
                <caption><b>Manage Listing</b></caption>
                <tbody>
                    <tr>
                       <td width="50%">Want guest to view your listing?</td>
                       <td>
                          <select class="form-control" name="is_avail" >
                              <option value=1 <?php echo $hostCale['is_avail']==1?"selected":null;?> >Yes</option>
                              <option value=0 <?php echo $hostCale['is_avail']==0?"selected":null;?> >No</option>
                          </select>
                    </td>
                    </tr>

                </tbody>
            </table>
            <button class="btn btn-primary "><b>Change Listing Status</b></button>
            </form>
            <div id="avail-res"></div>
            </div>
		<!-- Tab col-md-3 left side end-->


		<!-- Tab contents col-md-9 right side -->
		<div class="col-md-9">
			<div id="myTabContent" class="tab-content">

			<!-- Basic info tab begin-->
			<div class="tab-pane fade in active" id="info" >
                <form method="post" id="info-form" action="doAction.php?act=addLanguage">
					<table class="table table-condensed">
						<tbody>
							<tr>
								<td class="text-right">First Name</td>
								<td>
									<input type="text" class="form-control list-space-input" value="<?php echo $hostInfo['first_name']?$hostInfo['first_name']:null; ?>" name="first_name" id="first_name" required>
									<!-- <span class="hidden-xs" id="lsNameStatus" style="position:absolute;top:3px;right:470px;"></span>-->
								</td>
								<td class="text-right">Last Name</td>
								<td>
									<input type="text" class="form-control list-space-input" value="<?php echo $hostInfo['last_name']?$hostInfo['last_name']:null; ?>" name="last_name" id="last_name" required >
								    <!-- <span class="hidden-xs" id="lsLnameStatus" style="position:absolute;top:3px;right:63px;"></span>-->
								</td>
							</tr>

							<tr>
								<td class="text-right">Gender</td>
								<td>
									<select class="form-control list-space-input" name="gender" id="gender" required >
									    <option value=""> - Select - </option>
										<option value=1 <?php echo $hostInfo['gender']==1?"selected":null;?> >Male</option>
										<option value=0 <?php echo $hostInfo['gender']===0?"selected":null;?> >Female</option>
									</select>
									<!-- <span class="hidden-xs" id="genderStatus" style="position:absolute;top:48px;right:469px;"></span>-->
								</td>
								<td class="text-right">Age</td>
								<td>
									<input type="text" class="form-control list-space-input" value="<?php echo $hostInfo['age']?$hostInfo['age']:null; ?>" name="age" id="age" required >
								    <!-- <span class="hidden-xs" id="ageStatus" style="position:absolute;top:49px;right:63px;"></span>-->
								</td>
							</tr><!-- gender selection end -->

							<tr><!-- Ethnicity -->
								<td class="text-right">Ethnicity</td>
								<td>
									<select class="form-control list-space-input" name="ethnicity" id="ethnicity" required>
									    <option value=""> - Select - </option>
										<option value="Hispanic" <?php echo $hostInfo['ethnicity']=="Hispanic"?"selected":null;?> >Hispanic</option>
										<option value="Asian" <?php echo $hostInfo['ethnicity']=="Asian"?"selected":null;?> >Asian</option>
										<option value="White" <?php echo $hostInfo['ethnicity']=="White"?"selected":null;?> >White</option>
										<option value="Black" <?php echo $hostInfo['ethnicity']=="Black"?"selected":null;?> >Black</option>
										<option value="Pacific Islander" <?php echo $hostInfo['ethnicity']=="Pacific Islander"?"selected":null;?> >Pacific Islander</option>
										<option value="Two or more races" <?php echo $hostInfo['ethnicity']=="Two or more races"?"selected":null;?> >Two or more races</option>
										<option value="Other" <?php echo $hostInfo['ethnicity']=="Other"?"selected":null;?> >Other</option>
									</select>
									<!-- <span class="hidden-xs" id="ethnicityStatus" style="position:absolute;top:93px;right:468px;"></span>-->
								</td>
								<td class="text-right">Occupation</td>
								<td>
									<select class="form-control list-space-input" id="list-space-occupation" name="occupation" required>
										<option value=""> - Select - </option>
										<option value="1" <?php echo $hostInfo['occupation']=="1"?"selected":null;?> >Office worker</option>
										<option value="2" <?php echo $hostInfo['occupation']=="2"?"selected":null;?> >Manual worker</option>
										<option value="3" <?php echo $hostInfo['occupation']=="3"?"selected":null;?> >Self-employed</option>
										<option value="4" <?php echo $hostInfo['occupation']=="4"?"selected":null;?> >Executive/Professional</option>
										<option value="5" <?php echo $hostInfo['occupation']=="5"?"selected":null;?> >Housewife</option>
										<option value="6" <?php echo $hostInfo['occupation']=="6"?"selected":null;?> >Retired</option>
										<option value="7" <?php echo $hostInfo['occupation']=="7"?"selected":null;?> >Student</option>
										<option value="8" <?php echo $hostInfo['occupation']=="8"?"selected":null;?> >Other</option>
									</select>
									<!-- <span class="hidden-xs" id="occupationStatus" style="position:absolute;top:93px;right:63px;"></span>-->
								</td>
							</tr><!-- Ethnicity end -->

							<tr>
								<td class="text-right">Phone</td>
								<td>
									<input type="text" class="form-control" id="list-space-phone" name="phone_code" value="<?php echo $hostInfo['phone_code']?$hostInfo['phone_code']:null; ?>" placeholder="Area code" required>
									<input type="text" class="form-control" id="list-space-phone-input" value="<?php echo $hostInfo['phone']?$hostInfo['phone']:null; ?>" placeholder="Phone number" name="phone" required>
									<!-- <span class="hidden-xs" id="phoneStatus" style="position:absolute;top:135px;right:468px;"></span>-->
								</td>
								<td class="text-right">Mobile</td>
								<td>
									<input type="text" class="form-control" id="list-space-mobile" value="<?php echo $hostInfo['mobile_code']?$hostInfo['mobile_code']:null; ?>" placeholder="Area code" name="mobile_code" required>
									<input type="text" class="form-control" id="list-space-mobile-input" value="<?php echo $hostInfo['mobile']?$hostInfo['mobile']:null; ?>" placeholder="Mobile number" name="mobile" required style="width:120px;float:left;">
								   <!--  <span class="hidden-xs" id="mobileStatus" style="position:absolute;top:136px;right:63px;"></span>-->
								</td>
							</tr>

							<tr><!-- Language skills begin -->
								<td class="text-right">Language skills</td>
								<td>
								<div class="scrollField">
									<div class="checkbox">
									   <label><input type="checkbox" value=1 name="language[]" checked <?php if(in_array(1, $hostInfo['language'])) echo 'checked="checked"'; ?> >English</label>
									</div>
									<div class="checkbox">
									   <label><input type="checkbox" value=2 name="language[]" <?php if(in_array(2, $hostInfo['language'])) echo 'checked="checked"'; ?> >Spanish</label>
									</div>
									<div class="checkbox">
									   <label><input type="checkbox" value=3 name="language[]" <?php if(in_array(3, $hostInfo['language'])) echo 'checked="checked"'; ?> >Chinese</label>
									</div>
									<div class="checkbox">
									   <label><input type="checkbox" value=4 name="language[]" <?php if(in_array(4, $hostInfo['language'])) echo 'checked="checked"'; ?> >Vietnamese</label>
									</div>
									<div class="checkbox">
									   <label><input type="checkbox" value=5 name="language[]" <?php if(in_array(5, $hostInfo['language'])) echo 'checked="checked"'; ?> >Filipino</label>
									</div>
									<div class="checkbox">
									   <label><input type="checkbox" value=6 name="language[]" <?php if(in_array(6, $hostInfo['language'])) echo 'checked="checked"'; ?> >French</label>
									</div>
									<div class="checkbox">
									   <label><input type="checkbox" value=7 name="language[]" <?php if(in_array(7, $hostInfo['language'])) echo 'checked="checked"'; ?> >German</label>
									</div>
									<div class="checkbox">
									   <label><input type="checkbox" value=8 name="language[]"<?php if(in_array(8, $hostInfo['language'])) echo 'checked="checked"'; ?> >Indian</label>
									</div>
									<div class="checkbox">
									   <label><input type="checkbox" value=9 name="language[]" <?php if(in_array(9, $hostInfo['language'])) echo 'checked="checked"'; ?> >Arabic</label>
									</div>
									<div class="checkbox">
									   <label><input type="checkbox" value="a" name="language[]" <?php if(in_array('a', $hostInfo['language'])) echo 'checked="checked"'; ?> >Korean</label>
									</div>
									<div class="checkbox">
									   <label><input type="checkbox" value="b" name="language[]" <?php if(in_array('b', $hostInfo['language'])) echo 'checked="checked"'; ?> >Japanese</label>
									</div>
									<div class="checkbox">
									   <label><input type="checkbox" value="c" name="language[]" <?php if(in_array('c', $hostInfo['language'])) echo 'checked="checked"'; ?> >Portuguese</label>
									</div>
								</div>
								<!--  <span class="hidden-xs" id="languageStatus" style="position:absolute;top:366px;right:320px;"></span> -->
								</td>
							</tr>

						</tbody>
					</table>

					<a href="#acco" type="button" data-toggle="tab" class="btn btn-primary fr marginL-20" onclick="infoAcco();">Next step</a>
		            <button class="btn btn-success save-btn fr">Save</button>
		        </form>

		    </div>
			<!-- Basic info tab end -->



			<!-- Accommodation tab begin-->
			<div class="tab-pane fade col-md-offset-1" id="acco">

				<!-- Form begin -->
				<form method="post" id="acco-form" action="doAction.php?act=addAllAcco">
					<table class="table table-condensed">
						<tbody>
						    <tr><!-- no. of adults -->
								<td>
								   <label for="">No. of adult in your house</label>
									  <label for="name"></label>
										<select class="form-control list-space-input" id="adult_no" name="adult_no" required>
										    <option value=""> - select - </option>
											<option value=1 <?php echo $hostHouse['adult_no']==1?"selected":null;?> >1</option>
											<option value=2 <?php echo $hostHouse['adult_no']==2?"selected":null;?> >2</option>
											<option value=3 <?php echo $hostHouse['adult_no']==3?"selected":null;?> >3</option>
											<option value=4 <?php echo $hostHouse['adult_no']==4?"selected":null;?> >4</option>
											<option value=5 <?php echo $hostHouse['adult_no']==5?"selected":null;?> >5+</option>
										</select>
									<!-- <span class="hidden-xs" id="adultStatus" style="position:absolute;top:28px;right:553px;"></span>-->
								</td>

								<td>
								   <label for="">No. of child in your house</label>
									  <label for="name"></label>
										<select class="form-control list-space-input" id="child_no" name="child_no" required>
										    <option value=""> - select - </option>
										    <option value=0 <?php echo $hostHouse['child_no']==0?"selected":null;?> >0</option>
											<option value=1 <?php echo $hostHouse['child_no']==1?"selected":null;?> >1</option>
											<option value=2 <?php echo $hostHouse['child_no']==2?"selected":null;?> >2</option>
											<option value=3 <?php echo $hostHouse['child_no']==3?"selected":null;?> >3</option>
											<option value=4 <?php echo $hostHouse['child_no']==4?"selected":null;?> >4</option>
											<option value=5 <?php echo $hostHouse['child_no']==5?"selected":null;?> >5+</option>
										</select>
									<!-- <span class="hidden-xs" id="childStatus" style="position:absolute;top:28px;right:166px;"></span> -->
								</td>
							</tr><!-- no. of adults end -->

					    	<tr><!-- house type -->
    							<td>
    							   <label for="">House type</label>
    								  <label for="name"></label>
    									<select class="form-control list-space-input" id="house_type" name="house_type" required>
    									    <option value=""> - select - </option>
    										<option value=1 <?php echo $hostHouse['house_type']==1?"selected":null;?> >House</option>
    										<option value=2 <?php echo $hostHouse['house_type']==2?"selected":null;?> >Apartment</option>
    										<option value=3 <?php echo $hostHouse['house_type']==3?"selected":null;?> >Condo</option>
    										<option value=4 <?php echo $hostHouse['house_type']==4?"selected":null;?> >Town house</option>
    										<option value=5 <?php echo $hostHouse['house_type']==5?"selected":null;?> >Other</option>
    									</select>
    								 <!-- <span class="hidden-xs" id="houseTypeStatus" style="position:absolute;top:98px;right:553px;"></span> -->
								</td>
								<td>
								   <label for="">Room type</label>
									  <label for="name"></label>
										<select class="form-control list-space-input" id="room_type" name="room_type" required>
										    <option value=""> - select - </option>
											<option value=1 <?php echo $hostHouse['room_type']==1?"selected":null;?> >Private Room</option>
											<option value=2 <?php echo $hostHouse['room_type']==2?"selected":null;?> >Shared Room</option>
											<option value=3 <?php echo $hostHouse['room_type']==3?"selected":null;?> >Entire Home</option>
										</select>
								<!-- <span class="hidden-xs" id="roomTypeStatus" style="position:absolute;top:97px;right:166px;"></span> -->
								</td>
							</tr><!-- house type end -->

							<tr><!-- Bedrooms -->
								<td>
								   <label for="">No. of bedrooms</label>
									  <label for="name"></label>
										<select class="form-control list-space-input" id="bedroom" name="bedroom" required>
										    <option value=""> - select - </option>
											<option value="1" <?php echo $hostHouse['bedroom']=="1"?"selected":null;?> >1</option>
											<option value="2" <?php echo $hostHouse['bedroom']=="2"?"selected":null;?> >2</option>
											<option value="3+" <?php echo $hostHouse['bedroom']=="3+"?"selected":null;?> >3+</option>
										</select>
								<!-- <span class="hidden-xs" id="bedroomStatus" style="position:absolute;top:166px;right:553px;"></span> -->
								</td>
								<td>
								   <label for="">No. of bathrooms</label>
									  <label for="name"></label>
										<select class="form-control list-space-input" id="bathroom" name="bathroom" required>
										<option value=""> - select - </option>
											<option value="1" <?php echo $hostHouse['bathroom']=="1"?"selected":null;?> >1</option>
											<option value="1.5" <?php echo $hostHouse['bathroom']=="1.5"?"selected":null;?> >1.5</option>
											<option value="2+" <?php echo $hostHouse['bathroom']=="2+"?"selected":null;?> >2+</option>
										</select>
									 <!-- <span class="hidden-xs" id="bathroomStatus" style="position:absolute;top:166px;right:166px;"></span> -->
								</td>
							</tr><!-- Bedrooms end -->
	                   </tbody>
					</table>

					<!-- House title -->
					<label style="position:relative;">Title of listing</label>
					<!-- <span class="hidden-xs" id="titleStatus" style="position:absolute;top:217px;right:660px;"></span> -->
					<input type="text" class="form-control" id="house_title" name="house_title" placeholder="e.g. spacious room close to SFCS" value="<?php echo $hostHouse['house_title']?$hostHouse['house_title']:null; ?>" required />
					<!-- House title end -->

					<!-- House summary -->
					<label style="margin-top:10px;">Introduction </label>
					<!--  <span class="hidden-xs" id="introStatus" style="position:absolute;top:289px;right:660px;"></span>-->
					<textarea class="form-control" rows="5" cols="20" id="summary" name="summary" placeholder="e.g. family background, interest, hosting experience and etc."><?php echo $hostHouse['summary']?$hostHouse['summary']:null; ?></textarea>
					<!-- House summary end -->

                    <br />

                    <a href="#loca" data-toggle="tab" class="btn btn-primary fr marginL-20" type="button" onclick="accoLoca();">Next step</a>
			        <button class="btn btn-success save-btn fr">Save</button>
			        <a href="#info" data-toggle="tab" class="btn btn-primary" type="button" onclick="accoInfo();">Previous</a>
				</form>

			</div>
			<!-- Accommodation tab end -->

			<!-- Location tab begin -->
			<div class="tab-pane fade col-md-offset-1" id="loca" >

					<form method="post" action="doAction.php?act=addLocation" id="loca-form" >
						<table class="table table-condensed">
							<tbody>
							    <tr>
									<td>
									    <label for="">Enter your full address</label>
										<input type="text" class="form-control" placeholder="e.g. 1600 Moutain view CA 96000" style="width:152%" id="geocomplete" onblur="modify_add(); formAddress();" />
									</td>
								</tr>

								<tr>
									<td>
									    <label for="">Country</label>
										<input type="text" class="form-control list-space-input" disabled="disabled" name="country" id="country" onkeyup="formAddress()" value="<?php echo $houseLoca['country']?$houseLoca['country']:null; ?>" required />
									    <!--  <span class="hidden-xs" id="countryStatus" style="position:absolute;top:104px;right:553px;"></span> -->
									</td>

									<td>
										<label for="">City</label>
									    <input type="text" class="form-control list-space-input" disabled="disabled" name="locality" id="city" onkeyup="formAddress()" value="<?php echo $houseLoca['locality']?$houseLoca['locality']:null; ?>" required />
									    <!-- <span class="hidden-xs" id="cityStatus" style="position:absolute;top:104px;right:142px;"></span> -->
									</td>
								</tr>

								<tr>
									<td>
									    <label for="">House Number (optional)</label>
										<input type="text" class="form-control list-space-input" disabled="disabled" name="street_number" id="street_number" onkeyup="formAddress()" value="<?php echo $houseLoca['street_number']?$houseLoca['street_number']:null; ?>" />
									    <!-- <span class="hidden-xs" id="numberStatus" style="position:absolute;top:173px;right:553px;"></span>-->
									</td>
									<td>
										<label for="">Street Address</label>
										<input type="text" class="form-control list-space-input" disabled="disabled" name="route" id="route" onkeyup="formAddress()" value="<?php echo $houseLoca['route']?$houseLoca['route']:null; ?>" />
									   <!--  <span class="hidden-xs" id="routeStatus" style="position:absolute;top:172px;right:142px;"></span>-->
									</td>
								</tr>

								<tr>
									<td>
									    <label for="">State</label>
										<input type="text" class="form-control list-space-input" disabled="disabled" name="administrative_area_level_1" id="state" onkeyup="formAddress()" value="<?php echo $houseLoca['administrative_area_level_1']?$houseLoca['administrative_area_level_1']:null; ?>" required />
									   <!--  <span class="hidden-xs" id="stateStatus" style="position:absolute;top:243px;right:553px;"></span>-->
									</td>
									<td>
									    <label for="">ZIP</label>
										<input type="text" class="form-control list-space-input" disabled="disabled" name="postal_code" id="zip" onkeyup="formAddress()" value="<?php echo $houseLoca['postal_code']?$houseLoca['postal_code']:null; ?>" />
									    <!-- <span class="hidden-xs" id="zipStatus" style="position:absolute;top:242px;right:142px;"></span>-->
									</td>
								</tr>

								<!-- lat hide -->
								<tr class="search-hide">
									<td class="text-right">Lat</td>
									<td>
										<input type="text" name="lat" id="lat" value="<?php echo $houseLoca['lat']?$houseLoca['lat']:null; ?>" />
									</td>
								</tr>
								<!-- lat hide end -->

								<!-- lng hide end -->
								<tr class="search-hide"><!-- lng -->
									<td class="text-right">Lng</td>
									<td>
										<input type="text" name="lng" id="lng" value="<?php echo $houseLoca['lng']?$houseLoca['lng']:null; ?>" />
									</td>
								</tr>
								<!-- lng hide end -->

							</tbody>
						</table>

				    <input type="button" class="btn btn-danger" id="findMe" value="Check your address" style="margin-bottom:10px;" onclick="formAddress(); codeAddress();">

                    <!-- A hidden input area to get location -->
	                <b><i><input id="pac-input" type="text" readonly style="width:70%;border:none;text-indent:10px;font-size:16px;" /></i></b>
                    <p>Please click <b>"Save"</b> button to save your address.</p>
                    <!-- Google map display begin -->
                    <div>
                        <div id="map-canvas" style="width:100%;height:300px;"></div>
                    </div>
                    <!-- Google map display end-->

                    <hr>

                    <a href="#cale" data-toggle="tab" class="btn btn-primary fr marginL-20" type="button" onclick="locaCale();">Next step</a>
				    <button class="btn btn-success fr" save-btn>Save</button>
				    <a href="#acco" data-toggle="tab" class="btn btn-primary" type="button" onclick="locaAcco();">Previous</a>
					</form>

			</div>
			<!-- Location tab end -->

			<!-- Calendar tab begin -->
			<div class="tab-pane fade col-md-offset-1" id="cale">

			    <form method="post" action="doAction.php?act=addCalendar" id="cale-form" >
				<table class="table table-bordered table-striped">
					<tbody>

                      <div class="form-group">
                       <h4><label for="from">From</label></h4>
                        <span>First available date</span>
                        <input type="text" class="form-control list-space-input from" id="from" name="start_day" value="<?php echo $hostCale['start_day']?$hostCale['start_day']:null; ?>" placeholder="mm/dd/yyyy" required />
                        <!-- <span class="hidden-xs" id="fromStatus" style="position:absolute;top:58px;right:553px;"></span>-->
                      </div>
<!--                  <div class="form-group">
                        <label for="to">To</label>
                        <input type="text" class="form-control list-space-input to" id="to" name="end_day" value="<?php echo $hostCale['end_day']?$hostCale['end_day']:null; ?>" placeholder="mm/dd/yyyy" required>
                       </div> -->

                      <br />

                      <div class="form-group">
                        <h4><label for="min_days">Minimum days (in days)</label></h4>
                        <span>Minimum days of stay</span>
                        <input type="text" class="form-control list-space-input" id="min_days" name="min_days" value="<?php echo $hostCale['min_days']?$hostCale['min_days']:null; ?>" >
                        <!-- <span class="hidden-xs" id="minDaysStatus" style="position:absolute;top:191px;right:553px;"></span>-->
                      </div>

<!--                     <div class="form-group">
                        <label for="max_days">Maximum days</label>
                        <input type="text" class="form-control list-space-input" id="max_days" name="max_days" value="<?php echo $hostCale['max_days']?$hostCale['max_days']:null; ?>" >
                      </div>  -->

					</tbody>
				    </table>

<!--                     <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#cal-manage"> -->
<!-- 						Manage your calendar -->
<!-- 					</button> -->
					 <!-- Modal for meals and commute -->
<!-- 					<div class="collapse" id="cal-manage"> -->
<!-- 						<div class="well"> -->
<!-- 							<div class="row"> -->
<!-- 								<div class="col-md-3"> -->
<!-- 									<div class="page-header"> -->
<!-- 										<h3>Meals & Commute</h3> -->
<!-- 										<small>The price does not include any service fee, e.g. meals and commute;if you do provide these services, add the fees below please.</small> -->
<!-- 									</div> -->
<!-- 								</div> -->

<!-- 								<div class="col-md-9 type"> -->
<!-- 									<div class="form-group type"> -->
<!-- 										<label for="currency" class="currency">Meals / day</label> -->
<!-- 										<select class="form-control" id="currency-daily"> -->
<!-- 											<option>$</option> -->
<!-- 											<option>闁跨喐鏋婚幏锟�option> -->
<!-- 											<option>E</option> -->
<!-- 											<option>4</option> -->
<!-- 											<option>5</option> -->
<!-- 										</select> -->
<!-- 										<input type="text" class="form-control" placeholder="e.g. 40" id="daily" name="meal_price"> -->
<!-- 									</div> -->

<!-- 									<div class="form-group type"> -->
<!-- 										<label for="currency" class="currency">Commute / day</label> -->
<!-- 										<select class="form-control" id="currency-monthly"> -->
<!-- 											<option>$</option> -->
<!-- 											<option>闁跨喐鏋婚幏锟�option> -->
<!-- 											<option>E</option> -->
<!-- 											<option>4</option> -->
<!-- 											<option>5</option> -->
<!-- 										</select> -->
<!-- 										<input type="text" class="form-control" placeholder="e.g. 1200" id="monthly" name="commute_price"> -->
<!-- 									</div> -->
<!-- 								</div> -->
<!-- 							</div> -->
<!-- 						</div> -->
<!-- 					</div> -->

				    <hr>

					<a href="#price" data-toggle="tab" class="btn btn-primary fr marginL-20" type="button" onclick="calePrice();">Next step</a>
				    <button class="btn btn-success fr" save-btn>Save</button>
				    <a href="#loca" data-toggle="tab" class="btn btn-primary" type="button" onclick="caleLoca();">Previous</a>
                </form>
			</div><!-- Calendar tab end -->

			<!-- Price tab begin -->
			<div class="tab-pane fade col-md-offset-1" id="price">
				<form method="post" action="doAction.php?act=addPrice" id="price-form" >
					<div class="row">
						<div class="col-md-3">
							<div class="page-header"  style="margin-bottom:80px;border-bottom:none;">
								<h3>Price</h3>
								<span>Enter daily price if duration of stay can be less than a month.</span>
							</div>
						</div>

						<div class="col-md-9 type">
                            <label for="currency" class="currency">Monthly price</label>
							<div class="form-group type">
								<select class="form-control" id="currency-monthly">
									<option>$</option>
								</select>
								<input type="text" class="form-control" id="monthly" name="m_price" value="<?php echo $hostHouse['m_price']?$hostHouse['m_price']:null; ?>" required />
							    <!-- <span class="hidden-xs" id="mPriceStatus" style="position:absolute;top:39px;right:145px;"></span>-->
							</div>
						</div>

						<div class="col-md-9 type">
							<label for="currency" class="currency">Daily price</label>
							<div class="form-group type">

								<select class="form-control" id="currency-daily">
									<option>$</option>
								</select>
								<input type="text" class="form-control" id="daily" name="d_price" value="<?php echo $hostHouse['d_price']?$hostHouse['d_price']:null; ?>" />
							    <!-- <span class="hidden-xs" id="dPriceStatus" style="position:absolute;top:39px;right:145px;"></span>-->
							</div>
						</div>
					</div>

					<hr>

					<a href="#photo" data-toggle="tab" class="btn btn-primary fr marginL-20" type="button" onclick="pricePhoto();">Next step</a>
				    <button class="btn btn-success fr" save-btn>Save</button>
				    <a href="#cale" data-toggle="tab" class="btn btn-primary" type="button" onclick="priceCale();">Previous</a>

				</form>
			</div>
			<!-- Price tab end -->


			<!-- profile img upload tab begin -->
			<div class="tab-pane fade col-md-offset-1" id="photo">
				<div class="row">

                    <h2> Upload your profile picture </h2>
    				<ul style="list-style:none;">
    				   <li>1. Click the 'Pick Image' button to select your profile image that you want to upload;</li>
    				   <li>2. Make sure that the profile image is displayed correctly;</li>
    				   <li>3. click the 'upload' button once to upload the profile image;</li>
    				</ul>
    				<!-- Display profile image if exists -->
    				<?php $profileImg=getProfileImgById($_SESSION['user_id']);
                          if(!empty($profileImg['picture'])){
                    ?>
                    <img src="uploads/profile_img/user_id_<?php echo $_SESSION['user_id']."/".$profileImg['picture'];?>" class="img-thumbnail" id="guest-img">
                    <?php }  ?>

                    <form enctype="multipart/form-data">
                        <input id="profile-img" type="file" name="picture" accept="image/*" >
                    </form>

                    <hr>

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
                    <div style="clear:both;">
                        <a href="#price" data-toggle="tab" class="btn btn-primary fl" type="button" onclick="photoPrice();">Previous</a>
                        <a href="#amen" data-toggle="tab" class="btn btn-primary fr marLeft-10" type="button" onclick="photoAmen();">Next step</a>
                    </div>
                    </form>
    			    <!-- Multiple images upload for end -->
				</div>
            </div>

            <script>

                    $("#house-imgs").fileinput({
                        uploadUrl: 'doAction.php?act=addPhotos',
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

                    $("#profile-img").fileinput({
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


            	</script>
		    <!-- Multiple files tab end -->

			<!-- Service tab begin -->
			<div class="tab-pane fade col-md-offset-1" id="amen">

				<!-- form of host services -->
                <form method="post" action="doAction.php?act=addAmen" id="serv-form" >

                    <!-- Daily services row begin -->
					<div class="row">
						<div class="col-md-3">
							<div class="page-header" style="border-bottom: none;">
								<h3>Services</h3>
								<small></small>
							</div>
						</div>

						<div class="col-md-9">
							<div class="form-group">
								<tr>
									<td>
									    <div class="checkbox">
                                           <label></label>
                                        </div>
                                        <div class="checkbox">
                                           <label><input type="checkbox" value="Meals" name="daily_services[]" <?php if(in_array("Meals", $hostServices['daily_services'])) echo 'checked="checked"'; ?> >Meals</label>
                                        </div>
                                        <div class="checkbox">
                                           <label><input type="checkbox" value="Transportation" name="daily_services[]" <?php if(in_array("Transportation", $hostServices['daily_services'])) echo 'checked="checked"'; ?> >Transportation</label>
                                        </div>
                                        <div class="checkbox">
                                           <label><input type="checkbox" value="Language lesson" name="daily_services[]" <?php if(in_array("Language lesson", $hostServices['daily_services'])) echo 'checked="checked"'; ?> >Language lesson</label>
                                        </div>
                                        <div class="checkbox">
                                           <label><input type="checkbox" value="Airport pickup" name="daily_services[]" <?php if(in_array("Airport pickup", $hostServices['daily_services'])) echo 'checked="checked"'; ?> >Airport pick-up(one time)</label>
                                        </div>
                                        <div class="checkbox">
                                           <label><input type="checkbox" value="Legal guardianship" name="daily_services[]" <?php if(in_array("Legal guardianship", $hostServices['daily_services'])) echo 'checked="checked"'; ?> >Legal guardianship</label>
                                        </div>
									</td>
								</tr>
							</div>
						</div>
					</div>
					<!-- daily services row end -->

					<hr class="divider">

					<!-- Common row begin -->
					<div class="row">
						<div class="col-md-3">
							<div class="page-header" style="border-bottom: none;">
								<h3>Common</h3>
								<small></small>
							</div>
						</div>

						<div class="col-md-9">
							<div class="form-group">
								<tr>
									<td>
									    <div class="checkbox">
                                           <label></label>
                                        </div>
                                        <div class="checkbox">
                                           <label><input type="checkbox" value="TV" name="common[]" <?php if(in_array("TV", $hostServices['common'])) echo 'checked="checked"'; ?> >TV</label>
                                        </div>
                                        <div class="checkbox">
                                           <label><input type="checkbox" value="Air Condition" name="common[]" <?php if(in_array("Air Condition", $hostServices['common'])) echo 'checked="checked"'; ?> >Air Conditioning</label>
                                        </div>
                                        <div class="checkbox">
                                           <label><input type="checkbox" value="Heating" name="common[]" <?php if(in_array("Heating", $hostServices['common'])) echo 'checked="checked"'; ?> >Heating</label>
                                        </div>
                                        <div class="checkbox">
                                           <label><input type="checkbox" value="Kitchen" name="common[]" <?php if(in_array("Kitchen", $hostServices['common'])) echo 'checked="checked"'; ?> >Kitchen</label>
                                        </div>
                                        <div class="checkbox">
                                           <label><input type="checkbox" value="Washer" name="common[]" <?php if(in_array("Washer", $hostServices['common'])) echo 'checked="checked"'; ?> >Washer</label>
                                        </div>
                                        <div class="checkbox">
                                           <label><input type="checkbox" value="Dryer" name="common[]" <?php if(in_array("Dryer", $hostServices['common'])) echo 'checked="checked"'; ?> >Dryer</label>
                                        </div>
                                        <div class="checkbox">
                                           <label><input type="checkbox" value="Internet" name="common[]" <?php if(in_array("Internet", $hostServices['common'])) echo 'checked="checked"'; ?> >Internet</label>
                                        </div>
                                        <div class="checkbox">
                                           <label><input type="checkbox" value="Wifi" name="common[]" <?php if(in_array("Wifi", $hostServices['common'])) echo 'checked="checked"'; ?> >Wifi</label>
                                        </div>
									</td>
								</tr>
							</div>
						</div>
					</div>
					<!-- Common row end -->

					<hr class="divider">

					<!-- Extras row begin -->
					<div class="row">
						<div class="col-md-3">
							<div class="page-header" style="border-bottom: none;">
								<h3>Extras</h3>
								<small></small>
							</div>
						</div>

						<div class="col-md-9">
							<div class="form-group">
								<tr>
									<td>
                                        <div class="checkbox">
                                           <label></label>
                                        </div>
                                        <div class="checkbox">
                                           <label><input type="checkbox" value="Pool" name="extras[]" <?php if(in_array("Pool", $hostServices['extras'])) echo 'checked="checked"'; ?> >Pool</label>
                                        </div>
                                        <div class="checkbox">
                                           <label><input type="checkbox" value="Free Parking on Premises" name="extras[]" <?php if(in_array("Free Parking on Premises", $hostServices['extras'])) echo 'checked="checked"'; ?> >Free Parking on Premises</label>
                                        </div>
                                        <div class="checkbox">
                                           <label><input type="checkbox" value="Gym" name="extras[]" <?php if(in_array("Gym", $hostServices['extras'])) echo 'checked="checked"'; ?> >Gym</label>
                                        </div>
                                        <div class="checkbox">
                                           <label><input type="checkbox" value="Elevator in Building" name="extras[]" <?php if(in_array("Elevator in Building", $hostServices['extras'])) echo 'checked="checked"'; ?> >Elevator in Building</label>
                                        </div>
                                        <div class="checkbox">
                                           <label><input type="checkbox" value="Indoor Fireplace" name="extras[]" <?php if(in_array("Indoor Fireplace", $hostServices['extras'])) echo 'checked="checked"'; ?> >Indoor Fireplace</label>
                                        </div>
									</td>
								</tr>
							</div>
						</div>
					</div>	<!-- Extras row end -->

					<hr>

					<a href="review-profile.php" class="btn btn-success fr marginL-20" type="button">Preview list</a>
					<button class="btn btn-success fr" save-btn >Save</button>
					<a href="#photo" data-toggle="tab" class="btn btn-primary" type="button" onclick="amenPhoto();">Previous</a>

                </form>
			</div>
			<!-- Service tab end -->

			</div><!-- Tab contents col-md-9 -->
		</div><!-- Tab col-md-9 end-->
	</div>
	<!-- row -->
</div>
<!-- outside container -->


<?php

	require_once 'footer.php';

 ?>
