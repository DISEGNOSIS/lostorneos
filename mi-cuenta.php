<?php

    require_once "class/Validar.php";
    require_once "class/Json.php";
    $json = new Json();
    $datosUsuario = $json->traerUsuario();
    $usuario = $datosUsuario["usuario"];
    $email = $datosUsuario["email"];
    $password = $datosUsuario["password"];
    $pais = $datosUsuario["pais"];
    $fotoUsuario = $datosUsuario["fotoUsuario"];   

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Mi Cuenta en Los Torneos.</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="fonts/css/fontawesome-all.css">
	<link href="https://fonts.googleapis.com/css?family=Chewy" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,900" rel="stylesheet">
	<link rel="icon" href="img/favicon.png" type="image/x-icon">
  <!--[if lt IE 9]>
  	<script src="js/html5shiv.js"></script>
	<![endif]-->
</head>
<body>
	<header>
		<div class="fila">
			<div class="fecha">
				<time><?php
					$dias=array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
					$meses=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
					echo "<span>".date("H:i")."hs</span><br>";
					echo "<span>".$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y')."</span";
					?></time>
			</div>
			<div id="logo">
				<a href="index.php">
					<img src="img/logo.png" alt="Los Torneos" class="logo">
				</a>
			</div>
			<nav class="usuarios">
                <?php
                    //session_start();
                    if(isset($_COOKIE["usuario"])) {
                        $_SESSION["usuario"] = $_COOKIE["usuario"];
                        $_SESSION["fotoUsuario"] = $_COOKIE["fotoUsuario"];
                    }
                    if(isset($_SESSION["usuario"])) {
                        echo "<img src='" . $_SESSION["fotoUsuario"] . "' alt='Foto Perfil' class='fotoUsuario' />";
                        echo "<h4>Hola, " . $_SESSION["usuario"] . "!</h4>";
                        echo "<ul><li class='activo'><a href='mi-cuenta.php'><i class='fas fa-user-edit'></i>&nbsp; Mi Cuenta</a></li><li><a href='logout.php'><i class='fas fa-user-times'></i>&nbsp; Salir</a></li></ul>";
                    } else {
                        header("Location: index.php?");
                    }
                ?>
            </nav>
		</div>
		<a href="#" class="toggle-nav">
			<span class="ion-navicon-round">
				<img src="img/nav-icon.png" alt="Menú"/>
			</span>
		</a>
		<nav class="main-nav">
			 <ul>
				<li><a href="index.php"><i class="fas fa-home"></i></a></li>
				 <li><a href="#buscar.php"><i class="fas fa-search"></i>&nbsp; Buscar</a></li>
				 <li><a href="#crear-torneo.php"><i class="fas fa-trophy"></i>&nbsp; Crear Torneo</a></li>
				 <li><a href="faq.php"><i class="fas fa-question"></i>&nbsp; Ayuda</a></li>
				 <li><a href="#contacto.php"><i class="fas fa-envelope"></i></a></li>
			 </ul>
		</nav>
	</header>
	<main>
		<article>
			<h1>Mi Cuenta</h1>
			<section class="formulario">
                <div class="miCuenta">
                    <img src="<?= $fotoUsuario ?>" alt="Foto Perfil" class="imagenUsuario" />
                    <div class="datosUsuario">
                        <h2>Usuario: &nbsp; <span><?= $usuario ?></span></h2>
                        <h2>e-Mail: &nbsp; <span><?= $email ?></span></h2>
                        <h2>País: &nbsp; <span><?= $pais == "AR" ? "Argentina" : ""; ?></span></h2>
                    </div>
                    
                </div>
				<!-- <form method="post" id="editar" enctype="multipart/form-data">
				<div class="error"><?= isset($existeUsuario["usuario"]) ? $existeUsuario["usuario"] : "" ?></div>
				<div class="error"><?= isset($errores["usuario"]) ? $errores["usuario"]: "" ?></div>
					<div class="campo">
						<input type="text" name="usuario" value="<?= $usuario; ?>">
					</div>
					<div class="campo">
						<input type="email" name="email" value="<?= $email ?>">
					</div> -->
					<!-- <div class="campo">
						<input type="password" name="password" value="" placeholder="**************">
					</div> -->
					<!-- <div class="campo">
						 <select name="pais">
							<option value="" disabled>País</option>
							<option value="DE">Alemania</option>
							<option value="DZ">Argelia</option>
							<option value="AR" selected>Argentina</option>
							<option value="AM">Armenia</option>
							<option value="AW">Aruba</option>
							<option value="AU">Australia</option>
							<option value="AT">Austria</option>
							<option value="BS">Bahamas</option>
							<option value="BZ">Belice</option>
							<option value="BO">Bolivia</option>
							<option value="BR">Brasil</option>
							<option value="CA">Canadá</option>
							<option value="CL">Chile</option>
							<option value="CO">Colombia</option>
							<option value="CR">Costa Rica</option>
							<option value="HR">Croacia</option>
							<option value="CU">Cuba</option>
							<option value="DK">Dinamarca</option>
							<option value="EC">Ecuador</option>
							<option value="EG">Egipto</option>
							<option value="SV">El Salvador</option>
							<option value="SI">Eslovenia</option>
							<option value="ES">España</option>
							<option value="US">Estados Unidos</option>
							<option value="EE">Estonia</option>
							<option value="ET">Etiopía</option>
							<option value="PH">Filipinas</option>
							<option value="FI">Finlandia</option>
							<option value="FR">Francia</option>
							<option value="GI">Gibraltar</option>
							<option value="GR">Grecia</option>
							<option value="GL">Groenlandia</option>
							<option value="GP">Guadalupe</option>
							<option value="GT">Guatemala</option>
							<option value="GY">Guayana</option>
							<option value="GF">Guayana Francesa</option>
							<option value="HT">Haití</option>
							<option value="HN">Honduras</option>
							<option value="HU">Hungría</option>
							<option value="IN">India</option>
							<option value="ID">Indonesia</option>
							<option value="IE">Irlanda</option>
							<option value="IS">Islandia</option>
							<option value="IT">Italia</option>
							<option value="JM">Jamaica</option>
							<option value="JP">Japón</option>
							<option value="MX">México</option>
							<option value="MC">Mónaco</option>
							<option value="NI">Nicaragua</option>
							<option value="NO">Noruega</option>
							<option value="NZ">Nueva Zelanda</option>
							<option value="NL">Holanda</option>
							<option value="PA">Panamá</option>
							<option value="PY">Paraguay</option>
							<option value="PE">Perú</option>
							<option value="PL">Polonia</option>
							<option value="PT">Portugal</option>
							<option value="PR">Puerto Rico</option>
							<option value="QA">Qatar</option>
							<option value="UK">Reino Unido</option>
							<option value="DO">República Dominicana</option>
							<option value="RU">Rusia</option>
							<option value="SE">Suecia</option>
							<option value="CH">Suiza</option>
							<option value="UY">Uruguay</option>
							<option value="VE">Venezuela</option>
						</select>
					</div> -->
					<!-- <div class="campo">
                        //<input type="file" name="fotoUsuario" value="" accept="image/*">
					</div> -->
					<!-- <div class="campo">
						<button type="submit" form="editar" value="editar">Guardar Cambios</button>
					</div> -->
				<!-- </form> -->
			</section>
		</article>
	</main>
	<footer>
		<div class="fila">
			<div class="fecha">
				<time><?php
					$dias=array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
					$meses=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
					echo "<span>".date("H:i")."hs</span><br>";
					echo "<span>".$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y')."</span";
				?></time>
			</div>
			<div class="sociales">
			<div class="discord"><a href="#"><i class="fab fa-discord"></i></a></div>
			<div class="facebook"><a href="#"><i class="fab fa-facebook-square"></i></a></div>
			</div>
		</div>
		<div class="disegnosis">
			<a href="https://www.disegnosis.com.ar" target="_blank">
				<img src="img/disegnosis.png" alt="Diseño Web DISEGNOSIS - Webmaster Diseño de Páginas / Sitios Web. Servicios de Hosting.">
			</a>
		</div>
	</footer>
</body>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/menu.js"></script>
</html>