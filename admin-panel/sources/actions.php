<section id="wall_section">
	<div class="name_session_t">
		<p class="name_session_text"><?php echo $lags19; ?><br><spam class="name_session_text_spam"><?php echo $lags20; ?></spam></p>
	</div>
	<!---->
	<div class="div_statistics_panel">
		<div class="wall_class_actions">
		<!---->
			<div id="plugin_input_upload">
				<p class="text_plugin_p_up"><?php echo $lags37; ?></p>
			   <form id="imageform" action="?action=upload" method="post" enctype="multipart/form-data" name="form-example">
					<input type="hidden" name="sended" value="true"></input>
					<div id="div_upload_plugins">
						<input type="file" name="file_plugin" id="file_plugin"/>
						<input id="btn_upload_plugins" type="submit" value="<?php echo $lags38; ?>" name="submit"/>
					</div>
				</form>
			</div>
			<!-- action -->
		<p class="text_plugin_p"><?php echo $lags36; ?></p>
		
			<!--HTML-->
			<?php
			
				$sqli = mysqli_query($con,"Select * From platform_media");
				if (mysqli_num_rows($sqli) == 0){
						$line = '<div class="without_complements">
									<img class="w_c_img" src="./assets/image/blueprint.png"></img>
									<p class="w_c_text_p">'.$lags39.'</p>
								</div>
						
						';
						echo $line;
				}else{						
					while($data = mysqli_fetch_array($sqli)){
						$line = '<div class="background_wall_don">
									<div class="class_actions_display">
										<img class="wall_div_statistics_panel_img" src="'.$data["icon"].'"></img>
										<p class="text_action">
											<span class="plugin_lits_name">'.$data["platform"].'</span>
											<span class="plugin_lits_data"><i class="plugin_lits_icon far fa-calendar-alt"></i> '.$data["Data_Update"].'</span>
											<span class="plugin_lits_version"><i class="plugin_lits_icon fas fa-plug"></i> '.$data["version"].'</span>
										</p>
										<div class="action_plugis_div">
										<div class="lis_class_system">
										 ';
								if ($data["active"]==0){
											
									$line.= '<div id="media_yes'.$data["id"].'" class="div_media_yes">
												<a href="#" class="media_yes" id='.$data["id"].'>
													<span>'.$lags18.'</span>
												</a>
											</div>
											
											<div id="media_no'.$data["id"].'" style="display:none" class="div_media_no">
												<a href="#" class="media_no" id='.$data["id"].'>
													<span>'.$lags17.'</span>
												</a>
											</div>';
								}else{				
									$line.= '<div id="media_yes'.$data["id"].'" style="display:none" class="div_media_yes">
												<a href="#" class="media_yes" id='.$data["id"].'>
													<span>'.$lags18.'</span>
												</a>
											</div>
											
											<div id="media_no'.$data["id"].'" class="div_media_no">
												<a href="#" class="media_no" id='.$data["id"].'>
													<span>'.$lags17.'</span>
												</a>
											</div>';
								}	
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
	</div>
</section>
