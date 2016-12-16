<?php
/**
 * Created by PhpStorm.
 * User: Roger Pedrós Villorbina
 * Date: 16/12/2016
 * Time: 3:38
 */
error_reporting(E_ALL ^ E_NOTICE);
require_once("Crud/MySQLcrud.php");
require_once("Crud/PDOcrud.php");

$BDconf = ["localhost", "root", "root", "escola"];

$MySQLi = new MySQLcrud($BDconf[0],$BDconf[1],$BDconf[2],$BDconf[3]);
$PDO = new PDOcrud($BDconf[0],$BDconf[1],$BDconf[2],$BDconf[3]);


$Profesor = $MySQLi->getProfesor("47931591G");
?>

<html>
<head>
    <title>Gestio d'una escola.</title> <meta charset="utf-8">

    <!--MDL-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.indigo-pink.min.css">
    <script defer src="https://code.getmdl.io/1.2.1/material.min.js"></script>

</head>

<body>
<div class="mdl-layout mdl-js-layout mdl-color--grey-100">
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <header class="mdl-layout__header">
            <div class="mdl-layout__header-row">
                <!-- Title -->
                <span class="mdl-layout-title"><?php echo $Profesor[nom] . " " . $Profesor[cognom];?></span>
                <!-- Add spacer, to align navigation to the right -->
                <div class="mdl-layout-spacer"></div>
                <!-- Navigation. We hide it in small screens. -->
                <nav class="mdl-navigation mdl-layout--large-screen-only">
                    <a class="mdl-navigation__link"><?php echo $Profesor[asignatura];?></a>
                </nav>
            </div>
        </header>
        <main class="mdl-layout__content">
            <div class="page-content">
                <!--GENERADOR TAULA-->
                <?php
                    echo '<table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp">';
                        echo '<thead>';
                            echo '<tr>';
                                echo '<th class="mdl-data-table__cell--non-numeric">Nom alumne</th>';
                                echo '<th>Asignatura</th>';
                                echo '<th>Nota</th>';
                            echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                        $i = 5;
                        while($i > 0){
                            echo '<tr>';
                                echo '<td class="mdl-data-table__cell--non-numeric">Acrylic (Transparent)</td>';
                                echo '<td>25</td>';
                                echo '<td>$2.90</td>';
                            echo '</tr>';
                            $i--;
                        }
                        echo '</tbody>';
                    echo '</table>'
                ?>
            </div>
        </main>
    </div>
</div>
</body>
</html>

