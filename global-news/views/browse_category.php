<?php

	/*
	* Шаблонизатор article_list
	*/

	$TMPL['content'] = '';
	$TMPL['article_list'] = '';
	$TMPL['article_featured'] = '';

	$data = array();
	$data = $db->selectfunc($cur_page);

	if(count($data))
	{
		$i = 0;
		foreach($data as $data_value)
		{
			$TMPL['date_articles'] = date_articles($data_value['date_articles']);
			$TMPL['url_articles'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?id_categories='.$data_value['category_articles'].'&id='.$data_value['id'];
			$TMPL['title_articles'] = $data_value['title_articles'];
			$TMPL['image_articles'] = $data_value['image_articles'];
			$TMPL['text_articles'] = preview_article($data_value['text_articles']);
			$TMPL['url_categories'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?id_categories='.$data_value['category_articles'];
			$TMPL['title_categories'] = title_categories($data_value['category_articles']);

			$i++;
			if($i == 1){
				$skin = new skin(DIRECTORI.'/templates/article_featured.html');
				$TMPL['article_featured'] .= $skin->make();
			}else{
				$skin = new skin(DIRECTORI.'/templates/article_list.html');
				$TMPL['article_list'] .= $skin->make();
			}
		}
		require_once DIRECTORI.'/views/paginator.php';

		$skin = new skin(DIRECTORI.'/templates/browse_category.html');
		$TMPL['content'] = $skin->make();
	}else{
		$error_reporting = 'no_articles';
		require_once DIRECTORI.'/views/error_reporting.php';
	}