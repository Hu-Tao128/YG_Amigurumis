<div id="listCarrito">
<?php
$IDUsuario = $_SESSION['cliente_session'];
$listaCompras = getListMisCompras($IDUsuario);

if($listaCompras!=null){ ?>

	<div id="title-box-p-c" >
		<p class="titulo-carrito"><img class="title-icon" src="<?=IMG?>Iconos-Titulos/mis-compras-title.svg"/>Tus Pedidos</p>
		<!-- <p class="titulo-p-c"></p> -->
	</div>

	<section class="personalizar-compra-container" >
	<?php
			foreach($listaCompras as $campos){

			$months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
			$months_es_MX = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
			$monthName = str_replace($months, $months_es_MX, date("F", strtotime($campos['FechaRegistro'])));

			$dateEntrega = date_create($campos['FechaRegistro']); ?>
			<section class="productos-carrito">
				<div class="p-c-name-box">
					<p class="p-c-name">Pedido <?=date_format($dateEntrega,"j");?> de <?=$monthName?> de <?=date_format($dateEntrega,"Y");?>. ($<?=$campos['Total']?>)</p>
				</div>
				<?php
					$listaComprasDetalle = getListMisComprasDetalle($campos['IDVentaAmigurumi']);
					foreach($listaComprasDetalle as $camposComprasDetalle){
						$datosAmigurumis = obtenerTodosInfoAmigurumisMisPedidos($camposComprasDetalle['IDAmigurumi']); ?>
						<div class="info-p-c">
							<div class="foto-box-p-c">
								<img class="foto-p-c" src="<?=$datosAmigurumis['mostrarFoto']?>">
							</div>
							<div class="product-info-carrito">
								<div class="p-c-box">
									<div class="p-compra">
										<p class="p-descripcion"><?=$datosAmigurumis['NombreAmigurumi']?></p>
									</div>
									<div class="p-c-detalles">
										<p class="p-c-descripcion"><?=$camposComprasDetalle['Cantidad']?></p>
									</div>
								</div>
							</div>
						</div>
				<?php
					} ?>
			</section>
		<?php
			} ?>
	</section>
	
<?php } else {?>

	<p class="titulo-carrito"><img class="title-icon" src="<?=IMG?>Iconos-Titulos/carrito-fill.svg"/>Productos que has pedido.</p>
    <p class="subtitulo-carrito" >Solo se mostrarán las compras de los últimos 12 meses.</p>
    <div class="cta-btn" >
        <input class="c-c-btn" type="button" value="Seguir Comprando" onclick=self.location="<?=ROOTURL?>" />
    </div>
	<section class="m-p-p-g-box">
		<div class="m-p-p-guardados" >
			<div class="mockup-p-p-guardados"></div>
			<div class="mockup-p-p-txt-guardados">
				<p class="mockup-p-p-txt-title-guardados" >Aprovecha nuestros env&iacute;os a toda la rep&uacute;blica</p>
				<p class="mockup-p-p-txt-text-guardados" >Env&iacute;os a toda hora sin costo alguno. <b>¡Solo por tiempo limitado!</b></p>
				<a href="<?=ROOTURL?>?accion=verTodo" >
					<button class="hero-h-btn">Ver productos</button>
				</a>
			</div>
		</div>
	</section>

<?php }?>
</div>