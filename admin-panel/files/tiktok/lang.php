<?php


	if(@$_COOKIE["_lang_shareplus"]!='') {
		$tipo = @$_COOKIE["_lang_shareplus"];
	}else{
		$tipo = $config['lang'];
	}

	switch ($tipo) {
		case 'chinese':
			$text_media 	= '下載TikTok視頻';
			$text_media_two = 'TikTok視頻下載器是一個免費的工具，可以在線下載任何TikTok視頻。';
		break;
		case 'english':
			$text_media 	= 'Download TikTok videos';
			$text_media_two = 'The TikTok video downloader is a free tool to download any TikTok video online.';
		break;
		case 'French':
			$text_media 	= 'Téléchargez les vidéos TikTok';
			$text_media_two = 'Description des vidéos TikTok es una herramienta gratuitement pour télécharger des vidéos cualquier de TikTok en ligne.';
		break;
		case 'german':
			$text_media 	= 'Laden Sie TikTok-Videos herunter';
			$text_media_two = 'Die Video-TikTok ist ein kostenloses Video-TikTok für die Installation.';
		break;
		case 'Italian':
			$text_media 	= 'Scarica i video di TikTok';
			$text_media_two = 'L&#39TikTok video downloader è uno strumento gratuito per scaricare qualsiasi video TikTok online.';
		break;
		case 'portuguese':
			$text_media 	= 'Download de vídeos do TikTok...';
			$text_media_two = 'O TikTok video downloader é uma ferramenta gratuita para baixar qualquer vídeo online do TikTok';
		break;
		case 'russian':
			$text_media 	= 'Скачать видео в TikTok';
			$text_media_two = 'Загрузчик видео TikTok - это бесплатный инструмент для загрузки любого онлайн видео TikTok.';
		break;
		case 'spanish':
			$text_media 	= 'Descargar videos de TikTok';
			$text_media_two = 'El descargador de videos de TikTok es una herramienta gratuita para descargar cualquier video de TikTok en línea.';
		break;
		case 'turkish':
			$text_media 	= 'TikTok videoları indir';
			$text_media_two = 'TikTok video downloader, herhangi bir TikTok videosunu çevrimiçi olarak indirmek için ücretsiz bir araçtır.';
		break;
		default: 
			$text_media 	= $lang->Text_1;
			$text_media_two = '';
		break;
	}

?>