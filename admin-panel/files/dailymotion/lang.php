<?php


	if(@$_COOKIE["_lang_shareplus"]!='') {
		$tipo = @$_COOKIE["_lang_shareplus"];
	}else{
		$tipo = $config['lang'];
	}

	switch ($tipo) {
		case 'chinese':
			$text_media 	= '下載Dailymotion視頻';
			$text_media_two = 'Dailymotion視頻下載器是一個免費的工具，可以在線下載任何Dailymotion視頻。';
		break;
		case 'english':
			$text_media 	= 'Download Dailymotion videos';
			$text_media_two = 'The Dailymotion video downloader is a free tool to download any Dailymotion video online.';
		break;
		case 'French':
			$text_media 	= 'Téléchargez les vidéos Dailymotion';
			$text_media_two = 'Description des vidéos Dailymotion es una herramienta gratuitement pour télécharger des vidéos cualquier de Dailymotion en ligne.';
		break;
		case 'german':
			$text_media 	= 'Laden Sie Dailymotion-Videos herunter';
			$text_media_two = 'Die Video-Dailymotion ist ein kostenloses Video-Dailymotion für die Installation.';
		break;
		case 'Italian':
			$text_media 	= 'Scarica i video di Dailymotion';
			$text_media_two = 'L&#39Dailymotion video downloader è uno strumento gratuito per scaricare qualsiasi video Dailymotion online.';
		break;
		case 'portuguese':
			$text_media 	= 'Download de vídeos do Dailymotion...';
			$text_media_two = 'O Dailymotion video downloader é uma ferramenta gratuita para baixar qualquer vídeo online do Dailymotion';
		break;
		case 'russian':
			$text_media 	= 'Скачать видео в Dailymotion';
			$text_media_two = 'Загрузчик видео Dailymotion - это бесплатный инструмент для загрузки любого онлайн видео Dailymotion.';
		break;
		case 'spanish':
			$text_media 	= 'Descargar videos de Dailymotion';
			$text_media_two = 'El descargador de videos de Dailymotion es una herramienta gratuita para descargar cualquier video de Dailymotion en línea.';
		break;
		case 'turkish':
			$text_media 	= 'Dailymotion videoları indir';
			$text_media_two = 'Dailymotion video downloader, herhangi bir Dailymotion videosunu çevrimiçi olarak indirmek için ücretsiz bir araçtır.';
		break;
		default: 
			$text_media 	= $lang->Text_1;
			$text_media_two = '';
		break;
	}

?>