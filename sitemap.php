<?php
header('Content-type: application/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    <?php
	
    require_once './application/Connection.php';

	$links		 = PHP_GetMedia('');
    foreach ($links as $data) {
        echo "<url>";
        echo "<loc>".$data['platform']." Free downloader online</loc>";
        echo "<priority>1.00</priority>";
        echo "</url>";
    }
    ?>
</urlset>