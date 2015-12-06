
        <!-- Right Content Column begin -->
		<div class="col-md-8 margin-l-92">
			<div class="row" id="rp-house-tit">
				<h4><b>
				    <?php if(!empty($row['first_name'])): echo ucfirst(strtolower($row['first_name'])); endif; ?>&nbsp;
				        <?php if($row['gender']!=NULL): echo $row['gender']==1?'Male':'Female'; endif; ?>&nbsp;
				        <?php if(!empty($row['age'])): echo $row['age'] .'-years old'; endif; ?>&nbsp; from &nbsp;
				        <?php if(!empty($row['from_country'])): echo strtoupper($row['from_country']); endif; ?>&nbsp;
				</b></h4>
				 is looking for homestay in:

			</div>

			<hr class="divider">

            <table class="table table-condensed">
				<caption>Destination</caption>
				<tbody>

					<tr>
						<td style="width:30%;">Country</td>
						<td><b><?php if(!empty($row['country'])): echo $row['country']; endif; ?></b></td>
					</tr>

					<tr>
						<td>State</td>
						<td><b><?php if(!empty($row['administrative_area_level_1'])): echo $row['administrative_area_level_1']; endif; ?></b></td>
					</tr>

					<tr>
						 <td>City</td>
						 <td><b><?php if(!empty($row['locality'])): echo $row['locality']; endif; ?></b></td>
					 </tr>

					 <tr>
						 <td>Address</td>
						 <td><b><?php if(!empty($row['street_number'])): echo ucfirst(strtolower($row['street_number'])); endif; ?>&nbsp;
						        <?php if(!empty($row['route'])): echo $row['route']; endif; ?></b></td>
					 </tr>

					<tr>
						<td>Name of school / company</td>
						<td><b><?php if(!empty($row['name_dest'])): echo $row['name_dest']; endif; ?></b></td>
					</tr>

				 </tbody>
			 </table>

			 <hr class="divider">

			 <table class="table table-condensed">
				<caption>Personal information</caption>
				<tbody>

					<tr>
						<td style="width:30%;">Ethnicity</td>
						<td><b><?php if(!empty($row['ethnicity'])): echo $row['ethnicity']; endif; ?></b></td>
					</tr>

					<tr>
						<td>Occupation</td>
						<td><b>
						    <?php if(!empty($row['occupation'])):
						        switch ($row['occupation']){
						            case 1:
						                echo 'Student';
						            break;
						            case 2:
						                echo 'Office worker';
						            break;
						            case 3:
						                echo 'Self employed';
						                break;
					                case 4:
					                    echo 'Other';
					                    break;
						        }; endif; ?>
						</b></td>
					</tr>

					<tr>
						<td>Language</td>
						<td><b>
						    <?php if(!empty($row['language'])):

						        for($i=0;$i<strlen($row['language']);$i++){
						            if($row['language'][$i] == 1){
						                echo 'English ';
						            }elseif($row['language'][$i] == 2){
						                echo 'Spanish ';
						            }elseif($row['language'][$i] == 3){
						                echo 'Chinese ';
						            }elseif($row['language'][$i] == 4){
						                echo 'Vietnamese ';
						            }elseif($row['language'][$i] == 5){
						                echo 'Fillipino ';
						            }elseif($row['language'][$i] == 6){
						                echo 'French ';
						            }elseif($row['language'][$i] == 7){
						                echo 'German ';
						            }elseif($row['language'][$i] == 8){
						                echo 'Indian ';
						            }elseif($row['language'][$i] == 9){
						                echo 'Arabic ';
						            }elseif($row['language'][$i] == "a"){
						                echo 'Korean ';
						            }elseif($row['language'][$i] == "b"){
						                echo 'Japanese ';
						            }elseif($row['language'][$i] == "c"){
						                echo 'Portuguese ';
						            }
						        } endif; ?>
						</b></td>
					</tr>

					<tr>
						<td style="width:30%;">Purpose of travelling</td>
						<td><b>
						    <?php if(!empty($row['purpose'])):

						    switch ($row['purpose']){
						        case 1:
						            echo 'Study abroad';
						            break;
						        case 2:
						            echo 'Travel';
						            break;
						        case 3:
						            echo 'Business';
						            break;
						        case 4:
						            echo 'Other';
						            break;
						    }; endif; ?>
						</b></td>
					</tr>

				</tbody>
			</table>

			<hr class="divider">

			<table class="table table-condensed">
				<caption>Preferred services</caption>
				<tbody>

					<tr>
						<td style="width:30%;">Services required</td>
						<td><b>
						<?php if(!empty($row['preferred_services'])):

						for($i=0;$i<strlen($row['preferred_services']);$i++){
						    if($row['preferred_services'][$i] == 1){
						        echo 'Meals | ';
						    }elseif($row['preferred_services'][$i] == 2){
						        echo 'Transportation | ';
						    }elseif($row['preferred_services'][$i] == 3){
						        echo 'Laundry | ';
						    }elseif($row['preferred_services'][$i] == 4){
						        echo 'Room cleaning | ';
						    }elseif($row['preferred_services'][$i] == 5){
						        echo 'Internet | ';
						    }elseif($row['preferred_services'][$i] == 6){
						        echo 'Language lesson | ';
						    }elseif($row['preferred_services'][$i] == 7){
						        echo 'Airport pick-up | ';
						    }elseif($row['preferred_services'][$i] == 8){
						        echo 'Wifi | ';
						    }elseif($row['preferred_services'][$i] == 9){
                                echo 'Legal guardianship ';
                            }
						}; endif; ?>
						</b></td>
					</tr>
                </tbody>
            </table>

            <hr class="divider">

            <table class="table table-bordered">
				<caption>Introduction</caption>
				<tbody>
					<tr>
						<td><textarea class="form-control" rows="6" name="intro" readonly><?php echo $row['intro']; ?></textarea></td>
					</tr>

				</tbody>
			</table>
		</div>
		<!-- Right Content Column end -->
    </div>
    <!-- content row end -->
</div>
<!-- /.container -->

<!-- Google Map begin -->
<div class="container" style="width:100%;padding:0;">
     <div id="map-canvas" style="width:100%;height:500px; margin:0 auto;"></div>
     <input type="hidden" id="lat" value=<?php echo $row['lat']; ?> />
     <input type="hidden" id="lng" value=<?php echo $row['lng']; ?> />
</div>
<!-- Google Map end -->