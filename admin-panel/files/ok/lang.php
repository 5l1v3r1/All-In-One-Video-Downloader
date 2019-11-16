<?php


	if(@$_COOKIE["_lang_shareplus"]!='') {
		$tipo = @$_COOKIE["_lang_shareplus"];
	}else{
		$tipo = $config['lang'];
	}

	switch ($tipo) {
		case 'chinese':
			$text_media 	= '下載ok.ru視頻';
			$text_media_two = 'ok.ru視頻下載器是一個免費的工具，可以在線下載任何ok.ru視頻。';
		break;
		case 'english':
			$text_media 	= 'Download ok.ru videos';
			$text_media_two = 'The ok.ru video downloader is a free tool to download any ok.ru video online.';
		break;
		case 'French':
			$text_media 	= 'Téléchargez les vidéos ok.ru';
			$text_media_two = 'Description des vidéos ok.ru es una herramienta gratuitement pour télécharger des vidéos cualquier de ok.ru en ligne.';
		break;
		case 'german':
			$text_media 	= 'Laden Sie ok.ru-Videos herunter';
			$text_media_two = 'Die Video-ok.ru ist ein kostenloses Video-ok.ru für die Installation.';
		break;
		case 'Italian':
			$text_media 	= 'Scarica i video di ok.ru';
			$text_media_two = 'L&#39ok.ru video downloader è uno strumento gratuito per scaricare qualsiasi video ok.ru online.';
		break;
		case 'portuguese':
			$text_media 	= 'Download de vídeos do ok.ru...';
			$text_media_two = 'O ok.ru video downloader é uma ferramenta gratuita para baixar qualquer vídeo online do ok.ru';
		break;
		case 'russian':
			$text_media 	= 'Скачать видео в ok.ru';
			$text_media_two = 'Загрузчик видео ok.ru - это бесплатный инструмент для загрузки любого онлайн видео ok.ru.';
		break;
		case 'spanish':
			$text_media 	= 'Descargar videos de ok.ru';
			$text_media_two = 'El descargador de videos de ok.ru es una herramienta gratuita para descargar cualquier video de ok.ru en línea.';
		break;
		case 'turkish':
			$text_media 	= 'ok.ru videoları indir';
			$text_media_two = 'ok.ru video downloader, herhangi bir ok.ru videosunu çevrimiçi olarak indirmek için ücretsiz bir araçtır.';
		break;
		default: 
			$text_media 	= $lang->Text_1;
			$text_media_two = '';
		break;
	}

?>