<?php

    set_time_limit(100);
	$out = date("Y-m-d");
	$host = HOST;
	header("Content-type: text/xml; charset=UTF-8");

echo <<<START
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url>
		<loc>$host</loc>
		<lastmod>$out</lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.8</priority>
	</url>
START;

	$url = 'http://moonwalk.cc/api/serials_russian.xml?api_token=6e040cd6806dcc4add48b423d78c576e';
	$flags = false;

	switch($sitemap)
	{
		case 1: $url = 'http://moonwalk.cc/api/movies_anime.xml?api_token=6e040cd6806dcc4add48b423d78c576e'; $flags = true; break;
		case 2: $url = 'http://moonwalk.cc/api/movies_camrip.xml?api_token=6e040cd6806dcc4add48b423d78c576e'; $flags = true; break;
		case 3: $url = 'http://moonwalk.cc/api/movies_foreign.xml?api_token=6e040cd6806dcc4add48b423d78c576e'; $flags = true; break;
		case 4: $url = 'http://moonwalk.cc/api/movies_russian.xml?api_token=6e040cd6806dcc4add48b423d78c576e'; $flags = true; break;
		case 5: $url = 'http://moonwalk.cc/api/serials_anime.xml?api_token=6e040cd6806dcc4add48b423d78c576e'; $flags = false; break;
		case 6: $url = 'http://moonwalk.cc/api/serials_foreign.xml?api_token=6e040cd6806dcc4add48b423d78c576e'; $flags = false; break;
		case 7: $url = 'http://moonwalk.cc/api/serials_russian.xml?api_token=6e040cd6806dcc4add48b423d78c576e'; $flags = false; break;
		default: break;
	}

	$data = '';
	$data = simplexml_load_file($url);

if($flags)
{
	foreach($data->movies->movie as $value)
	{
		$kinopoisk_id = $value->{'kinopoisk_id'};
echo <<<VIDEOS

	<url>
		<loc>$host/$kinopoisk_id</loc>
		<lastmod>$out</lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.5</priority>
	</url>

VIDEOS;
	}
}
else
{
	foreach($data->serials->serial as $value)
	{
		$kinopoisk_id = $value->{'kinopoisk_id'};
echo <<<VIDEOS

	<url>
		<loc>$host/$kinopoisk_id</loc>
		<lastmod>$out</lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.5</priority>
	</url>

VIDEOS;
	}
}

echo <<<END
</urlset>
END;
?>