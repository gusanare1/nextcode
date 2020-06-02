<?php
include("Empresa.php");
require_once("facturacion/Factura.php");
session_start();
$isId = false;
if(!isset($_SESSION["username"]))
{
	$_SESSION["error"]="No permitido";
	header('Location: error.php');
}
else{
	
$empresa = new Empresa();
$factura = new Factura("principal");
$isId = isset($_GET["id"]);

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
		
		
		<script src="facturacion/js/factura_js.js"></script>	
	
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>

	
		<style>
		
		
		input{
			border-radius: 10px;
		}
		
		
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
				border: 2px solid #8de00c;
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
			
			.row_valor_total{
				border-bottom: 1px solid black;
				background-color: darkseagreen;
			}
			
			.valores_facturar{
				grid-template-columns: 18em auto;
				right: 0;
				position: absolute;
			}
			
		</style>
	</head>



<body ng-app="app" ng-controller="facturacion" id="exportthis">
	
	
	<div class="grid-container-header">
		
		<div class="grid-container-header-left">
			<div class="grid-one-column center-text ">
				<div class="fondo">
					<h2><?php echo $empresa->nombre; ?> </h2>
				</div>
			</div>
			
			<div class="grid-one-column ">
				<h4 class="center-text"> <?php echo $empresa->dueno; ?> </h4>
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
					<h4> <?php echo $empresa->ruc; ?>
				</div>
			</div>
			
			<div class="grid-container-one-column">
			<div class="grid-two-columns">
				<h3 class="center-text">FACTURA</h3>
			</div>
			<div class="grid-one-column">
				<h4 class="center-text" ng-if="!show_secuencia_inicial" >No. <?php if(!$isId) echo $factura->secuencia;?></h4>
				<h4 class="center-text" ng-if="show_secuencia_inicial">No. {{("000-00000-00-00"+factura_secuencia).slice(-12)}}</h4>
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
	
	
	
	
	<div id="myModal" class="modal in" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Busqueda {{clase}}</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<div>
				<input type="text" placeholder="Busqueda {{clase}}" ng-model="buscar_texto" style="height:2em;">
			</div>
			
			<div>
				<select ng-model="opciones_busqueda" size="8" >
					<option ng-repeat="i in lista | filter:{nombre:buscar_texto} | orderBy:orderProperty" value="{{i.nombre}}">{{i.nombre}}</option>
				</select>
			</div>
			
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-primary" ng-click="seleccionar(clase)">Seleccionar</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>
	
	
	
	

	
	<div class="espaciado">
	
		<div class="grid-container-four-columns">
			<div class="grid-one-column">
				<h4>Sr.(es): </h4>
			</div>
			<div class="grid-one-column"> 
				<input type="text" ng-click="buscar('Cliente','nombre')"  ng-disabled='c_nombre_checked' placeholder="Nombre del cliente" ng-model="cliente_nombre" ng-init="c_nombre_checked=false;">
			</div>
			
			<div class="grid-one-column"> 
				<h4>R.U.C.: </h4>
			</div>
			
			<div class="grid-one-column"> 
				<input type:"text" placeholder="C.I." ng-click="buscar('Cliente','cedula')" ng-model="cliente_ci" ng-disabled="c_ci_checked">
			</div>
		</div>
	
		<div class="espaciado-interior"/>
	
		<div class="grid-container-four-columns">
			<div class="grid-one-column">
				<h4>FECHA EMISION: </h4>
			</div>
			<div class="grid-one-column"> 
				<input type="date" name="" placeholder="Fecha de Emision" mg-model="fecha_factura" id="fecha_factura">
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
		
		<div class="grid-container-four-columns-detalles-factura" ng-repeat='p in productos'>
		
		
			<div class="grid-one-column" >
				<input type="number" placeholder="Cantidad" ng-click="buscar_cambios()" ng-keyup="buscar_cambios()" min="1" id={{p.cant}} value="1" ng-model="cantidad">
			</div>
			
			<div id class="grid-one-column"> 
				<input type="text" ng-click="buscar('Producto', p.id )" placeholder="Descripcion" id={{p.d_desc}} value=""></input>
			</div>
		
			<div class="grid-one-column">
				<input type="number" step="0.01" id={{p.id_desc}} placeholder="Precio Unitario" ng-click="buscar_cambios()" ng-keyup="buscar_cambios()" min="0.01" >
			</div>
			
			<div class="grid-one-column">
				<input type="number" step="0.01" id={{p.total}} placeholder="Total" min="0.01">
			</div>
		</div>

	</div>
	
	
	<div class="container-pago">
		
			
			
			
			<div class="subcontainer-pago-derecho">
				<div class="grid-container-two-columns valores_facturar">
					<div class="grid-one-column">
						<h4>SubTotal 12% IVA</h4>
					</div>
					<div class="grid-one-column ">
						<h4>{{subtotal_12_iva}}</h4>
					</div>
					
					<div class="grid-one-column">
						<h4>Descuento 1%</h4>
					</div>
					<div class="grid-one-column">
						<h4>{{descuento}}</h4>
					</div>
					
					<div class="grid-one-columnl">
						<h4>Sub Total</h4>
					</div>
					<div class="grid-one-column" >
						<h4>{{subtotal}}</h4>
					</div>
					
					<div class="grid-one-column">
						<h4>IVA 12%</h4>
					</div>
					<div class="grid-one-column">
						<h4>{{iva_12}}</h4>
					</div>
					
					<div class="grid-one-column row_valor_total">
						<h4>VALOR TOTAL</h4>
					</div>
					<div class="grid-one-column row_valor_total">
						<h4>{{factura_total}}</h4>
					</div>
				</div>
			</div>
			
		
	</div>
	
<button ng-click="finalizar_facturacion()" class="btn btn-secundary btn-info" ng-disabled="btn_guardar" >Guardar Factura </button>
	
<button ng-click="imprimir_facturacion()" class="btn btn-secundary btn-info" ng-disabled="btn_imprimir" >Imprimir Factura </button>
</body>
<br>
* Debe guardar la factura <br>
Primero

<?php
//Reimpresion
?>
	
</html>



