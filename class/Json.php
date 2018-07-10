<?php
    class Json {
        const ARCHIVO = "usuarios.json";

        public function guardarUsuario(Usuario $usuario) {
            $usuarioFinal = [];
            $usuarioFinal["usuario"] = $usuario->getUsuario();
            $usuarioFinal["email"] = $usuario->getEmail();
            $usuarioFinal["password"] = $usuario->getPassword();
            $usuarioFinal["pais"] = $usuario->getPais();
            $usuarioFinal["fotoUsuario"] = $usuario->getFotoUsuario();
            $datosJSON=json_encode($usuarioFinal);
            $usuariosJSON=file_get_contents(self::ARCHIVO);
            $usuarios=json_decode($usuariosJSON,true);
            $usuarios["usuarios"][]=$datosJSON;
            $usuariosJSON=json_encode($usuarios);
            file_put_contents(self::ARCHIVO,$usuariosJSON);
        }

        public function existeUsuarioR(Usuario $usuario) {
            $existeUsuario=[];
            $usuariosJSON=file_get_contents(self::ARCHIVO);
            $usuarios=json_decode($usuariosJSON,true);
            $usuarios=$usuarios["usuarios"];
            for($i=0;$i<count($usuarios);$i++){
              $usuario=json_decode($usuarios[$i],true);
              if($_POST["usuario"]==$usuario["usuario"]){
                $existeUsuario["usuario"]="Ya está registrado ese Usuario por favor elegí otro";
              }
              if($_POST["email"]==$usuario["email"]){
                $existeUsuario["email"]="Ya está registrado ese e-Mail por favor elegí otro";
              }
            }
            return $existeUsuario;
        }

        public function existeUsuarioL() {
            $usuariosJSON=file_get_contents(self::ARCHIVO);
            $usuarios=json_decode($usuariosJSON,true);
            $usuarios=$usuarios["usuarios"];
            $error=0;
            for($i=0;$i<count($usuarios);$i++){
                $usuario=json_decode($usuarios[$i],true);
                if($usuario["usuario"]==$_POST["usuario"]){
                    if(password_verify($_POST["password"], $usuario["password"])){
                        if(isset($_POST["recordarme"])) {
                            setcookie("usuario", $usuario["usuario"], time()+2592000);
                            setcookie("fotoUsuario", $usuario["fotoUsuario"], time()+2592000);
                        }
                        session_start();
                        $_SESSION["usuario"] = $usuario["usuario"];
                        $_SESSION["fotoUsuario"] = $usuario["fotoUsuario"];
                        header("Location: index.php?");
                    }
                }
                if(($usuario["usuario"]!=$_POST["usuario"]) || (!password_verify($_POST["password"], $usuario["password"]))){
                    $error++;
                }
            }
            if($error>=count($usuarios)){
                return "Verificá los datos ingresados!";
            }
        }
        
        public function traerUsuario() {
            $usuariosJSON=file_get_contents(self::ARCHIVO);
            $usuarios=json_decode($usuariosJSON,true);
            $usuarios=$usuarios["usuarios"];
            $error=0;
            for($i=0;$i<count($usuarios);$i++){
                $usuario=json_decode($usuarios[$i],true);
                if($usuario["usuario"]==$_SESSION["usuario"]){
                    break;
                }
            }
            return $usuario;
        }

    }
?>