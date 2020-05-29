<?php
include("Empresa.php");

$empresa = new Empresa();
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
		<script src="login_js.js"></script>	
	
		<style>
		
			.grid-container-header{
				display:grid;
				grid-template-columns: auto auto;
				
				grid-gap:0.4em;
			}
			.grid-container-header-left{
				display:grid;
				grid-template-columns: auto;
				//border-right: 2px solid #73AD21;
				
			}		
			
			.grid-container-header-right{
				display:grid;
				grid-template-columns: auto;
				border-radius: 25px;
				border: 2px solid #73AD21;
				grid-column-gap:1em;
				
			}	
			
			.grid-container-two-columns{
				display:grid;
				grid-template-columns: 2fr 2fr;
				//border: 2px solid #f76707;

			}
			
			.grid-container-one-column{
				display:grid;
				grid-template-columns: auto ;
				border-top: 2px solid #73ad21;
				border-bottom: 2px solid #73ad21;
			}
			
			.child:nth-child(3n) {
				border-left: var(--border);
			}

			.grid-container-four-columns{
				display:grid;
				grid-template-columns:5fr 40fr 5fr 50fr;
			}
			
			.grid-container-four-columns-detalles-factura{
				display:grid;
				grid-template-columns:10fr 70fr 10fr 10fr;
				grid-gap:0.5em;
				margin-top:1em;
			}

			
		
			//Fill one column
			.grid-one-column{
				grid-column-end: span 1;
				//border: 2px solid #f76707;
			}
			//Fill two columns
			.grid-two-columns{
				grid-column-end: span 2;
				//border: 2px solid #f76707;
			}
			.fondo
			{
				display:inline-block;
				padding-left:1em;
				padding-right:1em;
				background-color: darkgoldenrod;
			}
			#header-empresa-nombre{
				
			}
			.center-text{
				text-align:center;
			}
			.border-down{
				border-bottom: 2px solid #73AD21;
			}
			
			.hr1{
				border: 2px solid green;
				margin-left:1em;
				margin-right:1em;
			}
			.hr2{
				border: 2px solid blue;
				margin-left:1em;
				margin-right:1em;
			}
			.hr3{
				border: 2px solid black;
				margin-left:1em;
				margin-right:1em;
			}
			
			input{
				width:100%;
				height:100%;
			}
			select{
				width:100%;
				height:100%;
			}
			.espaciado{
				margin-top: 3em;
			}
			.espaciado-interior{
				margin-top:1.5em;
			}
			.grid-container-four-columns-detalles-factura-contenedor{
				border-radius: 10px;
				border: 2px solid #73AD11;
				padding-right:0.5em;
				padding-left:0.5em;
				padding-bottom:1em;
			}
			.container-pago{
				display:flex;
				grid-template-columns: 70fr 30fr;
				grid-column-gap:1em;
			}
			.subcontainer-pago{
				display:flex;
				grid-template-columns: 50fr 50fr;
			}
			.subcontainer-pago-izquierdo{
				margin-top:2em;
				grid-template-columns: 40fr 60fr;
				width:100%;
			}
			.subcontainer-pago-izquierdo-round{
				order-radius: 40px;
				border: 2px solid #73AD21;
				width:100%;
				min-width:70%;
			}
			.subcontainer-pago-derecho{
				grid-template-columns: 40fr 60fr;
				margin-top:2em;
			}
			.border-all{
				border-right: 2px solid black;
				border-top: 2px solid black;
				border-left: 2px solid black;
				border-bottom : 2px solid black;
				
				//max-width:100;
			}
			.border-righ{
				border-right:2px solid #73ad21;
			}
			
			
		</style>
	</head>



<body>
	
	
	<div class="grid-container-header">
		
		<div class="grid-container-header-left">
			<div class="grid-one-column center-text ">
				<div class="fondo">
					<h2><?php echo $empresa->nombre; ?> </h2>
				</div>
			</div>
			
			<div class="grid-one-column ">
				<h4 class="center-text"> PAMELA JESSICA </h4>
			</div>
			<hr class="hr1">
			<div class="grid-one-column">
				<h4> Direccción Matriz: <?php echo $empresa->direccion; ?> </h4>
			</div>
			
		</div>
		
		<div class="grid-container-header-right">
		
			<div class="grid-container-two-columns">
				<div class="grid-one-column center-text border-righ">
					<h4> R.U.C </h4>
				</div>
				<div class="grid-one-column center-text">
					<h4> E<?php echo $empresa->ruc; ?>
				</div>
			</div>
			
			<div class="grid-container-one-column">
			<div class="grid-two-columns">
				<h3 class="center-text">FACTURA</h3>
			</div>
			<div class="grid-one-column">
				<h4 class="center-text">No. XXXXXX-XXX-XXXX-XXX</h4>
			</div>
			</div>
			<div class="grid-two-columns">
			
			<div class="grid-container-two-columns">
				<div class="grid-one-column center-text border-righ">
					<h4> AUT. SRI: <h4>
				</div>
				<div class="grid-one-column center-text">
					<h4><?php echo $empresa->aut_sri; ?><h4>
				</div>
			</div>
		</div>
	</div>
	</div>
	
	<hr class="hr1">
	
	
	<div class="espaciado">
	
		<div class="grid-container-four-columns">
			<div class="grid-one-column">
				<h4>Sr.(es): </h4>
			</div>
			<div class="grid-one-column"> 
				<input type:"text" name="" placeholder="Nombre del cliente">
			</div>
			
			<div class="grid-one-column"> 
				<h4>R.U.C.: </h4>
			</div>
			
			<div class="grid-one-column"> 
				<input type:"text" name="" placeholder="C.I.">
			</div>
		</div>
	
		<div class="espaciado-interior"/>
	
		<div class="grid-container-four-columns">
			<div class="grid-one-column">
				<h4>FECHA EMISION: </h4>
			</div>
			<div class="grid-one-column"> 
				<input type:"text" name="" placeholder="Fecha de Emision">
			</div>
			
			<div class="grid-one-column"> 
				<h4>GUIA DE REMISION: </h4>
			</div>
			
			<div class="grid-one-column"> 
				<input type:"text" name="" placeholder="No.">
			</div>
		</div>
	</div>
	
	
	
	<hr class="hr2">
	
	<div class="grid-container-four-columns-detalles-factura-contenedor">
	
		<div class="grid-container-four-columns-detalles-factura">
		
			<div class="grid-one-column">
				<h4 class="center-text"> Cantidad</h4>
			</div>
			
			<div class="grid-one-column">
				<h4 class="center-text"> Descripcion</h4>
			</div>
			
			<div class="grid-one-column">
				<h4 class="center-text"> Precio Unitario </h4>
			</div>
			
			<div class="grid-one-column">
				<h4 class="center-text"> Total </h4>
			</div>
		</div>
		
		<div class="grid-container-four-columns-detalles-factura">
		
			<div class="grid-one-column">
				<input id="cantidad1" type="text" placeholder="Cantidad" >
			</div>
			
			<div id class="grid-one-column"> 
				<select id="descripcion1">
					<option value="1">Opcion1</option>
					<option value="2">Opcion2</option>
				</select>
			</div>
		
			<div class="grid-one-column">
				<input type="text" id="p_unitario1" placeholder="Precio Unitario" >
			</div>
			
			<div class="grid-one-column">
				<input id="total1" type="Total" placeholder="Total" >
			</div>
		</div>

		<div class="grid-container-four-columns-detalles-factura">
		
			<div class="grid-one-column">
				<input type="text" id="cantidad2" placeholder="Cantidad" >
			</div>
			
			<div class="grid-one-column"> 
				<select id="descripcion2">
					<option value="1">Opcion1</option>
					<option value="2">Opcion2</option>
				</select>
			</div>
		
			<div class="grid-one-column">
				<input id="p_unitario2" type="number" step="0.01" placeholder="Precio Unitario" >
			</div>
			
			<div class="grid-one-column">
				<input id="total2" type="number" step="0.01" placeholder="Total" >
			</div>
		</div>
			
		<div class="grid-container-four-columns-detalles-factura">
		
			<div class="grid-one-column">
				<input id="cantidad3" type="text" step="1" placeholder="Cantidad" >
			</div>
			
			<div class="grid-one-column"> 
				<select id="descripcion3">
					<option value="1">Opcion1</option>
					<option value="2">Opcion2</option>
				</select>
			</div>
			
			<div class="grid-one-column">
				<input id="p_unitario3" type="text" placeholder="Precio Unitario" >
			</div>
			
			<div class="grid-one-column">
				<input id="total3" type="Total" placeholder="Total" >
			</div>
		</div>
	</div>
	
	
	<div class="container-pago">
		
			<div class="subcontainer-pago-izquierdo">
			<div class="subcontainer-pago-izquierdo-round">
				<div class="grid-two-columns">
					<h3>Forma de pago</h3>
				</div>
				<div class="grid-container-two-columns">
					<div class="grid-one-column  border-all">
						<h4>Efectivo</h4>
					</div>
					<div class="grid-one-column  border-all">
						<h4>XYZ</h4>
					</div>
				</div>
				
				<div class="grid-container-two-columns">
					<div class="grid-one-column  border-all">
						<h4>Dinero Electronico</h4>
					</div>
					<div class="grid-one-column  border-all">
						<h4>XYZ</h4>
					</div>
				</div>
				
				<div class="espaciado">
					<div class="grid-container-two-columns ">
						<div class="grid-two-columns">
							<hr class="hr3">
						</div>
					</div>
				</div>
				
				<div class="grid-container-two-columns ">
					<div class="grid-two-columns">
						<h4 class="center-text">Recibi conforme</h4>
					</div>
				</div>
			</div>
			</div>
			
			
			<div class="subcontainer-pago-derecho">
				<div class="grid-container-two-columns">
					<div class="grid-one-column border-all">
						<h4>SubTotal 12% IVA</h4>
					</div>
					<div class="grid-one-column border-all">
						<h4>XXX</h4>
					</div>
					
					<div class="grid-one-column border-all">
						<h4>SubTotal 0% IVA</h4>
					</div>
					<div class="grid-one-column border-all">
						<h4>XXX</h4>
					</div>
					
					<div class="grid-one-column border-all">
						<h4>SubTotal No objeto IVA</h4>
					</div>
					<div class="grid-one-column border-all">
						<h4>XXX</h4>
					</div>
					
					<div class="grid-one-column border-all">
						<h4>Descuento</h4>
					</div>
					<div class="grid-one-column border-all">
						<h4>XXX</h4>
					</div>
					
					<div class="grid-one-column  border-all">
						<h4>Sub Total</h4>
					</div>
					<div class="grid-one-column border-all" >
						<h4>XXX</h4>
					</div>
					
					<div class="grid-one-column border-all">
						<h4>ICE</h4>
					</div>
					<div class="grid-one-column border-all">
						<h4>XXX</h4>
					</div>
					
					<div class="grid-one-column border-all">
						<h4>IVA 12%</h4>
					</div>
					<div class="grid-one-column border-all">
						<h4>XXX</h4>
					</div>
					
					<div class="grid-one-column border-all">
						<h4>VALOR TOTAL</h4>
					</div>
					<div class="grid-one-column border-all">
						<h4>XXX</h4>
					</div>
				</div>
			</div>
			
		
	</div>
	
	
	
</body>
	

</html>