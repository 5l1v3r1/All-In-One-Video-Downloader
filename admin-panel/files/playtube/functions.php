<?php
/*
Script for: playtubescript.com
Author: Zhareiv
Update date: 18-06-2019
Copyright (c) 2018 shareplus. All rights reserved.
*/

	$html = PHP_SYSTEM_url_get_contents($url);
	$video_url = get_url_playtube($html); 
	if(preg_match("/youtube.com(.+)v=([^&]+)/", $video_url)){ //--> Extension of YouTube 
		//--> YouTube
		$url = $video_url;
		include($plugins_dir . "/youtube/functions.php");
		//--> end
	} else if(preg_match("/vimeo.com\/([^&]+)/", $video_url)){ //--> Extension of Vimeo
		//--> vimeo
		$url = $video_url;
		include($plugins_dir . "/vimeo/functions.php");
		//--> end
	} else if(preg_match("/dailymotion.com(.+)([^&]+)/", $video_url)){ //--> Extension of Dailymotion 	
		$url = $video_url;
		include($plugins_dir . "/dailymotion/functions.php");
	} else {

		function Data_media_Json($url){
			
			$data = array();
			
			$curl_content = PHP_SYSTEM_url_get_contents($url);
			$strip_tags = array("type=\"video/mp4", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "=", "+", "[", "{", "]",
				"}", "\\", "|", ";", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
				"â€”", "â€“", ",", "<", ">", "?");	
			if (preg_match_all('/src="(.*?)" data-quality="(4k|2k|1080p|720p|480p|360p|240p)"/', $curl_content, $matches)) {
				$data["title"] 		= Data_title($curl_content);
				$data['thumbnail'] 	= Data_thumbnail($curl_content);
				$data["source"] 	= 'PlayTube';
				$i = 0;
				foreach ($matches[1] as $match) {
					$data["data"][$i]["url"] 		= trim(str_replace($strip_tags,'', $match));
					$data["data"][$i]["format"]		= "mp4";					
					$data["data"][$i]["quality"] 	= $matches[2][$i];
					$data["data"][$i]["size"] 		= PHP_file_size($data["data"][$i]["url"]);
					$i++;
				}
			}
			return $data;
		}
	}

	function Data_thumbnail($curl_content){
        if (preg_match_all('@<meta property="og:image" content="(.*?)" />@si', $curl_content, $match)) {
            return $match[1][0];
        }
    }

    function Data_title($curl_content){
        if (preg_match_all('@<meta property="og:title" content="(.*?)" />@si', $curl_content, $match)) {
            return $match[1][0];
        }
    }

	function get_url_playtube($url){
		if (preg_match('~<video id="my-video"[^>]*>(.*?)</video>~si', $url, $load_url)){
			preg_match('~<video id="my-video"[^>]*>(.*?)</video>~si', $url, $load_url);
			preg_match('/< *source [^>]*src *= *["\']?([^"\']*)/i', $load_url[1], $matches);
			$data = $matches[1];
			
		}else{
			preg_match('~<div class="pt_vdo_plyr"[^>]*>(.*?)</div>~si', $url, $load_url);
			preg_match('/< *iframe [^>]*src *= *["\']?([^"\']*)/i', $load_url[1], $matches);
			
			if(isset($matches[1])) :
				$url = $matches[1];
			if (preg_match("/player.vimeo.com\/([^&]+)/", $url)){
				$data = str_replace('https://player.vimeo.com/video/', 'https://vimeo.com/', $matches[1]);		
			} else if(preg_match("/www.dailymotion.com\/embed\/video\/(.+)([^&]+)/", $url)){	
				$data = str_replace('//www.dailymotion.com/embed/video/', 'https://dailymotion.com/video/', $matches[1]);	
			} else {
				
			}
			endif;
		}
		return $data;
	}	
 
?>