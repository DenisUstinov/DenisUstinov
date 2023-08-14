<?php
	function imageReplaceColor(&$src, $color_icon)
	{
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
		for($x = 0; $x < $srcW; $x++)
		{
			for($y = 0; $y < $srcH; $y++)
			{
				$srcColor = imagecolorsforindex($src, imagecolorat($src, $x, $y));
				$srcColor = imagecolorallocatealpha($src, $red, $green, $blue, $srcColor['alpha']);
				imagesetpixel($src, $x, $y, $srcColor);
			}
		}
	}

	if(isset($_GET['image_name'])){
		$image_name = '../images/weather/'.$_GET['image_name'];
		$image = imagecreatefrompng($image_name);
		imageReplaceColor($image, $_GET['color_icon']);
		header('Content-type: image/png');
		imagepng($image);
	}
?>