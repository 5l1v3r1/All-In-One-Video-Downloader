<?php

$text_media = 'hola ';


if (@$_COOKIE["_lang_shareplus"]!=''){
		if ($_COOKIE["_lang_shareplus"]=='chinese'){
			$text_media 	= '下載Break視頻';
			$text_media_two = 'Break視頻下載器是一個免費的工具，可以在線下載任何Break視頻。';
		}else if($_COOKIE["_lang_shareplus"]=='english'){
			$text_media 	= 'Download Break videos';
			$text_media_two = 'The Break video downloader is a free tool to download any Break video online.';
		}else if($_COOKIE["_lang_shareplus"]=='French'){
			$text_media 	= 'Téléchargez les vidéos Break';
			$text_media_two = 'Description des vidéos Break es una herramienta gratuitement pour télécharger des vidéos cualquier de Break en ligne.';
		}else if($_COOKIE["_lang_shareplus"]=='german'){
			$text_media 	= 'Laden Sie Break-Videos herunter';
			$text_media_two = 'Die Video-Break ist ein kostenloses Video-Break für die Installation.';
		}else if($_COOKIE["_lang_shareplus"]=='Italian'){
			$text_media 	= 'Scarica i video di Break';
			$text_media_two = 'L&#39Break video downloader è uno strumento gratuito per scaricare qualsiasi video Break online.';
		}else if($_COOKIE["_lang_shareplus"]=='portuguese'){
			$text_media 	= 'Download de vídeos do Break...';
			$text_media_two = 'O Break video downloader é uma ferramenta gratuita para baixar qualquer vídeo online do Break';
		}else if($_COOKIE["_lang_shareplus"]=='russian'){
			$text_media 	= 'Скачать видео в Break';
			$text_media_two = 'Загрузчик видео Break - это бесплатный инструмент для загрузки любого онлайн видео Break.';
		}else if($_COOKIE["_lang_shareplus"]=='spanish'){
			$text_media 	= 'Descargar videos de Break';
			$text_media_two = 'El descargador de videos de Break es una herramienta gratuita para descargar cualquier video de Break en línea.';
		}else if($_COOKIE["_lang_shareplus"]=='turkish'){
			$text_media 	= 'Break videoları indir';
			$text_media_two = 'Break video downloader, herhangi bir Break videosunu çevrimiçi olarak indirmek için ücretsiz bir araçtır.';
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