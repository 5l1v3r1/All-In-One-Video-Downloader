<?php
/*
Script for: vk.com
Author: Zhareiv
Update date: 18-06-2019
Copyright (c) 2018 shareplus. All rights reserved.
*/	

	function Data_media_Json($url){
		
		$data = array();
	
        $video_id = str_replace("video/", "", substr(parse_url($url, PHP_URL_PATH), 1));
        $data = get_data($video_id);
        if (isset($data) != "") {
            $data = json_decode($data, true);
			$data["source"] 		= "ok.ru";
			$data["thumbnail"] 		= $data["movie"]["poster"];
            $data["title"] 			= $data["movie"]["title"];
            $i = 0;
            foreach ($data["videos"] as $item) {
				$data["data"][$i]["format"] 	= "mp4";
                $data["data"][$i]["url"] 		= $item["url"];
				$data["data"][$i]["quality"] 	= $item["name"];
				$data["data"][$i]["size"] 		= PHP_file_size($item["url"]);
                $i++;
            }
            return $data;
        } else {
            return false;
        }
    }
	
	function get_data($video_id){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://ok.ru/dk?cmd=videoPlayerMetadata&mid=$video_id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST"
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return false;
        } else {
            return $response;
        }
    }

?>