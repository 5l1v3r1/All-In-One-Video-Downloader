<?php


	if(@$_COOKIE["_lang_shareplus"]!='') {
		$tipo = @$_COOKIE["_lang_shareplus"];
	}else{
		$tipo = $config['lang'];
	}

	switch ($tipo) {
		case 'chinese':
			$text_media 	= '下載vk視頻';
			$text_media_two = 'vk視頻下載器是一個免費的工具，可以在線下載任何vk視頻。';
		break;
		case 'english':
			$text_media 	= 'Download vk videos';
			$text_media_two = 'The vk video downloader is a free tool to download any vk video online.';
		break;
		case 'French':
			$text_media 	= 'Téléchargez les vidéos vk';
			$text_media_two = 'Description des vidéos vk es una herramienta gratuitement pour télécharger des vidéos cualquier de vk en ligne.';
		break;
		case 'german':
			$text_media 	= 'Laden Sie vk-Videos herunter';
			$text_media_two = 'Die Video-vk ist ein kostenloses Video-vk für die Installation.';
		break;
		case 'Italian':
			$text_media 	= 'Scarica i video di vk';
			$text_media_two = 'L&#39vk video downloader è uno strumento gratuito per scaricare qualsiasi video vk online.';
		break;
		case 'portuguese':
			$text_media 	= 'Download de vídeos do vk...';
			$text_media_two = 'O vk video downloader é uma ferramenta gratuita para baixar qualquer vídeo online do vk';
		break;
		case 'russian':
			$text_media 	= 'Скачать видео в vk';
			$text_media_two = 'Загрузчик видео vk - это бесплатный инструмент для загрузки любого онлайн видео vk.';
		break;
		case 'spanish':
			$text_media 	= 'Descargar videos de vk';
			$text_media_two = 'El descargador de videos de vk es una herramienta gratuita para descargar cualquier video de vk en línea.';
		break;
		case 'turkish':
			$text_media 	= 'vk videoları indir';
			$text_media_two = 'vk video downloader, herhangi bir vk videosunu çevrimiçi olarak indirmek için ücretsiz bir araçtır.';
		break;
		default: 
			$text_media 	= $lang->Text_1;
			$text_media_two = '';
		break;
	}

?>