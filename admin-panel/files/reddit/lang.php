<?php


	if(@$_COOKIE["_lang_shareplus"]!='') {
		$tipo = @$_COOKIE["_lang_shareplus"];
	}else{
		$tipo = $config['lang'];
	}

	switch ($tipo) {
		case 'chinese':
			$text_media 	= '下載Reddit視頻';
			$text_media_two = 'Reddit視頻下載器是一個免費的工具，可以在線下載任何Reddit視頻。';
		break;
		case 'english':
			$text_media 	= 'Download Reddit videos';
			$text_media_two = 'The Reddit video downloader is a free tool to download any Reddit video online.';
		break;
		case 'French':
			$text_media 	= 'Téléchargez les vidéos Reddit';
			$text_media_two = 'Description des vidéos Reddit es una herramienta gratuitement pour télécharger des vidéos cualquier de Reddit en ligne.';
		break;
		case 'german':
			$text_media 	= 'Laden Sie Reddit-Videos herunter';
			$text_media_two = 'Die Video-Reddit ist ein kostenloses Video-Reddit für die Installation.';
		break;
		case 'Italian':
			$text_media 	= 'Scarica i video di Reddit';
			$text_media_two = 'L&#39Reddit video downloader è uno strumento gratuito per scaricare qualsiasi video Reddit online.';
		break;
		case 'portuguese':
			$text_media 	= 'Download de vídeos do Reddit...';
			$text_media_two = 'O Reddit video downloader é uma ferramenta gratuita para baixar qualquer vídeo online do Reddit';
		break;
		case 'russian':
			$text_media 	= 'Скачать видео в Reddit';
			$text_media_two = 'Загрузчик видео Reddit - это бесплатный инструмент для загрузки любого онлайн видео Reddit.';
		break;
		case 'spanish':
			$text_media 	= 'Descargar videos de Reddit';
			$text_media_two = 'El descargador de videos de Reddit es una herramienta gratuita para descargar cualquier video de Reddit en línea.';
		break;
		case 'turkish':
			$text_media 	= 'Reddit videoları indir';
			$text_media_two = 'Reddit video downloader, herhangi bir Reddit videosunu çevrimiçi olarak indirmek için ücretsiz bir araçtır.';
		break;
		default: 
			$text_media 	= $lang->Text_1;
			$text_media_two = '';
		break;
	}

?>