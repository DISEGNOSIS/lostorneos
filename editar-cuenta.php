<?php
	require_once "helpers.php";

	if(isset($_SESSION["usuario"])) {
		$datosUsuario = $db->traerUsuario();
		$id = $datosUsuario->id;
		$usuario = $datosUsuario->usuario;
		$email = $datosUsuario->email;
		$password = $datosUsuario->pass;
		$pais = $datosUsuario->pais;
		$fotoUsuario = $datosUsuario->foto_usuario;
	}
	$estilo = "";
	if($_POST){
		$validar = new Validar();
		$errores = $validar->getErrorEditar();
		if(empty($errores)) {
			$usuarioViejo = $usuario;
			$usuario = $_POST["usuario"] ? $_POST["usuario"] : $usuario;
			$email = $_POST["email"] ? $_POST["email"] : $email;
			$password = $_POST["password"] ? $_POST["password"] : $password;
			$pais = $_POST["pais"] ? $_POST["pais"] : $pais;
			$nuevoUsuario = new Usuario($usuario, $email, $password, $pais);
			$nuevoUsuario->setId($id);
			$existeUsuario = $db->existeUsuarioE($nuevoUsuario);
			if(empty($existeUsuario)) {
				if(!empty($_FILES["fotoUsuario"]["name"])) {
					$nuevoUsuario->setFotoUsuario($_FILES["fotoUsuario"]);
				} else {
					$nuevoUsuario->setRutaFotoUsuario($fotoUsuario);
				}
				$db->editarUsuario($nuevoUsuario);
				if($cookie->get("usuario") == $usuarioViejo) {
					$cookie->add("usuario", $nuevoUsuario->getUsuario());
					$cookie->add("fotoUsuario", $nuevoUsuario->getFotoUsuario());
				}
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
			<nav class="usuarios <?= isset($_SESSION['usuario']) ? 'subir' : '' ?>" >
			<?php
				if(isset($_SESSION["usuario"])) { 
			?>
					<div class="usuario">
						<img src="<?= $_SESSION['fotoUsuario'] ?>" alt="Foto Perfil" class="foto-usuario" />
						<h4><?= $_SESSION["usuario"] ?></h4>
					</div>
					<ul>
						<li class='activo'><a href='mi-cuenta.php'><i class='fas fa-user-edit'></i>&nbsp; Mi Cuenta</a></li>
						<li><a href='logout.php'><i class='fas fa-user-times'></i>&nbsp; Salir</a></li>
					</ul>
			<?php
				} else {
                        header("Location: ingresa.php");
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
			<h1>Editar Cuenta</h1>
			<section class="formulario">
                <div class="editar-usuario">
				<form method="post" id="editar" enctype="multipart/form-data">
				<div class="error"><?= isset($existeUsuario["usuario"]) ? $existeUsuario["usuario"] : "" ?></div>
				<div class="error"><?= isset($errores["usuario"]) ? $errores["usuario"]: "" ?></div>
					<div class="campo">
						<input type="text" name="usuario" value="<?= $usuario; ?>">
					</div>
					<div class="error"><?= isset($existeUsuario["email"]) ? $existeUsuario["email"] : "" ?></div>
					<div class="<?= $estilo ?>"><?= isset($errores["email"]) ? $errores["email"] : "" ?></div>
					<div class="campo">
						<input type="email" name="email" value="<?= $email ?>">
					</div>
					<div class="<?= $estilo ?>"><?= isset($errores["password"]) ? $errores["password"] : "" ?></div>
					<div class="campo">
						<input type="password" name="password" value="" placeholder="**************">
					</div>
					<div class="<?= $estilo ?>"><?= isset($errores["passwordConfirm"]) ? $errores["passwordConfirm"] : "" ?></div>
					<div class="campo">
						<input type="password" name="passwordConfirm" value="<?= isset($_POST["passwordConfirm"]) ? $_POST["passwordConfirm"] : "" ?>" placeholder="Confirmar Contraseña">
					</div>
					</div>
					<div class="campo">
						 <select name="pais">
							<option value="" disabled>País</option>
							<option value="DE" <?= $pais == 'DE' ? 'selected' : '' ?>>Alemania</option>
							<option value="DZ" <?= $pais == 'DZ' ? 'selected' : '' ?>>Argelia</option>
							<option value="AR" <?= $pais == 'AR' ? 'selected' : '' ?>>Argentina</option>
							<option value="AM" <?= $pais == 'AM' ? 'selected' : '' ?>>Armenia</option>
							<option value="AW" <?= $pais == 'AW' ? 'selected' : '' ?>>Aruba</option>
							<option value="AU" <?= $pais == 'AU' ? 'selected' : '' ?>>Australia</option>
							<option value="AT" <?= $pais == 'AT' ? 'selected' : '' ?>>Austria</option>
							<option value="BS" <?= $pais == 'BS' ? 'selected' : '' ?>>Bahamas</option>
							<option value="BZ" <?= $pais == 'BZ' ? 'selected' : '' ?>>Belice</option>
							<option value="BO" <?= $pais == 'BO' ? 'selected' : '' ?>>Bolivia</option>
							<option value="BR" <?= $pais == 'BR' ? 'selected' : '' ?>>Brasil</option>
							<option value="CA" <?= $pais == 'CA' ? 'selected' : '' ?>>Canadá</option>
							<option value="CL" <?= $pais == 'CL' ? 'selected' : '' ?>>Chile</option>
							<option value="CN" <?= $pais == 'CN' ? 'selected' : '' ?>>China</option>
							<option value="CO" <?= $pais == 'CO' ? 'selected' : '' ?>>Colombia</option>
							<option value="CR" <?= $pais == 'CR' ? 'selected' : '' ?>>Costa Rica</option>
							<option value="HR" <?= $pais == 'HR' ? 'selected' : '' ?>>Croacia</option>
							<option value="CU" <?= $pais == 'CU' ? 'selected' : '' ?>>Cuba</option>
							<option value="DK" <?= $pais == 'DK' ? 'selected' : '' ?>>Dinamarca</option>
							<option value="EC" <?= $pais == 'EC' ? 'selected' : '' ?>>Ecuador</option>
							<option value="EG" <?= $pais == 'EG' ? 'selected' : '' ?>>Egipto</option>
							<option value="SV" <?= $pais == 'SV' ? 'selected' : '' ?>>El Salvador</option>
							<option value="SI" <?= $pais == 'SI' ? 'selected' : '' ?>>Eslovenia</option>
							<option value="ES" <?= $pais == 'ES' ? 'selected' : '' ?>>España</option>
							<option value="US" <?= $pais == 'US' ? 'selected' : '' ?>>Estados Unidos</option>
							<option value="EE" <?= $pais == 'EE' ? 'selected' : '' ?>>Estonia</option>
							<option value="ET" <?= $pais == 'ET' ? 'selected' : '' ?>>Etiopía</option>
							<option value="PH" <?= $pais == 'PH' ? 'selected' : '' ?>>Filipinas</option>
							<option value="FI" <?= $pais == 'FI' ? 'selected' : '' ?>>Finlandia</option>
							<option value="FR" <?= $pais == 'FR' ? 'selected' : '' ?>>Francia</option>
							<option value="GI" <?= $pais == 'GI' ? 'selected' : '' ?>>Gibraltar</option>
							<option value="GR" <?= $pais == 'GR' ? 'selected' : '' ?>>Grecia</option>
							<option value="GL" <?= $pais == 'GL' ? 'selected' : '' ?>>Groenlandia</option>
							<option value="GP" <?= $pais == 'GP' ? 'selected' : '' ?>>Guadalupe</option>
							<option value="GT" <?= $pais == 'GT' ? 'selected' : '' ?>>Guatemala</option>
							<option value="GY" <?= $pais == 'GY' ? 'selected' : '' ?>>Guayana</option>
							<option value="GF" <?= $pais == 'GF' ? 'selected' : '' ?>>Guayana Francesa</option>
							<option value="HT" <?= $pais == 'HT' ? 'selected' : '' ?>>Haití</option>
							<option value="HN" <?= $pais == 'HN' ? 'selected' : '' ?>>Honduras</option>
							<option value="HU" <?= $pais == 'HU' ? 'selected' : '' ?>>Hungría</option>
							<option value="IN" <?= $pais == 'IN' ? 'selected' : '' ?>>India</option>
							<option value="ID" <?= $pais == 'ID' ? 'selected' : '' ?>>Indonesia</option>
							<option value="IE" <?= $pais == 'IE' ? 'selected' : '' ?>>Irlanda</option>
							<option value="IS" <?= $pais == 'IS' ? 'selected' : '' ?>>Islandia</option>
							<option value="IT" <?= $pais == 'IT' ? 'selected' : '' ?>>Italia</option>
							<option value="JM" <?= $pais == 'JM' ? 'selected' : '' ?>>Jamaica</option>
							<option value="JP" <?= $pais == 'JP' ? 'selected' : '' ?>>Japón</option>
							<option value="MX" <?= $pais == 'MX' ? 'selected' : '' ?>>México</option>
							<option value="MC" <?= $pais == 'MC' ? 'selected' : '' ?>>Mónaco</option>
							<option value="NI" <?= $pais == 'NI' ? 'selected' : '' ?>>Nicaragua</option>
							<option value="NO" <?= $pais == 'NO' ? 'selected' : '' ?>>Noruega</option>
							<option value="NZ" <?= $pais == 'NZ' ? 'selected' : '' ?>>Nueva Zelanda</option>
							<option value="NL" <?= $pais == 'NL' ? 'selected' : '' ?>>Holanda</option>
							<option value="PA" <?= $pais == 'PA' ? 'selected' : '' ?>>Panamá</option>
							<option value="PY" <?= $pais == 'PY' ? 'selected' : '' ?>>Paraguay</option>
							<option value="PE" <?= $pais == 'PE' ? 'selected' : '' ?>>Perú</option>
							<option value="PL" <?= $pais == 'PL' ? 'selected' : '' ?>>Polonia</option>
							<option value="PT" <?= $pais == 'PT' ? 'selected' : '' ?>>Portugal</option>
							<option value="PR" <?= $pais == 'PR' ? 'selected' : '' ?>>Puerto Rico</option>
							<option value="QA" <?= $pais == 'QA' ? 'selected' : '' ?>>Qatar</option>
							<option value="UK" <?= $pais == 'UK' ? 'selected' : '' ?>>Reino Unido</option>
							<option value="DO" <?= $pais == 'DO' ? 'selected' : '' ?>>República Dominicana</option>
							<option value="RU" <?= $pais == 'RU' ? 'selected' : '' ?>>Rusia</option>
							<option value="SE" <?= $pais == 'SE' ? 'selected' : '' ?>>Suecia</option>
							<option value="SW" <?= $pais == 'SW' ? 'selected' : '' ?>>Suiza</option>
							<option value="UY" <?= $pais == 'UY' ? 'selected' : '' ?>>Uruguay</option>
							<option value="VE" <?= $pais == 'VE' ? 'selected' : '' ?>>Venezuela</option>
						</select>
					</div>
					<div class="<?= $estilo ?>"><?= isset($errores["fotoUsuario"]) ? $errores["fotoUsuario"] : "" ?></div>
					<div class="campo">
                        <input type="file" name="fotoUsuario" value="" accept="image/*">
					</div>
					<div class="campo">
						<button type="submit" form="editar" value="editar">Guardar Cambios</button>
					</div>
				</form>
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
