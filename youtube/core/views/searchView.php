<?php
/**
 * Представление вывода списка записей по условию
 */
if(count($json['items']) > 0) {
	// SEO сайта
	$alias = urldecode($matches['alias']);
	$TMPL['title_site'] = $alias;
	$TMPL['description_site'] = $alias.'.';
	$TMPL['keywords_site'] = $alias;
	$TMPL['main_header'] = '<p>Видео по запросу: <span>'.$alias.'</span></p>';
	$TMPL['main_description'] = '';
	$TMPL['searchString'] = $alias;
	$TMPL['url_logo'] = 'href="'.HOST.'"';
	$TMPL['image_site'] = '';
	
	// Вывод рекламы релевантной запросу
	$TMPL['relevantAdd'] = '';
	if (count($relevantAdd)) {
		foreach($relevantAdd as $relevantKey => $relevantLink){
			if(preg_match("#$relevantKey#iu", $alias)){
				$TMPL['relevantAdd'] .= $relevantLink;
			}
		}
	}

	require_once CORE.'/views/menuTokenView.php';
	require_once CORE.'/views/listVideoView.php';
	if (count($json['queries']) > 0) {
		require_once CORE.'/views/navQueriesView.php';
	}
} else {
	$TMPL['error_code'] = 'Видео не найдены!';
	return false;
}