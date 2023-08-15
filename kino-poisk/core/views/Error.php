<?php

	/*
	* Представление вывода ошибок
	*/

	if(isset($error_reporting))
	{
		$TMPL['error_reporting'] = '';

		switch($error_reporting)
		{
			case 'no_videos': $TMPL['error_reporting'] = '404 Страница не существует'; break;
			case 'no_search_videos': $TMPL['error_reporting'] = 'Результатов по данному запросу не найдено'; break;
			default :$TMPL['error_reporting'] = 'Неизвестная ошибка'; break;
		}

		header("HTTP/1.0 404 Not Found");
	}
	else
	{
		$TMPL['error_reporting'] = '404 Страница не существует'; header("HTTP/1.0 404 Not Found");
	}

	$skin = new skin(DIRECTORY.'/templates/error_reporting.html');
	$TMPL['error_reporting'] = $skin->make();