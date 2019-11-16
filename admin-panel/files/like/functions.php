<?php
/*
Script for: mobile.like-video.com
Author: Zhareiv
Update date: 07-06-2019
Copyright (c) 2018 shareplus. All rights reserved.
*/

	function Data_media_Json($url){
		
		$data = array();
		
		$curl_content = PHP_SYSTEM_url_get_contents($url);
        $meta  = PHP_Get_Tags($url);
		$data["source"] 			= "Like";
        $data["title"] 				= get_title($curl_content);
        $data["thumbnail"] 			= $meta['image'];
		$data["data"][0]["url"] 	= get_url_video($curl_content);
		$data["data"][0]["format"] 	= "mp4";
		$data["data"][0]["quality"] = "HD";
		$data["data"][0]["size"] 	= PHP_file_size($data["data"][0]["url"]);
        
        return $data;
    }
	
	function get_url_video($curl_content){
		preg_match('/< *video[^>]*src *= *["\']?([^"\']*)/i', $curl_content, $match);	
		return $match[1];		
	}
	
	function get_title($curl_content){
        preg_match_all('@<title>(.*?)</title>@si', $curl_content, $match);
        return $match[1][0];
        
    }

	function get_thumbnail($curl_content){
        preg_match_all('@property="og:image" content="(.*?)"@si', $curl_content, $match);
        return $match[1];
        
    }

?>