<?php
	session_start();
	
	include('../conexion.php');
	$form_data = json_decode(file_get_contents("php://input"));
	$message = '';

	if($form_data->action == 'login')
	{
		if(empty($form_data->username))
		{
			$error[] = "Usuario es requerido";
			$output=false;
		}
		else
		{
			$pwd = $form_data->password;
			$data = array(
						':username'	=>	$form_data->username,
						':password'	=>	md5($pwd)				
						);			
			$query = "SELECT username, r.nombre as rol FROM usuario u, rol r WHERE u.idRol = r.id and username=:username and password=:password"; //username unique
			$statement = $connect->prepare($query);
			$statement->execute($data);
			$result = $statement->fetchAll();
			if(count($result)>0)
			{
				$error[] = "";
				$output = true; 
				//$_SESSION["rol"] = $result[0]['rol'];
				$_SESSION["username"] = $result[0]['username'];
			}
			else
			{
				$output = false;
				$error[] = "Usuario no encontrado";
			}
		}
	}
		
		$output = array(
				'error'		=>	$error,
				'sucess' 	=> 	$output
			);
		
	
echo json_encode($output);

	

?>
