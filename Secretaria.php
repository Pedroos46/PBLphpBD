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

$Check = new DBChecker($BDconf[0],$BDconf[1],$BDconf[2],$BDconf[3]);

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

}
