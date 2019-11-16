<section id="wall_section">
	<div class="name_session_t">
		<p class="name_session_text"><?php echo $lags62; ?><br><span class="name_session_text_spam"><?php echo $lags65; ?></span></p>
	</div>
	<!---->
	<div class="div_statistics_panel">
		<div class="wall_report">
			<div class="wall_report_2 wall_class_actions">
			<!---->
				<!-- action -->
				<!--p class="text_plugin_p"><?php echo $lags49; ?></p-->
				
				<!--HTML-->
				<?php
					$sqli = mysqli_query($con,"Select * From platform_media limit 100");
					if (mysqli_num_rows($sqli) == 0){
							$line = '<div class="without_complements">
										<img class="w_c_img" src="./assets/image/blueprint.png"></img>
										<p class="w_c_text_p">'.$lags50.'</p>
									</div>
							
							';
							echo $line;
					}else{						
						while($data = mysqli_fetch_array($sqli)){
							$line = '<div class="linl_re background_wall_don">
										<div class="class_actions_display">
											<img class="wall_div_statistics_panel_img" src="'.$data["icon"].'"></img>
											<p class="text_action">
												<span class="text_r_link_r plugin_lits_name">'.PHP_count_r($data["platform"]).'</span>
									';
									if ($data["active"] == '1'){		
							$line.= '			<span class="plugin_lits_version"><i class="plugin_lits_icon fas fa-check"></i> '.$lags52.'</span>';
									}else{
							$line.= '			<span class="plugin_lits_version"><i class="plugin_lits_icon fas fa-times"></i> '.$lags51.'</span>';
									}
							$line.= '		</p>
											<div class="action_plugis_div">
											<div class="lis_class_system">
											 ';
									 
												
										$line.= '<div id="'.$data["userID"].'" class="check_link btn_aha_link div_media_yes" data-id="'.$data["platform"].'">
														<span>'.$lags63.'</span>
												</div>
												
												';
									
										$line.=	' 
												</div>
												<p class="action_plugis_div_p"></p>
													</div>
												</div>	
											</div>';
							echo $line;		
									
						}
						
					}
				?>	 
				<br>
				<br>
			</div>
			<div id="more_data">
				<div class="more_data_po">
				<img class="more_data_po_img" src="./assets/image/Ready_Web.png"></img>
				<p class="more_data_po_text"><?php echo $lags64; ?></p>
				</div>
			</div>
		</div>		
	</div>
</section>
<script type="text/javascript">
 
	//report link	
         $('.check_link').on('click', function(){
            var data_id = $(this).data('id');
            $.ajax({
                url: 'report.php',
                type: 'POST',
                data: {report: data_id},
                success: function(data){
                    $("#more_data").html(data);//$('#more-info').html(data.html);
                }
            });
        });
</script>		