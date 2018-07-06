<?php
    abstract class DB {

        abstract function guardarUsuario(Usuario $usuario);
        abstract function existeUsuarioR(Usuario $usuario);
        abstract function existeUsuarioL();
        abstract function traerUsuario();
        
        public function guardarFotoUsuario($fotoUsuario) {
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
    }
?>