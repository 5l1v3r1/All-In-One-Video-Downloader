<?php


	if(@$_COOKIE["_lang_shareplus"]!='') {
		$tipo = @$_COOKIE["_lang_shareplus"];
	}else{
		$tipo = $config['lang'];
	}

	switch ($tipo) {
		case 'chinese':
			$text_media 	= '下載plays視頻';
			$text_media_two = 'plays視頻下載器是一個免費的工具，可以在線下載任何plays視頻。';
		break;
		case 'english':
			$text_media 	= 'Download plays videos';
			$text_media_two = 'The plays video downloader is a free tool to download any plays video online.';
		break;
		case 'French':
			$text_media 	= 'Téléchargez les vidéos plays';
			$text_media_two = 'Description des vidéos plays es una herramienta gratuitement pour télécharger des vidéos cualquier de plays en ligne.';
		break;
		case 'german':
			$text_media 	= 'Laden Sie plays-Videos herunter';
			$text_media_two = 'Die Video-plays ist ein kostenloses Video-plays für die Installation.';
		break;
		case 'Italian':
			$text_media 	= 'Scarica i video di plays';
			$text_media_two = 'L&#39plays video downloader è uno strumento gratuito per scaricare qualsiasi video plays online.';
		break;
		case 'portuguese':
			$text_media 	= 'Download de vídeos do plays...';
			$text_media_two = 'O plays video downloader é uma ferramenta gratuita para baixar qualquer vídeo online do plays';
		break;
		case 'russian':
			$text_media 	= 'Скачать видео в plays';
			$text_media_two = 'Загрузчик видео plays - это бесплатный инструмент для загрузки любого онлайн видео plays.';
		break;
		case 'spanish':
			$text_media 	= 'Descargar videos de plays';
			$text_media_two = 'El descargador de videos de plays es una herramienta gratuita para descargar cualquier video de plays en línea.';
		break;
		case 'turkish':
			$text_media 	= 'plays videoları indir';
			$text_media_two = 'plays video downloader, herhangi bir plays videosunu çevrimiçi olarak indirmek için ücretsiz bir araçtır.';
		break;
		default: 
			$text_media 	= $lang->Text_1;
			$text_media_two = '';
		break;
	}

?>