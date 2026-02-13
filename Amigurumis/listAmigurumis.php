<h2>YG Amigurumis - Lista de amigurumis</h2>
<?php

$listAmigurumis =  obtenerListaAmigurumis();

?>
<table border="1">
	<tr>
		<th>IDAmigurumi</th> 
		<th>Foto</th> 
		<th>Nombre Amigurumi</th>
		<th>Descripción</th>
		<th>Existencias</th>
		<th>Producto</th>
		<th>Precio</th>
		<th>Estado</th>
		<th>Categoria</th>
		<?php if($puesto =='SUPERVISOR' || $puesto == 'GERENTE' || $puesto =='SUPERADMIN') {	
					echo '<th colspan="5">Acciones</th>';
				}	?>
		
	</tr>
<?php
		foreach($listAmigurumis AS $renglon=>$campos)
		{	?>
			<tr>
				<td><?=$campos['IDAmigurumi']?></td>
				<td>
					<?php if ($campos['Producto']=="Patron") {	?>
						<center><img class="foto" src="<?=$campos['mostrarPortada']?>"/></center>
					<?php	}	else	{ ?>
						<center><img class="foto" src="<?=$campos['mostrarFoto']?>"/></center>
					<?php	}	?>
				</td>
				<td><?=$campos['NombreAmigurumi']?></td>
				<td><?=$campos['Descripcion']?></td>
				<td><?=$campos['Existencias']?></td>
				<td><?=$campos['Producto']?></td>
				<td><?=$campos['Precio']?></td>
				<td><?=$campos['Estado']?></td>
				
				<?php $datosCategoria = obtenerDatosCategorias($campos ['IDCategoria']); ?>
				
				<td>
					<?php if($campos ['IDCategoria']=="0"){ ?>
						Patron
					<?php } else {?>
						<?php $datosCategoria = obtenerDatosCategorias($campos ['IDCategoria']); ?>
						<?=$datosCategoria['Nombre']?>
					<?php	}	?>	
				</td>

				<?php if($puesto =='SUPERVISOR' || $puesto == 'GERENTE' || $puesto =='SUPERADMIN') 
						{	?>

				<td>
					<?php if($campos['Estado']=="DISPONIBLE"){ ?>
						<a href="<?=ROOTURL?>?accion=discontinueAmigurumi&IDAmigurumi=<?=$campos['IDAmigurumi']?>" >Descontinuar</a>
					<?php } else{?>
						<a href="<?=ROOTURL?>?accion=continueAmigurumi&IDAmigurumi=<?=$campos['IDAmigurumi']?>" >Continuar</a>
					<?php	}	?>	
				</td>
				<td><a href="<?=ROOTURL?>?accion=imgAmigurumi&IDAmigurumi=<?=$campos['IDAmigurumi']?>"> Insertar Portada</a></td>
				<td><a href="<?=ROOTURL?>?accion=verFotosAmigurumis&IDAmigurumi=<?=$campos['IDAmigurumi']?>"> Ver Imagenes</a></td>
				<td><a href ="<?=ROOTURL?>?accion=deleteAmigurumi&IDAmigurumi=<?=$campos['IDAmigurumi']?>" >ELIMINAR</a></td>
				<td><a href ="<?=ROOTURL?>?accion=editAmigurumi&IDAmigurumi=<?=$campos['IDAmigurumi']?>" >MODIFICAR</a></td>
				
				<?php 	}	?>
				
			</tr>
<?php } ?>
	
</table>