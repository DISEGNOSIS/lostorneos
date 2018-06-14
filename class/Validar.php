<?php
    class Validar {
        private $errorRegistro = [];
        private $errorLogin = [];

        private function registro() {
            if(isset($_POST["usuario"]) || isset($_POST["email"]) || isset($_POST["password"]) || isset($_POST["passwordConfirm"]) || ($_FILES["fotoUsuario"]["error"] === UPLOAD_ERR_NO_FILE)) {
                if(empty($_POST["usuario"])) {
                    $this->errorRegistro["usuario"] = "Completá el Usuario";
                }
                if(empty($_POST["email"])) {
                    $this->errorRegistro["email"] = "Completá el e-Mail";
                } elseif(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                    $this->errorRegistro["email"] = "Por favor ingresá un e-Mail válido";
                }
                if(empty($_POST["password"])) {
                    $this->errorRegistro["password"] = "Completá la Contraseña";
                }
                if(empty($_POST["passwordConfirm"])) {
                    $this->errorRegistro["passwordConfirm"] = "Completá la Confirmación de Contraseña";
                }
                if($_POST["password"] != $_POST["passwordConfirm"]) {
                    $this->errorRegistro["passwordConfirm"] = "Las Contraseñas NO coiciden";
                }
                if(($_FILES["fotoUsuario"]["error"] === UPLOAD_ERR_NO_FILE)) {
                    $this->errorRegistro["fotoUsuario"] = "Debés subir una Imagen de Perfil";
                }
            } 
        }
        private function login() {
            if(isset($_POST["usuario"]) || isset($_POST["password"])) {
                if(empty($_POST["usuario"])) {
                    $this->errorLogin["usuario"] = "Ingresá el Usuario";
                }
                if(empty($_POST["password"])) {
                    $this->errorLogin["password"] = "Ingresá la Contraseña";
                }
            } 
        }
        public function getErrorRegistro() {
            $this->registro();
            return $this->errorRegistro;
        }
        public function getErrorLogin() {
            $this->login();
            return $this->errorLogin;
        }

    }
?>