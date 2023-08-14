<?php

	/*
	* Представления меню категорий.
	*/

	$TMPL['modal_menu'] = '';
	$TMPL['navigation_categories'] = '';

	if(count($categories))
	{
		foreach($categories as $categories_value)
		{
			$TMPL['url_categories'] = 'href="'.HOST.'/'.$categories_value['url_categories'].'"';
			$TMPL['name_categories'] = $categories_value['name_categories'];

			if (isset($matches['url_categories']) && $matches['url_categories'] == $categories_value['url_categories']) {
				$id_category = $categories_value['id'];
				$TMPL['class_link'] = 'active';

				if ($action == 'Category') {
					$TMPL['url_categories'] = '';
					$TMPL['navigation_string'] .= ' → <a title="'.$categories_value['name_categories'].'">'.$categories_value['name_categories'].'</a>';
				} else {
					$TMPL['navigation_string'] .= ' → <a '.$TMPL['url_categories'].' title="'.$categories_value['name_categories'].'">'.$categories_value['name_categories'].'</a>';
				}
				/* Для SEO сайта */
				$TMPL['preview_settings'] = $categories_value['preview_categories'];
				$TMPL['title_settings'] = $categories_value['title_categories'];
				$TMPL['description_settings'] = $categories_value['description_categories'];
				$TMPL['keywords_settings'] = $categories_value['keywords_categories'];
				/* Для SEO сайта */
			} else {
				$TMPL['class_link'] = 'noactive';
			}

			$skin = new skin(DIRECTORY.'/templates/'.$settings['template_settings'].'/modal_menu.html');
			$TMPL['modal_menu'] .= $skin->make();

			$skin = new skin(DIRECTORY.'/templates/'.$settings['template_settings'].'/navigation_categories.html');
			$TMPL['navigation_categories'] .= $skin->make();
		}
	}