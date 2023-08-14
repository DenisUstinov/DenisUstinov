<?php

	/*
	* Шаблонизатор main_navigation:
	*/

	$categories =array();
	$categories = $db->categories();

	$TMPL['mobile_navigation'] = '';
	$TMPL['rows_mobile_navigation'] = '';
	$TMPL['main_navigation'] = '';
	$TMPL['rows_main_navigation'] = '';
	$TMPL['footer_navigation'] = '';
	$TMPL['rows_footer_navigation'] = '';

	if(count($categories))
	{
		foreach($categories as $categories_value){
			$TMPL['id'] = $categories_value['id'];
			$TMPL['title_categories'] = $categories_value['title_categories'];
			$TMPL['description_categories'] = $categories_value['description_categories'];
			$TMPL['keywords_categories'] = $categories_value['keywords_categories'];
			$TMPL['url_categories'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?id_categories='.$categories_value['id'];
			if(isset($id_categories) && $id_categories == $categories_value['id']){
				$TMPL['class_link'] = 'active';
				/* Для SEO сайта */
				$TMPL['title_settings'] = $categories_value['title_categories'];
				$TMPL['description_settings'] = $categories_value['description_categories'];
				$TMPL['keywords_settings'] = $categories_value['keywords_categories'];
				/* Для SEO сайта */
			}else{
				$TMPL['class_link'] = 'noactive';
			}
			$skin = new skin(DIRECTORI.'/templates/rows_mobile_navigation.html');
			$TMPL['rows_mobile_navigation'] .= $skin->make();

			$skin = new skin(DIRECTORI.'/templates/rows_main_navigation.html');
			$TMPL['rows_main_navigation'] .= $skin->make();

			$skin = new skin(DIRECTORI.'/templates/rows_footer_navigation.html');
			$TMPL['rows_footer_navigation'] .= $skin->make();
		}
		$skin = new skin(DIRECTORI.'/templates/mobile_navigation.html');
		$TMPL['mobile_navigation'] = $skin->make();

		$skin = new skin(DIRECTORI.'/templates/main_navigation.html');
		$TMPL['main_navigation'] = $skin->make();

		$skin = new skin(DIRECTORI.'/templates/footer_navigation.html');
		$TMPL['footer_navigation'] = $skin->make();
	}else{
		//$error_reporting = 'no_articles';
		//require_once DIRECTORI.'/views/error_reporting.php';
	}
?>