<?php
/*
Script for: Vimeo.com
Author: Zhareiv
Update date: 18-06-2019
Copyright (c) 2018 shareplus. All rights reserved.
*/

	function Data_media_Json($url){
		
		$data = array();
		$curl_content = PHP_SYSTEM_url_get_contents($url);
		if (preg_match_all('/window.vimeo.clip_page_config.player\s*=\s*({.+?})\s*;\s*\n/', $curl_content, $match)) {
			$config_url = json_decode($match[1][0], true)["config_url"];
			$result = json_decode(PHP_SYSTEM_url_get_contents($config_url), true);
			$data["source"] = "Vimeo";
			$data["title"] = $result["video"]["title"];
			$data["thumbnail"] = reset($result["video"]["thumbs"]);
			$i = 0;
			foreach ($result["request"]["files"]["progressive"] as $current) {
				$data["data"][$i]["url"] 		= $current["url"];
				$data["data"][$i]["format"] 	= "mp4";
				$data["data"][$i]["size"] 		= PHP_file_size($data["data"][$i]["url"]);
				$data["data"][$i]["quality"] 	= $current["quality"] . "p";
				$i++;
			}
        
			return $data;
		}
    }

?>
