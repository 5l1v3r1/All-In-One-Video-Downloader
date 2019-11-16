<?php
/*
Script for: facebook.com
Author: Zhareiv
Update date: 18-06-2019
Copyright (c) 2018 shareplus. All rights reserved.
*/

	function Data_media_Json($url){
		
		$data = array();
		
		$curl_content = PHP_SYSTEM_url_get_contents($url);
         
		$data["source"]		= "facebook";
        $data["title"] 		= getTitle_facebook($curl_content);
        $data["thumbnail"] 	= get_thumbnail($curl_content);
		$sd_link = sd_finallink($curl_content);
		$data["data"]["0"]["url"] 		= $sd_link;
		$data["data"]["0"]["format"] 	= "mp4";
		$data["data"]["0"]["quality"] 	= 'SD';
		$data["data"]["0"]["size"] 		= PHP_file_size($data["data"][0]["url"]);
		$hd_link = hd_finallink($curl_content);
		if(!empty($hd_link)){
			$data["data"]["1"]["url"] 		= $hd_link;
			$data["data"]["1"]["format"] 	= "mp4";
			$data["data"]["1"]["quality"] 	= 'HD';
			$data["data"]["1"]["size"] 		= PHP_file_size($data["data"][1]["url"]);
		}
        return $data;
    }

	function unshorten($url, $max_redirs = 3){
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
	
	function GET_DATA_FACEBOOK($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.10240');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		$data = curl_exec($ch);
		curl_close($ch);
		return unshorten($data);
	}

    function get_thumbnail($curl_content){
        if (preg_match('/og:image"\s*content="([^"]+)"/', $curl_content, $match)) {
            return $match[1];
        }
    }	
///===== this function is to check if there are special characters	
	function cleanStr($str){
		return html_entity_decode(strip_tags($str), ENT_QUOTES, 'UTF-8');
	}
///===== with these functions are to read the data of facebook videos
///-----facebook more url
    function mobil_link($curl_content){
        $regex = '@&quot;https:(.*?)&quot;,&quot;@si';
        if (preg_match_all($regex, $curl_content, $match)) {
            return $match[1][0];
        }
    }
///-----facebook HD videos link
	function hd_finallink($curl_content){

		$regex = '/hd_src_no_ratelimit:"([^"]+)"/';
		if (preg_match($regex, $curl_content, $match)) {
			return $match[1];

		} else {
			return;
		}
	}
///----- facebook SD videos link
	function sd_finallink($curl_content){
		$regex = '/sd_src_no_ratelimit:"([^"]+)"/';
		if (preg_match($regex, $curl_content, $match1)) {
			return $match1[1];

		} else {
			$mobil_link = mobil_link($curl_content);
            if (!empty($mobil_link)) {
                return $mobil_link;
            }
		}
	}
///----- title of the facebook video
    function getTitle_facebook($curl_content){
    
			preg_match('~<title id="pageTitle"[^>]*>(.*?)</title>~si', $curl_content, $match);
			return $match[1];
	 
    }	
?>