<?php

require_once 'include.php';
require_once 'header.php';
checkProfileSession();

$id=$_REQUEST['guest_id'];

@$sql = "SELECT *
            FROM tg_guest_request as r
            JOIN tg_guest_info i ON i.guest_id = r.guest_id
            JOIN tg_user_login l ON l.user_id = r.guest_id
            where r.guest_id={$id}";
$row=fetchOne($sql);

$sql_checkInfo = "SELECT country,locality,administrative_area_level_1,gender,ethnicity,user_type
                    FROM tg_house_location as l
                    JOIN tg_host_info i ON i.host_id = l.location_id
                    JOIN tg_user_login lo ON lo.user_id = l.location_id
                    JOIN tg_host_house h ON h.house_id = l.location_id
                    where lo.user_id={$_SESSION['user_id']}";
$row_checkInfo=fetchOne($sql_checkInfo);

//Booking logic
$sql_book = "SELECT * from tg_booking where guest_id={$id} and host_id={$_SESSION['user_id']} and who_book=2";
$book = getResultNum($sql_book);
$status = fetchOne($sql_book);

$sql_1 = "SELECT * from tg_booking where guest_id={$id} and host_id={$_SESSION['user_id']} and who_book=1";
$book_1=getResultNum($sql_1);
$row_1 =fetchOne($sql_1);

$country=$row_checkInfo['country'];
$city=$row_checkInfo['locality'];
$state=$row_checkInfo['administrative_area_level_1'];
$gender=$row_checkInfo['gender'];
$ethnicity=$row_checkInfo['ethnicity'];
$type=$row_checkInfo['user_type'];

?>

<!-- Page Content -->
<div class="container">

    <!-- Page Heading/Breadcrumbs row -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <small><b><?php echo ucfirst(strtolower($row['first_name'])) ;?>&nbsp;from&nbsp;<?php echo $row['from_country'];?></b></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php">Home</a>
                </li>
                <li class="active"><a href="host-search-result.php">Back to search</a></li>
            </ol>
        </div>
    </div>
    <!-- /.Page Heading/Breadcrumbs row end -->

    <!-- Content Row -->
    <div class="row">
        <!-- Sidebar Column -->
        <div class="col-md-3">
            <!-- profile pic -->
            <div class="thumbnail">
                <?php if($row['picture']){ ?>
                <img src="uploads/profile_img/user_id_<?php echo $row['guest_id']."/".$row['picture'];?>" >
                <?php }else{ ?>
                <img src="images/default/profile-img.png" >
                <?php } ?>
            </div><!-- profile pic end -->

            <hr class="divider">

            <?php if($row['active_flag']==1) { ; ?>
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
				<caption>Booking information</caption>
				<tbody class="text-center">

				    <tr style="background:rgb(77,79,80);font-weight:bold;color:#fff;" class="text-center">
						<td class="book-info-list">Max. daily price</td>
				    <?php if($row['d_price']!=0){ ?>
						<td class="book-info-list"><b>$<?php echo $row['d_price'] ;?></b></td>
					<?php } else { ?>
					    <td class="book-info-list"><b>N/A</b></td>
					<?php } ;?>
					</tr>

					<tr>
						<td>Max. monthly price</td>
                    <?php if($row['m_price']!=0){ ?>
                        <td class="book-info-list"><b>$ <?php echo $row['m_price'] ;?></b></td>
                    <?php } else { ?>
                       <td class="book-info-list"><b>N/A</b></td>
                    <?php } ;?>
					</tr>

					<tr>
						<td class="book-info-list">Arrival date</td>
						<td class="book-info-list"><b><?php
						              if ($row['arrival']!=0){
						                  echo $row['arrival'];
						              }else{
						                  echo 'Undecided';
						              }
						           ?>
						</b></td>
					</tr>

					<tr>
						<td class="book-info-list">Departure date</td>
						<td class="book-info-list"><b><?php
                                      if ($row['departure']!=0){
                                          echo $row['departure'];
                                      }else{
                                          echo 'Undecided';
                                      }
                                   ?>
                        </b></td>
					</tr>
				</tbody>
			</table>

		    <?php if ($book!=0){
		              switch ($status['status']){
		                  case 0: ?>
		                      <button class="btn btn-block btn-success"  onclick="acceptGuestBook(<?php echo $id ;?>,<?php echo $_SESSION['user_id'] ;?>)">Accepting the booking</button>
		                      <button class="btn btn-block btn-danger" onclick="delBookGuest(<?php echo $id ;?>,<?php echo $_SESSION['user_id'] ;?>)">Cancel the booking</button>
		            <?php break;
                          case 1: ?>
                              <button class="btn btn-block btn-success" disabled>The booking is accepted</button>
                              <button class="btn btn-block btn-info" data-toggle="modal" data-target=".myModal-guest-p">Contact Information</button>
		            <?php break;
                          case 2: ?>
                              <a href="#" class="btn btn-block btn-danger" disabled>The booking is been rejected</a>
                              <a href="#" class="btn btn-block btn-success" data-toggle="modal" data-target=".myModal-host-book">Re-book <?php echo ucfirst(strtolower($row['first_name'])); ?></a>
		            <?php }
		            }else{
                        switch ($type){
                            case 1: if ($row_1['status']==1){?>
                            <button class="btn btn-block btn-info" data-toggle="modal" data-target=".myModal-guest-p">Contact Information</button>
                        <?php }else{ ?>
                             <a href="#" class="btn btn-block btn-success" data-toggle="modal" data-target=".myModal-host-book">Contact <?php echo ucfirst(strtolower($row['first_name'])); ?></a>
                        <?php } break;
                            case 2:
                                echo '';
                            break;
                } };?>

            </div>

		    <!-- left col 3 end -->
            <?php
                require_once 'list-request-content.php';
            ?>

    <!--comfirmation Modal begin -->
	<div class="modal fade myModal-host-book" tabindex="-1">
		<div class="modal-dialog" id="modal-dialog-sign-up">
			<div class="modal-content">
				<div class="modal-header" style="background:#f2f2f2;">

					<!-- Top Right corner "X" sign -->
					<button type="button" class="close" data-dismiss="modal">
						<span>&times;</span>
					</button>
					<h4 class="modal-title text-center" id="">Review guest information </h4>
				</div>
				<div class="modal-body">

					<!-- Form action

					<form id="sign-up-input-box" method="GET" action="guest-book-mail.php">-->

						<table class="table table-bordered">

            				<caption>Guest requsts</caption>
            				<tbody>

            				    <tr>
            						<td style="width:50%"><strong>Name</strong></td>
            						<td><b><em><?php echo ucfirst(strtolower($row['first_name'])) ;?></em></b></td>
            					</tr>

            					<tr>
            						<td><strong>Gender</strong></td>
            						<td><b><em><?php echo $row['gender']==1?'Male':'Female'; ?></em></b></td>
            					</tr>

            					<tr>
            						<td><strong>Age</strong></td>
            						<td><b><em><?php echo $row['age']; ?></em></b></td>
            					</tr>

            					<tr>
            						<td><strong>Arrival date</strong></td>
            						<td><b><em><?php echo $row['arrival']; ?></em></b></td>
            					</tr>

            					<tr>
            						<td><strong>Departure date</strong></td>
            						<td><b><em><?php echo $row['departure']; ?></em></b></td>
            					</tr>

            				</tbody>
            			</table>
                        <?php if (empty($country) || empty($state) || empty($city) || !isset($gender) || empty($ethnicity)) { ?>
						<h4 style="color:red;">You haven't enter all information</h4>
						<a href="list-space.php" class="btn btn-block btn-danger">Edit your Listing</a>
						<?php }else{ ?>
						<button type="submit" name="submit" id="loading-btn" class="btn btn-success btn-block" onclick="confirmGuest(<?php echo $row['guest_id'];?>)">
							<strong>Contact <?php echo ucfirst(strtolower($row['first_name']))?></strong>
						</button>
						<div id="loading" style="display:none;"><h2><img src="img/spinner.gif"> Send...</h2></div>
						<?php } ?>
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

	<!--guest-contact-p Modal begin -->
	<div class="modal fade myModal-guest-p" tabindex="-1">
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
        						<td><b><?php echo ucfirst(strtolower($row['first_name'])) ;?> <?php echo ucfirst(strtolower($row['last_name'])) ;?></b></td>
        					</tr>

        					<tr>
        						<td>Email</td>
        						<td><b><?php echo $row['email']; ?></b></td>
        					</tr>

        					<tr>
        						<td>TEL</td>
        						<td><b>(<?php echo $row['mobile_code']; ?>)</b> <b><?php echo $row['mobile']; ?></b></td>
        					</tr>

        				</tbody>
        			</table>
				</div>
			</div>
		</div>
	</div>
	<!-- guest-contact-p Modal end -->

<?php

require_once 'footer.php';

?>