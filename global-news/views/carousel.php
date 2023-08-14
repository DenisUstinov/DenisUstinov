<?php

	/*
	* Шаблонизатор carousel
	*/

	$data = array();
	$data = $db->carousel($categories);

	$TMPL['carousel'] = '';
	$TMPL['rows_carousel_inner'] = '';
	$TMPL['rows_carousel_sections'] = '';

	if(count($data))
	{
		$i = 0;
		foreach($data as $data_value)
		{
			$TMPL['url_articles'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?id_categories='.$data_value['category_articles'].'&id='.$data_value['id'];
			$TMPL['title_articles'] = $data_value['title_articles'];
			$TMPL['image_articles'] = $data_value['image_articles'];
			$TMPL['text_articles'] = preview_article_120($data_value['text_articles']);
			$TMPL['title_categories'] = title_categories($data_value['category_articles']);
			$TMPL['i'] = $i;

			$i++;
			if($i == 1){
				$TMPL['class_link'] = 'active';
			}else{
				$TMPL['class_link'] = 'noactive';
			}

			$skin = new skin(DIRECTORI.'/templates/rows_carousel_inner.html');
			$TMPL['rows_carousel_inner'] .= $skin->make();

			$skin = new skin(DIRECTORI.'/templates/rows_carousel_sections.html');
			$TMPL['rows_carousel_sections'] .= $skin->make();
		}
		$skin = new skin(DIRECTORI.'/templates/carousel.html');
		$TMPL['carousel'] = $skin->make();
	}else{
		$error_reporting = 'no_slider';
		require_once DIRECTORI.'/views/error_reporting.php';
	}