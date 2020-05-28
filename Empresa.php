<?php
	
	class Empresa
	{
		public $nombre;
		public $razon_social;
		public $direccion;
		public $ruc;
		
		public function __construct()
		{
			$data = array(
			);		
			include('conexion.php');
			$query = "select nombre, razon_social, direccion, ruc from empresa";
			$statement = $connect->prepare($query);
			$statement->execute($data);
			$result = $statement->fetchAll();
			$this->nombre = $result[0]["nombre"];
			$this->razon_social = $result[0]["razon_social"];
			$this->direccion = $result[0]["direccion"];
			$this->ruc = $result[0]["ruc"];
			
		
		}
		
		
	}

	
?>