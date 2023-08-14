<?php

	/*
	* Шаблонизатор вывода одной записи (article_content)
	* и похожих записей в текущей категории (articles_similar)
	*/

	$data = array();
	$data = $db->selectfunc($cur_page);

	$TMPL['article_content'] = '';
	$TMPL['breadcrumb'] = '';
	$TMPL['articles_similar'] = '';
	$TMPL['rows_articles_similar'] = ''; // 

	if(count($data))
	{
		foreach($data as $data_value)
		{
			$TMPL['url_categories'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?id_categories='.$data_value['category_articles'];
			$TMPL['title_categories'] = title_categories($data_value['category_articles']);
			$TMPL['url_articles'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?id_categories='.$data_value['category_articles'].'&id='.$data_value['id'];
			$TMPL['title_articles'] = $data_value['title_articles'];
			$TMPL['description_articles'] = $data_value['description_articles'];
			$TMPL['image_articles'] = $data_value['image_articles'];
			$TMPL['date_articles'] = date_articles($data_value['date_articles']);

			if($id == $data_value['id'])
			{
				$TMPL['title_settings'] = $settings['title_settings'];
				$skin = new skin(DIRECTORI.'/templates/breadcrumb.html');
				$TMPL['breadcrumb'] = $skin->make();

				/* Для SEO сайта */
				$TMPL['title_settings'] = $data_value['title_articles'];
				$TMPL['description_settings'] = $data_value['description_articles'];
				$TMPL['keywords_settings'] = $data_value['keywords_articles'];
				/* Для SEO сайта */

				$TMPL['text_articles'] = nl2br($data_value['text_articles']);

				$skin = new skin(DIRECTORI.'/templates/article_content.html');
				$TMPL['article_content'] = $skin->make();
			}
			else
			{
				$TMPL['text_articles'] = preview_article_120($data_value['text_articles']);

				$skin = new skin(DIRECTORI.'/templates/rows_articles_similar.html');
				$TMPL['rows_articles_similar'] .= $skin->make();
			}
		}
		$skin = new skin(DIRECTORI.'/templates/articles_similar.html');
		$TMPL['articles_similar'] = $skin->make();
	}
	else
	{
		$error_reporting = 'no_articles';
		require_once DIRECTORI.'/views/error_reporting.php';
	}