<?php

/**
 * Представление страниц
 */

if (isset($matches['alias'])) {
	$TMPL['title_site'] = '';
	$TMPL['description_site'] = '';
	$TMPL['keywords_site'] = '';
	$TMPL['main_header'] = '';
	$TMPL['main_description'] = '';
	$TMPL['searchString'] = '';
	$TMPL['url_logo'] = 'href="'.HOST.'"';
	$TMPL['image_site'] = '';

	$TMPL['content'] = '';
	$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/'.$matches['alias'].'.html');
	$TMPL['content'] = $skin->make();
} else {
	$TMPL['error_code'] = 'Такой страницы не сущесвует!';
	return false;
}