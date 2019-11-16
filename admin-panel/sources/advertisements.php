<section id="wall_section">
	<div class="name_session_t">
		<p class="name_session_text"><?php echo $lags12; ?><br><spam class="name_session_text_spam"><?php echo $lags23; ?></spam></p>
	</div>
	<div class="div_statistics_panel">
	<form method="post" action="content_data.php?data=ads" charset="UTF-8">
		<div class="wall_class_settings">
			<p class="text_p"><?php echo $lags21; ?> - 728x90</p>
			<textarea  class="class_settings_textarea" name="as_one" id="as_one" cols="60" rows="10"><?php echo data_script('21','SELECT');?></textarea><br><br>
			<p class="text_p"><?php echo $lags22; ?> - 728x90</p>
			<textarea  class="class_settings_textarea" name="as_two" id="as_two" cols="60" rows="10"><?php echo data_script('22','SELECT');?></textarea><br><br>
			<br> 
			<br> 
			<br> 
			<center>
				<input class="button_admin_more" type="submit" value="<?php echo $lags5; ?>"/> 
			</center>
		</div>
	</form>	
	</div>
</section>