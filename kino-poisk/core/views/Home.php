<?php

	/*
	* Представление вывода списка записей
	*/

	$TMPL['content'] = '';

	//Форма поиска
	$skin = new skin(DIRECTORY.'/templates/form.html');
	$TMPL['form'] = $skin->make();

	//Форма поиска для мобильных устройств
	$skin = new skin(DIRECTORY.'/templates/form_mobile.html');
	$TMPL['form_mobile'] = $skin->make();
	
	$skin = new skin(DIRECTORY.'/templates/home.html');
	$TMPL['content'] .= $skin->make();

	//Слайдер Новинки кино
	$TMPL['rows_slider'] = '';
	foreach($slider_1 as $value_id)
	{
		$TMPL['kinopoisk_id'] = $value_id;
		$skin = new skin(DIRECTORY.'/templates/rows_slider.html');
		$TMPL['rows_slider'] .= $skin->make();
	}
	$TMPL['sl'] = 1;
	$TMPL['slider_header'] = 'Новинки кино';
	$skin = new skin(DIRECTORY.'/templates/slider.html');
	$TMPL['content'] .= $skin->make();

	$skin = new skin(DIRECTORY.'/templates/index.html');
	echo $skin->make();