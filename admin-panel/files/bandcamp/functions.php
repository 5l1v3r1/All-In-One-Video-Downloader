<?php
/*
Script for: bandcamp.com
Author: Zhareiv
Update date: 10-07-2019
Copyright (c) 2019 shareplus. All rights reserved.
*/

	function Data_media_Json($url){
		$data = array();
		$web_page = PHP_SYSTEM_url_get_contents($url);
        if (preg_match_all('@content="https://bandcamp.com/EmbeddedPlayer/(.*?)">@si', $web_page, $match)) {
            $embed_url = "https://bandcamp.com/EmbeddedPlayer/" . $match[1][0];
            $embed_page = PHP_SYSTEM_url_get_contents($embed_url);
            if (preg_match_all('@var playerdata = (.*?)"};@si', $embed_page, $match)) {
                $player_json = $match[1][0] . '"}';
                $player_data = json_decode($player_json, true);
                $i = 0;
                $data["thumbnail"] = $player_data["album_art"];
                if(!empty($player_data["tracks"])){
                    foreach ($player_data["tracks"] as $key => $p_data){
                        if(!empty($p_data["file"]["mp3-128"])){
                            $data["title"]				 	= $p_data["title"];
                            $data["data"][$i]["url"] 	 	= $p_data["file"]["mp3-128"];
                            $data["data"][$i]["format"] 	= "mp3";
                            $data["data"][$i]["quality"] 	= "128 kbps";
                            $data["data"][$i]["size"] 		= PHP_file_size($data["data"][$i]["url"]);
                            $i++;
                        }
                    }
                }
                $data["source"] = "bandcamp";
                return $data;
            }
        }
	}

?>