<?php

class MySQLcrud{
  private $url = '';
  private $user = '';
  private $pass = '';
  private $bd = '';

    function __construct($url, $user, $pass, $bd){
        $this->url=$url;
        $this->user=$user;
        $this->pass=$pass;
        $this->bd=$bd;
    }

    public function __destruct(){
    }

    function BDconnection(){
        $mysqli = new mysqli($this->url, $this->user, $this->pass, $this->bd);
        if ($mysqli->connect_errno) {
            return "Error de conexion "  . $mysqli->connect_errno . "\n";
            exit;
        }
        return "Conexio correcta" . "\n";

    }

    function createBD($dbname){
      $db = new mysqli(url, user, pass);

      $setencia = 'CREATE DATABASE' .$dbname;
      $stmt = $db->prepare($setencia);
      $stmt->execute();
      $stmt->close();
      $db->close();
    }

    function deleteBD($dbname){
      $db = new mysqli(url, user, pass);

      $setencia = 'DROP DATABASE IF EXISTS' .$dbname;
      $stmt = $db->prepare($setencia);
      $stmt->execute();
      $stmt->close();
      $db->close();
    }


    function createTable(){
    }


    function deleteTable(){

    }

}


?>
