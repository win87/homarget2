
    <?php
        $sql = "select * from tg_house_img where album_id={$id} and img_path != 0";
        $rows_img = fetchOne($sql);
    ?>

        <!-- Right Content Column begin -->
		<div class="col-md-8 margin-l-65">

		<?php if($rows_img==0){ ?>
            <div><img src="images/no-image.png" alt="no-image" style="width:28%" /></div>
        <?php } else { ?>

			<!-- Jssor Slider Begin -->
			<div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 650px; height: 450px; background: #191919; overflow: hidden;">

				<!-- Loading Screen -->
				<div u="loading" style="position: absolute; top: 0px; left: 0px;">
					<div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block; background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
					</div>

					<div style="position: absolute; display: block; background: url(img/loading.gif) no-repeat center center; top: 0px; left: 0px;width: 100%;height:100%;">
					</div>
				</div>

				<!-- Slides Container -->
				<div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 650px; height: 450px; overflow: hidden;">
					<?php foreach ($rows as $row):
                        if(!empty($row['img_path'])){
					?>
					<div>
						<img u="image" src="uploads/House_Album/user_id_<?php echo $row_user['host_id']."/".$row['img_path'];?>" alt="house-images">
					</div>
					<?php } endforeach; ?>
			    </div>

				<!-- Arrow Navigator Skin Begin -->
				<!-- Arrow Left -->
				<span u="arrowleft" class="jssora05l" style="width: 40px; height: 40px; top: 190px; left: 8px;">
				</span>
				<!-- Arrow Right -->
				<span u="arrowright" class="jssora05r" style="width: 40px; height: 40px; top: 190px; right: 8px">
				</span>
				<!-- Arrow Navigator Skin End -->

				<!-- Thumbnail Navigator Skin Begin -->
				<div u="thumbnavigator" class="jssort01" style="position: absolute; width: 650px; height: 80px; left:0px; bottom: 0px;">

					<!-- 锟斤拷锟斤拷植锟斤拷锟斤拷锟酵� -->
					<div u="slides" style="cursor: move;">
						<div u="prototype" class="p" style="position: absolute; width: 67px; height: 67px; top: 0; left: 0;">
							<div class=w><div u="thumbnailtemplate" style=" width: 100%; height: 100%; border: none;position:absolute; top: 0; left: 0;"></div></div>
							<div class=c>
							</div>
						</div>
					</div>
				</div>
				<!-- Thumbnail Navigator Skin End -->
			</div>
            <!-- Jssor Slider End -->
            <?php } ?>

            <hr>

			<table class="table table-condensed">
				<caption>Household information</caption>
				<tbody>

				    <tr>
                        <td class="table-content"></td>
						<td style="width:40%;">Gender: <b><?php if($row_user['gender']!==NULL): echo $row_user['gender']==1?'Male':'Female'; endif; ?></b></td>
						<td>Age: <b><?php if(!empty($row_user['age'])): echo $row_user['age']; endif; ?></b></td>

					</tr>

					<tr>
						<td></td>
						<td>Ethnicity: <b><?php if(!empty($row_user['ethnicity'])): echo $row_user['ethnicity']==true?$row_user['ethnicity']:null; endif; ?></b></td>
                        <td>Occupation: <b>
						    <?php
						        switch ($row_user['occupation']){
						            case 1:
						                echo 'Office worker';
						            break;
						            case 2:
						                echo 'Manual worker';
						            break;
						            case 3:
						                echo 'Self employed';
						                break;
						            case 4:
						                echo 'Executive/Professional';
						                break;
					                case 5:
					                    echo 'Housewife';
					                    break;
					                case 6:
					                    echo 'Retired';
					                    break;
				                    case 7:
				                        echo 'Student';
				                        break;
				                    case 8:
				                        echo 'Other';
				                        break;
						        }
						    ?>
						</b></td>
					</tr>

					<tr>
						<td></td>
						<td>Language: <b>
						    <?php if(!empty($row_user['language'])):
						        for($i=0;$i<strlen($row_user['language']);$i++){
						            if($row_user['language'][$i] == 1){
						                echo 'English ';
						            }elseif($row_user['language'][$i] == 2){
						                echo 'Spanish ';
						            }elseif($row_user['language'][$i] == 3){
						                echo 'Chinese ';
						            }elseif($row_user['language'][$i] == 4){
						                echo 'Vietnamese ';
						            }elseif($row_user['language'][$i] == 5){
						                echo 'Fillipino ';
						            }elseif($row_user['language'][$i] == 6){
						                echo 'French ';
						            }elseif($row_user['language'][$i] == 7){
						                echo 'German ';
						            }elseif($row_user['language'][$i] == 8){
						                echo 'Indian ';
						            }elseif($row_user['language'][$i] == 9){
						                echo 'Arabic ';
						            }elseif($row_user['language'][$i] == 'a'){
						                echo 'Korean ';
						            }elseif($row_user['language'][$i] == 'b'){
						                echo 'Japanese ';
						            }elseif($row_user['language'][$i] == 'c'){
						                echo 'Portuguese ';
						            }
						        }; endif;
						    ?>
						</b></td>
                        <td></td>
					</tr>
				</tbody>
			</table>

			<hr class="divider">

			<table class="table table-condensed">
				<caption>Accommodation information</caption>
				<tbody>
					<tr>
						<td class="table-content"></td>
						<td style="width:40%;">House type: <b>
						<?php if(!empty($row_house['house_type'])):
    						switch ($row_house['house_type']){
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
    						}; endif;
						?>
						</b></td>
                        <td>Room type: <b>
						<?php if(!empty($row_house['room_type'])):
    						switch ($row_house['room_type']){
    						    case 1:
    						        echo 'Private Room';
    						        break;
    						    case 2:
    						        echo 'Shared Room';
    						        break;
    						    case 3:
    						        echo 'Entire Home';
    						        break;
    						};endif;
    					?>
						</b></td>
					</tr>

					<tr>
						<td></td>
					    <td>Bedroom: <b><?php if(!empty($row_house['bedroom'])): echo $row_house['bedroom']; endif; ?></b></td>
                        <td>Bathroom: <b><?php if(!empty($row_house['bathroom'])): echo $row_house['bathroom']; endif; ?></b></td>
					</tr>

                    <?php if(!empty($row_house['adult_no']) || !empty($row_house['child_no'])): ?>
					<tr>
                        <td></td>
                        <td># of Adults living in: <b><?php if(!empty($row_house['adult_no'])): echo $row_house['adult_no']; endif; ?></b></td>
                        <td># of Children living in: <b><?php echo $row_house['child_no']; ?></b></td>
                    </tr>
                    <?php endif; ?>

				</tbody>
			</table>

			<hr class="divider">

			<table class="table table-condensed">
				<caption>Services</caption>
				<tbody style="text-indent:72px;">
				    <tr>
						<td style="width:20%;">Daily: </td>
						<td><b><?php if(!empty($row_services['daily_services'])): echo $row_services['daily_services']; endif; ?></b></td>
					</tr>

                    <?php ?>
					<tr>
						<td>Common: </td>
						<td><b><?php if(!empty($row_services['common'])): echo $row_services['common']; endif; ?></b></td>
					</tr>

					<tr>
						<td>Extras: </td>
						<td><b><?php if(!empty($row_services['extras'])): echo $row_services['extras']; endif; ?></b></td>
					</tr>

                </tbody>
            </table>

            <hr class="divider">

            <?php if(!empty($row_house['summary'])): ?>
            <table class="table table-bordered">
				<caption>Introduction</caption>
				<tbody>
					<tr>
						<td><textarea class="form-control" rows="6" name="summary" readonly><?php echo $row_house['summary']; ?></textarea></td>
					</tr>
				</tbody>
			</table>
            <?php endif; ?>
		</div>
		<!-- Right Content Column end -->
    </div>
    <!-- content row end -->
</div>
<!-- /.container -->

<!-- Google Map begin -->
<div class="container" style="width:100%;padding:0;">
    <!-- Google Maps API -->
    <div id="map-canvas" style="width:100%;height:500px; margin:0 auto;"></div>
    <input type="hidden" id="lat" value="<?php echo $row_location['lat'];?>" />
    <input type="hidden" id="lng" value="<?php echo $row_location['lng'];?>" />
</div>
<!-- Google Map end -->

