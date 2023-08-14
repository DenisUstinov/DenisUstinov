<?php

	header("Content-type: text/txt; charset=UTF-8");
	$domain = DOMAIN;
	$settings = $db->getRow('SELECT * FROM settings WHERE id=1');
	$template = $settings['template_settings'];

echo <<<START
User-agent: Yandex
Disallow: /search*
Disallow: /tags*
Disallow: /panel*
Allow: /templates/$template/img/articles/large/
Host: https://$domain

User-agent: Googlebot
Disallow: /search*
Disallow: /tags*
Disallow: /panel*
Allow: /templates/$template/img/articles/large/

User-agent: Mail.Ru
Disallow: /search*
Disallow: /tags*
Disallow: /panel*
Allow: /templates/$template/img/articles/large/

User-agent: *
Disallow: /search*
Disallow: /tags*
Disallow: /panel*
Allow: /templates/$template/img/articles/large/

User-agent: Googlebot-Image
Allow: /templates/$template/img/articles/large/

User-agent: YandexImages
Allow: /templates/$template/img/articles/large/

User-agent: Mediapartners-Google
Disallow:

User-Agent: YaDirectBot
Disallow:

Sitemap: https://$domain/sitemap.xml

START;
