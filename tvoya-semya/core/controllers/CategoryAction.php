<?php

	/**
	 * Контроллер формирования вывода просмотра статей текущей категории
	 *
	 */

	$error_reporting = 'no_articles_category';

	$data = array();
	if(isset($id_category))
	{
		$TMPL['get'] = '<a href="'.HOST.'/'.$matches['url_categories'].'/2"></a>';
		$start = ($matches['current_page'] - 1) * $per_page;

		$data = $db->getAll('SELECT * FROM articles WHERE category_articles = ?i ORDER BY date_articles DESC LIMIT ?i, ?i', $id_category, $start, $per_page);
	}
	else
	{
		$error_reporting = '404';
	}
	require_once CORE.'/views/view_articles_all.php';