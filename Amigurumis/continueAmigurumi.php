<h2>YG Amigurumis - Continuar Amigurumi</h2>
<?php

include('MySqli_conexionDB.php');

$IDAmigurumi = $_GET['IDAmigurumi'];

echo "El IDAmigurumi a descontinuar es: ".$IDAmigurumi;

$respuesta = isset($_GET['respuesta'])?$_GET['respuesta']:null;

echo "</br>La respuesta del Admin es: ".$respuesta;

	if(!$respuesta)//sino existe respuesta, mostrar la pregunta
		{	?>
		<center>
			<h3>¿El Admin va a Continuar el Producto?</h3>
			<input type="button" value="SI" onclick=self.location="<?=ROOTURL?>?accion=continueAmigurumi&IDAmigurumi=<?=$IDAmigurumi?>&respuesta=SI" />
			<input type="button" value="NO" onclick=self.location="<?=ROOTURL?>?accion=listAmigurumis" />
		</center>
<?php 	}else if($respuesta == "SI")
			{
				$query = "UPDATE amigurumis SET Estado='DISPONIBLE' WHERE IDAmigurumi = ".$IDAmigurumi;
				$resultado = mysqli_query($miConexion,$query);
				
				if(!$resultado)
				{	?>
					
					<center>	
						<h3>Error al  registrar la Continuidad del amigurumi</h3>
						<h3><?=mysqli_error($miConexion);?></h3>
						<input type="button" value="Ir a la lista de Amigurumis" onclick=self.location="<?=ROOTURL?>?accion=listAmigurumis" />
					</center>	
				
<?php			}
				else
				{ ?>	
					<br/>
					<center>
						<h3>Producto Continuado!!!"</h3>
						<input type="button" value="Ir a la lista de Amigurumis" onclick=self.location="<?=ROOTURL?>?accion=listAmigurumis" />
					</center>	
<?php			}	
			}
?>
	
