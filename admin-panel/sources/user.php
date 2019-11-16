<?php
	$id_user = $_GET['id'];

	$query = "SELECT * from user_data WHERE userID = '$id_user'";
	$sql_query = mysqli_query($con,$query) or die ("error en la consulta". mysqli_connect_error()) ;
	$data = mysqli_fetch_array($sql_query, MYSQLI_ASSOC);

if ($data > 0){
?>
<section id="wall_section">
	<div class="name_session_t">
		<p class="name_session_text"><?php echo $lags54; ?><br><spam class="name_session_text_spam"><?php echo $lags55; ?></spam></p>
	</div>
	<div class="div_statistics_panel">
	<form method="post" action="content_data.php?data=user_e" charset="UTF-8">
	<input type="hidden" name="true_user" value="<?php echo $id_user; ?>"></input>
		<div class="wall_class_settings">
			<p class="text_p"><?php echo $lags57; ?></p>
			<input class="class_settings_input" type="text" name="name_user" value="<?php echo $data['username']; ?>"/>
			<p class="text_p">IP</p>
			<input class="class_settings_input" type="text" name="ip_user" value="<?php echo $data['ip_user']; ?>"/>
			<!---->
			<p class="text_p">E-mail @:</p>
			<input class="class_settings_input" type="text" name="data_mail" placeholder="mail@------.com" value="<?php echo $data['email']; ?>"/>

			<p class="text_p"><?php echo $lags56; ?></p>
			<?php
			//== manual to change the language:  en/English - es/Spanish - fr/French - it/Italian - ru/Russian - tr/trick - zh/Chinese - pt/Portuguese - de/German
				echo '<select class="lags_slider_select" name="user_locked" id="language">';
				
				if ($data['locked'] == 1){
					echo '<option value="1">'.$lags51.'</option>';
					echo '<option value="0">'.$lags52.'</option>';						
				}else{		
					echo '<option value="0">'.$lags52.'</option>';
					echo '<option value="1">'.$lags51.'</option>';					
				}
				echo '</select>';
			?>
			<br>
			
			<!--p class="text_p">imagen logo</p>
			<img src="./assets/img/vimeo.png"></img-->
			<br>
			<center>
				<input class="button_admin_more" type="submit" value="<?php echo $lags5; ?>"/> 
			</center>
			<br>
			<br>
		</div>
	</form>	
	</div>
</section>
<?php 
}else{
	@header("Location:./");
	exit('<meta http-equiv="Refresh" content="0;url=./">');
	echo 'error';
}
?>