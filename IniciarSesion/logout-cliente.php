<?php
	include('../configuracion-cliente.php');
	unset($_SESSION['cliente_session']);
	if(isset($_COOKIE[session_name()]))
	{
		setcookie(session_name(),' ',time()-4200,'/');
	}
	
	if(session_destroy())
	{
		header("Location:".ROOTURL);
	}
?>