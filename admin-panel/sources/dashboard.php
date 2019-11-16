<section id="wall_section">
	<div class="name_session_t">
		<p class="name_session_text"><?php echo $lags7; ?><br><spam class="name_session_text_spam"><?php echo $lags8; ?></spam></p>
	</div>
	<div class="div_statistics_panel">
		<!-- wall statistics -->
		<!--div class="div_statistics_panel_top">
			<div class="wall_div_statistics_panel">
				<div class="wall_div_statistics_panel_flex">
					<p class="wall_div_statistics_panel_p">2013K<br><spam class="wall_div_statistics_panel_spam">users</spam></p>
					<img class="wall_div_statistics_panel_img" src="./assets/img/vimeo.png"></img>
				</div>
				<div class="div_info_statistics">
					<p class="div_info_statistics_text_p">viwn</p>
				</div>
			</div>		
		</div-->
		<!-- charts-->
		<div id="wall_charts_div">
			<div class="class_chart">
			<?php require ("sources/Graphics_Visits.php"); ?>
			</div>
			<div class="class_weather">
			<?php require ("sources/flag.php"); ?>
			</div>
		</div>
		<?php require ("sources/Browser_device.php"); ?>
	</div>
</section>