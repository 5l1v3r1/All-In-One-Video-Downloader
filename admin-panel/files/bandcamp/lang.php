<?php


	if(@$_COOKIE["_lang_shareplus"]!='') {
		$tipo = @$_COOKIE["_lang_shareplus"];
	}else{
		$tipo = $config['lang'];
	}

	switch ($tipo) {
		case 'chinese':
			$text_media 	= '下載Bandcamp視頻';
			$text_media_two = 'Bandcamp視頻下載器是一個免費的工具，可以在線下載任何Bandcamp視頻。';
		break;
		case 'english':
			$text_media 	= 'Download Bandcamp MP3';
			$text_media_two = 'The Bandcamp MP3 downloader is a free tool to download any Bandcamp MP3 online.';
		break;
		case 'French':
			$text_media 	= 'Téléchargez les MP3 Bandcamp';
			$text_media_two = 'Description des MP3 Bandcamp es una herramienta gratuitement pour télécharger des MP3 cualquier de Bandcamp en ligne.';
		break;
		case 'german':
			$text_media 	= 'Laden Sie Bandcamp-MP3 herunter';
			$text_media_two = 'Die MP3-Bandcamp ist ein kostenloses MP3-Bandcamp für die Installation.';
		break;
		case 'Italian':
			$text_media 	= 'Scarica i MP3 di Bandcamp';
			$text_media_two = 'L&#39Bandcamp MP3 downloader è uno strumento gratuito per scaricare qualsiasi MP3 Bandcamp online.';
		break;
		case 'portuguese':
			$text_media 	= 'Download de MP3 do Bandcamp...';
			$text_media_two = 'O Bandcamp MP3 downloader é uma ferramenta gratuita para baixar qualquer vídeo online do Bandcamp';
		break;
		case 'russian':
			$text_media 	= 'Скачать видео в Bandcamp';
			$text_media_two = 'Загрузчик видео Bandcamp - это бесплатный инструмент для загрузки любого онлайн видео Bandcamp.';
		break;
		case 'spanish':
			$text_media 	= 'Descargar MP3 de Bandcamp';
			$text_media_two = 'El descargador de MP3 de Bandcamp es una herramienta gratuita para descargar cualquier MP3 de Bandcamp en línea.';
		break;
		case 'turkish':
			$text_media 	= 'Bandcamp MP3 indir';
			$text_media_two = 'Bandcamp MP3 downloader, herhangi bir Bandcamp MP3unu çevrimiçi olarak indirmek için ücretsiz bir araçtır.';
		break;
		default: 
			$text_media 	= $lang->Text_1;
			$text_media_two = '';
		break;
	}

?>