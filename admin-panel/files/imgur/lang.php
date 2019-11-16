<?php


	if(@$_COOKIE["_lang_shareplus"]!='') {
		$tipo = @$_COOKIE["_lang_shareplus"];
	}else{
		$tipo = $config['lang'];
	}

	switch ($tipo) {
		case 'chinese':
			$text_media 	= '下載imgur視頻';
			$text_media_two = 'imgur視頻下載器是一個免費的工具，可以在線下載任何imgur視頻。';
		break;
		case 'english':
			$text_media 	= 'Download imgur videos';
			$text_media_two = 'The imgur video downloader is a free tool to download any imgur video online.';
		break;
		case 'French':
			$text_media 	= 'Téléchargez les vidéos imgur';
			$text_media_two = 'Description des vidéos imgur es una herramienta gratuitement pour télécharger des vidéos cualquier de imgur en ligne.';
		break;
		case 'german':
			$text_media 	= 'Laden Sie imgur-Videos herunter';
			$text_media_two = 'Die Video-imgur ist ein kostenloses Video-imgur für die Installation.';
		break;
		case 'Italian':
			$text_media 	= 'Scarica i video di imgur';
			$text_media_two = 'L&#39imgur video downloader è uno strumento gratuito per scaricare qualsiasi video imgur online.';
		break;
		case 'portuguese':
			$text_media 	= 'Download de vídeos do imgur...';
			$text_media_two = 'O imgur video downloader é uma ferramenta gratuita para baixar qualquer vídeo online do imgur';
		break;
		case 'russian':
			$text_media 	= 'Скачать видео в imgur';
			$text_media_two = 'Загрузчик видео imgur - это бесплатный инструмент для загрузки любого онлайн видео imgur.';
		break;
		case 'spanish':
			$text_media 	= 'Descargar videos de imgur';
			$text_media_two = 'El descargador de videos de imgur es una herramienta gratuita para descargar cualquier video de imgur en línea.';
		break;
		case 'turkish':
			$text_media 	= 'imgur videoları indir';
			$text_media_two = 'imgur video downloader, herhangi bir imgur videosunu çevrimiçi olarak indirmek için ücretsiz bir araçtır.';
		break;
		default: 
			$text_media 	= $lang->Text_1;
			$text_media_two = '';
		break;
	}

?>