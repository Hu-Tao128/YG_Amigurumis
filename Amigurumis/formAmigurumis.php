<?php 

$listaCategorias =  obtenerListaCategorias();

?>

<style>
	textarea{
		width: 100%;
		height: auto;
		margin: 2px 0 6px;
		padding-left: 10px;
		box-sizing: border-box;
		border: 1px solid #6E6E6E;
		font-size: 14px;
		color: #6E6E6E;
		font-family: "futura_book";
		-webkit-border-radius: 5px 5px 5px 5px;
		-moz-border-radius: 5px 5px 5px 5px;
		border-radius: 5px 5px 5px 5px;
		outline: none;
		padding-top: 10px;
		padding-bottom: 20px;
	}
</style>

<h2>YG Amigurumis - Registrar amigurumi</h2>
<center>
	<form name="frmAmigurumis" id="frmAmigurumis" action="Amigurumis/addAmigurumi.php" method="POST" >
		<h3>Captura los datos del Amigurumi</h3>
		
		<label>Nombre del Amigurumi*
			<input type="text" name="txtNombreAmigurumi" id="txtNombreAmigurumi" required />			
		</label><br/>

		<label>Existencias*
			<input type="text" name="txtExistencias" id="txtExistencias" required />			
		</label><br/>

		<label>Producto*
			<select name="seltProducto" id="seltProducto" >
				<option value="">-- Selecciona Tipo Producto --</option>
				<option value="Amigurumi">Amigurumi</option>
				<option value="Accesorio">Accesorio</option>
				<option value="Llavero">Llavero</option>
				<option value="Peculiaridad">Peculiaridad</option>
				<option value="Patron">Patron</option>
			</select>		
		</label><br/>	
		
		<label>Selecciona la Categoria
			<select name="seltIDCategoria" id="seltIDCategoria" >
			
						<option value="">-- Selecciona Categoria --</option>

				<?php foreach($listaCategorias as $renglon=>$campo) 
						{	?>
						<option value="<?=$campo['IDCategoria']?>" ><?=$campo['Nombre']?> </option>	
				<?php 	}	?>		
				
			</select>	
		</label><br/>

		<label>Descripcion*
			<textarea name="txtDescripcion" id="txtDescripcion" rows="3" cols="44" required maxlength="500"></textarea>			
		</label><br/>
		
		<label>Precio*
			<input type="text" name="txtPrecio" id="txtPrecio" required />			
		</label><br/>	
		
		
		
	
		<input type="submit" name="btnRegistrarAmigurumi" id="btnRegistrarAmigurumi" value="Registrar Amigurumi" />
		
	</form>
</center>