<?php
$load->page        = 'lang';
$load->title       = $load->config->title;
$load->content 	 = '';

if (isset($_GET['url'])) {
    $lang = PHP_Secure($_GET['lang']);
	$s = 3600000; // seconds in a year
	setcookie("_lang_shareplus", $lang, time() + $s, '/', null, null, true);
	@header("Location:../");		
}else{
	
}