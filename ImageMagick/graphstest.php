<!DOCTYPE html>
<html lang="ca">

<head>
    <meta content="text/html"; charset="utf-8" http-equiv="content-type">
    <title>Gráficos</title>
</head>

<body>

<?php
	//Funció dibuixa_eix: Dibuixa els eixos de coordenades
    //
    function dibuixa_eix($draw) {
		global $strokeColor, $pixels, $q_notes;

        // Declaració del color de línia.
        $strk_clr = new \ImagickPixel($strokeColor);

        // Configuració de les propietats de línia.
        $draw->setStrokeColor($strk_clr);
        $draw->setStrokeOpacity(1);
        $draw->setStrokeWidth(2);

        // Dibuix dels eixos X i Y.
        $draw->line(0, 0, $pixels, 0);
        $draw->line(0, 0, 0, -$pixels*10);

        // Dibuix de les marques de l'eix X.
        for ($i = 0; $i <= $pixels; $i++)
            if ($i%$pixels == 0)
                $draw->line($i, 0, $i, 5);

        // Dibuix de les marques de l'eix Y.
        for ($i = 0; $i <= $pixels*10; $i++)
            if ($i%$pixels == 0)
                $draw->line(0, -$i, -5, -$i);
    }
    /* Funció dibuixa_barres:
     *
     * Dibuixa de forma dinàmica (segons la quantitat de posicions de l'array
     * $array_notes) les barres del gràfic.
     *
     * Les notes superiors o iguals a 5 (els aprovats) es representen de color verd.
     * En cas contrari (els suspesos) la barra serà de color vermell.
     * Les variables $fillColorA i $fillColorS guarden el color dels aprovats
     * i suspesos en notació hexadecimal.
     *
     */

    function dibuixa_barres($draw, $img) {
		global $strokeColor, $fillColorA, $fillColorS,$fontSize, $fillColorT, $alt, $pixels, $array_notes,$q_notes_no_rep;

		//Declaració dels colors de línia.
        $strk_clr = new \ImagickPixel($strokeColor);

        //Declaració dels colors d'aprovat i suspès.
        $fill_clrA = new \ImagickPixel($fillColorA);
        $fill_clrS = new \ImagickPixel($fillColorS);

        //Declaració de les propietats del text
        $draw->setFontSize($fontSize);
        $fill_clrT = new \ImagickPixel($fillColorT);
        $text_pos_vert = $alt - $pixels;

        //Configuració de les propietats de línia.
        $draw->setStrokeColor($strk_clr);
        $draw->setStrokeOpacity(1);
        $draw->setStrokeWidth(2);

        /*
         * Dibuix de les barres.
         *
         * En cas que $value (cadascun dels valors de $array_notes) sigui menor
         * que 5 (és a dir, suspès), la barra resultant serà vermella. Sinó,
         * serà verda.
         *
         * La variable $i és un comptador que va sumant píxels per dibuixar cada
         * barra al costat de l'anterior.
         *
         * La variable $key s'utilitza per escriure la llegenda (o sigui, la nota)
         *
         * La funció array_count_values() retorna un array utilitzant les notes d'array_notes com a claus
         * i la seva freqüència com a valor
         */
        asort($array_notes);
        $array_freq=array_count_values($array_notes);
        $q_notes_no_rep=count($array_freq);
        $i = 0;
        foreach ($array_freq as $nota => $freq) {
			// Color de la barra:
            // aprovat --> verd
            // suspès --> vermell
            if ($nota < 5)
                $draw->setFillColor($fill_clrS);
            else
                $draw->setFillColor($fill_clrA);

            // Dibuix del rectangle:
            $draw->rectangle($i, 0, $i+$pixels, -$freq*$pixels);

            // Llegenda
            $img->annotateImage($draw, $i+6/5*$pixels, $text_pos_vert, -90, $nota);
			// Increment del comptador de píxels
            $i += $pixels;
        }
        for ($i=0;$i<=10;$i++) { //Compte. Aquest valor 10 hauria de ser el valor de la nota que ha sortit més vegades
			$img->annotateImage($draw, 0, $i*$pixels+1/20*$text_pos_vert, 0, 10-$i);
		}
		$img->annotateImage($draw, 50, 1/10*$text_pos_vert, 0, "FREQÜÈNCIA DE LES NOTES");
    }

    /*
     * Funció dibuixa_grafic:
     *
     * Funció "main" del programa. A partir d'aquí s'inicialitzen els valors
     * necessaris per al funcionament del programa, es realitza la translació
     * del punt d'origen i es fan les crides a les funcions que fan la tasca de
     * dibuixar l'eix cartesià i les barres.
     *
     * En aquesta funció es defineixen també el color de fons i els marges del
     * gràfic respecte la imatge.
     *
     * La imatge no es printa a la pantalla fins que el programa no arriba a la
     * sentència de dibuix de l'objecte $imagick.
     *
     */
    function dibuxa_grafic() {
		global  $array_notes, $q_notes, $ampl, $alt, $backgroundColor, $marge;

        //Declaració de la imatge (objecte $imagick)
        $imagick = new \Imagick();
        $imagick->newImage($ampl, $alt, $backgroundColor);
        $imagick->setImageFormat("png");

        /*
         * Declaració del context ImagickDraw ($draw) i translació del punt
         * d'origen a la cantonada inferior esquerra.
         *
         * Degut a que la Y augmenta en sentit descendent, els VALORS VERTICALS
         * han de ser NEGATIUS per tal que el gràfic es dibuixi cap amunt.
         */
        $draw = new \ImagickDraw();
        $draw->translate($marge, $alt - 4*$marge);

        // Crida de les funcions que dibuixen el gràfic.
        dibuixa_eix($draw);
        dibuixa_barres($draw, $imagick);

        //Dibuix final de la imatge. Ara es quan apareix tot a la pantalla.
        $imagick->drawImage($draw);
        $imagick->setImageFormat ("png");
        file_put_contents ("grafico.png", $imagick);

        echo "<div id='container'><img src='grafico.png'/></div>";

    }

	/* Declaració de variables que el programa utilitza. Aquestes són:
     *
     * array_notes: Array amb les notes a partir de les quals s'ha de fer un gràfic
     *
     * q_notes: quantitat total de notes
     *
     * strokeColor: color de la línia.
     * fillColorA: color dels aprovats.
     * fillColorS: color dels suspesos.
     * backgroundColor: color de fons.
     *
     * fontSize: Mida de la lletra per al text del gràfic
     * fillColorT: Color del text
     *
     * pixels: proporció de píxels per cada unitat del gràfic
     * marge: pixels de marge que es deixen als costats del gràfic
     * horitzontal: pixels d'ample
     * vertical: pixels d'altura
     *
     *
     */
	//
	//Dades
	$array_notes=array(1,5,9,3,1,4,0,7,8,6,8,3,2,9,10,4,1,0,5,4,5,2,7,8,3,4,9);
	$q_notes = count($array_notes);
	$q_notes_no_rep=0;
    //
    //Definició dels colors
    $strokeColor = '#000000';
    $fillColorA = '#90EE90';
    $fillColorS = '#FF8383';
    $backgroundColor = '#FFFFFF';
    //
    //Propietats del text
    $fillColorT = '#000000';
    $fontSize = 15;
	//
	//Proporcions del gràfic
    $pixels = 45;
    $marge = 20;
    $ampl = $q_notes*$pixels + 2*$marge;
    $alt = 500 + $pixels;
	//
	//DIBUIXANT LA GRÀFICA
	dibuxa_grafic();

?>

</body>

</html>
