<?php
	error_reporting(E_ALL);
	require_once 'url.php';
	$domains = DOMAINS;
	header("Content-type: text/txt; charset=UTF-8");
echo <<<MAIN_ARTICLES
User-agent: *
Host: http://xn--80afdbf6bfdbh.xn--p1ai/

MAIN_ARTICLES;

/* Вывод карты статей */
	require_once DIRECTORI.'/core/ar_subdomen_city.php';
	foreach($ar_subdomen_city as $key_cities => $value_cities){
		$url = 'http://'.$key_cities.'.'.idn_to_utf8($domains).'/sitemap.php';
echo <<<ARTICLES
Sitemap: $url

ARTICLES;
	}