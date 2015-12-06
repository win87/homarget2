<?php

require_once 'include.php';
require_once 'header.php';
checkProfileSession();

$id=$_REQUEST['house_id'];

$sql_pic="select email, picture, active_flag from tg_user_login where user_id={$id}";
$pic=fetchOne($sql_pic);

$sql_user="select * from tg_host_info where host_id={$id}";
$row_user=fetchOne($sql_user);

$sql_house="select * from tg_host_house where house_id={$id}";
$row_house=fetchOne($sql_house);
//print_r($row_house);

$sql_house="select * from tg_host_services where services_id={$id}";
$row_services=fetchOne($sql_house);
//print_r($row_services);

$sql_location="select * from tg_house_location where location_id={$id}";
$row_location=fetchOne($sql_location);
//print_r($row_location);

$sql_calendar="select * from tg_host_calendar where calendar_id={$id}";
$row_calendar=fetchOne($sql_calendar);

$rows=getAllImgsByHouseId($id);


$sql_checkGuestInfo = "SELECT country,locality,administrative_area_level_1,gender,ethnicity,user_type,arrival
        FROM tg_guest_info as i
        JOIN tg_guest_request r ON r.guest_id = i.guest_id
        JOIN tg_user_login lo ON lo.user_id = i.guest_id
        where lo.user_id={$_SESSION['user_id']}";
$row_checkGuestInfo=fetchOne($sql_checkGuestInfo);

$country=$row_checkGuestInfo['country'];
$city=$row_checkGuestInfo['locality'];
$state=$row_checkGuestInfo['administrative_area_level_1'];
$gender=$row_checkGuestInfo['gender'];
$ethnicity=$row_checkGuestInfo['ethnicity'];
$arrival=$row_checkGuestInfo['arrival'];
$type=$row_checkGuestInfo['user_type'];


//Booking Guest logic
$sql_book = "SELECT * from tg_booking where host_id={$id} and guest_id={$_SESSION['user_id']} and who_book=1";
$book = getResultNum($sql_book);
$status = fetchOne($sql_book);

//Re-Booking  logic
$sql_2 = "SELECT * from tg_booking where host_id={$id} and guest_id={$_SESSION['user_id']} and who_book=2";
$book_2 = getResultNum($sql_2);
$row_2 = fetchOne($sql_2);


?>

<!-- Page Content -->
<div class="container">

    <!-- Page Heading/Breadcrumbs row -->
    <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header text-center" style="margin:0;">
                    <small>
                        <div class="row" id="rp-house-tit">
                            <h2><b><?php echo $row_house['house_title']?></b></h2>
                            <h4><?php echo $row_location['locality']; ?> &nbsp;
                                <?php echo $row_location['administrative_area_level_1']; ?> &nbsp;
                                <?php echo $row_location['country']; ?>
                            </h4>
                        </div>
                    </small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a>
                    </li>
                    <li class="active"><a href="guest-search-result.php">back to search</a></li>
                </ol>
            </div>
    </div>
    <!-- /.Page Heading/Breadcrumbs row end -->

    <!-- Content Row -->
    <div class="row">
        <!-- Sidebar Column -->
        <div class="col-md-3">
            <!-- profile pic -->
            <div class="thumbnail marginT-37">
                <?php if($pic['picture']){ ?>
                <img class="img-circle" src="uploads/profile_img/user_id_<?php echo $row_user['host_id']."/".$pic['picture'];?>" >
                <?php }else{ ?>
                <img class="img-circle" src="images/default/profile-img.png" >
                <?php } ?>

            </div><!-- profile pic end -->
           	<div class="caption text-center">
				<h3><?php echo $row_user['first_name'] ?></h3>
            </div>

            <hr class="divider">

            <?php if($pic['active_flag']==1) { ; ?>
            <div class="fl">
                <img src="images/email-verify.png" class="email-verify-icon">
            </div>
            <div class="email-verify-txt">
                <span>E-mail verified</span>
            </div>
            <?php } else { ?>
            <div class="fl">
                <img src="images/email-not-verify.png" class="email-not-verify-icon">
            </div>
            <div class="email-verify-txt">
                <span>E-mail not verified</span>
            </div>
            <?php } ?>

            <hr class="divider">

            <table class="table" style="border:1px solid #ccc;">

				<caption></caption>
				<tbody class="text-center">

					<tr style="background:rgb(77,79,80);font-weight:bold;color:#fff;">
						<td class="book-info-list">Monthly price</td>
						<?php if($row_house['m_price']!=0){ ?>
						    <td class="book-info-list"><b>$ <?php echo $row_house['m_price']; ?></b></td>
						<?php } else { ?>
                            <td class="book-info-list">N/A</td>
                        <?php } ;?>
					</tr>

					<tr>
						<td class="book-info-list">Daily price</td>
						<?php if($row_house['d_price']!=0){ ?>
                            <td class="book-info-list"><b>$ <?php echo $row_house['d_price'] ;?></b></td>
                        <?php } else { ?>
                            <td class="book-info-list">N/A</td>
                        <?php } ;?>
					</tr>

				 	<tr>
						<td>First date available</td>
						<td class="book-info-list"><b><?php echo $row_calendar['start_day']; ?></b></td>
					</tr>

					<tr>
						<td>Min. duration of stay (in days)</td>
						<?php if($row_calendar['min_days']!=0){ ?>
                            <td class="book-info-list"><b><?php echo $row_calendar['min_days'] ;?></b></td>
                        <?php } else { ?>
                            <td class="book-info-list">N/A</td>
                        <?php } ;?>
					</tr>
				</tbody>
			</table>

            <?php if ($book!=0){
		              switch ($status['status']){
		                  case 0: ?>
		                      <button class="btn btn-block btn-success"  onclick="acceptHostBook(<?php echo $id ;?>,<?php echo $_SESSION['user_id'] ;?>)">Accept the booking</button>
		                      <button class="btn btn-block btn-danger" onclick="delBookHost(<?php echo $id ;?>,<?php echo $_SESSION['user_id'] ;?>)">Cancel the booking</button>
		            <?php break;
                          case 1: ?>
                              <button class="btn btn-block btn-success" disabled>The booking is accepted</button>
                              <button class="btn btn-block btn-info" data-toggle="modal" data-target=".myModal-host-p">Contact Information</button>
                    <?php break;
                          case 2: ?>
                              <a href="#" class="btn btn-block btn-danger" disabled>The booking is been cancelled</a>
                              <a href="#" class="btn btn-block btn-success" data-toggle="modal" data-target=".myModal-guest-book">Re-book <?php echo ucfirst(strtolower($row_user['first_name'])); ?></a>
		            <?php }
		            }else{
		                switch ($type){
		                    case 2: if ($row_2['status']==1){?>
                                <button class="btn btn-block btn-info" data-toggle="modal" data-target=".myModal-host-p">Contact Information</button>
                            <?php }else{ ?>
                             <a href="#" class="btn btn-block btn-success" data-toggle="modal" data-target=".myModal-guest-book">Contact <?php echo ucfirst(strtolower($row_user['first_name'])); ?></a>
                        <?php } break;
                            case 1:
                                echo '';
                            break;
		                } }; ?>
        </div>
		<!-- left col 3 end -->

    <!-- display content-->
    <?php
        require_once 'list-space-content.php';
    ?>
    <!-- display content end -->

    <!--comfirmation Modal begin -->
	<div class="modal fade myModal-guest-book" tabindex="-1">
		<div class="modal-dialog" id="modal-dialog-sign-up">
			<div class="modal-content">
				<div class="modal-header" style="background:#f2f2f2;">

					<!-- Top Right corner "X" sign -->
					<button type="button" class="close" data-dismiss="modal">
						<span>&times;</span>
					</button>
					<h4 class="modal-title text-center" id="">Review Host Infomation</h4>
				</div>
				<div class="modal-body">

					<!-- Form action -->

					<form id="sign-up-input-box" method="post" action="guest-book-mail.php?house_id=<?php echo $row_house['house_id']; ?>">

						<table class="table table-bordered">

            				<caption>Booking information</caption>
            				<tbody>

            				    <tr>
            						<td style="width:50%"><strong>Country</strong></td>
            						<td><b><em><?php echo $row_location['country'] ;?></em></b></td>
            					</tr>

            					<tr>
            						<td><strong>State</strong></td>
            						<td><b><em><?php echo $row_location['administrative_area_level_1']; ?></em></b></td>
            					</tr>

            					<tr>
            						<td><strong>City</strong></td>
            						<td><b><em><?php echo $row_location['locality']; ?></em></b></td>
            					</tr>

            					<tr>
            						<td><strong>Address</strong></td>
            						<td><b><em><?php echo $row_location['route']; ?></em></b></td>
            					</tr>

            					<tr>
            						<td><strong>Arrival date</strong></td>
            						<td><input type="text" class="from form-control" id="from" name="arrival" placeholder="mm/dd/yyyy" <?php echo $arrival ;?> ></td>
            					</tr>

            					<tr>
            						<td><strong>Departure date</strong></td>
            						<td><input type="text" class="to form-control" id="to" name="depart" placeholder="mm/dd/yyyy"></td>
            					</tr>

            				</tbody>
            			</table>

            			<?php if (empty($country) || empty($state) || empty($city) || !isset($gender) || empty($ethnicity) || empty($arrival)) { ?>
						<h4 style="color:red;">You haven't enter all information</h4>
						<a href="list-request.php" class="btn btn-block btn-danger">List your request</a>
						<?php }else{ ?>
						<button type="submit" name="submit" id="loading-btn" class="btn btn-success btn-block" onclick="confirmHost(<?php echo $row['guest_id'];?>)">
							Contact <?php echo ucfirst(strtolower($row_user['first_name'])) ?>
						</button>
						<div id="loading" style="display:none;"><h2><img src="img/spinner.gif"> Send...</h2></div>
						<?php } ?>
                    </form>
				</div>
				<script>
			        $('#loading-btn').click(function(){
			            $(this).hide();
			            $('#loading').show();
				        });
				</script>

			</div>
		</div>
	</div>
	<!-- comfirmation Modal end -->

	<!--host-contact-p Modal begin -->
	<div class="modal fade myModal-host-p" tabindex="-1">
		<div class="modal-dialog" id="modal-dialog-sign-up">
			<div class="modal-content">
				<div class="modal-header" style="background:#f2f2f2;">

					<!-- Top Right corner "X" sign -->
					<button type="button" class="close" data-dismiss="modal">
						<span>&times;</span>
					</button>
					<h4 class="modal-title text-center" id="">Contact information </h4>
				</div>
				<div class="modal-body">

					<!-- Form action

					<form id="sign-up-input-box" method="GET" action="guest-book-mail.php">-->

					<table class="table table-bordered">
                        <caption>Private information</caption>
        				<tbody>

        				    <tr>
        						<td style="width:40%">Name</td>
        						<td><b><?php echo ucfirst(strtolower($row_user['first_name'])) ;?> <?php echo ucfirst(strtolower($row_user['last_name'])) ;?></b></td>
        					</tr>

        					<tr>
        						<td>Email</td>
        						<td><b><?php echo $pic['email']; ?></b></td>
        					</tr>

        					<tr>
        						<td>TEL</td>
        						<td><b>(<?php echo $row_user['mobile_code']; ?>)</b> <b><?php echo $row_user['mobile']; ?></b></td>
        					</tr>

        				</tbody>
        			</table>
				</div>
			</div>
		</div>
	</div>
	<!-- host-contact-p Modal end -->


<?php
//Insert the footer
require_once 'footer.php';

?>