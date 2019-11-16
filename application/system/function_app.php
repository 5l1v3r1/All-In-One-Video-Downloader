<?php
require_once('conectarBD.php');
require('core/cURL.php');
require('core/reason_phrases.php');
 
	
	// 
	function PHP_LoadPage($page_url = '', $data = array(), $set_lang = true) {
		global $load, $lang_text, $lang, $config, $add_action, $CODE,$text_media, $text_media_two, $text_media;
		$page         = './themes/' . $config['theme'] . '/layout/' . $page_url . '.php';
		if (!file_exists($page)) {
			return false;
		}
		$page_content = '';
		ob_start();
		require($page);
		$page_content = ob_get_contents();
		ob_end_clean();
	    if ($set_lang == true) {
			$page_content = preg_replace_callback("/{{LANG (.*?)}}/", function($m) use ($lang_text) {
				return (isset($lang_text[$m[1]])) ? $lang_text[$m[1]] : '';
			}, $page_content);
		}
 
		if (!empty($data) && is_array($data)) {
			foreach ($data as $key => $replace) {
					$object_to_replace = "{{" . $key . "}}";
					@$page_content      = str_replace($object_to_replace, $replace, $page_content);
			}
		}

		#-->
		$page_content = preg_replace("/{{LINK (.*?)}}/", PHP_Link("$1"), $page_content);
		$page_content = preg_replace_callback("/{{CONFIG (.*?)}}/", function($m) use ($config) {
			return (isset($config[$m[1]])) ? $config[$m[1]] : '';
		}, $page_content);
 
		return $page_content;
	}
//-- 
	function PHP_Link($string) {
		global $site_url;
		return $site_url . '/' . $string;
	}
//--
	function PHP_Slug($string, $video_id) {
		global $load;
		if ($load->config->seo_link != 'on') {
			return $video_id;
		}
		$slug = url_slug($string, array(
			'delimiter' => '-',
			'limit' => 100,
			'lowercase' => true,
			'replacements' => array(
				'/\b(an)\b/i' => 'a',
				'/\b(example)\b/i' => 'Test'
			)
		));
		return $slug . '_' . $video_id . '.html';
	} 
//--
	function PHP_SeoLink($query = '') {
		global $load, $config;
		if ($config['seoLink'] == 1) {
			$query = preg_replace(array(
				'/^index\.php\?url=profile&u=([A-Za-z0-9_]+)&type=([A-Za-z0-9_]+)$/i',
			), array(
				$site_url . '/$1/$2',
				$site_url,
			), $query);
		} else {
			$query = $config['site_url'] . '/' . $query;
		}
		return $query;
	}
//--
	function ToArray($obj) {
		if (is_object($obj))
			$obj = (array) $obj;
		if (is_array($obj)) {
			$new = array();
			foreach ($obj as $key => $val) {
				$new[$key] = ToArray($val);
			}
		} else {
			$new = $obj;
		}
		
		return $new;
	}
//-- 
	function PHP_SYSTEM_url_get_contents($url){
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
		return $data;
	}	
//-- 	
	function ToObject($array) {
		$object = new stdClass();
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				$value = ToObject($value);
			}
			if (isset($value)) {
				$object->$key = $value;
			}
		}
		return $object;
	}
//--	
	function websites_supported() {
		global $con;
		$pedir =  mysqli_query($con,"SELECT count(*) as cuenta from platform_media");
		$res = mysqli_fetch_assoc($pedir);
		
		return (string)$res["cuenta"];
	}	
	// This function is to prevent special characters
	function PHP_Secure($string, $censored_words = 1) {
		global $con,$config;
		$string = trim($string);
		$string = mysqli_real_escape_string($con, $string);
		$string = htmlspecialchars($string, ENT_QUOTES,'UTF-8');
		$string = str_replace('\r\n', " <br>", $string);
		$string = str_replace('\n\r', " <br>", $string);
		$string = str_replace('\r', " <br>", $string);
		$string = str_replace('\n', " <br>", $string);
		$string = str_replace('&amp;#', '&#', $string);
		$string = stripslashes($string);
		if ($censored_words == 1) {
			global $con;
			@$censored_words = @explode(",", $config['censored_words']);
			foreach ($censored_words as $censored_word) {
				$censored_word = trim($censored_word);
				$string        = str_replace($censored_word, '****', $string);
			}
		}
		return $string;
	}
	
	// Configuration of data in the Templates and in the Insertion of data 
	function PHP_GetConfig() {
		global $db;
		$data  = array();
		$configs = $db->get(T_CONFIG);
		foreach ($configs as $key => $config) {
			$data[$config->name] = $config->value;
		}
		return $data;
	}
//-- 
	function PHP_file_size_2($bytes){
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
//-- 
	function PHP_file_size($url, $format = true){
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
				return PHP_file_size_2($size);
			} else {
				return $size;
			}
		} else {
			return "unknown";
		}
	}
//-- 
	function PHP_Format_video($Format){
		$url = PHP_Secure($Format);
		//-- with this function is to know the format of the video
		preg_match("/.(3gp|3GP|mp4|MP4|flv|FLV|m4a|M4A|avi|AVI|webm|WebM|wmv|WMV|mov|MOV|h264|H264|mkc|MKV|3gpp|3GPP|mpegps|MPEGPS|mpeg4|MPEG4|gifv|GIFV|jpg|JPG|jpeg|JPEG|png|PNG|icon|ICON|gif|GIF|mp3|MP3)/", $url, $check);
		if (@$check[1] == 'H264'&&'h264'){
			$Formats = 'mp4';
		}else if(@$check[0] == null){
			$Formats = 'mp4';
		}else if(@$check[0] == 'M4A'&&'m4a'){
			$Formats = 'mp3';			
		}else{	
			$Formats = $check[1];
		}
		return strtoupper($Formats);
	}
//--
    function PHP_string_between($string, $start, $end){
        $string = " " . $string;
        $ini = strpos($string, $start);
        $eni = strpos($string, $end);
        if ($ini == 0 || $eni == 0) return "";
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }	
//--	
	function br2nl($st) {
		$breaks = array("<br />","<br>","<br/>");  
		return str_ireplace($breaks, "\r\n", $st);
	}
	
//-- This function allows us to know the metadata of the sites
	function PHP_Get_Tags($url) {
		 
		@$html = PHP_SYSTEM_url_get_contents($url);
		 
		@libxml_use_internal_errors(true);
		$dom = new DomDocument();
		@$dom->loadHTML($html);
		$xpath = new DOMXPath($dom);
		$query = '//*/meta[starts-with(@property, \'og:\')]';
		$result = $xpath->query($query);
		
		foreach ($result as $meta) {
			$property = $meta->getAttribute('property');
			$content = $meta->getAttribute('content');
		
			// replace og
			$property = str_replace('og:', '', $property);
			$list[$property] = $content;
		}
			
		return @$list;
	}		 
//--
	function PHP_GetMedia($limit = ''){
		global $con;
		
		$data = array();
	
		if ($limit == NULL){
			$query = "SELECT * FROM " . T_MEDIA . " ORDER BY key_plugin ";
		}else{
			// DESC
			$query = "SELECT * FROM " . T_MEDIA . " ORDER BY key_plugin LIMIT {$limit}";
		}	

		$sql_query   = mysqli_query($con, $query);
		$sql_numrows = mysqli_num_rows($sql_query);
		if ($sql_numrows > 0) {
			while ($sql_fetch = mysqli_fetch_assoc($sql_query)) {
				if ($sql_fetch['active'] == 0){
					
				}else{
					$sql_fetch['data'] 	= $sql_fetch['id'];
					$data[]           	= $sql_fetch;
				}
				
			}
		}
		return $data;
	}
//--
	function PHP_Active_Media($data){
		global $con;
	
			$pedir = mysqli_query($con,"Select * From " . T_MEDIA . " WHERE  url_line LIKE '%$data%'");
			while($fila = mysqli_fetch_array($pedir)){
							 
				if($fila['active'])
				{	
					return $fila['platform'];
				}
			}
	}
//--
	function External_links($Link_info, $Url_line = NULL){
			global $PHP_Error;
		$content = $Url_line;
		
		
        if (preg_match_all('#"url_line":[^"]*"([^"]*)"#', $content, $resultado)) {
            $mp = $resultado[1];   
        } else {
			// No Content
            $mp = $PHP_Error->_204; 
        }
        $result = FALSE;// este mensaje de error
		
        foreach ($mp as $nombre) {
            if(isset($Link_info)) :
                $url = $Link_info;    
                if(preg_match($nombre, $url)) {  
					$data = str_ireplace("www.", "", parse_url($url, PHP_URL_HOST));				
                    $result = PHP_Active_Media($data);
                }
            endif;///
        }
        return $result;
    }
//--
	function return_json($array){
		
			header('Content-Type: application/json');
			echo json_encode($array);
			die();
		
	}
//--
	function username_post_id($url){
		
		$username = explode('.', str_ireplace("www.", "", parse_url($url, PHP_URL_HOST)))[0];  
        return $username;
        
    }
//-- tumblr
	function PHP_key_user_tumblr($text = null, $url_line){

		if($text == null){
			$data = $text;
		}else{
			$data = str_replace( 'line_tumblr', $text, $url_line );
			if ($data == true){
				$data = str_replace( $text.'.tumblr.com', 'tumblr.com', $data );
			}else{
				$data = str_replace( $text.'.tumblr.com', 'tumblr.com', $data );
			}
		}
				
		return $data;
				
	}	
//--
	function PHP_Get_url_line(){
	global $con;
		$sql = mysqli_query($con,"SELECT * FROM ".T_MEDIA."");
		while($fila = mysqli_fetch_array($sql)){
			$data = $fila['url_line'];
			
			$path = str_replace( '/', '\/', $data );
			$path = str_replace( ':"\/', ':"/', $path );
			$path = str_replace( '\/";', '/";', $path );
			 
			echo $path;
		}
		
	}
//-- 

	function PHP_Url($media = null, $url = null, $value, $share_data = true){
		global $con, $lang, $CODE, $config, $_COOKIE, $data_yt;
		error_reporting(e_all);
		$plugins_dir	 = "./admin-panel/files";
		//$lang_found 	 = 0;
		$url_platform	 = PHP_Secure($url);
		$Error_platform  = PHP_LoadPage('template/report_link_html', array(
									$CODE['ERROR_MESSAGE_LINKS']  = 'Error_data_url',
								));
								
		$urlparts 		 = parse_url($url_platform);
		$scheme			 = $urlparts['scheme'];

		if ($scheme == 'https') {
			$true_url = true;
		} else if($scheme == 'http') {
			$true_url = true;
		} else {
			$true_url = false;
		}
	   //-->
		if ($true_url == true){
			if (@$_COOKIE["m_user"]!='') {
				@$Uid 	= PHP_Secure(PHP_Crypt_code($_COOKIE['m_user'],true));
			}else{
				@$Uid 	= 0;
			}
	   //-->
			if(PHP_GetMedia() == NULL){
				echo $Error_platform;
			}else{	
				//-->
					if ($url_platform == NULL){
						$line = $Error_platform;
					}else{	
						$line_url 		= PHP_SYSTEM_url_get_contents($config['site_url'].'/requests.php?data_api_url=1234'); 
					//--> special function only for tumblr
						if(preg_match("/([^&]+)(.+)tumblr.com\/post\/([a-z1-9.-_]+)/", $url)){
							//$plugin_line 	= External_links($url_platform, PHP_key_user_tumblr(username_post_id($url_platform),$line_url));
							$plugin = strtolower('tumblr');
					//--> special function only for bandcamp					
						}else if(preg_match("/([^&]+)(.+)bandcamp.com\/track\/([a-z1-9.-_]+)/", $url)){
							$plugin = strtolower('bandcamp');
						}else{
							$plugin_line 	= External_links($url_platform, $line_url);
							$plugin = strtolower($plugin_line);
						}
					//-->
						if ($plugin == null){
							$line = $Error_platform;
						}else{
							# Code
							include($plugins_dir . "/" . $plugin ."/functions.php");
							@$Data_media_Json = Data_media_Json($url);
							if (empty($Data_media_Json['data'][0]['url'])){
							# Report_link	
								$Report_link 	 = PHP_LoadPage('template/report_link_html', array(
									$CODE['ERROR_MESSAGE_LINKS'] = 'Report_link',
									'REPORT_URL_DATA' => $url_platform,
									'REPORT_PLATFORM_DATA' => $plugin,
								));
								$line = $Report_link;
							}else{
							# Code	
								if($share_data){
								$CODE['SHARE_EXTENSION'] = PHP_LoadPage('template/share_url', array(
										'DATA_URL' => $config['site_url'].'/s/'.PHP_data_ShareUrl_INSERT($url, $share_data, $Uid, $plugin),	
									));
								}
							# Code						
								@$CODE['GET_URL_VALUE_TITLE'] 		= $Data_media_Json['title'];
								@$CODE['GET_URL_VALUE_THUMBNAIL']	= $Data_media_Json['thumbnail'];
								@$CODE['GET_URL_PLATFORM_MEDIA'] 	= $Data_media_Json['data'];
								@$CODE['GET_DIRECT_DOWNLOAD'] 		= $Data_media_Json['direct_download'];
								
								$line = PHP_LoadPage('template/platform_html'); 
							}
						}
					}	
				$result = $line;
			}
		}else{
			$result = $Error_platform;
		}
		return $result;
	}

//--

function displayLangSelect($lang) {
		global $lang,$config;
		
		$languages_dir = "application/langs/"; //-- languages  folder 
		$lang_found = 0;
		
		if (is_dir($languages_dir)) {
			
			if ($dh = opendir($languages_dir)) {
				
				$i = 0;
				while (($file = readdir($dh)) !== false) {
					
					if (substr($file,-1) != "." && pathinfo($file, PATHINFO_EXTENSION) == "php") {
						
						$i++;
						
						$file_name = $file;
						
						// Open file to get language name
						include($languages_dir . "/" . $file_name);
						
						$lang_found = 1;
						
						// Strip extension
						$file_name = preg_replace("/\..*$/", "", $file_name);

							$line =  '';
						if ($file_name == $lang)
							$line .= "";
							$line .= "";
							$line .= '<a href="'.$config['site_url'].'/lang/'.$url_lang.'"><li><span><img class="class_flag_icons" src="'.$img_lang.'"></img> '.$name_lang.'</span></li></a>';
							
						$langsAr[] = $line; 

					}
				}
				closedir($dh);
				
				if ($lang_found == 0) {
					
					echo "Error: <strong>languages</strong> folder empty!";
					
				} else {
					
					if ($i > 0) {
						
						sort($langsAr);
						
						echo "";
						echo "<div>";
						foreach ($langsAr AS $lang) {
							echo $lang;
						}
						echo "</div>";
						
					} else {
						echo "<input type=\"hidden\" name=\"lang\" value=\"" . $file_name . "\">";
					}
				}

			} else {
				
				echo "Error: <strong>languages</strong> folder locked!";
			}
			
		} else {
			echo "Error: <strong>languages</strong> folder missing!";
		}
	}	 
//--
	function PHP_GetKey($minlength = 20, $maxlength = 20, $uselower = true, $useupper = true, $usenumbers = true, $usespecial = false) {
		$charset = '';
		if ($uselower) {
			$charset .= "abcdefghijklmnopqrstuvwxyz";
		}
		if ($useupper) {
			$charset .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		}
		if ($usenumbers) {
			$charset .= "123456789";
		}
		if ($usespecial) {
			$charset .= "~@#$%^*()_+-={}|][";
		}
		if ($minlength > $maxlength) {
			$length = mt_rand($maxlength, $minlength);
		} else {
			$length = mt_rand($minlength, $maxlength);
		}
		$key = '';
		for ($i = 0; $i < $length; $i++) {
			$key .= $charset[(mt_rand(0, strlen($charset) - 1))];
		}
		return $key;
	}
//--
	function PHP_Get_Public_ip(){
		$externalContent = file_get_contents('http://checkip.dyndns.com/');
		preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', $externalContent, $m);
		$externalIp = $m[1];
		return $externalIp;
	}
//--
	function PHP_Verify_url($clave){
		global $con;
		$data	= array();
		$sqli 	= mysqli_query($con,"SELECT * from ".T_SHARE." WHERE id_url = '$clave'");
		$data 	= mysqli_fetch_array($sqli);
		return ($clave == $data['id_url'])? $clave: 'ok';	 
	}
//--
	/* 
		PHP_data_ShareUrl('','INSERT');
	*/
	function PHP_data_ShareUrl_INSERT($url = 0, $value = true, $userID = 0, $platform){
		global $con;
		if (@$url!='') {
			$sqli = mysqli_query($con,"SELECT * from ".T_SHARE." WHERE IDuser = '$userID'") or die ("error en la consulta". mysqli_connect_error()) ;
			$data = mysqli_fetch_array($sqli);
		# if the url is from an anonymous user it will always be the same url key
			if ($data['url'] == $url){
				$code = $data['id_url'];
			}else{	
				if ($value){
					$Key_code	= PHP_GetKey(15,15);
					$Key		= ($Key_code == PHP_Verify_url($Key_code))? PHP_GetKey(12,12) . '___ok': PHP_GetKey(15,15);
					$ip_user	= PHP_Get_Public_ip();
					$time		= time();
					$views		= '0';
					$sqli		= "INSERT INTO ".T_SHARE." (url,id_url,ip_user,time,views,IDuser,platform)VALUES ('$url','$Key','$ip_user','$time','$views','$userID','$platform');";
					mysqli_query($con, $sqli);
					$code 		= $Key;
				}	
				
			}
			return @$code;			
		} else {
			header("Location:../404");
			exit();
		} 	
	}
//--
	function PHP_data_ShareUrl($value, $redir, $social = '', $data_id = 'id_url'){
		global $con;
	
		($data_id == 'id') ? $info = 'id' : $info = 'id_url';
		
		$data= array();
		if (@$redir!='') {
			$sqli = mysqli_query($con,"SELECT * from ".T_SHARE." WHERE $info = '$redir'") or die ("error en la consulta". mysqli_connect_error()) ;
			if (mysqli_num_rows($sqli) > 0) {
				$data = mysqli_fetch_array($sqli, MYSQLI_ASSOC);
	
				switch ($social) {
					//-- here are created the new chats
					case 'facebook':
						$red_social = 'facebook';
					break;
					case 'twitter':
						$red_social = 'twitter';
					break;
					case 'whatsapp':
						$red_social = 'whatsapp';
					break;
					case 'vk':
						$red_social = 'vk';
					break;
					case 'downloads':
						$red_social = 'downloads';
					break;
					default: 
						$red_social = 'other';
					break;
				}
				
				$views = $data['views']+1;
				$red_views = $data[$red_social]+1;
				$sqli = "UPDATE ".T_SHARE." SET views='$views', $red_social='$red_views' WHERE id_url = '$redir'";
				mysqli_query($con, $sqli);
				$return = $data[$value];
			}else{
				$return = '';
			} 
			
			return @$return;
		} else {
			header("Location:../404");
			exit();
		} 
	
	}
//--
	function PHP_GetStoriesUrls($user, $limit = 5){
		global $con;
		
		$data = array();
		if (empty($user)) {
			return false;
		}
		if (empty($limit) or !is_numeric($limit) or $limit < 1) {
			$limit = 5;
		}
		
		$query = "SELECT * from ".T_SHARE." WHERE IDuser = '$user' ORDER BY id DESC LIMIT {$limit}";
		
		$sql_query   = mysqli_query($con, $query);
		$sql_numrows = mysqli_num_rows($sql_query);
		if ($sql_numrows > 0) {
			while ($sql_fetch = mysqli_fetch_assoc($sql_query)) {
				$sql_fetch['data'] 	= $sql_fetch['url'];
				$data[]           	= $sql_fetch;
			}
		}
		return $data;
	}
//--
	function PHP_URL_MEDIA_DATA($data = false){
		global $con;
		
		$sqli = mysqli_query($con,"SELECT * from ".T_MEDIA." WHERE platform = '$data'") or die ("error en la consulta". mysqli_connect_error()) ;
		if (mysqli_num_rows($sqli) > 0){
			$info = true;
		}else{
			$info = false;
		}
		return $info;
	}
//--
	function PHP_Report_link($url, $platform){
		global $con;
		$data_1 = PHP_Secure($url);
		$data_2 = PHP_Secure($platform);
		$data_3 = time();
		$data_4 = PHP_Get_Public_ip();
		$sqli		= "INSERT INTO ".T_REPORT_LINK." (report_link,platform,time,ip_user)VALUES ('$data_1','$data_2','$data_3','$data_4');";
		mysqli_query($con, $sqli);
		if (!$sqli){
			$data_return = 204;
		}else{
			$data_return = 200;
		}	
		return $data_return;
	}	
?>