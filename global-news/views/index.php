<?php
	require_once DIRECTORI.'/controllers/function_controller.php';
	require_once DIRECTORI.'/controllers/template_controller.php';

	$settings = $db->settings();
	if(isset($settings['title_settings'])) $TMPL['title_settings'] = $settings['title_settings'];
	if(isset($settings['description_settings'])) $TMPL['description_settings'] = $settings['description_settings'];
	if(isset($settings['keywords_settings'])) $TMPL['keywords_settings'] = $settings['keywords_settings'];
	if(isset($settings['image_settings'])) $TMPL['image_settings'] = $settings['image_settings'];
	if(isset($settings['email_settings'])) $TMPL['email_settings'] = $settings['email_settings'];
	if(isset($settings['address_settings'])) $TMPL['address_settings'] = $settings['address_settings'];
	if(isset($settings['phone_settings'])) $TMPL['phone_settings'] = $settings['phone_settings'];
	if(isset($settings['copyright_settings'])) $TMPL['copyright_settings'] = $settings['copyright_settings'];
	if(isset($settings['date_settings'])) $TMPL['date_settings'] = date('Y');
	if(isset($settings['footer_settings'])) $TMPL['footer_settings'] = $settings['footer_settings'];

	require_once DIRECTORI.'/views/main_navigation.php';
	require_once $tpl;

	$skin = new skin(DIRECTORI.'/templates/index.html');
	echo $skin->make();
?>