<?php


	if(@$_COOKIE["_lang_shareplus"]!='') {
		$tipo = @$_COOKIE["_lang_shareplus"];
	}else{
		$tipo = $config['lang'];
	}

	switch ($tipo) {
		case 'chinese':
			$text_media 	= '下載Soundcloud視頻';
			$text_media_two = 'Soundcloud視頻下載器是一個免費的工具，可以在線下載任何Soundcloud視頻。';
		break;
		case 'english':
			$text_media 	= 'Download Soundcloud videos';
			$text_media_two = 'The Soundcloud video downloader is a free tool to download any Soundcloud video online.';
		break;
		case 'French':
			$text_media 	= 'Téléchargez les vidéos Soundcloud';
			$text_media_two = 'Description des vidéos Soundcloud es una herramienta gratuitement pour télécharger des vidéos cualquier de Soundcloud en ligne.';
		break;
		case 'german':
			$text_media 	= 'Laden Sie Soundcloud-Videos herunter';
			$text_media_two = 'Die Video-Soundcloud ist ein kostenloses Video-Soundcloud für die Installation.';
		break;
		case 'Italian':
			$text_media 	= 'Scarica i video di Soundcloud';
			$text_media_two = 'L&#39Soundcloud video downloader è uno strumento gratuito per scaricare qualsiasi video Soundcloud online.';
		break;
		case 'portuguese':
			$text_media 	= 'Download de vídeos do Soundcloud...';
			$text_media_two = 'O Soundcloud video downloader é uma ferramenta gratuita para baixar qualquer vídeo online do Soundcloud';
		break;
		case 'russian':
			$text_media 	= 'Скачать видео в Soundcloud';
			$text_media_two = 'Загрузчик видео Soundcloud - это бесплатный инструмент для загрузки любого онлайн видео Soundcloud.';
		break;
		case 'spanish':
			$text_media 	= 'Descargar videos de Soundcloud';
			$text_media_two = 'El descargador de videos de Soundcloud es una herramienta gratuita para descargar cualquier video de Soundcloud en línea.';
		break;
		case 'turkish':
			$text_media 	= 'Soundcloud videoları indir';
			$text_media_two = 'Soundcloud video downloader, herhangi bir Soundcloud videosunu çevrimiçi olarak indirmek için ücretsiz bir araçtır.';
		break;
		default: 
			$text_media 	= $lang->Text_1;
			$text_media_two = '';
		break;
	}

?>