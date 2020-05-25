<?php
session_start();


if(isset($_SESSION["username"]))
{
	?> 
	<div class="">
		<span> 
			<h4> Bienvenido <?php echo $_SESSION["username"]; ?> </h4>
		</span>
		<span>
			<h4> <a href="salir.php">Salir</a> </h4>
		</span>
	</div>
	<?php
	require_once('dashboard.html');
	
}
else
{
	$_SESSION["error"]="No permitido";
	include_once('error.php');
	

}
?>