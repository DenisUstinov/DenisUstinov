<?php

	/**
	 * Контроллер вывода результатов поиска
	 */

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search_videos'])) {
		header('Location: '.HOST.'/search/'.$_POST['search_videos']);
	} else {
		$data = array();
		$data = json_decode(@file_get_contents('http://moonwalk.cc/api/videos.json?title='.urlencode($matches['search']).'&api_token=6e040cd6806dcc4add48b423d78c576e'));

		require_once DIRECTORY.'/core/views/Search.php';
	}