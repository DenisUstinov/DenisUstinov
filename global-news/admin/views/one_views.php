<?php
	$categories = $db->categories();
	//$subcategories = $db->subcategories();

	$TMPL['content'] = '';
	$TMPL['url_action'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?table='.$table;
	$TMPL['categories'] = '';

	foreach($data as $data_value)
	{

		/*foreach($categories as $value){
			if(isset($data_value['category_'.$table]) && $data_value['category_'.$table] == $value['id']){
				$TMPL['categories'] .= '<option value="'.$value['id'].'" selected>'.$value['title_categories'].'</option>';
				$TMPL['subcategories'] .= '
					<div class="form-group">
						<label class="control-label '.$value['id'].' none" for="subcategory_'.$table.'">Подкатегория статьи</label>
						<div class="controls">
							<select name="subcategory_'.$table.'" style="" class="form-control '.$value['id'].' none">
				';
			}else{
				$TMPL['categories'] .= '<option value="'.$value['id'].'">'.$value['title_categories'].'</option>';
				$TMPL['subcategories'] .= '
				<div class="form-group">
					<label class="control-label '.$value['id'].'  none" style="display:none;"  for="subcategory_'.$table.'">Подкатегория статьи</label>
						<div class="controls">
							<select style="display:none;" class="form-control '.$value['id'].' none">
				';
			}

			foreach($subcategories as $subcat_value){
				if($subcat_value['category_subcategories'] == $value['id']){
					if(isset($data_value['subcategory_'.$table]) && $data_value['subcategory_'.$table] == $subcat_value['id']){
						$TMPL['subcategories'] .= '<option value="'.$subcat_value['id'].'" selected>'.$subcat_value['title_subcategories'].'</option>';
					}else{
						$TMPL['subcategories'] .= '<option value="'.$subcat_value['id'].'">'.$subcat_value['title_subcategories'].'</option>';
					}
				}
			}
			$TMPL['subcategories'] .= '
						</select>
					</div>
				</div>
			';
		}*/

		if($data_value['id'] > 0)
		{
			$TMPL['title_content'] = 'Редактирование записи - '.$data_value['title_'.$table];

			$columns = $db->getAll("SHOW COLUMNS FROM ?n", $table);
			foreach($columns as $columns_value)
			{
				$TMPL[$columns_value['Field']] = $data_value[$columns_value['Field']];
			}

			/* Для SEO сайта */
			$settings['title_settings'] = $data_value['title_'.$table];
			$settings['description_settings'] = $data_value['description_'.$table];
			$settings['keywords_settings'] = $data_value['keywords_'.$table];
			/* Для SEO сайта */

			/* Вывод картинки если она есть при редактировании */
			if(!empty($data_value['image_'.$table]) && file_exists(DIRECTORI.'/templates/img/'.$data_value['image_'.$table]))
			{
				$TMPL['image'] = $data_value['image_'.$table];
				require_once DIRECTORI.'/admin/views/form_delite_images.php';

				$skin = new skin(DIRECTORI.'/admin/templates/image_form.html');
				$TMPL['image_form'] = $skin->make();
			}
			/* .Вывод картинки если она есть при редактировании */

			require_once DIRECTORI.'/admin/views/form_delite_articles.php';
		}
		else
		{
			$TMPL['title_content'] = 'Добавление записи:';
		}

		$skin = new skin(DIRECTORI.'/admin/templates/one_'.$table.'.html');
		$TMPL['content'] = $skin->make();
	}