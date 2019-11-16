<?php
$load->page        = 'share';

 if (isset($_GET['url'])) {
	 	$id_url 			= PHP_Secure($_GET['share']);
	 	@$ref_social 		= PHP_Secure($_GET['social']);
		$data_url 			= PHP_data_ShareUrl('url',$id_url,$ref_social);
	if($data_url == null){
		//-- 404
	}else{		
		$og_meta			= PHP_Get_Tags($data_url);
		$CODE['OG_TAG_TITLE']		=  utf8_decode(mb_substr($og_meta['title'], 0, 400, "UTF-8"));
		@$CODE['OG_TAG_IMAGE']		= ($og_meta['image'] == null) ? $config['theme_url'].'/img/logo.png' : $og_meta['image'];
		@$load->title       = utf8_decode(mb_substr($og_meta['title'], 0, 60, "UTF-8")).' | '.utf8_decode(mb_substr($load->title, 0, 400, "UTF-8"));
		$load->content = PHP_LoadPage('template/home', array(
		@$CODE['ACTIVE_SHARE'] = ($_GET['s']) ? 'off' : 'ok',
		$CODE['SHARE_EXTENSION'] = PHP_LoadPage('template/share_url', array(
										'DATA_URL' => $config['site_url'].'/s/'.$id_url,	
									)),
		@$CODE['share_data'] = PHP_Url('youtube',$data_url,'return', false),
		$CODE['URL_OG'] = @$data_og_meta,
		'CONTAINER_URL_HOME' => $site_url,
		'ICONS_MEDIA' => PHP_LoadPage('template/icons_media',array(
			$CODE['GET_TRENDING_FUNCTION'] 		= PHP_GetMedia(8),
			$CODE['GET_TRENDING_NO_CONTENT'] 	= $PHP_Error->_404,
		)),	
	));	
	}	
}else{
	header("Location:../");
		exit();
}
 
