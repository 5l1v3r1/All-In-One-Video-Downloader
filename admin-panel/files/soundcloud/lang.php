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
			$text_media 	= 'Download Soundcloud MP3';
			$text_media_two = 'The Soundcloud MP3 downloader is a free tool to download any Soundcloud MP3 online.';
		break;
		case 'French':
			$text_media 	= 'Téléchargez les MP3 Soundcloud';
			$text_media_two = 'Description des MP3 Soundcloud es una herramienta gratuitement pour télécharger des MP3 cualquier de Soundcloud en ligne.';
		break;
		case 'german':
			$text_media 	= 'Laden Sie Soundcloud-MP3 herunter';
			$text_media_two = 'Die MP3-Soundcloud ist ein kostenloses MP3-Soundcloud für die Installation.';
		break;
		case 'Italian':
			$text_media 	= 'Scarica i MP3 di Soundcloud';
			$text_media_two = 'L&#39Soundcloud MP3 downloader è uno strumento gratuito per scaricare qualsiasi MP3 Soundcloud online.';
		break;
		case 'portuguese':
			$text_media 	= 'Download de MP3 do Soundcloud...';
			$text_media_two = 'O Soundcloud MP3 downloader é uma ferramenta gratuita para baixar qualquer vídeo online do Soundcloud';
		break;
		case 'russian':
			$text_media 	= 'Скачать видео в Soundcloud';
			$text_media_two = 'Загрузчик видео Soundcloud - это бесплатный инструмент для загрузки любого онлайн видео Soundcloud.';
		break;
		case 'spanish':
			$text_media 	= 'Descargar MP3 de Soundcloud';
			$text_media_two = 'El descargador de MP3 de Soundcloud es una herramienta gratuita para descargar cualquier MP3 de Soundcloud en línea.';
		break;
		case 'turkish':
			$text_media 	= 'Soundcloud MP3 indir';
			$text_media_two = 'Soundcloud MP3 downloader, herhangi bir Soundcloud MP3unu çevrimiçi olarak indirmek için ücretsiz bir araçtır.';
		break;
		default: 
			$text_media 	= $lang->Text_1;
			$text_media_two = '';
		break;
	}

?>