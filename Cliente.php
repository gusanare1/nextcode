<?php
	class Cliente
	{
		public $id; //
		public $nombre;
		public $cedula;
		public function __construct($cedula)
		{
			include("conexion.php");
			//GET ID CLIENTE
			$this->cedula = $cedula;
			$this->getCliente();
		}
		
		private function getCliente()
		{
			include('conexion.php');
			$data = array(
			':idenitificacion' => $this->cedula,
			);
			$query = "SELECT id, nombre, identificacion from cliente where identificacion = :idenitificacion";
			$statement = $connect->prepare($query);
			$statement->execute($data);
			$result = $statement->fetch();
			//echo "$query";
			//print_r($result);
			$this->nombre = $result["nombre"];
			$this->cedula = $result["identificacion"];
			$this->id = $result["id"];
			
			
		}
	}
?>