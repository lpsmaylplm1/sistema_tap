<!DOCTYPE html>
<html>
	<head>
		<title>Tablas de aplicabilidad</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!-- Compiled and minified CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
		<link  rel="icon"   href="<?php echo base_url('assets/images/favicon.ico') ?>" type="image/ico" >
		<script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" 	crossorigin="anonymous"></script>
		<script  src="https://code.jquery.com/jquery-3.5.0.min.js"  integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="  crossorigin="anonymous"></script>
		<script>
			document.addEventListener('DOMContentLoaded', function () {
				M.AutoInit();
			});
		</script>
		<style type="text/css">
			body{
				background-color:#eee9e9;
			}
		</style>

	</head>
	<body background = "<?php echo base_url('assets/images/back_comp.jpg') ?> " style="background-size: cover;">
		<div class="navbar-fixed">

			<!-- Dropdown Structure -->
			<ul id="menu-drop" class="dropdown-content">
				<li><a href="#!">Item 1</a></li>
				<li><a href="#!">Item 2</a></li>
				<li class="divider"></li>
				<li><a href="#!">Iniciar sesión</a></li>
			</ul>
			<nav class="orange darken-4">
				<div class="nav-wrapper container">
					<a href="<?php echo base_url() ?>" class="brand-logo">   <img class="responsive-img"  src="<?php echo base_url('assets/images/logo_small.png') ?>">        </a>
					<a href="#" data-target="menu-responsive" class="sidenav-trigger"> <i class="material-icons">menu</i> </a>
					<ul class="right hide-on-med-and-down"> 
<!--						<li><a href="#">Enlace 1</a></li>
						<li><a href="#">Enlace 2</a></li>
						 Dropdown Trigger 
						<li><a class="dropdown-trigger" href="#!" data-target="menu-drop"><strong>Login</strong><i class="material-icons right">arrow_drop_down</i></a></li>-->
					</ul>
				</div>
			</nav>

		</div>
