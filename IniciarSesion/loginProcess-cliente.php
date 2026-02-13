<?php
	require_once '../configuracion-cliente.php';
	$db_host = DBHOST;
	$db_name = DBNAME;
	$db_NombreUsuarioCliente = DBUSER;
	$db_pass = DBPASSWD;
	require_once(HEADERCLIENTE);
	
	try{		
		$db_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_NombreUsuarioCliente,$db_pass);
		
		$db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}

	if(isset($_POST['btnLogin']))
	{
		$NombreUsuarioCliente = trim($_POST['txtNombreUsuario']);
		$ContrasenaCliente = trim($_POST['txtContrasena']);
		
		try
		{			
			$stmt = $db_con->prepare("SELECT * FROM usuario_cliente WHERE NombreUsuarioCliente='".$NombreUsuarioCliente."'");
		
			$stmt->execute();
			//print_r($stmt);
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();
			//print_r($row);
			if($count==0)//no existe usuario
				$DBContrasenaCliente ="";
			else
				$DBContrasenaCliente =$row['ContrasenaCliente'];
			//exit;
			
			if($DBContrasenaCliente==$ContrasenaCliente){				
				$_SESSION['cliente_session'] = $row['IDUsuario'];
			?>
				<div class="loader">
					<div class="load"></div>
				</div>
				<meta http-equiv="refresh" content="0;url=<?=ROOTURL?>">
			<?php }
			else{?>
				</br>
				<center>
					<p>Upss... usuario o contrase&ntilde;a incorrecto</p>
					<input type="button" value="Volver a intentar" onclick=self.location="<?=ROOTURL?>?accion=formLogin" />
				</center>

<?php		}
				
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
include_once(FOOTERCLIENTE);
?>