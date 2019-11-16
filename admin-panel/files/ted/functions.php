<?php
/*
Script for: Ted.com
Author: Zhareiv
Update date: 10-07-2019
Copyright (c) 2019 shareplus. All rights reserved.
*/

	function Data_media_Json($url){
		$data = array();
		$curl_content = PHP_SYSTEM_url_get_contents($url);
        preg_match_all('@"__INITIAL_DATA__":(.*?)\}\)</script>@si', $curl_content, $match); 
		$json = json_decode($match[1][0], true);
        $data["source"] = "ted";
        $data["direct_download"] = "yes";
        $data["title"] = $json["name"];
        $data["thumbnail"] = $json["talks"][0]["hero"];
        $i = 0;
        foreach ($json["talks"][0]["downloads"]["nativeDownloads"] as $quality => $url){
            $data["data"][$i]["url"] 		= $url;
            $data["data"][$i]["format"] 	= "mp4";
            $data["data"][$i]["quality"] 	= $quality;
            $data["data"][$i]["size"] 		= PHP_file_size($data["data"][$i]["url"]);
            $i++;
        }
        $data["data"][$i]["url"] 			= cURL($json["talks"][0]["downloads"]["audioDownload"]);
        $data["data"][$i]["format"] 		= "mp3";
        $data["data"][$i]["quality"] 		= "128 Kbps";
        $data["data"][$i]["size"] 			= PHP_file_size($data["data"][$i]["url"]);
        return $data;
	}
 
	function cURL($url, $max_redirs = 3){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, $max_redirs);
		curl_setopt($ch, CURLOPT_TIMEOUT, 15);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Niche Office Link Checker 1.0');
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_exec($ch);
		$url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
		curl_close($ch);
		return $url;
	}
?>