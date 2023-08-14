<?php

	/*
	* Шаблонизатор article_list
	*/

	$data = array();
	$data = $db->selectfunc($cur_page);

	$TMPL['article_list'] = '';

	if(count($data))
	{
		foreach($data as $data_value)
		{
			$TMPL['url_categories'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?id_categories='.$data_value['category_articles'];
			$TMPL['title_categories'] = title_categories($data_value['category_articles']);
			$TMPL['url_articles'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?id_categories='.$data_value['category_articles'].'&id='.$data_value['id'];
			$TMPL['title_articles'] = $data_value['title_articles'];
			$TMPL['text_articles'] = preview_article($data_value['text_articles']);
			$TMPL['image_articles'] = $data_value['image_articles'];
			$TMPL['date_articles'] = date_articles($data_value['date_articles']);

			$skin = new skin(DIRECTORI.'/templates/article_list.html');
			$TMPL['article_list'] .= $skin->make();
		}
		require_once DIRECTORI.'/views/paginator.php';
	}else{
		$error_reporting = 'no_articles';
		require_once DIRECTORI.'/views/error_reporting.php';
	}