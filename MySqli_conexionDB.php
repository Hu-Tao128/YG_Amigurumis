<?php
$miConexion = new mysqli(DBHOST,DBUSER,DBPASSWD,DBNAME);

if($miConexion->connect_error)
{
	die("Conexión fallida".$miConexion->connect_error);
}

$query = "SET NAMES 'utf8'";

if(!$resultado= mysqli_query($miConexion,$query))
{
	exit(mysqli_error($miConexion));
}

?>