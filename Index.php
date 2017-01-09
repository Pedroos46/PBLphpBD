<?php
error_reporting(E_ALL ^ E_NOTICE);

require_once("Controls/DBChecker.php");
require_once("Controls/manualControlsBD.php");
require_once("Logica/loginManager.php");
require_once("Crud/MySQLcrud.php");
require_once("Crud/PDOcrud.php");
require_once("ImageMagick/graphs.php");

session_start();
$_SESSION['loged'] = false;

$BDconf = ["localhost", "root", "root", "escola"];

//$Check = new DBChecker($BDconf[0],$BDconf[1],$BDconf[2],$BDconf[3]);
$Controls = new manualControlsBD($BDconf[0],$BDconf[1],$BDconf[2],$BDconf[3]);
$Login = new loginManager($BDconf[0],$BDconf[1],$BDconf[2],$BDconf[3]);

$MySQLi = new MySQLcrud($BDconf[0],$BDconf[1],$BDconf[2],$BDconf[3]);
$PDO = new PDOcrud($BDconf[0],$BDconf[1],$BDconf[2],$BDconf[3]);


$Imagick = new ImageMagick($BDconf[0],$BDconf[1],$BDconf[2],$BDconf[3]);

//$PDO->fillAlumne("47931590G","Roger","Pedrós","1234");
//$PDO->fillAlumne("47931591G","Robert","Montoro","1234");

//$MySQLi->fillAsignatura("Matematiques","47931590G", 7);
//$MySQLi->fillAsignatura("Matematiques","47931591G", 2);
//$MySQLi->fillAsignatura("Ciencies","47931590G", 7);
//$MySQLi->fillAsignatura("Ciencies","47931591G", 10);
//$MySQLi->fillProfesors("47931594G","Sergi","Grau","Matematiques","1234");
//$MySQLi->fillProfesors("47931595G","Jordi","Binefa","Llengua","1234");
//$MySQLi->fillProfesors("47931596G","Hector","Lopez","Ciencies","1234");


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
      <link rel="stylesheet" type="text/css" href="Styles/IndexStyle.css">

  </head>

  <body>
  <div class="mdl-layout mdl-js-layout mdl-color--grey-100">
      <main class="mdl-layout__content">
          <div class="mdl-card mdl-shadow--6dp">
              <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
                  <h2 class="mdl-card__title-text">Login</h2>
              </div>
              <div class="mdl-card__supporting-text">

                  <form  id='login' action="Index.php" method='post' accept-charset='UTF-8'>
                      <div class="mdl-textfield mdl-js-textfield">
                          <input class="mdl-textfield__input" type="text" name='username' id="username" autocomplete="off" />
                          <label class="mdl-textfield__label" for="username">Usuari</label>
                      </div>

                      <div class="mdl-textfield mdl-js-textfield">
                          <input class="mdl-textfield__input" type="password" name='userpass' id="userpass" autocomplete="off" />
                          <label class="mdl-textfield__label" for="userpass">Contrasenya</label>
                      </div>

                      <div class="mdl-card__actions mdl-card--border">
                          <button type='submit' class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" name='Submit'>
                              Log in
                          </button>
                      </div>
                  </form>
                  <?php
                      if(isset($_POST['username']) && isset($_POST['userpass']) ){
                          echo '<div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate"></div>';
                          if($Login->loginCheck($_POST['username'],$_POST['userpass']) == true){
                              echo "Login correcte";
                          }else{
                              echo "Error d'usuari o contrasenya";
                          }
                      }
                  ?>
              </div>
          </div>
      </main>
  </div>

  </body>

</html>
