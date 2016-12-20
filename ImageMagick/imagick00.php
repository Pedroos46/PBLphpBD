<?php
	$im = new Imagick();
	$im->newImage( 200, 150, 'NavajoWhite' );
	$draw = new ImagickDraw();
	$draw->setFillColor('none');
	$draw->setStrokeColor( 'Black' );
	$draw->setStrokeWidth(1); 
	$draw->line( 10,140, 190,10 );
	$im->drawImage( $draw );
	$im->writeImage('draw_line.jpg');
	$im->destroy();
?>  
<html>
<head>
	<meta content="text/html; charset=UTF-8" http-equiv="content-type">
	<title>Imagick00</title>
</head>  
<body>  
	<img src="draw_line.jpg" alt="Línia">
</body>
</html>
