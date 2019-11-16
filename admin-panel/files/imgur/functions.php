<?php
/*
Script for: imgur.com
Author: Zhareiv
Update date: 18-06-2019
Copyright (c) 2018 shareplus. All rights reserved.
*/

	function Data_media_Json($url){
		
		$data = array();
		
		$curl_content = PHP_SYSTEM_url_get_contents($url);
		$meta = PHP_Get_Tags($url);
		$data["source"] 	= "imgur";
        $data["title"] 		= get_title($curl_content);
        $data["thumbnail"] 	= get_thumbnail($curl_content);
		$data["data"][0]["url"] 		= $meta['video'];
		$data["data"][0]["format"] 		= "mp4";
		$data["data"][0]["quality"] 	= 'HD';
		$data["data"][0]["size"] 		= PHP_file_size($data["data"][0]["url"]);

        return $data;
    }
	
	function get_thumbnail($curl_content){
        if (preg_match_all('/meta itemprop="thumbnailUrl"\s*content="([^"]+)"/', $curl_content, $match)) {
            return $match[1][0];
        } else if (preg_match_all('/property="og:image"\s*content="([^"]+)"/', $curl_content, $match)) {
            return $match[1][0];
        }
    }
	
	function get_title($curl_content){
        if (preg_match_all('/og:title"\s*content="([^"]+)"/', $curl_content, $match)) {
            return $match[1][0];
        } else if (preg_match_all('/property="og:title"\s*content="([^"]+)"/', $curl_content, $match)) {
            return $match[1][0];
        }
    }
?>