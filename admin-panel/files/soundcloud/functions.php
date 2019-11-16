<?php

    function truncate($string, $length)
    {
        $string = trim(strip_tags($string));
        if (strlen($string) > $length) {
            $string = substr($string, 0, $length) . '...';
        }
        return $string;
    }

    function Data_media_Json($url){
		
		$key_api = 'DMgKi6Eg9EhC4B5Ddj3P7mjTu8qV2AVu';
        $data = array();
        if (!empty($key_api)) {
            $data['found'] = 0;
            $result = PHP_SYSTEM_url_get_contents("https://api.soundcloud.com/resolve.json?url=" . $url . "&client_id=" . $key_api);
            if ($result) {
                $result = json_decode($result, true);
                if (isset($result['kind']) && $result['kind'] == "track") {
                    $data['id'] = $result['id'];
                    $data['found'] = 1;
                    $title = (isset($result['title']) ? htmlentities($result['title'], ENT_QUOTES) : "Track By Soundcloud");
                    $data['title'] = $title;
                    $data['image'] = str_replace("large", "t300x300", $result['artwork_url']);
                    $duration = $result['duration'] / 1000;
                    $data['time'] = gmdate(($duration > 3600 ? "H:i:s" : "i:s"), $duration);
                    $stream_links = PHP_SYSTEM_url_get_contents("https://api.soundcloud.com/i1/tracks/" . $result['id'] . "/streams?client_id=" . $key_api);
                    $stream_links = json_decode($stream_links, true);
                    $download_url = $stream_links['http_mp3_128_url'];
                    $audios = array();
                    $formatId = "http_mp3_128_url";
                    $link = array();
                    $format_data = array();
                    $format_data['order'] = 1;
                    $format_data['height'] = "empty";
                    $format_data['ext'] = "mp3";
                    $format_data['resolution'] = "Original";
                    $format_data['video'] = "false";
                    $format_data['video_only'] = "false";
                    $link['data'] = $format_data;
                    $link['formatId'] = $formatId;
                    $link['order'] = 1;
                    $link['url'] = $download_url;
                    $link['title'] = $title . "." . $format_data['ext'];
                    $link['size'] = "unknown";
                    array_push($audios, $link);
                    $data['audios'] = $audios;
                    $link["title"] = $title;
                    $link["source"] = "soundcloud";
                    $link["thumbnail"] = $data["image"];
                    $link["duration"] = $data["time"];
                    $i = 0;
                    foreach ($data["audios"] as $current) {
                        $link["data"][$i]["url"] 		= $current["url"];
                        $link["data"][$i]["format"] 	= "mp3";
                        $link["data"][$i]["size"] 		= PHP_file_size($link["data"][$i]["url"]);
                        $link["data"][$i]["quality"] 	= "128 kbps";
                        $i++;
                    }
                    return $link;
                }
            }
        }
    }
 
 
 
 


?>