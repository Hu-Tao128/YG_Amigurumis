<?php
require_once('../configuracion.php');
include_once('../MySqli_conexionDB.php');
require_once(HEADERADMIN);

$NombreAmigurumi = $_POST['txtNombreAmigurumi'];
$Descripcion = $_POST['txtDescripcion'];
$Existencias = $_POST['txtExistencias'];
$Producto = $_POST['seltProducto'];
$Precio = $_POST['txtPrecio'];
$Estado = 'DISPONIBLE';
$IDCategoria = $_POST['seltIDCategoria'];


$query = "INSERT INTO amigurumis(NombreAmigurumi,Existencias,Descripcion,Producto,Precio,Estado,IDCategoria) VALUES ('$NombreAmigurumi','$Existencias','$Descripcion','$Producto','$Precio','$Estado','$IDCategoria')";

		if(!$resultado = mysqli_query($miConexion,$query))
		{ ?>
			<center>	
				<h3>Error al intentar Registrar el Amigurumi</h3>
				<h3><?=mysqli_error($miConexion);?></h3>
				<input type="button" value="Ir a la lista de amigurumis" onclick=self.location="<?=ROOTURL?>?accion=listAmigurumis" />
			</center>	
				
<?php	}else{ ?>
	<meta http-equiv="refresh" content="0;url=<?=ROOTURL?>?accion=listAmigurumis">	
<?php		}	?>
<?php		include(FOOTERADMIN);	?>

