<?php 

$IDAmigurumi = (isset($_GET['IDAmigurumi'])) ? $_GET['IDAmigurumi'] : null;
	
$DatosAmigurumi = obtenerDatosAmigurumis($IDAmigurumi);

	if($DatosAmigurumi!=null)
	{	
			$IDAmigurumi = $DatosAmigurumi['IDAmigurumi'];
			$imagen = $DatosAmigurumi['mostrarFoto'];
			$NombreAmigurumi = $DatosAmigurumi['NombreAmigurumi'];
			$Precio = $DatosAmigurumi['Precio'];			
			$estado =$DatosAmigurumi['Estado'];
	}
 ?>	
	<div id="DatosAmigurumi">
			<form name="frmLibro" action="Amigurumis/subirFotoAmigurumi.php" method="POST" enctype="multipart/form-data">
				<input type="hidden" id="IDAmigurumiFoto" name="IDAmigurumiFoto" value="<?=$IDAmigurumi?>"/>
				<h2>Subir imagen del Libro</h2>
				<center><img  src="<?=$imagen?>"/></center>
				<label>IDAmigurumi: <span>*</span>
					<input type="text" id="IDAmigurumi" name="IDAmigurumi" value="<?=$IDAmigurumi?>" disabled />
				</label>
				
				<label>Nombre Amigurumi: <span>*</span>
					<input type="text" name="NombreAmigurumi" placeholder="NombreAmigurumi" value="<?=$NombreAmigurumi?>" disabled />
				</label>

				<label>Precio: <span>*</span>
					<input type="text" name="txtPrecio" placeholder="txtPrecio" value="<?=$Precio?>" disabled />
				</label>	
				
				<input type="file" id="uploadImage" name="uploadImage" />
				
				<input type="submit" name="btnRegistrar" value="subirImagen">
			</form>
	</div>
	<div style="clear: both;">&nbsp;</div>