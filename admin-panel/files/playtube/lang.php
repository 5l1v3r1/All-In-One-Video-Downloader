<?php


	if(@$_COOKIE["_lang_shareplus"]!='') {
		$tipo = @$_COOKIE["_lang_shareplus"];
	}else{
		$tipo = $config['lang'];
	}

	switch ($tipo) {
		case 'chinese':
			$text_media 	= '下載Playscript視頻';
			$text_media_two = 'Playscript視頻下載器是一個免費的工具，可以在線下載任何Playscript視頻。';
		break;
		case 'english':
			$text_media 	= 'Download Playscript videos';
			$text_media_two = 'The Playscript video downloader is a free tool to download any Playscript video online.';
		break;
		case 'French':
			$text_media 	= 'Téléchargez les vidéos Playscript';
			$text_media_two = 'Description des vidéos Playscript es una herramienta gratuitement pour télécharger des vidéos cualquier de Playscript en ligne.';
		break;
		case 'german':
			$text_media 	= 'Laden Sie Playscript-Videos herunter';
			$text_media_two = 'Die Video-Playscript ist ein kostenloses Video-Playscript für die Installation.';
		break;
		case 'Italian':
			$text_media 	= 'Scarica i video di Playscript';
			$text_media_two = 'L&#39Playscript video downloader è uno strumento gratuito per scaricare qualsiasi video Playscript online.';
		break;
		case 'portuguese':
			$text_media 	= 'Download de vídeos do Playscript...';
			$text_media_two = 'O Playscript video downloader é uma ferramenta gratuita para baixar qualquer vídeo online do Playscript';
		break;
		case 'russian':
			$text_media 	= 'Скачать видео в Playscript';
			$text_media_two = 'Загрузчик видео Playscript - это бесплатный инструмент для загрузки любого онлайн видео Playscript.';
		break;
		case 'spanish':
			$text_media 	= 'Descargar videos de Playscript';
			$text_media_two = 'El descargador de videos de Playscript es una herramienta gratuita para descargar cualquier video de Playscript en línea.';
		break;
		case 'turkish':
			$text_media 	= 'Playscript videoları indir';
			$text_media_two = 'Playscript video downloader, herhangi bir Playscript videosunu çevrimiçi olarak indirmek için ücretsiz bir araçtır.';
		break;
		default: 
			$text_media 	= $lang->Text_1;
			$text_media_two = '';
		break;
	}

?>