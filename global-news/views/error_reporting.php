<?php
	switch($error_reporting)
	{
		case 'no_articles': $TMPL['error_reporting'] = 'В данной категории пока нет записей'; break;
		case 'no_categories': $TMPL['error_reporting'] = 'В данной категории пока нет записей'; break;
		case 'no_subcategories': $TMPL['error_reporting'] = 'В данной подкатегории пока нет записей'; break;
	}
	$skin = new skin(DIRECTORI.'/templates/error_reporting.html');
	$TMPL['error_reporting'] = $skin->make();