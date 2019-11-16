<?php
#----> key to encrypt E-mail
define('EMAIL_CRYPT_CODE', '1234_PASS');

#----> key to encrypt Media URL's
define('MEDIA_CRYPT_CODE', '1234_PASS_URL_MEDIA');


//--
    function PHP_DatesCrypt($action, $string) {
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$secret_key = 'zhareiv';
		$secret_iv = '123456789';
		// hash
		$key = hash('sha256', $secret_key);
		
		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);
		if ( $action == 'encrypt' ) {
			$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);
		} else if( $action == 'decrypt' ) {
			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		}
		return $output;
	}
//--
	function PHP_Crypt_code($in, $to_num = false, $pad_up = false, $pass_key = null) {
		$out   =   '';
		$index = 'abcdefghijklmnopqrstuvwxyz';
		$index.= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$index.= '0123456789';
		$base  = strlen($index);

		if ($pass_key !== null) {

			for ($n = 0; $n < strlen($index); $n++) {
				$i[] = substr($index, $n, 1);
			}

			$pass_hash = hash('sha256',$pass_key);
			$pass_hash = (strlen($pass_hash) < strlen($index) ? hash('sha512', $pass_key) : $pass_hash);

			for ($n = 0; $n < strlen($index); $n++) {
				$p[] =  substr($pass_hash, $n, 1);
			}

			array_multisort($p, SORT_DESC, $i);
			$index = implode($i);
		}

		if ($to_num) {
			// Digital number  <<--  alphabet letter code
			$len = strlen($in) - 1;

			for ($t = $len; $t >= 0; $t--) {
				@$bcp = bcpow($base, $len - $t);
				@$out = $out + strpos($index, substr($in, $t, 1)) * $bcp;
			}

			if (is_numeric($pad_up)) {
				$pad_up--;

				if ($pad_up > 0) {
					$out -= pow($base, $pad_up);
				}
			}
		} else {
			// Digital number  -->>  alphabet letter code
			if (is_numeric($pad_up)) {
				$pad_up--;

				if ($pad_up > 0) {
					$in += pow($base, $pad_up);
				}
			}

			for ($t = ($in != 0 ? floor(log($in, $base)) : 0); $t >= 0; $t--) {
				$bcp = bcpow($base, $t);
				@$a   = floor($in / $bcp) % $base;
				$out = $out . substr($index, $a, 1);
				@$in  = $in - ($a * $bcp);
			}
		}

		return $out;
	}
//--
function PHP_UserData($data_request = array('value' => '', 'direct_query' => 0, 'loggedin' => true)){
		global $con;
		
		#$value, $private_request = true, $loggedin = true
		$data	= array();
		@$value = PHP_Secure($data_request['value']);
		@$pass 	= PHP_Secure($_COOKIE['m_session']);
		@$Uid 	= PHP_Secure(PHP_Crypt_code($_COOKIE['m_user'],true));
			
		if (@$pass!='' and @$Uid!='') {
				
			$query = "SELECT * from ".T_USER." WHERE password = '$pass' AND userID = '$Uid'";
			$sql_query = mysqli_query($con,$query) or die ("error en la consulta". mysqli_connect_error()) ;
					
			if (mysqli_num_rows($sql_query) > 0) {
				$data = mysqli_fetch_array($sql_query, MYSQLI_ASSOC);
			}else{
				$s = '-0';
				setcookie("m_user", trim(''), time() + $s, '/', null, null, true);
				setcookie("m_session", trim(''), time() + $s, '/', null, null, true);
				@header("Location:./");
				exit('<meta http-equiv="Refresh" content="0;url=./">');
				
			}
				
			if ($data['locked']) {
				exit ('Error: Su cuenta se encuentra desactivada');
			}
			
		}elseif($data_request['loggedin'] == 1){
			setcookie('m_user', '', time()-1);
			@header("Location:./");
			exit('<meta http-equiv="Refresh" content="0;url=./">');
		}

		if (!empty($data_request['direct_query']) == 1){
			return @$data[$value];
		}else{
			return @$data;
		}
	} 
//--
	function PHP_Message_EMAIL($data = array()) {
		global $load, $con, $mail, $smtp_or_mail, $smtp_host, $smtp_username, $smtp_password, $smtp_encryption, $smtp_port;
		
		$email_from      = $data['from_email'] = PHP_Secure($data['from_email']);
		$to_email        = $data['to_email'] = PHP_Secure($data['to_email']);
		$subject         = $data['subject'];
		$data['charSet'] = PHP_Secure($data['charSet']);
		if (@$smtp_or_mail == 'mail') {
			$mail->IsMail();
		} else if (@$smtp_or_mail == 'smtp') {
			$mail->isSMTP();
			$mail->Host        = $smtp_host;
			$mail->SMTPAuth    = true;
			$mail->Username    = $smtp_username;
			$mail->Password    = $smtp_password;
			$mail->SMTPSecure  = $smtp_encryption;
			$mail->Port        = $smtp_port;
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);
		} else {
			return false;
		}
		$mail->IsHTML($data['is_html']);
		$mail->setFrom($data['from_email'], $data['from_name']);
		$mail->addAddress($data['to_email'], $data['to_name']);
		$mail->Subject = $data['subject'];
		$mail->CharSet = $data['charSet'];
		$mail->MsgHTML($data['message_body']);
		if ($mail->send()) {
			$mail->ClearAddresses();
			return true;
		}
	}
//--	
	function PHP_UsernameExists($username = '') {
		global $db;
		return ($db->where('username', PHP_Secure($username))->getValue(T_USER, 'count(*)') > 0) ? true : false;
	}
//--	
	function PHP_UserEmailExists($username = '') {
		global $db;
		return ($db->where('email', PHP_Secure($username))->getValue(T_USER, 'count(*)') > 0) ? true : false;
	}
//--
	function PHP_Install_rmdir() {	
		$files = glob('install/*'); //obtenemos todos los nombres de los ficheros
		foreach($files as $file){
			if(is_file($file))
			unlink($file); //elimino el fichero
		}
		@rmdir('install');
	}
	
?>