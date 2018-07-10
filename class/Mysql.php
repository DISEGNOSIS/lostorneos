<?php
    class Mysql extends DB {

        private $conexion;

        public function __construct() {
            $dsn = "mysql:host=localhost;dbname=lostorneos;charset=utf8mb4";
            $user = "root";
            $pass = "";
            $this->conexion = new PDO($dsn, $user, $pass);
        }

        public function guardarUsuario(Usuario $usuario) {
            $sql = "INSERT INTO usuarios (usuario, email, pass, pais, foto_usuario) VALUES (:usuario, :email, :pass, :pais, :foto_usuario)";
            $query = $this->conexion->prepare($sql);
            $query->bindValue(":usuario", $usuario->getUsuario());
            $query->bindValue(":email", $usuario->getEmail());
            $query->bindValue(":pass", $usuario->getPassword());
            $query->bindValue(":pais", $usuario->getPais());
            $query->bindValue(":foto_usuario", $usuario->getFotoUsuario());

            $query->execute();
        }

        public function editarUsuario(Usuario $usuario) {
            $sql = 'UPDATE usuarios SET usuario = :usuario, email = :email, pass = :pass, pais = :pais, foto_usuario = :foto_usuario WHERE id = :id';
        
            $query = $this->conexion->prepare($sql);
            $query->bindValue(":id", $usuario->getId());
            $query->bindValue(":usuario", $usuario->getUsuario());
            $query->bindValue(":email", $usuario->getEmail());
            $query->bindValue(":pass", $usuario->getPassword());
            $query->bindValue(":pais", $usuario->getPais());
            $query->bindValue(":foto_usuario", $usuario->getFotoUsuario());
            $query->execute();
          }

        public function existeUsuarioR(Usuario $usuario) {
            $existeUsuario=[];
            $sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
            $query = $this->conexion->prepare($sql);
            $query->bindValue(":usuario", $usuario->getUsuario());
            $query->execute();
            $usuarioTraido = $query->fetch(PDO::FETCH_ASSOC);
            if($usuarioTraido != false) {
                foreach($usuarioTraido as $value){
                    if($value==$usuario->getUsuario()) {
                        $existeUsuario["usuario"] = "Ya está registrado ese Usuario por favor elegí otro";
                    }
                    if($value==$usuario->getEmail()) {
                        $existeUsuario["email"] = "Ya está registrado ese e-Mail por favor elegí otro";
                    }
                }
            }
            return $existeUsuario;
        }

        public function existeUsuarioL() {
            $sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
            $query = $this->conexion->prepare($sql);
            $query->bindValue(":usuario", $_POST["usuario"]);
            $query->execute();
            $usuario = $query->fetch(PDO::FETCH_ASSOC);
            return $usuario;
        }

        public function existeUsuarioE(Usuario $usuario) {
            $existeUsuario=[];
            $sql = "SELECT * FROM usuarios";
            $query = $this->conexion->prepare($sql);
            $query->execute();
            $usuarios = $query->fetchAll(PDO::FETCH_OBJ);
            if($usuarios != false) {
                foreach($usuarios as $value){
                    if($value->id != $usuario->getId()) {
                        if($value->usuario == $usuario->getUsuario()) {
                            $existeUsuario["usuario"] = "Ya está registrado ese Usuario por favor elegí otro";
                        }
                        if($value->email == $usuario->getEmail()) {
                            $existeUsuario["email"] = "Ya está registrado ese e-Mail por favor elegí otro";
                        }
                    }
                }
            }
            return $existeUsuario;
        }

        public function traerUsuario() {
            $sql = "SELECT * FROM usuarios";
            $query = $this->conexion->prepare($sql);
            $query->execute();
            $usuarios = $query->fetchAll(PDO::FETCH_OBJ);
            if($usuarios != false) {
                foreach($usuarios as $usuario) {
                    if($usuario->usuario == $_SESSION["usuario"]) {
                        break;
                    }
                }
            }
            return $usuario;
        }

        public function comprobarContraseña(Usuario $usuario) {
            $autorizado = false;
            if(password_verify($_POST["password"], $usuario->getPassword())){
                $autorizado = true;
            }
            return $autorizado;
        }

        public function getConexion() {
            return $this->conexion;
        }
        
    }
?>