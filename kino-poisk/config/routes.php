<?php

return [
	'^search\/(?P<search>.+)$' => ['controller' => 'Search'],
	'^(?P<id>[0-9-]+)$' => ['controller' => 'Article'],
	'^sitemap\/(?P<sitemap>[1-7]+)$' => ['controller' => 'Sitemap'],
	'^robots.txt$' => ['controller' => 'Robots'],
	'^send.php$' => ['controller' => 'Send'],
	'^$' => ['controller' => 'Main'],
];