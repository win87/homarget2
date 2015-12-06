<?php

    require_once 'include.php';
	require_once 'header.php';
	checkProfileSession();


	$id=($_SESSION['user_id'])?$_SESSION['user_id']:$_COOKIE['user_id'];

	$sql_email="select email, picture, active_flag, verify_code from tg_user_login where user_id='{$id}'";
	$row_email=fetchOne($sql_email);

	$sql_user="select * from tg_host_info where host_id={$id}";
	$row_user=fetchOne($sql_user);

	$sql_house="select * from tg_host_house where house_id={$id}";
	$row_house=fetchOne($sql_house);
	//print_r($row_house);

	$sql_services="select * from tg_host_services where services_id={$id}";
	$row_services=fetchOne($sql_services);
	//print_r($row_services);

	$sql_location="select * from tg_house_location where location_id={$id}";
	$row_location=fetchOne($sql_location);
	//print_r($row_location);

	$sql_calendar="select * from tg_host_calendar where calendar_id={$id}";
	$row_calendar=fetchOne($sql_calendar);

	//取锟斤拷同一锟斤拷album_id 锟斤拷锟斤拷锟斤拷图 Get all imgs with identity album_id using in images_ablum display
	$rows=getAllImgsByHouseId($id);
	//Get data from tg_house_img
	$sql_img="select * from tg_house_img where album_id={$id}";
	$rows=fetchAll($sql_img);

?>


<!-- Page Content -->
<div class="container">

    <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <?php if($row_calendar['is_avail']==0):?>
            <div class="breadcrumb text-center" style="padding:10px 0;color:rgb(217,83,79);background:#fff;">
                <span class="fa fa-file-text-o" style="margin-right:20px;"></span>
                This is an unlisted draft
            </div>
            <?php endif; ?>

            <?php  if($row_calendar['is_avail']==1):?>
            <div class="breadcrumb text-center" style="padding:10px 0; color:rgb(92,184,92);background:#fff;">
                <span class="fa fa-file-text-o" style="margin-right:20px;"></span>
                Your space is listed
            </div>
            <?php endif; ?>

            <h1 class="page-header" style="border-bottom:none;">
                <small><?php echo $row_house['house_title']?></small>
            </h1>

            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li class="active"><a href="list-space.php">Edit Listing</a></li>
            </ol>
        </div>
        <!-- /.row -->

    <!-- Content Row -->
    <div class="row">
        <!-- Sidebar Column -->
        <div class="col-md-3 col-sm-12">
            <!-- profile pic -->
            <div class="thumbnail marginT-56">
                <?php if($row_email['picture']){ ?>
                <img src="uploads/profile_img/user_id_<?php echo $_SESSION['user_id']."/".$row_email['picture'];?>" >
                <?php }else{ ?>
                <img src="images/default/profile-img.png" >
                <?php } ?>

            </div><!-- profile pic end -->

           	<div class="caption text-center">
				<h3><?php echo ucfirst(strtolower($row_user['first_name'])) ?></h3>
            </div>
            <a href="list-space.php" class="btn btn-primary btn-sm"><b>Edit Listing</b></a>
            <?php
                if($row_email['active_flag']==0){
            ?>
                <a href="verification-email-sent.php?email=<?php echo $row_email['email']; ?>" class="btn btn-default btn-sm fr"><b>Verify Email</b></a>
            <?php }else{?>
                <a class="btn btn-default btn-sm fr" disabled><b>Email Verified</b></a>
            <?php } ?>


			 <form method="post" id="avail-form" action="doAction.php?act=unShowHouse">
             <table class="table" style="border:1px solid #ccc;">
				<caption></caption>
				<tbody class="text-center">

				    <tr style="background:rgb(77,79,80);font-weight:bold;color:#fff;" class="text-center">
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
						<td>First available date </td>
						<td class="book-info-list"><b><input type="text" class="form-control from" id="from" name="start_day" value="<?php echo $row_calendar['start_day']?$row_calendar['start_day']:null; ?>" ></b></td>
					</tr>

					 <tr>
						<td>Min. duration of stay (in days) </td>
						<td class="book-info-list"><b><input type="text" class="form-control" name="min_days" value="<?php echo $row_calendar['min_days']?$row_calendar['min_days']:null; ?>" > </b></td>
					</tr>

					<tr>
					   <td>Do you want guest to view your listing?</td>
					   <td class="book-info-list">
					      <select class="form-control" name="is_avail" >
        					  <option value=1 <?php echo $row_calendar['is_avail']==1?"selected":null;?> >Yes</option>
        					  <option value=0 <?php echo $row_calendar['is_avail']==0?"selected":null;?> >No</option>
        				  </select>
				    </td>
					</tr>

                <hr>

				</tbody>
			</table>
                <button class="btn btn-primary "><b>Change Listing Status</b></button>
            </form>
            <div id="avail-res"></div>



            <!--
            <table class="table table-bordered">
                <caption><b>Private information</b> (this information will not be visible by other users until you authorize.)</caption>
                <tbody class="text-center">

                    <tr>
                        <td style="width:35%">Full name</td>
                        <td><b><?php echo ucfirst(strtolower($row_user['first_name'])) ;?>  <?php echo ucfirst(strtolower($row_user['last_name'])) ;?></b></td>
                    </tr>


                    <tr>
                        <td>Email</td>
                        <td><b><?php echo $row_email['email']; ?></b></td>
                    </tr>

                    <tr>
                        <td>Phone</td>
                        <td><b>(<?php echo $row_user['phone_code'];?>) <?php echo $row_user['phone'];?></b></td>
                    </tr>

                    <tr>
                        <td>Mobile</td>
                        <td><b>(<?php echo $row_user['mobile_code'];?>) <?php echo $row_user['mobile'];?></b></td>
                    </tr>

                    <tr>
                        <td>Address</td>
                        <td><b>
                            <?php echo ucfirst(strtolower($row_location['street_number'])); ?>&nbsp;
                            <?php echo ucfirst(strtolower($row_location['route'])); ?>&nbsp;
                            <?php echo ucfirst(strtolower($row_location['locality'])); ?>&nbsp;
                            <?php echo ucfirst(strtolower($row_location['administrative_area_level_1'])); ?>&nbsp;
                            <?php echo ucfirst(strtolower($row_location['country'])); ?>
                        </b></td>
                    </tr>

                </tbody>
            </table>
             -->

        </div>
		<!-- left col 3 end -->

        <!-- display content -->
        <?php
            require_once 'list-space-content.php';
        ?>
        <!-- display content end -->

<?php
    require_once 'footer.php';
?>
