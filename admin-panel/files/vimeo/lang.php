<?php


	if(@$_COOKIE["_lang_shareplus"]!='') {
		$tipo = @$_COOKIE["_lang_shareplus"];
	}else{
		$tipo = $config['lang'];
	}

	switch ($tipo) {
		case 'chinese':
			$text_media 	= '下載vimeo視頻';
			$text_media_two = 'vimeo視頻下載器是一個免費的工具，可以在線下載任何vimeo視頻。';
		break;
		case 'english':
			$text_media 	= 'Download vimeo videos';
			$text_media_two = 'The vimeo video downloader is a free tool to download any vimeo video online.';
		break;
		case 'French':
			$text_media 	= 'Téléchargez les vidéos vimeo';
			$text_media_two = 'Description des vidéos vimeo es una herramienta gratuitement pour télécharger des vidéos cualquier de vimeo en ligne.';
		break;
		case 'german':
			$text_media 	= 'Laden Sie vimeo-Videos herunter';
			$text_media_two = 'Die Video-vimeo ist ein kostenloses Video-vimeo für die Installation.';
		break;
		case 'Italian':
			$text_media 	= 'Scarica i video di vimeo';
			$text_media_two = 'L&#39vimeo video downloader è uno strumento gratuito per scaricare qualsiasi video vimeo online.';
		break;
		case 'portuguese':
			$text_media 	= 'Download de vídeos do vimeo...';
			$text_media_two = 'O vimeo video downloader é uma ferramenta gratuita para baixar qualquer vídeo online do vimeo';
		break;
		case 'russian':
			$text_media 	= 'Скачать видео в vimeo';
			$text_media_two = 'Загрузчик видео vimeo - это бесплатный инструмент для загрузки любого онлайн видео vimeo.';
		break;
		case 'spanish':
			$text_media 	= 'Descargar videos de vimeo';
			$text_media_two = 'El descargador de videos de vimeo es una herramienta gratuita para descargar cualquier video de vimeo en línea.';
		break;
		case 'turkish':
			$text_media 	= 'vimeo videoları indir';
			$text_media_two = 'vimeo video downloader, herhangi bir vimeo videosunu çevrimiçi olarak indirmek için ücretsiz bir araçtır.';
		break;
		default: 
			$text_media 	= $lang->Text_1;
			$text_media_two = '';
		break;
	}

?>