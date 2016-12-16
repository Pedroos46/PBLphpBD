<?php

require_once("Crud/MySQLcrud.php");
require_once("Crud/PDOcrud.php");
/**
 * Created by PhpStorm.
 * User: Roger Pedrós Villorbina
 * Date: 11/12/2016
 * Time: 23:31
 */

class loginManager{
    function __construct($url, $user, $pass, $bd){
        $this->MySQLi = new MySQLcrud($url, $user, $pass, $bd);
        $this->PDO = new PDOcrud($url, $user, $pass, $bd);
    }

    function __destruct(){
    }

    function loginCheck($userDNI, $pass){
      $profesor = $this->MySQLi->getProfesor($userDNI);
      $alumne = $this->PDO->getAlumne($userDNI);

      if (empty($userDNI) || empty($pass)){
          return false;
          exit;
      }

      if(($alumne[contrasenya] || $profesor[contrasenya]) == $pass){
          return true;
      }else{
          return false;
      }
    }

}