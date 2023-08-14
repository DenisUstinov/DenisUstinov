<?php

	$settings = $db->getRow('SELECT * FROM settings WHERE id=1');
	$categories = $db->getAll("SELECT * FROM categories");
	$subcategories = $db->getAll("SELECT * FROM subcategories");
	$site_title = $settings['title_settings'];
	$site_description = $settings['description_settings'];

	$host = HOST;
	$domain = DOMAIN;
	$date = date('r', time());

	header("Content-type: text/xml; charset=UTF-8");

echo <<<END
<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0">
<channel>
	<title>$site_title</title>
	<link>$host</link>
	<description>$site_description</description>
	<language>ru</language>
	<pubDate>$date</pubDate>
	<lastBuildDate>$date</lastBuildDate>
	<docs>$host/rss.xml</docs>
	<generator>Weblog Editor 2.0</generator>
	<copyright>Copyright 2015 $domain</copyright>
	<managingEditor>contacts@$domain</managingEditor>
	<webMaster>webmaster@$domain</webMaster>
END;

	$data = $db->getAll("SELECT * FROM articles WHERE date_articles < '2016-09-28 10:36:06' ORDER BY date_articles DESC LIMIT 0, 10");
	foreach($data as $data_value)
	{
		$url = $host.'/'.url_subcategories($data_value['subcategory_articles']).'/'.url_subcategories($data_value['subcategory_articles']).'/'.$data_value['url_articles'];
		$articles_title = $data_value['header_articles'];
		$articles_description = $data_value['preview_articles'];
		$date = date('r', strtotime($data_value['date_articles']));

echo <<<END
	<item>
		<title>$articles_title</title>
		<link>$url</link>
		<description><![CDATA[$articles_description]]></description>
		<pubDate>$date</pubDate>
		<guid isPermaLink="true">$url</guid>
	</item>
END;
}

echo <<<END
</channel>
</rss>
END;
?>