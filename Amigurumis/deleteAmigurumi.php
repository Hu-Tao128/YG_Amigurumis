<h2>YG Amigurumis - Eliminar Amigurumi</h2>
<?php

include('MySqli_conexionDB.php');

$IDAmigurumi = $_GET['IDAmigurumi'];

echo "El Amigurumi a eliminar es: ".$IDAmigurumi;

$respuesta = isset($_GET['respuesta'])?$_GET['respuesta']:null;

echo "</br>La respuesta del admin es: ".$respuesta;

	if(!$respuesta)
		{	?>
		<center>
			<h3>¿Est&aacute;s seguro de eliminar el producto?</h3>
			<input type="button" value="SI" onclick=self.location="<?=ROOTURL?>?accion=deleteAmigurumi&IDAmigurumi=<?=$IDAmigurumi?>&respuesta=SI" />
			<input type="button" value="NO" onclick=self.location="<?=ROOTURL?>?accion=listAmigurumis" />
		</center>
<?php 	}else if($respuesta == "SI")
			{
				
				$query = "DELETE FROM amigurumis WHERE IDAmigurumi = ".$IDAmigurumi;
				$resultado = mysqli_query($miConexion,$query);
				
				if(!$resultado)
				{	?>
					
					<center>	
						<h3>Error al eliminar el registro</h3>
						<h3><?=mysqli_error($miconexion);?></h3>
						<input type="button" value="Ir a la lista de amigurumis" onclick=self.location="<?=ROOTURL?>?accion=listAmigurumis" />
					</center>	
				
<?php			}
				else
				{ ?>	
					<br/>
					<center>
						<h3>Amigurumi eliminado!!!"</h3>
						<input type="button" value="Ir a la lista de amigurumis" onclick=self.location="<?=ROOTURL?>?accion=listAmigurumis" />
					</center>	
<?php			}	
			}
?>
	
