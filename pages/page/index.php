<?php
$load->page        = 'page';

 if (isset($_GET['url'])) {
    @$page = PHP_Secure($_GET['page']);
	
	if($page == 'privacy'){
		$load->title       = $lang->Privacy_Policy .' | '. $load->config->title;
		$load->content = PHP_LoadPage('template/pages', array(
			'ICONS_MEDIA' => '',
			'DATA_PAGES' => $lang->Privacy_Policy,
			'INFO_PAGES' => br2nl($load->config->privacy_policy),
		));
	} else if ($page == 'useterms') {
		$load->title       = $lang->Terms_of_Use .' | '. $load->config->title;
		$load->content = PHP_LoadPage('template/pages', array(
			'ICONS_MEDIA' => '',
			'DATA_PAGES' => $lang->Terms_of_Use,
			'INFO_PAGES' => br2nl($load->config->terms_of_use),
			));		
	} else if ($page == 'all_media') {
		$load->title       = $lang->site_Supported_page .' | '. $load->config->title;
		$load->content = PHP_LoadPage('template/pages', array(
			'ICONS_MEDIA' => PHP_LoadPage('template/icons_media',array(
				$CODE['GET_TRENDING_FUNCTION'] 		= PHP_GetMedia(''),
				$CODE['GET_TRENDING_NO_CONTENT'] 	= '404',
			)),
			'DATA_PAGES' => $lang->site_Supported_page,
			'INFO_PAGES' => '',	
		));
		
	}else if ($page == 'help'){
		$load->title       = $lang->help_page .' | '. $load->config->title;
		$load->content = PHP_LoadPage('template/pages', array(
			'ICONS_MEDIA' => '',
			'DATA_PAGES' => $lang->help_page,
			'INFO_PAGES' => br2nl($load->config->help),
		));		
	}else{
		header("Location:../");
		exit();	
	}
	
	 
}else{
	header("Location:../");
		exit();
}
 
