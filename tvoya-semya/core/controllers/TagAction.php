<?php

	/**
	 * Контроллер формирования вывода просмотра статей тега
	 *
	 */

	$tags_articles = urldecode($matches['tags_articles']);
	$error_reporting = 'no_articles_tags';

	/* Для SEO сайта */
	$TMPL['navigation_string'] .= ' → <a title="'.$tags_articles.'">'.$tags_articles.'</a>';
	$TMPL['title_settings'] = $tags_articles.' - теги сайта '.DOMAIN;
	$TMPL['description_settings'] = '';
	$TMPL['keywords_settings'] = $tags_articles;
	/* Для SEO сайта */

	$TMPL['get'] = '<a href="'.HOST.'/tags/'.$tags_articles.'/2"></a>';
	$start = ($matches['current_page'] - 1) * $per_page;

	$data = array();
	$data = $db->getAll('SELECT * ,MATCH(tags_articles) AGAINST(?s IN BOOLEAN MODE) as REL FROM articles WHERE MATCH(tags_articles) AGAINST(?s IN BOOLEAN MODE) ORDER BY REL DESC LIMIT ?i, ?i', $tags_articles, $tags_articles, $start, $per_page);

	require_once CORE.'/views/view_articles_all.php';