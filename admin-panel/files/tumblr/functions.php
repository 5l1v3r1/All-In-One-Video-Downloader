<?php
 /*
Script for: tumblr.com
Author: Zhareiv
Update date: 18-06-2019
Copyright (c) 2018 shareplus. All rights reserved.
*/

	function Data_media_Json($url){
		
		//$curl_content = PHP_SYSTEM_url_get_contents($url);
        $meta = PHP_Get_Tags($url);

		$username 			= explode('.', str_ireplace("www.", "", parse_url($url, PHP_URL_HOST)))[0];
		preg_match_all('@/post/(.*?)/@si', $url, $postID);
		$scrape 			= PHP_SYSTEM_url_get_contents("https://www.tumblr.com/video/" . $username . "/" . $postID[1][0] . "/700/");
		preg_match('/< *video[^>]*src *= *["\']?([^"\']*)/i', $scrape, $video);	
 
		$videoURL 			= str_replace("src=", "", $videoURL[0][0]);
		$videoURL 			= str_replace('"', "", $videoURL);
        $data["source"] 			= "tumblr";
		$data["title"] 				= $meta['title'];
		$data["thumbnail"] 			= $meta['image'];
		$data["data"][0]["url"] 	= $meta['video'];
		$data["data"][0]["format"] 	= "mp4";
		$data["data"][0]["size"] 	= PHP_file_size($data["data"][0]["url"]);
		$data["data"][0]["quality"] = "HD";
		return $data;
    }


	function get_title($curl_content){
        if (preg_match_all('@<title>(.*?)</title>@si', $curl_content, $match)) {
            return $match[1][0];
        }
    }
	
	
/* 	$video_tumblr_url	= $url;
	$username 			= explode('.', str_ireplace("www.", "", parse_url($video_tumblr_url, PHP_URL_HOST)))[0];
	preg_match_all('@/post/(.*?)/@si', $video_tumblr_url, $postID);
	$scrape 			= url_get_contents("https://www.tumblr.com/video/" . $username . "/" . $postID[1][0] . "/700/");
	preg_match_all('@src="https://' . $username . '.tumblr.com/video_file/(.*?)"@si', $scrape, $videoURL);
	$videoURL 			= str_replace("src=", "", $videoURL[0][0]);
    $videoURL 			= str_replace('"', "", $videoURL);
*/
?>	