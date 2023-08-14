<?php

	/**
	 * Контроллер формирования вывода просмотра статьи
	 *
	 */

	$error_reporting = 'no_articles_semilar';

	$data = array();
	if (isset($id_category) && isset($id_subcategory))
	{
		$data = $db->getRow("SELECT * FROM articles WHERE url_articles = ?s", $matches['url_articles']);
	}
	else
	{
		$error_reporting = '404';
	}
	require_once CORE.'/views/view_articles_one.php';

	/* Вывод похожих по тегу статей */
	if(isset($data['tags_articles']))
	{
		$data = $db->getAll('SELECT * ,MATCH(tags_articles) AGAINST(?s IN BOOLEAN MODE) AS REL FROM articles WHERE url_articles != ?s AND MATCH(tags_articles) AGAINST(?s IN BOOLEAN MODE)ORDER BY REL DESC LIMIT 1, ?i', $data['tags_articles'], $matches['url_articles'], $data['tags_articles'], $max_similar);
	}
	require_once CORE.'/views/view_articles_all.php';