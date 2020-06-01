<?php
	class DetalleFactura
	{
		public $id_factura;
		public $id_producto;
		public $cantidad;
		public $precio_unitario;

		public function __construct($id_factura, $id_producto, $cantidad, $precio_unitario)
		{
			$this->id_factura = $id_factura;
			$this->id_producto = $id_producto;
			$this->cantidad = $cantidad;
			$this->precio_unitario = $precio_unitario;
			
		}
		
		public function save()
		{
			include('conexion.php');
			$data = array(
			':id_factura' => $this->id_factura,
			':id_producto' => $this->id_producto,
			':cantidad' => $this->cantidad,
			':precio_unitario' => $this->precio_unitario,
			);
			$query = "INSERT INTO factura_detalle (idFactura, idProducto, cantidad, p_unitario) values (:id_factura, :id_producto, :cantidad, :precio_unitario)";
			$statement = $connect->prepare($query);
			if($statement->execute($data))
				return "Detalle factura Exito";
			else
				return "Dealle factura No exitoso";
			// $statement->execute($data);
			// print_r($statement->errorInfo());
		}
	}
?>