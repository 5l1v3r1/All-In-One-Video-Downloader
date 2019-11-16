<?php
/*
Script for: tiktok.com
Author: Zhareiv
Update date: 18-06-2019
Copyright (c) 2018 shareplus. All rights reserved.
*/
 
	function Data_media_Json($url){
		
	 
		$curl_content = PHP_SYSTEM_url_get_contents($url);
        
		preg_match_all('/\bdata\s*=\s*({.+?})\s*;/', $curl_content, $match);
        preg_match_all('@<script>window.__INIT_PROPS__ = (.*?)</script>@si', $curl_content, $match2);
        if (isset($match[1][0]) != "") {
            $data = json_decode($match[1][0], true);
            $data["source"] = "tiktok";
            $data["title"] = $data["share_info"]["share_title"];
            $data["thumbnail"] = $data["video"]["cover"]["preview_url"];
            $data["data"][0]["url"] = "https:" . $data["video"]["play_addr"]["url_list"][0];
            $data["data"][0]["format"] = "mp4";
            $data["data"][0]["size"] = PHP_file_size($data["data"][0]["url"]);
            $data["data"][0]["quality"] = "HD";
            return $data;
        } else if (isset($match2[1][0]) != "") {
            $data = json_decode($match2[1][0], true)["/@:uniqueId/video/:id"];
            $data["source"] = "tiktok";
            $data["title"] = $data["shareMeta"]["title"];
            $data["thumbnail"] = $data["videoData"]["itemInfos"]["covers"][0];
            $data["data"][0]["url"] = $data["videoData"]["itemInfos"]["video"]["urls"][0];
            $data["data"][0]["format"] = "mp4";
            $data["data"][0]["size"] = PHP_file_size($data["data"][0]["url"]);
            $data["data"][0]["quality"] = "HD";
            return $data;
        } else {
            return false;
        }
    }
	
	function get_title($curl_content){
        preg_match_all('@<title>(.*?)</title>@si', $curl_content, $match);
            return $match[1][0];
        
    }


?>