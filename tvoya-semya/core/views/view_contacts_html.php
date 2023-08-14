<?php

	/* Для SEO сайта */
	$TMPL['navigation_string'] .= ' → <a title="Контакты">Контакты</a>';
	$TMPL['preview_settings'] = '';
	$TMPL['title_settings'] = 'Контакты';
	$TMPL['description_settings'] = 'Контакты сайта ТвояСемья.рф';
	$TMPL['keywords_settings'] = '';
	/* Для SEO сайта */

	$skin = new skin(DIRECTORY.'/templates/'.$settings['template_settings'].'/view_contacts.html');
	$TMPL['content'] .= $skin->make();