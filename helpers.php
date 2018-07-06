<?php
    spl_autoload_register(function($clase) {
      if(file_exists("class/$clase.php")) {
        require_once "class/$clase.php";
      } 
    });
    
    $session = new Session();
    try {
      $db = new Mysql();
    } catch(PDOException $e) {
      echo $e->getMessage();
    }
?>