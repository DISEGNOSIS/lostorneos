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
		<div id="logo">
			<a href="index.php">
				<img src="img/logo.png" alt="Los Torneos" class="logo">
			</a>
		</div>
		<nav class="usuarios">
			<ul>
			 <li class="activo"><a href="ingresa.php"><i class="fas fa-user"></i>&nbsp; Ingresá</a></li>
			 <li><a href="registrate.php"><i class="fas fa-user-plus"></i>&nbsp; Registrate</a></li>
			</ul>
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
			 <li><a href="buscar.php"><i class="fas fa-search"></i>&nbsp; Buscar</a></li>
			 <li><a href="crear-torneo.php"><i class="fas fa-trophy"></i>&nbsp; Crear Torneo</a></li>
			 <li><a href="faq.php"><i class="fas fa-question"></i>&nbsp; Ayuda</a></li>
			 <li><a href="contacto.php"><i class="fas fa-envelope"></i></a></li>
		 </ul>
	 </nav>
	</header>
 <main>
 	<article>
 		<h1>Ingresá a tu Cuenta:</h1>
 		<section class="formulario">
 			<form action="" method="post" id="ingreso">
 				<div class="campo">
					<label for="usuario">Usuario: </label>
					<input type="text" name="usuario" value="">
 				</div>
 				<div class="campo">
					<label for="password">Contraseña: </label>
					<input type="password" name="password" value="">
 				</div>
 				<div class="campo1">
 					<div class="checkbox">
 						<input type="checkbox" name="recordarme" value="Recordar">Recordarme
 					</div>
 					<a href="#">Olvidé mi Contraseña</a>
				</div>
				<div class="campo">
					<button type="submit" form="ingreso" value="ingresar">Ingresar</button>
				</div>
 			</form>
 		</section>
 	</article>
 </main>
 <footer>
	<div class="sociales">
	<div class="discord"><a href="#"><i class="fab fa-discord"></i></a></div>
	<div class="facebook"><a href="#"><i class="fab fa-facebook-square"></i></a></div>
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