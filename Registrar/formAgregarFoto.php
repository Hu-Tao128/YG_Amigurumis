<h2>Crea una cuenta de YG</h2>
<?php
	$IDUsuarioCliente = (isset($_GET['IDUsuario'])) ? $_GET['IDUsuario'] : null;
	
	$datosUsuarioCliente = obtenerDatosUsuarioCliente($IDUsuarioCliente);
	
		if($datosUsuarioCliente!=null)
		{	
				$IDUsuarioCliente = $datosUsuarioCliente['IDUsuarioCliente'];
				$FotoPerfil = $datosUsuarioCliente['FotoPerfil'];
                $Nombre = $datosUsuarioCliente['Nombre'];
                $NombreUsuarioCliente = $datosUsuarioCliente['NombreUsuarioCliente'];
		}
?>	
<center>
	<form name="frmAgregarFoto" id="frmAgregarFoto" action="Registrar/subirFotoPerfil.php" method="POST" >
		<input type="hidden" id="IDRegistrarPerfil" name="" value="<?=$IDUsuarioCliente?>" />

        <h2>Crea un usuario</h2>
        
        <center><img src="<?=$FotoPerfil?>" height="100px" width="100px" style="object-fit:cover; border-radius: 90px 90px 90px 90px;"/>
            <br>
            <label><?=$NombreUsuarioCliente?></label>
        </center>
        
        <fieldset><legend><?=$Nombre?> sube una foto para personalizar tu cuenta</legend>
            <input type="file" name="imgFotoPerfil" id="imgFotoPerfil" accept="image/*" /></br>
        </fieldset><br/>

        <div class="action-btn-container" >
            <div class="action-btn" >
                <input type="submit" name="btnRegistrarPerfil" id="btnRegistrarPerfil" value="Crear cuenta" />
            </div>
        </div>				
	</form>
</center>