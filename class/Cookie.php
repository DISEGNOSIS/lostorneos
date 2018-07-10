<?php
    class Cookie {

        public function add($key, $value) {
            setcookie($key, $value, time()+2592000);
        }

        public function get($key) {
            return !empty($_COOKIE[$key]) ? $_COOKIE[$key] : null;
        }

        public function getAll() {
            return $_COOKIE;
        }

        public function remove($key) {
            if(!empty($_COOKIE[$key])) {
                unset($_COOKIE[$key]);
            }
        }

        public function logout() {
            foreach($_COOKIE as $key => $value) {
                setcookie($key, "", -1);
            }
        }
    }
?>