<?php

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

    public function __destruct(){
    }

    function BDconnection(){


    }

    function createBD($dbname){

    }

    function deleteBD($dbname){

    }


    function createTable(){
    }


    function deleteTable(){

    }

}


?>
