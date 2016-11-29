<!DOCTYPE php>

<?php
 spl_autoload_register(function ($clase) {
    include $clase . '.php';
 });

$MySQLi = new MySQLcrud('localhost','root','root','test');
$PDO = new PDOcrud('localhost','root','root','test');


$MySQLi->BDconnection();

?>

<html>
  <head>
    <title>Gestio d'una escola.</title> <meta charset="utf-8">

  </head>

  <body>

  </body>

</html>
