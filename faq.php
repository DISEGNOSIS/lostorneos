<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Ayuda para participar o crear tu torneo.</title>
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
				<ul>
				 <li><a href="ingresa.php"><i class="fas fa-user"></i>&nbsp; Ingresá</a></li>
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
				 <li class="activo"><a href="faq.php"><i class="fas fa-question"></i>&nbsp; Ayuda</a></li>
				 <li><a href="contacto.php"><i class="fas fa-envelope"></i></a></li>
			 </ul>
		</nav>
	</header>
	<main>
		<section>
			<article id="faq">
				<h1>Preguntas Frecuentes</h1>
				<a href="#" class="faq">
					<h3>¿Para qué sirve Los Torneos?</h3>
				</a>
				<div class="respuesta">
					<p>Los Torneos es una aplicación para Participar o Crear Torneos.</p>
					<p>Podés Participar / Crear Torneos Individuales o Grupales.</p>
				</div>
				<a href="#" class="faq">
					<h3>¿Por qué utilizar Los Torneos?</h3>
				</a>
				<div class="respuesta">
					<p>Nuestra plataforma incluye todo para que tu Torneo sea profesional. Ranking, Fixtures, Resultados, Partidas en Vivo.</p>
				</div>
				<a href="#" class="faq">
					<h3>¿Puedo registrarme e ingresar con Discord o Facebook?</h3>
				</a>
				<div class="respuesta">
					<p>¡Por supuesto! Buscamos hacerlo más fácil. &#128521</p>
				</div>
				<a href="#" class="faq">
					<h3>¿Cómo participo en Torneos?</h3>
				</a>
				<div class="respuesta">
					<ol>
						<li><a href="registrate.php">Registrarte</a> e <a href="ingresa.php">Ingresá en tu cuenta</a>.</li>
						<li>Elegí el Juego.</li>
						<li>Elegí el Torneo en el que quieras participar.</li>
						<li>Registrate en el Torneo elegido.</li>
						<li>Esperá a que te acepte el Organizador del Torneo.</li>
						<li>Verificá el día y la hora de Comienzo del Torneo.</li>
						<li>Unos minutos antes que comience el Torneo presentate haciendo click en el ícono en tu cuenta.</li>
						<li>Jugá los partidos.</li>
						<li>Informá los resultados.</li>
						<li>¡Mirá el Ranking!</li>
					</ol>
				</div>
				<a href="#" class="faq">
					<h3>¿Cómo creo un Torneo?</h3>
				</a>
				<div class="respuesta">
					<ol>
						<li><a href="registrate.php">Registrarte</a> e <a href="ingresa.php">Ingresá en tu cuenta</a>.</li>
						<li>Creá el Torneo.</li>
						<li>Elegí el Juego.</li>
						<li>Elegí el Tipo de Torneo (eliminación simple o doble, rondas por equipos,   fase de grupos).</li>
						<li>Elegí si los Jugadores participan Individualmente o en Grupos.</li>
						<li>Seteá la fecha de Comienzo y Fin del Torneo.</li>
						<li>Seteá la fecha de Comienzo y Fin de las Inscripciones.</li>
						<li>Publicá el Torneo.</li>
						<li>Invitá a los Participantes o esperá a que se inscriban.</li>
						<li>Creá el Fixture.</li>
						<li>Esperá que se Jueguen los Partidos.</li>
						<li>Ingresá los Resultados de los Partidos.</li>
						<li>Compartí los Resultados de tu Torneo.</li>
					</ol>
				</div>
			</article>
		</section>
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
<script src="js/faq.js"></script>
</html>