<?php 
require_once 'funciones-cliente.php';
$IDAmigurumi = (isset($_GET['IDAmigurumi'])) ? $_GET['IDAmigurumi'] : null;
$datosTodosAmigurumis = obtenerTodosInfoAmigurumis($IDAmigurumi);

if($datosTodosAmigurumis!=null){?>
	<script>
		document.title += " <?=$datosTodosAmigurumis['NombreAmigurumi']?> - <?=SITENAME?>";
	</script>
	<div id="detalle-producto">
		<section class="d-p-info-imp">	
			<p class="info-nombre"><?=$datosTodosAmigurumis['NombreAmigurumi']?></p>
			
			<div class="info-precio-box">
				<div class="info-precio">$<?=number_format($datosTodosAmigurumis['Precio'], 2, '.', ',')?></div>
			</div>

			<div class="info-categoria-box">
				<?php $datosCategoria = obtenerDatosCategorias($datosTodosAmigurumis ['IDCategoria']);?>
				<p class="info-categoria"><?=$datosCategoria['Nombre']?></p>
			</div>

			<p class="info-descripcion"><?=$datosTodosAmigurumis['Descripcion']?></p>
			
			<div class="info-btns-box" >
				<input class="d-i-p-btnAddCarrito" type="button" value="Agregar al Carrito" onclick=self.location="<?=ROOTURL?>?accion=addCarrito&IDAmigurumi=<?=$datosTodosAmigurumis['IDAmigurumi']?>" />
			</div>
			<div class="info-btns-box" >
				<div class="info-btns-container">
					<p class="info-btns-title">¿A&uacute;n no te decides?</p>
					<p class="info-btns-descripcion">Guardalo para que lo puedas ver m&aacute;s tarde.</p>
				</div>
				<?php
				if(isset($_SESSION['cliente_session'])){
					if($btnGuardados == $IDUsuario." ".$datosTodosAmigurumis['IDAmigurumi']) { ?>
						<input class="info-icono-guardado" type="image" src="<?=IMG?>Iconos-Titulos/guardados-fill.svg" onclick=self.location="<?=ROOTURL?>?accion=deleteGuardados&IDAmigurumi=<?=$datosTodosAmigurumis['IDAmigurumi']?>" />	
					<?php
					}else{ ?>
						<input class="info-icono-guardado" type="image" src="<?=IMG?>Menu/carrito/guardados.svg" onclick=self.location="<?=ROOTURL?>?accion=addGuardados&IDAmigurumi=<?=$datosTodosAmigurumis['IDAmigurumi']?>" />
					<?php
					}
				}else{ ?>
					<input class="info-icono-guardado" type="image" src="<?=IMG?>Menu/carrito/guardados.svg" onclick=self.location="<?=ROOTURL?>?accion=addGuardados&IDAmigurumi=<?=$datosTodosAmigurumis['IDAmigurumi']?>" />
				<?php
				}?>
			</div>
		</section>
		
		<div class="imgs-box">
			<section class="product-img-box">
				<button type="button" class="open-modal f-p-moreActions-btn" data-open="full-img">
					<img class="product-img" src="<?=$datosTodosAmigurumis['mostrarFoto']?>"/>
				</button>
			</section>
			<section class="imgs-container">
				<?php
				$exc = 0;
				$fotosAmigurumis = obtenerFotosAmigurumis($IDAmigurumi);
				foreach($fotosAmigurumis as $campo){
					if($datosTodosAmigurumis['IDAmigurumi'] == $campo['IDAmigurumi']){
						if($exc >= 5) {
							break;
						}else{?>
							<button type="button" class="open-modal f-p-moreActions-btn" data-open="<?=$campo['IDFoto']?>">
							<?php
								if($campo['NombreFoto'] == $campo['IDFoto']."".'.mp4'){ ?>
									<video class="foto-icons" poster="<?=ROOTURL?>/admin/Amigurumis/Fotos/<?=$campo['IDAmigurumi']?>.gif">
										<source src="<?=$campo['mostrarFoto']?>" type="video/mp4">
									</video>
							<?php
								}else{ ?>
								<img class="foto-icons" src="<?=$campo['mostrarFoto']?>"/>
							<?php
								}
							?>
							</button>
							
							<div class="full-img-product" id="<?=$campo['IDFoto']?>">
								<div class="full-img-product-dialog">
									<section class="f-i-p-d-content">
										<div class="f-i-p-d-btn-box">
										</div>
										<?php
											if($campo['NombreFoto'] == $campo['IDFoto']."".'.mp4'){ ?>
												<video class="f-i-p-d-content-img product-img" controls>
													<source src="<?=$campo['mostrarFoto']?>" type="video/mp4">
												</video>
										<?php
											}else{ ?>
											<img class="f-i-p-d-content-img product-img" src="<?=$campo['mostrarFoto']?>"/>
										<?php
											}
										?>
										<div class="f-i-p-d-btn-box">
											<button type="button" class="exit-btn" aria-label="close modal" data-close>
												<img class="exit-btn-icon" src="<?=IMG?>modal/x-delete.svg"/>
											</button>
										</div>
									</section>
								</div>
							</div>
					<?php
							$exc++;
						}
					}	
				}?>
			</section>
		</div>
	</div>

			<div class="full-img-product" id="full-img">
				<div class="full-img-product-dialog">
					<section class="f-i-p-d-content">
						<div class="f-i-p-d-btn-box">	
						</div>
						<img class="f-i-p-d-content-img product-img" src="<?=$datosTodosAmigurumis['mostrarFoto']?>"/>
						<div class="f-i-p-d-btn-box">
							<button type="button" class="exit-btn" aria-label="close modal" data-close>
								<img class="exit-btn-icon" src="<?=IMG?>modal/x-delete.svg"/>
							</button>
						</div>
					</section>
				</div>
			</div>
            <script>
                const openEls = document.querySelectorAll("[data-open]");
                const closeEls = document.querySelectorAll("[data-close]");
                const isVisible = "is-visible";

                for (const el of openEls) {
                el.addEventListener("click", function() {
                    const modalId = this.dataset.open;
                    document.getElementById(modalId).classList.add(isVisible);
				});
                }

                for (const el of closeEls) {
                el.addEventListener("click", function() {
                    this.parentElement.parentElement.parentElement.parentElement.classList.remove(isVisible);
                });
                }

                document.addEventListener("click", e => {
                if (e.target == document.querySelector(".full-img-product.is-visible")) {
                    document.querySelector(".full-img-product.is-visible").classList.remove(isVisible);
                }
                });

                document.addEventListener("keyup", e => {
                // if we press the ESC
                if (e.key == "Escape" && document.querySelector(".full-img-product.is-visible")) {
                    document.querySelector(".full-img-product.is-visible").classList.remove(isVisible);
                }
                });
            </script>  

	<?php
	require_once 'funciones-cliente.php';
	$palabra = $datosCategoria['Nombre'];
	$datosAmigurumi = obtenerBusqueda($palabra);

	// Categorias 

	$DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');
	$query = "SELECT COUNT(amigurumis.IDCategoria) as total FROM amigurumis  INNER JOIN categorias on amigurumis.IDCategoria=categorias.IDCategoria WHERE amigurumis.Estado='DISPONIBLE' and categorias.Estado='DISPONIBLE' and amigurumis.IDCategoria=".$datosCategoria['IDCategoria'];
	$resultado = $DBConexion2->query($query);
	$cantCategorias = $resultado->fetchColumn();

	if($cantCategorias >= 3){
	?>
	<div id="listCarrito">
		<div class="sugerencias-carrito">
			<p class="titulo-carrito-2">También te puede interesar</p>
			<p class="subtitulo-carrito" ></p>
			<section>
		<?php
			$exc = 0;
			foreach($datosAmigurumi as $campo){
				require_once 'funciones-cliente.php';
                    //btn Guardados
                    if(isset($_SESSION['cliente_session'])){
						$DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');
						$query = "SELECT guardados.IDUsuario FROM guardados INNER JOIN amigurumis on guardados.IDAmigurumi=amigurumis.IDAmigurumi INNER JOIN categorias on amigurumis.IDCategoria=categorias.IDCategoria WHERE amigurumis.Estado='DISPONIBLE' and categorias.Estado='DISPONIBLE' and guardados.IDUsuario=".$IDUsuario." and guardados.IDAmigurumi=".$campo['IDAmigurumi'];
						$resultado = $DBConexion2->query($query);
						$btnGuardadosIDUsuario = $resultado->fetchColumn();
			
						$DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');
						$query = "SELECT guardados.IDAmigurumi FROM guardados INNER JOIN amigurumis on guardados.IDAmigurumi=amigurumis.IDAmigurumi INNER JOIN categorias on amigurumis.IDCategoria=categorias.IDCategoria WHERE amigurumis.Estado='DISPONIBLE' and categorias.Estado='DISPONIBLE' and guardados.IDUsuario=".$IDUsuario." and guardados.IDAmigurumi=".$campo['IDAmigurumi'];
						$resultado = $DBConexion2->query($query);
						$btnGuardadosIDAmigurumis = $resultado->fetchColumn();
			
						$btnGuardados = $btnGuardadosIDUsuario." ".$btnGuardadosIDAmigurumis;
					}

				// if($datosTodosAmigurumis['NombreAmigurumi'] == $campo['NombreAmigurumi']){
				// 	$exc++;
				// }elseif($exc >= 4){
				// 	break;
				// }else{
					if($exc >= 3){
						break;
					}else{?>
				<div class="p-product-box" >
					<div class="filterDiv <?=$campo['IDCategoria']?> show">
						<div class="unit-body">
							<a title="<?=$campo['NombreAmigurumi']?>" href="<?=ROOTURL.'?accion=verProducto&IDAmigurumi='.$campo['IDAmigurumi']?>">
								<img class="foto" src="<?=$campo['mostrarFoto']?>"/>
							</a>
							<p class="product-title"><?=$campo['NombreAmigurumi']?></p>
							<div class="product-price-wrap">
								<div class="product-price">$<?=number_format($campo['Precio'], 2, '.', ',')?></div>
								<div class="iconos-product-box" >
									<input class="iconos-product" type="image" src="<?=IMG?>Menu/carrito/carrito-0.svg" onclick=self.location="<?=ROOTURL?>?accion=addCarrito&IDAmigurumi=<?=$campo['IDAmigurumi']?>" />
									<?php
                                    if(isset($_SESSION['cliente_session'])){
                                        if($btnGuardados == $IDUsuario." ".$campo['IDAmigurumi']) { ?>
                                            <input class="iconos-product" type="image" src="<?=IMG?>Iconos-Titulos/guardados-fill.svg" onclick=self.location="<?=ROOTURL?>?accion=deleteGuardados&IDAmigurumi=<?=$campo['IDAmigurumi']?>" />
                                        <?php
                                        }else{ ?>
                                            <input class="iconos-product" type="image" src="<?=IMG?>Menu/carrito/guardados.svg" onclick=self.location="<?=ROOTURL?>?accion=addGuardados&IDAmigurumi=<?=$campo['IDAmigurumi']?>" />
                                        <?php
                                        }
                                    }else{ ?>
                                        <input class="iconos-product" type="image" src="<?=IMG?>Menu/carrito/guardados.svg" onclick=self.location="<?=ROOTURL?>?accion=addGuardados&IDAmigurumi=<?=$campo['IDAmigurumi']?>" />
                                    <?php
                                    }?>	
								</div>
							</div>
						</div>
					</div>
				</div>
		<?php $exc++;
					}
				// }
			}
		}else{?>
		<div id="listCarrito">
			<div class="sugerencias-carrito">
				<p class="titulo-carrito-2">Lo m&aacute;s nuevo de YG</p>
				<p class="subtitulo-carrito" >Aprovecha nuestros amigurumis de temporada.</p>
				<section>
					<?php   require_once 'funciones-cliente.php';
					$listTodosAmigurumis = obtenerTodosAmigurumis();
						if($listTodosAmigurumis!=null)
						{	
							$exc = 0;
							foreach($listTodosAmigurumis as $campo){
								require_once 'funciones-cliente.php';
									//btn Guardados
									if(isset($_SESSION['cliente_session'])){
										$DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');
										$query = "SELECT guardados.IDUsuario FROM guardados INNER JOIN amigurumis on guardados.IDAmigurumi=amigurumis.IDAmigurumi INNER JOIN categorias on amigurumis.IDCategoria=categorias.IDCategoria WHERE amigurumis.Estado='DISPONIBLE' and categorias.Estado='DISPONIBLE' and guardados.IDUsuario=".$IDUsuario." and guardados.IDAmigurumi=".$campo['IDAmigurumi'];
										$resultado = $DBConexion2->query($query);
										$btnGuardadosIDUsuario = $resultado->fetchColumn();
							
										$DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');
										$query = "SELECT guardados.IDAmigurumi FROM guardados INNER JOIN amigurumis on guardados.IDAmigurumi=amigurumis.IDAmigurumi INNER JOIN categorias on amigurumis.IDCategoria=categorias.IDCategoria WHERE amigurumis.Estado='DISPONIBLE' and categorias.Estado='DISPONIBLE' and guardados.IDUsuario=".$IDUsuario." and guardados.IDAmigurumi=".$campo['IDAmigurumi'];
										$resultado = $DBConexion2->query($query);
										$btnGuardadosIDAmigurumis = $resultado->fetchColumn();
							
										$btnGuardados = $btnGuardadosIDUsuario." ".$btnGuardadosIDAmigurumis;
									}
								if($exc >= 3){
									break;
								}else{?>
								<div class="p-product-box" >
									<div class="filterDiv <?=$campo['IDCategoria']?> show">
										<div class="unit-body">
											<a title="<?=$campo['NombreAmigurumi']?>" href="<?=ROOTURL.'?accion=verProducto&IDAmigurumi='.$campo['IDAmigurumi']?>">
												<img class="foto" src="<?=$campo['mostrarFoto']?>"/>
											</a>
											<p class="product-title"><?=$campo['NombreAmigurumi']?></p>
											<div class="product-price-wrap">
												<div class="product-price">$<?=number_format($campo['Precio'], 2, '.', ',')?></div>
												<div class="iconos-product-box" >
													<input class="iconos-product" type="image" src="<?=IMG?>Menu/carrito/carrito-0.svg" onclick=self.location="<?=ROOTURL?>?accion=addCarrito&IDAmigurumi=<?=$campo['IDAmigurumi']?>" />
													<?php
													if(isset($_SESSION['cliente_session'])){
														if($btnGuardados == $IDUsuario." ".$campo['IDAmigurumi']) { ?>
															<input class="iconos-product" type="image" src="<?=IMG?>Iconos-Titulos/guardados-fill.svg" onclick=self.location="<?=ROOTURL?>?accion=deleteGuardados&IDAmigurumi=<?=$campo['IDAmigurumi']?>" />
														<?php
														}else{ ?>
															<input class="iconos-product" type="image" src="<?=IMG?>Menu/carrito/guardados.svg" onclick=self.location="<?=ROOTURL?>?accion=addGuardados&IDAmigurumi=<?=$campo['IDAmigurumi']?>" />
														<?php
														}
													}else{ ?>
														<input class="iconos-product" type="image" src="<?=IMG?>Menu/carrito/guardados.svg" onclick=self.location="<?=ROOTURL?>?accion=addGuardados&IDAmigurumi=<?=$campo['IDAmigurumi']?>" />
													<?php
													}?>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php $exc++;
								}
							}
						} ?>       
				</section>
			</div>
		</div>
		<?php
			}?>       
			</section>
		</div>
	</div>
<?php	
	} ?>