<?php


	if(@$_COOKIE["_lang_shareplus"]!='') {
		$tipo = @$_COOKIE["_lang_shareplus"];
	}else{
		$tipo = $config['lang'];
	}

	switch ($tipo) {
		case 'chinese':
			$text_media 	= '下載pinterest視頻';
			$text_media_two = 'pinterest視頻下載器是一個免費的工具，可以在線下載任何pinterest視頻。';
		break;
		case 'english':
			$text_media 	= 'Download pinterest videos';
			$text_media_two = 'The pinterest video downloader is a free tool to download any pinterest video online.';
		break;
		case 'French':
			$text_media 	= 'Téléchargez les vidéos pinterest';
			$text_media_two = 'Description des vidéos pinterest es una herramienta gratuitement pour télécharger des vidéos cualquier de pinterest en ligne.';
		break;
		case 'german':
			$text_media 	= 'Laden Sie pinterest-Videos herunter';
			$text_media_two = 'Die Video-pinterest ist ein kostenloses Video-pinterest für die Installation.';
		break;
		case 'Italian':
			$text_media 	= 'Scarica i video di pinterest';
			$text_media_two = 'L&#39pinterest video downloader è uno strumento gratuito per scaricare qualsiasi video pinterest online.';
		break;
		case 'portuguese':
			$text_media 	= 'Download de vídeos do pinterest...';
			$text_media_two = 'O pinterest video downloader é uma ferramenta gratuita para baixar qualquer vídeo online do pinterest';
		break;
		case 'russian':
			$text_media 	= 'Скачать видео в pinterest';
			$text_media_two = 'Загрузчик видео pinterest - это бесплатный инструмент для загрузки любого онлайн видео pinterest.';
		break;
		case 'spanish':
			$text_media 	= 'Descargar videos de pinterest';
			$text_media_two = 'El descargador de videos de pinterest es una herramienta gratuita para descargar cualquier video de pinterest en línea.';
		break;
		case 'turkish':
			$text_media 	= 'pinterest videoları indir';
			$text_media_two = 'pinterest video downloader, herhangi bir pinterest videosunu çevrimiçi olarak indirmek için ücretsiz bir araçtır.';
		break;
		default: 
			$text_media 	= $lang->Text_1;
			$text_media_two = '';
		break;
	}

?>