<?php

	if($table == 'articles' || $table == 'subcategories'){
		require_once DIRECTORI.'/admin/views/filter_categories.php';
	}
	if($table == 'articles'){
		require_once DIRECTORI.'/admin/views/filter_subcategories.php';
	}
	if($table == 'settings'){
		header('location: http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?table=settings&id=1');
		exit;
	}

	$TMPL['content'] = '';
	if(count($data)){
		foreach ($data as $value){
			$TMPL['title_'.$table] = $value['title_'.$table];
			$TMPL['url_edit_'.$table] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?table='.$table.'&id='.$value['id'];

			$skin = new skin(DIRECTORI.'/admin/templates/all_'.$table.'.html');
			$TMPL['content'] .= $skin->make();
		}
		require_once DIRECTORI.'/admin/views/paginator.php';
	}else{
		$error_reporting = 'no_articles';
		require_once DIRECTORI.'/admin/views/error_reporting.php';
	}