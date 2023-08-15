<?php

/**
 * Представление вывода списка записей по условию
 */
if(count($json['items']) > 0) {
	// SEO сайта
	$json['items'][0]['snippet']['channelTitle'] = htmlspecialchars($json['items'][0]['snippet']['channelTitle']);
	
	$TMPL['title_site'] = $json['items'][0]['snippet']['channelTitle'];
	$TMPL['description_site'] = $json['items'][0]['snippet']['channelTitle'].'.';
	$TMPL['keywords_site'] = $json['items'][0]['snippet']['channelTitle'];
	$TMPL['main_header'] = '<p>Видео на канале: <span>'.$json['items'][0]['snippet']['channelTitle'].'</span></p>';
	$TMPL['main_description'] = '';
	$TMPL['searchString'] = $json['items'][0]['snippet']['channelTitle'];
	$TMPL['url_logo'] = 'href="'.HOST.'"';
	$TMPL['image_site'] = '';

	require_once CORE.'/views/menuTokenView.php';
	require_once CORE.'/views/listVideoView.php';
} else {
	$TMPL['error_code'] = 'Видео не найдены!';
	return false;
}