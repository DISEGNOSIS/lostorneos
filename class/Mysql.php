<?php
    class Mysql extends DB {

        private $conexion;

        public function __construct() {
            $dsn = "mysql:host=localhost;dbname=lostorne_os;charset=utf8mb4";
            $user = "root";
            $pass = "";
            $this->conexion = new PDO($dsn, $user, $pass);
        }

        public function guardarUsuario(Usuario $usuario) {
            $sql = "INSERT INTO usuarios (usuario, email, pass, pais, fotoUsuario) VALUES (:usuario, :email, :pass, :pais, :fotoUsuario)";
            $query = $this->conexion->prepare($sql);
            $query->bindParam(":usuario", $usuario->getUsuario());
            $query->bindParam(":email", $usuario->getEmail());
            $query->bindParam(":pass", $usuario->getPassword());
            $query->bindParam(":pais", $usuario->getPais());
            $query->bindParam(":fotoUsuario", $usuario->getFotoUsuario());

            $query->execute();
        }

        public function existeUsuarioR(Usuario $usuario) {
            $existeUsuario=[];
            $sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
            $query = $this->conexion->prepare($sql);
            //$query->bindParam(":usuario", $usuario);
            $query->execute();
            $usuarios = $query->fetch(PDO::FETCH_ASSOC);
            var_dump($usuarios);
            exit;
            foreach($usuarios as $usuario){
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
        }

        public function traerUsuario() {
            
        }
        
    }
?>