<?php
/*
Script for: Dailymotion.com
Author: Zhareiv
Update date: 18-06-2019
Copyright (c) 2018 shareplus. All rights reserved.
*/
	function Data_media_Json($url){

		$data = array();

		$id = video_id($url);
		$curl_content = PHP_NATIVE_cURL("https://www.dailymotion.com/embed/video/" . $id);
		$meta = PHP_Get_Tags($url);
		$data['image'] = $meta['image']; 
		$data['title'] = $meta['title'];
		$format_codes = array(
                    "144" => array("order" => "1", "height" => "144", "ext" => "mp4", "resolution" => "144p", "video" => "true", "video_only" => "false"),
                    "240" => array("order" => "2", "height" => "240", "ext" => "mp4", "resolution" => "240p", "video" => "true", "video_only" => "false"),
                    "380" => array("order" => "3", "height" => "380", "ext" => "mp4", "resolution" => "380p", "video" => "true", "video_only" => "false"),
                    "480" => array("order" => "4", "height" => "480", "ext" => "mp4", "resolution" => "480p", "video" => "true", "video_only" => "false"),
                    "720" => array("order" => "5", "height" => "720", "ext" => "mp4", "resolution" => "720p", "video" => "true", "video_only" => "false"),
                    "1080" => array("order" => "6", "height" => "1080", "ext" => "mp4", "resolution" => "1080p", "video" => "true", "video_only" => "false")
                );
		$video_formats_data = get_string_between($curl_content, "config = ", "}};");	
		$video_formats_data .= "}}";
        $video_formats_data = json_decode($video_formats_data, true);	
		$streams = $video_formats_data['metadata']['qualities'];
        $videos = array();
        foreach ($streams as $format_id => $stream) {
            if (array_key_exists($format_id, $format_codes)) {
                $data_video = array();
                $format_data = $format_codes[$format_id];
                $data_video['data'] 	= $format_data;
                $data_video['formatId'] = $format_id;
                $data_video['order'] 	= $format_data['order'];
                $data_video['url'] 		= $stream[1]['url'];
                $data_video['size'] 	= "unknown";
                array_push($videos, $data_video);
            }
			
        }
			$orders = array();
            foreach ($videos as $key => $row) {
                $orders[$key] = $row['order'];
            }
            array_multisort($orders, SORT_DESC, $videos);
               $data['videos'] = $videos;
		return data_dailymotion($data);
	}

	function data_dailymotion($data){
		$video["title"] 	= $data['title'];
		$video["source"] 	= "Dailymotion";
		$video["thumbnail"] = $data['image'];
		$i = 0;
		foreach ($data["videos"] as $current) {
			$video["data"][$i]["url"] = $current["url"];
			$video["data"][$i]["format"] = "mp4";
			$video["data"][$i]["size"] = PHP_file_size($video["data"][$i]["url"]);
			$video["data"][$i]["quality"] = $current["formatId"] . "P";
			$i++;
		}
		$video["data"] = array_reverse($video["data"]);
		return $video;
	}

    function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

	function video_id($url){
        $domain = str_ireplace("www.", "", parse_url($url, PHP_URL_HOST));
        switch (true) {
            case($domain == "dai.ly"):
                $video_id = str_replace('https://dai.ly/', "", $url);
                $video_id = str_replace('/', "", $video_id);
                return $video_id;
                break;
            case($domain == "dailymotion.com"):
                $url_parts = parse_url($url);
                $path_arr = explode("/", rtrim($url_parts['path'], "/"));
                $video_id = $path_arr[2];
                return $video_id;
                break;
        }
    }

?>