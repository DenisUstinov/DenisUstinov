<?php

	/*
	* Контроллер получения представления селекта категорий.
	*/

	$categories = array();
	$categories = $db->getAll('SELECT * FROM ?n', $comment['from']);

	$TMPL['select_option'] = '';
	if(count($categories))
	{
		foreach($categories as $categories_value)
		{
			$TMPL['option_value'] = $categories_value['id'];
			$TMPL['option_title'] = $categories_value['name_'.$comment['from']];

			if(isset($data[$columns_value['Field']]) && $data[$columns_value['Field']] == $categories_value['id'])
			{
				$TMPL['selected'] = 'selected';
				$active_category = $categories_value['id'];
			}
			else
			{
				$TMPL['selected'] = '';
			}
			$skin = new skin(DIRECTORY.'/templates/admin/fields/select_option.html');
			$TMPL['select_option'] .= $skin->make();
		}
		$skin = new skin(DIRECTORY.'/templates/admin/fields/'.$comment['type'].'.html');
		$TMPL['fields'] .= $skin->make();
	}