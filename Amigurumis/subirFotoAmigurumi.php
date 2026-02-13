<?php
include "../configuracion.php";
include_once('../MySqli_conexionDB.php');

require_once(HEADERADMIN);

if (isset($_POST['btnRegistrar'])) {
    $uploadfile = $_FILES["uploadImage"]["tmp_name"];//variable donde se guarda el archivo tipo imagen
    $folderRuta = "Fotos/"; //carpeta donde se guardarán las Fotos de mis artículos/productos
	$tipoImagen = explode("/",$_FILES["uploadImage"]["type"]);//variable donde se guarda el tipo de imagen
	$IDAmigurumi = $_REQUEST['IDAmigurumiFoto'];//variable donde se guarda el ID del balón
	$nombreImagen = $IDAmigurumi.".".$tipoImagen[1]; //se renombra la imagen con el ID del balón para evitar que se reemplacen imagenes con el mismo nombre
    //var_dump($_REQUEST);
    if (! is_writable($folderRuta) || ! is_dir($folderRuta)) 
	{ //Si ocurre algún error se muestra el mensaje para regresar a la lista
?>
		<center>
			<h2 class="title">Error al intentar Registrar la imagen del Amigurumi</h2>
			<?=mysqli_error($miConexion)?>
			<input type="button" value="Ir a la lista de Amigurumis" onclick=self.location="<?=ROOTURL?>?accion=listAmigurumis" />
		</center>
<?php

    }
	
	$query = "SELECT IDAmigurumi, Foto FROM amigurumis WHERE IDAmigurumi = '$IDAmigurumi'"; //se realiza la consulta para verificar si hay una imagen borrarla y guardar la nueva imagen
	
	if (!$result = mysqli_query($miConexion, $query))
        exit(mysqli_error($miConexion));
    
	if(mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			if(file_exists(DOCROOT."Amigurumis/Fotos/".$row['Foto']) && $row['Foto']<>""){
				unlink(DOCROOT."Amigurumis/Fotos/".$row['Foto'])or die("Couldn't delete file");//unlink es la instrucción para borrar archivos
			}
		}
	}	
	
    if (move_uploaded_file($_FILES["uploadImage"]["tmp_name"], $folderRuta . $nombreImagen)) {//se guarda la imagen seleciona
        echo '<img src="' . ROOTURL."Amigurumis/" . $folderRuta . "" . $nombreImagen . '">';//se muestra la imagen guardada
		$query = "UPDATE amigurumis SET Foto='$nombreImagen' WHERE IDAmigurumi = '$IDAmigurumi'";//se guarda el nombre de la imagen
		if (!$result = mysqli_query($miConexion, $query))
			exit(mysqli_error($miConexion));		
			
    }
?>	
	<meta http-equiv="refresh" content="0;url=<?=ROOTURL?>?accion=listAmigurumis">
<?php   	
}
require_once(FOOTERADMIN);
?>