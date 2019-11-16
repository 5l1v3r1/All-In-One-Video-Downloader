<?php
 
class YouTubeDownloader {
	
	
	private $fmtmaps;
	
	private $vid;
	
	private $sts = -1;
	
	private $js;
	
	private $playerJs;
	
	private $sigJs;
	
	private $jsVars;
	
	private $cookieFile;
	
	private $fmts = array(
			22 => '0|720|0|192',
			45 => '1|720|1|192',
			44 => '1|480|1|192',
			35 => '2|480|0|128',
			43 => '1|360|1|128',
			34 => '2|360|0|128',
			18 => '0|360|0|96',
			6 => '2|270|3|64',
			5 => '2|240|3|64',
			36 => '3|240|0|36',
			17 => '3|144|0|24'
		);
	
	private $dashfmts = array(
			138 => 'V0',
			272 => 'V1',
			315 => 'V1',
			266 => 'V0',
			313 => 'V1',
			308 => 'V1',
			264 => 'V0',
			271 => 'V1',
			299 => 'V0',
			303 => 'V1',
			137 => 'V0',
			248 => 'V1',
			136 => 'V0',
			298 => 'V0',
			247 => 'V1',
			302 => 'V1',
			135 => 'V0',
			244 => 'V1',
			140 => 'A0',
			171 => 'A1',
			251 => 'A2',
			250 => 'A2',
			249 => 'A2'
		);
 

	public function getDownloadLinks($link_url) {
		$url = parse_url($link_url);
		$this->vid = array();
		if ($this->PHP_host_matches('youtu.be', $url['host'])){
			preg_match('@/([\w\-\.]{11})@i', $url['path'], $this->vid);
			
		}else if (empty($url['query']) || ($this->vid[1] = $this->PHP_cut_str('&'.$url['query'].'&', '&v=', '&')) === false || !preg_match('@^[\w\-\.]{11}$@i', $this->vid[1])){
			#-->
			preg_match('@/(?:v|(?:embed))/([\w\-\.]{11})@i', $url['path'], $this->vid);
		}
		if (empty($this->vid[1])){
			//echo 'Video ID not found.';
		}
		$this->vid 		= $this->vid[1];
		$this->link_url = 'https://www.youtube.com/watch?v='.$this->vid;
		$this->getFmtMaps();
		$data_video 	= array();
		$i = 0;
		foreach ($this->fmtmaps as $itag => $fmt) {
			$data_video["data"][$i]["url"] 		= $fmt["url"];
			$data_video["data"][$i]["quality"]	= $fmt["itag"];
			$i++;
		}
		return $data_video;
	}
//-->	
	private function PHP_cut_str($str, $left, $right) {
		$str = substr(stristr($str, $left), strlen($left));
		$leftLen = strlen(stristr($str, $right)); 
		$leftLen = $leftLen ? -($leftLen) : strlen($str);
		$str = substr($str, 0, $leftLen);
		return $str;
	}
//-->	
	private function PHP_host_matches($site, $host) {
		if (empty($site) || empty($host)){
			return false;
		}
		if (strtolower($site) == strtolower($host)){
			return true;
		}
		if (($pos = strripos($host, $site)) !== false && ($pos + strlen($site) == strlen($host)) && $pos > 1 && substr($host, $pos - 1, 1) == '.'){
			return true;
		}
		return false;
	}
	
//--> si funciona 
	private function FormToArr($content, $v1 = '&', $v2 = '=') {
		
		$rply = array();
		
		if (strpos($content, $v1) === false || strpos($content, $v2) === false){
			return $rply;
		}
		foreach (array_filter(array_map('trim', explode($v1, $content))) as $v) {
			$v = array_map('trim', explode($v2, $v, 2));
			if ($v[0] != ''){
				@$rply[$v[0]] = $v[1];
			}
		}
		return $rply;
	}
//-->
	private function PHP_defport($urls) {
		if (!empty($urls['port'])){
			return $urls['port'];
		}
		switch(strtolower($urls['scheme'])) {
			case 'http' :
				return '80';
			case 'https' :
				return '443';
			case 'ftp' :
				return '21';
		}
	}
//-->
	private function PHP_rebuild_url($url) {
		
		$url['scheme'] = strtolower($url['scheme']);
		
		return $url['scheme'] . '://' . (!empty($url['user']) && !empty($url['pass']) ? rawurlencode($url['user']) . ':' . rawurlencode($url['pass']) . '@' : '') . strtolower($url['host']) . (!empty($url['port']) && $url['port'] != $this->PHP_defport(array('scheme' => $url['scheme'])) ? ':' . $url['port'] : '') . (empty($url['path']) ? '/' : $url['path']) . (!empty($url['query']) ? '?' . $url['query'] : '') . (!empty($url['fragment']) ? '#' . $url['fragment'] : '');
	}
//-->
	private function PHP_url_get_contents($url){
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
//--> 
	private function get_sts($alt) {
		$page = $this->PHP_url_get_contents('https://www.youtube.com/embed/' . $alt);
		preg_match('@"sts"\s*:\s*(\d+)@i', $page, $sts);
		$sts = intval($sts[1]);
		return $sts;
	}
//-->	
	private function queryVideo($alt = 0) {
		$sts 	= $this->get_sts($this->vid);
		$page 	= $this->PHP_url_get_contents('https://www.youtube.com/get_video_info?hl=en_US&video_id=' . $this->vid . ($alt ? '&eurl=https%3A%2F%2Fgoogle.com%2F' : '&el=detailpage') .'&sts=' . $sts); 
		$this->queryVideo_como_funciona = array_map('urldecode', $this->FormToArr(substr($page, strpos($page, "\r\n\r\n") + 4)));
		if (!empty($this->queryVideo_como_funciona['requires_purchase'])){
			//echo '[Unsupported Video] This Video or Channel Requires a Payment to Watch.';
		}
	}
//-->
	private function getFmtMaps() {
		$this->queryVideo();
		$this->fmtmaps = array();
		foreach (array('url_encoded_fmt_stream_map', 'adaptive_fmts') as $map) {
			#
			foreach (explode(',', $this->queryVideo_como_funciona[$map]) as $fmt) {
				$fmt = array_map('urldecode', $this->FormToArr($fmt));
				if (!empty($fmt['s']) && empty($this->encS)) {
					if ($this->sts < 1){
						return $this->getCipher();
					}else{
						//echo '[' . $this->sts . '] No decoded steps';
					}
				}

				$fmt['url'] 			= parse_url($fmt['url']);
				$fmt['url']['query'] 	= array_map('urldecode', $this->FormToArr($fmt['url']['query']));
				if (!empty($fmt['s']) && !empty($fmt['sp'])){
					$fmt['url']['query']["{$fmt['sp']}"] = $this->sigDecode($fmt['s']);	
				}else if (empty($fmt['s']) && !empty($fmt['sig'])){
					if (empty($fmt['url']['query']['signature'])){
						$fmt['url']['query']['signature'] = $fmt['sig'];
					}
				}else if (empty($fmt['url']['query']['signature']) && empty($fmt['url']['query']['sig'])){
					//Cannot get signature key name;
				
				}else{
					
				}

				foreach (array_diff(array_keys($fmt), array('signature', 'sig', 's', 'url', 'xtags')) as $k){
					$fmt['url']['query'][$k] = $fmt[$k];
					if (empty($fmt['url']['query']['ratebypass'])){
						$fmt['url']['query']['ratebypass'] = 'yes'; // Fix for Slow Downloads of DASH Formats
					}
					ksort($fmt['url']['query']);
				}
				$fmt['url']['query'] = http_build_query($fmt['url']['query']);
				$fmt['url'] = $this->PHP_rebuild_url($fmt['url']);
				$this->fmtmaps[$fmt['itag']] = $fmt;
			}
		}
	}

	private function findFunction($fName, $num) {
		if ($fName == 'T8'){
			return "w$num";
		}
		$obj = explode('.', $fName, 3);
		
		if (count($obj) > 2){
			//echo "Cannot search function: '$fName'";
		}	
		if (count($obj) > 1) {
			
			$fName 	= $obj[1];
			$obj 	= $obj[0];
			
			if (empty($this->jsVars[$obj]['src'])) {
				if (($spos = strpos($this->playerJs, "var $obj={")) === false || ($epos = strpos($this->playerJs, '};', $spos)) === false){
					//echo "Cannot find object '$obj'";
				}	
				$spos 				+= strlen("var $obj={");
				$this->jsVars[$obj]  = array('src' => substr($this->playerJs, $spos, $epos - $spos), 'fn' => array());
			}
			//--
			if (empty($this->jsVars[$obj]['fn'][$fName]['step'])) {
				
				$v = '[\$_A-Za-z][\$\w]*';
				
				if (!preg_match("@(?<=^|,)\s*$fName:function\($v(?:,($v))?\)\{([^}]+)\}\s*(?=,|$)@", $this->jsVars[$obj]['src'], $src)){
					echo "Cannot find function '$obj.$fName'";
				}	
				$src[0] 							= trim($src[0]);
				$this->jsVars[$obj]['fn'][$fName] 	= array('src' => $src);

				if (empty($src[1])){
					return $this->jsVars[$obj]['fn'][$fName]['step'] = 'r';
				}else if (preg_match("@var\s+($v)=($v)\[0\];\\2\[0\]=\\2\[{$src[1]}%\\2(?:\.length|\[$v\])\];\\2\[{$src[1]}(?:%\\2(?:\.length|\[$v\]))?\]=\\1@", $src[2])){
					
					$this->jsVars[$obj]['fn'][$fName]['step'] = 'w%d';
					return "w$num";
				} else if (preg_match("@(?:$v=)?$v(?:\.s(p)?lice|\[$v\])\((?(1)0,){$src[1]}\)@", $src[2])) {
					#
					$this->jsVars[$obj]['fn'][$fName]['step'] = 's%d';
					return "s$num";
				} else if (preg_match("@(?:$v=)?$v(?:\.reverse|\[$v\])\(\)@", $src[2])){
					#
					return $this->jsVars[$obj]['fn'][$fName]['step'] = 'r';
				}else{
					#
					//echo "Error parsing function '$obj.$fName'";
				}	
			} else{
				return sprintf($this->jsVars[$obj]['fn'][$fName]['step'], $num);
			}	
		}
		if (empty($this->jsVars[$fName]['step'])) {
			if (($spos = strpos($this->playerJs, "function $fName(")) === false || ($epos = strpos($this->playerJs, '};', $spos)) === false){
				//echo "Cannot find function '$fName'";
			}
			#--
			$this->jsVars[$fName] 	= array('src' => substr($this->playerJs, $spos, $epos - $spos));
			$v 						= '[\$_A-Za-z][\$\w]*';
			#--
			if (!preg_match("@^function\s+$fName\($v(?:,($v))?\)\{(.*)$@", $this->jsVars[$fName]['src'], $pars)){
				//echo "Cannot parse function '$fName'";
			}
			#--
			if (empty($pars[1])){
				return $this->jsVars[$fName]['step'] = 'r';
			}else if (preg_match("@var\s+($v)=($v)\[0\];\\2\[0\]=\\2\[{$pars[1]}%\\2(?:\.length|\[$v\])\];\\2\[{$pars[1]}(?:%\\2(?:\.length|\[$v\]))?\]=\\1@", $src[2])){
				#-->
				$this->jsVars[$fName]['step'] = 'w%d';
				return "w$num";
			} else if (preg_match("@(?:$v=)?$v(?:\.s(p)?lice|\[$v\])\((?(1)0,){$src[1]}\)@", $src[2])) {
				#
				$this->jsVars[$fName]['step'] = 's%d';
				return "s$num";
			} else if (preg_match("@(?:$v=)?$v(?:\.reverse|\[$v\])\(\)@", $src[2])){
				#
				return $this->jsVars[$fName]['step'] = 'r';
			}else{
				#
				//echo "Error parsing function '$fName'";
			}	
		} else{
			return sprintf($this->jsVars[$fName]['step'], $num);
		}
	}

	// getCipher & sigDecode are based on jwz's youtubedown code.
	private function getCipher() {
		## <br />Video with ciphered signature, trying to decode it.<br /><br />
		echo '';
		$page = $this->PHP_url_get_contents('https://www.youtube.com/embed/'.$this->vid);

		if (preg_match('@"sts"\s*:\s*(\d+)@i', $page, $this->sts) && intval($this->sts[1])) {
			$this->sts = intval($this->sts[1]);
		}

		$savefile =  __DIR__ . '/YT_lastjs.txt';
		
		
		
		if (!preg_match('@/((?:html5)?player[-_][\w\-\.]+(?:(?:/\w+)?/[\w\-\.]+)?)\.js@i', str_replace('\\/', '/', $page), $this->js)){
			//'YT\'s player javascript not found.;
		}
		if (@file_exists($savefile) && ($file = file_get_contents($savefile, NULL, NULL, -1, 822)) && ($saved = @unserialize($file)) && is_array($saved) && !empty($saved['js']) && !empty($saved['sts']) && !empty($saved['steps']) && ((!$this->sts && $saved['js'] == $this->js[1]) || $saved['sts'] == $this->sts) && preg_match('@^\s*([ws]\d+|r)( ([ws]\d+|r))*\s*$@', $saved['steps'])) {
			$this->encS = explode(' ', trim($saved['steps']));
			if (empty($this->sts)) $this->sts = $saved['sts'];
		} else {
			
			$this->playerJs = $this->PHP_url_get_contents('https://s.ytimg.com/yts/jsbin'.$this->js[0]);
			if (empty($this->sts) && (!preg_match('@\bsts\s*:\s*(\d+)@i', $this->playerJs, $this->sts) || !($this->sts = intval($this->sts[1])))) {
				//'Signature TimeStamp not found.');
			}

			$v = '[\$_A-Za-z][\$\w]*';
			$v3 = '[\$_A-Za-z][\$\w]{3,}';
			
			if (!preg_match("@(?:\.sig\|\||\.set\(\"signature\",|\|\"signature\",|$v\.sp,)(?:\(0,$v(?:\.$v)*\)\(|$v3\()?($v)\((?:\(0,$v(?:\.$v)*\)\(|$v3\()?$v\.s\)@", $this->playerJs, $fn)){
				//echo 'Cannot get decoder function name';
			}
			$fn = preg_quote($fn[1], '@');
			if (!preg_match("@(?:function\s+$fn\s*\(|var\s+$fn\s*=\s*function\s*\(|(?<=(?:{|,|;))\s*$fn\s*=\s*function\s*\()@", $this->playerJs, $fpos, PREG_OFFSET_CAPTURE)){
				//echo 'Cannot find decoder function';
			}
			$fpos = $fpos[0][1];
			if (($cut2 = $this->PHP_cut_str(substr($this->playerJs, $fpos), '{', '}')) == false){
				//echo 'Cannot get decoder function contents';
			}
			$sigJs = preg_replace("@var $v=$v\[0\];$v\[0\]=($v)\[(\d+)%$v(?:\.length|\[$v\])\];$v\[\d+\]=$v;@", '$1=T8($1,$2);', trim($cut2));	
		//-- encS aqui esta el encS que solo tiene un array()	
			$this->encS = array();
			foreach (array_map('trim', explode(';', '{'.$sigJs.'}')) as $step) {
				if (($step{0} == '{' || substr($step, strlen($step) - 1, 1) == '}') && (preg_match("@^\{(?:var\s+)?$v=$v(?:\.split|\[$v\])\(\"\"\)$@", $step) || preg_match("@^return\s+$v(?:\.join|\[$v\])\(\"\"\);?\}$@", $step))){
					continue;
				}else if (preg_match("@^(?:$v=)?((?:$v.)*$v)\($v\,(\d+)\)$@", $step, $s)){
					$this->encS[] = $this->findFunction($s[1], $s[2]);
				
				}else if (preg_match("@^(?:$v=)?$v(?:\.s(p)?lice|\[$v\])\((?(1)0,)(\d+)\)$@", $step, $s)){
					$this->encS[] = 's'.$s[2];
			
				}else if (preg_match("@^(?:$v=)?$v(?:\.reverse|\[$v\])\(\)$@", $step)){
					$this->encS[] = 'r';
				}else{
					//echo $step.' | Unknown step on decoder function.';
				}
			}

			if (empty($this->encS)){
				//echo 'Empty decoded result';
			}
			
			//file_put_contents($savefile, serialize(array('sts' => $this->sts, 'js' => $this->js[1], 'steps' => implode(' ', $this->encS))));
			
			file_put_contents($savefile, serialize(array('js' => $this->js[1], 'sts' => $this->sts, 'steps' => implode(' ', $this->encS))));
		}

		// Request video fmts with the current sts
		$this->getFmtMaps();
	}

	private function sigDecode($sig) {
		
		if (empty($this->encS)){
			//echo 'sigDecode() can\'t be called before getCipher()';;
		}
		$_sig = $sig;
		
		$sig = str_split($sig);
		
		foreach ($this->encS as $_step) {
			
			if (!preg_match('@^\s*([wrs])(\d*)\s*$@', $_step, $step) || ($step[1] != 'r' && !array_key_exists(2, $step))){
				//echo "Unknown decoding step \"$_step\"";
			}	
			switch ($step[1]) {
				case 'w': $step[2] = (int)$step[2];$x = $sig[0];$sig[0] = $sig[$step[2] % count($sig)];$sig[$step[2]] = $x; break;
				case 's': $step[2] = (int)$step[2];$sig = array_slice($sig, $step[2]); break;
				case 'r': $sig = array_reverse($sig); break;
			}
		}
		return implode($sig);
	}
 
//--> ?????
 
}
 