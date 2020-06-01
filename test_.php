<?php
use DatosPersonales\Usuario;
use DatosPersonales\Permisos;
use Validador\Validar;
	include("Usuario.php");
	include("Validar.php");
	$usuario = "admin";
	$user = new Usuario("admin");
	
	
	$arr = [":u1"=>"p6", ":u2"=>"Producto,:6"];
	$validar = new Validar();
	$arr_validado = $validar->ValidarArray($arr);
	print_r($arr_validado);

	
	require("Empresa.php");
	$empresa = new Empresa();
	print_r($empresa->nombre);
	
	require("Cliente.php");
	$cliente = new Cliente("43");
	
	

?>