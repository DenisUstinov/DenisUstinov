<?php

	/*
	 * Контроллер файла роботс
	 */
	header("Content-type: text/txt; charset=UTF-8");
	$host = HOST;

echo <<<START
User-agent: Yandex
Disallow: /templates/
Disallow: /search*
Host: $host

User-agent: Googlebot
Disallow: /templates/
Disallow: /search*
Allow: /templates/images/

User-agent: Mail.Ru
Disallow: /templates/
Disallow: /search*
Allow: /templates/images/

User-agent: *
Disallow: /templates/
Disallow: /search*
Allow: /templates/images/

User-agent: Googlebot-Image
Allow: /templates/images/

User-agent: YandexImages
Allow: /templates/images/

User-agent: Mediapartners-Google
Disallow:

User-Agent: YaDirectBot
Disallow:

Sitemap: $host/sitemap/1
Sitemap: $host/sitemap/2
Sitemap: $host/sitemap/3
Sitemap: $host/sitemap/4
Sitemap: $host/sitemap/5
Sitemap: $host/sitemap/6
Sitemap: $host/sitemap/7
START;
