<?php
	$fillColor='black'; 
	$backgroundColor='yellow';
	$draw = new ImagickDraw();
    $draw->setFillColor($fillColor);
    $points = array(array(1,1),array(20,5),array(30,8),array(40,15),array(50,23),
			  array(60,35),array(70,50),array(80,65),array(85,80),array(90,105),
			  array(95,128),array(98,155));
    $size=count($points);
	for ($x = 0; $x < $size; $x++) {
        $draw->point($points[$x][0],$points[$x][1]);
    }
    $imagick = new Imagick();
    $imagick->newImage(100, 160, $backgroundColor);
    $imagick->setImageFormat("png");
    $imagick->drawImage($draw);
    header("Content-Type: image/png");
    echo $imagick->getImageBlob();
?>

