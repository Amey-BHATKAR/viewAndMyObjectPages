<div class='blue bold' style='height: 80px; text-align: center;'>
	Titre de la page
</div>
<div class='col-md-3' style='border-radius: 10px; background-color: #f3f3f3; padding-bottom: 10px; padding-top: 10px'>
	<div class="menu">
		<form action="" method="post">
			<?php
				/* $listecomm = '';
				$i=0;
				foreach(community::getAllMyCommunity(Session::Me()->getAttr('id')) as $unecommunity)
				{ */
					?>
					<div class='bloc_communaute' style="padding: 5px">
						<div class='communaute color_0' id='communaute_1'>
							<div class='communaute_nom color_1'  id='com_1'>
								<div class='communaute_nom_name'>
								<!-- Complete functionality for the checkboxes (all of them) is to be added. -->
									<span> Objets en prét 
										<input type='checkbox' class='check' name='checkcomm' id='checkcomm_1' value='1'/>
											<label style="margin-top: 0px; margin-right: 15px;" 
												for='checkcomm_1' class='checkcomm'></label>
									</span>
								</div>
								
							</div>
							<div class='communaute_check' id='communaute_check_1'>
							  
							</div>
						</div>
						<div id='communaute_menu_1' class='communaute_menu' style="height:50px;">
						    <div class='blue' style='padding:5px 0px 0px 5px;'><span class='bold'>type : </span></div>
						    
						</div>
						<div class='communaute color_0' id='communaute_2'>
							<div class='communaute_nom color_2' id='com_2'>
								<div class='communaute_nom_name'>
									<span> Objets dispo 
										<input type='checkbox' class='check' name='checkcomm' id='checkcomm_2' value='2'/>
											<label style="margin-top: 0px; margin-right: 15px;" 
												for='checkcomm_2' class='checkcomm'></label>
									</span>
								</div>
							</div>
							<div class='communaute_check' id='communaute_check_1'>
							  
							</div>
						</div>
						<div id='communaute_menu_2' class='communaute_menu' style="height:40px">
						    <div class='blue' style='padding:5px 0px 0px 5px;'><span class='bold'>type : </span></div>
						    
						</div>
						<div class='communaute color_0' id='communaute_3'>
							<div class='communaute_nom color_3' id='com_3'>
								<div class='communaute_nom_name'>?</div>
							</div>
							<div class='communaute_check' id='communaute_check_1'>
							  
							</div>
						</div>
						<div id='communaute_menu_3' class='communaute_menu' style="height:40px">
						    <div class='blue' style='padding:5px 0px 0px 5px;'><span class='bold'>type : </span></div>
						    
						</div>
						<div class='communaute color_0' id='communaute_4'>
							<div class='communaute_nom color_4' id='com_4'>
								<div class='communaute_nom_name'>?</div>
							</div>
							<div class='communaute_check' id='communaute_check_1'>
							  
							</div>
						</div>
						<div id='communaute_menu_4' class='communaute_menu' style="height:40px">
						    <div class='blue' style='padding:5px 0px 0px 5px;'><span class='bold'>type : </span></div>
						    
						</div>
					</div>
					<?php
					/* $i++;
					$listecomm.= $unecommunity[0]->getAttr('id').',';
				}
				$listecomm = substr($listecomm,0,-1); */
			?>
		</form>
		<!-- Searching for the items is to be implemented. -->
		<div class="findcomm">
			<input style="border: hidden; width: 120px;" placeholder="rechercher un objet..." type="text" name="typeahead">
		</div>
	</div>
</div>

<div class='col-md-15' id="itemsBlock">
	<div class='col-md-18'
		style='border-radius: 10px; background-color: #f3f3f3;'>
        <?php
			$cptSearch = 1;
			$cpt;
			$tab_marker = array ();
			foreach ( $tab_art_search as $a ) {
		?>
                
			<div class='col-md-18 surligneur'
				data-surligneur='<?=$cptSearch-1;?>'
				style='border-bottom: 1px solid #d0d0d0; padding: 20px 0px; height: 150px;'>
				<div class='col-md-4' style='height: 105px; padding-left: 0px;'>
                            <?=$a[1]->print_picture(100,'round');?>
                </div>
				<div class='col-md-10' style='margin-left: -5px;'>
					<div class='bold' style="font-size: x-large;">
                        <nobr><?=$a[0]->getAttr('name');?>
						<span><?=$a[1]->getNoteMoy($a[1]->getAttr('id'));?></span></nobr> 
					</div>
					<br>
					<div class='bold' style="font-size: medium;">
						<nobr>Caution : <span class = blue><?=$a[1]->getAttr ('caution');?> € </span>&nbsp;/&nbsp;
						Category : <span class = blue><?=$a[1]->getCatName();?></span></nobr>
				    </div>
				    
				    <br>
                    <div class='bold' style="font-size: medium;">
						Description : <div class = blue><?=$a[1]->getAttr('desc');?></div>
				    </div>
					
				</div>
				<div class='col-md-4' style='padding-left: 0px; padding-right: 0px;'>
					<div style="height: 70px">
						
					</div>
					<div class='black'>
						<span style='font-size: 2.5em;'><?=$a[1]->getMutumByDay();?></span>
						<img alt='number_mutum' src='<?=WEBDIR?>/img/search_mutum_day.png'
							style='width: 30px;'> <span style='font-size: 1.1em;'>/ jour</span>
					</div>
				</div>
			</div>
		
                <?php
                array_push($tab_marker,array($a[1]->getAttr('name'))) ;
                $cptSearch ++;
                }
                ?>
                <div class='search_pagination'>
                    <?php
                    if ($max_page > 1) 
					{
						if ($p > 3 && $max_page > 5) {
							echo '<a href="?s_a_cat=' . $s_a_cat . '$s_a_name=' . $s_a_name . '&s_a_loc=' . $url_address . '&p=1"> Début </a>';
						}
						$skip = 0;
						$nb_aff = 0;
						for($i = 1; $i <= $max_page; $i ++) {
							if (($i >= $p - 2 && $i <= $p + 2) || $max_page <= 5) {
								$skip = 0;
								echo "<a style='" . ($i == $p ? "color:#00a2b0;" : "") . "' href='?s_a_cat=" . $s_a_cat . "&s_a_name=" . $s_a_name . "&s_a_loc=" . $url_address . "&p=$i'> $i </a>";
							} else {
								if ($skip == 0) {
									$skip = 1;
									print " ... ";
								}
							}
						}
						if ($p < $max_page - 2 && $max_page > 5) {
							echo '<a href="?s_a_cat=' . $s_a_cat . '$s_a_name=' . $s_a_name . '&s_a_loc=' . $url_address . '&p=' . $max_page . '"> Fin </a>';
						}
					}
					?>
                </div>
	</div>
</div>
<script type="text/javascript">
    

    $(document).ready(function() {

		$('.communaute_nom').click(function() {
			var id = $(this).prop('id').replace('com_','');
			
			if($('#communaute_'+id).hasClass('color_0'))
			{
				$('#communaute_'+id).removeClass("color_0");
				$('#communaute_'+id).addClass("color_"+parseInt(id));
				$('#communaute_menu_'+id).show();
				var j;
				for(j=0;j<5;j++)
				{
					if($('#communaute_'+j).hasClass('color_0') || j==id)
					{}
					else
					{
						$('#communaute_'+j).removeClass("color_"+parseInt(id));
						$('#communaute_'+j).addClass("color_0");
						$('#communaute_menu_'+j).hide();
					}
				}

				/* $('input.typeahead').typeahead({
			        name: 'typeahead',
			        remote:'search.php?key=%QUERY',
			        limit : 10 
			    }); */
			    
				$.ajax({
					url: '<?php echo AJAXLOAD ?>items&',
					dataType: 'json',
					data: {method: 'getShared'+id},
					type: 'POST',
					success: function(data) {
						if (data.success) {
							var html = '',
								myContainer = $('#itemsBlock'),
								cptSearch = 1,
								img_src_path = "<?=WEBDIR?>img/cat/missing.png";

							$('#communaute_menu_'+id).find('div').html('<span><span style = "font-size: 2.1em; color: blue; font-weight: bold;">' 
																			+ data.datas.count + '</span>'
																	 + '<span style = "font-size: 1.7em; color: blue;">/' 
																			+ data.datas.total + '</span></span>');
							
							myContainer.html('');
							html += '<div class = "col-md-18" style = "border-radius: 10px; background-color: #f3f3f3;">';
							
							$.each(data.datas.articles, function(k, val) {

								if(val[1].arti_pictures != ""){
									img_src_path = "<?=WEBDIR?>img/art/"+ val[1].arti_pictures;
								}
								html += '<div class="col-md-18 surligneur" data-surligneur = "'
											+(cptSearch-1)+'" style = "border-bottom: 1px solid #d0d0d0; padding: 20px 0px; height: 150px;">';
									html += '<div  class = "col-md-4" style = "height: 105px; padding-left: 0px;"><img src = "' 
												+ img_src_path +
													 '" style = "height:100px;width:100; border-bottom-left-radius: 20px;' 
													 + 'border-top-right-radius: 20px;border-top-left-radius: 20px;" class = "round">'
								 				+ '</div>';
	
									html += '<div class = "col-md-10" style = "margin-left: -5px;">';
									
						 				html += '<div class = "bold" style = "font-size: x-large;">'
							 						+ val[1].prod_name + val[1].stars
							 					+ '</div><br>';	
							 				
						 				html += '<div class = "bold" style="font-size: medium;">'
						 							+ '<nobr>Caution : <span class = blue>' + val[1].arti_caution + ' € </span>&nbsp;/&nbsp;'
						 							+ 'Category : <span class = blue>' + val[1].name + '</span></nobr>'
							 					+ '</div><br>';
							 				
						 				html += '<div class = "bold" style = "font-size: medium;">'
													+ 'Description : <div class = blue>' + val[1].prod_desc + '</div>'
							 					+ '</div>';	
	
						 			html += '</div>';

						 			html += '<div class = "col-md-4" style = "padding-left: 0px; padding-right: 0px;">'
												+ '<div style="height: 70px">'
												+ '</div>'
												+ '<div class = "black">'
													+ '<span style = "font-size: 2.5em;">' + val[1].mutumByDay + '</span>'
													+ '<img alt = "number_mutum" src = "<?=WEBDIR?>/img/search_mutum_day.png"' 
														+ 'style = "width: 30px;"> <span style = "font-size: 1.1em;">/ jour</span>'
												+ '</div>'
											+ '</div>'; 					 	
								html += '</div>';
								//myContainer.append(html);
								
							});
							html += '</div>';
							myContainer.append(html);
						}
					}
				});
			}
			else
			{
				$('#communaute_'+id).removeClass("color_"+parseInt(id));
				$('#communaute_'+id).addClass("color_0");
				$('#communaute_menu_'+id).hide();
			}
		});
		
    	function affichInfo(selecteur, id) {
            $.post("<?=AJAXLOAD?>afficheinfo", { id: id }, function (toto) {
                $(selecteur).after(toto);
            });
        }
        
        
        
       
        
        
    });
</script>


