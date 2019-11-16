<?php

$text_media = 'hola ';


if (@$_COOKIE["_lang_shareplus"]!=''){
		if ($_COOKIE["_lang_shareplus"]=='chinese'){
			$text_media 	= '下載Ted視頻';
			$text_media_two = 'Ted視頻下載器是一個免費的工具，可以在線下載任何Ted視頻。';
		}else if($_COOKIE["_lang_shareplus"]=='english'){
			$text_media 	= 'Download Ted Videos - MP3';
			$text_media_two = 'The Ted video downloader is a free tool to download any Ted video online.';
		}else if($_COOKIE["_lang_shareplus"]=='French'){
			$text_media 	= 'Téléchargez les vidéos - MP3 Ted';
			$text_media_two = 'Description des vidéos - MP3 Ted es una herramienta gratuitement pour télécharger des vidéos cualquier de Ted en ligne.';
		}else if($_COOKIE["_lang_shareplus"]=='german'){
			$text_media 	= 'Laden Sie Ted-Videos - MP3 herunter';
			$text_media_two = 'Die Video-Ted ist ein kostenloses Video - MP3 Ted für die Installation.';
		}else if($_COOKIE["_lang_shareplus"]=='Italian'){
			$text_media 	= 'Scarica i video di Ted';
			$text_media_two = 'L&#39Ted video downloader è uno strumento gratuito per scaricare qualsiasi video Ted online.';
		}else if($_COOKIE["_lang_shareplus"]=='portuguese'){
			$text_media 	= 'Download de vídeos do Ted...';
			$text_media_two = 'O Ted video downloader é uma ferramenta gratuita para baixar qualquer vídeo online do Ted';
		}else if($_COOKIE["_lang_shareplus"]=='russian'){
			$text_media 	= 'Скачать видео в Ted';
			$text_media_two = 'Загрузчик видео Ted - это бесплатный инструмент для загрузки любого онлайн видео Ted.';
		}else if($_COOKIE["_lang_shareplus"]=='spanish'){
			$text_media 	= 'Descargar Videos - MP3 de Ted';
			$text_media_two = 'El descargador de Videos - MP3 de Ted es una herramienta gratuita para descargar cualquier video de Ted en línea.';
		}else if($_COOKIE["_lang_shareplus"]=='turkish'){
			$text_media 	= 'Ted videoları indir';
			$text_media_two = 'Ted video downloader, herhangi bir Ted Videos - MP3 unu çevrimiçi olarak indirmek için ücretsiz bir araçtır.';
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