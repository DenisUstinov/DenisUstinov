<?php
	require_once DIRECTORI.'/views/carousel.php';
	require_once DIRECTORI.'/views/article_list.php';

	$skin = new skin(DIRECTORI.'/templates/browse_index.html');
	$TMPL['content'] = $skin->make();