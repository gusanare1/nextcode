<?php
	include('conexion.php');			
			
	$username = "admin";
	$password = "admin";
	$mail = "nareagustavo@yahoo.com";
	$idRol = 1;
	
	$data = array(
		':username'		=>	$username,
		':password'		=>	md5($password),
		':mail'			=>  $mail,
		':idRol'		=> 	$idRol
	);
	$query = "
	INSERT INTO usuario
		(username, password, mail, idRol) VALUES 
		(:username, :password, :mail, :idRol)
	";
	$statement = $connect->prepare($query);
	if($statement->execute($data))
	{
		$message = 'Data Inserted';
	}
	else
	{
		$message = "Datos NO se insertaron";
	}
	
	echo $message;
	
?>