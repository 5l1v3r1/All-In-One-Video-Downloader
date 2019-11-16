<?php


	if(@$_COOKIE["_lang_shareplus"]!='') {
		$tipo = @$_COOKIE["_lang_shareplus"];
	}else{
		$tipo = $config['lang'];
	}

	switch ($tipo) {
		case 'chinese':
			$text_media 	= '下載WWE視頻';
			$text_media_two = 'WWE視頻下載器是一個免費的工具，可以在線下載任何WWE視頻。';
		break;
		case 'english':
			$text_media 	= 'Download WWE videos';
			$text_media_two = 'The WWE video downloader is a free tool to download any WWE video online.';
		break;
		case 'French':
			$text_media 	= 'Téléchargez les vidéos WWE';
			$text_media_two = 'Description des vidéos WWE es una herramienta gratuitement pour télécharger des vidéos cualquier de WWE en ligne.';
		break;
		case 'german':
			$text_media 	= 'Laden Sie WWE-Videos herunter';
			$text_media_two = 'Die Video-WWE ist ein kostenloses Video-WWE für die Installation.';
		break;
		case 'Italian':
			$text_media 	= 'Scarica i video di WWE';
			$text_media_two = 'L&#39WWE video downloader è uno strumento gratuito per scaricare qualsiasi video WWE online.';
		break;
		case 'portuguese':
			$text_media 	= 'Download de vídeos do WWE...';
			$text_media_two = 'O WWE video downloader é uma ferramenta gratuita para baixar qualquer vídeo online do WWE';
		break;
		case 'russian':
			$text_media 	= 'Скачать видео в WWE';
			$text_media_two = 'Загрузчик видео WWE - это бесплатный инструмент для загрузки любого онлайн видео WWE.';
		break;
		case 'spanish':
			$text_media 	= 'Descargar videos de WWE';
			$text_media_two = 'El descargador de videos de WWE es una herramienta gratuita para descargar cualquier video de WWE en línea.';
		break;
		case 'turkish':
			$text_media 	= 'WWE videoları indir';
			$text_media_two = 'WWE video downloader, herhangi bir WWE videosunu çevrimiçi olarak indirmek için ücretsiz bir araçtır.';
		break;
		default: 
			$text_media 	= $lang->Text_1;
			$text_media_two = '';
		break;
	}

?>