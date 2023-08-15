<?php
// Настройки сайта
define('DOMAIN', $_SERVER['HTTP_HOST']);//убирают ошибки с константами в описании
define('HOST', 'http://'.$_SERVER['HTTP_HOST']);//убирают ошибки с константами в описании
require_once '../config/settings.php';

function imageReplaceColor(&$src, $color_icon) {
	list($red, $green, $blue) = array(
		$color_icon{0}.$color_icon{1},
		$color_icon{2}.$color_icon{3},
		$color_icon{4}.$color_icon{5}
	);
	$red = hexdec($red); 
	$green = hexdec($green);
	$blue = hexdec($blue);

	imagealphablending($src, false);
	imagesavealpha($src, true);
	$srcW = imagesx($src);
	$srcH = imagesy($src);
	for($x = 0; $x < $srcW; $x++) {
		for($y = 0; $y < $srcH; $y++) {
			$srcColor = imagecolorsforindex($src, imagecolorat($src, $x, $y));
			$srcColor = imagecolorallocatealpha($src, $red, $green, $blue, $srcColor['alpha']);
			imagesetpixel($src, $x, $y, $srcColor);
		}
	}
}
if(isset($_GET['color_icon'])){
	$image = imagecreatefrompng('../templates/'.$TMPL['templates'].'/images/'.$_GET['name_icon'].'.png');
	imageReplaceColor($image, $_GET['color_icon']);
	header('Content-type: image/png');
	imagepng($image);
}