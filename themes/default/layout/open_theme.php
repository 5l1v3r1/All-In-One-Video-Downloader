<!DOCTYPE html>
<html>
	<head>
    {{EXTRA_TOP}}
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<?php if($CODE['URL_OG'] == '200'){ ?>
			<title>{{CONTAINER_TITLE}} {{CONFIG name_site}}</title> 
			<meta name="title" content="<?php echo $CODE['OG_TAG_TITLE']; ?>">
			<meta name="description" content="{{CONTAINER_DESC}}">
			<meta name="image" content="<?php echo $CODE['OG_TAG_IMAGE']; ?>">
			<meta name="url" content="{{CONTAINER_URL}}">
			<meta property="og:title" content="<?php echo $CODE['OG_TAG_TITLE']; ?>" />
			<meta property="og:type" content="website" />
			<meta property="og:url" content="{{CONTAINER_URL}}" />
			<meta property="og:image" content="<?php echo $CODE['OG_TAG_IMAGE']; ?>" />
			<meta property="og:description" content="{{CONTAINER_DESC}}" />
			<meta property="og:site_name" content="{{CONTAINER_NAME}}" />
	<?php }else{ ?>
			<?php if(@$CODE['ACTIVE_MEDIA'] == 'ok'){ ?>	
			<title>{{CONTAINER_TITLE}} <?php echo $text_media; ?></title> 
			<meta name="title" content="{{CONTAINER_TITLE}} | <?php echo $text_media; ?>">
			<meta name="description" content="{{CONTAINER_DESC}} | <?php echo $text_media_two; ?>">
			<meta name="image" content="{{CONFIG theme_url}}/img/icon.png">
			<meta property="og:title" content="{{CONTAINER_TITLE}} | <?php echo $text_media; ?>" />
			<meta property="og:type" content="website" />
			<meta property="og:url" content="{{CONTAINER_URL}}" />
			<meta property="og:image" content="{{CONFIG theme_url}}/img/icon.png" />
			<meta property="og:description" content="{{CONTAINER_DESC}} | <?php echo $text_media_two; ?>" />
			<meta property="og:site_name" content="{{CONTAINER_NAME}}" />	
			<?php }else{ ?>	
			<title>{{CONTAINER_TITLE}} {{CONFIG name_site}}</title> 
			<meta name="title" content="{{CONTAINER_TITLE}}">
			<meta name="description" content="{{CONTAINER_DESC}}">
			<meta name="image" content="{{CONFIG theme_url}}/img/icon.png">
			<meta property="og:title" content="{{CONTAINER_TITLE}}" />
			<meta property="og:type" content="website" />
			<meta property="og:url" content="{{CONTAINER_URL}}" />
			<meta property="og:image" content="{{CONFIG theme_url}}/img/icon.png" />
			<meta property="og:description" content="{{CONTAINER_DESC}}" />
			<meta property="og:site_name" content="{{CONTAINER_NAME}}" />
			<?php } ?>	
	<?php } ?>	
    <link rel="shortcut icon" type="image/png" href="{{CONFIG theme_url}}/img/icon.png"/>
	</head>
<body>
	<script type="text/javascript">
        function Ajax_Requests_File(){
            return "<?php echo $config['site_url']; ?>/requests.php"
		}
	</script>
	<input type="hidden" class="main_session" value="{{MAIN_URL}}">
	{{CONTAINER_CONTENT}}
    {{EXTRA_BOTTOM}}
</body>
</html>