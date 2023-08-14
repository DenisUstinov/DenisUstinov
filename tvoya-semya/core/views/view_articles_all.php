<?php

	/*
	* Представление вывода списка записей
	*/

	$TMPL['rows_articles_all'] = '';

	if(count($data))
	{
		foreach($data as $data_value)
		{
			$url_categories = url_categories($data_value['category_articles']);
			$url_subcategories = url_subcategories($data_value['subcategory_articles']);

			$TMPL['url_category_articles'] = HOST.'/'.$url_categories;
			$TMPL['url_subcategory_articles'] = HOST.'/'.$url_categories.'/'.$url_subcategories;
			$TMPL['url_articles'] = HOST.'/'.$url_categories.'/'.$url_subcategories.'/'.$data_value['url_articles'].'.html';

			$TMPL['category_articles'] = name_categories($data_value['category_articles']);
			$TMPL['subcategory_articles'] = name_subcategories($data_value['subcategory_articles']);
			$TMPL['header_articles'] = $data_value['header_articles'];
			$TMPL['preview_articles'] = $data_value['preview_articles'];
			$TMPL['image_articles'] = $data_value['image_articles'];
			$TMPL['date_articles'] = date_articles($data_value['date_articles']);

			$skin = new skin(DIRECTORY.'/templates/'.$settings['template_settings'].'/rows_articles_all.html');
			$TMPL['rows_articles_all'] .= $skin->make();
		}
	}
	else
	{
		require_once CORE.'/controllers/error_reporting.php';
	}

	$skin = new skin(DIRECTORY.'/templates/'.$settings['template_settings'].'/view_articles_all.html');
	$TMPL['content'] .= $skin->make();