<?php
/*
Script for: WWE.com
Author: Zhareiv
Update date: 18-06-2019
Copyright (c) 2018 shareplus. All rights reserved.
*/

	function Data_media_Json($url) {
 		$data = array();
		$url_video 		= curl_content($url);
		$meta 			= PHP_Get_Tags($url);
		

		$meta = PHP_Get_Tags($url);
		$data["source"] 			= "wwe";
        $data["thumbnail"] 			= $meta['image'];
        $data["title"] 				= $meta['title'];
		$data["data"][0]["url"] 	= $url_video['stream'];
		$data["data"][0]["format"] 	= "mp4";
		$data["data"][0]["quality"] = "HD";
		$data["data"][0]["size"] 	= PHP_file_size($data["data"][0]["url"]);
        
        return $data;
	}

	function curl_content($url) {
		
		@$html = file_get_contents($url);
		@libxml_use_internal_errors(true);
		$dom = new DomDocument();
		@$dom->loadHTML($html);
		$xpath = new DOMXPath($dom);
		$query = '//*/meta[starts-with(@name, \'twitter:player:\')]';
		$result = $xpath->query($query);
		
		foreach ($result as $meta) {
			$name = $meta->getAttribute('name');
			$content = $meta->getAttribute('content');
		
			$name = str_replace('twitter:player:', '', $name);
			$list[$name] = $content;
		}
			
		return @$list;
	}

?>