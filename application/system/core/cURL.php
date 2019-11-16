<?php
 
define('rl_UserAgent', 'Mozilla/5.0 (Windows NT 6.1; rv:52.0) Gecko/20100101 Firefox/52.0');

function formpostdata($post=array()) {
	
	$postdata = '';
	foreach ($post as $k => $v){
		$postdata .= "$k=$v&";
	}
	// Remove the last '&'
	$postdata = substr($postdata, 0, -1);
	return $postdata;

}

//--

function readCustomHeaders(&$referer) {
	$headers = array();
	if (!empty($referer)) {
		$tmp = array_map('trim', explode("\n", $referer));
		$referer = array_shift($tmp);
		if (count($tmp) > 0) {
			foreach (array_filter($tmp) as $tmp) {
				$tmp = array_map('trim', explode(':', $tmp, 2));
				// Avoid set an empty method header (key: '')
				if ($tmp[0] !== '' || $tmp[1] !== '') {
					// Key must be lowercase (for override default header)
					$headers[strtolower($tmp[0])] = $tmp[1];
				}
			}
		}
	}
	return $headers;
}

// function to convert an array of cookies into a string
function CookiesToStr($cookie=array()) {
	if (empty($cookie)) return '';
	$cookies = '';
	foreach ($cookie as $k => $v){
		$cookies .= "$k=$v; ";
	}	
	// Remove the last '; '
	$cookies = substr($cookies, 0, -2);
	return $cookies;
}

//--

function html_error($msg) {
	if (!empty($GLOBALS['throwRLErrors']) || (strtolower(basename($_SERVER['SCRIPT_NAME'])) == 'audl.php' && isset($_REQUEST['GO']) && $_REQUEST['GO'] == 'GO' && $_REQUEST['server_side'] == 'on' && !empty($GLOBALS['isHost']))){
		throw new Exception($msg); // throw errors for try and catch usage.
	} else {
			echo '<div align="center">';
			echo "<span class='htmlerror'><b>$msg</b></span><br /><br />";
		if (isset($_GET['audl'])){
			echo '<script type="text/javascript">parent.nextlink();</script>';
		}
		
		if (!empty($GLOBALS['options']['new_window'])){
			echo '<a href="javascript:window.close();">Try again</a>';
		}else{
			echo 'Try again';
			echo '</div>';
		}
	}
	exit();
}

//--

function PHP_NATIVE_cURL($link, $cookie = 0, $post = 0, $referer = 0, $auth = 0, $opts = 0) {
	
	static $NSS, $ch, $lastProxy;
	
	if (empty($link) || !is_string($link)){
		return html_error('Url error');
	}
	
	if (!extension_loaded('curl') || !function_exists('curl_init') || !function_exists('curl_exec')){
		return html_error('cURL isn\'t enabled or cURL\'s functions are disabled');
	}
	
	if (!empty($referer)) {
		$arr = array_map('trim', explode("\n", $referer));
		$referer = array_shift($arr);
		$header = array_filter($arr);
	} else {
		$header = array();
	}
	

	$link = str_replace(array(' ', "\r", "\n"), array('%20'), $link);
	$opt = array(CURLOPT_HEADER => 1, CURLOPT_SSL_VERIFYPEER => 0,
		CURLOPT_SSL_VERIFYHOST => 0, CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_FOLLOWLOCATION => 0, CURLOPT_FAILONERROR => 0,
		CURLOPT_FORBID_REUSE => 0, CURLOPT_FRESH_CONNECT => 0,
		CURLINFO_HEADER_OUT => 1, CURLOPT_URL => $link,
		CURLOPT_SSLVERSION => (defined('CURL_SSLVERSION_TLSv1') ? CURL_SSLVERSION_TLSv1 : 1),
		CURLOPT_ENCODING => 'gzip, deflate', CURLOPT_USERAGENT => rl_UserAgent);

	// Fixes "Unknown cipher in list: TLSv1" on cURL with NSS
	if (!isset($NSS)) {
		$cV = curl_version();
		$NSS = (!empty($cV['ssl_version']) && strtoupper(substr($cV['ssl_version'], 0, 4)) == 'NSS/');
	}
	if (!$NSS){
		$opt[CURLOPT_SSL_CIPHER_LIST] = 'TLSv1';
	}


	// Uncomment next line if do you have IPv6 problems
	// $opt[CURLOPT_IPRESOLVE] = CURL_IPRESOLVE_V4;

	$opt[CURLOPT_REFERER] = !empty($referer) ? $referer : false;
	$opt[CURLOPT_COOKIE] = !empty($cookie) ? (is_array($cookie) ? CookiesToStr($cookie) : trim($cookie)) : false;

	if (!empty($_GET['useproxy']) && !empty($_GET['proxy'])) {
		$opt[CURLOPT_HTTPPROXYTUNNEL] = strtolower(parse_url($link, PHP_URL_SCHEME) == 'https') ? true : false; // cURL https proxy support... Experimental.
		// $opt[CURLOPT_HTTPPROXYTUNNEL] = false; // Uncomment this line for disable https proxy over curl.
		$opt[CURLOPT_PROXY] = $_GET['proxy'];
		$opt[CURLOPT_PROXYUSERPWD] = (!empty($GLOBALS['pauth']) ? base64_decode($GLOBALS['pauth']) : false);
	} else {
		$opt[CURLOPT_PROXY] = false;
	}

	// Send more headers...
	$headers = array('Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8', 'Accept-Language: en-US,en;q=0.5', 'Pragma: no-cache', 'Cache-Control: no-cache', 'Connection: Keep-Alive');
	if (empty($opt[CURLOPT_REFERER])){
		$headers[] = 'Referer:';
	}
	if (empty($opt[CURLOPT_COOKIE])){
		$headers[] = 'Cookie:';
	}
	if (!empty($opt[CURLOPT_PROXY]) && empty($opt[CURLOPT_PROXYUSERPWD])){
		$headers[] = 'Proxy-Authorization:';
	}
	if (count($header) > 0){
		$headers = array_merge($headers, $header);
	}
	
	$opt[CURLOPT_HTTPHEADER] = $headers;

	if ($post != '0') {
		$opt[CURLOPT_POST] = 1;
		$opt[CURLOPT_POSTFIELDS] = is_array($post) ? formpostdata($post) : $post;
	} else $opt[CURLOPT_HTTPGET] = 1;

	if ($auth) {
		$opt[CURLOPT_HTTPAUTH] = CURLAUTH_BASIC;
		$opt[CURLOPT_USERPWD] = base64_decode($auth);
	} else $opt[CURLOPT_HTTPAUTH] = false;

	$opt[CURLOPT_CONNECTTIMEOUT] = $opt[CURLOPT_TIMEOUT] = 120;
	if (is_array($opts) && count($opts) > 0) foreach ($opts as $O => $V) $opt[$O] = $V;

	if (!isset($lastProxy)){
		$lastProxy = $opt[CURLOPT_PROXY];
	}
	
	if (!isset($ch)){
		$ch = curl_init();
	} elseif ($lastProxy != $opt[CURLOPT_PROXY]) {
		// cURL seems that doesn't like switching proxies on a active resource, there is a bug about that @ https://bugs.php.net/bug.php?id=68211
		curl_close($ch);
		$ch = curl_init();
		$lastProxy = $opt[CURLOPT_PROXY];
	}
	
	// Using this instead of 'curl_setopt_array'
	foreach ($opt as $O => $V){
		curl_setopt($ch, $O, $V);
	} 

	$page = curl_exec($ch);
	$info = curl_getinfo($ch);
	$errz = curl_errno($ch);
	$errz2 = curl_error($ch);
	// curl_close($ch);
	// The "100 Continue" or "200 Connection established" can break some functions in plugins, lets remove it...
	if (substr($page, 9, 3) == '100' || !empty($opt[CURLOPT_PROXY])){
		$page = preg_replace("@^HTTP/1\.[01] \d{3}(?:\s[^\r\n]+)?\r\n\r\n(HTTP/1\.[01] \d+ [^\r\n]+)@i", "$1", $page, 1);
	}
	
	if ($errz != 0){
		return html_error("[cURL:$errz] $errz2");
	}

	return $page;
}
?>