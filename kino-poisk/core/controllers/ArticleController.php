<?php

	/**
	 * Контроллер вывода результатов поиска
	 */

	$row = array();
	$row = $db->getRow('SELECT * FROM articles WHERE id_articles=?i', $matches['id']);

	$data = json_decode(@file_get_contents('http://moonwalk.cc/api/videos.json?kinopoisk_id='.$matches['id'].'&api_token=6e040cd6806dcc4add48b423d78c576e'));

	require_once DIRECTORY.'/core/views/Article.php';