<?php
session_start();

$TMPL['admin_panel'] = '';

if (isset($_SESSION['user_id']))
{
	if(isset($id))
	{
		$TMPL['get_admin'] = $id;
		$TMPL['table'] = 'articles';
		$TMPL['editor_label'] = 'Статью';
	}
	elseif(isset($id_pages))
	{
		$TMPL['get_admin'] = $id_pages;
		$TMPL['table'] = 'pages';
		$TMPL['editor_label'] = 'Страницу';
	}
	elseif(isset($id_subcategory))
	{
		$TMPL['get_admin'] = $id_subcategory;
		$TMPL['table'] = 'subcategories';
		$TMPL['editor_label'] = 'Подкатегорию';
	}
	elseif(isset($id_category))
	{
		$TMPL['get_admin'] = $id_category;
		$TMPL['table'] = 'categories';
		$TMPL['editor_label'] = 'Категорию';
	}
	else{
		$TMPL['editor_button_none'] = 'display:none;';
		$TMPL['get_admin'] = '';
	}

	$TMPL['admin_directory'] = ADMIN_DIRECTORY;

	$skin = new skin(DIRECTORY.'/templates/admin/admin_panel.html');
	$TMPL['admin_panel'] =  $skin->make();
}