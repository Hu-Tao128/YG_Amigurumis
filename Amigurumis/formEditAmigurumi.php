<h2>YG Amigurumis - Modificar informaci&oacute;n del Amigurumi</h2>
<?php

$IDAmigurumi = $_REQUEST['IDAmigurumi']; 
echo "El amigurumi a modificar es: ".$IDAmigurumi;

$datosAmigurumis = obtenerDatosAmigurumis($IDAmigurumi);
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

<center>
	<form name="frmEditAmigurumi" id="frmEditAmigurumi" action="Amigurumis/updateAmigurumi.php" method="POST" >
		<h3>Modifica los datos del Amigurumi</h3>
		
		<label>No. Serie
			<input type="text" value="<?=$datosAmigurumis['IDAmigurumi']?>" readonly disabled/>
			<input type="hidden" name="IDAmigurumi" id="IDAmigurumi" value="<?=$datosAmigurumis['IDAmigurumi']?>"/>
		</label><br/>
		
		<label>Nombre del Amigurumi*
			<input type="text" name="txtNombreAmigurumi" id="txtNombreAmigurumi" value="<?=$datosAmigurumis['NombreAmigurumi']?>" required />			
		</label><br/>

		<label>Existencias*
			<input type="text" name="txtExistencias" id="txtExistencias" value="<?=$datosAmigurumis['Existencias']?>" required />			
		</label><br/>

		<label>Producto*
			<select name="txtProducto" id="txtProducto" >
				<option value="Amigurumi" <?php
						if($datosAmigurumis['Producto'] == "Amigurumi"){
							echo "selected";
						}else{
							echo "";
						} ?>>Amigurumi</option>
				<option value="Accesorio" <?php
						if($datosAmigurumis['Producto'] == "Accesorio"){
							echo "selected";
						}else{
							echo "";
						} ?>>Accesorio</option>
				<option value="Llavero" <?php
						if($datosAmigurumis['Producto'] == "Llavero"){
							echo "selected";
						}else{
							echo "";
						} ?>>Llavero</option>
				<option value="Peculiaridad" <?php
						if($datosAmigurumis['Producto'] == "Peculiaridad"){
							echo "selected";
						}else{
							echo "";
						} ?>>Peculiaridad</option>
				<option value="Patron" <?php
						if($datosAmigurumis['Producto'] == "Patron"){
							echo "selected";
						}else{
							echo "";
						} ?>>Patron</option>
			</select>		
		</label><br/>

		<label>Selecciona la Categoria
			<select name="IDCategoria" id="IDCategoria" >
				<?php foreach($listaCategorias as $renglon=>$campo)
						{	?>
						<option value="<?=$campo['IDCategoria']?>" <?php
						if($datosAmigurumis['IDCategoria'] == $campo['IDCategoria']){
							echo "selected";
						}else{
							echo "";
						} ?>><?=$campo['Nombre']?></option>	
				<?php 	}	?>		
			</select>
		</label><br/>

		<label>Descripcion*
			<textarea name="txtDescripcion" id="txtDescripcion" rows="3" cols="44" required maxlength="500"><?=$datosAmigurumis['Descripcion']?></textarea>			
		</label><br/>
		
		<label>Precio*
			<input type="text" name="txtPrecio" id="txtPrecio" value="<?=$datosAmigurumis['Precio']?>" required />			
		</label><br/>

		<input type="submit" name="btnModificarAmigurumi" id="btnModificarAmigurumi" value="Actualizar Amigurumi" />
		
	</form>
</center>
