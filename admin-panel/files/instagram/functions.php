<?php
/*
Script for: Instagram.com
Author: Zhareiv
Update date: 18-06-2019
Copyright (c) 2018 shareplus. All rights reserved.
*/
	
   function Data_type($curl_content){
        if (preg_match_all('@<meta property="og:type" content="(.*?)" />@si', $curl_content, $match)) {
            return $match[1][0];
        }
    }

    function Data_image($curl_content){

        if (preg_match_all('@<meta property="og:image" content="(.*?)" />@si', $curl_content, $match)) {
            return $match[1][0];
        }

    }

    function Data_video($curl_content){

        if (preg_match_all('@<meta property="og:video" content="(.*?)" />@si', $curl_content, $match)) {
            return $match[1][0];
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
 
	function Data_media_Json($url){
		
		$data = array();
        $curl_content = PHP_NATIVE_cURL($url);
        $data["source"] = "Instagram";
		$data["title"] = Data_title($curl_content);
        $data["thumbnail"] = Data_thumbnail($curl_content);
        switch (Data_type($curl_content)) {
            case "instapp:photo":
                $data['data'][0]['url'] 	= Data_thumbnail($curl_content);
				$data["data"][0]["format"] 	= PHP_Format_video($data['data'][0]['url'] );
				$data['data'][0]["quality"] = "image";
				$data['data'][0]["size"] 	= PHP_file_size($data['data'][0]['url']);
            break;
            case "video":
                $data['data'][0]['url'] 	= Data_video($curl_content);
				$data["data"][0]["format"] 	= "mp4";
				$data['data'][0]["quality"] = "HD";
				$data['data'][0]["size"] 	= PHP_file_size($data['data'][0]['url']);				
            break;
        }
        return $data;
    }

?>