<?php
	error_reporting(E_ALL);

	require_once '../url.php';

	require_once DIRECTORI.'/controllers/function_controller.php';
	require_once DIRECTORI.'/controllers/select_controller.php';


	if(isset($_GET['table'])){
		$table = $_GET['table'];
		$db = new select_sql($table);
		$db->table($table);

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			require_once DIRECTORI.'/controllers/editing_controller.php';
		}

		if(isset($_GET['page']) && $_GET['page'] > 0){
			$cur_page = $_GET['page'];
		}else{
			$cur_page = 1;
		}

		if (isset($_GET['id_categories']) && $_GET['id_categories'] > 0){
			$id_categories = (int)$_GET['id_categories'];
			$db->id_categories($id_categories);
		}

		if(!isset($_GET['id'])){
			$data = $db->selectfunc($cur_page);
			$tpl = DIRECTORI.'/admin/views/all_views.php';
		}else{
			if($_GET['id']){
				$id = (int)$_GET['id'];
				$db->id($id);
				$data = $db->selectfunc($cur_page);

			}else{
				$data[]['id'] = 0;
			}
			$tpl = DIRECTORI.'/admin/views/one_views.php';
		}

	}else{
		$table = '';
		$db = new select_sql($table);
		$tpl = 'home.php';
	}
	require_once DIRECTORI.'/admin/views/index.php';
?>