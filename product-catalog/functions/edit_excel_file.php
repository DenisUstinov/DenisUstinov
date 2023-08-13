<?php
	function edit_excel_file($filename,$b,$c,$e,$f){
		$array = array();
		$file_type = PHPExcel_IOFactory::identify( $filename );
		$objReader = PHPExcel_IOFactory::createReader($file_type);
		$objPHPExcel = $objReader->load( $filename );
		$array = $objPHPExcel->getActiveSheet()->toArray();
		$i = count($array );
		$ii = $i-1;
		if($array[$ii][0] != null){
			$i++;
		}
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$i, $i)
			->setCellValue('B'.$i, $b)
			->setCellValue('C'.$i, $c)
			->setCellValue('D'.$i, $i.'jpg')
			->setCellValue('E'.$i, $e)
			->setCellValue('F'.$i, $f);

		$save = new PHPExcel_Writer_Excel5($objPHPExcel);
		$save->save($filename);
		
		unset($objPHPExcel);
		unset($save);
		return($i);
	}
?>