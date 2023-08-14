<?php

	/*
	* Шаблонизатор меню подкатегорий:
	*/

	$TMPL['filter_subcategories'] = '';
	$TMPL['rows_subcategories'] = '';

	if(isset($id_categories))
	{
		$subcategories = $db->subcategories($id_categories);
		if(count($subcategories))
		{
			foreach ($subcategories as $subcategories_value){
				$TMPL['id'] = $subcategories_value['id'];
				$TMPL['title_subcategories'] = $subcategories_value['title_subcategories'];
				$TMPL['description_subcategories'] = $subcategories_value['description_subcategories'];
				$TMPL['keywords_subcategories'] = $subcategories_value['keywords_subcategories'];
				$TMPL['category_subcategories'] = $subcategories_value['category_subcategories'];
				$TMPL['url_subcategories'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?table='.$table.'&id_categories='.$subcategories_value['category_subcategories'].'&id_subcategories='.$subcategories_value['id'].'"';
				if(isset($id_subcategories) && $id_subcategories == $subcategories_value['id']){
					$TMPL['class_link'] = 'active';
					/* Для SEO сайта */
					$settings['title_settings'] = $subcategories_value['title_subcategories'];
					$settings['description_settings'] = $subcategories_value['description_subcategories'];
					$settings['keywords_settings'] = $subcategories_value['keywords_subcategories'];
					$TMPL['title_description'] = $subcategories_value['title_subcategories'];
					$TMPL['description'] = $subcategories_value['description_subcategories'];
					/* Для SEO сайта */
				}else{
					$TMPL['class_link'] = 'noactive';
				}
				$skin = new skin(DIRECTORI.'/admin/templates/rows_subcategories.html');
				$TMPL['rows_subcategories'] .= $skin->make();
			}
			$skin = new skin(DIRECTORI.'/admin/templates/filter_subcategories.html');
			$TMPL['filter_subcategories'] = $skin->make();
		}else{
			//$error_reporting = 'no_articles';
			//require_once DIRECTORI.'/views/error_reporting.php';
		}
	}
?>