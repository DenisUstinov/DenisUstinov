<?php

function if_exists($variabl) {
	if (isset($variabl)) {
		return $variabl;
	} else {
		return 0;
	}
}
function publishedAt($publishedAt) {
	$publishedAt = explode(' ', $publishedAt);
	switch($publishedAt[1]) {
		case 'янв.': $mon = 01; break;
		case 'февр.': $mon = 02; break;
		case 'мар.': $mon = 03; break;
		case 'апр. ': $mon = 04; break;
		case 'мая': $mon = 05; break;
		case 'июн.': $mon = 06; break;
		case 'июл.': $mon = 07; break;
		case 'авг.': $mon = 08; break;
		case 'сент.': $mon = 09; break;
		case 'окт.': $mon = 10; break;
		case 'нояб.': $mon = 11; break;
		default : $mon = 12;
	}
	return date("c", strtotime("$publishedAt[2]-$mon-$publishedAt[0] ".date('H:i:s')));
}
function showDate($time) {
	$time = time() - $time;
	if ($time < 60) {
		return 'меньше минуты назад';
	} elseif ($time < 3600) {
		return dimension((int)($time/60), 'i');
	} elseif ($time < 86400) {
		return dimension((int)($time/3600), 'G');
	} elseif ($time < 2592000) {
		return dimension((int)($time/86400), 'j');
	} elseif ($time < 31104000) {
		return dimension((int)($time/2592000), 'n');
	} elseif ($time >= 31104000) {
		return dimension((int)($time/31104000), 'Y');
	}
}

function dimension($time, $type) {
	$dimension = array(
		'n' => array('месяцев', 'месяц', 'месяца', 'месяц'),
		'j' => array('дней', 'день', 'дня'),
		'G' => array('часов', 'час', 'часа'),
		'i' => array('минут', 'минуту', 'минуты'),
		'Y' => array('лет', 'год', 'года')
	);
	$n = 0;
    if ($time >= 5 && $time <= 20)
        $n = 0;
    else if ($time == 1 || $time % 10 == 1)
        $n = 1;
    else if (($time <= 4 && $time >= 1) || ($time % 10 <= 4 && $time % 10 >= 1))
        $n = 2;
    return $time.' '.$dimension[$type][$n]. ' назад';
}

function translit1 ($text) { 
	$RU['ru'] = array( 
		'Ё', 'Ж', 'Ц', 'Ч', 'Щ', 'Ш', 'Ы',  
		'Э', 'Ю', 'Я', 'ё', 'ж', 'ц', 'ч',  
		'ш', 'щ', 'ы', 'э', 'ю', 'я', 'А',  
		'Б', 'В', 'Г', 'Д', 'Е', 'З', 'И',  
		'Й', 'К', 'Л', 'М', 'Н', 'О', 'П',  
		'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ъ',  
		'Ь', 'а', 'б', 'в', 'г', 'д', 'е',  
		'з', 'и', 'й', 'к', 'л', 'м', 'н',  
		'о', 'п', 'р', 'с', 'т', 'у', 'ф',  
		'х', 'ъ', 'ь', '/'
		); 

	$EN['en'] = array( 
		"yo", "zh",  "cz", "ch", "shh","sh", "y",  
		"e", "yu",  "ya", "yo", "zh", "cz", "ch",  
		"sh", "shh", "y", "e'", "yu", "ya", "a",  
		"b" , "v" ,  "g",  "d",  "e",  "z",  "i",  
		"j",  "k",   "l",  "m",  "n",  "o",  "p",  
		"r",  "s",   "t",  "u",  "f",  "kh",  "", 
		"",  "a",   "b",  "v",  "g",  "d",  "e",  
		"z",  "i",   "j",  "k",  "l",  "m",  "n",   
		"o",  "p",   "r",  "s",  "t",  "u",  "f",   
		"h",  "",  "",  ""
		); 
	$text = str_replace($RU['ru'], $EN['en'], preg_replace("/[^a-zA-Zа-яА-Я0-9 ]/ui", "", $text));
	return mb_strtolower(preg_replace("/[\s]+/u", "-", trim($text))); 
}

function translit($text) {
	$text = preg_replace("/[^\w ]/ui", "", $text);
	$foreign_characters = chars();
	$array_from = array_keys($foreign_characters);
	$array_to = array_values($foreign_characters);
	$title = preg_replace($array_from, $array_to, $text); 
	$title = preg_replace("/-{1,}/", "-", $title);
	return $title;
}
function chars() {
  return array(
	'/ä|æ|ǽ/' => 'ae','/ö|œ/' => 'oe','/ü/' => 'ue','/Ä/' => 'Ae','/Ü/' => 'Ue','/Ö/' => 'Oe','/À|Á|Â|Ã|Ä|Å|Ǻ|Ā|Ă|Ą|Ǎ|Α|Ά|Ả|Ạ|Ầ|Ẫ|Ẩ|Ậ|Ằ|Ắ|Ẵ|Ẳ|Ặ|А/' => 'a','/à|á|â|ã|å|ǻ|ā|ă|ą|ǎ|ª|α|ά|ả|ạ|ầ|ấ|ẫ|ẩ|ậ|ằ|ắ|ẵ|ẳ|ặ|а/' => 'a',
	'/Б/' => 'b','/б/' => 'b','/Ç|Ć|Ĉ|Ċ|Č/' => 'C','/ç|ć|ĉ|ċ|č/' => 'c','/Д/' => 'd','/д/' => 'd','/Ð|Ď|Đ|Δ/' => 'Dj','/ð|ď|đ|δ/' => 'dj','/È|É|Ê|Ë|Ē|Ĕ|Ė|Ę|Ě|Ε|Έ|Ẽ|Ẻ|Ẹ|Ề|Ế|Ễ|Ể|Ệ|Е|Э/' => 'e','/è|é|ê|ë|ē|ĕ|ė|ę|ě|έ|ε|ẽ|ẻ|ẹ|ề|ế|ễ|ể|ệ|е|э/' => 'e','/Ф/' => 'f',
	'/ф/' => 'f','/Ĝ|Ğ|Ġ|Ģ|Γ|Г|Ґ/' => 'g','/ĝ|ğ|ġ|ģ|γ|г|ґ/' => 'g','/Ĥ|Ħ/' => 'H','/ĥ|ħ/' => 'h','/Ì|Í|Î|Ï|Ĩ|Ī|Ĭ|Ǐ|Į|İ|Η|Ή|Ί|Ι|Ϊ|Ỉ|Ị|И|Ы/' => 'i','/ì|í|î|ï|ĩ|ī|ĭ|ǐ|į|ı|η|ή|ί|ι|ϊ|ỉ|ị|и|ы|ї/' => 'i','/Ĵ/' => 'J','/ĵ/' => 'j','/Ķ|Κ|К/' => 'k','/ķ|κ|к/' => 'k','/Ĺ|Ļ|Ľ|Ŀ|Ł|Λ|Л/' => 'l','/ĺ|ļ|ľ|ŀ|ł|λ|л/' => 'l','/М/' => 'm','/м/' => 'm','/Ñ|Ń|Ņ|Ň|Ν|Н/' => 'n','/ñ|ń|ņ|ň|ŉ|ν|н/' => 'n','/Ò|Ó|Ô|Õ|Ō|Ŏ|Ǒ|Ő|Ơ|Ø|Ǿ|Ο|Ό|Ω|Ώ|Ỏ|Ọ|Ồ|Ố|Ỗ|Ổ|Ộ|Ờ|Ớ|Ỡ|Ở|Ợ|О/' => 'o','/ò|ó|ô|õ|ō|ŏ|ǒ|ő|ơ|ø|ǿ|º|ο|ό|ω|ώ|ỏ|ọ|ồ|ố|ỗ|ổ|ộ|ờ|ớ|ỡ|ở|ợ|о/' => 'o','/П/' => 'p','/п/' => 'p','/Ŕ|Ŗ|Ř|Ρ|Р/' => 'r','/ŕ|ŗ|ř|ρ|р/' => 'r','/Ś|Ŝ|Ş|Ș|Š|Σ|С/' => 's','/ś|ŝ|ş|ș|š|ſ|σ|ς|с/' => 's','/Ț|Ţ|Ť|Ŧ|τ|Т/' => 't',
	'/ț|ţ|ť|ŧ|т/' => 't',
	'/Þ|þ/' => 'th',
	'/Ù|Ú|Û|Ũ|Ū|Ŭ|Ů|Ű|Ų|Ư|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ|Ũ|Ủ|Ụ|Ừ|Ứ|Ữ|Ử|Ự|У/' => 'u',
	'/ù|ú|û|ũ|ū|ŭ|ů|ű|ų|ư|ǔ|ǖ|ǘ|ǚ|ǜ|υ|ύ|ϋ|ủ|ụ|ừ|ứ|ữ|ử|ự|у/' => 'u',
	'/Ý|Ÿ|Ŷ|Υ|Ύ|Ϋ|Ỳ|Ỹ|Ỷ|Ỵ|Й/' => 'y',
	'/ý|ÿ|ŷ|ỳ|ỹ|ỷ|ỵ|й/' => 'y',
	'/В/' => 'v',
	'/в/' => 'v',
	'/Ŵ/' => 'w',
	'/ŵ/' => 'w',
	'/Ź|Ż|Ž|Ζ|З/' => 'z',
	'/ź|ż|ž|ζ|з/' => 'z',
	'/Æ|Ǽ/' => 'AE',
	'/ß/' => 'ss',
	'/Ĳ/' => 'IJ',
	'/ĳ/' => 'ij',
	'/Œ/' => 'OE',
	'/ƒ/' => 'f',
	'/ξ/' => 'ks',
	'/π/' => 'p',
	'/β/' => 'v',
	'/μ/' => 'm',
	'/ψ/' => 'ps',
	'/Ё/' => 'yo',
	'/ё/' => 'yo',
	'/Є/' => 'ye',
	'/є/' => 'ye',
	'/Ї/' => 'yi',
	'/Ж/' => 'zh',
	'/ж/' => 'zh',
	'/Х/' => 'Kh',
	'/х/' => 'kh',
	'/Ц/' => 'Ts',
	'/ц/' => 'ts',
	'/Ч/' => 'ch',
	'/ч/' => 'ch',
	'/Ш/' => 'Sh',
	'/ш/' => 'sh',
	'/Щ/' => 'shch',
	'/щ/' => 'shch',
	'/Ъ|ъ|Ь|ь/' => '',
	'/Ю/' => 'yu',
	'/ю/' => 'yu',
	'/Я/' => 'ya',
	'/я/' => 'ya',
	'/ /'=> '-',
	'/\./'=>'',
	'/\,/' => '',
	'/!/' =>'',
	'/\?/'=>'',
	'/\#/'=>'',
	'/\(/'=>'',
	'/\)/'=>'',
	'/\%/'=>'',
	'/\"/' =>'',
	'/\'/'=>'',
	'/\[/'=>'',
	'/\]/'=>'',
	'/{/'=>'',
	'/}/'=>'',
	'/\+/'=>'',
	'/\//'=>'',
	'/`/'=>'',
	'/\|/' =>'',
	'/\&/'=>'',
	'/¦/'=>'',
	'/\:/'=>'','/A/'=>'a','/B/'=>'b','/C/'=>'c','/D/'=>'d','/E/'=>'e','/F/'=>'f','/G/'=>'g','/H/'=>'h','/I/'=>'i','/J/'=>'j','/K/'=>'k','/L/'=>'l','/M/'=>'m','/N/'=>'n','/O/'=>'o','/P/'=>'p','/Q/'=>'q','/R/'=>'r','/S/'=>'s','/T/'=>'t','/U/'=>'u','/V/'=>'v','/W/'=>'w','/X/'=>'x','/Y/'=>'y','/Z/'=>'z', '/,/'=>'','/»/'=>'', '/«/'=>'', '/„/'=>'', '/“/'=>''
	);
}

function upUrl($text) {
	return removeUrl($text);
	/*обертка ссылок ноиндексами
    $regex = "#(https?|ftp)://\S+[^\s.,>)\];'\"!?]#";
    return upBreak(preg_replace_callback($regex, function ($matches) {
        return "<!--noindex--><!--googleoff: all-->{$matches[0]}<!--googleon: all--><!--/noindex-->";
    }, $text));*/
}

function removeUrl($text) {
	return preg_replace("#(https?|ftp)://\S+[^\s.,>)\];'\"!?]#", '', upBreak($text));
}

function upBreak($text) {
	return preg_replace("/[\n]+/u", "\n", $text);
}

if (!function_exists('mb_ucfirst') && function_exists('mb_substr')) {
	function mb_ucfirst($string) {
		$string = mb_strtoupper(mb_substr($string, 0, 1)) . mb_substr($string, 1);
		return $string;
	}
}
function duration($duration) {
	$array_duration = explode (':', $duration);
	switch (count($array_duration)) {
		case 1: $schema_duration = 'PT' . $array_duration[0] . 'S'; break;
		case 2: $schema_duration = 'PT' . ltrim($array_duration[0], '0') . 'M' .$array_duration[1] . 'S'; break;
		case 3: if ($array_duration[0] == 00) : $schema_duration = 'PT' . ltrim($array_duration[1], '0') . 'M' .$array_duration[2] . 'S'; else : $schema_duration = 'PT' . ltrim($array_duration[0], '0') .'H'. ltrim($array_duration[1], '0') . 'M' .$array_duration[2] . 'S'; endif; break;
	}
	return $schema_duration;
}