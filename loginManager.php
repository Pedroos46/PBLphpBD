<?php

spl_autoload_register(function ($clase) {
    include $clase . '.php';
});

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

    function loginCheck($user, $pass){
        $profesors = $this->MySQLi->getProfesors();
        $alumnes = $this->PDO->getAlumnes();

//        foreach ($prof in $profesors){
//            if ($prof = $user){
//                return true;
//            } else{
//                return false;
//            }
//        }
    }

}