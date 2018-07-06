<?php
    session_destroy();
    setcookie("usuario", $usuario["usuario"], time()-1);
    setcookie("fotoUsuario", $usuario["fotoUsuario"], time()-1);
    header("Location: index.php?");
?>