<?php
	require_once DIRECTORI.'/views/article_content.php';
	require_once DIRECTORI.'/views/article_share.php';
	require_once DIRECTORI.'/views/article_comments.php';

	$skin = new skin(DIRECTORI.'/templates/browse_article.html');
	$TMPL['content'] = $skin->make();