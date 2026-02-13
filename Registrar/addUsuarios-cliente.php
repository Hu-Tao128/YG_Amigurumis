<?php
include('../configuracion-cliente.php');
include('../MySqli_conexionDB.php');
include(HEADERCLIENTE);

$Nombre = $_POST['txtNombre'];
$APaterno = $_POST['txtAPaterno'];
$AMaterno = $_POST['txtAMaterno'];
$FotoPerfil = '0.svg';
$Telefono = $_POST['txtTelefono'];
$Correo = $_POST['txtCorreo'];
$NombreUsuarioCliente = $_POST['txtNombreUsuario'];
$ContrasenaCliente = $_POST['txtContrasena'];

$query = "INSERT INTO usuario_cliente(Nombre,APaterno,AMaterno,FotoPerfil,Telefono,Correo,NombreUsuarioCliente,ContrasenaCliente) VALUES ('$Nombre','$APaterno','$AMaterno','$FotoPerfil','$Telefono','$Correo','$NombreUsuarioCliente','$ContrasenaCliente')";

		if(!$resultado = mysqli_query($miConexion,$query))
		{ ?>
			<div id="registro-exi">
				<p class="titulo-carrito">Hub&oacute; un error con tu registro :(</p>
				<p class="subtitulo-carrito"><?=mysqli_error($miConexion);?></p>
				<div class="cta-btn" >
					<input class="login-btn-link" type="button" value="Volver a la página de inicio" onclick=self.location="<?=ROOTURL?>" />
				</div>
			</div>	
				
<?php	}else{ ?>
			<div id="registro-exi">
				<p class="titulo-carrito">Tu registro fue un exit&oacute;</p>
				<p class="subtitulo-carrito">Inicia sesi&oacute;n para continuar.</p>
				<div class="cta-btn" >
					<input class="login-btn-link" type="button" value="Inicia Sesi&oacute;n" onclick=self.location="<?=ROOTURL?>?accion=formLogin" />
				</div>
			</div>
<?php		}	?>
<?php		include(FOOTERCLIENTE);?>