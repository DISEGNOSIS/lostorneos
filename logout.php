<?php
    require_once "helpers.php";

    $session->logout();
    $cookie->logout();
    header("Location: index.php?");
?>