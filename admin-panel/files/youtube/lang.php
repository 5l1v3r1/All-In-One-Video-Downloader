<?php


	if(@$_COOKIE["_lang_shareplus"]!='') {
		$tipo = @$_COOKIE["_lang_shareplus"];
	}else{
		$tipo = $config['lang'];
	}

	switch ($tipo) {
		case 'chinese':
			$text_media 	= '下載YouTube視頻';
			$text_media_two = 'YouTube視頻下載器是一個免費的工具，可以在線下載任何YouTube視頻。';
		break;
		case 'english':
			$text_media 	= 'Download YouTube videos';
			$text_media_two = 'The YouTube video downloader is a free tool to download any YouTube video online.';
		break;
		case 'French':
			$text_media 	= 'Téléchargez les vidéos YouTube';
			$text_media_two = 'Description des vidéos YouTube es una herramienta gratuitement pour télécharger des vidéos cualquier de YouTube en ligne.';
		break;
		case 'german':
			$text_media 	= 'Laden Sie YouTube-Videos herunter';
			$text_media_two = 'Die Video-YouTube ist ein kostenloses Video-YouTube für die Installation.';
		break;
		case 'Italian':
			$text_media 	= 'Scarica i video di YouTube';
			$text_media_two = 'L&#39YouTube video downloader è uno strumento gratuito per scaricare qualsiasi video YouTube online.';
		break;
		case 'portuguese':
			$text_media 	= 'Download de vídeos do YouTube...';
			$text_media_two = 'O YouTube video downloader é uma ferramenta gratuita para baixar qualquer vídeo online do YouTube';
		break;
		case 'russian':
			$text_media 	= 'Скачать видео в YouTube';
			$text_media_two = 'Загрузчик видео YouTube - это бесплатный инструмент для загрузки любого онлайн видео YouTube.';
		break;
		case 'spanish':
			$text_media 	= 'Descargar videos de YouTube';
			$text_media_two = 'El descargador de videos de YouTube es una herramienta gratuita para descargar cualquier video de YouTube en línea.';
		break;
		case 'turkish':
			$text_media 	= 'YouTube videoları indir';
			$text_media_two = 'YouTube video downloader, herhangi bir YouTube videosunu çevrimiçi olarak indirmek için ücretsiz bir araçtır.';
		break;
		default: 
			$text_media 	= $lang->Text_1;
			$text_media_two = '';
		break;
	}

?>