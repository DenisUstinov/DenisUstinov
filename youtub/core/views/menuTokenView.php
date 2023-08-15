<?php

/**
 * Формируем пагинацию на основе переменной $tokenString из контроллера
 */
$TMPL['li'] = '';
$TMPL['class_ul'] = 'class="page-token button"';
if (isset($json['prevPageToken'])) {
	$TMPL['href_link'] = HOST.'/'.$action.'/'.urlencode($matches['alias']).'/'.$json['prevPageToken'];
	$TMPL['title_link'] = 'Назад';

	$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/li.html');
	$TMPL['li'] .= $skin->make();
}
if (isset($json['nextPageToken']) && count($json['items']) >= 19) {
	$TMPL['href_link'] = HOST.'/'.$action.'/'.urlencode($matches['alias']).'/'.$json['nextPageToken'];
	$TMPL['title_link'] = 'Дальше';

	$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/li.html');
	$TMPL['li'] .= $skin->make();
}
$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/ul.html');
$TMPL['token_nav'] = $skin->make();