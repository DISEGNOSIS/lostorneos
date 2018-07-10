<?php
	spl_autoload_register(function($clase) {
		if(file_exists("class/$clase.php")) {
			require_once "class/$clase.php";
		} 
	});
	$GLOBALS["mensaje"] = "";
	
	$session = new Session();
	$cookie = new Cookie();
	if(!is_null($cookie->get("usuario"))) {
		$session->add("usuario", $cookie->get("usuario"));
		$session->add("fotoUsuario", $cookie->get("fotoUsuario"));
	}
	try {
		$db = new Mysql();
	} catch(PDOException $e) {
		$GLOBALS["mensaje"] =  $e->getMessage();
	}
?>