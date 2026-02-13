<?php
require_once('../configuracion-cliente.php');
$IDAmigurumi = $_REQUEST['IDAmigurumi'];
$accion = $_REQUEST['accion'];

if(isset($_SESSION['Carrito'][$IDAmigurumi])){ 
	if($accion=='procesarPago')
	{
		$_SESSION['Carrito'][$IDAmigurumi]['Descuento'] = $_REQUEST['Descuento'];
		$_SESSION['Carrito'][$IDAmigurumi]['Cantidad'] = $_REQUEST['Cantidad'];	
		$ruta = ROOTURL."?accion=personalizarCompra";		
	}
}

ksort($_SESSION['Carrito']);?>

<div class="loader">
	<div class="load"></div>
</div>
<meta http-equiv="refresh" content="0;url=<?=ROOTURL?>?accion=perfil">