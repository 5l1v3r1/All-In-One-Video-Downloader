<?php
/*
Script for: YouTube.com
Author: Zhareiv
Update date: 18-06-2019
Copyright (c) 2018 shareplus. All rights reserved.
*/

include ("data.php");	

	$data_yt = new YouTubeDownloader();


	function Data_media_Json($url){
		global $data_yt;
		
		$data 				= array();
		$meta = PHP_Get_Tags($url);
		$video_id 			= video_id($url);
		$data["title"] 		= $meta["title"];
		$data['thumbnail'] 	= "https://i.ytimg.com/vi/" . $video_id . "/mqdefault.jpg";	
		$data["source"] 	= 'YouTube';
		$links = $data_yt->getDownloadLinks($url);
		$i = 0;
		foreach($links['data'] as $indice => $data_video){
			

		
				if (itag_true($data_video['quality'])){
					if((PHP_file_size($data_video['url'])?true:false)){		
						$data["data"][$i]['url'] 		= $data_video['url'];
						//$data["data"][$i]['format'] 	= ($data_video['quality'] == 140) ? 'MP3' : PHP_Format_video($match[2]);					
						$data["data"][$i]['format'] 	= itag_format($data_video['quality']);					
						$data["data"][$i]["quality"] 	= itag_to_quality_data($data_video['quality']);
						$data["data"][$i]["size"] 		= PHP_file_size($data_video['url']);
					}
				}	
			 	
			$i++; 
		}
	 
		return $data;
	}
 
    function video_id($url){
		
        $domain = str_ireplace("www.", "", parse_url($url, PHP_URL_HOST));
        switch ($domain) {
            case "youtube.com":
                parse_str(parse_url($url, PHP_URL_QUERY), $post_query);
                $video_id = $post_query["v"];
                return $video_id;
                break;
            case "m.youtube.com":
                parse_str(parse_url($url, PHP_URL_QUERY), $post_query);
                $video_id = $post_query["v"];
                return $video_id;
                break;
            case "youtu.be":
                $path = parse_url($url, PHP_URL_PATH);
                $path_fragments = explode("/", $path);
                $video_id = end($path_fragments);
                return $video_id;
                break;
            default:
                return "";
                break;
        }
    }
	
	 function itag_to_quality_data($itag) {
        switch ($itag) {
            case "17":
                return "144P";
                break;
            case "278":
                return "144P";
                break;
            case "36":
                return "240P";
                break;
            case "242":
                return "240P";
                break;
            case "18":
                return "360P";
                break;
            case "243":
                return "360P";
                break;
            case "43":
                return "360P";
                break;
            case "35":
                return "480P";
                break;
            case "44":
                return "480P";
                break;
            case "135":
                return "<img src='https://i.imgur.com/sAiZdSr.png'></img> 480P";
                break;
            case "244":
                return "480P";
                break;
            case "22":
                return "720P";
                break;
            case "136":
                return "720P";
                break;
            case "247":
                return "720P";
                break;
            case "137":
                return "1080P";
                break;
            case "248":
                return "1080P";
                break;
            case "299":
                return "1080P (60 FPS)";
                break;
            case "138":
                return "2K";
                break;
            case "264":
                return "2K";
                break;
            case "271":
                return "2K";
                break;
            case "266":
                return "4K";
                break;
            case "313":
                return "4K (60 FPS)";
                break;
            case "139":
                return "<img src='https://i.imgur.com/H6TF3Sc.png'></img> 48 Kbps";
                break;
            case "140":
                return "<img src='https://i.imgur.com/cYJzY9F.png'></img> 128 Kbps";
                break;
            case "141":
                return "<img src='https://i.imgur.com/cYJzY9F.png'></img> 128 Kbps";
                break;				
            case "171":
                return "<img src='https://i.imgur.com/H6TF3Sc.png'></img> 128 Kbps";
                break;
			case "249":
                return "<img src='https://i.imgur.com/sAiZdSr.png'></img> 50k";
                break;
			case "250":
                return "<img src='https://i.imgur.com/H6TF3Sc.png'></img> 70k";
                break;
			case "251":
                return "<img src='https://i.imgur.com/H6TF3Sc.png'></img> 160k";
                break;				
            default:
                return $itag;
                break;
        }
    } 
	
	function itag_true($itag) {
        switch ($itag) {
            case "17":
                return true;
                break;
            case "278":
                return true;
                break;
            case "36":
                return true;
                break;
            case "242":
                return true;
                break;
            case "18":
                return true;
                break;
            case "243":
                return true;
                break;
            case "43":
                return true;
                break;
            case "35":
                return true;
                break;
            case "44":
                return true;
                break;
            case "135":
                return true;
                break;
            case "244":
                return true;
                break;
            case "22":
                return true;
                break;
            case "136":
                return true;
                break;
            case "247":
                return true;
                break;
            case "137":
                return true;
                break;
            case "248":
                return true;
                break;
            case "299":
                return true;
                break;
            case "138":
                return true;
                break;
            case "264":
                return true;
                break;
            case "271":
                return true;
                break;
            case "266":
                return true;
                break;
            case "313":
                return true;
                break;
            case "139":
                return true;
                break;
            case "140":
                return true;
                break;
            case "141":
                return true;
                break;				
            case "171":
                return true;
                break;
			case "249":
                return true;
                break;
			case "250":
                return true;
                break;
			case "251":
                return true;
                break;				
            default:
                return false;
                break;
        }
    }
	
	function itag_format($itag) {
        switch ($itag) {
            case "17":
                return '3GP';
                break;
            case "278":
                return 'WEBM';
                break;
            case "36":
                return '3GP';
                break;
            case "242":
                return 'WEBM';
                break;
            case "18":
                return 'MP4';
                break;
            case "243":
                return 'WEBM';
                break;
            case "43":
                return 'WEBM';
                break;
            case "35":
                return 'FLV';
                break;
            case "44":
                return 'WEBM';
                break;
            case "135":
                return 'MP4';
                break;
            case "244":
                return 'WEBM';
                break;
            case "22":
                return 'MP4';
                break;
            case "136":
                return 'MP4';
                break;
            case "247":
                return 'WEBM';
                break;
            case "137":
                return 'MP4';
                break;
            case "248":
                return 'WEBM';
                break;
            case "299":
                return 'MP4';
                break;
            case "138":
                return 'MP4';
                break;
            case "264":
                return 'MP4';
                break;
            case "271":
                return 'WEBM';
                break;
            case "266":
                return 'MP4';
                break;
            case "313":
                return 'WEBM';
                break;
            case "139":
                return 'MP3';
                break;
            case "140":
                return 'MP3';
                break;
            case "141":
                return 'MP3';
                break;				
            case "171":
                return 'WEBM';
                break;
			case "249":
                return 'WEBM';
                break;
			case "250":
                return 'WEBM';
                break;
			case "251":
                return 'WEBM';
                break;				
            default:
                return 'MP4';
                break;
        }
    }