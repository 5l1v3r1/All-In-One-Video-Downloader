<?php
 

	
//////////** ip 

	function get_public_ip(){
		$externalContent = file_get_contents('http://checkip.dyndns.com/');
		preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', $externalContent, $m);
		$externalIp = $m[1];
		return $externalIp;
	}

		function getRealIpAddress() {
			if (!empty($_SERVER['HTTP_CLIENT_IP']))
			//check ip from internet
			{
				$ipadd=$_SERVER['HTTP_CLIENT_IP'];
			}
			elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			//check ip proxy
			{
				$ipadd=$_SERVER['HTTP_X_FORWARDED_FOR'];
			}else{
				$ipadd=$_SERVER['REMOTE_ADDR'];
			}
			return $ipadd;
		}
		$IPaddress =  get_public_ip(); // display IP address
		
 
/*
* This function is a plugin is called "geoplugin"
* License or copyright ↓↓↓↓↓↓↓↓↓↓
* https://www.geoplugin.com/_media/webservices/example.phps?id=webservices%3Aphp&cache=cache
*/
		function ipInfo($ip) {
			if(isset($ip)) {
			  @$data = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
			   if($data['geoplugin_status'] == '200') {
				return $data;
			   }else{
					//**echo "Bad request!, Error code is ".$data['geoplugin_status']; 
					//** error 404
			   }
			}else{
				//**echo "IP is not set!"; 
			}
		}
	$IPdata = ipInfo($IPaddress);
	$dataip = $IPdata['geoplugin_countryName'];

///////////////////////////////////////////////////////// 
		/////** look ↓↓↓↓↓↓↓↓↓↓
		$day_data = date("Y/m/d");
		////** look end ↑↑↑↑↑↑↑↑↑↑
/////////////////////////////////////////////////////////	
//***********************************************************************************	
////** browser function		↓↓↓↓↓↓↓↓↓↓
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	
	function getBrowser($user_agent){
		if(strpos($user_agent, 'Maxthon') !== FALSE)
			return "Maxthon";
		elseif(strpos($user_agent, 'SeaMonkey') !== FALSE)
			return "SeaMonkey";
		elseif(strpos($user_agent, 'Vivaldi') !== FALSE)
			return "Vivaldi";
		elseif(strpos($user_agent, 'Arora') !== FALSE)
			return "Arora";
		elseif(strpos($user_agent, 'Avant Browser') !== FALSE)
			return "Avant Browser";
		elseif(strpos($user_agent, 'Beamrise') !== FALSE)
			return "Beamrise";
		elseif(strpos($user_agent, 'Epiphany') !== FALSE)
			return 'Epiphany';
		elseif(strpos($user_agent, 'Chromium') !== FALSE)
			return 'Chromium';
		elseif(strpos($user_agent, 'Iceweasel') !== FALSE)
			return 'Iceweasel';
		elseif(strpos($user_agent, 'Galeon') !== FALSE)
			return 'Galeon';
		elseif(strpos($user_agent, 'Edge') !== FALSE)
			return 'Microsoft Edge';
		elseif(strpos($user_agent, 'Trident') !== FALSE) //IE 11
			return 'Internet Explorer';
		elseif(strpos($user_agent, 'MSIE') !== FALSE)
			return 'Internet Explorer';
		elseif(strpos($user_agent, 'Opera Mini') !== FALSE)
			return "Opera Mini";
		elseif(strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE)
			return "Opera";
		elseif(strpos($user_agent, 'Firefox') !== FALSE)
			return 'Mozilla Firefox';
		elseif(strpos($user_agent, 'Chrome') !== FALSE)
			return 'Google Chrome';
		elseif(strpos($user_agent, 'Safari') !== FALSE)
			return "Safari";
		elseif(strpos($user_agent, 'iTunes') !== FALSE)
			return 'iTunes';
		elseif(strpos($user_agent, 'Konqueror') !== FALSE)
			return 'Konqueror';
		elseif(strpos($user_agent, 'Dillo') !== FALSE)
			return 'Dillo';
		elseif(strpos($user_agent, 'Netscape') !== FALSE)
			return 'Netscape';
		elseif(strpos($user_agent, 'Midori') !== FALSE)
			return 'Midori';
		elseif(strpos($user_agent, 'ELinks') !== FALSE)
			return 'ELinks';
		elseif(strpos($user_agent, 'Links') !== FALSE)
			return 'Links';
		elseif(strpos($user_agent, 'Lynx') !== FALSE)
			return 'Lynx';
		elseif(strpos($user_agent, 'w3m') !== FALSE)
			return 'w3m';
		else
			return 'unknown';
	}
	$navegador = getBrowser($user_agent);
 
		
//******************************************************************		
//We collect the user agent of the visitor
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		
	function getPlatform($user_agent){
		if(strpos($user_agent, 'Windows NT 10.0') !== FALSE)
			return "Windows 10";
		elseif(strpos($user_agent, 'Windows NT 6.3') !== FALSE)
			return "Windows 8.1";
		elseif(strpos($user_agent, 'Windows NT 6.2') !== FALSE)
			return "Windows 8";
		elseif(strpos($user_agent, 'Windows NT 6.1') !== FALSE)
			return "Windows 7";
		elseif(strpos($user_agent, 'Windows NT 6.0') !== FALSE)
			return "Windows Vista";
		elseif(strpos($user_agent, 'Windows NT 5.1') !== FALSE)
			return "Windows XP";
		elseif(strpos($user_agent, 'Windows NT 5.2') !== FALSE)
			return 'Windows 2003';
		elseif(strpos($user_agent, 'Windows NT 5.0') !== FALSE)
			return 'Windows 2000';
		elseif(strpos($user_agent, 'Windows ME') !== FALSE)
			return 'Windows ME';
		elseif(strpos($user_agent, 'Win98') !== FALSE)
			return 'Windows 98';
		elseif(strpos($user_agent, 'Win95') !== FALSE)
			return 'Windows 95';
		elseif(strpos($user_agent, 'WinNT4.0') !== FALSE)
			return 'Windows NT 4.0';
		elseif(strpos($user_agent, 'Windows Phone') !== FALSE)
			return 'Windows Phone';
		elseif(strpos($user_agent, 'Windows') !== FALSE)
			return 'Windows';
		elseif(strpos($user_agent, 'iPhone') !== FALSE)
			return 'iPhone';
		elseif(strpos($user_agent, 'iPad') !== FALSE)
			return 'iPad';
		elseif(strpos($user_agent, 'Debian') !== FALSE)
			return 'Debian';
		elseif(strpos($user_agent, 'Ubuntu') !== FALSE)
			return 'Ubuntu';
		elseif(strpos($user_agent, 'Slackware') !== FALSE)
			return 'Slackware';
		elseif(strpos($user_agent, 'Linux Mint') !== FALSE)
			return 'Linux Mint';
		elseif(strpos($user_agent, 'Gentoo') !== FALSE)
			return 'Gentoo';
		elseif(strpos($user_agent, 'Elementary OS') !== FALSE)
			return 'ELementary OS';
		elseif(strpos($user_agent, 'Fedora') !== FALSE)
			return 'Fedora';
		elseif(strpos($user_agent, 'Kubuntu') !== FALSE)
			return 'Kubuntu';
		elseif(strpos($user_agent, 'Linux') !== FALSE)
			return 'Linux';
		elseif(strpos($user_agent, 'FreeBSD') !== FALSE)
			return 'FreeBSD';
		elseif(strpos($user_agent, 'OpenBSD') !== FALSE)
			return 'OpenBSD';
		elseif(strpos($user_agent, 'NetBSD') !== FALSE)
			return 'NetBSD';
		elseif(strpos($user_agent, 'SunOS') !== FALSE)
			return 'Solaris';
		elseif(strpos($user_agent, 'BlackBerry') !== FALSE)
			return 'BlackBerry';
		elseif(strpos($user_agent, 'Android') !== FALSE)
			return 'Android';
		elseif(strpos($user_agent, 'Mobile') !== FALSE)
			return 'Firefox OS';
		elseif(strpos($user_agent, 'Mac OS X+') || strpos($user_agent, 'CFNetwork+') !== FALSE)
			return 'Mac OS X';
		elseif(strpos($user_agent, 'Macintosh') !== FALSE)
			return 'Mac OS Classic';
		elseif(strpos($user_agent, 'OS/2') !== FALSE)
			return 'OS/2';
		elseif(strpos($user_agent, 'BeOS') !== FALSE)
			return 'BeOS';
		elseif(strpos($user_agent, 'Nintendo') !== FALSE)
			return 'Nintendo';
		else
			return 'unknown';
	}

$Device = getPlatform($user_agent);
	
//********************************************************************************************* 
///////////////////////////////////////////////////////////////////////////////////////////////		


			////** Insert Graphics clicks user ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
						$sql = "select look from admin_graphics where look='$day_data'";
						$result=mysqli_query($con,$sql);								
					if(mysqli_num_rows($result)>0) 
					{ 
										
						$sql = "UPDATE admin_graphics SET click=click+1 WHERE look='$day_data'";
						mysqli_query($con,$sql);
					}else{ 
										
						$sql="insert into admin_graphics (look,click) values ('$day_data','1')";
						mysqli_query($con,$sql);
					} 
			////** Graphics clicks user the end ↑↑↑↑↑↑↑↑↑↑


			@session_start();
			$session = session_id();
			$time = time();
			$time_check = $time-2775360; //We have the timer 1 month
			
			$sql="SELECT * FROM admin_graphic_visits_month WHERE sessionIP='$session'";
			$result=mysqli_query($con,$sql);
			$count=mysqli_num_rows($result); 
			
			//If count is 0 , then enter the values
			if($count=="0"){ 
			
			
				$sql="INSERT INTO admin_graphic_visits_month(sessionIP, time)VALUES('$session', '$time')"; 
				$result=mysqli_query($con,$sql);
				
				
			////** Insert Graphics Visits user ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
								$data_look=mysqli_query($con,"select look from admin_graphics where look='$day_data'"); 
					if(mysqli_num_rows($data_look)>0) 
					{ 
										
						$sql = "UPDATE admin_graphics SET Visits=Visits+1 WHERE look='$day_data'";
						mysqli_query($con,$sql);
					}else{ 
										
						$sql="insert into admin_graphics (look,Visits) values ('$day_data','1')";
						mysqli_query($con,$sql);
					} 
			////** Graphics Visits user the end ↑↑↑↑↑↑↑↑↑↑		

			////** Countries	↓↓↓↓↓↓↓↓↓↓
			if($dataip == NULL){
				//** error 404
			}else{	
				$data_address=mysqli_query($con,"select Countries from admin_graphics_countries where Countries='$dataip'"); 
					if(mysqli_num_rows($data_address)>0) 
					{ 
										
						$sql = "UPDATE admin_graphics_countries SET Results=Results+1 WHERE Countries='$dataip'";
						mysqli_query($con,$sql);
					}else{ 
										
						$sql="insert into admin_graphics_countries (Countries,Results) values ('$dataip','1')";
						mysqli_query($con,$sql);
					}
			}		
			////** Countries the end ↑↑↑↑↑↑↑↑↑↑
			
			////** browser	↓↓↓↓↓↓↓↓↓↓
				$data_browser=mysqli_query($con,"select Browser from admin_browser_graphics where Browser='$navegador'"); 
					if(mysqli_num_rows($data_browser)>0) 
					{ 
										
						$sql = "UPDATE admin_browser_graphics SET Access=Access+1 WHERE Browser='$navegador'";
						mysqli_query($con,$sql);
					}else{ 
										
						$sql="insert into admin_browser_graphics (Browser,Access) values ('$navegador','1')";
						mysqli_query($con,$sql);
					}
			////** browser the end ↑↑↑↑↑↑↑↑↑↑

			
			////** Device	↓↓↓↓↓↓↓↓↓↓
				$data_Device=mysqli_query($con,"select Device from admin_device_graphics where Device='$Device'"); 
					if(mysqli_num_rows($data_Device)>0) 
					{ 
										
						$sql = "UPDATE admin_device_graphics SET Access=Access+1 WHERE Device='$Device'";
						mysqli_query($con,$sql);
					}else{ 
										
						$sql="insert into admin_device_graphics (Device,Access) values ('$Device','1')";
						mysqli_query($con,$sql);
					}	
			////** Device the end ↑↑↑↑↑↑↑↑↑↑
			}else{
				// else update the values 
				$sql="UPDATE admin_graphic_visits_month SET time='$time' WHERE sessionIP = '$session'"; 
				$result=mysqli_query($con,$sql); 
			}

			$sql="SELECT * FROM admin_graphic_visits_month";
			$result=mysqli_query($con,$sql); 
			$count_user_online=mysqli_num_rows($result);
					 

			// after 1 month, session will be deleted 
			$sql="DELETE FROM admin_graphic_visits_month WHERE time<$time_check"; 
			$result=mysqli_query($con,$sql); 
	
	
	
						
?>						
 
 
 