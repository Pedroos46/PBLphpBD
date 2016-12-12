<?php
/**
  * @author Roger Pedrós Villorbina
  */
include 'manualControlsBD.php';

class DBChecker{
  private $url = '';
  private $user = '';
  private $pass = '';
  private $bd = '';
  public $ErrorCatcher = '';

    function __construct($url, $user, $pass, $bd){
        $this->url=$url;
        $this->user=$user;
        $this->pass=$pass;
        $this->bd=$bd;

        $this->controls = new manualControlsBD($url, $user, $pass, $bd);
        $this->ErrorCatcher= ''; //TODO ARREGLAR AIXO
    }

    function __destruct(){
    }


    function initCheck(){
        $Run = array("BDconnectionCheck"=> $this->BDconnectionCheck() ,"BDexist"  => $this->BDexist(), "TablesExist"  => $this->TablesExist(), 4 => $this->ErrorCatcher,);
      return $Run;
    }

    public function connectionCheck(){
      $mysqli = new mysqli($this->url, $this->user, $this->pass);
      if ($mysqli->connect_errno){
          return "Error de conexion "  . $mysqli->connect_errno . "\n";
          $this->ErrorCatcher = false;
      } else {
          return "Estat de la conexio"  . $mysqli->connection_status . "\n";
      }
      $db->close();
    }

    public function BDexist(){
      $mysqli = new mysqli($this->url, $this->user, $this->pass);
      $db_selected = mysqli_select_db($mysqli, $this->bd);
      if (!$db_selected) {
          $ErrorCatcher = false;
          $this->controls->createBD();
          $this->controls->createTables();
          return "La base de dades NO existeix, es procedira a crearne una."   . "\n";
      }else{
          return "La base de dades existeix" . "\n";
      }
      $db->close();
    }

    public function TablesExist(){
      $mysqli = new mysqli($this->url, $this->user, $this->pass, $this->bd);
      $tables = array_column(mysqli_fetch_all($mysqli->query('SHOW TABLES')),0);
      if (count($tables) != 3) {
          $ErrorCatcher = false;
          $this->controls->deleteTables();
          $this->controls->createTables();
          return "Hi ha un problema amb alguna taula, es prodecidará a crearles de nou. " . $tables . " " . count($tables) . "\n";
      } else{
          return "Hi ha 3 taules creades";
      }

      $db->close();
    }

}



?>
