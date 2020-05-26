<?php
	session_start();
	
	include('../conexion.php');
	$form_data = json_decode(file_get_contents("php://input"));
	$message = '';

	if($form_data->action == 'mantenimiento_configuracion_get')
	{
		
		$data = array();			
		$query = "SELECT * FROM configuracion";
		$statement = $connect->prepare($query);
		$statement->execute($data);
		$result = $statement->fetchAll();
		$row = $result[0]; //One configuration
		{
			$output[] = $row;
		}
	}
	
	if($form_data->action == 'mantenimiento_configuracion_put')
	{
		$data = array(
			':establecimiento'	=>	$form_data->establecimiento,
			':punto_emision'	=>	$form_data->punto_emision,
			':sec_factura'		=>	$form_data->sec_factura,
			':id'				=>	$form_data->id
		);			
		$query = "update configuracion set establecimiento=:establecimiento, punto_emision=:punto_emision, sec_factura=:sec_factura where id=:id";
		$statement = $connect->prepare($query);
		if($statement->execute($data))
		{
			$output["message"] = "Insercion exitosa";
			$output["sucess"] = true;
		}
	}
	
	
	if($form_data->action == 'mantenimiento_clientes_get')
	{
		$data = array(
		);			
		$query = "select id, identificacion, nombre, apellido, telefono, emision from cliente";
		$statement = $connect->prepare($query);
		$statement->execute($data);
		$result = $statement->fetchAll();
		$output["resultado"] = $result;
	}
	
	
	
	if($form_data->action == 'mantenimiento_cliente_fetch_single_data')
	{
		$data = array(
			':id' => $form_data->id
		);			
		$query = "select id, identificacion, nombre, apellido, telefono, emision from cliente where id=:id";
		$statement = $connect->prepare($query);
		$statement->execute($data);
		$result = $statement->fetchAll();
		$output["cliente"] = $result;
	}
	
	
	
	$message = [];
	if($form_data->action == 'mantenimiento_clientes_put')
	{
		if(isset($form_data->cliente_identificacion))
		{
				$message[] = "Cedula / RUC no debe ser vacio";
		}
		if(isset($form_data->cliente_nombre))
		{
				$message[] = "Nombre no debe ser vacio";				
		}
		if(isset($form_data->cliente_apellido))
		{
				$message[] = "Apellido no debe ser vacio";				
		}
		if(count($message)==0)
		{
			if($form_data->subaction == 'Crear')
			{
				$data = array(
					':cliente_identificacion'	=>	$form_data->cliente_identificacion,
					':cliente_nombre'	=>	$form_data->cliente_nombre,
					':cliente_apellido'		=>	$form_data->cliente_apellido,
					':cliente_telefono'				=>	$form_data->cliente_telefono,
					':cliente_fecha_emision' =>		date('Y/m/d')
				);			
				$query = "insert into cliente (identificacion, nombre, apellido, telefono, emision) values (:cliente_identificacion, :cliente_nombre , :cliente_apellido , :cliente_telefono , :cliente_fecha_emision)";
				$statement = $connect->prepare($query);
				if($statement->execute($data))
				{
					$output["message"] = "Insercion exitosa";
					$output["sucess"] = true;
				}
			}
			if($form_data->subaction == 'Editar')
			{
				$data = array(
					':cliente_id'	=> 	$form_data->cliente_id,
					':cliente_identificacion'	=>	$form_data->cliente_identificacion,
					':cliente_nombre'	=>	$form_data->cliente_nombre,
					':cliente_apellido'		=>	$form_data->cliente_apellido,
					':cliente_telefono'				=>	$form_data->cliente_telefono
				);			
				$query = "update cliente set identificacion =  :cliente_identificacion, nombre=:cliente_nombre , apellido=:cliente_apellido , telefono=:cliente_telefono where id=:cliente_id";
				$statement = $connect->prepare($query);
				if($statement->execute($data))
				{
					$output["message"] = "Update exitosa";
					$output["sucess"] = true;
				}
			}
		}
		else
		{
			$output["message"] = implode("; ",$message);
		}
	}
	
	
	
echo json_encode($output);
?>
