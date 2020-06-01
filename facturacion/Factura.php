<?php
class Factura
{
	public $id;
	public $nombre = "";
	public $apellido = "";
	public $secuencia = "1244";
	public $autorizacion = "";
	public $detalle_factura;
	private $conexion;
	
	private $idEmpres;
	private $idCliente;
	
	public function __construct($folder)
	{
		if($folder=="principal")
			include("conexion.php");
		else
			include("../conexion.php");
		$this->conexion = $connect;
		
		$this->init_();
	}
	
	private function init_()
	{
		$row = $this->conexion->query("select next_val()")->fetch(); //Fetchall
		$this->secuencia = $row[0];
		
		
		
	}
}

class Factura_BBDD{

	public $detalle_factura;
	public $id;
	public $fecha_emision;
	public $idEmpres;
	public $idCliente;
	
	public $isSave = "";
	public function __construct($idEmpresa, $idCliente, $sequence, $fecha_emision)
	{
		
		$this->idEmpresa = $idEmpresa;
		$this->idCliente = $idCliente;
		$this->id = $sequence;
		
		$this->detalle_factura = [];
		
		$this->save($idEmpresa, $idCliente, $sequence, $fecha_emision);
	}
	
	private function save($idEmpresa, $idCliente, $sequence, $fecha_emision)
	{
		include("conexion.php");
		$data = array(
		':idEmpresa' => $idEmpresa,
		':idCliente' => $idCliente,
		':sequence'  => $sequence,
		':fecha_emision' => $fecha_emision,
		);	
		
		$query = "INSERT INTO factura(idEmpresa, idCliente, no_factura, fecha_emision) values (:idEmpresa, :idCliente, :sequence, :fecha_emision)";
		$statement = $connect->prepare($query);
		$isSave = $statement->execute($data);
			
		
		
	}

	
	
	
}


?>