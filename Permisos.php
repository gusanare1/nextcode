<?php
namespace DatosPersonales;
/**
* Permisos de usuario para navegacion entre paginas web
*/
 class Permisos
{
	

	/**
	* Lista de paginas disponibles en el servidor  (1 pagina = 1 servicio)
	* Depercated. (A futuro tener en base las paginas en el mysql, para optimizar añadicion de paginas nuevas)
	* @see: Future. Ver route 
	*/
	const folder_mantenimiento = "mantenimiento/";
	const folder_producto = "producto/";
	public static 	$navegador_url = ["mantenimiento_configuracion"=>self::folder_mantenimiento."mantenimiento_configuracion.html", 
									"mantenimiento_clientes"=>self::folder_mantenimiento."mantenimiento_clientes.html", 
									"mantenimiento_empresa"=>self::folder_mantenimiento."mantenimiento_empresa.html",
									"mantenimiento_productos"=>self::folder_producto."mantenimiento_productos.html",
									];
	
	public static 	$navegador_titulo = ["mantenimiento_configuracion"=>"Mantenimiento de Configuracion", 
									"mantenimiento_clientes"=>"Mantenimiento de Clientes", 
									"mantenimiento_empresa"=>"Mantenimiento de la Empresa",
									"mantenimiento_productos"=>"Mantenimiento de Producto"];
	private $navegador_paginas = [	"admin"=>	
													["mantenimiento_configuracion","mantenimiento_clientes","mantenimiento_empresa","mantenimiento_productos"],
									"mantenimiento"=>
													["mantenimiento_configuracion","mantenimiento_clientes","mantenimiento_empresa"],
									];
	/**
	* Persona a loguear
	*/
	private $usuario;
	/**
	*Set de navegador_paginas_permitidas
	*/
	private $navegador_paginas_permitidas=[]; 
	private $connect; 
	
	public function get_paginas_permitidas()
	{
		return $this->navegador_paginas_permitidas;
	}
	
	function __construct($usuario)
	{
		include('conexion.php');
		$this->connect = $connect;
		$this->usuario = $usuario;
		$this->fill_data($usuario);
	}
	
	
	/**
	* Get the role de un usuario
	*/
	private function get_rol($username)
	{	
		$data = array(
				':username'	=>	$username,
					);			
		$query = "SELECT r.nombre FROM usuario u, rol r WHERE u.idRol = r.id and username=:username"; //username unique
		$statement = $this->connect->prepare($query);
		$statement->execute($data);
		$result = $statement->fetchAll();
		//print_r($result);
		return $result[0]["nombre"];
	}
	
	private function fill_data($username)
	{
		$role=$this->get_rol($username);
		$arr=$this->navegador_paginas[$role];
		foreach($arr as $row)
		{
			$this->navegador_paginas_permitidas[] = $row;
			//print("<br>".$row);
		}
	}
	
}
?>