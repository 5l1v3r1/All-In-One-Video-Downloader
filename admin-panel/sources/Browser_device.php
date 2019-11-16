<?php
				echo '<div class="Browser_device">';


////** device					
					echo '	<div class="div_device">';
		$pedir = mysqli_query($con,"Select * From admin_device_graphics ORDER BY Access DESC LIMIT 15");
	while($device = mysqli_fetch_array($pedir)){			
					echo '		<div class="div_Browser_device">';
					echo '		<img class="img_Browser_device" src="assets/img/icons/img/'.strtolower($device['Device']).'.png" alt=""></img>';
					echo '		<p class="p_Browser_device"><spam class="text_nn">'.$device['Device'].'</spam><spam class="spam_Browser_device">'.$device['Access'].'</spam></p>';					
					echo '		</div>';
	}				
					echo '	</div>';
////** browser		
					echo '	<div class="div_Browser">';
		$pedir = mysqli_query($con,"Select * From admin_browser_graphics ORDER BY Access DESC LIMIT 15");
	while($Browser = mysqli_fetch_array($pedir)){					
					echo '		<div class="div_Browser_device">';
					echo '		<img class="img_Browser_device" src="./assets/img/icons/img/'.strtolower($Browser['Browser']).'.png" alt=""></img>';
					echo '		<p class="p_Browser_device"><spam class="text_nn">'.$Browser['Browser'].'</spam><spam class="spam_Browser_device">'.$Browser['Access'].'</spam></p>';					
					echo '		</div>';
	}				
					echo '	</div>';
										
				echo '</div>';
?>					