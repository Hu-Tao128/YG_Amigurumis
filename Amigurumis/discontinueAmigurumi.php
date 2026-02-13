<h2>YG Amigurumis - Descontinuar Amigurumi</h2>
<?php

include('MySqli_conexionDB.php');

$IDAmigurumi = $_GET['IDAmigurumi'];

echo "El IDAmigurumi a descontinuar es: ".$IDAmigurumi;

$respuesta = isset($_GET['respuesta'])?$_GET['respuesta']:null;

echo "</br>La respuesta del Admin es: ".$respuesta;

	if(!$respuesta)//sino existe respuesta, mostrar la pregunta
		{	?>
		<center>
			<h3>¿El Admin va a descontinuar el producto?</h3>
			<input type="button" value="SI" onclick=self.location="<?=ROOTURL?>?accion=discontinueAmigurumi&IDAmigurumi=<?=$IDAmigurumi?>&respuesta=SI" />
			<input type="button" value="NO" onclick=self.location="<?=ROOTURL?>?accion=listAmigurumis" />
		</center>
<?php 	}else if($respuesta == "SI")
			{
				//AGREGAR MI QUERY PARA ACTUALIZAR EL ESTADO A "DEVUELTO" DE LA TABLA PRESTAMOS
				//UPDATE nombreTabla SET nombreCampo1 = valorCampo1
				$query = "UPDATE amigurumis SET Estado='NO DISPONIBLE' WHERE IDAmigurumi = ".$IDAmigurumi;
				$resultado = mysqli_query($miConexion,$query);
				
				if(!$resultado)//algo salio mal...tengo mal escrita mi sentencia
				{	?>
					
					<center>	
						<h3>Error al  registrar la descontinuidad del amigurumi</h3>
						<h3><?=mysqli_error($miConexion);?></h3>
						<input type="button" value="Ir a la lista de Amigurumis" onclick=self.location="<?=ROOTURL?>?accion=listAmigurumis" />
					</center>	
				
<?php			}
				else
				{ ?>	
					<br/>
					<center>
						<h3>Producto descontinuado!!!"</h3>
						<input type="button" value="Ir a la lista de Amigurumis" onclick=self.location="<?=ROOTURL?>?accion=listAmigurumis" />
					</center>	
<?php			}	
			}
?>
	
