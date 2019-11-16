<?php

$text_media = 'hola ';


if (@$_COOKIE["_lang_shareplus"]!=''){
		if ($_COOKIE["_lang_shareplus"]=='chinese'){
			$text_media 	= '下載puhutv視頻';
			$text_media_two = 'puhutv視頻下載器是一個免費的工具，可以在線下載任何puhutv視頻。';
		}else if($_COOKIE["_lang_shareplus"]=='english'){
			$text_media 	= 'Download puhutv videos';
			$text_media_two = 'The puhutv video downloader is a free tool to download any puhutv video online.';
		}else if($_COOKIE["_lang_shareplus"]=='French'){
			$text_media 	= 'Téléchargez les vidéos puhutv';
			$text_media_two = 'Description des vidéos puhutv es una herramienta gratuitement pour télécharger des vidéos cualquier de puhutv en ligne.';
		}else if($_COOKIE["_lang_shareplus"]=='german'){
			$text_media 	= 'Laden Sie puhutv-Videos herunter';
			$text_media_two = 'Die Video-puhutv ist ein kostenloses Video-puhutv für die Installation.';
		}else if($_COOKIE["_lang_shareplus"]=='Italian'){
			$text_media 	= 'Scarica i video di puhutv';
			$text_media_two = 'L&#39puhutv video downloader è uno strumento gratuito per scaricare qualsiasi video puhutv online.';
		}else if($_COOKIE["_lang_shareplus"]=='portuguese'){
			$text_media 	= 'Download de vídeos do puhutv...';
			$text_media_two = 'O puhutv video downloader é uma ferramenta gratuita para baixar qualquer vídeo online do puhutv';
		}else if($_COOKIE["_lang_shareplus"]=='russian'){
			$text_media 	= 'Скачать видео в puhutv';
			$text_media_two = 'Загрузчик видео puhutv - это бесплатный инструмент для загрузки любого онлайн видео puhutv.';
		}else if($_COOKIE["_lang_shareplus"]=='spanish'){
			$text_media 	= 'Descargar videos de puhutv';
			$text_media_two = 'El descargador de videos de puhutv es una herramienta gratuita para descargar cualquier video de puhutv en línea.';
		}else if($_COOKIE["_lang_shareplus"]=='turkish'){
			$text_media 	= 'puhutv videoları indir';
			$text_media_two = 'puhutv video downloader, herhangi bir puhutv videosunu çevrimiçi olarak indirmek için ücretsiz bir araçtır.';
		}else{
			$text_media 	= $lang->Text_1;
			$text_media_two = '';
		}
	}else{
		$lang_file = './application/langs/'.$config['lang'].'.php';
		if (file_exists($lang_file)) {
			require($lang_file);
			$text_media 	= $lang->Text_1;
			$text_media_two = '';
		}
	}

?>