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
	
	
echo json_encode($output);
?>
