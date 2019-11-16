<?php
$load->page        = 'home';
$load->title       = $load->config->title;



@$url_true 	= PHP_Secure($_GET['media']);
@$strip_tags = array("-video-downloader", "-music-downloader", "-audio-downloader");	
@$data 		= str_replace($strip_tags, '', $url_true);

if (empty($_GET['media'])) {
	@$DATA_MEDIA = '';
}else{
	if (PHP_URL_MEDIA_DATA($data) == TRUE){
		if ($url_true==NULL){
			@$DATA_MEDIA.= $url_true;
		}else{
			@$DATA_MEDIA.= 'ok';
		}
	}else{
		header("Location:../");
		exit();
	}	
}


$load->content = PHP_LoadPage('template/home', array(
    'ICONS_MEDIA' => PHP_LoadPage('template/icons_media',array(
		$CODE['GET_TRENDING_FUNCTION'] 		= PHP_GetMedia(24),
		$CODE['GET_TRENDING_NO_CONTENT'] 	= '404',
		$CODE['ACTIVE_MEDIA'] 	= $DATA_MEDIA,
		$CODE['ACTIVE_MEDIA_NAME'] 	= $data,
	)),	
));
