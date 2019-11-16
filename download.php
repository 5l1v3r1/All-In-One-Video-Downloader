<?php
	require_once './application/system/function_security.php'; 
	error_reporting(0);
	
	function PHP_Secure($string, $censored_words = 1) {
		global $con,$config;
		$string = trim($string);
		$string = htmlspecialchars($string, ENT_QUOTES,'UTF-8');
		$string = str_replace('\r\n', " <br>", $string);
		$string = str_replace('\n\r', " <br>", $string);
		$string = str_replace('\r', " <br>", $string);
		$string = str_replace('\n', " <br>", $string);
		$string = str_replace('&amp;#', '&#', $string);
		$string = stripslashes($string);
		if ($censored_words == 1) {
			 
			@$censored_words = @explode(",", $config['censored_words']);
			foreach ($censored_words as $censored_word) {
				$censored_word = trim($censored_word);
				$string        = str_replace($censored_word, '****', $string);
			}
		}
		return $string;
	}
	
	function format_size($bytes){
		switch ($bytes) {
			case $bytes < 1024:
				$size = $bytes . " B";
				break;
			case $bytes < 1048576:
				$size = round($bytes / 1024, 2) . " KB";
				break;
			case $bytes < 1073741824:
				$size = round($bytes / 1048576, 2) . " MB";
				break;
			case $bytes < 1099511627776:
				$size = round($bytes / 1073741824, 2) . " GB";
				break;
		}
		if (!empty($size)) {
			return $size;
		} else {
			return "";
		}
	}
	
	function PHP_file_size($url){
		$headers = get_headers($url, 1);
		if (is_array($headers) && count($headers) > 0) {
			$size = $headers['Content-Length'];
			if (is_array($size)) {
				foreach ($size as $value) {
					if ($value != 0) {
						$size = $value;
						break;
					}
				}
			}
			if ($format === true) {
				return format_size($size);
			} else {
				return $size;
			}
			
		} else {
			return "unknown";
		}
	}
	
	function PHP_clear_string($data){
		$data = stripslashes(trim($data));
		$data = strip_tags($data);
		$data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
		return $data;
	}

	function PHP_xss_clean($data){
		$data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
		return $data;
	}
	
	function sanitize_filename($string, $type = 'mp4'){
		//$string = htmlentities($string, ENT_QUOTES, 'UTF-8');
		$string = preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', $string);
		//$string = html_entity_decode($string, ENT_QUOTES, 'UTF-8');
		//$string = preg_replace(array('~[^0-9a-z]~i', '~[ -]+~'), ' ', $string);
		if (empty(trim($string, ' -'))) {
			$name = generate_string();
		} else {
			$name = $string;
		}
		if ($type == NULL) {
			$file_name = $name . ".mp4";
		}else{
			$file_name = $name . "." . $type;
		}
		
		return str_replace(array("\r", "\n"), "", $string = utf8_decode(mb_substr($file_name, 0, 400, "UTF-8")));
	}

	function generate_string($length = 10){
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	

	//-- with the base64() function we use it to avoid errors of special carat	
	$headers_url 	= PHP_DatesCrypt('decrypt', $_GET["url_video"]);//-- id with the video link
	$headers_title 	= str_replace(" ", "_", $_GET["title"]);//-- id with the name of the video	
	$Formats 		= $_GET["type_format"];
	

	//-- here ends the name of the video with the format
	$fileName = PHP_clear_string(PHP_xss_clean($headers_title));
	$fileName = html_entity_decode($headers_title, ENT_QUOTES, "UTF-8");
	$fileName = utf8_encode($fileName);
	
	$context_options = array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
        ),
    );
 
	if(!empty($_GET)){
		//-- Define headers
		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header('Content-Disposition: attachment; filename="' . sanitize_filename($fileName, $Formats) . '"');
		header("Content-Type: video/$Formats charset=utf-8");
		header("Content-Transfer-Encoding: binary");
		header('Expires: 0');
		header('Pragma: no-cache');
		
		
/* 		header('Content-Disposition: attachment; filename="' . sanitize_filename($fileName, $Formats) . '"');
		header("Content-Transfer-Encoding: binary");
		header('Expires: 0');
		header('Pragma: no-cache'); */
		if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE) {
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
		}
		/*
			$filesize = PHP_file_size($headers_url);
			if ($filesize > 0) {
				header('Content-Length: ' . $filesize);
			}
		*/
		//-- Read the file
		//readfile($headers_url);
		ob_clean();
		ob_end_flush();
		readfile($headers_url, "", stream_context_create($context_options));
		exit;
	}else{
		@header("Location:./");
		exit('<meta http-equiv="Refresh" content="0;url=./">');
		echo 'error';
	}
?>
