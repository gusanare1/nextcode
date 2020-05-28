<?php
namespace Validador;

class Validar
{
	
	public function validarVacio($nombre,$valor)
	{
		$message = array();
		if(!isset($valor)){
			$message[] = "$nombre no debe estar vacio";
		}
			
		if(count($message)>0)
			return $message;
		else
			return null;
	}
	
	public function validarArray($arr_)
	{
		$message = [];
		foreach($arr_ as $key=>$value)
		{
			$key = str_replace(":","",$key);
			$key = str_replace("_"," ",$key);
			$key = ucwords($key);
			$tmp = $this->validarVacio($key, $value);
			if($tmp != null)
				$message[] = $tmp;
			if(! preg_match("/^[a-zA-Z0-9\s\.,:]*$/",$value) )
			{
				$message[] = "$key NO valido";
			}
		}
		return $message;
	}
}

?>