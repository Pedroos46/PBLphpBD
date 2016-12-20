<?php
	$fillColor='black'; 
	$backgroundColor='yellow';
	$draw = new ImagickDraw();
    $draw->setFillColor($fillColor);
    for ($x = 0; $x < 10000; $x++) {
        $draw->point(rand(0, 500), rand(0, 500));
    }
    $imagick = new Imagick();
    $imagick->newImage(500, 500, $backgroundColor);
    $imagick->setImageFormat("png");
    $imagick->drawImage($draw);
    header("Content-Type: image/png");
    echo $imagick->getImageBlob();
?>

