<?php 
require ("ConectarDtata.php");
require_once ("languages/$Languages_panel.php");
	if (@$_COOKIE["auser"]!='') {

		
		$s = $_POST['search'];
		$sql = mysqli_query($con,"Select * From user_data WHERE username LIKE '%$s%' ORDER BY userID DESC LIMIT 10");
		echo '<p class="text_plugin_p">'.$lags60.'</p>';
		if (mysqli_num_rows($sql) == 0){
			$line = '<div class="without_complements">
									
									<p class="w_c_text_p">'.$lags61.'</p>
								</div>
						
						';
						echo $line;
			
		}else{
			while($data = mysqli_fetch_array($sql)) {
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
	}else{
		require ("sources/login.php");	
	}					