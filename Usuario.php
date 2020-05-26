<?php
namespace DatosPersonales;
include_once("Permisos.php");

class Usuario
{
	/**
	* Future:: Poner private con set/gets necesarios
	*/
	public $username;
	public $email;
	public $rol;
	public $idRol;
	
	public $paginas_permitidas = [];
	
	private $connect; 
	
	function __construct($username_)
	{
		$this->username = $username_;
		
		
		$permisos = new Permisos($username_);
		$this->paginas_permitidas = $permisos->get_paginas_permitidas();
		include('conexion.php');
		$this->connect = $connect;
		$this->fill_data($username_);

	}
	
	private function fill_data($username)
	{
		$data = array(
				':username'	=>	$username
					);			
		$query = "SELECT u.username, u.mail, r.nombre, r.id FROM usuario u, rol r WHERE u.idRol = r.id and username=:username";
		$statement = $this->connect->prepare($query);
		$statement->execute($data);
		$result = $statement->fetchAll();
		$one = $result[0];
		
		//print_r($one);
		$this->username = $one["username"];
		$this->email = $one["mail"];
		$this->rol = $one["nombre"];
		$this->idRol = $one["id"];
	}
	
}
?>