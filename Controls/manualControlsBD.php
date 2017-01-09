<?php
/**
 * @author Roger Pedrós Villorbina, Aldair Ñique del Aguila, Alejandro Rodriguez Garcia.
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

    /*
    *Esta funcion realiza la conexion con la BD, indicando con un mensaje si existe la conexion.
    *
    *
    */

    public function BDconnection(){
        $db = new mysqli($this->url, $this->user, $this->pass);
        if ($db->connect_errno) {
            return false;
        }else{
            return "Hi ha conecció amb la BD.";
        }
        $db->close();
    }

    /*
    *Esta funcion crea la base de datos si hay conexion en caso contrario saltara el mensaje.
    */

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

    /*
    *Esta funcion elimina la base de datos si hay conexion en caso contrario saltara el mensaje.
    */

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

    /*
    *Esta funcion crea las tablas con los campos indicados de base la datos indicada  si hay conexion en caso contrario saltara el mensaje.
    */

    function createTables(){
      if($this->BDconnection() == false){
          return "Sense conexió amb la BD";
        exit;
      };

      $db = new mysqli($this->url, $this->user, $this->pass, $this->bd);
      try {
          $db->begin_transaction();
          //"CREATE TABLE alumne (alumID INT(15), alumDNI VARCHAR(10) PRIMARY KEY, alumNom VARCHAR(45), alumCognom VARCHAR(45), alumContra VARCHAR(45))"

          $sentencia = 'CREATE TABLE IF NOT EXISTS profesors(
                          profID INT NOT NULL UNIQUE AUTO_INCREMENT,
                          DNI_Profesor VARCHAR(20) PRIMARY KEY,
                          nom VARCHAR(45) NOT NULL,
                          cognom VARCHAR(45) NOT NULL,
                          asignatura VARCHAR(50),
                          contrasenya VARCHAR(45) NOT NULL);';
          $stmt = $db->prepare($sentencia);
          $stmt->execute();


          $sentencia = 'CREATE TABLE IF NOT EXISTS curs(  
                          nom_curs VARCHAR(45) PRIMARY KEY,
                          profesor VARCHAR(45),
                          FOREIGN KEY (profesor) REFERENCES profesors(DNI_Profesor));';
          $stmt = $db->prepare($sentencia);
          $stmt->execute();


          $sentencia = 'CREATE TABLE IF NOT EXISTS alumne(
                          alumID INT NOT NULL UNIQUE AUTO_INCREMENT,
                          alumDNI VARCHAR(20) PRIMARY KEY,
                          nom VARCHAR(45) NOT NULL,
                          cognom VARCHAR(45) NOT NULL,
                          contrasenya VARCHAR(45) NOT NULL,
                          curs VARCHAR (45),
                          FOREIGN KEY (curs) REFERENCES curs(nom_curs));';
          $stmt = $db->prepare($sentencia);
          $stmt->execute();

          $sentencia = 'CREATE TABLE IF NOT EXISTS asignatures(
                          nom_asignatura VARCHAR(45),
                          DNI_Alumne VARCHAR(20),
                          nota INT(2),
                          curs VARCHAR(45),
                          FOREIGN KEY (DNI_Alumne) REFERENCES alumne(alumDNI),
                          FOREIGN KEY (curs) REFERENCES curs(nom_curs));';
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

    /*
*Esta funcion elimina las tablas con los campos indicados de base la datos indicada  si hay conexion en caso contrario saltara el mensaje.
*/

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
