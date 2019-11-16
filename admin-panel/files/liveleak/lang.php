<?php


	if(@$_COOKIE["_lang_shareplus"]!='') {
		$tipo = @$_COOKIE["_lang_shareplus"];
	}else{
		$tipo = $config['lang'];
	}

	switch ($tipo) {
		case 'chinese':
			$text_media 	= '下載Liveleak視頻';
			$text_media_two = 'Liveleak視頻下載器是一個免費的工具，可以在線下載任何Liveleak視頻。';
		break;
		case 'english':
			$text_media 	= 'Download Liveleak videos';
			$text_media_two = 'The Liveleak video downloader is a free tool to download any Liveleak video online.';
		break;
		case 'French':
			$text_media 	= 'Téléchargez les vidéos Liveleak';
			$text_media_two = 'Description des vidéos Liveleak es una herramienta gratuitement pour télécharger des vidéos cualquier de Liveleak en ligne.';
		break;
		case 'german':
			$text_media 	= 'Laden Sie Liveleak-Videos herunter';
			$text_media_two = 'Die Video-Liveleak ist ein kostenloses Video-Liveleak für die Installation.';
		break;
		case 'Italian':
			$text_media 	= 'Scarica i video di Liveleak';
			$text_media_two = 'L&#39Liveleak video downloader è uno strumento gratuito per scaricare qualsiasi video Liveleak online.';
		break;
		case 'portuguese':
			$text_media 	= 'Download de vídeos do Liveleak...';
			$text_media_two = 'O Liveleak video downloader é uma ferramenta gratuita para baixar qualquer vídeo online do Liveleak';
		break;
		case 'russian':
			$text_media 	= 'Скачать видео в Liveleak';
			$text_media_two = 'Загрузчик видео Liveleak - это бесплатный инструмент для загрузки любого онлайн видео Liveleak.';
		break;
		case 'spanish':
			$text_media 	= 'Descargar videos de Liveleak';
			$text_media_two = 'El descargador de videos de Liveleak es una herramienta gratuita para descargar cualquier video de Liveleak en línea.';
		break;
		case 'turkish':
			$text_media 	= 'Liveleak videoları indir';
			$text_media_two = 'Liveleak video downloader, herhangi bir Liveleak videosunu çevrimiçi olarak indirmek için ücretsiz bir araçtır.';
		break;
		default: 
			$text_media 	= $lang->Text_1;
			$text_media_two = '';
		break;
	}

?>