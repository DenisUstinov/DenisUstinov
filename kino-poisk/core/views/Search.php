<?php

	/*
	* Представление вывода результатов поиска
	*/

	$TMPL['content'] = '';
	$TMPL['number_videos'] = '';
	$TMPL['rows_videos_all'] = '';
	$TMPL['search_string'] = @$matches['search'];

	// Форма поиска
	$skin = new skin(DIRECTORY.'/templates/form.html');
	$TMPL['form'] = $skin->make();

	//Форма поиска для мобильных устройств
	$skin = new skin(DIRECTORY.'/templates/form_mobile.html');
	$TMPL['form_mobile'] = $skin->make();

	//Список выдачи
	if (count($data))
	{
		$i = 0;
		foreach($data as $data_value)
		{
			if($data_value->{'kinopoisk_id'} != 0 && !isset($license[$data_value->{'kinopoisk_id'}]))
			{
				$TMPL['title_ru'] = $data_value->{'title_ru'};
				$TMPL['title_en'] = $data_value->{'title_en'};
				$TMPL['kinopoisk_id'] = $data_value->{'kinopoisk_id'};

				$TMPL['category'] = '';
				switch($data_value->{'category'})
				{
					case 'russian': $TMPL['category'] .= 'Русские';break;
					case 'anime': $TMPL['category'] .= 'Анимационные';break;
					default: $TMPL['category'] .= 'Зарубежные';
				}
				switch($data_value->{'type'})
				{
					case 'movie': $TMPL['category'] .= ' фильмы';break;
					case 'serial': $TMPL['category'] .= ' сериалы';break;
					default: $TMPL['category'] .= '';
				}

				/* Сео сайта */
				$TMPL['title'] = 'КиноПоиск24.рф —  &laquo;'.$matches['search'].'&raquo;';
				$TMPL['description'] = 'Результаты поиска по запросу: &laquo;'.$matches['search'].'&raquo; на сайте КиноПоиск24.рф';
				$TMPL['keywords'] = $matches['search'].',фильмы 2016 новинки кино онлайн,новинки кино фантастика,новинки кино комедии,новинки кино мелодраммы,новинки военного кино';
				/*.Сео сайта */

				/* Сохранение картинки */
				$url_img = 'http://www.kinopoisk.ru/images/film/'.$data_value->{'kinopoisk_id'}.'.jpg';
				$url_img_alt = 'http://st.kp.yandex.net/images/film_iphone/iphone360_'.$data_value->{'kinopoisk_id'}.'.jpg';
				$url_new_img = DIRECTORY.'/templates/images/video/'.$data_value->{'kinopoisk_id'}.'.jpg';

				if(!file_exists($url_new_img))
				{
					if(getimagesize($url_img) && !file_put_contents($url_new_img, file_get_contents($url_img)) || getimagesize($url_img_alt) && !file_put_contents($url_new_img, file_get_contents($url_img_alt)))
					{
						$TMPL['image_videos'] = 'no_img';
					}
				}
				/* .Сохранение картинки */

				if ($i == 15) break;
				if ($i == 0 || $i == 2 || $i == 4|| $i == 6)
				{
					$skin = new skin(DIRECTORY.'/templates/advertising.html');
					$TMPL['rows_videos_all'] .= $skin->make();
				}
				$skin = new skin(DIRECTORY.'/templates/rows_videos_all.html');
				$TMPL['rows_videos_all'] .= $skin->make();
				$i++;
			}
		}

		$TMPL['number_videos'] = '<p style="color:#807e7e">По запросу <span>'.$matches['search'].'</span> найдено <span>'.$i.'</span> видео</p>';

		$skin = new skin(DIRECTORY.'/templates/videos_all.html');
		$TMPL['content'] .= $skin->make();

	} else {
		$error_reporting = 'no_search_videos';
		require_once CORE.'/views/Error.php';
	}

	$skin = new skin(DIRECTORY.'/templates/index.html');
	echo $skin->make();