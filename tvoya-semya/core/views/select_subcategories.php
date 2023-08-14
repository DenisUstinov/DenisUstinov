<?php

	/*
	* Контроллер получения представления селекта подкатегорий.
	*/

	if(count($categories))
	{
		foreach($categories as $categories_value)
		{
			if(isset($active_category) && $active_category == $categories_value['id'])
			{
				$TMPL['name'] = $columns_value['Field'];
				$TMPL['display'] = '';
			}else{
				$TMPL['name'] = '';
				$TMPL['display'] = 'display:none;';
			}

			$subcategories = array();
			$subcategories = $db->getAll('SELECT * FROM ?n WHERE ?n=?i', $comment['from'], 'category_'.$comment['from'], $categories_value['id']);

			$TMPL['select_option'] = '';
			if(count($subcategories))
			{
				foreach($subcategories as $subcategories_value)
				{
					$TMPL['option_value'] = $subcategories_value['id'];
					$TMPL['option_title'] = $subcategories_value['name_subcategories'];
					$TMPL['select_category'] = $categories_value['id'];

					if(isset($data[$columns_value['Field']]) && $data[$columns_value['Field']] == $subcategories_value['id'])
					{
						$TMPL['selected'] = 'selected';
					}else{
						$TMPL['selected'] = '';
					}
					$skin = new skin(DIRECTORY.'/templates/admin/fields/select_option.html');
					$TMPL['select_option'] .= $skin->make();

				}
				$skin = new skin(DIRECTORY.'/templates/admin/fields/'.$comment['type'].'.html');
				$TMPL['fields'] .= $skin->make();
			}
		}
	}