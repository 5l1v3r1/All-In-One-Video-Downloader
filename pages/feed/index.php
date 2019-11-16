<?php

if (isset($_GET['url'])) {
	$load->page        	= 'feed';
	@$page = PHP_Secure($_GET['page']);

	
	if($page == 'history'){
//--->history				
		$user_id 		= PHP_UserData(array('value' => 'userID','direct_query' =>1,'loggedin' =>true));
		
		$load->title       = $lang->history .' | ';
		$load->content 		= PHP_LoadPage('template/history',array(
				'LIST_DATA_HISTORY'			=>	PHP_LoadPage('template/list_urls',array(
				$CODE['GET_URLS_FUNCTION']   = PHP_GetStoriesUrls($user_id, 8),
				'CONTAINER_URL_HOME' => $site_url,
				)),
			)); 
	}else if($page == 'settings'){
//--->settings		
		$user_id 		= PHP_UserData(array('value' => 'userID','direct_query' =>1,'loggedin' =>true));
		$errors   		= array();
		$erros_final	= '';
		$username 		= '';
		$email    		= '';	
		$success		= '';
		
		if (!empty($_POST)) {
			if (empty($_POST['password']) || empty($_POST['email'])) {
				$errors[] = $lang->please_check_details;
			} else {
				
				$password        = PHP_Secure($_POST['password']);
				$r_password      = PHP_Secure($_POST['r_password']);
				$email        	 = PHP_Secure($_POST['email']);	
				
				
				if (PHP_UserEmailExists($_POST['email'])) {
					$errors[] =  $lang->email_exists;
				}
			
				if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
					$errors[] = $lang->email_invalid_characters;
				}
				
				if ($password != $r_password) {
					$errors[] = $lang->password_not_match;
				}
				
				if (strlen($password) < 4) {
					$errors[] = $lang->password_is_short;
				}
				
				$userID 	= PHP_UserData(array('value' => 'userID','direct_query' =>1,'loggedin' =>false));
				$password   = sha1($password);
				$ip 		= PHP_Get_Public_ip();
				
				$s 			= 3600000; // seconds in a year
				setcookie("m_user", trim($userID), time() + $s, '/', null, null, true);
				setcookie("m_session", trim($password), time() + $s, '/', null, null, true);
				
				$sql = "UPDATE ".T_USER." SET email='$email', password='$password', ip_user='$ip' WHERE userID='$userID'";
		        mysqli_query($con, $sql);
				
				
				
			}	
		}

		if (!empty($errors)) {
			foreach ($errors as $key => $error) {
				$erros_final .= $error . "<br>";
			}
		}
		
		
		$load->title       = $lang->Settings .' | ';
		$load->content = PHP_LoadPage('template/access_data', array(
			@$CODE['username'] = @$username,
				@$CODE['EMAIL'] = @$email,
				@$CODE['ERRORS'] = @$erros_final,
				@$CODE['SUCCESS'] = @$success,
				@$CODE['ACCESS']	= 'settings',
				'TEXT_BTN_BOM'	=> $lang->Settings,
			));
	}else if($page == 'password'){
//--->password	
		$errors   		= array();
		$erros_final	= '';
		$username 		= '';
		$email    		= '';	
		$success		= '';


		if (!empty($_POST)) {
			if (empty($_POST['email'])) {
				$errors[] = $lang->please_check_details;
			} else {
				
				$email        	 = PHP_Secure($_POST['email']);	
				
				if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
					$errors[] = $lang->email_invalid_characters;
				}
				
				if (PHP_UserEmailExists($_POST['email'])) {
					
					$sqli = mysqli_query($con,"SELECT * from ".T_USER." WHERE email = '$email'") or die ("error en la consulta". mysqli_connect_error()) ;
					if (mysqli_num_rows($sqli) > 0){
						
						$user = mysqli_fetch_array($sqli);
	
						$success 	= $lang->confirm_email;
						$key_login 	= PHP_GetKey(15,15);
						$userID 	= $user['userID'];
						$username 	= $user['username'];
						$sql = "UPDATE ".T_USER." SET  key_login='$key_login' WHERE userID='$userID'";
						mysqli_query($con, $sql);
						
						$data['EMAIL_CODE'] = $key_login;
						$data['USERID'] 	= PHP_Crypt_code($userID);
						$data['USERNAME'] 	= $username;
						$data['LOGO'] 		= $load->config->name;
						
						$send_email_data = array(
							'from_email' => $smtp_username,
							'from_name' => $load->config->name,
							'to_email' => $email,
							'to_name' => $username,
							'subject' => $lang->reset_password,
							'charSet' => 'UTF-8',
							'message_body' => PHP_LoadPage('template/email',$data),
							'is_html' => true
						);
						$send_message = PHP_Message_EMAIL($send_email_data);

					}else{
						$errors[] = $lang->incorrect_information;
					}
				}else{
					$errors[] = $lang->incorrect_information;
				}
				
			}
		}	

		if (!empty($errors)) {
			foreach ($errors as $key => $error) {
				$erros_final .= $error . "<br>";
			}
		}
			
		$load->title       = $lang->request_new_password .' | ';
		$load->content = PHP_LoadPage('template/access_data', array(
			@$CODE['username'] = @$username,
				@$CODE['EMAIL'] = @$email,
				@$CODE['ERRORS'] = @$erros_final,
				@$CODE['SUCCESS'] = @$success,
				@$CODE['ACCESS']	= 'password',
				'TEXT_BTN_BOM'	=> $lang->request_new_password,
			));
	}else if($page == 'login'){
//--->login		
		if (@$_COOKIE["m_user"]!='') {
			@header("Location:./");
			exit('<meta http-equiv="Refresh" content="0;url=./">');
		}
		
			$errors   		= array();
			$erros_final	= '';
			$username 		= '';
			$email    		= '';	
			$success		= '';
		if (!empty($_POST)) {
			if (empty($_POST['password']) || empty($_POST['email'])) {
				$errors[] = $lang->please_check_details;
			} else {
				
				if (empty($_POST['agree'])) {
					$errors[] = $lang->terms__privacy;
				}
				
				$password        = sha1(PHP_Secure($_POST['password']));
				$email        	 = PHP_Secure($_POST['email']);	
					
				$sqli = mysqli_query($con,"SELECT * from ".T_USER." WHERE email = '$email' AND password = '$password'") or die ("error en la consulta". mysqli_connect_error()) ;
				if (mysqli_num_rows($sqli) > 0){
					$user = mysqli_fetch_array($sqli);
				
					$user_id 	= PHP_Crypt_code($user['userID']);
					$s 			= 3600000; // seconds in a year
					setcookie("m_user", trim($user_id), time() + $s, '/', null, null, true);
					setcookie("m_session", trim($user['password']), time() + $s, '/', null, null, true);
					@header("Location:./");
					exit('<meta http-equiv="Refresh" content="0; url=./">');
					
				}else{
					$errors[] = $lang->incorrect_information;
				}
			}
		}	
		
		if (!empty($errors)) {
			foreach ($errors as $key => $error) {
				$erros_final .= $error . "<br>";
			}
		}
		
		$load->title       = $lang->login .' | ';
		$load->content = PHP_LoadPage('template/access_data', array(
			@$CODE['username'] = @$username,
				@$CODE['EMAIL'] = @$email,
				@$CODE['ERRORS'] = @$erros_final,
				@$CODE['SUCCESS'] = @$success,
				@$CODE['ACCESS']	= 'login',
				'TEXT_BTN_BOM'	=> $lang->login,
			));
		
	}else if($page == 'register'){
//--->register
		if (@$_COOKIE["m_user"]!='') {
			@header("Location:./");
			exit('<meta http-equiv="Refresh" content="0;url=./">');
		}
		
			$errors   		= array();
			$erros_final	= '';
			$username 		= '';
			$email    		= '';	
			$success		= '';
		if (!empty($_POST)) {
			if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
				$errors[] = $lang->please_check_details;
			} else {
				$username        = PHP_Secure($_POST['username']);
				$password        = PHP_Secure($_POST['password']);
				$email        	 = PHP_Secure($_POST['email']);
			
				if (PHP_UsernameExists($_POST['username'])) {
					$errors[] =  $lang->username_is_taken;
				}

				if (!preg_match('/^[\w]+$/', $_POST['username'])) {
					$errors[] = $lang->username_invalid_characters;
				}
				
				if (PHP_UserEmailExists($_POST['email'])) {
					$errors[] =  $lang->email_exists;
				}
			
				if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
					$errors[] = $lang->email_invalid_characters;
				}
			
				if (empty($_POST['agree'])) {
					$errors[] = $lang->terms__privacy;
				}
				
				$code_pass = sha1($password);
				
				if (empty($errors)) {
					
					$ip 	= PHP_Get_Public_ip();
					$time 	= time();
					$active	= '1';
					
					$sqli = "INSERT INTO ".T_USER." (username,password,email,active,ip_user,time) VALUES ('$username','$code_pass','$email','$active','$ip','$time')";
					$data = mysqli_query($con, $sqli);
					if (!$data){
						$errors[] = $lang->we_have_a_problem;
					}else{
						$data_user = mysqli_query($con,"SELECT * from ".T_USER." WHERE username = '$username' AND password = '$code_pass'") or die ("error en la consulta". mysqli_connect_error()) ;
						if (mysqli_num_rows($data_user) > 0){
							$data 		= mysqli_fetch_array($data_user);
							$user_id 	= PHP_Crypt_code($data['userID']);
							$s 			= 3600000; // seconds in a year
							setcookie("m_user", trim($user_id), time() + $s, '/', null, null, true);
							setcookie("m_session", trim($data['password']), time() + $s, '/', null, null, true);
							@header("Location:./");
							exit('<meta http-equiv="Refresh" content="0;url=./">');
						}
					}	
				}	
			}
		}	
		
		if (!empty($errors)) {
			foreach ($errors as $key => $error) {
				$erros_final .= $error . "<br>";
			}
		}
		
		$load->title       = $lang->register .' | ';
		$load->content = PHP_LoadPage('template/access_data', array(
			@$CODE['username'] = @$username,
				@$CODE['EMAIL'] = @$email,
				@$CODE['ERRORS'] = @$erros_final,
				@$CODE['SUCCESS'] = @$success,
				@$CODE['ACCESS']	= 'register',
				'TEXT_BTN_BOM'	=> $lang->register,
			));
		
		
	}else if($page == 'activate'){
//--->activate
		$errors   		= array();
		$erros_final	= '';
		$username 		= '';
		$email    		= '';	
		$success		= '';
	
		$KEY 	= PHP_Secure($_GET['key']);
		$USERID = PHP_Secure(PHP_Crypt_code($_GET['user'],true));
		
		$data_user = mysqli_query($con,"SELECT * from ".T_USER." WHERE key_login = '$KEY' and userID='$USERID'") or die ("error en la consulta". mysqli_connect_error()) ;
		if (mysqli_num_rows($data_user) > 0){
			$data 		= mysqli_fetch_array($data_user);
			$user_id 	= PHP_Crypt_code($data['userID']);
			$userID 	= $data['userID'];
			
			$sql = "UPDATE ".T_USER." SET key_login='null' WHERE userID='$userID'";
			mysqli_query($con, $sql);
			
			$s 			= 3600000; // seconds in a year
			setcookie("m_user", trim($user_id), time() + $s, '/', null, null, true);
			setcookie("m_session", trim($data['password']), time() + $s, '/', null, null, true);
			@header("Location:".$site_url."/me/settings");
			exit('<meta http-equiv="Refresh" content="0;url='.$site_url.'/me/settings">');
		}else{
			$errors[] =  $lang->confirm_email_error;
		}				

		if (!empty($errors)) {
			foreach ($errors as $key => $error) {
				$erros_final .= $error . "<br>";
			}
		}
		
		$load->title       = $lang->request_new_password .' | ';
		$load->content = PHP_LoadPage('template/access_data', array(
			@$CODE['username'] = @$username,
				@$CODE['EMAIL'] = @$email,
				@$CODE['ERRORS'] = @$erros_final,
				@$CODE['SUCCESS'] = @$success,
				@$CODE['ACCESS']	= 'password',
				'TEXT_BTN_BOM'	=> $lang->request_new_password,
			));
	}else if($page == 'logout'){
//--->logout			
		$s = '-0';
		setcookie("m_user", trim(''), time() + $s, '/', null, null, true);
		setcookie("m_session", trim(''), time() + $s, '/', null, null, true);
		@header("Location:./");
		exit('<meta http-equiv="Refresh" content="0;url=./">');
		
	}else{
		header("Location:../");
		exit();
	}			 
	 
}else{
	header("Location:../");
	exit();
}