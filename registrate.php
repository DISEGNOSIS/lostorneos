<?php
	require_once "helpers.php";
	
	$estilo = "";
	if($_POST){
		$validar = new Validar();
		$errores = $validar->getErrorRegistro();
		if(empty($errores)) {
			$usuario = $_POST["usuario"];
			$email = $_POST["email"];
			$password = $_POST["password"];
			$pais = $_POST["pais"];
			$fotoUsuario = $_FILES["fotoUsuario"];
			$nuevoUsuario = new Usuario($usuario, $email, $password, $pais);
			$existeUsuario = $db->existeUsuarioR($nuevoUsuario);
			if(empty($existeUsuario)) {
				$nuevoUsuario->setFotoUsuario($fotoUsuario);
				$db->guardarUsuario($nuevoUsuario);
				$session->add("usuario", $nuevoUsuario->getUsuario());
				$session->add("fotoUsuario", $nuevoUsuario->getFotoUsuario());
				header("Location: mi-cuenta.php");
			} else {
				$estilo = "error";
			}
		} else {
			$estilo = "error";
		}
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Registrate en Los Torneos.</title>
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
				if(isset($_SESSION["usuario"])) {
					header("Location: index.php");
				} else {
			?>
					<ul>
					<li><a href="ingresa.php"><i class="fas fa-user"></i>&nbsp; Ingresá</a></li>
					<li class="activo"><a href="registrate.php"><i class="fas fa-user-plus"></i>&nbsp; Registrate</a></li>
					</ul>
			<?php
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
			<h1>Creá tu Cuenta:</h1>
			<section class="formulario">
				<form method="post" id="registro" enctype="multipart/form-data">
				<div class="error"><?= isset($existeUsuario["usuario"]) ? $existeUsuario["usuario"] : "" ?></div>
				<div class="error"><?= isset($errores["usuario"]) ? $errores["usuario"]: "" ?></div>
					<div class="campo">
						<input type="text" name="usuario" value="<?= isset($_POST["usuario"]) ? $_POST["usuario"] : "" ?>" placeholder="Usuario">
					</div>
					<div class="<?= $estilo ?>"><?= isset($existeUsuario["email"]) ? $existeUsuario["email"] : "" ?></div>
					<div class="<?= $estilo ?>"><?= isset($errores["email"]) ? $errores["email"] : "" ?></div>
					<div class="campo">
						<input type="email" name="email" value="<?= isset($_POST["email"]) ? $_POST["email"] : "" ?>" placeholder="e-Mail">
					</div>
					<div class="<?= $estilo ?>"><?= isset($errores["password"]) ? $errores["password"] : "" ?></div>
					<div class="campo">
						<input type="password" name="password" value="<?= isset($_POST["password"]) ? $_POST["password"] : "" ?>" placeholder="Contraseña">
					</div>
					<div class="<?= $estilo ?>"><?= isset($errores["passwordConfirm"]) ? $errores["passwordConfirm"] : "" ?></div>
					<div class="campo">
						<input type="password" name="passwordConfirm" value="<?= isset($_POST["passwordConfirm"]) ? $_POST["passwordConfirm"] : "" ?>" placeholder="Confirmar Contraseña">
					</div>
					<div class="campo">
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
							<option value="CN">China</option>
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
							<option value="SW">Suiza</option>
							<option value="UY">Uruguay</option>
							<option value="VE">Venezuela</option>
						</select>
					</div>
					<div class="<?= $estilo ?>"><?= isset($errores["fotoUsuario"]) ? $errores["fotoUsuario"] : "" ?></div>
					<div class="campo">
						<input type="file" name="fotoUsuario" value="<?= isset($_FILES["fotoUsuario"]["name"]) ? $_FILES["fotoUsuario"]["name"] : "" ?>" accept="image/*">
					</div>
					<div class="campo">
						<button type="submit" form="registro" value="registrarme">Registrarme</button>
						<button type="reset" form="registro" value="reset">Borrar</button>
					</div>
				</form>
				<div class="campo">
					<p><em>*&nbsp; Todos los campos son requeridos.</em></p>
				</div>
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
