<?php
error_reporting(E_ALL ^ E_NOTICE);
/**
 * Created by PhpStorm.
 * User: Roger Pedrós Villorbina
 * Date: 16/12/2016
 * Time: 3:38
 */

require_once("Crud/MySQLcrud.php");
require_once("Crud/PDOcrud.php");
require_once("Controls/DBChecker.php");

session_start();
if(($_SESSION['loged'] == false) || ($_SESSION['loged'] == null)){
    echo '<h1> SESSIÓ O LOGIN INVALID </h1>';
    exit;
}

$BDconf = ["localhost", "root", "root", "escola"];

$MySQLi = new MySQLcrud($BDconf[0],$BDconf[1],$BDconf[2],$BDconf[3]);
$PDO = new PDOcrud($BDconf[0],$BDconf[1],$BDconf[2],$BDconf[3]);

//$Check = new DBChecker($BDconf[0],$BDconf[1],$BDconf[2],$BDconf[3]);
$Imagick = new ImageMagick($BDconf[0],$BDconf[1],$BDconf[2],$BDconf[3]);
?>

<html>
<head>
    <title>Gestio d'una escola.</title> <meta charset="utf-8">

    <!--MDL-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.indigo-pink.min.css">
    <script defer src="https://code.getmdl.io/1.2.1/material.min.js"></script>

    <link rel="stylesheet" href="https://cdn.rawgit.com/CreativeIT/getmdl-select/master/getmdl-select.min.css">
    <script defer src="https://cdn.rawgit.com/CreativeIT/getmdl-select/master/getmdl-select.min.js"></script>

    <!--Local Style-->
    <link rel="stylesheet" type="text/css" href="Styles/SecretariaSytle.css">

</head>

<body>
<div class="mdl-layout mdl-js-layout mdl-color--grey-100">
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <header class="mdl-layout__header">
            <div class="mdl-layout__header-row">
                <!-- Title -->
                <span class="mdl-layout-title">Secretaria</span>
                <!-- Add spacer, to align navigation to the right -->
                <div class="mdl-layout-spacer"></div>
                <!-- Navigation. We hide it in small screens. -->
                <nav class="mdl-navigation mdl-layout--large-screen-only">
                    <a class="mdl-navigation__link"></a>
                </nav>
            </div>
        </header>
        <main class="mdl-layout__content">
            <div class="page-content">

                <div class="demo-card-square mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-card--expand">
                        <h2 class="mdl-card__title-text">Revisió o Restabliment de la BD</h2>
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                            Fes-ho.
                        </a>
                    </div>
                </div>

                <div class="demo-card-square mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-card--expand">
                        <h2 class="mdl-card__title-text">Alumnes</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        Crear, actualizar i elimminar els Alumnes de l'escola.
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <a href="http://localhost/daw2/php/PBLphpBD/Secretaria/SecretariaAlum.php" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                            Anar-hi.
                        </a>
                    </div>
                </div>
                <div class="demo-card-square mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-card--expand">
                        <h2 class="mdl-card__title-text">Profesors</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        Crear, actualizar i elimminar els Profesors de l'escola.
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <a href="http://localhost/daw2/php/PBLphpBD/Secretaria/SecretariaProf.php" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                            Anar-hi.
                        </a>
                    </div>
                </div>
                <div class="demo-card-square mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-card--expand">
                        <h2 class="mdl-card__title-text">Cursos</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        Crear, actualizar i elimminar cursos de l'escola.
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <a href="http://localhost/daw2/php/PBLphpBD/Secretaria/SecretariaCurs.php" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                            Anar-hi.
                        </a>
                    </div>
                </div>
                <div class="demo-card-square mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-card--expand">
                        <h2 class="mdl-card__title-text">Assignatures</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        Crear, actualizar i elimminar assignatures de l'escola.
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <a href="http://localhost/daw2/php/PBLphpBD/Secretaria/SecretariaAssing.php" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                            Anar-hi.
                        </a>
                    </div>
                </div>


                <div class="demo-card-wide mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__media">
                        ////////////////////////////////////////////////////////////////
                        <?php

                        class ImageMagick{
                            private $url = '';
                            private $user = '';
                            private $pass = '';
                            private $bd = '';

                            /*
                        *Esta función invoca o llama los metodos declarados en los objetos creados.
                        */

                            function __construct($url, $user, $pass, $bd){
                                $this->url = $url;
                                $this->user = $user;
                                $this->pass = $pass;
                                $this->bd = $bd;

                                $this->MySQLi = new MySQLcrud($url, $user, $pass, $bd);
                                $this->PDO = new PDOcrud($url, $user, $pass, $bd);

                                $this->array_notes = array();
                                $this->q_notes = ''; //aquesta linia s'a de reexecutar
                                $this->q_notes_no_rep = 0;

                                //Definició dels colors
                                $this->strokeColor = '#000000';
                                $this->fillColorA = '#90EE90';
                                $this->fillColorS = '#FF8383';
                                $this->backgroundColor = '#FFFFFF';

                                //Propietats del text
                                $this->fillColorT = '#000000';
                                $this->fontSize = 15;

                                //Proporcions del gràfic
                                $this->pixels = 45;
                                $this->marge = 20;
                                $this->ampl = ''; //aquesta linia s'ha de reexecutar
                                $this->alt = 500 + $this->pixels;
                            }
                        /*
                        *Esta funcion sera llamada cuando no hayan referencias a un objeto determinado o cuando algo finalice.
                        */
                            function __destruct(){    }


                            //DIBUIXANT LA GRÀFICA

                            function GraficPanelAlumne($dni){ //grafico de alumno
                                $Notaalumne = $this->MySQLi->getAsignaturaAlum($dni);

                                foreach($Notaalumne as $data){
                                    array_push($this->array_notes, $data[nota]);
                                }

                                $this->q_notes = count($this->array_notes);
                                $this->ampl = $this->q_notes*$this->pixels + 2*$this->marge;

                                dibuxa_grafic();
                            }

                            function GraficSecretaria(){//grafico de tot global
                                $Notaalumne[] = $this->MySQLi->getTotesAsignatures();

                                foreach($Notaalumne as $data){
                                    array_push($this->array_notes, $data[nota]);
                                }

                                $this->q_notes = count($this->array_notes);
                                $this->ampl = $this->q_notes*$this->pixels + 2*$this->marge;

                                // dibuxa_grafic();
                            }

                            function GraficPanelProf($asignatura){ //grafico de asignatura por separado
                                $Notaalumne = $this->MySQLi->getAsignaturaProf($asignatura);

                                foreach($Notaalumne as $data){
                                    array_push($this->array_notes, $data[nota]);
                                }

                                $this->q_notes = count($this->array_notes);
                                $this->ampl = $this->q_notes*$this->pixels + 2*$this->marge;

                                dibuxa_grafic();
                            }

                            function GraficoMedia(){ //grafico de la media
                                $Notaalumne = $this->MySQLi->getTotesAsignatures();

                                foreach($Notaalumne as $data){
                                    array_push($this->array_notes, $data[nota]);
                                }

                                $this->q_notes = count($this->array_notes);
                                $this->ampl = $this->q_notes*$this->pixels + 2*$this->marge;

                                dibuxa_grafic();
                            }

                            //Funció dibuixa_eix: Dibuixa els eixos de coordenades
                            //
                            function dibuixa_eix($draw){
                                $this->strokeColor;
                                $this->pixels;
                                $this->q_notes;
                                $draw = new \ImagickDraw();
                                $draw->translate($this->marge, $this->alt - 4 * $this->marge);
                                // Declaració del color de línia.
                                $this->strk_clr = new \ImagickPixel($this->strokeColor);

                                // Configuració de les propietats de línia.
                                $draw->setStrokeColor($this->strk_clr);
                                $draw->setStrokeOpacity(1);
                                $draw->setStrokeWidth(2);

                                // Dibuix dels eixos X i Y.
                                $draw->line(0, 0, $this->pixels, 0);
                                $draw->line(0, 0, 0, -$this->pixels * 10);

                                // Dibuix de les marques de l'eix X.
                                for ($i = 0; $i <= $this->pixels; $i++)
                                    if ($i % $this->pixels == 0)
                                        $draw->line($i, 0, $i, 5);

                                // Dibuix de les marques de l'eix Y.
                                for ($i = 0; $i <= $this->pixels * 10; $i++)
                                    if ($i % $this->pixels == 0)
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

                            function dibuixa_barres($draw, $img)
                            {
                                $this->strokeColor;
                                $this->fillColorA;
                                $this->fillColorS;
                                $this->fontSize;
                                $this->fillColorT;
                                $this->alt;
                                $this->pixels;
                                $this->array_notes;
                                $this->q_notes_no_rep;

                                //Declaració dels colors de línia.
                                $strk_clr = new \ImagickPixel($this->strokeColor);

                                //Declaració dels colors d'aprovat i suspès.
                                $this->fill_clrA = new \ImagickPixel($this->fillColorA);
                                $this->fill_clrS = new \ImagickPixel($this->fillColorS);
                                $draw = new \ImagickDraw();
                                $draw->translate($this->marge, $this->alt - 4 * $this->marge);
                                //Declaració de les propietats del text
                                $draw->setFontSize($fontSize);
                                $this->fill_clrT = new \ImagickPixel($fillColorT);
                                $this->text_pos_vert = $this->alt - $this->pixels;

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
                                asort($this->array_notes);
                                $this->array_freq = array_count_values($this->array_notes);
                                $this->q_notes_no_rep = count($this->array_freq);
                                $i = 0;

                                foreach ($this->array_freq as $nota => $freq){
                                    // Color de la barra:
                                    // aprovat --> verd
                                    // suspès --> vermell
                                    if ($nota < 5)
                                        $draw->setFillColor($this->fill_clrS);
                                    else
                                        $draw->setFillColor($this->fill_clrA);

                                    // Dibuix del rectangle:
                                    $draw->rectangle($i, 0, $i + $this->pixels, -$freq * $this->pixels);

                                    // Llegenda
                                    $img->annotateImage($draw, $i + 6 / 5 * $this->pixels, $this->text_pos_vert, -90, $nota);
                                    // Increment del comptador de píxels
                                    $i += $this->pixels;
                                }
                                for ($i = 0; $i <= 10; $i++) { //Compte. Aquest valor 10 hauria de ser el valor de la nota que ha sortit més vegades
                                    $img->annotateImage($draw, 0, $i * $this->pixels + 1 / 20 * $this->text_pos_vert, 0, 10 - $i);
                                }
                                $img->annotateImage($draw, 50, 1 / 10 * $this->text_pos_vert, 0, "FREQÜÈNCIA DE LES NOTES");
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
                            function dibuxa_grafic(){
                                $this->array_notes;
                                $this->q_notes;
                                $this->ampl;
                                $this->alt;
                                $this->backgroundColor;
                                $this->marge;

                                //Declaració de la imatge (objecte $imagick)
                                $this->imagick = new \Imagick();
                                $this->imagick->newImage($this->ampl, $this->alt, $this->backgroundColor);
                                $this->imagick->setImageFormat("png");

                                /*
                                 * Declaració del context ImagickDraw ($draw) i translació del punt
                                 * d'origen a la cantonada inferior esquerra.
                                 *
                                 * Degut a que la Y augmenta en sentit descendent, els VALORS VERTICALS
                                 * han de ser NEGATIUS per tal que el gràfic es dibuixi cap amunt.
                                 */
                                $draw = new \ImagickDraw();
                                $draw->translate($this->marge, $this->alt - 4 * $this->marge);

                                // Crida de les funcions que dibuixen el gràfic.
                                // dibuixa_eix($draw);
                                // dibuixa_barres($draw, $this->imagick);

                                //Dibuix final de la imatge. Ara es quan apareix tot a la pantalla.
                                $this->imagick->drawImage($draw);
                                $this->imagick->setImageFormat("png");
                                file_put_contents("grafico.png", $this->imagick);

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


                        }
                        $Imagick->GraficSecretaria();
                        $Imagick->dibuxa_grafic();
                        //////////////////////////////////////////////////////////////////////////////////////////////////////
                        ?>

                        <!--                        Per aqui haurie d'anar el grafic-->
                        <img src="grafico.png">
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <div class="mdl-card__supporting-text">
                            Explicacio de la grafica
                        </div>
                    </div>
                </div>

        </main>
    </div>
</div>
</body>
</html>

}
