<?php
	/* Норм дата */
	function date_articles($normdate){
		$time = strtotime($normdate);
		$out = strftime('%d.%m.%Y', $time);
		return $out;
	}
	/*.Норм дата */

	/* Создание превью статьи */
	function preview_article($preview_article){
		$preview_article = mb_substr($preview_article,0,mb_strrpos(mb_substr($preview_article,0,150,'utf-8'),' ','utf-8'),'utf-8').' ...';
		return $preview_article;
	}
	/*.Создание превью статьи */

	/* Создание превью статьи */
	function preview_article_120($preview_article){
		$preview_article = mb_substr($preview_article,0,mb_strrpos(mb_substr($preview_article,0,100,'utf-8'),' ','utf-8'),'utf-8').' ...';
		return $preview_article;
	}
	/*.Создание превью статьи */
	/* Имя текущей категории */
	function title_categories($id_cat_articles){
		global $categories;
		foreach($categories as $catval){
			if($id_cat_articles == $catval['id']){
				$title_categories = $catval['title_categories'];
				return $title_categories;
			}
		}
	}
	/*.Имя текущей категории */

	/* Имя текущей статьи */
	function title_articles($id_articles){
		global $data;
		foreach($data as $artticlval){
			if($id_articles == $artticlval['id']){
				$title_articles = $artticlval['title_articles'];
				return $title_articles;
			}
		}
	}
	/*.Имя текущей статьи */
?>