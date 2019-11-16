<?php
/*
Script for: reddit.com
Author: Zhareiv
Update date: 18-06-2019
Copyright (c) 2018 shareplus. All rights reserved.
*/

	function Data_media_Json($url){
		
		$data = array();
		
        $curl_content = get_contents_Reddit($url);
		if (preg_match('@"scrubberThumbSource":"(.*?)"@si', $curl_content, $video_url)){ 
			$data["source"] 			= "Reddit";
			$data["thumbnail"] 			= get_thumbnail($curl_content);
			$data["title"] 				= get_title($curl_content);
			$data["data"][0]["url"] 	= $video_url[1];
			$data["data"][0]["format"] = "mp4";
			$data["data"][0]["quality"] = "video";
			$data["data"][0]["size"] 	= PHP_file_size($data["data"][0]["url"]);

			return $data;
		}
    }
	
	function get_more_url($curl_content){
		preg_match('/< *video[^>]*src *= *["\']?([^"\']*)/i', $curl_content, $match);	
		return $match[1];		
	}
	
	function get_title($curl_content){
        preg_match_all('@property="og:title" content="(.*?)"@si', $curl_content, $match);
            return $match[1][0];
        
    }

	function get_thumbnail($curl_content){
        preg_match_all('@property="og:image" content="(.*?)"@si', $curl_content, $match);
            return $match[1][0];
        
    }
	
	function get_contents_Reddit($linkinfo){
			$context = [
				'http' => [
					'method' => 'GET',
					'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.47 Safari/537.36",
				],
			];
			$context = stream_context_create($context);
			$data = file_get_contents($linkinfo, false, $context);
			
			return $data;
	}	

?>