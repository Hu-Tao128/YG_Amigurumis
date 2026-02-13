<?php
	if(isset($_SESSION['Carrito']) && isset($_SESSION['cliente_session']))
	{		
?>
	<form id="frmConfirmar" id="frmConfirmar" action="Carrito/addCompra.php" method="POST">
		<input type="hidden" name="accion" id="accion" value="addCompra" />
		<input type="hidden" name="IDUsuario" id="IDUsuario" value="<?=$_SESSION['cliente_session']?>" />
		<h2 class="fs-title">Confirmar compra</h2>
	
		<table id="listCompra"> 
	
		<?php 	
			$importeTotal = 0;
			$subTotal = 0;
			$IVA = 0;
			$cantArticulos = 0;
			$descuento = 0;
			foreach($_SESSION['Carrito'] as $IDAmigurumi => $campos)
			{
				$datosAmigurumi=obtenerTodosInfoAmigurumis($IDAmigurumi);	
				$Importe = $datosAmigurumi['Precio']*$campos['Cantidad'] - $campos['Descuento'];
				$subTotal += $Importe;
				$cantArticulos += $campos['Cantidad'];
				$descuento += $campos['Descuento'];
				
			?>

					<!-- UTILIZAR EN LA TABLA VENTA DETALLE-->	
					<input type="hidden" name="listArticulos[<?=$IDAmigurumi?>][IDAmigurumi]" id="listArticulos[<?=$IDAmigurumi?>][IDAmigurumi]" value="<?=$IDAmigurumi?>" />
					<input type="hidden" name="listArticulos[<?=$IDAmigurumi?>][Precio]" id="listArticulos[<?=$IDAmigurumi?>][Precio]" value="<?=$datosAmigurumi['Precio']?>" />
					<input type="hidden" name="listArticulos[<?=$IDAmigurumi?>][Cantidad]" id="listArticulos[<?=$IDAmigurumi?>][Cantidad]" value="<?=$campos['Cantidad']?>" />
					<input type="hidden" name="listArticulos[<?=$IDAmigurumi?>][Descuento]" id="listArticulos[<?=$IDAmigurumi?>][Descuento]" value="<?=$campos['Descuento']?>" />
					<input type="hidden" name="listArticulos[<?=$IDAmigurumi?>][Importe]" id="listArticulos[<?=$IDAmigurumi?>][Importe]" value="<?=$Importe?>" />
			
					<tr>
						<td><img src="<?=$datosAmigurumi['mostrarFoto']?>" height="100px" width="100px" style="object-fit:cover"/></td>
						<td><h3><?=$datosAmigurumi['NombreAmigurumi']?></h3><br><?=$datosAmigurumi['Descripcion']?></td> 
						<td class="precios">$ <?=number_format($datosAmigurumi['Precio'], 2, '.', ',')?></td>
						<td><?=$campos['Cantidad']?></td>
						<td class="precios">$ <?=number_format($campos['Descuento'], 2, '.', ',')?></td>
						<td class="precios">$ <?=number_format($Importe, 2, '.', ',')?></td>
					</tr>
					
					
			<?php	}	
			
					$IVA = $subTotal * 0.08;	
					$importeTotal = $subTotal + $IVA;
			?>
					<tr>
						<td colspan="5" class="precios">Subtotal:</td>	
						<td class="precios">$ <?=number_format($subTotal, 2, '.', ',')?></td>
						
					</tr>
					<tr>
						<td colspan="5" class="precios">IVA: </td>	
						<td class="precios">$ <?=number_format($IVA, 2, '.', ',')?></td>
						
					</tr>
					<tr>
						<td colspan="5" class="precios">Total:</td>	
						<td class="precios"><h2>$<?=number_format($importeTotal, 2, '.', ',')?></td>						
					</tr>
					<tr>
					<td colspan="3"></td>	
			</table>
			</br>
			
			<input type="hidden" name="cantArticulos" id="cantArticulos" value="<?=$cantArticulos?>"/>
			<input type="hidden" name="Descuento" id="Descuento"value="<?=$descuento?>" />
			<input type="hidden" name="subTotal" id="subTotal"value="<?=$subTotal?>" />
			<input type="hidden" name="IVA" id="IVA"value="<?=$IVA?>" />
			<input type="hidden" name="importeTotal" id="importeTotal"value="<?=$importeTotal?>" />
			
			<label class="fs-subtitle">Selecciona el metodo de pago
				<select name="metodoPago" id="metodoPago" required>
					<option value="Cr&eacute;dito">Tarjeta de Cr&eacute;dito</option>
					<option value="D&eacute;bito">Tarjeta de D&eacute;bito</option>			
				</select>
			</label>
				
	</form>
	
	<?php
		$listTarjetas = obtenerListaTarjetas($_SESSION['cliente_session']);
			if($listTarjetas!= null )
				{	?>
				<label class="fs-subtitle">Selecciona la tarjeta de pago
					<select name="infoMetodoPago" id="infoMetodoPago" required>
						
						<?php foreach($listTarjetas as $renglon=>$campos) 
								{	?>
									<option value="<?=$campos['Numero']?>"> <?=$campos['NombreTitular']?> - <?=substr_replace($campos['Numero'],"**** **** ****",0,12)?> </option>
						<?php 	}	?>
					</select>
				</label>
				</br></br>
				<input type="submit" name="submit" id="submit" class="submit action-button" value="Confirmar" onclick=self.location="<?=ROOTURL?>?accion=addCompra" />
		<?php 	}else{	?>
				<br>
				<center>
					<h2>Registra una tarjeta para continuar con tu compra</h2>
					<input type="button" value="Regresar" onclick=self.location="<?=ROOTURL?>?accion=Carrito" />
					<input type="button" value="Registrar Tarjeta" onclick=self.location="<?=ROOTURL?>?accion=addTarjetas" />
				</center>	
		<?php 	}	?>

<?php	}	?>