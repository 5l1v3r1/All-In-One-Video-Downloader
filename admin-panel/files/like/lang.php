<?php

$text_media = 'hola ';


if (@$_COOKIE["_lang_shareplus"]!=''){
		if ($_COOKIE["_lang_shareplus"]=='chinese'){
			$text_media 	= '下載like視頻';
			$text_media_two = 'like視頻下載器是一個免費的工具，可以在線下載任何like視頻。';
		}else if($_COOKIE["_lang_shareplus"]=='english'){
			$text_media 	= 'Download like videos';
			$text_media_two = 'The like video downloader is a free tool to download any like video online.';
		}else if($_COOKIE["_lang_shareplus"]=='French'){
			$text_media 	= 'Téléchargez les vidéos like';
			$text_media_two = 'Description des vidéos like es una herramienta gratuitement pour télécharger des vidéos cualquier de like en ligne.';
		}else if($_COOKIE["_lang_shareplus"]=='german'){
			$text_media 	= 'Laden Sie like-Videos herunter';
			$text_media_two = 'Die Video-like ist ein kostenloses Video-like für die Installation.';
		}else if($_COOKIE["_lang_shareplus"]=='Italian'){
			$text_media 	= 'Scarica i video di like';
			$text_media_two = 'L&#39like video downloader è uno strumento gratuito per scaricare qualsiasi video like online.';
		}else if($_COOKIE["_lang_shareplus"]=='portuguese'){
			$text_media 	= 'Download de vídeos do like...';
			$text_media_two = 'O like video downloader é uma ferramenta gratuita para baixar qualquer vídeo online do like';
		}else if($_COOKIE["_lang_shareplus"]=='russian'){
			$text_media 	= 'Скачать видео в like';
			$text_media_two = 'Загрузчик видео like - это бесплатный инструмент для загрузки любого онлайн видео like.';
		}else if($_COOKIE["_lang_shareplus"]=='spanish'){
			$text_media 	= 'Descargar videos de like';
			$text_media_two = 'El descargador de videos de like es una herramienta gratuita para descargar cualquier video de like en línea.';
		}else if($_COOKIE["_lang_shareplus"]=='turkish'){
			$text_media 	= 'like videoları indir';
			$text_media_two = 'like video downloader, herhangi bir like videosunu çevrimiçi olarak indirmek için ücretsiz bir araçtır.';
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