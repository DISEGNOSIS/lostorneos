<?php
    error_reporting(E_ALL);
	ini_set('display_errors', '1');

    spl_autoload_register(function($clase) {
        if(file_exists("$clase.php")) {
          require_once "$clase.php";
        } 
    });
      
      try {
        $db = new Mysql();
      } catch(PDOException $e) {
        echo $e->getMessage();
      }
    
    class Migracion {

        public function crearTablas($db) {
            $sql="CREATE TABLE IF NOT EXISTS usuarios (
                id INT(6) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                usuario VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                pass VARCHAR(255) NOT NULL,
                pais VARCHAR(255) NOT NULL,
                fotoUsuario VARCHAR(255) NOT NULL
            )";
            $query = $db->query($sql);
            if($query) {
                echo "Tabla Usuarios creada con éxito";
            } else {
                echo "Error al crear la tabla Usuarios: " . $db->error;
            }
        }

        public function jsonToMysql($db) {
            $usuariosJSON=file_get_contents("../usuarios.json");
            $usuarios=json_decode($usuariosJSON,true);
            $usuarios=$usuarios["usuarios"];
            $usuariosArray=[];
            $i=0;
            foreach($usuarios as $usuario) {
                $usuariosArray[]=json_decode($usuario,true);
                $nuevoUsuario = new Usuario($usuariosArray[$i]["usuario"], $usuariosArray[$i]["email"], $usuariosArray[$i]["password"], $usuariosArray[$i]["pais"], $usuariosArray[$i]["fotoUsuario"]);
                $existeUsuario = $db->existeUsuarioR($nuevoUsuario);
                var_dump($existeUsuario);
                exit;
                if(empty($existeUsuario)) {
                    var_dump($nuevoUsuario);
                    exit;
                    $db->guardarUsuario($nuevoUsuario);
                }
                $i++;
            }
            
            
        }
    }

    $migracion = new Migracion();
    //$migracion->crearTablas($db);
	$migracion->jsonToMysql($db);
?>