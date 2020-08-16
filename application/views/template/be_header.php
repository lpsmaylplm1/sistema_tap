<!DOCTYPE html>
<html>
	<head>
		<title>Tablas de aplicabilidad</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link  rel="icon"   href="<?php echo base_url('assets/images/favicon.ico') ?>" type="image/ico" >
		<!--Import Google Icon Font-->

		<link rel="stylesheet" href="<?php echo base_url('assets/back_end/css/icon.css')?>">
		<!-- Compiled and minified CSS -->
		<link rel="stylesheet" href="<?php echo base_url('assets/back_end/css/materialize.min.css')?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/back_end/css/jquery.dataTables.min.css')?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/back_end/css/responsive.dataTables.min.css')?>">
		<script>
			document.addEventListener('DOMContentLoaded', function () {
				M.AutoInit();
			});
		</script> 
		<script    src="<?php echo base_url('assets/back_end/js/jquery-3.5.0.js')?>"  ></script>
		<script    src="<?php echo base_url('assets/back_end/js/jquery.dataTables.min.js')?>" > </script> 
		<script    src="<?php echo base_url('assets/back_end/js/dataTables.responsive.min.js')?>" > </script>
	</head>
	<body>
		<div class="navbar-fixed">

			<!-- Dropdown Structure -->
			<ul id="menu-drop" class="dropdown-content">
				
				<li class="divider"></li>
				<li><a href=""</li>
			</ul>
			
			<nav class="orange darken-4">
				<div class="nav-wrapper container">
					<a class="brand-logo">   <img class="responsive-img"  src="<?php echo base_url('assets/images/logo_small.png') ?>">        </a>
					<a href="#" data-target="menu-responsive" class="sidenav-trigger"> <i class="material-icons">menu</i> </a>
					<ul class="right hide-on-med-and-down">
						<!-- Dropdown Trigger -->
							<li><a   href="<?php echo base_url('login/logout') ?>"> <i class="tiny material-icons right"> exit_to_app</i>  Cerrar sesión</a></li>
						
					</ul>
				</div>
			</nav>

		</div>
<!--		<ul class="sidenav" id="menu-responsive">
			<li><a href="#"><i class="material-icons ">send</i> Enlace 1</a></li>
			<li><a href="#"><i class="material-icons">send</i> Enlace 2</a></li>
			 Dropdown Trigger 
			<li><a class="dropdown-trigger" href="#!" data-target="menu-drop"><strong>Login</strong><i class="material-icons right">arrow_drop_down</i></a></li>
		</ul>-->