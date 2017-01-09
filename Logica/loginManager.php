<?php

require_once("Crud/MySQLcrud.php");
require_once("Crud/PDOcrud.php");
/**
 * Created by PhpStorm.
 * User: Roger Pedrós Villorbina, Aldair Ñique del Aguila, Alejandro Rodriguez Garcia.
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

    //Funcio que s'encarrega d'administrar el sistema de login
    function loginCheck($userDNI, $pass){
        session_start();

        print_r($profesor = $this->MySQLi->getProfesor($userDNI));
        print_r($alumne = $this->PDO->getAlumne($userDNI));


        if ($userDNI == "secretaria"){
            $_SESSION['loged'] = true; $_SESSION['dni']="secretaria";
            $_SESSION['type'] = "secretaria";
            header("Location: http://localhost/daw2/php/PBLphpBD/secretaria.php");
            exit;
        }

        if (empty($userDNI) || empty($pass)){
            return false;
            exit;
        }

        if(count($profesor) > 2){
            $_SESSION['type'] = "Profesor";
        }
        if(count($alumne) > 2){
            $_SESSION['type'] = "Alumne";
        }

        if(($alumne[contrasenya] || $profesor[contrasenya]) == $pass){
            $_SESSION['loged'] = true; $_SESSION['dni']=$userDNI;
            print_r("true");
            return true;
        }else{
            $_SESSION['loged'] = false;
            return false;
        }
    }

}