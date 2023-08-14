<?php

	/**
	 * Контроллер формирования карты сайта
	 *
	 */
	$articles = $db->getALL('SELECT * FROM articles');
	require_once CORE.'/views/view_sitemap_html.php';