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

          $sentencia = 'CREATE TABLE IF NOT EXISTS alumne(
                          alumID INT(15) NOT NULL AUTO_INCREMENT,
                          DNI VARCHAR(20) NOT NULL, 
                          cognom VARCHAR(45),
                          curs VARCHAR(50),
                          contrasenya VARCHAR(45),
                          PRIMARY KEY (DNI);';
          $stmt = $db->prepare($sentencia);
          $stmt->execute();


          $sentencia = 'CREATE TABLE IF NOT EXISTS asignatures(
                          nom_asignatura VARCHAR(45) NOT NULL,
                          DNI_Alumne VARCHAR(20),
                          Nota INT,
                          PRIMARY KEY (nom_asignatura),
                          FOREIGN KEY (DNI_Alumne) REFERENCES alumne(DNI)';
          $stmt = $db->prepare($sentencia);
          $stmt->execute();

          $sentencia = 'CREATE TABLE IF NOT EXISTs profesors(
                          profID INT NOT NULL AUTO_INCREMENT,
                          DNI_Profesor VARCHAR(20) NOT NULL,
                          nom VARCHAR(45),
                          cognom VARCHAR(45),
                          asignatura VARCHAR(50),
                          contrasenya VARCHAR(45),
                          PRIMARY KEY (DNI),
                          FOREIGN KEY (asignatura) REFERENCES assignatura(nom_asignatura)';
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

          $setencia = 'DROP TABLE IF NOT EXIST alumne';
          $stmt = $db->prepare($setencia);
          $stmt->execute();

          $setencia = 'DROP TABLE IF NOT EXIST assignatures';
          $stmt = $db->prepare($setencia);
          $stmt->execute();

          $setencia = 'DROP TABLE IF NOT EXIST profesors';
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
