<?php
/******************************************************* Функции ***********************************************************/

	/* Функция парсера xml файла - отдает многомерный массив */
	function parse_excel_file( $filename ){
		$result = array();
		$file_type = PHPExcel_IOFactory::identify( $filename ); // узнаем тип файла, excel может хранить файлы в разных форматах, xls, xlsx и другие
		$objReader = PHPExcel_IOFactory::createReader( $file_type ); // создаем объект для чтения файла
		$objPHPExcel = $objReader->load( $filename ); // загружаем данные файла в объект
		$result = $objPHPExcel->getActiveSheet()->toArray(); // выгружаем данные из объекта в массив
		return $result; //возвращаем массив
	}
	/* Функция парсера xml файла - отдает многомерный массив */

	/*Функция формирует и сохраняет xml файл из многомерного массива */
	function Save_Exel_File($filename,$res){
		$pExcel = new PHPExcel(); //создаем рабочий объект
		$pExcel->setActiveSheetIndex(0); // устанавливаем номер рабочего документа
		$aSheet = $pExcel->getActiveSheet(); // получаем объект рабочего документа
		$aSheet->getRowDimension('1')->setRowHeight(50);
		$aSheet->getRowDimension('2')->setRowHeight(40);

		$data = strftime('%d.%m.%Y');
		$aSheet->mergeCells('A1:E1');// Обьеденение ячеек
		$aSheet->mergeCells('F1:H1');// Обьеденение ячеек
		$aSheet->setCellValue('A1','Служебная информация');
		$aSheet->setCellValue('F1','Остатки продукции Bella на '.$data.' года');
		$aSheet->setCellValue('A2','№');
		$aSheet->setCellValue('B2','Артикул');
		$aSheet->setCellValue('C2','Картинка');
		$aSheet->setCellValue('D2','Группа');
		$aSheet->setCellValue('E2','Подгруппа');
		$aSheet->setCellValue('F2','Наименование');
		$aSheet->setCellValue('G2','Склад');
		$aSheet->setCellValue('H2','Цена');
		$aSheet->setTitle("Прайс-лист"); //Название листа
		$aSheet->getColumnDimension('A')->setWidth(0.0);//Настройки основных полей
		$aSheet->getColumnDimension('B')->setWidth(0.0);//Настройки основных полей
		$aSheet->getColumnDimension('C')->setWidth(0.0);//Настройки основных полей
		$aSheet->getColumnDimension('D')->setWidth(0.0);//Настройки основных полей
		$aSheet->getColumnDimension('E')->setWidth(0.0);//Настройки основных полей
		$aSheet->getColumnDimension('F')->setAutoSize(true);//Настройки основных полей
		$aSheet->getColumnDimension('G')->setWidth(12);//Настройки основных полей
		$aSheet->getColumnDimension('H')->setWidth(12);//Настройки основных полей
		$aSheet->getDefaultStyle()->getFont()->setName('Arial');//Настройки основных полей
		$aSheet->getDefaultStyle()->getFont()->setSize(12);//Настройки основных полей
		$aSheet->getDefaultStyle()->getFont()->getColor()->applyFromArray(array('rgb' => '334677'));//Настройки основных полей
		$aSheet->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$aSheet->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_JUSTIFY);
		$style_one = array(
			//Шрифт
			'font'=>array(
				'bold' => true,
				'name' => 'Arial',
				'size' => 18
			),
		//Выравнивание
			'alignment' => array(
				'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER,
			),
		/*//Заполнение цветом
			'fill' => array(
				'type' => PHPExcel_STYLE_FILL::FILL_SOLID,
				'color'=>array(
					'rgb' => 'e1e9f2'
				)
			)*/
		 
		);
		$style_two = array(
		//Выравнивание
			'alignment' => array(
				'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER,
			),

		);

		$style_ones = array(
			//Шрифт
			'font'=>array(
				'bold' => true,
				'name' => 'Arial',
				'size' => 16
			),
		//Выравнивание
			'alignment' => array(
				'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_STYLE_ALIGNMENT::VERTICAL_CENTER,
			),
		);

		$aSheet->getStyle('A:E')->applyFromArray($style_two);//Настройки интервала полей
		$aSheet->getStyle('G:H')->applyFromArray($style_two);//Настройки интервала полей
		$aSheet->getStyle('A1:H1')->applyFromArray($style_one);//Настройки интервала полей
		$aSheet->getStyle('A2:H2')->applyFromArray($style_ones);//Настройки интервала полей
		 /*Стили конкретных ячеек*/
		 
				$writer_i=3;

				foreach($res as $ar){ // читаем массив
					$j=0;
					foreach($ar as $val){
						$aSheet->setCellValueByColumnAndRow($j,$writer_i,"$val"); // записываем данные массива в ячейку
						$j++;
					}
					$writer_i++;
				}
				$objWriter = new PHPExcel_Writer_Excel5($pExcel); // создаем объект для записи excel в файл
				$objWriter->save($filename); // сохраняем данные в excel формате
}
		/* Функция формирует и сохраняет xml файл из многомерного массива */
		
	/* Функция очистки кэша вызываем в админке при загрузке нового прайса */
	function cleanDir($dir) {
		$files = glob($dir."/*");
		$c = count($files);
		if (count($files) > 0) {
			foreach ($files as $file) {      
				if (file_exists($file)) {
				unlink($file);
				}   
			}
		}
	}
	/* Функция очистки кэша вызываем в админке при загрузке нового прайса */
	
/*********************************** Функция вывода статей ************************************/
	function function_parse_article($file_price = '', $flag){
		$pars_article = parse_excel_file($file_price); // Передаем адрес файла для парсинга
		$ii='';
		$pars_article_reverse = array_reverse($pars_article);//Инвертировал массив
		foreach($pars_article_reverse as $article_array){
			if($ii<10 && $flag == $article_array[1]){
				$ii++;
				$string = $article_array[5];
				//$string = strip_tags($string);
				//$string = substr($string, 0, 100);
				//$string = rtrim($string, "!,.-");
				//$article_array[5] = substr($string, 0, strrpos($string, ' '));
				echo '
					<p class="data">'.$article_array[2].'</p>
					<h3>'.$article_array[4].'</h3>
					<img src="'.HOSTS.'/images/articles/'.$flag.'/'.$article_array[3].'" alt="'.$article_array[4].'"/>
					<p class="p">'.$article_array[5].'</p>
					<center><div class="line"> </div></center>
				';
			}
		}
	}
/*********************************** Функция вывода статей ************************************/
?>