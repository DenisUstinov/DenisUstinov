<?php

return [
	'^tagsmap/(?P<currentPage>[0-9]+)\.xml$' => ['controller' => 'Sitemap', 'action' => 'tagsmap'],
	'^sitemap/(?P<currentPage>[0-9]+)\.xml$' => ['controller' => 'Sitemap', 'action' => 'rowsmap'],
	'^sitemap\.xml$' => ['controller' => 'Sitemap', 'action' => 'sitemaps'],
	
	'^robots\.txt$' => ['controller' => 'Robots'],
	
	'^opensearch\.xml$' => ['controller' => 'Opensearch'],
	
	'^suggestion\.php&q=(?P<alias>[^/><]+)?$' => ['controller' => 'Suggestion'],
	
	'^indexes$' => ['controller' => 'Indexes'],
	
	'^embed/(?P<alias>.+)$' => ['controller' => 'Embed'],
	
	'^imagefile/(?P<file>.+)$' => ['controller' => 'File', 'action' => 'imagefile'],
	'^videofile/(?P<file>.+)$' => ['controller' => 'File', 'action' => 'videofile'],
	
	'^cron/(?P<alias>[^/><]+)/?(?P<pageToken>.+)?$' => ['controller' => 'Cron'],
	
	'^page/(?P<alias>.+)$' => ['controller' => 'Main', 'action' => 'page'],
	'^watch/(?P<alias>.+)/(?P<titleTranslit>.+)$' => ['controller' => 'Main', 'action' => 'watch'],
	'^video/(?P<alias>[^/><]+)/?(?P<pageToken>.+)?$' => ['controller' => 'Main', 'action' => 'video'],
	'^search/(&q=)?(?P<alias>[^/><]+)/?(?P<pageToken>.+)?$' => ['controller' => 'Main', 'action' => 'search'],
	'^channel/(?P<alias>[^/]+)/?(?P<pageToken>.+)?$' => ['controller' => 'Main', 'action' => 'channel'],
	'^$' => ['controller' => 'Main']
];