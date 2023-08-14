<?php

	/*
	* Представление вывода одной записи
	*/

	$TMPL['rows_articles_one'] = '';

	if(count($data))
	{
		$url_categories = url_categories($data['category_articles']);
		$url_subcategories = url_subcategories($data['subcategory_articles']);

		$TMPL['url_category_articles'] = HOST.'/'.$url_categories;
		$TMPL['url_subcategory_articles'] = HOST.'/'.$url_categories.'/'.$url_subcategories;
		$TMPL['url_articles'] = HOST.'/'.$url_categories.'/'.$url_subcategories.'/'.$data['url_articles'];

		$TMPL['category_articles'] = name_categories($data['category_articles']);
		$TMPL['header_articles'] = $data['header_articles'];
		$TMPL['preview_articles'] = $data['preview_articles'];
		$TMPL['text_articles'] = $data['text_articles'];//Переносы строк
		$TMPL['image_articles'] = $data['image_articles'];
		//$TMPL['date_articles'] = date_articles($data['date_articles']);

		/* Преобразую в читабельный вид теги статьи */
		//$tags_articles_array = explode(',', $data['tags_articles']);
		$tags_articles = array();
		foreach(explode(',', $data['tags_articles']) as $tags_articles_value)
			$tags_articles[] = '<a href="'.HOST.'/tags/'.$tags_articles_value.'">'.$tags_articles_value.'</a>';

		$TMPL['tags_articles'] = implode(', ', $tags_articles);
		/* Преобразую в читабельный вид теги статьи */

		/* Для SEO сайта */
		$TMPL['preview_settings'] = '';
		$id = $data['id'];//для админки
		$TMPL['navigation_string'] .= ' → <a title="'.$data['header_articles'].'">'.$data['header_articles'].'</a>';
		if (empty($data['title_articles'])) {
			$TMPL['title_settings'] = $data['header_articles'];
		} else {
			$TMPL['title_settings'] = $data['title_articles'];
		}
		if (empty($data['description_articles'])) {
			$TMPL['description_settings'] = $data['preview_articles'];
		} else {
			$TMPL['description_settings'] = $data['description_articles'];
		}
 
		$TMPL['keywords_settings'] = $data['keywords_articles'];
		/* Для SEO сайта */

		$skin = new skin(DIRECTORY.'/templates/'.$settings['template_settings'].'/rows_articles_one.html');
		$TMPL['rows_articles_one'] = $skin->content();
	}
	else
	{
		$error_reporting = '404';
		require_once CORE.'/controllers/error_reporting.php';
	}

	$skin = new skin(DIRECTORY.'/templates/'.$settings['template_settings'].'/view_articles_one.html');
	$TMPL['content'] .= $skin->make();