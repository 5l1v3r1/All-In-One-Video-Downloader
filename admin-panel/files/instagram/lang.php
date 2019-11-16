<?php


	if(@$_COOKIE["_lang_shareplus"]!='') {
		$tipo = @$_COOKIE["_lang_shareplus"];
	}else{
		$tipo = $config['lang'];
	}

	switch ($tipo) {
		case 'chinese':
			$text_media 	= '下載instagram視頻';
			$text_media_two = 'instagram視頻下載器是一個免費的工具，可以在線下載任何instagram視頻。';
		break;
		case 'english':
			$text_media 	= 'Download instagram videos';
			$text_media_two = 'The instagram video downloader is a free tool to download any instagram video online.';
		break;
		case 'French':
			$text_media 	= 'Téléchargez les vidéos instagram';
			$text_media_two = 'Description des vidéos instagram es una herramienta gratuitement pour télécharger des vidéos cualquier de instagram en ligne.';
		break;
		case 'german':
			$text_media 	= 'Laden Sie instagram-Videos herunter';
			$text_media_two = 'Die Video-instagram ist ein kostenloses Video-instagram für die Installation.';
		break;
		case 'Italian':
			$text_media 	= 'Scarica i video di instagram';
			$text_media_two = 'L&#39instagram video downloader è uno strumento gratuito per scaricare qualsiasi video instagram online.';
		break;
		case 'portuguese':
			$text_media 	= 'Download de vídeos do instagram...';
			$text_media_two = 'O instagram video downloader é uma ferramenta gratuita para baixar qualquer vídeo online do instagram';
		break;
		case 'russian':
			$text_media 	= 'Скачать видео в instagram';
			$text_media_two = 'Загрузчик видео instagram - это бесплатный инструмент для загрузки любого онлайн видео instagram.';
		break;
		case 'spanish':
			$text_media 	= 'Descargar videos de instagram';
			$text_media_two = 'El descargador de videos de instagram es una herramienta gratuita para descargar cualquier video de instagram en línea.';
		break;
		case 'turkish':
			$text_media 	= 'instagram videoları indir';
			$text_media_two = 'instagram video downloader, herhangi bir instagram videosunu çevrimiçi olarak indirmek için ücretsiz bir araçtır.';
		break;
		default: 
			$text_media 	= $lang->Text_1;
			$text_media_two = '';
		break;
	}

?>