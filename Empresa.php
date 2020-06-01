<?php
	
	class Empresa
	{
		public $id;
		public $nombre;
		public $razon_social;
		public $direccion;
		public $ruc;
		public $aut_sri="1234567890";
		public $dueno ="";
		
		public function __construct()
		{
			$data = array(
			);		
			include('conexion.php');
			$query = "select id, nombre, razon_social, direccion, ruc,aut_sri, dueno from empresa";
			$statement = $connect->prepare($query);
			$statement->execute($data);
			$result = $statement->fetchAll();
			
			$this->id = $result[0]["id"];
			$this->nombre = $result[0]["nombre"];
			$this->razon_social = $result[0]["razon_social"];
			$this->direccion = $result[0]["direccion"];
			$this->ruc = $result[0]["ruc"];
			$this->aut_sri = $result[0]["aut_sri"];
			$this->dueno =  $result[0]["dueno"];
		}
		
		
	}

	
?>