<?php
    require_once 'include.php';
    require_once 'header.php';
    checkProfileSession();

    $id=$_SESSION['user_id'];

    //Guest booking
    $sql="SELECT book_time,first_name,gender,age,ethnicity,picture,b.host_id,status,country,locality,administrative_area_level_1,route
            FROM tg_booking as b
            JOIN tg_house_location lo ON lo.location_id = b.host_id
            JOIN tg_user_login l ON l.user_id = b.host_id
            JOIN tg_host_info i ON i.host_id = b.host_id
            where b.guest_id = {$id} and b.who_book=2";
    $rows=fetchAll($sql);

    //Who booked Guest
    $sql_booked="SELECT book_time,first_name,gender,age,ethnicity,picture,b.host_id,status,country,locality,administrative_area_level_1,route
            FROM tg_booking as b
            JOIN tg_host_info i ON i.host_id = b.host_id
            JOIN tg_house_location lo ON lo.location_id = b.host_id
            JOIN tg_user_login l ON l.user_id = b.host_id
            where b.guest_id = {$id} and b.who_book=1";
    $rows_booked=fetchAll($sql_booked);


?>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header" style="border-bottom:none;">
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a>
                    </li>
                    <li class="active"><a href="guest-search-result.php">Homestay Finder</a></li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">

        <!-- Tab col-md-3 left side-->
		<div class="col-md-3" id="list-col">
			<ul class="nav nav-pills nav-stacked text-left" id="list-space-col3">
				<li class="active" id="">
				    <a href="#reservation-tab" data-toggle="tab" class="list-group-item">Your Reservations</a>
				</li>
				<li id="">
				    <a href="#booked-tab" data-toggle="tab" class="list-group-item">Who booked you</a>
				</li>
				<!--
				<li id="" style="position: relative;">
				    <a href="#requirement-tab" data-toggle="tab" class="list-group-item">Reservation Requirement</a>
				</li>
				-->
			</ul>
        </div>
		<!-- Tab col-md-3 left side end-->

        <div class="col-md-9">
            <div id="myTabContent" class="tab-content">
    		<!-- Host reservations tab begin-->
    		<div class="tab-pane fade in active" id="reservation-tab" >
              <div class="col-md-12">
                <table class="table table-hover">
                    <caption class="text-center"><h2>Your Reservations</h2></caption>

                    <tbody>
                    <?php if ($rows): ?>
                    <?php foreach ($rows as $row):
                        $status=$row['status'];
                    ?>
                    <tr>
                       <td width="20%">
                         <div class="thumbnail">
                           <a href="#" onclick="viewHost(<?php echo $row['host_id'];?>)">
                           <?php if ($row['picture']){?>
                               <img class="img-circle" src="uploads/profile_img/user_id_<?php echo $row['host_id']."/".$row['picture'];?>" alt="guest-profile-image" />
                           <?php }else { ?>
                               <img class="img-circle" src="images/default/profile-img.png" alt="host-profile-image" />
                           <?php } ?>
                           </a>
                         </div>
                       </td>

                       <td>
                           <div>
                               <b>Name:</b>
                               <?php echo $row['first_name']?>,
                               <?php echo $row['gender']=1?'Male':'Female'?>,
                               <?php echo $row['age']?> year's old
                           </div>
                           <div>
                               <b>Location:</b>
                               <?php echo $row['route']?> <?php echo $row['locality']?> <?php echo $row['administrative_area_level_1']?> <?php echo $row['country']?>
                           </div>
                           <div>
                               <b>Ethnicity:</b>
                               <?php echo $row['ethnicity']?>
                           </div>
                           <div>
                               <b>Reservation date:</b>
                               <?php echo $row['book_time']?>
                           </div>
                       </td>

                       <td>

                           <?php
                               switch ($status){
                                   case 0: ?>
                                       <div>
                                           <button class="btn btn-block btn-warning" disabled>Pending</button>
                                       </div>
                                       <div style="margin-top:5px;">
                                           <a href="#" class="btn btn-block btn-danger" onclick="delBookHost(<?php echo $row['host_id'];?>,<?php echo $id ;?>) ">Cancel</a>
                                       </div>
                           <?php   break;
                                   case 1: ?>
                                       <div>
                                           <button class="btn btn-block btn-success" disabled>Accepted</button>
                                       </div>
                                       <div style="margin-top:5px;">
                                           <a href="#" class="btn btn-block btn-info" onclick="viewHost(<?php echo $row['host_id'];?>)">Contact Info</a>
                                       </div>
                           <?php   break;
                                   case 2: ?>
                                       <div>
                                           <button class="btn btn-block btn-danger" disabled>Rejected</button>
                                       </div>
                                       <!--  <div style="margin-top:5px;">
                                           <a href="#" class="btn btn-block btn-info" onclick="viewHost(<?php echo $row['host_id'];?>)">View Host</a>
                                       </div>-->
                           <?php   break; }; ?>

                       </td>
                    </tr>
                    <?php endforeach; ?>
    		        <?php endif; ?>
                    </tbody>
                </table>
              </div>
    	    </div>
    		<!-- Host reservations tab end -->

    		<!-- Guest being Booked tab begin -->
    		<div class="tab-pane fade" id="booked-tab">
    		  <div class="col-md-12">
                <table class="table table-hover">
                    <caption class="text-center"><h2>Who booked you</h2></caption>

                    <tbody>
                    <?php if ($rows_booked): ?>
                    <?php foreach ($rows_booked as $row):
                        $status=$row['status'];
                    ?>
                    <tr>
                       <td width="20%">
                           <div class="thumbnail">
                           <a href="#" onclick="viewHost(<?php echo $row['host_id'];?>)">
                           <?php if ($row['picture']){?>
                               <img class="img-circle" src="uploads/profile_img/user_id_<?php echo $row['host_id']."/".$row['picture'];?>" alt="host-profile-image" />
                           <?php }else { ?>
                               <img class="img-circle" src="images/default/profile-img.png" alt="host-profile-image" />
                           <?php } ?>
                           </a>
                           </div>
                       </td>

                       <td>
                           <div>
                               <b>Name:</b>
                               <?php echo $row['first_name']?>,
                               <?php echo $row['gender']=1?'Male':'Female'?>,
                               <?php echo $row['age']?> year's old
                           </div>
                           <div>
                               <b>Location:</b>
                               <?php echo $row['route']?>
                               <?php echo $row['locality']?>
                               <?php echo $row['administrative_area_level_1']?>
                               <?php echo $row['country']?>
                           </div>
                           <div>
                               <b>Ethnicity:</b>
                               <?php echo $row['ethnicity']?>
                           </div>
                           <div>
                               <b>Reservation date:</b>
                               <?php echo $row['book_time']?>
                           </div>
                       </td>

                       <td>
                           <?php
                               switch ($status){
                                   case 0: ?>
                                       <div>
                                           <button class="btn btn-block btn-success" onclick="acceptHostBook(<?php echo $row['host_id'] ;?>,<?php echo $id ;?>)">Accept</button>
                                       </div>
                                       <div style="margin-top:5px;">
                                           <a href="#" class="btn btn-block btn-danger" onclick="cancelHostBook(<?php echo $row['host_id'] ;?>,<?php echo $id ;?>)">Reject</a>
                                       </div>
                           <?php   break;
                                   case 1: ?>
                                       <div>
                                           <button class="btn btn-block btn-success" disabled>Accepted</button>
                                       </div>
                                       <div style="margin-top:5px;">
                                           <button class="btn btn-block btn-info" onclick="viewHost(<?php echo $row['host_id'];?>)">Contact info</button>
                                       </div>
                           <?php   break;
                                   case 2: ?>
                                       <div>
                                           <button class="btn btn-block btn-danger" disabled>Rejected</button>
                                       </div>
                                       <!--  <div style="margin-top:5px;">
                                           <a href="#" class="btn btn-block btn-info" onclick="viewHost(<?php echo $row['host_id'];?>)">View Host</a>
                                       </div>-->
                           <?php   break; }; ?>
                       </td>
                    </tr>
                    <?php endforeach; ?>
    		        <?php endif; ?>
                    </tbody>
                </table>
              </div>
    		</div>
    		<!-- Booked tab end -->


    		<!-- Reservations requirment tab begin
    		<div class="tab-pane fade" id="requirement-tab">



    		</div>
    		 Reservations requirment tab end -->

            </div>

        </div>
        <!-- /.col-md-9 -->
        </div>
        <!-- /.row -->

        <hr>

    </div>
    <!-- /.container -->
    <script>

    </script>

<?php
    include_once 'footer.php';
?>

