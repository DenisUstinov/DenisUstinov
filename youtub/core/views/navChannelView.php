<?php
/**
 * Представление навигации каналов
 */
$TMPL['nav_channel'] = '';
if (count($nav_channel) > 0) {
	$TMPL['li'] = '';
	foreach ($nav_channel as $key => $value) {
		$TMPL['href_link'] = HOST.'/channel/'.$value;
		$TMPL['title_link'] = $key;
		$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/li.html');
		$TMPL['li'] .= $skin->make();
	}
	$TMPL['class_ul'] = 'class="nav-channel button"';
	$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/ul.html');
	$TMPL['nav_channel'] = $skin->make();
}