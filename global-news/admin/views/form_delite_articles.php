<?php
	$TMPL['form_delite_articles'] = '';
	$TMPL['id'] = $id;
	$skin = new skin(DIRECTORI.'/admin/templates/form_delite_articles.html');
	$TMPL['form_delite_articles'] = $skin->make();
