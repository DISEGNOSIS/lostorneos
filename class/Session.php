<?php
    class Session {
        
        public function __construct() {
            session_start();
        }

        public function login(Usuario $usuario) {

        }

        public function estaLogueado() {
            if(isset($_SESSION["usuario"]) && !empty($_SESSION["usuario"])) {
                return true;
            }
            return false;
        }

        public function logout() {
            session_destroy();
            foreach($_COOKIE as $key => $value) {
                setcookie($key, "", -1);
            }
        }
    }
?>