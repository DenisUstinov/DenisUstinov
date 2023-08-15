<?php

	/*
	 * Представление вывода статьи
	 */

	$TMPL['content'] = '';
	$TMPL['social'] = '';
	$TMPL['mail'] = '';

	if(count($data) && !isset($license[$matches['id']])) {
		$TMPL['text_articles'] = '';
		$TMPL['tags_articles'] = '';
		if(count($row))
		{
			$TMPL['text_articles'] = nl2br($row['text_articles']);
			$TMPL['tags_articles'] = nl2br($row['tags_articles']);
		}

		$TMPL['title_ru'] = $data[0]->{'title_ru'};
		$TMPL['title_en'] = $data[0]->{'title_en'};
		$TMPL['kinopoisk_id'] = $data[0]->{'kinopoisk_id'};
		$TMPL['image_videos'] = $data[0]->{'kinopoisk_id'};
		$TMPL['iframe_url'] = $data[0]->{'iframe_url'};

		$seo = '';
		$TMPL['category'] = '';
		switch($data[0]->{'category'})
		{
			case 'russian': $TMPL['category'] .= 'Русские';break;
			case 'anime': $TMPL['category'] .= 'Анимационные';break;
			default: $TMPL['category'] .= 'Зарубежные';
		}
		switch($data[0]->{'type'})
		{
			case 'movie': $TMPL['category'] .= ' фильмы';break;
			case 'serial': $TMPL['category'] .= ' сериалы';$seo = 'все серии подряд';break;
			default: $TMPL['category'] .= '';
		}


		$TMPL['title'] = '&laquo;'.$data[0]->{'title_ru'}.'&raquo; смотреть онлайн бесплатно в хорошем качестве '.$seo.' на НовинкиКино';
		$TMPL['description'] = 'Страница просмотра фильма &laquo;'.$data[0]->{'title_ru'}.'&raquo;. Смотреть &laquo;'.$data[0]->{'title_ru'}.'&raquo; онлайн бесплатно в хорошем качестве '.$seo.' на НовинкиКино';
		$TMPL['keywords'] = $TMPL['category'].', '.$data[0]->{'title_ru'}.' смотреть онлайн,'.$data[0]->{'title_ru'}.' на новинкикино,фильмы 2016 новинки кино онлайн,новинки кино фантастика,новинки кино комедии,новинки кино мелодраммы,новинки военного кино';

		/* Сохранение картинки большой */
		$url_img = 'http://www.kinopoisk.ru/images/film_big/'.$data[0]->{'kinopoisk_id'}.'.jpg';
		$url_img_alt = 'http://st.kp.yandex.net/images/film_iphone/iphone360_'.$data[0]->{'kinopoisk_id'}.'.jpg';
		$url_new_img = DIRECTORY.'/templates/images/video_big/'.$data[0]->{'kinopoisk_id'}.'.jpg';

		if(!file_exists($url_new_img))
		{
			if(getimagesize($url_img) && !file_put_contents($url_new_img, file_get_contents($url_img)) || getimagesize($url_img_alt) && !file_put_contents($url_new_img, file_get_contents($url_img_alt)))
			{
				$TMPL['image_videos'] = 'no_img';
			}
		}
		/* .Сохранение картинки */

		$skin = new skin(DIRECTORY.'/templates/send.html');
		$TMPL['mail'] = $skin->make();

		$skin = new skin(DIRECTORY.'/templates/social.html');
		$TMPL['social'] = $skin->make();


		$skin = new skin(DIRECTORY.'/templates/rows_videos_one.html');
		$TMPL['content'] .= $skin->make();


		$skin = new skin(DIRECTORY.'/templates/iframe.html');
		$TMPL['content'] .= $skin->make();

		//$skin = new skin(DIRECTORY.'/templates/group.html');
		//$TMPL['content'] .= $skin->make();

	} else {
		$error_reporting = 'no_videos';
		require_once CORE.'/views/Error.php';
	}

	$skin = new skin(DIRECTORY.'/templates/index.html');
	echo $skin->make();