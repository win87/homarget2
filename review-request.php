<?php

    require_once 'include.php';
	require_once 'header.php';
	checkProfileSession();

	$id=($_SESSION['user_id'])?$_SESSION['user_id']:$_COOKIE['user_id'];

	@$sql = "SELECT email,user_type,picture,active_flag,first_name,last_name,gender,age,ethnicity,from_country,occupation,language,mobile_code,mobile,purpose,is_avail,name_dest,
	           country,street_number,route,locality,administrative_area_level_1,postal_code,lat,lng,arrival,departure,preferred_services,d_price,m_price,intro
        	FROM tg_guest_request as r
        	JOIN tg_guest_info i ON i.guest_id = r.guest_id
        	JOIN tg_user_login l ON l.user_id = r.guest_id
        	where r.guest_id={$id}";

	$row=fetchOne($sql);

?>


<!-- Page Content -->
<div class="container">

    <!-- Page Heading/Breadcrumbs row -->
    <div class="row">
            <div class="col-lg-12">

                <?php if($row['is_avail']==0):?>
                <div class="breadcrumb text-center" style="padding:10px 0;color:rgb(217,83,79);background:#fff;">
                    <span class="fa fa-file-text-o" style="margin-right:20px;"></span>
                    This is an unlisted draft
                </div>
                <?php endif; ?>

                <?php  if($row['is_avail']==1):?>
                <div class="breadcrumb text-center" style="padding:10px 0; color:rgb(92,184,92);background:#fff;">
                    <span class="fa fa-file-text-o" style="margin-right:20px;"></span>
                    Your space is listed
                </div>
                <?php endif; ?>

                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a>
                    </li>
                    <li class="active"><a href="list-request.php">Edit your request</a></li>
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
                <img src="uploads/profile_img/user_id_<?php echo $_SESSION['user_id']."/".$row['picture'];?>" >
                <?php }else{ ?>
                <img src="images/default/profile-img.png" >
                <?php } ?>

            </div><!-- profile pic end -->

            <a href="list-request.php" class="btn btn-primary"><b>Edit request</b></a>

            <?php
                if($row['active_flag']==0){
            ?>
                <a href="verification-email-sent.php?email=<?php echo $row['email']; ?>" class="btn btn-default fr"><b>Verify Email</b></a>
            <?php }else{?>
                <a class="btn btn-default fr" disabled><b>Email Verified</b></a>
            <?php } ?>

            <hr>
             <form method="post" id="avail-form" action="doAction.php?act=unShowRequest">
             <table class="table" style="border:1px solid #ccc;">
                <caption></caption>
                <tbody class="text-center">
                    <tr style="background:rgb(77,79,80);font-weight:bold;color:#fff;" class="text-center">
                        <td class="book-info-list">Max. daily price</td>
                        <?php if($row['d_price']!=0){ ?>
    						<td class="book-info-list"><b>$ <?php echo $row['d_price'] ;?></b></td>
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
                        <td class="book-info-list">Arrival date </td>
                        <td class="book-info-list"><b><input type="text" class="form-control from" id="from" name="arrival" value="<?php echo $row['arrival']?$row['arrival']:null; ?>" ></b></td>
                    </tr>

                     <tr>
                        <td class="book-info-list">Departure date </td>
                        <td class="book-info-list"><b><input type="text" class="form-control to" id="to" name="departure" value="<?php echo $row['departure']?$row['departure']:null; ?>" > </b></td>
                    </tr>

                    <tr>
                       <td>Do you want guest to view your listing?</td>
                       <td class="book-info-list">
                          <select class="form-control" name="is_avail" >
                              <option value=1 <?php echo $row['is_avail']==1?"selected":null;?> >Yes</option>
                              <option value=0 <?php echo $row['is_avail']==0?"selected":null;?> >No</option>
                          </select>
                    </td>
                    </tr>

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
						<td><b><?php echo ucfirst(strtolower($row['first_name'])) ;?>  <?php echo ucfirst(strtolower($row['last_name'])) ;?></b></td>
					</tr>


					<tr>
						<td>Email</td>
						<td><b><?php echo $row['email']; ?></b></td>
					</tr>

					<tr>
						<td>Mobile</td>
						<td><b>(<?php echo $row['mobile_code'];?>) <?php echo $row['mobile'];?></b></td>
					</tr>


				</tbody>
			</table>
			 -->

<!--			<hr class="divider">

  			<table class="table table">
                <thead>
                    <tr>
						<th>Reviews manamgement</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
						<td>Write Reference</td>
                    </tr>
                    <tr>
						<td>Request References</td>
                    </tr>
					<tr>
						<td><a href="#">Reference about you &nbsp; <span class="badge">42</span></a></td>
                    </tr>
                </tbody>
            </table>

			<table class="table">
                <thead>
                    <tr>
						<th>Find guests</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
						<td><a href="#">Matching guests &nbsp; <span class="badge">42</span></a></td>
                    </tr>
					<tr>
						<td><a href="#">Bookmarked guests &nbsp; <span class="badge">42</span></a></td>
                    </tr>
                </tbody>
            </table>   -->

        </div>
		<!-- left col 3 end -->

        <?php
            require_once 'list-request-content.php';
        ?>

<?php
    require_once 'footer.php';
?>
