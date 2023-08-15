<?php
/**
 * Представление навигации сайта
 */
$TMPL['nav'] = '';
if (count($nav) > 0) {
	$TMPL['li'] = '';
	foreach ($nav as $value) {
		$TMPL['href_link'] = HOST.'/video/'.str_replace(' ',  '-', $value);
		if ($TMPL['href_link'] == URL) {
			$TMPL['href_link'] = '';
			$TMPL['title_link'] = '&#10004; '.$value;
		} else {
			$TMPL['title_link'] = $value;
		}
		$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/li.html');
		$TMPL['li'] .= $skin->make();
	}
	$TMPL['class_ul'] = '';
	$TMPL['top_li'] = '<li><a '.$TMPL['url_logo'].' title="Главная страница">Главная</a></li>';
	$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/ul.html');
	$TMPL['nav'] = $skin->make();
}