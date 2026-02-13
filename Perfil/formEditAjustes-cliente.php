<?php
require_once 'funciones-cliente.php';

$IDUsuarioCliente = (isset($_SESSION['cliente_session'])) ? $_SESSION['cliente_session'] : null;
$datosCliente = obtenerDatosUsuarioCliente($IDUsuarioCliente);

$IDCliente = (isset($_GET['IDUsuarioCliente'])) ? $_GET['IDUsuarioCliente'] : null;
$datosFotoPerfil = obtenerDatosUsuarioCliente($IDUsuarioCliente);

if($datosFotoPerfil!=null){
	$Perfil=$datosFotoPerfil['mostrarPerfil'];
	$Nombre=$datosFotoPerfil['Nombre'];
	$APaterno=$datosFotoPerfil['APaterno'];
}	
?>

<form name="frmEditCliente" id="frmEditCliente" action="Perfil/updateAjustes-cliente.php" method="POST" >
	<div class="tab-registrar">
		<div class="login-head" >
			<p class="titulo-carrito"><img class="title-icon" src="<?=IMG?>Iconos-Titulos/mi-info-title.svg"/>Mi Informaci&oacute;n</p>
			<p class="subtitulo-carrito">Edita tu informaci&oacute;n.</p>
		</div>
		<div class="tab-form-registrar" >
			<div class="input-registrar">
				<label class="form-label-registrar" >Nombre</label>
				<input class="form-input-registrar" type="text" name="txtNombre" id="txtNombre" value="<?=$datosCliente['Nombre']?>" required />
			</div>
			<div class="input-registrar">
				<label class="form-label-registrar" >Apellido Paterno</label>
				<input class="form-input-registrar" type="text" name="txtAPaterno" id="txtAPaterno" value="<?=$datosCliente['APaterno']?>" required />
			</div>
			<div class="input-registrar">
				<label class="form-label-registrar" >Apellido Materno</label>
				<input class="form-input-registrar" type="text" name="txtAMaterno" id="txtAMaterno" value="<?=$datosCliente['AMaterno']?>" required/>
			</div>
			<div class="input-registrar">
				<label class="form-label-registrar" >Telefono</label>
				<input class="form-input-registrar" type="text" pattern="[0-9]{10}" name="txtTelefono" id="txtTelefono" value="<?=$datosCliente['Telefono']?>" />
			</div>
			<div class="input-registrar">
				<label class="form-label-registrar" >Correo</label>
				<input class="form-input-registrar" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="txtCorreo" id="txtCorreo" value="<?=$datosCliente['Correo']?>" />
			</div>
			
			<div class="f-l-btns p-edit-btns" >
				<div class="cta-btn" >
					<input type="button" class="c-c-btn" onclick=self.location="<?=ROOTURL?>?accion=perfil" value="Cancelar">
					<input type="submit" class="c-btn btn-crear" name="btnModificarCliente" id="btnModificarCliente" value="Guardar" />
				</div>
			</div>
		</div>
	</div>
</form>