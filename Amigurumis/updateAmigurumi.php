<?php
require_once('../configuracion.php');
include_once('../MySqli_conexionDB.php');
require_once(HEADERADMIN);


$IDAmigurumi = $_POST['IDAmigurumi'];
$NombreAmigurumi = $_POST['txtNombreAmigurumi'];
$Descripcion = $_POST['txtDescripcion'];
$Existencias = $_POST['txtExistencias'];
$Producto = $_POST['txtProducto'];
$Precio = $_POST['txtPrecio'];
$IDCategoria = $_POST['IDCategoria'];



$query = "UPDATE amigurumis SET NombreAmigurumi='$NombreAmigurumi',Producto ='$Producto',Existencias='$Existencias', Descripcion='$Descripcion', Precio ='$Precio', IDCategoria='$IDCategoria' WHERE IDAmigurumi=".$IDAmigurumi;


if(!$resultado = mysqli_query($miConexion,$query))
		{ ?>
			<center>	
				<h3>Error al intentar Actualizar el amigurumi</h3>
				<h3><?=mysqli_error($miconexion);?></h3>
				<input type="button" value="Ir a la lista de amigurumis" onclick=self.location="<?=ROOTURL?>?accion=listAmigurumis" />
			</center>	
				
<?php	}else{ ?>
				<meta http-equiv="refresh" content="0;url=<?=ROOTURL?>?accion=listAmigurumis">
<?php		}	?>
