<div id="listCarrito">
	<input type="hidden" name="title" id="title" value="Buscar" />
	<?php
		require_once 'funciones-cliente.php';
		$palabra = "";
		$palabra=(isset($_GET['palabra']))?$_GET['palabra']:null;
		$datosAmigurumi=obtenerBusqueda($palabra);
	?>
	<script>
		document.title += " <?=$palabra?> - <?=SITENAME?>";
	</script>
	<p class="titulo-carrito"><img class="title-icon" src="<?=IMG?>Iconos-Titulos/search-fill.svg"/>Resultados para "<?=$palabra?>"</p>
	
	<?php
		if($datosAmigurumi!=null){
	?>
	<section id="ordenar-por-box">
        <div class="ordenar-select " >
        <?php
            $option = "";
			$option=(isset($_GET['option']))?$_GET['option']:null;

            if($option == "mas-relevantes"){ ?>
            	<div class="ordenar-select-title" >Ordenar por: M&aacute;s relevantes<img class="down-icon" src="<?=IMG?>Home/deslizar-abajo.svg"/></div>
		<?php
            }elseif($option == "nombres"){ ?>
            	<div class="ordenar-select-title" >Ordenar por: Nombre<img class="down-icon" src="<?=IMG?>Home/deslizar-abajo.svg"/></div>
        <?php
            }elseif($option == "mayor-precio"){ ?>
            	<div class="ordenar-select-title" >Ordenar por: Mayor Precio<img class="down-icon" src="<?=IMG?>Home/deslizar-abajo.svg"/></div>
        <?php
            }elseif($option == "menor-precio"){ ?>
                <div class="ordenar-select-title" >Ordenar por: Menor Precio<img class="down-icon" src="<?=IMG?>Home/deslizar-abajo.svg"/></div>
        <?php
            }else{ ?>
                <div class="ordenar-select-title" >Ordenar por: M&aacute;s relevantes<img class="down-icon" src="<?=IMG?>Home/deslizar-abajo.svg"/></div>
        <?php
            }?>
            <div class="ordenar-select-opts" >
                <a href="<?=ROOTURL?>?palabra=<?=$palabra?>&accion=search&orderby=amigurumis.IDAmigurumi&order=desc&option=mas-relevantes" >
                    <div class="ordenar-select-opts-btns" >M&aacute;s relevantes</div>
                </a>
                <a href="<?=ROOTURL?>?palabra=<?=$palabra?>&accion=search&orderby=amigurumis.NombreAmigurumi&order=asc&option=nombres" >
                    <div class="ordenar-select-opts-btns" >Nombre</div>
                </a>
                <a href="<?=ROOTURL?>?palabra=<?=$palabra?>&accion=search&orderby=amigurumis.Precio&order=desc&option=mayor-precio" >
                    <div class="ordenar-select-opts-btns" >Mayor Precio</div>
                </a>
                <a href="<?=ROOTURL?>?palabra=<?=$palabra?>&accion=search&orderby=amigurumis.Precio&order=asc&option=menor-precio" >
                    <div class="ordenar-select-opts-btns" >Menor Precio</div>
                </a>
            </div>
        </div>
    </section>

	<?php 	
		foreach($datosAmigurumi as $campo){
	?>
	<section class="productos-carrito" >
		<div class="info-carrito <?='.', $campo['IDCategoria'], '.'?> show" >
			<div class="foto-box-carrito" >
				<a href="<?=ROOTURL?>?accion=verProducto&IDAmigurumi=<?=$campo['IDAmigurumi']?>" ><img class="foto-carrito" src="<?=$campo['mostrarFoto']?>" /></a>
			</div>
			<div class="product-info-carrito" >
				<div class="p-i-c-guardados-box" >
					<div class="p-i-c-compra">
						<div class="carrito-p-name-box">
							<a class="carrito-p-name" href="<?=ROOTURL?>?accion=verProducto&IDAmigurumi=<?=$campo['IDAmigurumi']?>" ><p><?=$campo['NombreAmigurumi']?></p></a>
						</div>
						<p class="p-price-carrito" >$<?=number_format($campo['Precio'], 2, '.', ',')?></p>
					</div>
					<div class="p-i-c-detalles detalles-guardados" >
						<p class="p-descripcion" ><?=$campo['Descripcion']?></p>
					</div>
				</div>
				<div class="p-i-c-extra-info-guardados">
					<div class="search-link-box link-box">
						<a class="search-link link l-space" href="<?=ROOTURL?>?accion=verProducto&IDAmigurumi=<?=$campo['IDAmigurumi']?>" ><img class="search-link-icon icons" src="<?=IMG?>Iconos/info.svg"/> Ver detalles</a>
						<a class="search-link link l-space" href="<?=ROOTURL?>?accion=addCarrito&IDAmigurumi=<?=$campo['IDAmigurumi']?>" ><img class="search-link-icon icons" src="<?=IMG?>Menu/carrito/carrito-0.svg"/> Agregar a tu Carrito</a>
						<a class="search-link link l-space" href="<?=ROOTURL?>?accion=addGuardados&IDAmigurumi=<?=$campo['IDAmigurumi']?>" ><img class="search-link-icon icons" src="<?=IMG?>Menu/carrito/guardados.svg"/> Guardar</a>
					</div>
					<p class="search-tag p-categoria-02" >#<?=$campo['Producto']?></p>
				</div>
			</div>
		</div>
		<?php 
			} }else{
		?>
			<p class="subtitulo-carrito" >No se encontraron resultados para <?=$palabra?>. Prueba con otro término de búsqueda.</p>
			<div class="cta-btn" >
        		<input class="c-c-btn" type="button" value="Seguir Comprando" onclick=self.location="<?=ROOTURL?>" />
			</div>
			<!-- <section class="null-search-box">
				<div>
					<img class="null-search-img" src="</?=IMG?>Logo/yg - svg/yg_color.svg" />  2022_12_31 | Hacer una imagen para cuando no se encuentren resultados
				</div>
			</section> -->
		<?php
			}
		?>
	</section>
</div>