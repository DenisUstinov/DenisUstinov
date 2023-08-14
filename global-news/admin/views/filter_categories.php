<?php

	/*
	* Шаблонизатор меню категорий:
	*/

	$TMPL['filter_categories'] = '';
	$TMPL['rows_categories'] = '';

	$categories = $db->categories();

	if(count($categories))
	{
		foreach($categories as $categories_value){
			$TMPL['id'] = $categories_value['id'];
			$TMPL['title_categories'] = $categories_value['title_categories'];
			$TMPL['description_categories'] = $categories_value['description_categories'];
			$TMPL['keywords_categories'] = $categories_value['keywords_categories'];
			$TMPL['url_categories'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?table='.$table.'&id_categories='.$categories_value['id'];
			if(isset($id_categories) && $id_categories == $categories_value['id']){
				$TMPL['class_link'] = 'active';
				/* Для SEO сайта */
				$settings['title_settings'] = $categories_value['title_categories'];
				$settings['description_settings'] = $categories_value['description_categories'];
				$settings['keywords_settings'] = $categories_value['keywords_categories'];
				$TMPL['title_description'] = $categories_value['title_categories'];
				$TMPL['description'] = $categories_value['description_categories'];
				/* Для SEO сайта */
			}else{
				$TMPL['class_link'] = 'noactive';
			}
			$skin = new skin(DIRECTORI.'/admin/templates/rows_categories.html');
			$TMPL['rows_categories'] .= $skin->make();
		}
		$skin = new skin(DIRECTORI.'/admin/templates/filter_categories.html');
		$TMPL['filter_categories'] = $skin->make();
	}else{
		//$error_reporting = 'no_articles';
		//require_once DIRECTORI.'/views/error_reporting.php';
	}
?>