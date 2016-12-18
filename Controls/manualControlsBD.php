<?php
/**
* @author Roger Pedrós Villorbina
*/

class manualControlsBD{
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

    public function BDconnection(){
        $db = new mysqli($this->url, $this->user, $this->pass);
        if ($db->connect_errno) {
            return false;
        }else{
            return "Hi ha conecció amb la BD.";
        }
        $db->close();
    }

    function createBD(){
      if($this->BDconnection() == false){
        return "Sense conexió amb la BD";
        exit;
      }

      $db = new mysqli($this->url, $this->user, $this->pass);
      try {
          $db->begin_transaction();

          $setencia = 'CREATE DATABASE escola';
          $stmt = $db->prepare($setencia);

          $stmt->execute();
          $stmt->close();

          $db->commit();
          return "S'ha creat la BD correctament";

          $db->close();

      } catch (Exception $e) {
            $db->rollback();
        }
    }

    function deleteBD(){
      if($this->BDconnection() == false){
        return "Sense conexió amb la BD";
        exit;
      }

      $db = new mysqli($this->url, $this->user, $this->pass);
      try {
          $db->begin_transaction();

          $setencia = 'DROP DATABASE escola';
          $stmt = $db->prepare($setencia);

          $stmt->execute();
          $stmt->close();

          $db->commit();
          return "S'ha eliminat la BD correctament";

          $db->close();

      } catch (Exception $e) {
          $db->rollback();
      }
    }

    function createTables(){
      if($this->BDconnection() == false){
          return "Sense conexió amb la BD";
        exit;
      };

      $db = new mysqli($this->url, $this->user, $this->pass, $this->bd);
      try {
          $db->begin_transaction();
          //"CREATE TABLE alumne (alumID INT(15), alumDNI VARCHAR(10) PRIMARY KEY, alumNom VARCHAR(45), alumCognom VARCHAR(45), alumContra VARCHAR(45))"

          $sentencia = 'CREATE TABLE IF NOT EXISTS alumne(
                          alumID INT NOT NULL UNIQUE AUTO_INCREMENT,
                          alumDNI VARCHAR(20) PRIMARY KEY,
                          nom VARCHAR(45) NOT NULL,
                          cognom VARCHAR(45) NOT NULL,
                          contrasenya VARCHAR(45) NOT NULL);';
          $stmt = $db->prepare($sentencia);
          $stmt->execute();


          $sentencia = 'CREATE TABLE IF NOT EXISTS asignatures(  
                          nom_asignatura VARCHAR(45),
                          DNI_Alumne VARCHAR(20),
                          Nota INT,
                          FOREIGN KEY (DNI_Alumne) REFERENCES alumne(alumDNI));';
          $stmt = $db->prepare($sentencia);
          $stmt->execute();

          $sentencia = 'CREATE TABLE IF NOT EXISTS profesors(
                          profID INT NOT NULL UNIQUE AUTO_INCREMENT,
                          DNI_Profesor VARCHAR(20) PRIMARY KEY,
                          nom VARCHAR(45) NOT NULL,
                          cognom VARCHAR(45) NOT NULL,
                          asignatura VARCHAR(50) NOT NULL,
                          contrasenya VARCHAR(45) NOT NULL);';
          $stmt = $db->prepare($sentencia);
          $stmt->execute();

          $stmt->close();
          $db->commit();
          return "S'ha creat la taula correctament";

          $db->close();

      } catch (Exception $e) {
          $db->rollback();
      }
    }

    function deleteTables(){
      if($this->BDconnection() == false){
        return "Sense conexió amb la BD";
        exit;
      }

      $db = new mysqli($this->url, $this->user, $this->pass, $this->bd);
      try {
          $db->begin_transaction();

          $setencia = 'DROP TABLE profesors';
          $stmt = $db->prepare($setencia);
          $stmt->execute();

          $setencia = 'DROP TABLE asignatures';
          $stmt = $db->prepare($setencia);
          $stmt->execute();

          $setencia = 'DROP TABLE alumne';
          $stmt = $db->prepare($setencia);
          $stmt->execute();

          $stmt->close();

          $db->commit();
          return "S'ha eliminat la taula correctament";

          $db->close();

      } catch (Exception $e) {
          $db->rollback();
      }
    }

}


?>
