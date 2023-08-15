<?php
/**
 * Представление файла sitemap.xml
 */

if(!count($data['rowsmaps']) && !count($data['tagsmaps'])) {
	return false;
} else {
	$TMPL['sitemap_items_index'] = '';
	
	//Карта записей
	$i = intval($data['rowsmaps'] / 1000);
	while ($i > 0) {
		$TMPL['url'] = HOST.'/sitemap/'.$i.".xml";
		$i--;
		
		$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/sitemap-items-index.html');
		$TMPL['sitemap_items_index'] .= $skin->make();
	}
	$TMPL['url'] = HOST.'/sitemap/0.xml';
	
	$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/sitemap-items-index.html');
	$TMPL['sitemap_items_index'] .= $skin->make();
	
	//Карта тегов
	foreach ($data['tagsmaps'] as $file_name) {
		$TMPL['url'] = HOST.'/tagsmap/'.$file_name.".xml";
		
		$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/sitemap-items-index.html');
		$TMPL['sitemap_items_index'] .= $skin->make();
	}
}