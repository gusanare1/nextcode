<?php
use DatosPersonales\Permisos;
include("Empresa.php");

$empresa = new Empresa();
?>
<html>
	<head>
		<title>Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
	<script
	  src="https://code.jquery.com/jquery-3.5.1.min.js"
	  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
	  crossorigin="anonymous"></script>
	  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>


<body>
	<nav class="navbar navbar-default">
	<div class="container-fluid">
		<ul class="nav navbar-nav">
		
		<div class="navbar-header">
			<a class="navbar-brand" href="#">Empresa <?php echo $empresa->nombre ?> </a>
		</div>
		
			<?php

				foreach($user->paginas_permitidas as $nav_pag) 
				{
			?>
					<li class="nav-item active" style="margin-right:2em;">
						<a class="nav-link" href="<?php  echo DatosPersonales\Permisos::$navegador_url[$nav_pag]; ?>"> <?php echo DatosPersonales\Permisos::$navegador_titulo[$nav_pag]; ?> <span class="sr-only"> </a>
					</li>
			<?php
				}
			?>
		</ul>
	</div>
	</nav>
</body>