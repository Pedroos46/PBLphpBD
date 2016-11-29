<?php

class test{
  private $name = '';

    public function __construct($name){
        $this->name=$name;
    }

    public function __destruct(){
    }

    function testname(){
        echo $this->name;
    }
  }

?>
