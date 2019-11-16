<section id="wall_section">
	<div class="name_session_t">
		<p class="name_session_text"><?php echo $lags25; ?><br><spam class="name_session_text_spam"><?php echo $lags24; ?></spam></p>
	</div>
	<div class="div_statistics_panel">
	<form method="post" action="content_data.php?data=settings" charset="UTF-8">
		<div class="wall_class_settings">
			<p class="text_p"><?php echo $lags48; ?></p>
			<input class="class_settings_input" type="text" name="title" value="<?php echo $titule_site; ?>"/>
			<p class="text_p"><?php echo $lags26; ?></p>
			<input class="class_settings_input" type="text" name="name" value="<?php echo $name_site; ?>"/>
			<p class="text_p"><?php echo $lags27; ?></p>
			<input class="class_settings_input" type="text" name="Description" value="<?php echo $Description_site; ?>"/>
			<!---->
			<p class="text_p">facebook URL:</p>
			<input class="class_settings_input" type="text" name="data_facebook" placeholder="https://facebook.com/user" value="<?php echo $social_facebook; ?>"/>
			<!---->
			<p class="text_p">twitter URL:</p>
			<input class="class_settings_input" type="text" name="data_twitter" placeholder="https://twitter.com/user" value="<?php echo $social_twitter; ?>"/>
			<!---->
			<p class="text_p">E-mail @:</p>
			<input class="class_settings_input" type="text" name="data_mail" placeholder="mail@shareplus.com" value="<?php echo $social_mail; ?>"/>

			<p class="text_p"><?php echo $lags28; ?></p>
			<?php
			//== manual to change the language:  en/English - es/Spanish - fr/French - it/Italian - ru/Russian - tr/trick - zh/Chinese - pt/Portuguese - de/German
				echo '<select class="lags_slider_select" name="language" id="language">';
				echo '<option value="'.$Languages_web.'">'.$Languages[$Languages_web].'</option>';
				echo '<option value="english">'.$Languages['en'].'</option>';
				echo '<option value="spanish">'.$Languages['es'].'</option>';			
				echo '<option value="french">'.$Languages['fr'].'</option>';			
				echo '<option value="italian">'.$Languages['it'].'</option>';			
				echo '<option value="russian">'.$Languages['ru'].'</option>';			
				echo '<option value="turkish">'.$Languages['tr'].'</option>';			
				echo '<option value="chinese">'.$Languages['zh'].'</option>';			
				echo '<option value="portuguese">'.$Languages['pt'].'</option>';			
				echo '<option value="german">'.$Languages['de'].'</option>';			
				echo '</select>';		 
			?>
			<br>
			<p class="text_p"><?php echo $lags44; ?></p>
			<?php
			//== manual to change the language:  en/English - es/Spanish - fr/French - it/Italian - ru/Russian - tr/trick - zh/Chinese - pt/Portuguese - de/German
				echo '<select class="lags_slider_select" name="language_panel" id="language">';
				echo '<option value="'.$Languages_panel.'">'.$Languages[$Languages_panel].'</option>';
				echo '<option value="en">'.$Languages['en'].'</option>';
				echo '<option value="es">'.$Languages['es'].'</option>';						
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