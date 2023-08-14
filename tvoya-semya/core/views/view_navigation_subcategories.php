<?php

	/*
	* Представления меню подкатегорий.
	*/

	$TMPL['navigation_subcategories'] = '';

	if(count($subcategories) && isset($id_category))
	{
		foreach($subcategories as $subcategories_value)
		{
			if($subcategories_value['category_subcategories'] == $id_category)
			{
				$TMPL['url_subcategories'] = 'href="'.HOST.'/'.$matches['url_categories'].'/'.$subcategories_value['url_subcategories'].'"';
				$TMPL['name_subcategories'] = $subcategories_value['name_subcategories'];

				if(isset($matches['url_subcategories']) && $matches['url_subcategories'] == $subcategories_value['url_subcategories'])
				{
					$id_subcategory = $subcategories_value['id'];
					$TMPL['class_link'] = 'active';

					if ($action == 'Subcategory') {
						$TMPL['url_subcategories'] = '';
						$TMPL['navigation_string'] .= ' → <a title="'.$subcategories_value['name_subcategories'].'">'.$subcategories_value['name_subcategories'].'</a>';
					} else {
						$TMPL['navigation_string'] .= ' → <a '.$TMPL['url_subcategories'].' title="'.$subcategories_value['name_subcategories'].'">'.$subcategories_value['name_subcategories'].'</a>';
					}
					/* Для SEO сайта */
					$TMPL['preview_settings'] = $subcategories_value['preview_subcategories'];
					$TMPL['title_settings'] = $subcategories_value['title_subcategories'];
					$TMPL['description_settings'] = $subcategories_value['description_subcategories'];
					$TMPL['keywords_settings'] = $subcategories_value['keywords_subcategories'];
					/* Для SEO сайта */
				}
				else
				{
					$TMPL['class_link'] = 'noactive';
				}
				$skin = new skin(DIRECTORY.'/templates/'.$settings['template_settings'].'/navigation_subcategories.html');
				$TMPL['navigation_subcategories'] .= $skin->make();
			}
		}
	}