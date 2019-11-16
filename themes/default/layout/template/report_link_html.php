<?php if($CODE['ERROR_MESSAGE_LINKS'] == 'Error_data_url'){ ?>
	<div class="error_data_url">
		<img class="no_media_url_plugin_img" src="{{CONFIG theme_url}}/img/i_web_2.png"></img>
		<br>
		<span id="no_media_url_plugin">{{LANG not_service_media}}</span>
	</div>
<?php }else if($CODE['ERROR_MESSAGE_LINKS'] == 'Report_link'){ ?>
	<div class="report_link_html">
		<div id="report_link_html">
			<div class="div_bom_report_link_html">
				<img class="no_media_url_plugin_img" src="{{CONFIG theme_url}}/img/i_web_2.png"></img>
			</div>	
			<p class="text_report_link_html">{{LANG report_link_1}}
			<span class="pal_report_url_data">{{LANG report_link_2}}</span>
			<span class="pal_report_url_data">{{LANG report_link_3}} <span class="Error_name_media_link">{{REPORT_PLATFORM_DATA}}</span></span>
			<a class="tex_cer_link_report" target="_blank" href="{{REPORT_URL_DATA}}">
				<p class="report_url_data">{{REPORT_URL_DATA}}</p>
			</a>
			</p>
			<p class="text_report_link_html_2">
				<span>{{LANG report_link_4}}</span>
			</p>
			<br>
			<div class="div_bom_report_link_html">
				<a class="btn_text_report_link_html button_video_more click_report_link" data-url="{{REPORT_URL_DATA}}" data-media="{{REPORT_PLATFORM_DATA}}" href="#">{{LANG report_link_5}}</a>
			</div>
		</div>
		<p id="report_platform_data" class="text_re_cer text_report_link_html"></p>
	</div>
<?php } ?>


<script>
//-->	report_link
	$('.click_report_link').on('click', function(){
		var data_url  	= $(this).data('url');
		var data_media 	= $(this).data('media');
		$.ajax({
			url: Ajax_Requests_File(),
            type: 'POST',
            data: 'report_link='+data_url+'&name_media='+data_media,
            success: function(data){
				$("#report_platform_data").html(data);
				$("#report_link_html").hide();
				$("#close_load_modal").show();		
			}
		});
    });
</script>