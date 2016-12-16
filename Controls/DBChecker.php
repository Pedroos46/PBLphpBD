<?php
/**
  * @author Roger Pedrós Villorbina
  */
require_once("Controls/manualControlsBD.php");

class DBChecker{
  private $url = '';
  private $user = '';
  private $pass = '';
  private $bd = '';
  public $ErrorCatcher;

    function __construct($url, $user, $pass, $bd){
        $this->url=$url;
        $this->user=$user;
        $this->pass=$pass;
        $this->bd=$bd;

        $this->controls = new manualControlsBD($url, $user, $pass, $bd);
        $this->ErrorCatcher;
    }

    function __destruct(){
    }


    function initCheck(){
        $Run = array("BDconnectionCheck"=> $this->connectionCheck() ,"BDexist"  => $this->BDexist(), "TablesExist"  => $this->TablesExist(), 4 => $this->ErrorCatcher);
      return $Run;
    }

    public function connectionCheck(){
      $mysqli = new mysqli($this->url, $this->user, $this->pass);
      if ($mysqli->connect_errno){
          return "Error de conexio "  . $mysqli->connect_errno . "\n";
          $this->ErrorCatcher = false;
      } else {
          return "Hi ha conecció amb la BD." . "\n";
      }
      $db->close();
    }

    public function BDexist(){
      $mysqli = new mysqli($this->url, $this->user, $this->pass);
      $db_selected = mysqli_select_db($mysqli, $this->bd);
      if (!$db_selected) {
          $this->ErrorCatcher = false;
          $this->controls->createBD();
          return "Base de dades no trobada."   . "\n";
      }else{
          return "La base de dades existeix." . "\n";
      }
      $db->close();
    }

    public function TablesExist(){
      $mysqli = new mysqli($this->url, $this->user, $this->pass, $this->bd);
      $tables = array_column(mysqli_fetch_all($mysqli->query('SHOW TABLES')),0);
      if (count($tables) != 3) {
          $this->ErrorCatcher = false;
          $this->controls->deleteTables();
          $this->controls->createTables();
          return "Problemes amb les taules." . "\n";
      } else{
          return "Hi ha 3 taules creades.";
      }

      $db->close();
    }

}



?>
