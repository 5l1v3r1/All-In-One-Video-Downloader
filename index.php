<?php
require_once './application/Connection.php';
@require_once './admin-panel/data_web_analytics.php';
/*
 *---------------------------------------------------------------
 * SYSTEM DIRECTORY NAME
 *---------------------------------------------------------------
 *
 * This variable must contain the name of your "system" directory.
 * Set the path if it is not in the same directory as this file.
 */
	$system_path = './application/system';
/*
 *---------------------------------------------------------------
 * APPLICATION DIRECTORY NAME
 *---------------------------------------------------------------
 *
 * If you want this front controller to use a different "application"
 * directory than the default one you can set its name here. The directory
 * can also be renamed or relocated anywhere on your server. If you do,
 * use an absolute (full) server path.
 * For more info please see the user guide:
 *
 *
 * NO TRAILING SLASH!
 */
	$application_folder = 'application';
/*
 * -------------------------------------------------------------------
 *  Now that we know the path, set the main path constants
 * -------------------------------------------------------------------
 */
// The name of THIS file
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

// Path to the system directory
define('BASEPATH', $system_path);	
//--
if (!empty($_SERVER['HTTP_HOST'])) {
    $server_scheme = @$_SERVER["HTTPS"];
    $pageURL       = ($server_scheme == "on") ? "https://" : "http://";
    $http_url      = $pageURL . $_SERVER['HTTP_HOST'];
    $url           = parse_url($site_url);
    if (!empty($url)) {
        if ($url['scheme'] == 'http') {
            if ($http_url != 'http://' . $url['host']) {
                header('Location: ' . $site_url);
                exit();
            }
        } else {
            if ($http_url != 'https://' . $url['host']) {
                header('Location: ' . $site_url);
                exit();
            }
        }
    }
}	
//-- delete the install folder
	PHP_Install_rmdir();
//-- Homepage
	$page = 'home';
//-- (PHP_UserData(array('value' => 'userID','direct_query' =>1,'loggedin' =>true)) == null) ? false: true
	$loggedin = (PHP_UserData(array('value' => 'userID','direct_query' =>1,'loggedin' =>false)) == null) ? true: false;
//--
	if (isset($_GET['url'])) {
		$page = $_GET['url'];
	}
//--

	// Is the system path correct?
	if ( ! is_dir($system_path))
	{
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'Your system folder path does not appear to be set correctly. Please open the following file and correct this: '.pathinfo(__FILE__, PATHINFO_BASENAME);
		exit(3); // EXIT_CONFIG
	}
//--
if (is_dir($application_folder)) {
	//--
	if (file_exists("./pages/$page/index.php")) {
		require_once("./pages/$page/index.php");
	}
	if (empty($load->content)) {
	   require_once("./application/includes/error_system/404.php");
	}
	#-- 
	$data_og_meta 	= '';
	if ($load->page == 'share') {
	  	$data_og_meta = '200';
	}
	#--
	//-- View
	$final_content = PHP_LoadPage('open_theme', array(
		'CONTAINER_TITLE' => mb_substr($load->title, 0, 400, "UTF-8"),
		'CONTAINER_NAME' => $config['name_site'],
		'CONTAINER_CONTENT' => $load->content,
		'CONTAINER_DESC' => $config['des_web'],
		'CONTAINER_URL' => mb_substr($load->actual_link, 0, 400, "UTF-8"),
		$CODE['URL_OG'] = $data_og_meta,
		'MAIN_URL' => $load->actual_link,
		'HEADER_LAYOUT' => '',
		//'ADS_ONE_CODE' => $load->config->ads_one,
		'ADS_ONE_CODE' => htmlspecialchars_decode($load->config->ads_one),
		'ADS_TWO_CODE' => htmlspecialchars_decode($load->config->ads_two),
		'EXTRA_TOP' => PHP_LoadPage('extra-top/index'),
		'EXTRA_BOTTOM' => PHP_LoadPage('extra-bottom/index'),
		'FOOTER_LAYOUT' => '',
		'INCLUDE_HEADER' => PHP_LoadPage('template/header',array(
			'DATA_FACEBOOK' => ($load->config->facebook == null) ? '' : '<li><a href="'.$load->config->facebook.'"><span><i class="icon_red_i_facebook fab fa-facebook-square"></i> facebook</span></a></li>' ,
			'DATA_TWITTER' => ($load->config->twitter == null) ? '' : '<li><a href="'.$load->config->twitter.'"><span><i class="icon_red_i_twitter fab fa-twitter-square"></i> twitter</span></a></li>' ,
			'DATA_EMAIL' => ($load->config->email_web == null) ? '' : '<li><a href="mailto:'.$load->config->email_web.'"><span><i class="icon_red_i_mail fas fa-envelope-square"></i> Contact Us</span></a></li>' ,
			'ME_USER_NAME' => PHP_UserData(array('value' => 'username','direct_query' =>1,'loggedin' =>false)),
			'ME_USER_ID' => '',
			$CODE['USER_LOGIN'] = $loggedin,
		)),
		'INCLUDE_FOOTER' => PHP_LoadPage('template/footer',array()),
		'NAME_SITE' => PHP_Secure($load->config->name).' ',
		'DATA_YEAR' => date('Y'),
	));
	echo $final_content;
}else{
	header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
	echo 'Your application folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
	exit(3); // EXIT_CONFIG
} 
$db->disconnect();
unset($load);
ob_flush();
?>