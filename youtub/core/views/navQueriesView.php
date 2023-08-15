<?php

$TMPL['menu_queries'] = '';
$TMPL['li'] = '';
foreach ($json['queries'][1] as $value) {
	$TMPL['href_link'] = HOST.'/video/'.str_replace(' ',  '-', $value);
	if ($TMPL['href_link'] != URL) {
		$TMPL['title_link'] = $value;
		$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/li.html');
		$TMPL['li'] .= $skin->make();
	}
}
$TMPL['class_ul'] = 'class="nav-tags button"';
$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/ul.html');
$TMPL['menu_queries'] = $skin->make();