<?php
use DatosPersonales\Usuario;

session_start();
if(isset($_SESSION["username"]))
{
	require_once("Usuario.php");
	$nombre_usuario = $_SESSION["username"];
	$user = new DatosPersonales\Usuario($nombre_usuario);
	?> 
	<div class="">
		<span> 
			<h4> Bienvenido <?php echo $user->username; ?> </h4>
		</span>
		<span>
			<h4> <a href="salir.php">Salir</a> </h4>
		</span>
	</div>
	<?php
	
	include_once('dashboard.php');
	
}
else
{
	$_SESSION["error"]="No permitido";
	header('Location: error.php');
	

}
?>