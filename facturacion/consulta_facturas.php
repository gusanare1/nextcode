<?php
session_start();
if(!isset($_SESSION["username"]))
{
	$_SESSION["error"]="No permitido";
	header('Location: error.php');
}
?>

<html>
	
		<head>
		<title>Factura</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<script
		  src="https://code.jquery.com/jquery-3.5.1.min.js"
		  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
		  crossorigin="anonymous"></script>
		  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		
		
		<script src="js/factura_js.js"></script>	
	
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
  
	</head>
	
	<body>
		<div ng-app="app" ng-controller="consulta_facturas"> 
	
	<label for="search">Busqueda por Document</label>
	<input type="text" ng-model="searchDocumento">
	
	<label for="search">Busqueda por Cliente</label>
	<input type="text" ng-model="searchCliente">
	
	Desde:<input type="date" ng-model="date1" type="text" placeholder="" >
	Hasta:<input type="date" ng-model="date2" type="text" placeholder="" >
	
	<table class="table table-dark">
		<tr>
			<th> Identificacion</th>
			<th> Nombre</th>
			<th> No. Factura </th>
			<th> <a href="#" ng-click="setOrderProperty('fecha_emision')">Fecha de Emision {{orderChar}}</a></th>
			<th> Ver </th>
		</tr>
		
		<tbody ng-repeat="factura in facturas | filter:{nombre:searchCliente} | orderBy:orderProperty | filter:{identificacion:searchDocumento} | myfilter:date1:date2">
			<tr>
				<td>{{factura.identificacion}}</td>
				<td>{{factura.nombre}}</td>
				<td>{{factura.no_factura}}</td>
				<td>{{factura.fecha_emision}}</td>
				<td><button ng-click="fetchFacura(factura.no_factura)">Ver</button> </td>
			</tr>
		</tbody>
	</table>		
	
	
	
	
	
	
	
	
	
	
	
	
</div>
	</body>
</html>