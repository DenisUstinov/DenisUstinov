<?php

	$TMPL['content'] = '';
	$TMPL['HOST'] = HOST;
	$TMPL['DOMAIN'] = DOMAIN;
	$TMPL['ADMIN_DIRECTORY'] = ADMIN_DIRECTORY;

	/* Переменные рекламных мест */
	$advertisings = array();
	$advertisings = $db->getRow('SELECT * FROM advertisings WHERE id=1 and state_advertisings=1');
	require_once CORE.'/views/view_advertisings.php';

	/* Переменные настройки сайта */
	$settings = array();
	$settings = $db->getRow('SELECT * FROM settings WHERE id=1');
	require_once CORE.'/views/view_settings.php';
	$per_page = 9;
	$max_similar = 3;

	/* Навигация категорий статей */
	$categories = array();
	$categories = $db->getAll('SELECT * FROM categories ORDER BY sorting_categories');
	require_once CORE.'/views/view_navigation_categories.php';

	/* Навигация подкатегорий статей */
	$subcategories = array();
	$subcategories = $db->getAll('SELECT * FROM subcategories ORDER BY sorting_subcategories');
	require_once CORE.'/views/view_navigation_subcategories.php';

	require_once CORE.'/controllers/'.$action.'Action.php';

	/* Административная панель */
	require_once CORE.'/views/view_admin_panel.php';

	$skin = new skin(DIRECTORY.'/templates/'.$TMPL['template_settings'].'/index.html');
	echo $skin->make();