<?php
/*
Script for: plays.com
Author: Zhareiv
Update date: 18-06-2019
Copyright (c) 2018 shareplus. All rights reserved.
*/
	function Data_media_Json($url){
		
		$data = array();
		
		$curl_content = PHP_SYSTEM_url_get_contents($url);
        $meta = PHP_Get_Tags($url);
		$data["source"] 			= "Plays";
        $data["title"] = $meta['title'];
        $data["thumbnail"] = $meta['image'];
		if (preg_match_all('/res="(1080|720|480|360|240|144)" src="(.*?)"/', $curl_content, $matches)) {
            $i = 0;
            foreach ($matches[2] as $match) {
				$data["data"][$i]["url"] 		= 'https:'.$match;
				$data["data"][$i]["format"] 	= "mp4";
				$data["data"][$i]["quality"] 	= $matches[1][$i].'p';
				$data["data"][$i]["size"] 		= PHP_file_size($data["data"][0]["url"]);
                $i++;
            }
        }
        return $data;
    }
?>