<?php
/*
Script for: puhutv.com
Author: Zhareiv
Update date: 18-06-2019
Copyright (c) 2018 shareplus. All rights reserved.
*/	
 
	function Data_media_Json($url){
		
		$data = array();
		
        $curl_content = PHP_SYSTEM_url_get_contents($url);
        if (preg_match_all('@"assetId":(.*?),@si', $curl_content, $match)) {
            $video_id = $match[1][0];
        }
        if (preg_match('@name="og:title" content="(.*?)"@si', $curl_content, $title)) {
            $data["title"] = $title[1];
        }
        if (preg_match('@name="og:image" content="(.*?)"@si', $curl_content, $thumbnail)) {
            $data["thumbnail"] = $thumbnail[1];
        }
		if (preg_match('@name="og:image:width" content="(.*?)"@si', $curl_content, $Error_404)) {
            $data["Error_404"] = $Error_404[1];
        }
		$data["source"] = "puhutv";
        $api_url = "https://puhutv.com/api/assets/" . $video_id . "/videos";
        $api_page = PHP_SYSTEM_url_get_contents($api_url);
        $api_json = json_decode($api_page, true)["data"]["videos"];
        $i = 0;
        foreach ($api_json as $current) {
            if ($current["video_format"] == "mp4") {
                $data["data"][$i]["url"] 		= $current["url"];
                $data["data"][$i]["format"] 	= "mp4";;
                $data["data"][$i]["size"]		= PHP_file_size($data["data"][$i]["url"]);
                $data["data"][$i]["quality"] 	= $current["quality"] . "p";
                $i++;
            }
        }
        
        return $data; 
    }

?>
