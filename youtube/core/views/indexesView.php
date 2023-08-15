<?php

/**
 * Представление вывода списка записей на главной
 */
//require_once CORE.'/views/menuTagsView.php';

if (isset($json['pageInfo']['totalResults']) && $json['pageInfo']['totalResults'] > 0) {
	$TMPL['HOST'] = HOST;
	$content = '';
	foreach ($json['items'] as $item) {
		$TMPL['videoId'] = $item['id']['videoId'];
		$TMPL['translit'] = translit($item['snippet']['title']);
		
		$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/list_links.html');
		$content .= $skin->make();
	}
	echo $content;
} else {
	$TMPL['error_code'] = 'Видео не найдены!';
	return false;
}