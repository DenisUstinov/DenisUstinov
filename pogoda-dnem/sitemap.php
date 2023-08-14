<?php
	error_reporting(E_ALL);
	require_once 'url.php';
	define('DATE_FORMAT_RFC822','r');
	header("Content-type: text/xml; charset=UTF-8");
	$time = strftime('%Y-%m-%d');
	$hosts = HOSTS;
	$domains = DOMAINS;

echo <<<START
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url>
		<loc>$hosts/</loc>
		<lastmod>$time</lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.8</priority>
	</url>
START;

/* Вывод карты статей */
	require_once DIRECTORI.'/core/ar_subdomen_city.php';
	foreach($ar_subdomen_city as $key_cities => $value_cities){
		$url = 'http://'.$key_cities.'.'.idn_to_utf8($domains);
echo <<<ARTICLES

	<url>
		<loc>$url</loc>
		<lastmod>$time</lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.6</priority>
	</url>

ARTICLES;
	}
/*.Вывод карты статей */

echo <<<END
</urlset>
END;
?>