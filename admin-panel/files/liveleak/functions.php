<?php
/*
Script for: Liveleak.com
Author: Zhareiv
Update date: 18-06-2019
Copyright (c) 2018 shareplus. All rights reserved.
*/

 $PHP_cUrl  = PHP_NATIVE_cURL($url);
if (preg_match('~<div class="embedWrapper"[^>]*>(.*?)</div>~si', $PHP_cUrl, $load_url)){		
	preg_match('~<div class="embedWrapper"[^>]*>(.*?)</div>~si', $PHP_cUrl, $load_url);		
	preg_match('/< *iframe[^>]*src *= *["\']?([^"\']*)/i', $load_url[1], $matches);	
	$data_video_embed = str_replace('//www.youtube.com/embed/', 'https://www.youtube.com/watch?v=', $matches[1]);
	//--> YouTube
	$url = $data_video_embed;
	include($plugins_dir . "/youtube/functions.php");
	//--> end
}else{
    function Data_media_Json($url){
		$curl_content = PHP_NATIVE_cURL($url);
		$data = array();
		$meta = PHP_Get_Tags($url);
		if (preg_match_all('/src="(.*?)" (default|) label="(720p|360p|HD|SD)"/', $curl_content, $matches)) {
			$data["title"] 		= $meta['title'];
			$data['thumbnail'] 	= $meta['image'];
			$data["source"] 	= 'Liveleak';
            $i = 0;
            foreach ($matches[1] as $match) {
                    $data["data"][$i]["url"] 		= $match;
					$data["data"][$i]["format"]		= "mp4";
                    $data["data"][$i]["quality"] 	= $matches[3][$i];
					$data["data"][$i]["size"] 		= PHP_file_size($data["data"][$i]["url"]);
                    $i++;
            }
        }
		$data["data"] = array_reverse($data["data"]);
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
?>