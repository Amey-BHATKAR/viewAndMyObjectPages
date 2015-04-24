<?php

/*
 * $dates = array('2015-03-01 10:20:30', '1983-02-21 07:00:00'); var_dump(json_encode($dates))
 */
?>

<!-- <button id="pre-selected-dates">Show selected dates!</button>  -->
<div class="col-sm-18"
	style="height: 300px; padding: 20px 20px; border-radius: 10px; background-color: #f3f3f3; width: 1040px;">

	<div class="col-sm-18" style="padding: 20px 0px;">

		<div class="col-md-4" style="padding-left: 0px; height: 105px;">
			<div class="panel panel-default">
				<div class="panel-heading">
	              <?php echo $art->print_picture(200); ?>
				 </div>
				<div class="panel-body" style="padding: 5px;">
					<div class="col-md-6">
						<?php echo $art->print_picture(50, null, null, 1); ?>
					 </div>
					<div class="col-md-6">
						<?php echo $art->print_picture(50, null, null, 2); ?>
					 </div>
					<div class="col-md-6">
						<?php echo $art->print_picture(50, null, null, 3); ?>
					 </div>
				</div>
			</div>
		</div>


		<div class="col-sm-4">
			<div class="panel panel-default">
				<div class="black"
					style="padding: 20px 0px; font-size: 25px; font-weight: bold;">
					<nobr><?php echo $prodName; ?>
		            <?php echo article::getNoteMoy($prodID); ?>
					</nobr>
				</div>
				<div class="col-md-18" style="padding: 4px 0px;">
					<div class="col-md-9">
						<div class="black" style="font-size: 18px; font-weight: bold;">
							Categorie:</div>
					</div>

					<div class="col-md-6">
						<div class="blue" style="font-size: 18px;">
			            	<?php echo $categoryArticle; ?>
			            </div>
					</div>

				</div>
				<div class="col-md-18" style="padding: 4px 0px;">
					<div class="col-md-9">
						<div class="black" style="font-size: 18px; font-weight: bold;">
							Description:</div>
					</div>

					<div class="col-md-18">
						<div class="blue" style="font-size: 18px;">
			            	<p> <?php echo $prodDesc; ?></p>
			            </div>
					</div>

				</div>
				<div class="col-md-18" style="padding: 4px 0px;">
					<div class="col-md-9">
						<div class="black" style="font-size: 18px; font-weight: bold;">
							Caution:</div>
					</div>

					<div class="col-md-6">
						<div class="blue" style="font-size: 18px;">
			            	<?php echo $articleCaution." "; ?>€
			            </div>
					</div>

				</div>
				<div class="col-md-18" style="padding: 4px 0px;">
					<div class="col-md-12">
						<div class="black" style="font-size: 18px; font-weight: bold;">
							<?php echo $articlePrice; ?> <img
								src="<?php echo WEBDIR; ?>/img/header_number_mutum.png"
								style="width: 30px; height: 21px">
						</div>
					</div>
					<div class="col-md-6">
						<button id="text" class="btn blue">J'emprunte!</button>
					</div>

				</div>

			</div>
		</div>



		<div class="col-sm-3">
			<div class="panel panel-default">&nbsp;&nbsp;&nbsp;&nbsp;</div>
		</div>

		<div class="col-sm-4">
			<div class="black"
				style="padding: 20px 0px; font-size: 22px; font-weight: bold;">
				<nobr><?php echo user::printNote($prodOwner['user_nb_notation'],$prodOwner['user_notation'])." ".$prodOwnerName; ?></nobr>
			</div>
			<div class="col-md-9" style="padding: 4px 0px;">
				<div class="black" style="font-size: 18px; font-weight: bold;">
					Ajoute le:</div>
			</div>

			<div class="col-md-6" style="padding: 4px 0px;">
				<div class="blue" style="font-size: 18px;">
					<nobr><?php echo $productAddedOn; ?></nobr>
				</div>
			</div>
			<div class="col-md-9" style="padding: 4px 0px;">
				<div class="black" style="font-size: 18px; font-weight: bold;">
					Ville:</div>
			</div>

			<div class="col-md-6" style="padding: 4px 0px;">
				<div class="blue" style="font-size: 18px;">
					<nobr><?php echo $prodOwnerCity; ?></nobr>
				</div>
			</div>

			<div class="col-md-9" style="padding: 4px 0px;">
				<div class="black" style="font-size: 18px; font-weight: bold;">
					Distance:</div>
			</div>

			<div class="col-md-6" style="padding: 4px 0px;">
				<div class="blue" style="font-size: 18px;">
					<nobr><?php echo $prodAndOwnerDistance; ?></nobr>
				</div>
			</div>
			<div class="col-md-9" style="padding: 4px 0px; z-index: 2"
				id="calendar"></div>

		</div>

		<div class="col-md-1">
			<div class='owner'
				style='float: left; width: 60px; height: 60px; border-radius: 2px;'>
				<div><?php echo $owner->print_user(60) ?></div>
			</div>
			
		</div>



	</div>

</div>

<div class="col-sm-18"
	style="height: 350px; width: 1040px; padding: 20px 0px; border-radius: 10px; z-index: 1">
	<div id="mapToDisplay">
		<div class="panel panel-default">
			<div class='col-md-18' id='google_map_results'
				style='padding: 0px 20px; border-radius: 10px; height: 350px; width: 1040px;'>

			</div>


		</div>

	</div>


	<div id="formToDisplay"
		style="padding: 20px 10px; height: 300px; width: 1020px; background-color: #f3f3f3; border-radius: 10px;">
		<div class="panel panel-default">
			<form id="contactForm" method="post">
				<h1>Demande d'emprunte!</h1>

				<div class="col-md-12" style="padding: 4px 0px;">
					<div class="col-md-8">
						<div class="black" style="font-size: 18px; font-weight: bold;">
							Date de début d'emprunt</div>
					</div>
					<div class="col-md-4">
						<input type="date" id="debutDate">
					</div>

				</div>

				<div class="col-md-12" style="padding: 4px 0px;">
					<div class="col-md-8">
						<div class="black" style="font-size: 18px; font-weight: bold;">
							Date de fin d'emprunt</div>
					</div>
					<div class="col-md-4">
						<input type="date" id="finDate">
					</div>

				</div>

				<div class="col-md-12" style="padding: 4px 0px;">
					<div class="col-md-8">
						<div class="black" style="font-size: 18px; font-weight: bold;">
							Message</div>
					</div>
					<div class="col-md-4">
						<textarea rows="8" cols="80" draggable="true" id="content"></textarea>
                        <nobr>

                            <p>Ce préteur demande une caution. Cella ci ne sera débitée
                                qu'en cas de soucis qu'avec votre accord.

                                <b>Enregistrer une carte.</b>
                            </p>
                        </nobr>
                        <nobr>
                            Total:<?php echo "12"; ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


                            <input id="maps" class="submit" type="submit"
                                   value="J'emprunte!"/>
                        </nobr>


                    </div>

				</div>



			</form>
		</div>
	</div>
</div>






<script type="text/javascript">

	//Function for hiding or showing the map
	$(document).ready(function(){

		//var date = new Date();
		
		$("#mapToDisplay").show();
		$("#formToDisplay").hide();
		$("#text").click(function(){
	        $("#mapToDisplay").toggle();
	        $("#formToDisplay").toggle();
	    });

		$("#contactForm").on('submit', function(e){
			//e.preventDefault();
	       
	        $.ajax({ url: "<?php echo AJAXLOAD;?>view",
			        data: {
				        	action: 'sendMail',
				        	debutDate: $("#debutDate").val(),
				           	finDate: $("#finDate").val(),
				           	content: $("#content").val(),
				           	from: "<?php echo Session::Me()->getAttr('email'); ?>",
				           	fromId: "<?php echo Session::Me()->getAttr('id'); ?>",
				           	toId: "<?php echo $prodOwnerID; ?>",
				           	forProduct: "<?php echo $prodName; ?>",
				           	productOwnerEmail: "<?php echo $prodOwnerEmail; ?>"       	
				          },
			        type: 'post',
			        success: function(response) {
			                     alert(response);
			                 }
			});
	    });

        var dates = <?php echo($art_dates); ?>;
        $('#calendar').multiDatesPicker({
            dateFormat: 'yy-mm-dd',
//            addDates: dates
            addDisabledDates: dates
        });




	function initialize_result() {

	  //Initialise la zone des marqueurs
	  var zoneMarqueurs = new google.maps.LatLngBounds();


	  //Affichage Carte
	  var options_map = {
	    center: latlng,
	    maxZoom: 18,
	    mapTypeId: google.maps.MapTypeId.ROADMAP,
	    zoomControl: true,
	    zoomControlOptions: {
	      style: google.maps.ZoomControlStyle.LARGE,
	      position: google.maps.ControlPosition.RIGHT_BOTTOM
	    },
	    disableDefaultUI: true,
	    streetViewControl: false
	  };
	  var carte = new google.maps.Map(document.getElementById("google_map_results"), options_map);
	  

	    //Marking the user's position
	<?php
	if ($location_coords [0] != 0 && $location_coords [1] != 0) {
		?>
	  
	  var latlng = new google.maps.LatLng(<?=$location_coords[0];?>,<?=$location_coords[1];?>);

	  var myPosition = new google.maps.Marker({
	    position: latlng,
	    map: carte,
	    icon: '/Obj/img/marker_home.png',
	    title: "Votre Adresse"
	  });
	  zoneMarqueurs.extend(  myPosition.getPosition() );

	<?php
	}
	?>

	  //Marking the owner's/product's position

	  <?php
			if ($lat != 0 && $lng != 0) {
				?>
	  
	  var latlng = new google.maps.LatLng(<?=$lat;?>,<?=$lng;?>);

	  var myPosition = new google.maps.Marker({
	    position: latlng,
	    map: carte,
	    //icon: '/Obj/img/marker_home.png',
	    title: "<?php echo $prodName; ?>"
	  });
	  zoneMarqueurs.extend(  myPosition.getPosition() );

	<?php
			}
			?>
	  
	  
	  carte.fitBounds(zoneMarqueurs);

	 }



	google.maps.event.addDomListener(window, 'load', initialize_result);
			
		
		
		
	});

	
</script>

