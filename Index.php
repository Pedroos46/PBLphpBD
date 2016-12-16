<?php
spl_autoload_register(function ($clase) {
    include $clase . '.php';
});

$BDconf = ["localhost", "root", "root", "escola"];

$Check = new DBChecker($BDconf[0],$BDconf[1],$BDconf[2],$BDconf[3]);
$Controls = new manualControlsBD($BDconf[0],$BDconf[1],$BDconf[2],$BDconf[3]);

// $MySQLi = new MySQLcrud($BDconf[0],$BDconf[1],$BDconf[2],$BDconf[3]);
// $PDO = new PDOcrud($BDconf[0],$BDconf[1],$BDconf[2],$BDconf[3]);
//echo $Controls->BDconnection();//echo $Controls->deleteTables();//echo $Controls->deleteBD();//echo $Controls->createBD();//echo $Controls->createTables();// echo $Check->initCheck();
?>
<html>
  <head>
      <title>Gestio d'una escola.</title> <meta charset="utf-8">

      <!--MDL-->
      <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
      <link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.indigo-pink.min.css">
      <script defer src="https://code.getmdl.io/1.2.1/material.min.js"></script>

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

                  <form  id='login' action="#" method='post' accept-charset='UTF-8'>
                      <div class="mdl-textfield mdl-js-textfield">
                          <input class="mdl-textfield__input" type="text" id="username" autocomplete="off" />
                          <label class="mdl-textfield__label" for="username">Usuari</label>
                      </div>

                      <div class="mdl-textfield mdl-js-textfield">
                          <input class="mdl-textfield__input" type="password" id="userpass" autocomplete="off" />
                          <label class="mdl-textfield__label" for="userpass">Contrasenya</label>
                      </div>
                  </form>

              </div>
              <div class="mdl-card__actions mdl-card--border">
                  <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">Log in</button>
              </div>
          </div>
              <?php
                  $Run = array(1 => $Controls->BDconnection());
                  echo '<ul class="demo-list-item mdl-list">';
                  foreach ($Run as $val ) {
                      echo '<li class="mdl-list__item">';
                      echo '<span class="mdl-list__item-primary-content">';
                      echo $val;
                      echo '</span>';
                      echo '</li>';
                  }
                  echo '</ul>';
              ?>
      </main>
  </div>

  </body>

</html>
