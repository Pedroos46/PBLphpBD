<?php
/**
 * Created by PhpStorm.
 * User: Roger Pedrós Villorbina, Aldair Ñique del Aguila, Alejandro Rodriguez Garcia.
 * Date: 02/01/2017
 * Time: 20:00
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
/*Esta clase permite la conexion con la base de datos mediante la url, el usuario, y el password.*/
    function BDconnection(){
        $db = new mysqli($this->url, $this->user, $this->pass, $this->bd);
        if ($db->connect_errno) {
            return false;
            exit;
        }
        $db->close();
    }

    //CRUD ALUMNE
//Esta funcion recibe parametros "$alumDNI, $alumNom, $alumContrasenya"

//Aqui realiza una conexion con la BD que necesita un log del usuario(alumno, profesor o secretaria con su respectivo password)
// Realiza tambien la insercion de datos, si  todo esta correcto devolvera el mensaje, en caso contrario arrancara el "catch"
// y con el rollback limpiara todos los datos que hemos ingresado hasta la funcion $bd->beginTransaction.
    function fillAlumne($alumDNI, $alumNom, $alumCognom, $alumContrasenya, $alumCurs){
        try {
            $bd = new PDO("mysql:host={$this->url};dbname={$this->bd}" , $this->user ,$this->pass );

            $bd->beginTransaction();

            $sentencia = $bd->prepare("INSERT INTO alumne (alumDNI, nom, cognom, contrasenya, curs) VALUES (:dni, :nom, :cognom, :contrasenya, :curs)");
            $sentencia->bindParam(':dni', $alumDNI);
            $sentencia->bindParam(':nom', $alumNom);
            $sentencia->bindParam(':cognom', $alumCognom);
            $sentencia->bindParam(':contrasenya', $alumContrasenya);
            $sentencia->bindParam(':curs', $alumCurs);
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
//Esta funcion permite  eliminar la informacion del alumno mediante el DNI que funciona como identificador,
// si todo esta correcto devolvera el mensaje, en caso contrario arrancara el "catch"
// y con el rollback limpiara todos los datos que hemos ingresado hasta la funcion $bd->beginTransaction.
    function deleteAlumne($alumDNI){
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

// Esta funcion permite modificar informacion del alumno mediante su dni que es el identificador.
// si todo esta correcto devolvera el mensaje, en caso contrario arrancara el "catch"
// y con el rollback limpiara todos los datos que hemos ingresado hasta la funcion $bd->beginTransaction.
    function updateAlumne($alumDNI, $alumNom, $alumCognom, $alumContrasenya, $alumCurs){

        try {
            $bd = new PDO("mysql:host={$this->url};dbname={$this->bd}" , $this->user ,$this->pass );

            $bd->beginTransaction();

            $sentencia = $bd->prepare("UPDATE alumne SET nom = :nom, cognom = :cognom, contrasenya = :contrasenya, curs = :curs WHERE alumDNI = :dni");
            $sentencia->bindParam(':dni', $alumDNI);
            $sentencia->bindParam(':nom', $alumNom);
            $sentencia->bindParam(':cognom', $alumCognom);
            $sentencia->bindParam(':contrasenya', $alumContrasenya);
            $sentencia->bindParam(':curs', $alumCurs);
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
// Esta funcion nos muestra toda la informacio del alumno que hemos indicado mediante el DNI que nos sirve como identificador.
// si todo esta correcto devolvera la información , en caso contrario arrancara el "catch"
// y con el rollback limpiara todos los datos que hemos ingresado hasta la funcion $bd->beginTransaction.
    function getAlumne($alumDNI){
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

    function getTotsAlumne(){
        try {
            $bd = new PDO("mysql:host={$this->url};dbname={$this->bd}" , $this->user ,$this->pass );

            $bd->beginTransaction();

            $sentencia = $bd->prepare("SELECT * FROM alumne");
            $sentencia->execute();
            $resposta=$sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resposta;

            $bd->commit();

            $sentencia = null;
            $bd = null;
        } catch ( PDOException $e ) {
            return "¡Error!: " . $e -> getMessage ();
            $bd->rollBack();

        }
    }


    //ORDERBYS

    function getTotsAlumneOrderbyname(){
        try {
            $bd = new PDO("mysql:host={$this->url};dbname={$this->bd}" , $this->user ,$this->pass );

            $bd->beginTransaction();

            $sentencia = $bd->prepare("SELECT * FROM alumne ORDER BY nom");
            $sentencia->execute();
            $resposta=$sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resposta;

            $bd->commit();

            $sentencia = null;
            $bd = null;
        } catch ( PDOException $e ) {
            return "¡Error!: " . $e -> getMessage ();
            $bd->rollBack();

        }
    }

    function getTotsAlumneOrderbyCurs(){
        try {
            $bd = new PDO("mysql:host={$this->url};dbname={$this->bd}" , $this->user ,$this->pass );

            $bd->beginTransaction();

            $sentencia = $bd->prepare("SELECT * FROM alumne ORDER BY curs");
            $sentencia->execute();
            $resposta=$sentencia->fetchAll(PDO::FETCH_ASSOC);
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
