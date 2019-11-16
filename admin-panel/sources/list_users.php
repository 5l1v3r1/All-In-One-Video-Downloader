<section id="wall_section">
	<div class="name_session_t">
		<p class="name_session_text"><?php echo $lags50; ?><br><span class="name_session_text_spam"><?php echo $lags49; ?></span></p>
	</div>
	<!---->
	<div class="div_statistics_panel">
		<div class="wall_class_actions">
		<!---->
			<div id="plugin_input_upload">
				<p class="text_plugin_p_up"><?php echo $lags58; ?></p>
			   <form id="liveSearch" method="POST">
			
					<div id="div_upload_plugins">
						<input id="file_plugin" class="class_search_user" type="text" name="search" placeholder="<?php echo $lags58; ?>"/>
						<input id="btn_upload_plugins" type="submit" value="<?php echo $lags59; ?>" name="filter"/>
					</div>
				</form>
			</div>
			<div id="resultados"></div>
			<!-- action -->
		<p class="text_plugin_p"><?php echo $lags49; ?></p>
			
			<!--HTML-->
			<?php
				$sqli = mysqli_query($con,"Select * From user_data limit 50");
				if (mysqli_num_rows($sqli) == 0){
						$line = '<div class="without_complements">
									<img class="w_c_img" src="./assets/image/blueprint.png"></img>
									<p class="w_c_text_p">'.$lags50.'</p>
								</div>
						
						';
						echo $line;
				}else{						
					while($data = mysqli_fetch_array($sqli)){
						$line = '<div class="background_wall_don">
									<div class="class_actions_display">
										<img class="wall_div_statistics_panel_img" src="./assets/image/i_web_1.png"></img>
										<p class="text_action">
											<span class="plugin_lits_name">'.$data["username"].'</span>
											<span class="plugin_lits_data"><i class="plugin_lits_icon far  fa-clock"></i> '.$lags53.' | '.time_elapsed($data["time"]).'</span>';
								if ($data["active"] == '1'){		
						$line.= '			<span class="plugin_lits_version"><i class="plugin_lits_icon fas fa-check"></i> '.$lags52.'</span>';
								}else{
						$line.= '			<span class="plugin_lits_version"><i class="plugin_lits_icon fas fa-times"></i> '.$lags51.'</span>';
								}
						$line.= '		</p>
										<div class="action_plugis_div">
										<div class="lis_class_system">
										 ';
								 
											
									$line.= '<div id="'.$data["userID"].'" class="div_media_yes">
												<a href="?action=user&id='.$data["userID"].'" class="" id='.$data["userID"].'>
													<span>'.$lags54.'</span>
												</a>
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
	</div>
</section>
		<script>
		/*$('.text_topbar_span').on('click', function(){
		   $('.onclick-menu-content').css('display','block');
		})
		*/
		
			function close_share() {
				$("#resultados").hide();
				$("#resultados_url").hide();
				$(".class_back_search_btn").hide();
				$("#ads_one_home").hide();
				$("#liveSearch").show();
				$('#loader_btn_no').show();
				$('#loader_btn').hide();
			}
		// search of index
			$(document).ready(function () {
			  
				$('body').on('submit', '#liveSearch', function (e) {


					e.preventDefault();

					var DataString = new FormData($(this)[0]);
					var search = $("#search").val();
				  
					if (search == "") {

						$("#searcherror").html('<div class="error_div_data"><p class="error_div_data_p">{{LANG Error_1}}<br><span class="error_div_data_span">{{LANG Error_2}}</span></p></div>');
						$("#content_video").show();
						$("#resultados").hide();
					
					} else {

						$('#loader_btn_no').hide();
						$('#loader_btn').show();
						$("#searcherror").html("");
						$.ajax({
							url: 'search.php',
							// url: 'lib/module/search_MYSQL.php', only for mysql or mysqlite connection
							type: 'POST',
							data: DataString,
							cache: false,
							contentType: false,
							processData: false,
							beforeSend: function () {

								$('#searcbtn').attr('disabled', 'disabled');
							},
							success: function (data) {

								$("#content_video").hide();
								$("#resultados").html(data).show();
								$(".class_back_search_btn").show();
								$("#ads_one_home").show();
								
								$('#searcbtn').removeAttr('disabled', 'disabled');
							},
							error: function(){
							   $("#searcherror").html('<center><br><br><img src="./assets/img/wifi_off.png"/><br><br></center>');
							   $("#resultados").hide();
							   $("#ads_one_home").hide();
						 
							}
						});
					}

				});
			   
			});
		</script>