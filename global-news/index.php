<?
	error_reporting(E_ALL);
	require_once 'url.php';
	require_once DIRECTORI.'/controllers/select_controller.php';
	$db = new select_sql();

	if(isset($_GET['page']) && $_GET['page'] > 0){
		$cur_page = $_GET['page'];
	}else{
		$cur_page = 1;
	}

	if(isset($_GET['id_categories']) && $_GET['id_categories'] > 0){
		$id_categories = (int)$_GET['id_categories'];
		$db->id_categories($id_categories);

		if(isset($_GET['id']) && $_GET['id'] > 0){
			$id = (int)$_GET['id'];
			$db->id_array($id);
			$tpl = DIRECTORI.'/views/browse_article.php';
		}else{
			$tpl = DIRECTORI.'/views/browse_category.php';
		}
	}elseif(isset($_GET['pages'])){
		$pages = (int)$_GET['pages'];
		$tpl = DIRECTORI.'/views/browse_pages.php';
	}else{
		$tpl = DIRECTORI.'/views/browse_index.php';
	}

	require_once DIRECTORI.'/views/index.php';
?>