<?php

	$settings = $db->getRow('SELECT * FROM settings WHERE id=1');
	$host = HOST;
	$out = date("Y-m-d");

	header("Content-type: text/xml; charset=UTF-8");

echo <<<START
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url>
		<loc>$host/</loc>
		<lastmod>2015-12-12</lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.8</priority>
	</url>
START;

	/* Вывод карты категорий */
	$categories = $db->getAll('SELECT * FROM categories');
	foreach($categories as $categories_value){
		$url = $host.'/'.$categories_value['url_categories'];
echo <<<CATEGORIES

	<url>
		<loc>$url</loc>
		<lastmod>$out</lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.7</priority>
	</url>

CATEGORIES;
	}
	/*.Вывод карты категорий */

	/* Вывод карты подкатегорий */
	$subcategories = $db->getAll("SELECT * FROM subcategories");
	foreach($subcategories as $subcategories_value){
		$url_categories = url_categories($subcategories_value['category_subcategories']);
		$url = $host.'/'.$url_categories.'/'.$subcategories_value['url_subcategories'];
echo <<<SUBCATEGORIES

	<url>
		<loc>$url</loc>
		<lastmod>$out</lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.6</priority>
	</url>

SUBCATEGORIES;
	}
	/*.Вывод карты подкатегорий */

/* Вывод карты статей */
	$data = $db->getAll("SELECT * FROM articles");
	foreach($data as $data_value)
	{
		$url_categories = url_categories($data_value['category_articles']);
		$url_subcategories = url_subcategories($data_value['subcategory_articles']);

		$url = $host.'/'.$url_categories.'/'.$url_subcategories.'/'.$data_value['url_articles'].'.html';
echo <<<ARTICLES

	<url>
		<loc>$url</loc>
		<lastmod>$out</lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.5</priority>
	</url>

ARTICLES;
	}
/*.Вывод карты статей */

echo <<<END
</urlset>
END;
?>