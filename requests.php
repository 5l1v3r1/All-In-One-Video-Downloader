<?php
require_once './application/Connection.php';
	error_reporting(0);
	$search_url  			= PHP_Secure($_POST['search']);
	$more_stories 			= PHP_Secure($_POST['more_data_url']);
	$report_link 			= PHP_Secure($_POST['report_link']);
	$name_media 			= PHP_Secure($_POST['name_media']);
	$share_data 			= PHP_Secure($_POST['share_modal']);
	$download_file_modal 	= PHP_Secure($_POST['download_file_modal']);
	$data_api_url 			= PHP_Secure($_GET['data_api_url']);
	$requests_json 			= PHP_Secure($_GET['api_media']);
	if ($search_url){
//--		
		echo PHP_Url('youtube', $search_url, 'echo', true);
		
	}else if($download_file_modal){
//--		
		$load_url = PHP_Crypt_code($download_file_modal,true);
		$load_url = PHP_data_ShareUrl('url',$load_url,'','id');
		echo PHP_Url('youtube',$load_url,'echo', false);

	}else if($report_link){
		$load_data = PHP_Report_link($report_link, $name_media);
		if ($load_data == 200){
			echo $lang->message_link_ok;
		}else{
			echo 'error';
		}
	}else if($share_data){
//--		
		$data_id   = PHP_Crypt_code($share_data,true);
		$load_url  = PHP_data_ShareUrl('id_url',$data_id,'','id');
		$data_url  = PHP_data_ShareUrl('url',$data_id,'','id');
		$load_data = PHP_LoadPage('template/share_url', array(
						$CODE['ACTIVE_DATA_MODAL_OG'] = true,	
						$CODE['DATA_UTL_OG_META'] = $data_url,	
						$CODE['ACTIVE_DATA_MODAL'] = true,	
						'DATA_URL' => $config['site_url'].'/s/'.$load_url,	
						'DATA_URL_SHARE' => $config['site_url'].'/s/'.$load_url,	
						'DATA_URL_ORIGINAL' => $data_url,	
						'INFO_VIEWS_ALL_FACEBOOK' => PHP_data_ShareUrl('facebook',$data_id,'','id'),	
						'INFO_VIEWS_ALL_TWITTER' => PHP_data_ShareUrl('twitter',$data_id,'','id'),	
						'INFO_VIEWS_ALL_WHATSAPP' => PHP_data_ShareUrl('whatsapp',$data_id,'','id'),	
						'INFO_VIEWS_ALL_OTHER' => PHP_data_ShareUrl('other',$data_id,'','id'),	
						'INFO_VIEWS_ALL' => PHP_data_ShareUrl('views',$data_id,'','id'),	
					));
					
		echo $load_data;
	}else if($requests_json){
//---->		
		if ($data_api_url == '1234'){
			 
			$plugins_dir	 = "./admin-panel/files";
			$url_platform	 = base64_decode($requests_json);		
			$url	 		 = base64_decode($requests_json);		
			$urlparts		 = parse_url($url_platform);

			$scheme = $urlparts['scheme'];

			if ($scheme == 'https') {
				$true_url = true;
			} else if($scheme == 'http') {
				$true_url = true;
			} else {
				$true_url = false;
			}
			//--
			if ($true_url == true){
				if(PHP_GetMedia() == NULL){
					return_json('503'); 
				}else{
					$line_url 		= PHP_SYSTEM_url_get_contents($config['site_url'].'/requests.php?data_api_url=1234');
					
					//--> special function only for tumblr
					if(preg_match("/([^&]+)(.+)tumblr.com\/post\/([a-z1-9.-_]+)/", $url)){
						//$plugin_line 	= External_links($url_platform, PHP_key_user_tumblr(username_post_id($url_platform),$line_url));
						$plugin = strtolower('tumblr');
					}else{
						$plugin_line 	= External_links($url_platform, $line_url);
						$plugin = strtolower($plugin_line);
					}
					
					if ('tumblr' == NULL) {
						return_json($lang->not_service_media);
					}else{
						include($plugins_dir . "/" . $plugin ."/functions.php");
						
						$Data_media_Json = Data_media_Json($url);
						
						if (empty($Data_media_Json['data'][0]['url'])){
							return_json('503');
						}else{
							return_json(Data_media_Json($url_platform));
						}
					}	
				}	
			}else{
				return_json('503');
			}
			
		}else{
			@header("Location:./404");
			exit('<meta http-equiv="Refresh" content="0;url=./404">');
		}
	}else if($data_api_url){
		if ($data_api_url == '1234'){
			PHP_Get_url_line();
		}else{
			@header("Location:./404");
			exit('<meta http-equiv="Refresh" content="0;url=./404">');
		}
	}else if($more_stories){
		
		$user_id 		= PHP_UserData(array('value' => 'userID','direct_query' =>1,'loggedin' =>true));
		$data_id   		= PHP_Crypt_code($more_stories,true);
		
		// Count all records except already displayed
		$query = "SELECT COUNT(*) as num_rows FROM ".T_SHARE." WHERE IDuser = '$user_id' and  id < ".$data_id." ORDER BY id DESC";
		$sql_query   = mysqli_query($con, $query);
		$row = mysqli_fetch_assoc($sql_query);
		$totalRowCount = $row['num_rows'];
		$showLimit = 8;
		
		// Get records from the database
		$query = "SELECT * FROM ".T_SHARE." WHERE IDuser = '$user_id' and id < ".$data_id." ORDER BY id DESC LIMIT $showLimit";

		$sql_query   = mysqli_query($con, $query);
		$sql_numrows = mysqli_num_rows($sql_query);
		if ($sql_numrows > 0) {
			while ($row = mysqli_fetch_assoc($sql_query)) {
				$postID 		= $row['id'];
				$postID			= PHP_Crypt_code($postID,false);
				$data_share 	= $row['id_url'];
				$og_meta		= PHP_Get_Tags($row['url']);
				
				@include ("./themes/default/layout/template/list_urls_data.php");
			} 
		
			if($totalRowCount > $showLimit){ 
				@include ("./themes/default/layout/template/list_more_btn.php");
			} 
	
		}	
	}else{
		@header("Location:./404");
		exit('<meta http-equiv="Refresh" content="0;url=./404">');
	}
?>	