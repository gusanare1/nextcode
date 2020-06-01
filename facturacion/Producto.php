<?php
class Producto
{
	public $nombre = "";
	public $id;
	public $cantidad; //Solo en ventas, (no en base)....

	public function __construct($nombre, $cantidad, $precio_unitario)
	{
		//conexion a base y traemos el id 

		$this->nombre = $nombre;
		$this->cantidad = $cantidad;
		$this->precio_unitario = $precio_unitario;
		
		include('conexion.php');
		$data = array(":nombre" => $nombre);
		$query = "SELECT id FROM producto where nombre=:nombre";
		$statement = $connect->prepare($query);
		$statement->execute($data);
		$result = $statement->fetch();
		$this->id = $result["id"];
	}
}

?>