<div class="div_modal_stories">
	<!---->	
	<div class="thumbnail_img_stories">
		<img class="img_stories_url_size" src="<?php echo $og_meta['image']; ?>"></img>
	</div>
	<!---->	
	<p class="text_p_modal_stories">
		<a class="a_class_share_css" target="_blank" href="<?php echo $config['site_url']; ?>/s/<?php echo $data_share; ?>">
			<span class="text_span_modal_stories"><?php echo $og_meta['title']; ?></span>
		</a>
		<!---->		
		<span class="span_icons_modal">
			<!---->	
			<span class="loader_url_modal_no_<?php echo $postID; ?> btn_loader_url_no btn_Download_file_modal click_load_url" data-id="<?php echo $postID; ?>"><i class="fas fa-cloud-download-alt"></i> <?php echo $lang->Download_file; ?></span>
			<span class="loader_url_modal_<?php echo $postID; ?> btn_loader_url btn_Download_file_modal click_load_url" data-id="<?php echo $postID; ?>"><i class="fa fa-spinner fa-spin"></i></span>
			<span class="menu_left_modal">
			<span class="icon_left_menu_modal">
				<span class="loader_data_share_no_<?php echo $postID; ?> btn_loader_data_share_no click_load_share" data-id="<?php echo $postID; ?>"><i class="fas fa-share"></i> <?php echo $lang->share; ?></span>
				<span class="loader_data_share_<?php echo $postID; ?> btn_loader_data_share click_load_share" data-id="<?php echo $postID; ?>"><i class="fa fa-spinner fa-spin"></i></span>
			</span>
			<!--i class="icon_left_menu_modal fas fa-chart-line"></i-->
		<span>
		</span>
	</p>
</div>

<script>	
    $('.click_load_url').on('click', function(){
		var data_id = $(this).data('id');
		$('.loader_url_modal_no_'+data_id).hide();
		$('.loader_url_modal_'+data_id).show();
		
		$.ajax({
			url: Ajax_Requests_File(),
            type: 'POST',
            data: 'download_file_modal='+data_id,
            success: function(data){
                $("#CONTENT_DOWNLOAD_MODAL").html(data);//$('#more-info').html(data.html);
				$('.div_modal_stories').hide();
				$(".show_more").hide();
				$("#CONTENT_DOWNLOAD_MODAL").show();
				$("#close_load_modal").show();
				$('.loader_url_modal_'+data_id).show();
			},
			error: function(jqXHR, textStatus, errorThrown){
				$('#CONTENT_DOWNLOAD_MODAL').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                     
			}
		});
    });
//--	
	$('.click_load_share').on('click', function(){
		var data_id = $(this).data('id');
		$('.loader_data_share_no_'+data_id).hide();
		$('.loader_data_share_'+data_id).show();
		
		$.ajax({
			url: Ajax_Requests_File(),
            type: 'POST',
            data: 'share_modal='+data_id,
            success: function(data){
                $("#CONTENT_SHARE_MODAL").html(data);//$('#more-info').html(data.html);
				$('.div_modal_stories').hide();
				$(".show_more").hide();
				$("#CONTENT_SHARE_MODAL").show();
				$("#close_load_modal").show();
				$('.loader_data_share_'+data_id).show();
			},
			error: function(jqXHR, textStatus, errorThrown){
				$('#CONTENT_SHARE_MODAL').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                     
			}
		});
    });
</script>