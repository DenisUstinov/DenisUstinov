<?php
/**
 * Представление вывода списка записей
 */
if(count($data)){
	$TMPL['sitemap_items_urlset'] = '';
	foreach ($data as $item) {
		$TMPL['url'] = HOST.'/watch/'.$item['id']['videoId'].'/'.translit($item['snippet']['title']);
		
		$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/sitemap-items-urlset.html');
		$TMPL['sitemap_items_urlset'] .= $skin->make();
	}
} else {
	return false;
}