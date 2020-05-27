<?php
require_once("../Encriptacion.php");
use Encriptar\Constantes as Constantes;
//require_once("../Encriptacion.php");
	session_start(); //Para evitar el uso de crud externos...
	
	//encript parte

	//$ivlen = openssl_cipher_iv_length($method);
	//$iv = openssl_random_pseudo_bytes($ivlen);
	//$encrypted_message = openssl_encrypt($message_to_encrypt, $method, $secret_key, 0, $iv);

	//$decrypted_message = openssl_decrypt($encrypted_message, $method, $secret_key, 0, $iv);
	
	if(isset($_SESSION["username"])) //Cambio de session para uso en otros  modulos
	{
		include('../conexion.php');
		$form_data = json_decode(file_get_contents("php://input"));
		$message = '';
		if($form_data->action == 'mantenimiento_productos_get')
		{
			$data = array();			
			$query = "SELECT l.cantidad_disponible , p.id, p.nombre, p.codigo, p.descripcion, p.precio_unitario FROM producto p, lote l where l.idProducto = p.id";
			$statement = $connect->prepare($query);
			$statement->execute($data);
			//$output["productos"] = $statement->fetchAll();
			$result = $statement->fetchAll();
			$rows=array();
			foreach ($result as $row)
			{
				$row["id"] = openssl_encrypt($row["id"], Constantes::$method, Constantes::$secret_key,0,Constantes::$IV_);
				array_push($rows,$row);
			}
			$output["productos"] = $rows;
			$output["message"] = "Productos Totales";
			$output["sucess"]=true;
		}
		
		if($form_data->action == 'mantenimiento_productos_get_producto') //fetch one producto
		{
			$id_ = openssl_decrypt($form_data->id, Constantes::$method, Constantes::$secret_key,0,Constantes::$IV_);
			$data = array(':id'=>$id_."");			
			$query = "SELECT l.cantidad_disponible , p.id, p.nombre, p.codigo, p.descripcion, p.precio_unitario FROM producto p, lote l where l.idProducto = p.id and p.id=:id";
			$statement = $connect->prepare($query);
			$statement->execute($data);
			$result = $statement->fetchAll();
			$rows=array();
			foreach ($result as $row)
			{
				$row["id"] = openssl_encrypt($row["id"], Constantes::$method, Constantes::$secret_key,0,Constantes::$IV_);
				array_push($rows,$row);
			}
			$output["productos"] = $rows;
			$output["message"] = "Get producto";
			$output["sucess"]=true;
		}
		
		if($form_data->action == 'mantenimiento_productos_put') //PUT (Crear o modificar)
		{
			$message=[];
			if(!isset($form_data->producto_nombre))
			{
				$message[] = "Nombre no debe ser vacio";
			}
			if(!isset($form_data->producto_codigo))
			{
				$message[] = "Codigo no debe ser vacio";
			}
			if(!isset($form_data->producto_descripcion))
			{
				$message[] = "Descripcion no debe ser vacio";
			}
			if(!isset($form_data->producto_precio_unitario))
			{
				$message[] = "Precio no debe ser vacio";
			}
			
			if(count($message)==0)
			{
				if($form_data->subaction == "Crear")
				{
					$data = array(
					':producto_nombre'=> $form_data->producto_nombre ,
					':producto_codigo'=> $form_data->producto_codigo ,
					':producto_descripcion'=> $form_data->producto_descripcion ,
					':producto_precio_unitario'=> $form_data->producto_precio_unitario 
					);			
					$query = "insert into producto(nombre, codigo, descripcion, precio_unitario) values (:producto_nombre, :producto_codigo, :producto_descripcion, :producto_precio_unitario)";
					
					$statement = $connect->prepare($query);
					if($statement->execute($data))
					{
						$output["message"] = "Producto insertado exitosamente";
						$output["sucess"] = true;
						$last_id = $connect->lastInsertId();
						$data2 = array(
						':lote_id_producto' => $last_id,
						':producto_stock' => $form_data->cantidad_disponible,
						);
						$query2 = "insert into lote (idProducto, cantidad_disponible) values(:lote_id_producto, :producto_stock)";
						$statement = $connect->prepare($query2);
						$statement->execute($data2);
					}
					else{
						$error_arr=$statement->errorInfo(); //["23000",1062,"Duplicate entry '1' for key 'identificacion_UNIQUE'"]
						if($error_arr[1] == "1062") //futore More codigos
							$output["message"] = "Codigo de producto repetido";
						$output["sucess"] = true;
					}
				}
				if($form_data->subaction == "Modificar")
				{
					$id_ = openssl_decrypt($form_data->producto_id, Constantes::$method, Constantes::$secret_key,0,Constantes::$IV_);
					$data = array(
					'producto_id'=>$id_,
					'producto_nombre'=> $form_data->producto_nombre,
					'producto_codigo'=> $form_data->producto_codigo,
					'producto_descripcion'=> $form_data->producto_descripcion,
					'producto_precio_unitario'=> $form_data->producto_precio_unitario,
					);			
					$query = "update producto set nombre=:producto_nombre, codigo=:producto_codigo, descripcion=:producto_descripcion,precio_unitario=:producto_precio_unitario where id=:producto_id";
					$statement = $connect->prepare($query);
					if($statement->execute($data))
					{
						$data2 = array(
						'lote_id_producto'=> $id_,
						'producto_stock'=>$form_data->cantidad_disponible
						);
						$query2 = "update lote set cantidad_disponible=:producto_stock where idProducto=:lote_id_producto";
						$statement = $connect->prepare($query2);
						if($statement->execute($data2))
							$output["message"] = "Cambio exitoso";
						else 
							$output["message"] = "Cambio NO exitoso en lote";
					}
					else{
						$output["message"] = "No se pudo cambiar el producto";
					}
					
				}
				
			}
			else{
					$mensajes = implode(", ", $message);
					$output["message"] = $mensajes;
					$output["productos"] = [];
				}
			
			
			

		}
	}
	else
	{
		$output["message"] = "No permnitido";
		
	}

	echo json_encode($output);
	


?>