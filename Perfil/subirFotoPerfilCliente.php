<?php
include "../configuracion-cliente.php";
include_once('../MySqli_conexionDB.php');

require_once(HEADERCLIENTE);

if (isset($_POST['btnCambiarFotoPerfil'])) {
    $uploadfile = $_FILES["changeFotoPerfil"]["tmp_name"];
    $folderRuta = "C:/xampp/htdocs/YG_Amigurumis/admin/UsuariosClientes/fotos/";
	//acuerdate de poner toda la ruta si no guarda
	$tipoImagen = explode("/",$_FILES["changeFotoPerfil"]["type"]);
	$IDUsuarioCliente = $_REQUEST['IDCambioFoto'];
	$NombreFotoPerfil = $IDUsuarioCliente.".".$tipoImagen[1];
    //var_dump($_REQUEST);
    if (! is_writable($folderRuta) || ! is_dir($folderRuta)) 
	{ 
?>
		<center>
			<h2 class="title">Upps!... Ocurri&oacute; un error al intentar cambiar la imagen</h2>
			<?=mysqli_error($miConexion)?>
			<input type="button" value="Volver a intentar" onclick=self.location="<?=ROOTURL?>?accion=Perfil" />
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
	
    if (move_uploaded_file($_FILES["changeFotoPerfil"]["tmp_name"], $folderRuta . $NombreFotoPerfil)) {
		$query = "UPDATE usuario_cliente SET FotoPerfil='$NombreFotoPerfil' WHERE IDUsuario='$IDUsuarioCliente'";
	
		if (!$result = mysqli_query($miConexion, $query))
			exit(mysqli_error($miConexion));
    } ?>
		<div class="loader">
			<div class="load"></div>
		</div>
		<meta http-equiv="refresh" content="0;url=<?=ROOTURL?>?accion=perfil">
<?php   	
}
require_once(FOOTERCLIENTE);
?>