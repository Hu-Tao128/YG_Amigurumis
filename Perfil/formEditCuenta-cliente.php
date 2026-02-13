<?php
require_once 'funciones-cliente.php';

$IDUsuarioCliente = (isset($_SESSION['cliente_session'])) ? $_SESSION['cliente_session'] : null;
$datosCliente = obtenerDatosUsuarioCliente($IDUsuarioCliente);

$datosFotoPerfil = obtenerDatosUsuarioCliente($IDUsuarioCliente);

if($datosFotoPerfil!=null){
	$Perfil=$datosFotoPerfil['mostrarPerfil'];
	$Nombre=$datosFotoPerfil['Nombre'];
	$APaterno=$datosFotoPerfil['APaterno'];
}	
?>

<form name="frmEditCliente" id="frmEditCliente" action="Perfil/accionesCuenta-cliente.php" method="POST" >
	<div class="tab-registrar">
		<div class="login-head" >
			<p class="titulo-carrito"><img class="title-icon" src="<?=IMG?>Iconos-Titulos/mi-cuenta-title.svg"/>Mi Cuenta</p>
			<p class="subtitulo-carrito">Edita tu cuenta. Crea un nuevo nombre de usuario y/o contrase&ntilde;a.</p>
		</div>
		<div class="tab-form-registrar" >
			<div class="input-registrar">
				<label class="form-label-registrar" >Usuario</label>
				<input class="form-input-registrar" type="text" name="txtNombreUsuario" id="txtNombreUsuario" value="<?=$datosCliente['NombreUsuarioCliente']?>" required />
			</div>
			<div class="input-registrar">
				<label class="form-label-registrar" >Contrase&ntilde;a</label>
				<input class="form-input-registrar" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="txtContrasena" id="txtContrasena" value="<?=$datosCliente['ContrasenaCliente']?>" title="Utiliza ocho caracteres como mínimo con una combinación de letras, números y símbolos" required />
			</div>
		</div>
        <label class="form-relink-02 f-r-registrar" >
			<input class="f-r-checkbox" type="checkbox" onclick="showPassword()" >
			<p>Mostrar contrase&ntilde;a</p>
			<script>
				function showPassword(){
					var x = document.getElementById("txtContrasena");

					if(x.type === "password"){
						x.type = "text";
					}else{
						x.type = "password";
					}
				}
			</script>
		</label>
		<div class="f-l-btns p-edit-btns" >
            <div class="cta-btn" >
                <input type="button" class="c-c-btn" onclick=self.location="<?=ROOTURL?>?accion=perfil" value="Cancelar">
                <input type="submit" class="c-btn btn-crear" name="btnModificarCliente" id="btnModificarCliente" value="Guardar" />
            </div>
		</div>
	</div>
</form>