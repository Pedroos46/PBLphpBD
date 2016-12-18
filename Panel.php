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
    exit;
}

$BDconf = ["localhost", "root", "root", "escola"];

$MySQLi = new MySQLcrud($BDconf[0],$BDconf[1],$BDconf[2],$BDconf[3]);
$PDO = new PDOcrud($BDconf[0],$BDconf[1],$BDconf[2],$BDconf[3]);

//print_r($MySQLi->getAsignaturaAlum("47931590G"));
print_r($MySQLi->getAsignaturaProf("Matematiques"));

if($_SESSION['type'] == "Profesor"){
   $usuari = $MySQLi->getProfesor($_SESSION['dni']);
   $asig = $MySQLi->getAsignaturaProf($usuari[$asignatura]);
}

if($_SESSION['type'] == "Alumne"){
    $usuari = $PDO->getAlumne($_SESSION['dni']);
    $asig = $MySQLi->getAsignaturaAlum($_SESSION['dni']);
}

?>

<html>
<head>
    <title>Gestio d'una escola.</title> <meta charset="utf-8">

    <!--MDL-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.indigo-pink.min.css">
    <script defer src="https://code.getmdl.io/1.2.1/material.min.js"></script>

    <!--Local Style-->
    <link rel="stylesheet" type="text/css" href="Styles/PanelStyle.css">

</head>

<body>
<div class="mdl-layout mdl-js-layout mdl-color--grey-100">
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <header class="mdl-layout__header">
            <div class="mdl-layout__header-row">
                <!-- Title -->
                <span class="mdl-layout-title"><?php echo $usuari[nom] . " " . $usuari[cognom];?></span>
                <!-- Add spacer, to align navigation to the right -->
                <div class="mdl-layout-spacer"></div>
                <!-- Navigation. We hide it in small screens. -->
                <nav class="mdl-navigation mdl-layout--large-screen-only">
                    <a class="mdl-navigation__link"><?php echo $usuari[asignatura];?></a>
                </nav>
            </div>
        </header>
        <main class="mdl-layout__content">
            <div class="page-content">
                <!--GENERADOR TAULA-->
                <?php
                if($_SESSION['type'] == "Profesor"){
                    ProfTab($asig);
                }
                if($_SESSION['type'] == "Alumne"){
                    AlumnTab($asig);
                }
                ?>
            </div>

<!--            <div class="demo-card-wide mdl-card mdl-shadow--2dp">-->
<!--                <div class="mdl-card__title">-->
<!--                    <h2 class="mdl-card__title-text">Welcome</h2>-->
<!--                </div>-->
<!--                <div class="mdl-card__supporting-text">-->
<!--                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.-->
<!--                    Mauris sagittis pellentesque lacus eleifend lacinia...-->
<!--                </div>-->
<!--                <div class="mdl-card__actions mdl-card--border">-->
<!--                    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">-->
<!--                        Get Started-->
<!--                    </a>-->
<!--                </div>-->
<!--                <div class="mdl-card__menu">-->
<!--                    <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">-->
<!--                        <i class="material-icons">share</i>-->
<!--                    </button>-->
<!--                </div>-->
<!--            </div>-->


        </main>
    </div>
</div>
</body>
</html>


<?php
function ProfTab($asig){ //OSIFUI QUAN S'HAN DE CARREGAR TOTS ELS ALUMNES D'UNA ASIGNATURA
    echo '<table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp">';
            echo '<thead>';
                echo '<tr>';
                    echo '<th>Nom alumne</th>';
                    echo '<th>Alumnes</th>';
                    echo '<th>Nota</th>';
                echo '</tr>';
            echo '</thead>';
        echo '<tbody>';
            $iteracionsMax = count($asig);
            $i = 0;
            while($iteracionsMax > $i){
                echo '<tr>';
                echo '<td>' . $asig[$i][DNI_Alumne] . '</td>';
                echo '<td>' . $asig[$i][nom_asignatura] . '</td>';
                echo '<td>' . $asig[$i][Nota] . '</td>';
                echo '</tr>';
                $i++;
            }
        echo '</tbody>';
    echo '</table>';
}
function AlumnTab($asig){ //OSIFUI QUAN S'HAN DE CARREGAR TOTES LES ASIGNATURES D'UN ALUMNE
    echo '<table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp">';
            echo '<thead>';
                echo '<tr>';
                    echo '<th>DNI alumne</th>';
                    echo '<th>Asignatura</th>';
                    echo '<th>Nota</th>';
                echo '</tr>';
            echo '</thead>';
        echo '<tbody>';
            $iteracionsMax = count($asig);
            $i = 0;
            while($iteracionsMax > $i){
                echo '<tr>';
                echo '<td>' . $asig[$i][DNI_Alumne] . '</td>';
                echo '<td>' . $asig[$i][nom_asignatura] . '</td>';
                echo '<td>' . $asig[$i][Nota] . '</td>';
                echo '</tr>';
            $i++;
            }
        echo '</tbody>';
    echo '</table>';
}

?>