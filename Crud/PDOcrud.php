<?php
/**
 * Created by PhpStorm.
 * User: Roger Pedrós Villorbina
 * Date: 12/12/2016
 * Time: 23:31
 */
class PDOcrud{
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

    function __destruct(){}

    function BDconnection(){
        $db = new mysqli($this->url, $this->user, $this->pass, $this->bd);
        if ($db->connect_errno) {
            return false;
            exit;
        }
        $db->close();
    }

    //CRUD ALUMNE

    function fillAlumne($alumDNI, $alumNom, $alumCognom, $alumContrasenya){
//        if($this->BDconnection() == false){
//            echo "Sense conexió amb la BD.";
//            exit;
//        }
        try {
            $bd = new PDO("mysql:host={$this->url};dbname={$this->bd}" , $this->user ,$this->pass );

            $bd->beginTransaction();

            $sentencia = $bd->prepare("INSERT INTO alumne (alumDNI, nom, cognom, contrasenya) VALUES (:dni, :nom, :cognom, :contrasenya)");
            $sentencia->bindParam(':dni', $alumDNI);
            $sentencia->bindParam(':nom', $alumNom);
            $sentencia->bindParam(':cognom', $alumCognom);
            $sentencia->bindParam(':contrasenya', $alumContrasenya);
            $sentencia->execute();

            $bd->commit();
            return "S'ha insertat la informacio correctament";

            $sentencia = null;
            $bd = null;
        } catch ( PDOException $e ) {
            return "¡Error!: " . $e -> getMessage ();
            $bd->rollBack();

        }
    }

    function deleteAlumne($alumDNI){
//        if($this->BDconnection() == false){
//            echo "Sense conexió amb la BD";
//            exit;
//        }
        try {
            $bd = new PDO("mysql:host={$this->url};dbname={$this->bd}" , $this->user ,$this->pass );

            $bd->beginTransaction();

            $sentencia = $bd->prepare("DELETE FROM alumne WHERE alumDNI = :dni ");
            $sentencia->bindParam(':dni', $alumDNI);
            $sentencia->execute();

            $bd->commit();
            return "S'ha eliminat la informacio correctament";

            $sentencia = null;
            $bd = null;
        } catch ( PDOException $e ) {
            return "¡Error!: " . $e -> getMessage ();
            $bd->rollBack();

        }
    }

    function updateAlumne($alumDNI, $alumNom, $alumCognom, $alumContrasenya){
//        if ($this->BDconnection() == false) {
//            echo "Sense conexió amb la BD";
//            exit;
//        }
        try {
            $bd = new PDO("mysql:host={$this->url};dbname={$this->bd}" , $this->user ,$this->pass );

            $bd->beginTransaction();

            $sentencia = $bd->prepare("UPDATE alumne SET :nom, :cognom, :contrasenya WHERE alumDNI = :dni");
            $sentencia->bindParam(':dni', $alumDNI);
            $sentencia->bindParam(':nom', $alumNom);
            $sentencia->bindParam(':cognom', $alumCognom);
            $sentencia->bindParam(':contrasenya', $alumContrasenya);
            $sentencia->execute();

            $bd->commit();
            return "S'ha actualitzat la informacio correctament";

            $sentencia = null;
            $bd = null;
        } catch ( PDOException $e ) {
            return "¡Error!: " . $e -> getMessage ();
            $bd->rollBack();

        }
    }

    function getAlumne($alumDNI){
//        if ($this->BDconnection() == false) {
//            echo "Sense conexió amb la BD";
//            exit;
//        }
        try {
            $bd = new PDO("mysql:host={$this->url};dbname={$this->bd}" , $this->user ,$this->pass );

            $bd->beginTransaction();

            $sentencia = $bd->prepare("SELECT * FROM alumne WHERE alumDNI = :dni");
            $sentencia->bindParam(':dni', $alumDNI);
            $sentencia->execute();
            $resposta=$sentencia->fetch(PDO::FETCH_ASSOC);
            return $resposta;

            $bd->commit();

            $sentencia = null;
            $bd = null;
        } catch ( PDOException $e ) {
            return "¡Error!: " . $e -> getMessage ();
            $bd->rollBack();

        }
    }
}

?>
