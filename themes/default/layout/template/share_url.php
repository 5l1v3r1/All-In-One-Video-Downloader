<?php
	if (@$CODE['ACTIVE_DATA_MODAL_OG']){
		$meta = PHP_Get_Tags($CODE['DATA_UTL_OG_META']);
?>
	<div id="content_load_metas_div_modal">
		<img class="css_Download_img" src="<?php echo $meta['image'] ?>"></img>
		<p class="css_Download_text_p"><?php echo utf8_decode(mb_substr($meta['title'], 0, 400, "UTF-8")) ?></p>
	</div>
<?php
	}
?>
<div id="div_share_css">
	<a class="a_class_share_css" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{DATA_URL}}?social=facebook">
		<div class="class_facebook_share class_share_css">
			<p class="text_share_p"><i class="icon_share_url_video fab fa-facebook-f"></i><span class="dis_none_share">Facebook</span></p>
		</div>
	</a><!---->
	<a class="a_class_share_css" target="_blank" href="https://twitter.com/home?status={{DATA_URL}}?social=twitter">
		<div class="class_twitter_share class_share_css">
			<p class="text_share_p"><i class="icon_share_url_video fab fa-twitter"></i><span class="dis_none_share">Twitter</span></p>
		</div>
	</a><!---->
	<a class="a_class_share_css" target="_blank" href="whatsapp://send?text={{DATA_URL}}?social=whatsapp">
		<div class="class_whatsapp_share class_share_css">
			<p class="text_share_p"><i class="icon_share_url_video fab fa-whatsapp"></i><span class="dis_none_share">Whatsapp</span></p>
		</div>
	</a><!---->
</div>
<?php
	if (@$CODE['ACTIVE_DATA_MODAL']){
?>
<div>
	<!---->
	<span class="text_share_span_data_class">{{LANG url_share}}</span>
	<div class="div_modal_share_copy">
		<p id="copy_url_data" class="text_imput_p_share">{{DATA_URL_SHARE}}</p>
		<a class="btn_copy_class" onclick="copy('copy_url_data')">{{LANG copy}}</a>
	</div>	
	<!---->
	<span class="text_share_span_data_class">{{LANG original_url}}</span>
	<div class="div_modal_share_copy">
		<p id="copy_url_data_origial" class="text_imput_p_share">{{DATA_URL_ORIGINAL}}</p>
		<a class="btn_copy_class" onclick="copy('copy_url_data_origial')">{{LANG copy}}</a>
	</div>	
	<!--p id="copy_yes"><i class="fas fa-check"></i></p-->
	<div>
		<span id="te_span_vi_modal">{{LANG source_views}}</span>
		<br>
		<div class="con_div_vi_modal">
			<i class="size_icons_modal icon_red_i_facebook fab fa-facebook-square"></i>
			<span class="nun_views">{{INFO_VIEWS_ALL_FACEBOOK}}</span>
		</div>
		<div class="con_div_vi_modal">
			<i class="size_icons_modal icon_red_i_twitter fab fa-twitter-square"></i>
			<span class="nun_views">{{INFO_VIEWS_ALL_TWITTER}}</span>
		</div>
		<div class="con_div_vi_modal">
			<i class="size_icons_modal icon_red_i_whatsapp fab fa-whatsapp-square"></i>
			<span class="nun_views">{{INFO_VIEWS_ALL_WHATSAPP}}</span>
		</div>
		<div class="con_div_vi_modal">
			<i class="size_icons_modal icon_red_i_other fas fa-question-circle"></i>
			<span class="nun_views">{{INFO_VIEWS_ALL_OTHER}}</span>
		</div>
		<!--
		<i class="size_icons_modal icon_red_i_viewr fas fa-eye"></i>
		{{INFO_VIEWS_ALL}}
		-->
	</div>
</div>
<?php
	}
?>	