<?php

if(isset($matches['id']) && isset($matches['table']))
{
	$TMPL['id'] = $matches['id'];
	$TMPL['table'] = $matches['table'];
	$TMPL['url_action'] = HOST.'/'.ADMIN_DIRECTORY.'/edit/'.$TMPL['table'];
	$TMPL['template_settings'] = $settings['template_settings'];

	$data = array();
	$data = $db->getRow("SELECT * FROM ?n WHERE id=?i", $TMPL['table'], $TMPL['id']);

	/* Вывод картинки при редактировании если она есть */
	if(!empty($data['image_'.$TMPL['table']]) && file_exists(DIRECTORY.'/templates/'.$settings['template_settings'].'/img/'.$TMPL['table'].'/medium/'.$data['image_'.$TMPL['table']]))
	{
		$TMPL['image_form'] = '';
		$TMPL['image_name'] = $data['image_'.$TMPL['table']];
		$skin = new skin(DIRECTORY.'/templates/admin/image_form.html');
		$TMPL['image_form'] = $skin->make();
	}
	/* .Вывод картинки если она есть при редактировании */

	/* Удаление записи */
	if($TMPL['table'] != 'settings' && $TMPL['id'] != 0)
	{
		$TMPL['form_delite_articles'] = '';
		if(isset($data['image_'.$TMPL['table']])) $TMPL['image_name'] = $data['image_'.$TMPL['table']];
		$skin = new skin(DIRECTORY.'/templates/admin/form_delite_articles.html');
		$TMPL['form_delite_articles'] = $skin->make();
	}
	/* .Удаление записи */

	/* Формирование формы */
	$columns = array();
	$columns = $db->getAll("SHOW FULL COLUMNS FROM ?n", $TMPL['table']);//Какие столбци в таблице есть и их массивы атрибутов

	$TMPL['fields'] = '<div class="editor_header">Редактор записи</div>';
	foreach($columns as $columns_value)
	{
		$TMPL['field_name'] = $columns_value['Field'];//Имя столбца текущей таблицы
		if(count($data)) $TMPL['field_value'] = $data[$columns_value['Field']];//(Если редактируем запись)Значение ячеки таблицы текущей записи

		if($columns_value['Comment'])
		{
			$comment = unserialize($columns_value['Comment']);
			$TMPL['label'] = $comment['label'];
			$TMPL['other'] = $comment['other'];

			// Оптимизация сео блока
			if($comment['label'] == 'Адрес страницы (url)')
			{
				$TMPL['fields'] .= '<div class="editor_header">Модуль SEO оптимизации</div>';
			}

			// Оптимизация селектов
			if($comment['type'] == 'select_category')
			{
				require_once CORE.'/views/select_categories.php';
			}
			elseif($comment['type'] == 'select_subcategory')
			{
				require_once CORE.'/views/select_subcategories.php';
			}
			else
			{
				$skin = new skin(DIRECTORY.'/templates/admin/fields/'.$comment['type'].'.html');
				$TMPL['fields'] .= $skin->make();
			}
		}
	}
	/* .Формирование формы */
	$skin = new skin(DIRECTORY.'/templates/admin/view_one.html');
	echo $skin->make();
}