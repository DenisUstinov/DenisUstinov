<?php

	$TMPL['template_settings'] = $settings['template_settings'];
	//$TMPL['preview_settings'] = $categories_value['preview_settings'];
	$TMPL['title_settings'] = $settings['title_settings'];
	$TMPL['description_settings'] = $settings['description_settings'];
	$TMPL['keywords_settings'] = $settings['keywords_settings'];
	$TMPL['image_settings'] = $settings['image_settings'];
	$TMPL['email_settings'] = $settings['email_settings'];
	$TMPL['address_settings'] = $settings['address_settings'];
	$TMPL['phone_settings'] = $settings['phone_settings'];
	$TMPL['copyright_settings'] = $settings['copyright_settings'];
	$TMPL['footer_settings'] = $settings['footer_settings'];
	$TMPL['navigation_string'] = '';
	
	if (isset($action) && $action != 'Main') {
		$TMPL['url_logo'] = 'href="'.HOST.'"';
	}