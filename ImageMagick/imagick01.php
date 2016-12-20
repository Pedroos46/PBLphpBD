<?php 
	$im = new Imagick();
	$im->newImage( 200, 150, 'NavajoWhite' );
	$draw = new ImagickDraw();
	$points = array(
				array( 'x' => 1, 'y' => 150 ),
				array( 'x' => 10, 'y' => 0 ),  
				array( 'x' => 80, 'y' => 50 ),
				array( 'x' => 120, 'y' => 50 ),
				array( 'x' => 189, 'y' => 150 ),
				array( 'x' => 199, 'y' => 0 )
			  );
	$draw->setFillColor('none');
	$draw->setStrokeColor( 'Black' );
	$draw->setStrokeWidth(1); 
	$draw->polyline( $points );
	$im->drawImage( $draw );
	$im->writeImage('draw_polyline.jpg');
	$im->destroy();
?>
<html>
<head>
	<meta content="text/html; charset=UTF-8" http-equiv="content-type">
	<title>Imagick01</title>
</head>  
<body>  
	<img src="draw_polyline.jpg" alt="Múltiples Línes">
</body>
</html>
