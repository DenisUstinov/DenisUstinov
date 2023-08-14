<?php
	error_reporting(E_ALL);
	require_once DIRECTORI.'/models/model.php';

	class select_sql extends SafeMySQL{

		public $table;
		public $per_page;
		public $paginator = array();
		public $w = array();
		public $g = array();

		function __construct($table = 'articles', $per_page = 2)
		{
			parent::__construct();
			$this->table = $table;
			$this->per_page = $per_page;
		}

		function settings()
		{
			$settings = $this->getRow('SELECT * FROM settings');
			return $settings;
		}

		function table($table)
		{
			$this->g[] = 'table='.$table;
		}

		function id_categories($id_categories)
		{
			$this->w[] = $this->parse("category_".$this->table." = ?i",$id_categories);
			$this->g[] = 'id_categories='.$id_categories;
		}

		function id($id)
		{
			$this->w[] = $this->parse("id=?i", $id);
		}

		function id_array($id)
		{
			if (count($this->w)) $where = "WHERE ".implode(' AND ',$this->w);// Условие текущая категория и подкатегория
			$id_array = $this->getCol("SELECT id FROM ?n ?p", $this->table, $where);//Массив id  с условием
			shuffle($id_array);//Перемешали массив
			$in[] = $id;//Первый элемент массива текущий id статьи
			$per_page = 5; // Количество статей на странице вместе с похожими
			for($i=0; $i < $per_page; $i++){
				if(isset($id_array[$i])){//Если данные в массиве закончатся выйдем через break
					if($id_array[$i] != $id){//Чтобы не попал в массив id текущей статьи
						$in[] = $id_array[$i];
					}
				}else{
					break;
				}
			}
			$this->w[] = $this->parse("id IN (?a)", $in);
		}

		function carousel($categories)
		{
			foreach($categories as $categories_value)
			{
				$data = $this->getRow('SELECT * FROM articles WHERE category_articles=?i LIMIT 1', $categories_value['id']);
				if (count($data))$carousel_data[] = $data;
			}
			return $carousel_data;
		}

		function categories()
		{
			$categories = $this->getAll('SELECT * FROM categories');
			return $categories;
		}

		function selectfunc($cur_page)
		{
			$start = ($cur_page - 1) * $this->per_page;
			$where = '';
			if (count($this->w)) $where = "WHERE ".implode(' AND ',$this->w);
			$data = $this->getAll("SELECT SQL_CALC_FOUND_ROWS * FROM ?n ?p LIMIT ?i, ?i", $this->table, $where, $start, $this->per_page);
			$this->paginator['rows'] = $this->getOne("SELECT FOUND_ROWS()");
			return $data;
		}

		function paginator()
		{
			$this->paginator['get'] = '';
			if (count($this->g)) $this->paginator['get'] = implode('&',$this->g);
			$this->paginator['num_pages'] = ceil($this->paginator['rows']/$this->per_page);
			return $this->paginator;
		}
	}
?>