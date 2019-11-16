<?php


	if(@$_COOKIE["_lang_shareplus"]!='') {
		$tipo = @$_COOKIE["_lang_shareplus"];
	}else{
		$tipo = $config['lang'];
	}

	switch ($tipo) {
		case 'chinese':
			$text_media 	= '下載tumblr視頻';
			$text_media_two = 'tumblr視頻下載器是一個免費的工具，可以在線下載任何tumblr視頻。';
		break;
		case 'english':
			$text_media 	= 'Download tumblr videos';
			$text_media_two = 'The tumblr video downloader is a free tool to download any tumblr video online.';
		break;
		case 'French':
			$text_media 	= 'Téléchargez les vidéos tumblr';
			$text_media_two = 'Description des vidéos tumblr es una herramienta gratuitement pour télécharger des vidéos cualquier de tumblr en ligne.';
		break;
		case 'german':
			$text_media 	= 'Laden Sie tumblr-Videos herunter';
			$text_media_two = 'Die Video-tumblr ist ein kostenloses Video-tumblr für die Installation.';
		break;
		case 'Italian':
			$text_media 	= 'Scarica i video di tumblr';
			$text_media_two = 'L&#39tumblr video downloader è uno strumento gratuito per scaricare qualsiasi video tumblr online.';
		break;
		case 'portuguese':
			$text_media 	= 'Download de vídeos do tumblr...';
			$text_media_two = 'O tumblr video downloader é uma ferramenta gratuita para baixar qualquer vídeo online do tumblr';
		break;
		case 'russian':
			$text_media 	= 'Скачать видео в tumblr';
			$text_media_two = 'Загрузчик видео tumblr - это бесплатный инструмент для загрузки любого онлайн видео tumblr.';
		break;
		case 'spanish':
			$text_media 	= 'Descargar videos de tumblr';
			$text_media_two = 'El descargador de videos de tumblr es una herramienta gratuita para descargar cualquier video de tumblr en línea.';
		break;
		case 'turkish':
			$text_media 	= 'tumblr videoları indir';
			$text_media_two = 'tumblr video downloader, herhangi bir tumblr videosunu çevrimiçi olarak indirmek için ücretsiz bir araçtır.';
		break;
		default: 
			$text_media 	= $lang->Text_1;
			$text_media_two = '';
		break;
	}

?>