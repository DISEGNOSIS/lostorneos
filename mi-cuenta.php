<?php
	require_once "helpers.php";

	if(isset($_SESSION["usuario"])) {
		$datosUsuario = $db->traerUsuario();
		$usuario = $datosUsuario->usuario;
		$email = $datosUsuario->email;
		$password = $datosUsuario->pass;
		$pais = $datosUsuario->pais;
		$fotoUsuario = $datosUsuario->foto_usuario;
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
			<div class="editar">
				<a 	href="editar-cuenta.php">Editar</a>
			</div>
			<h1>Mi Cuenta</h1>
			<section class="formulario">
                <div class="mi-cuenta">
                    <img src="<?= $fotoUsuario ?>" alt="Foto Perfil" class="imagen-usuario" />
                    <div class="datos-usuario">
                        <h2>Usuario: &nbsp; <span><?= $usuario ?></span></h2>
                        <h2>e-Mail: &nbsp; <span><?= $email ?></span></h2>
                        <h2>País: &nbsp; <span><?= $pais == "AR" ? "Argentina" : $pais; ?></span></h2>
                    </div>
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
