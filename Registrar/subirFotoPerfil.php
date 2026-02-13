<?php
include "../configuracion.php";
include_once('../MySqli_conexionDB.php');

require_once(HEADERCLIENTE);

if (isset($_POST['btnRegistrarPerfil'])) {
    $uploadfile = $_FILES["imgFotoPerfil"]["tmp_name"];
    $folderRuta = "../admin/UsuariosClientes/fotos/";
	$tipoImagen = explode("/",$_FILES["imgFotoPerfil"]["type"]);
	$IDUsuarioCliente = $_REQUEST['IDRegistrarPerfil'];
	$NombrePerfil = $IDUsuarioCliente.".".$tipoImagen[1];
    //var_dump($_REQUEST);
    if (! is_writable($folderRuta) || ! is_dir($folderRuta)) 
	{ 
?>
		<center>
			<h2 class="title">Upps!... Ocurri$oacute; un error al intentar registrarte</h2>
			<?=mysqli_error($miConexion)?>
			<input type="button" value="Volver a intentar" onclick=self.location="<?=ROOTURL?>?accion=formUsuario" />
            o
			<input type="button" value="Regresar al inicio" onclick=self.location="<?=ROOTURL?>" />
		</center>
<?php
    }
	
	$query = "SELECT IDUsuario, FotoPerfil FROM usuario_cliente WHERE IDUsuario='$IDUsuarioCliente'";
	
	if (!$result = mysqli_query($miConexion, $query))
        exit(mysqli_error($miConexion));
    
	if(mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			if(file_exists(DOCROOT."admin/UsuariosClientes/fotos/".$row['FotoPerfil']) && $row['FotoPerfil']<>""){
				unlink(DOCROOT."admin/UsuariosClientes/fotos/".$row['FotoPerfil'])or die("Couldn't delete file");
			}
		}
	}	
	
    if (move_uploaded_file($_FILES["imgFotoPerfil"]["tmp_name"], $folderRuta . $NombrePerfil)) {//se guarda la imagen seleciona
        echo '<img src="'.IMAGES_ORIGEN."".$folderRuta."".$NombrePerfil.'">';//se muestra la imagen guardada
		$query = "UPDATE usuario_cliente SET FotoPerfil='$NombrePerfil' WHERE IDUsuario='$IDUsuarioCliente'";//se guarda el nombre de la imagen
		if (!$result = mysqli_query($miConexion, $query))
			exit(mysqli_error($miConexion));
    }
?>	
	<center>
		<br><h2>Imagen Guardada!!!</h2>
		<br><input type="button" value="Inicia sesi&oacute;n para continuar." onclick=self.location="<?=ROOTURL?>?accion=formLogin" /> 
    </center>	
<?php   	
}
require_once(FOOTERCLIENTE);
?>