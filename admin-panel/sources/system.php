<?php

				$cURL = true;
				$php = true;
				$gd = true;
				$disabled = false;
				$mysqli = true;
				$is_writable = true;
				$mbstring = true;
				$is_htaccess = true;
				$is_mod_rewrite = true;
				$is_sql = true;
				$zip = true;
				$allow_url_fopen = true;
				$exif_read_data = true;
				if (!function_exists('curl_init')) {
				$cURL = false;
				$disabled = true;
				}
				if (!function_exists('mysqli_connect')) {
				$mysqli = false;
				$disabled = true;
				}
				if (!extension_loaded('mbstring')) {
				$mbstring = false;
				$disabled = true;
				}
				if (!extension_loaded('gd') && !function_exists('gd_info')) {
				$gd = false;
				$disabled = true;
				}
				if (!version_compare(PHP_VERSION, '5.5.0', '>=')) {
				$php = false;
				$disabled = true;
				}
				if (!is_writable('config.php')) {
				$is_writable = false;
				$disabled = true;
				}
				if (!file_exists('.htaccess')) {
				$is_htaccess = false;
				$disabled = true;
				}
				if (!file_exists('mysql.sql')) {
				$is_sql = false;
				$disabled = true;
				}
				if (!extension_loaded('zip')) {
				$zip = false;
				$disabled = true;
				}
				if(!ini_get('allow_url_fopen') ) {
				$allow_url_fopen = false;
				$disabled = true;
				}

?>
<section id="wall_section">
	<div class="name_session_t">
		<p class="name_session_text"><?php echo $lags2; ?><br><spam class="name_session_text_spam"><?php echo $lags6; ?></spam></p>
	</div>
	<div class="div_statistics_panel">
		<div class="class_system">
			<div class="wall_class_system_one">
			<form method="post" action="content_data.php?data=system" charset="UTF-8">
				<div class="lis_class_system">
					<label class="switch">
					<?php
						echo '<select class="slider_select" name="error" id="error">';
						if ($error){
							echo '
							<option value="1">'.$lags17.'</option>
							<option value="0">'.$lags18.'</option>';
						}else{
							echo '
							<option value="0">'.$lags18.'</option>
							<option value="1">'.$lags17.'</option>';
						}
						echo '</select>'; 
					?>
					</label>
					<p class="lis_class_system_one_p"><?php echo $lags1; ?></p>
				</div>
				<div class="lis_class_system">
					<label class="switch">
					<?php
						echo '<select class="slider_select" name="cookies" id="cookies">';
						if ($cookies){
							echo '
							<option value="1">'.$lags17.'</option>
							<option value="0">'.$lags18.'</option>';
						}else{
							echo '
							<option value="0">'.$lags18.'</option>
							<option value="1">'.$lags17.'</option>';
						}
						echo '</select>'; 
					?>
					</label>
					<p class="lis_class_system_one_p"><?php echo $lags4; ?></p>
				</div>
				<!--div class="lis_class_system">
					<label class="switch">
					  <input type="checkbox" >
					  <span class="slider"></span>
					</label>
					<p class="lis_class_system_one_p">apagar sitio?</p>
				</div>
				<div class="lis_class_system">
					<label class="switch">
					  <input type="checkbox" checked>
					  <span class="slider"></span>
					</label>
					<p class="lis_class_system_one_p">apagar sitio?</p>
				</div>	
				<div class="lis_class_system">
					<label class="switch">
					  <input type="checkbox" checked>
					  <span class="slider"></span>
					</label>
					<p class="lis_class_system_one_p">apagar sitio?</p>
				</div>
				<div class="lis_class_system">
					<label class="switch">
					  <input type="checkbox" >
					  <span class="slider"></span>
					</label>
					<p class="lis_class_system_one_p">apagar sitio?</p>
				</div-->

				<br>
				<center>
					<input class="button_admin_more" type="submit" value="<?php echo $lags5; ?>"/> 
				</center>
			</form>	
			</div>
			<div class="wall_class_system_two">
				<p class="text_p_system"><?php echo ($is_writable == true) ? '<spam class="system_ac_yes">yes</spam>' : '<spam class="system_ac_not">not</spam>'?>Required PHP version 5.5 or more</p>
				<!--p class="text_p_system"><?php echo ($is_htaccess == true) ? '<spam class="system_ac_yes">yes</spam>' : '<spam class="system_ac_not">not</spam>'?>Required .htaccess file for script security </p-->
				<p class="text_p_system"><?php echo ($cURL == true) ? '<spam class="system_ac_yes">yes</spam>' : '<spam class="system_ac_not">not</spam>'?>Required cURL PHP extension</p>
				<p class="text_p_system"><?php echo ($zip == true) ? '<spam class="system_ac_yes">yes</spam>' : '<spam class="system_ac_not">not</spam>'?>Required ZIP extension for backuping data</p>
				<p class="text_p_system"><?php echo ($allow_url_fopen == true) ? '<spam class="system_ac_yes">yes</spam>' : '<spam class="system_ac_not">not</spam>'?>Required allow_url_fopen</p>
				<p class="text_p_system"><?php echo ($mysqli == true) ? '<spam class="system_ac_yes">yes</spam>' : '<spam class="system_ac_not">not</spam>'?>Required MySQLi PHP extension</p>
			</div>
		</div>
	</div>
</section>