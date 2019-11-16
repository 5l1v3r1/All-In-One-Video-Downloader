<?php
/*
Script for: tiktok.com
Author: Zhareiv
Date: 09-02-2019
Copyright (c) 2018 shareplus. All rights reserved.
*/
//----->
	
error_reporting(0);

	$data_url = str_replace('https://m.tiktok.com/v/', 'https://www.tiktok.com/share/video/', $url);
	$data_url = str_replace('.html', '', $data_url);
	$PHP_cUrl = PHP_SYSTEM_url_get_contents($data_url);
	/*
	preg_match_all("/var data =(.*?);/", $PHP_cUrl,$matches);
	$json = json_decode($matches[1][0],true);
	$url_video 		= $json["video"]["play_addr"]["url_list"][0];
	$url_thumbnail 	= $json["video"]["cover"]["url_list"][0];
	$quality_video 	= $json["video"]["ratio"];
	*/
 
	preg_match('/< *video[^>]*src *= *["\']?([^"\']*)/i', $PHP_cUrl, $video);	
	$url_video = $video[1];
	preg_match('/< *video[^>]*poster *= *["\']?([^"\']*)/i', $PHP_cUrl, $image);	
	$url_image = $image[1];
//Meta og: 
	$meta = PHP_Get_Tags($data_url);

//script Plugin
	$line = '<div id="css_Download">';
	$line = '<div class="dis_flex">';	
	$line.= '	<img class="css_Download_img" src="'.utf8_decode(mb_substr($url_image, 0, 400, "UTF-8")).'"></img>';
	$line.= '	<p class="css_Download_text_p">'.utf8_decode(mb_substr($meta['title'], 0, 400, "UTF-8")).'</p>';
	$line.= '</div>';
	$line.= '<div class="div_right_wall_download">';	
	$line.= ''.$CODE['SHARE_EXTENSION'].'';
	$line.= '<div class="box_data_videos_download">';
	$line.= '	<div class="top_box_data_videos_download">';	
	$line.= '		<p class="span_text_data_videos_download">'.$lang->text_down_1.'</p>';
	$line.= '		<p class="span_text_data_videos_download">'.$lang->text_down_2.'</p>';
	$line.= '		<p class="span_text_data_videos_download">'.$lang->text_down_3.'</p>';
	$line.= '		<i class="icon_download_videos_d fas fa-arrow-down"></i>';
	$line.= '	</div>';		
	$line.= '	<div class="div_data_download_videos">';
	$line.= '		<div class="div_full_pantall">';
	$line.= '		<div class="forma_css_download text_video_data_dentro">MP4</div>';
	$line.= '		<div class="text_video_data_dentro">video</div>';
	$line.= '		<div class="text_video_data_dentro">'.PHP_file_size($url_video).'</div>';
	$line.= '		</div>';
	$line.= '		<a class="button_video_more" href="'.$config['site_url'].'/download.php?url_video='.base64_encode(''.$url_video).'&title='.utf8_decode(mb_substr($meta['title'], 0, 400, "UTF-8")).'" download="downloadfilename"><span id="btn_mo_tel">'.$lang->Download_file.'</span></a>';
	$line.= '	</div>';			
	$line.= '</div>';
	$line.= '</div>';
	$line.= '</div>';
	 
$CODE_PLUGIN = $line;

?>