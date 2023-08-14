<?php
	/*
	* Контроллер вывода ошибок
	*/

	if(isset($error_reporting))
	{
		$TMPL['error_reporting'] = '';

		switch($error_reporting)
		{
			case '404': $TMPL['error_reporting'] = '404 Страница не существует'; header("HTTP/1.0 404 Not Found"); break;
			case 'no_articles': $TMPL['error_reporting'] = 'Такой записи не существует'; header("HTTP/1.0 404 Not Found"); break;
			case 'no_articles_tags': $TMPL['error_reporting'] = 'Записей с данным тегом не найдено'; header("HTTP/1.0 404 Not Found"); break;
			case 'no_articles_search': $TMPL['error_reporting'] = 'Записей по запросу не найдено'; header("HTTP/1.0 404 Not Found"); break;
			case 'no_articles_semilar': $TMPL['error_reporting'] = 'Похожих записей не найдено'; header("HTTP/1.0 404 Not Found"); break;
			case 'no_articles_category': $TMPL['error_reporting'] = 'В данной категории пока нет записей'; header("HTTP/1.0 404 Not Found"); break;
			case 'no_articles_subcategory': $TMPL['error_reporting'] = 'В данной подкатегории пока нет записей'; header("HTTP/1.0 404 Not Found"); break;
			default :$TMPL['error_reporting'] = 'Неизвестная ошибка'; header("HTTP/1.0 404 Not Found"); break;
		}
	}
	else
	{
		$TMPL['error_reporting'] = '404 Страница не существует'; header("HTTP/1.0 404 Not Found");
	}

	$skin = new skin(DIRECTORY.'/templates/'.$TMPL['template_settings'].'/error_reporting.html');
	$TMPL['error_reporting'] = $skin->make();