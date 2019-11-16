<?php
/*
Script for: break.com
Author: Zhareiv
Update date: 10-07-2019
Copyright (c) 2019 shareplus. All rights reserved.
*/

	$PHP_cUrl  = PHP_NATIVE_cURL($url);
	preg_match('~<video id="player"[^>]*>(.*?)</video>~si', $PHP_cUrl, $load_url);		
	preg_match('/< *source [^>]*src *= *["\']?([^"\']*)/i', $load_url[1], $matches);
	$data_url = str_ireplace("www.", "", parse_url($matches[1], PHP_URL_HOST));        
	if ($data_url == "youtube.com" || $data_url == "m.youtube.com" || $data_url == "youtu.be"){ //--> Extension of YouTube 
		# YouTube code
		$url = $matches[1];
		include($plugins_dir . "/youtube/functions.php");
	}else{
		function Data_media_Json($url){
			$data = array();
			$data['found'] = 0;
			$data_video_embed = $url;
			$text_curl = PHP_SYSTEM_url_get_contents($url);
			if ($text_curl) {
				$result 		= PHP_string_between($text_curl, 'var clipvars = ', ';');
				$title 			= PHP_string_between($text_curl, '<title>', '</title>');
				$data['title'] 	= $title;
				$data['image'] 	= PHP_string_between($text_curl, 'defaultThumbnailUrl": "', '"');
				$videoSDlink 	= PHP_string_between($text_curl, '[{"url":"', '"');
				$links 			= array();
				$links['SD'] 	= $videoSDlink;
				$format_codes = array(
						"SD" => array("order" => "1", "height" => "{{height}}", "ext" => "mp4", "resolution" => "SD", "video" => "true", "video_only" => "false"),
						"HD" => array("order" => "2", "height" => "{{height}}", "ext" => "mp4", "resolution" => "HD", "video" => "true", "video_only" => "false")
				);
				$videos = array();
				foreach ($format_codes as $format_id => $format_data) {
					if (isset($links[$format_id])) {
						$link = array();
						$link['data'] = $format_data;
						$link['formatId'] = $format_id;
						$link['order'] = $format_data['order'];
						$link['url'] = $links[$format_id];
						$link['title'] = $title . "." . $format_data['ext'];
						array_push($videos, $link);
					}
				}
				$data['videos'] = $videos;
			}
			return format_data($data);   
		}
	}	
 
	function format_data($data){
        $video["title"] = $data["title"];
        $video["source"] = "break";
        $video["thumbnail"] = $data["image"];
        $i = 0;
        foreach ($data["videos"] as $current) {
            $video["data"][$i]["url"] 		= $current["url"];
            $video["data"][$i]["format"] 	= "mp4";
            $video["data"][$i]["size"] 		= PHP_file_size($video["data"][$i]["url"]);
            $video["data"][$i]["quality"] 	= $current["formatId"];
            $i++;
        }
        return $video;
    }


 
 
 
 


?>