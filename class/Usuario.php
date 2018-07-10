<?php
    class Usuario {

        private $id;
        private $usuario;
        private $email;
        private $password;
        private $pais;
        private $fotoUsuario;

        public function __construct($usuario, $email, $password, $pais) {
            $this->usuario = $usuario;
            $this->setEmail($email);
            $this->setPassword($password);
            $this->pais = $pais;
        }
        private function hashPassword($pass) {
            return password_hash($pass, PASSWORD_BCRYPT);
        }
        private function guardarFotoUsuario($fotoUsuario) {
            $original = $_FILES["fotoUsuario"];
            if($_FILES["fotoUsuario"]["error"] === UPLOAD_ERR_OK){
                $nombreViejo = $original["name"];
                $extension = pathinfo($nombreViejo, PATHINFO_EXTENSION);
                $nombreNuevo = $original["tmp_name"];
                $rutaFinal = "img/usr/";
                $rutaFinal .= uniqid() . "." . $extension;
                //$archivoFinal = dirname(__FILE__) . "/" . $rutaFinal;
                $archivoFinal = dirname(__FILE__, 2) . "/" . $rutaFinal;
                move_uploaded_file($nombreNuevo, $archivoFinal);
                return $rutaFinal;
            }
        }
        public function getUsuario() {
            return $this->usuario;
        }
        public function getEmail() {
            return $this->email;
        }
        public function getPassword() {
            return $this->password;
        }
        /* public function getPasswordConfirm() {
            return $this->passwordConfirm;
        } */
        public function getPais() {
            return $this->pais;
        }
        public function getFotoUsuario() {
            return $this->fotoUsuario;
        }
        public function getId() {
            return $this->id;
        }
        public function setUsuario($usuario) {
            $this->usuario = $usuario;
        }
        public function setEmail($email) {
            $this->email = $email;
        }
        public function setPassword($password) {
            if(substr($password, 0, 6) != "$2y$10") {
                $this->password = $this->hashPassword($password);
            } else {
                $this->password = $password;
            }
        }
        public function setPais($pais) {
            $this->pais = $pais;
        }
        public function setFotoUsuario($fotoUsuario) {
            $this->fotoUsuario = $this->guardarFotoUsuario($fotoUsuario);
        }
        public function setRutaFotoUsuario($ruta) {
            $this->fotoUsuario = $ruta;
        }
        public function setId($id) {
            $this->id = $id;
        }
    }
?>