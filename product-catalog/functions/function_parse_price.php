<?php
/*********************************** Функция парсинг прайса ************************************/
	function function_parse_price($file_price = '', $start_html = '', $center_html = '', $stop_html = '', $flags = false, $discount_bella = '', $discount_seni = ''){
		$pars_price = parse_excel_file($file_price); // Передаем адрес файла для парсинга
		$punkt_menu = ''; // Инициализируем чтобы изначально была пустая
		$menu = ''; // Инициализируем чтобы изначально была пустая
		$i = ''; // Инициализировал счетчик для того чтобы не попадать в первый массив.
		foreach($pars_price as $price_array){
			$i ++;
			if($i>2){
				if($punkt_menu != $price_array[3]){
					$punkt_menu = $price_array[3];
					$menu .= $start_html.$punkt_menu.$center_html.$punkt_menu.$stop_html;
				}
				
				
				if($price_array[4] == 'Bella'){
					$price = $price_array[7]*$discount_bella;
				}elseif($price_array[4] == 'Seni'){
					$price = $price_array[7]*$discount_seni;
				}
				
				if($flags == 'admin'){// если флаг есть и равен админ дополнительно выведим товары
					$menu .= '
						<div style="width:100%">
							<input style="text-align:center; margin:10px; min-width: 40px;width: 4%; font-size: 1.45em; color:#47a3da; border: solid 1px #47a3da" name="'.$price.'^'.$price_array[5].'" type="number" autocomplete="off">
							<label>'.$price_array[5].'<span> ( '.(int)$price_array[6].' шт / '.(int)$price.' р )</span></label>
						</div>';
				}elseif($flags == 'client'){// если флаг есть и равен клиент дополнительно выведим товары
					$menu .= '
						<table class="price_table">
							<tr>
								<td width="10%">
									<img src="'.HOSTS.'/images/'.$price_array[2].'" title="'.$price_array[2].'">
								</td>
								<td>
									<table style="padding:0 10px;">
										<tr>
											<td>
												<h3>'.$price_array[5].'</h3>
											</td>
										</tr>
										<tr>
											<td>
												Остаток: <span style="color: #ef6d4b;"> '.(int)$price_array[6].' шт.</span>
											</td>
										</tr>
										<tr>
											<td>Цена: <span style="color: #ef6d4b; font-size:1.8em"> '.(int)$price.' р.</span></td>
										</tr>
									</table>
								</td>
								<td width="5%">
									<input class="input_price" name="'.$price.'^'.$price_array[5].'" type="number" autocomplete="off" placeholder="0">
								</td>
							</tr>
						</table>
					';
				}
			}
		}
		return $menu;
	}
/*********************************** Функция парсинг прайса ************************************/
?>