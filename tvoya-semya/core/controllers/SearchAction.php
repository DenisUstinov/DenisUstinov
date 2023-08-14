<?php

	/**
	 * Контроллер формирования вывода просмотра статей поиска
	 *
	 */
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search']))
	{
		$search_string = trim(preg_replace('/\s{2,}/', ' ', $_POST['search']));
		$search_string = str_replace(' ', '%20', $search_string);
		header('Location: '.HOST.'/search/'.$search_string);
	}
	else
	{

		$search_articles = urldecode($matches['search_articles']);
		$error_reporting = 'no_articles_search';

		/* Для SEO сайта */
		$TMPL['navigation_string'] .= ' → <a title="'.$search_articles.'">'.$search_articles.'</a>';
		$TMPL['title_settings'] = $search_articles.' - поиск на сайте '.DOMAIN;
		$TMPL['description_settings'] = '';
		$TMPL['keywords_settings'] = $search_articles;
		/* Для SEO сайта */


		$TMPL['get'] = '<a href="'.HOST.'/search/'.str_replace(' ', '%20', $search_articles).'/2"></a>';
		$start = ($matches['current_page'] - 1) * $per_page;

		$data = array();
		$data = $db->getAll('SELECT * ,MATCH(text_articles) AGAINST(?s IN BOOLEAN MODE) as REL FROM articles WHERE MATCH(text_articles) AGAINST(?s IN BOOLEAN MODE) ORDER BY REL DESC LIMIT ?i, ?i', '+'.$search_articles, '+'.$search_articles, $start, $per_page);

		require_once CORE.'/views/view_articles_all.php';
	}