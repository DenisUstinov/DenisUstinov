<?php

	/**
	 * Контроллер формирования вывода просмотра домашней страницы
	 *
	 */

	$TMPL['get'] = '<a href="'.HOST.'/2"></a>';
	$start = ($matches['current_page'] - 1) * $per_page;

	$data = array();
	$data = $db->getAll('SELECT * FROM articles ORDER BY date_articles DESC LIMIT ?i, ?i', $start, $per_page);

	require_once CORE.'/views/view_articles_all.php';