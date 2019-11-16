<?php
//Incluyo la configuración
require ("config.php");
//--
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './application/system/PHPMailer/Exception.php';
require './application/system/PHPMailer/PHPMailer.php';
require './application/system/PHPMailer/SMTP.php';
$mail = new PHPMailer;
require ("PHPMailer_config.php");
//--
require 'application/system/DB/vendor/autoload.php';
// created the connection
$load     = ToObject(array());

$con = @mysqli_connect($dbhost, $dbuser, $dbpassword);
// Check connection

// ...some PHP code for database "my_db"...

// check the connection
if (!$con){
	die(include ("application/includes/error_system/500.php"));
	exit;
}

/* User datos */
// Change database to "test"
$bdselect = mysqli_select_db($con, $dbdatabase);



// UTF-8

mysqli_set_charset($con,'utf8');

// Handling Server Errors
$ServerErrors = array();
if (mysqli_connect_errno()) {
    $ServerErrors[] = "Failed to connect to MySQL: " . mysqli_connect_error();
}
if (!function_exists('curl_init')) {
    $ServerErrors[] = "PHP CURL is NOT installed on your web server !";
}
if (!extension_loaded('gd') && !function_exists('gd_info')) {
    $ServerErrors[] = "PHP GD library is NOT installed on your web server !";
}
if (!extension_loaded('zip')) {
    $ServerErrors[] = "ZipArchive extension is NOT installed on your web server !";
}
if (!version_compare(PHP_VERSION, '5.4.0', '>=')) {
    $ServerErrors[] = "Required PHP_VERSION >= 5.4.0 , Your PHP_VERSION is : " . PHP_VERSION . "\n";
}
if (isset($ServerErrors) && !empty($ServerErrors)) {
    foreach ($ServerErrors as $Error) {
        echo "<h3>" . $Error . "</h3>";
    }
    die();
} 
$mysqli = new mysqli($dbhost, $dbuser, $dbpassword, $dbdatabase);
$query = $mysqli->query("SET NAMES utf8");
$mysqli->set_charset("utf8");
// Connecting to DB after verfication
$db 				= new MysqliDb($mysqli);
 
$http_header = 'http://';
if (!empty($_SERVER['HTTPS'])) {
    $http_header = 'https://';
}

$load->site_pages = array('home');
$load->actual_link = $http_header . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];


$config          		  = PHP_GetConfig();
$load->loggedin			  = false;
$config['theme_url']      = $site_url . '/themes/' . $config['theme'];
$config['site_url']       = $site_url;
$config['name_site']      = $config['name'];
$config['des_web']        = $config['description'];
$config['lang']      	  = $config['language'];
$config['site_url']       = $site_url;

$load->config               = ToObject($config);
//--
	function CT_lang($lang) {
		global $config;
		switch ($lang) {
			case 'es':
				$lang = 'spanish';
			break;
			case 'tr':
				$lang = 'turkish';
			break;
			case 'zr':
				$lang = 'chinese';
			break;
			case 'fr':
				$lang = 'french';
			break;
			case 'en':
				$lang = 'english';
			break;
			case 'de':
				$lang = 'german';
			break;
			case 'it':
				$lang = 'italian';
			break;
			case 'pr':
				$lang = 'portuguese';
			break;
			case 'ru':
				$lang = 'russian';
			break;	
			default: 
				$lang = $config['lang'];
			break;
			
		}
		$s = 3600000; // seconds in a year
			setcookie("_lang_shareplus", $lang, time() + $s, '/', null, null, true);
		return $lang;
	}
//--
	if (isset($_GET['lang'])) {
		$lang = CT_lang($_GET['lang']);
		
	}else{
		$lang = $config['lang'];
	}
	

	if (@$_COOKIE["_lang_shareplus"]!='') {
		$lang_file = './application/langs/'.$_COOKIE["_lang_shareplus"].'.php';
	}else{
		$lang_file = './application/langs/'.$lang.'.php';
	}

	if (file_exists($lang_file)) {
		require($lang_file);
	}

$lang            = ToObject($lang_text);
 
