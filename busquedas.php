<?php
	require('facturacion/Factura.php');
	require('facturacion/Producto.php');
	include('facturacion/DetalleFactura.php');
	require('Cliente.php');
	
	require('Empresa.php');
	
	include('conexion.php');
	$form_data = json_decode(file_get_contents("php://input"));
	
	$message = '';
	$output["message"] = "Incorrecto";
	
	if($form_data->action == 'Cliente')
	{
		if($form_data->subaction == 'nombre')
			$query = "SELECT nombre FROM cliente";
		else if($form_data->subaction == 'cedula')
			$query = "SELECT identificacion as nombre FROM cliente";
		
		$data = array();
		$statement = $connect->prepare($query);
		$statement->execute($data);
		$result = $statement->fetchAll();
		$output["message"] = "Correcto";
		$output["resultado"] = $result;
		
		
	}
	if($form_data->action == 'Producto')
	{
		$data = array();
		$query = "SELECT nombre FROM producto";
		$statement = $connect->prepare($query);
		$statement->execute($data);
		$result = $statement->fetchAll();
		$output["message"] = "Correcto";
		$output["resultado"] = $result;
	}
	
	if($form_data->action == 'get_cliente')
	{
		if($form_data->subaction == 'nombre')
			$query = "SELECT nombre, identificacion FROM cliente where nombre = :texto";
		else if($form_data->subaction == 'cedula')
			$query = "SELECT nombre, identificacion FROM cliente where identificacion = :texto";
		$data = array(
		':texto' => $form_data->seleccion,
		);
		$statement = $connect->prepare($query);
		$statement->execute($data);
		$result = $statement->fetch();
		$output["message"] = "Correcto";
		$output["resultado"] = $result;	
	}
	
	
	if($form_data->action == 'get_producto')
	{
		$data = array(
		':nombre' => $form_data->seleccion,
		);
		$query = "SELECT nombre, precio_unitario FROM producto where nombre = :nombre";
		$statement = $connect->prepare($query);
		$statement->execute($data);
		$result = $statement->fetch();
		$output["message"] = "Correcto";
		$output["resultado"] = $result;	
	}
	
	
	if($form_data->action == 'guardar_factura')
	{
		$arr_factura = $form_data->factura;
		$datos_productos = $arr_factura[0]->Productos;
		$productos = [];
	
		//print_r($datos);
	///////////////////////////////////
		//$arr_factura[0]->Productos[1][0]
		//print_r(count($arr_factura[0]->Productos));
	//////////////////////////////////
		//print_r($productos);
		$datos_factura = $arr_factura[1]->Datos;
		$fecha_emision = $datos_factura->fecha_emision;
		//print_r($datos_factura);
		
		$empresa = new Empresa();
		$idEmpresa = $empresa->id;
		//print_r($empresa);

		$cliente = new Cliente($datos_factura->cedula);
		$idCliente = $cliente->id;
		//print_r($cliente);
		$factura_sec = new Factura("principal");
		$sec_factura =  $factura_sec->secuencia;
		
		$output["secuencia"] = $sec_factura;
		
		
		$sec_factura = str_replace("-",'',$sec_factura);
		$factura = new Factura_BBDD($idEmpresa, $idCliente, $sec_factura, $fecha_emision);
		$idfactura = $sec_factura;
		
		
		
		foreach($datos_productos as $producto_row)
		{
			//echo("********");
			//print_r($producto_row[0]);
			$cantidad = $producto_row[0]->cantidad;
			$nombre = $producto_row[0]->descripcion;
			$precio_unitario = $producto_row[0]->precio_unitario;
			
			$producto = new Producto($nombre, $cantidad, $precio_unitario);
			$idproducto = $producto->id;
			//print_r($producto);
			$detalle_factura = new DetalleFactura($idfactura, $idproducto, $cantidad, $precio_unitario);
			$message_detalle_save = $detalle_factura->save();
			$output["message"] = $message_detalle_save;
			//array_push($productos, $producto);
			//$nombre_producto = $producto["descripcion"]; //Descripcion = nombre en base
			//$producto = new Producto($nombre_producto);
		}
		

		
		//print_r(count($arr_factura[0]->Productos));
	}
	
	
	
	if($form_data->action="consulta_factura")
	{
		$data = array(
		);
		$query = "SELECT c.identificacion, c.nombre, no_factura, fecha_emision FROM cliente c, factura f WHERE f.idcliente = c.id";
		$statement = $connect->prepare($query);
		$statement->execute($data);
		$result = $statement->fetchAll();
		$output["message"] = "Correcto";
		$output["facturas"] = $result;	
	}
	
	
	
	echo json_encode($output);
	
?>