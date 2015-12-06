<?php

    include_once 'include.php';
    include_once 'header.php';
    checkProfileSession();

    // Fetch row numbers of houses
    $sql="select id from tg_host_calendar where is_avail=1";
    $totalRows=getResultNum($sql);
    $pageSize=15;

    //it has to be set to GLOBAL!!
    global $totalPage;
    $totalPage=ceil($totalRows/$pageSize);
    @$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;

    if($page<1 || $page==null || !is_numeric($page)){
        $page=1;
    }

    if($page>=$totalPage) $page=$totalPage;
    $offset=($page-1)*$pageSize;
    $arr=$_POST;
    @$order=$_REQUEST['order']?$_REQUEST['order']:null;
    @$orderBy=$order?"order by h.".$order:null;

    @$route=$_GET['route']?$_GET['route']:null;
    @$country=$_GET['country']?$_GET['country']:null;
    @$state=$_GET['administrative_area_level_1']?$_GET['administrative_area_level_1']:null;
    @$city=$_GET['locality']?$_GET['locality']:null;

    $where="where l.country like '%{$country}%'
            and l.route like '%{$route}%'
            and l.administrative_area_level_1 like '%{$state}%'
            and l.locality like '%{$city}%'";

    @$sql = "SELECT *
                FROM tg_host_house as h
                JOIN tg_host_info i ON i.host_id = h.house_id
                JOIN tg_house_location l ON l.location_id = h.house_id
                JOIN tg_host_calendar c ON c.calendar_id = h.house_id
                JOIN tg_host_services s ON s.services_id = h.house_id
                JOIN tg_user_login lo ON lo.user_id = h.house_id
                {$where}
                order by lo.last_login desc
                limit {$offset},{$pageSize}";

    $rows=fetchAll($sql);

    //$sql_pic="SELECT *"



?>

<!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Page Heading/Breadcrumbs row -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <small>Homestay Finder</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Home</a>
                            </li>
                            <li class="active"><a href="host-search-result.php">Guest Finder</a></li>
                        </ol>
                    </div>
                </div>
                <!-- /.Page Heading/Breadcrumbs row end -->

                    <form method="GET" action="guest-search-result.php">

                    <div class="col-md-6">
                        <input type="text" class="form-control no-bRadius" id="geocomplete" placeholder="Where do you go" >
                        <span class="fa fa-map-marker"></span>

                        <!-- search input hidden area -->
                        <input type="text" name="route" class="search-hide" placeholder="route" />
                        <input type="text" name="locality" class="search-hide" placeholder="city" />
                        <input type="text" name="administrative_area_level_1" class="search-hide" placeholder="state" />
                        <input type="text" name="country" id="gpCountry" class="search-hide" placeholder="country" />
                        <!-- search input hidden area end -->

                    </div>
                    <!-- /.col-lg-6 -->

                   <!--  <div class="col-md-2">
                        <input type="text" class="form-control no-bRadius from" id="arrive-input" name="s-arrival" placeholder="Arrival" />
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control no-bRadius to" name="s-depart" placeholder="Depart" />
                    </div>   -->
                    <div class="col-md-2">
                        <button class="form-control btn btn-danger" id="search-btn"><b>Search Homestay</b></button>
                    </div>
                    </form>
            </div>
            <!-- /.col-md-12 -->
        </div>
        <!-- /.col-md-12 -->


            <div class="row">
            <div class="col-md-12">
<!--             <form action="#" method="post" id="filter_form">

                    <div class="col-md-1 form-group">
                        <label>Filter</label>
                    </div>
                    <div class="col-md-5 form-group">

                          <label class="btn btn-default">
                            <input type="checkbox" name="room_type" id="entire_home" value="entire_home" /> Entire Home
                          </label>

                          <label class="btn btn-default">
                            <input type="checkbox" name="room_type" id="private_room" value="private_room"/> Private Room
                          </label>

                          <label class="btn btn-default">
                            <input type="checkbox" name="room_type" id="shared_room" value="shared_room" /> Shared Room
                          </label>

                    </div>


                    <div class="col-md-4 form-group">

                          <label class="btn btn-default">
                            <input type="checkbox"> Daily Meal
                          </label>

                          <label class="btn btn-default">
                            <input type="checkbox"> Commute
                          </label>

                          <label class="btn btn-default">
                            <input type="checkbox" autocomplete="off"> Laundry
                          </label>

                    </div>

                    <div class="col-md-2 form-group">
                        <div class="btn-group" data-toggle="buttons">
                          <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle"
                                  data-toggle="dropdown">
                                  Preferred Language
                                  <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a href="#"> 1</a></li>
                                  <li><a href="#"> 2</a></li>
                                </ul>
                              </div>
                        </div>
                    </div>-->
<!--             </form> -->


            <!-- method="GET" end -->
            </div>
            <!-- /.col-md-12 -->
        </div>
        <!-- /.row -->

        <hr>

        <!-- Guest search result -->
        <div class="row">
            <?php if (!empty($rows)){ ?>
            <?php foreach($rows as $row): ?>
            <?php if($row['is_avail']==1): ?>

            <!-- each row one user -->
            <div class="col-md-12">

            	<!-- left side house image -->
                <div class="col-md-3">
                    <!-- profile image -->
                    <div class="thumbnail">
                        <a href = "#" onclick="viewHouse(<?php echo $row['house_id'];?>)">
                        <?php if($row['picture']){ ?>
                            <img class="img-circle" src="uploads/profile_img/user_id_<?php echo $row['host_id']."/".$row['picture'];?>">
                        <?php }else{ ?>
                            <img class="img-circle" src="images/default/profile-img.png" >
                        <?php } ?>
                        </a>
                        <!-- name button -->
                        <div class="caption text-center">
                            <a href = "#" onclick="viewHouse(<?php echo $row['house_id'];?>)">
                                <h4><?php echo ucfirst(strtolower($row['first_name'])); ?></h4>
                            </a>
                       <!--   <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>-->
                        </div>

                    </div>
                </div>
                <!--col-md-3 end -->

               <!-- right side of house description -->
               <div class="col-md-7" style="margin-top:-20px;">
                  <table class="table table-condensed">
                       <tbody>
                          <tr>
                             <td><h3><a href = "#" onclick="viewHouse(<?php echo $row['house_id'];?>)"><b><?php echo $row['house_title']?></b></a></h3></td>
                          </tr>

                          <tr>
                             <td>Location: <span><?php echo $row['locality'];?>&nbsp;<?php echo $row['administrative_area_level_1'];?>&nbsp;<?php echo $row['country'];?></span></td>
                          </tr>
                          <tr>
                             <td>Home type:
                             <span>

                                <?php
                                switch ($row['house_type']){
                                    case 1:
                                        echo 'House';
                                        break;
                                    case 2:
                                        echo 'Apartment';
                                        break;
                                    case 3:
                                        echo 'Condo';
                                        break;
                                    case 4:
                                        echo 'Town House';
                                        break;
                                    case 5:
                                        echo 'Other';
                                        break;
                                };

                                ?>

                             </span></td>
                          </tr>
                          <tr>
                             <td>Room type:
                             <span>
                                <?php
    						    switch ($row['room_type']){
    						        case 1:
    						            echo 'Private Room';
    						            break;
    						        case 2:
    						            echo 'Shared Room';
    						            break;
    						        case 3:
    						            echo 'Entire Home';
    						            break;
    						    }
						    ?>

                             </span></td>
                          </tr>
                          <tr >
                             <td class="table-nowrap">Services: <span><?php echo $row['daily_services'];?></span></td>
                          </tr>
                          <tr >
                             <td><a href = "#" class="btn btn-default btn-sm" onclick="viewHouse(<?php echo $row['house_id'];?>)">more...</a></td>
                          </tr>
                       </tbody>
                   </table>
               </div>
               <!-- col-md-8 end -->

               <div class="col-md-2">
                   <?php if($row['d_price']!=0) { ; ?>
                       <p><button class="btn btn-block btn-price"><span> $ <?php echo $row['d_price'];?> per day</span></button></p>
                   <?php } else { ?>
                       <p><button class="btn btn-block btn-price"><span> N/A </span></button></p>
                   <?php } ?>

                   <?php if($row['m_price']!=0) { ; ?>
                       <p><button class="btn btn-block btn-price"><span> $ <?php echo $row['m_price'];?> per month</span></button></p>
                   <?php } else { ?>
                       <p><button class="btn btn-block btn-price"><span> N/A </span></button></p>
                   <?php } ?>

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
               </div>
           </div>
           <!-- col-md-12 end -->

           <hr class="divider">

           <?php endif; ?>
           <?php endforeach; ?>
           <?php } else{ ?>

                <div class="row" style="height:300px;">
                    <div class="col-lg-12">
                    <h3>There is no listing in your area yet. Please list your request for potential host families to contact you.</h3>


                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4" style="margin-top:50px;">
                                <a href="list-request.php" class="btn btn-lg btn-default btn-block">List Your Request</a>
                        </div>
                        <div class="col-md-4">
                        </div>

                    </div>
                </div>

           <?php } ?>

        </div>
        <!-- Row end -->

        <hr>

        <!-- Pagination -->
         <div class="row text-center" style="font-size:18px; margin-bottom:20px;">
            <div class="col-lg-12">

                       <?php if($rows>$pageSize):?>

                <?php echo @showPage($page, $totalPage,"keywords={$keywords}&order={$order}");?>
            <?php endif;?>

            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

<?php
    include_once 'footer.php';
?>
