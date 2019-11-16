<!--div id="css_Download"-->
	<div class="dis_flex">	
		<img class="css_Download_img" src="<?php echo ($CODE['GET_URL_VALUE_THUMBNAIL']==NULL)?'{{CONFIG theme_url}}/img/noimage.png':$CODE['GET_URL_VALUE_THUMBNAIL']; ?>"></img>
		<p class="css_Download_text_p"><?php echo $CODE['GET_URL_VALUE_TITLE']; ?></p>
	</div>
	<div class="div_right_wall_download">	
		<?php echo $CODE['SHARE_EXTENSION']; ?>
		<div class="box_data_videos_download">
			<div class="top_box_data_videos_download">	
				<p class="span_text_data_videos_download">{{LANG text_down_1}}</p>
				<p class="span_text_data_videos_download">{{LANG text_down_2}}</p>
				<p class="span_text_data_videos_download">{{LANG text_down_3}}</p>
				<i class="icon_download_videos_d fas fa-arrow-down"></i>
			</div>
	<!---->	
	<?php foreach ($CODE['GET_URL_PLATFORM_MEDIA'] as $indice => $Data_media) { ?>
		<?php if($Data_media['size']=='ERROR'){ ?>
			<!-- null -->
		<?php }else{ ?>
			<div class="div_data_download_videos">
				<div class="div_full_pantall">
					<div class="forma_css_download text_video_data_dentro"><?php echo $Data_media['format']; ?></div>
					<div class="text_video_data_dentro"><?php echo $Data_media['quality']; ?></div>
					<div class="text_video_data_dentro"><?php echo $Data_media['size']; ?></div>
				</div>
				<?php if (@$CODE['GET_DIRECT_DOWNLOAD'] == NULL){ ?>
					<a class="button_video_more" href="{{CONFIG site_url}}/download.php?url_video=<?php echo PHP_DatesCrypt('encrypt', $Data_media['url']); ?>&title=<?php echo $CODE['GET_URL_VALUE_TITLE']; ?>&type_format=<?php echo $Data_media['format']; ?>" download="downloadfilename"><span id="btn_mo_tel">{{LANG Download_file}}</span></a>
				<?php }else{ ?>
					<a class="button_video_more" href="<?php echo $Data_media['url']; ?>" download="downloadfilename"><span id="btn_mo_tel">{{LANG Download_file}}</span></a>
				<?php } ?>
			</div>
		<?php } ?>
			<!--?php echo $Data_media['url']; ?-->
	<?php } ?>
	<!---->		
		</div>
	</div>
<!----/div-->