<?php
include('../configuracion-cliente.php');
include('../MySqli_conexionDB.php');
include(HEADERCLIENTE);

$Nombre = $_POST['txtNombre'];
$APaterno = $_POST['txtAPaterno'];
$AMaterno = $_POST['txtAMaterno'];
$Telefono = $_POST['txtTelefono'];
$Correo = $_POST['txtCorreo'];


$query = "UPDATE usuario_cliente SET Nombre='$Nombre',APaterno ='$APaterno', AMaterno ='$AMaterno', Telefono='$Telefono', Correo='$Correo' WHERE IDUsuario=$IDUsuarioCliente";


if(!$resultado = mysqli_query($miConexion,$query))
		{ ?>
			<center>	
				<h3>Upps... Ocurri&oacute; un error al intentar editar tu informaci&oacute;n</h3>
				<h3><?=mysqli_error($miconexion);?></h3>
				<input type="button" value="Volver a la p&aacute;gina" onclick=self.location="<?=ROOTURL?>" />
			</center>	
				
<?php	}else{ ?>
				<div class="loader">
					<div class="load"></div>
				</div>
				<meta http-equiv="refresh" content="0;url=<?=ROOTURL?>?accion=perfil">
<?php		}	?>
<?php		include(FOOTERCLIENTE);	?>