<?php
// +------------------------------------------------------------------------+
// | @author_email: chuyd23@gmail.com   
// +------------------------------------------------------------------------+
// | SharePlus - Download system of social media videos
// | Copyright (c) 2018 SharePlus. All rights reserved.
// +------------------------------------------------------------------------+
/*
Any doubt or failure in the system takes a capture and sends the creator in support
*/



//Incluyo la configuración
require ("../config.php");


// created the connection

$con = @mysqli_connect($dbhost, $dbuser, $dbpassword);
// Check connection

// ...some PHP code for database "my_db"...

// check the connection
if (!$con){
		die(include ("./admin/error_db.php"));
	exit;
}

/* User datos */
// Change database to "test"
$bdselect = mysqli_select_db($con, $dbdatabase);

if (!$bdselect) { 
// this function is to know if the system is installed
	if (!file_exists('./admin/install.php')) {
		die("ERROR TO BE CONNECTED WITH THE SERVER");
	}else{
		die(include ("./admin/install.php"));
	}
	exit;
}


if (!file_exists('install.php')) {
	$install = '';
}else{
	$install = '<div class="install_admin"><p class="delete_file_admin">once the installation was done you have to delete the file install.php<br><br> <a href=dashboard?action=install_delete class="style_a admin_a_wall_chats">click here to remove</a></p></div>';
}



	/*
	this PHP function is for NOT NOTIFYING SYSTEM ERRORS SINCE THERE ARE SOME BUT ARE BECAUSE THE META TAGS DO NOT 
	EXIST EXAMPLE IF THEY SEEK A FACEBOOK VIDEO AS WAS DELETED FACEBOOK GIVES A 404 ERROR AND THE VIDEO TAGS ARE NOT
	--------------
	-----BUT EVERYTHING WORKS WELL
	*/
	//error_reporting (E_ALL);
	error_reporting(0);
	
	
	function data_script($value,$redir,$info = ''){
		global $con;
		$data= array();
		
		if ($redir == 'SELECT'){ 
		
			$sqli = mysqli_query($con,"SELECT * from config WHERE id = $value") or die ("error en la consulta". mysqli_connect_error()) ;
			$data = mysqli_fetch_array($sqli, MYSQLI_ASSOC);			
			$code = $data['value'];
			
		}else if($redir == 'UPDATE') {
			
			$sqli = "UPDATE config SET value='$info' WHERE id='$value'";
			mysqli_query($con, $sqli);
			$code = '';
		}
		
		return @$code;
	}
	
	function PHP_count_r($data) {
		global $con;
		$pedir 	= mysqli_query($con,"SELECT count(*) as cuenta from report_link WHERE platform='$data'");
		$res	= mysqli_fetch_assoc($pedir);
		$return = (string)$res["cuenta"];
		return $return;
	}
	function PHP_Secure_c($string, $censored_words = 1) {
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
	
	function time_elapsed($ptime){
		$etime = time() - $ptime;

		if ($etime < 1)
		{
			return '';//-- 0 seconds
		}

		$count = array( 
					365 * 24 * 60 * 60  =>  'year',
					 30 * 24 * 60 * 60  =>  'month',
						  24 * 60 * 60  =>  'day',
							   60 * 60  =>  'hour',
									60  =>  'minute',
									 //1  =>  'second'
					);
		$count_plural = array(
						   'year'   => 'years',
						   'month'  => 'months',
						   'day'    => 'days',
						   'hour'   => 'hours',
						   'minute' => 'minutes',
						   //'second' => 'seconds'
					);

		foreach ($count as $secs => $str)
		{
			$d = $etime / $secs;
			if ($d >= 1)
			{
				$r = round($d);
				return $r . ' ' . ($r > 1 ? $count_plural[$str] : $str) . ' ago';
			}
		}
	}
	
	//-- THIS FUNCTIONS ARE TO ACTIVATE OR DEACTIVATE THE SITES TO DOWNLOAD VIDEOS
	//-- ACTIVATE = TRUE
	//-- DEACTIVATE = FALSE

	 
		//-- Admin
		$email 				 = data_script('24','SELECT');
		$password 			 = data_script('25','SELECT');
		//== Titule of site
		$titule_site 		 = data_script('3','SELECT');
		$name_site 			 = data_script('4','SELECT');
		$Description_site 	 = data_script('7','SELECT');

		$social_facebook     = data_script('16','SELECT');
		$social_twitter 	 = data_script('17','SELECT');
		$social_mail	 	 = data_script('15','SELECT');
		//===============================>
		//== manual to change the language:  en/English - es/Spanish - fr/French - it/Italian - ru/Russian - tr/trick - zh/Chinese - pt/Portuguese - de/German
		$Languages_web 		= data_script('11','SELECT');
		$Languages_panel	= data_script('23','SELECT');
		//===============================>
		
	
	
?>