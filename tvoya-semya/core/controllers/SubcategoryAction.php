<?php

	/**
	 * Контроллер формирования вывода просмотра статей текущей подкатегории
	 *
	 */

	$error_reporting = 'no_articles_subcategory';

	$data = array();
	if(isset($id_category) && isset($id_subcategory))
	{
		$TMPL['get'] = '<a href="'.HOST.'/'.$matches['url_categories'].'/'.$matches['url_subcategories'].'/2"></a>';
		$start = ($matches['current_page'] - 1) * $per_page;

		$data = $db->getAll('SELECT * FROM articles WHERE category_articles = ?i AND subcategory_articles = ?i ORDER BY date_articles DESC LIMIT ?i, ?i', $id_category, $id_subcategory, $start, $per_page);
	}
	else
	{
		$error_reporting = '404';
	}
	require_once CORE.'/views/view_articles_all.php';