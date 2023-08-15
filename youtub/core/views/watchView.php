<?php

/**
 * Представление вывода одной записи
 */

require_once CORE.'/views/relatedView.php';
require_once CORE.'/views/commentsView.php';
require_once CORE.'/views/playerView.php';
require_once CORE.'/views/captionsView.php';

//if(isset($json['title']) && translit($json['title']) == $matches['titleTranslit']) {
if(isset($json['title'])) {
	
	$json['title'] = htmlspecialchars($json['title']);
	$json['description'] = htmlspecialchars($json['description']);
	$json['channelTitle'] = htmlspecialchars($json['channelTitle']);

	// SEO сайта
	$TMPL['title_site'] = 'Смотреть или скачать видео '.$json['title'].' бесплатно.';
	//$TMPL['description_site'] = mb_substr(removeUrl($json['description']), 0, 200, 'UTF-8').'.';
	$TMPL['description_site'] = 'Смотрите или скачивайте видео '. $json['title'].' бесплатно в формате'.$type.'.';
	$TMPL['keywords_site'] = 'видео, смотреть, скачать, онлайн, бесплатно, '.$type.', '.$json['title'];
	$TMPL['main_header'] = '<p>Приятного просмотра</p>';
	$TMPL['main_description'] = '';
	$TMPL['url_logo'] = 'href="'.HOST.'"';
	$TMPL['image_site'] = HOST.'/imagefile/'.$json['videoId'].'.jpg';
	
	$TMPL['videoId'] = $json['videoId'];
	$TMPL['publishedAt'] = $json['publishedAt'];
	$TMPL['publishedAtnew'] = showDate(strtotime($json['publishedAt']));
	$TMPL['channelId'] = $json['channelId'];
	$TMPL['channelTitle'] = $json['channelTitle'];
	
	//из файла get_video_info
	$TMPL['channelThumbnail'] = $json['get_video_info']['channel_thumbnail'] ? $json['get_video_info']['channel_thumbnail'] : HOST.'/templates/'.$TMPL['templates'].'/images/no_user.jpg';
	
	$TMPL['title'] = $json['title'];
	$TMPL['title_search'] = preg_replace("/[\s]+/u", "+", trim(preg_replace("/[^a-zA-Zа-яА-Я0-9 ]/ui", "", $json['title'])));

	if(!empty($json['description'])) {
		$TMPL['description'] = nl2br(upUrl($json['description']));
	} else {
		$TMPL['description'] = $json['title'];
	}
	$TMPL['thumbnails'] = HOST.'/imagefile/'.$json['videoId'].'.jpg';

	$TMPL['li'] = '';
	foreach (explode(',', $json['tags']) as $tags) {
		$TMPL['href_link'] = HOST.'/video/'.str_replace (' ', '-', $tags);
		$TMPL['title_link'] = $tags;
		$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/li.html');
		$TMPL['li'] .= $skin->make();
	}
	
	$TMPL['class_ul'] = 'class="nav-tags button"';
	$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/ul.html');
	$TMPL['tags'] = $skin->make();

	//$TMPL['categoryId'] = $json['categoryId'];
	switch($json['categoryId']) {
		case 1: $TMPL['genre'] = 'Фильмы и Анимация'; break;
		case 2: $TMPL['genre'] = 'Авто и Транспорт'; break;
		case 10: $TMPL['genre'] = 'Музыка'; break;
		case 17: $TMPL['genre'] = 'Спорт'; break;
		case 20: $TMPL['genre'] = 'Игры'; break;
		case 22: $TMPL['genre'] = 'Люди и блоги'; break;
		case 23: $TMPL['genre'] = 'Юмор'; break;
		case 25: $TMPL['genre'] = 'Новости и политика'; break;
		case 26: $TMPL['genre'] = 'Мода и Стиль'; break;
		case 28: $TMPL['genre'] = 'Наука и Технологии'; break;
		case 30: $TMPL['genre'] = 'Ролики'; break;
		default : $TMPL['genre'] = 'Общая'; 
	}
	$TMPL['duration'] = $json['duration'];
	$TMPL['viewCount'] = number_format($json['viewCount'], 0, '', ' ' );
	$TMPL['likeCount'] = number_format($json['likeCount'], 0, '', ' ' );
	$TMPL['dislikeCount'] = number_format($json['dislikeCount'], 0, '', ' ' );
	$TMPL['ratingCount'] = $json['likeCount'] + $json['dislikeCount'];
	$TMPL['lineProgress'] = $json['likeCount'] / ($TMPL['ratingCount'] / 100);
	$TMPL['ratingValue'] = round(5 / $TMPL['ratingCount'] * $json['likeCount']);

	$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/ld_json.html');
	$TMPL['ld_json'] = $skin->make();
	
	$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/schema.html');
	$TMPL['schema'] = $skin->make();
	
	$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/watch.html');
	$TMPL['content'] = $skin->make();
	
} else {
	$TMPL['error_code'] = 'Видео не найдено!';
	return false;
}