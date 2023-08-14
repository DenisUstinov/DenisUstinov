<?php
	require_once DIRECTORI.'/controllers/function_controller.php';
	require_once DIRECTORI.'/controllers/template_controller.php';
	$settings = $db->settings();

	$TMPL['HOST'] = HOST;
	$TMPL['title_description'] = $settings['title_settings'];
	$TMPL['description'] = $settings['description_settings'];

	require_once $tpl;

	$TMPL['title_settings'] = $settings['title_settings'];
	$TMPL['description_settings'] = $settings['description_settings'];
	$TMPL['keywords_settings'] = $settings['keywords_settings'];
	$TMPL['image_settings'] = $settings['image_settings'];
	$TMPL['ok_settings'] = $settings['ok_settings'];
	$TMPL['vk_settings'] = $settings['vk_settings'];
	$TMPL['t_settings'] = $settings['t_settings'];
	$TMPL['f_settings'] = $settings['f_settings'];
	$TMPL['date_settings'] = date('Y');
	$TMPL['footer_settings'] = $settings['footer_settings'];

	$skin = new skin(DIRECTORI.'/admin/templates/index.html');
	echo $skin->make();
	
?>