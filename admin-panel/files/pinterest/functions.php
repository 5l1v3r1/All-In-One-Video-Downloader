<?php 
/*
Script for: pinterest.com
Author: Zhareiv
Update date: 18-06-2019
Copyright (c) 2018 shareplus. All rights reserved.
*/

	function Data_media_Json($url){
		$data = array();
		$curl_content 	= curl_content($url);
		$meta = PHP_Get_Tags($url);
		$data["source"] 			= "Pinteres";
        $data["thumbnail"] 			= $meta['image'];
        $data["title"] 				= $meta['title'];
		$data["data"][0]["url"] 	= Data_video($curl_content, $url);;
		$data["data"][0]["format"] 	= "mp4";
		$data["data"][0]["quality"] = "720p";
		$data["data"][0]["size"] 	= PHP_file_size($data["data"][0]["url"]);
        
        return $data;
	}
	
	
	
		function sanitize($string, $forceLowercase = false, $anal = false){
		$strip = array("~", "`", "!", "@", "https://www.pinterest.com/pin/", "$", "%", "^", "&", "*", "(", ")", "=", "+", "[", "{", "]",
			"}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
			"â€”", "â€“", ",", "<", ".", ">", "/", "?", "pin");
		$clean = trim(str_replace($strip, "", strip_tags($string)));
		$clean = preg_replace('/\s+/', "-", $clean);
		$clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean;
		$clean = ($forceLowercase) ?
			(function_exists('mb_strtolower')) ?
				mb_strtolower($clean, 'UTF-8') :
				strtolower($clean) :
			$clean;
		$specialChars = "\x00\x21\x22\x24\x25\x2a\x2f\x3a\x3c\x3e\x3f\x5c\x7c";
		$clean = str_replace(str_split($specialChars), '_', $clean);
		$clean = substr($clean, 0, 40);
		$clean = mb_convert_encoding($clean, 'UTF-8', 'UTF-8');
		return $clean;
	}

    function get_Pinterest_id_video($curl_content)
    {
        if (preg_match_all('@<meta property="og:url" name="og:url" content="(.*?)" data-app>@si', $curl_content, $match)) {
            return $match[1][0];
        }
    }

	function curl_content($linkinfo){
		
		$context = [
		'http' => [
				'method' => 'GET',
				'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.47 Safari/537.36",
			],
		];
		
		$context = stream_context_create($context);
		$data = file_get_contents($linkinfo, false, $context);
			
		return $data;
	}
	
	
	function Data_video($data_url, $url){
		if (preg_match("/pin.it(.+)([^&]+)/", $url)){	
			$id_video = sanitize(get_Pinterest_id_video($data_url));
			$source = str_replace('type="application/json"', '', $data_url);
			$data = str_replace('script', 'p', $source);
			preg_match("'<p  id=\'initial-state\'>(.*?)</p>'si", $data, $match);
			$file = $match[1];
			$file = str_replace($id_video, 'DATA_URL_ID_VIDEO', $file);
			$info = json_decode($file,true);
			$id = $info['pins']['DATA_URL_ID_VIDEO']['videos']['video_list']['V_HLSV4']['url'];
			$data 		= str_replace('hls', '720p', $id);
			$url_video  = str_replace('.m3u8', '.mp4', $data);

		}else{
			$source		= str_replace('type="application/json"', '', $data_url);
			$data 		= str_replace('script', 'p', $source);
			preg_match("'<p  id=\'initial-state\'>(.*?)</p>'si", $data, $match);
			$file		= $match[1];
			$source = str_replace('type="application/json"', '', $source);
			$data = str_replace('script', 'p', $source);
			preg_match("'<p  id=\'initial-state\'>(.*?)</p>'si", $data, $match);
			$file = $match[1];
			$info = json_decode($file,true);
			$id = sanitize($info['location']['pathname']);
			$code 		= 'field_set_key=\"detailed\",get_page_metadata=true,id=\"'.$id.'\",main_module_name=\"UnauthPinReactPage\",pure_react=true,python_resource_prefetch=false';
			$code 		= str_replace($code, 'info', $file);
			$output 	= json_decode($code,true);
			$data 		= $output['resources']['data']['PinPageResource']['info']['data']['videos']['video_list']['V_HLSV4']['url'];
			$data 		= str_replace('hls', '720p', $data);
			$url_video  = str_replace('.m3u8', '.mp4', $data);
		}
		return $url_video;
	}
	
	
?>