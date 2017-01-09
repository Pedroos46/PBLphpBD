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

session_start();
if(($_SESSION['loged'] == false) || ($_SESSION['loged'] == null)){
    echo '<h1> SESSIÓ O LOGIN INVALID </h1>';
    echo '<img src="https://s-media-cache-ak0.pinimg.com/564x/c3/a0/3c/c3a03c07eebed8c70fffdeb8e66f5d0b.jpg" alt="Mountain View" >';

    exit;
}

$BDconf = ["localhost", "root", "root", "escola"];

$MySQLi = new MySQLcrud($BDconf[0],$BDconf[1],$BDconf[2],$BDconf[3]);
$PDO = new PDOcrud($BDconf[0],$BDconf[1],$BDconf[2],$BDconf[3]);

$Imagick = new ImageMagick($BDconf[0],$BDconf[1],$BDconf[2],$BDconf[3]);

//print_r($MySQLi->getAsignaturaAlum("47931590G"));
//print_r($MySQLi->getAsignaturaProf($usuari[$asignatura]));

if($_SESSION['type'] == "Profesor"){
   $profesor = $MySQLi->getProfesor($_SESSION['dni']);

   $asig = $MySQLi->getAsignaturaProf($profesor[asignatura]);

}

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
    <link rel="stylesheet" type="text/css" href="Styles/PanelStyle.css">

</head>

<body>
<div class="mdl-layout mdl-js-layout mdl-color--grey-100">
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <header class="mdl-layout__header">
            <div class="mdl-layout__header-row">
                <!-- Title -->
                <span class="mdl-layout-title"><?php echo $profesor[nom] . " " . $profesor[cognom];?></span>
                <!-- Add spacer, to align navigation to the right -->
                <div class="mdl-layout-spacer"></div>
                <!-- Navigation. We hide it in small screens. -->
                <nav class="mdl-navigation mdl-layout--large-screen-only">
                    <a class="mdl-navigation__link"><?php echo $profesor[asignatura];?></a>
                </nav>
            </div>
        </header>
        <main class="mdl-layout__content">
            <div class="page-content">
                <!--GENERADOR TAULA-->
                <?php
                if($_SESSION['type'] == "Profesor"){//OSIFUI QUAN S'HAN DE CARREGAR TOTS ELS ALUMNES D'UNA ASIGNATURA

                    include("Formularis/taulaProfesor.php");
                        $iteracionsMax = count($asig);
                        $i = 0;
                        while($iteracionsMax > $i){
                            $nomAlum = $PDO->getAlumne($asig[$i][DNI_Alumne]);
                            echo '<tr>';
                                echo '<td>' . $asig[$i][DNI_Alumne] . '</td>';
                                echo '<td>' . $nomAlum[nom] . ' ' . $nomAlum[cognom] . '</td>';
                                echo '<td>' . $asig[$i][nota] . '</td>';
                                echo '<td>' . $asig[$i][curs] . '</td>';
                            echo '</tr>';
                            $i++;
                        }
                        echo '</tbody>';
                    echo '</table>';

                    include("Formularis/formulariProfesor.php");

                    echo '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select">';
                    echo '<input class="mdl-textfield__input" id="curs" name="curs" value="" type="text" readonly tabIndex="-1" data-val="BLR"/>';
                    echo '<label class="mdl-textfield__label" for="country">Curs</label>';
                    echo '<ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu" for="curs">';
                    foreach ($DataCursos as $data){
                        echo '<li class="mdl-menu__item">'.$data[nom_curs]. '</li>';
                    }
                    echo '</ul>';
                    echo '</div>';

                    include("Formularis/IntroActuDel.php");

                    echo '<div class="mdl-card__actions mdl-card--border">';
                    echo '<button type="submit" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" name="Submit"> Dale';
                    echo '</button>';
                    echo '</div>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';

                    if(isset($_POST['alumdni']) && isset($_POST['aign']) && isset($_POST['nota']) && isset($_POST['options'])){
                        if(($_POST['options'])== "Introduir"){
                            echo $MySQLi->fillAsignatura($_POST['aign'], $_POST['alumdni'], $_POST['nota']);
                        }
                        if(($_POST['options'])== "Eliminar"){
                            echo $MySQLi->deleteNotaAsignatura($_POST['aign'], $_POST['alumdni']);
                        }
                        if(($_POST['options'])== "Actualitzar"){
                            echo $MySQLi->updateAsignatura($_POST['aign'], $_POST['alumdni'], $_POST['nota']);
                        }

                    } else{
                        echo 'Falta introduir dades';
                    }
                }

                ?>


            <div class="demo-card-wide mdl-card mdl-shadow--2dp">
                <div class="mdl-card__media">
<!--                        Per aqui haurie d'anar el grafic-->
                    <img src="">
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


