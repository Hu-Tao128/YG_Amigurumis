
<?php
	require_once 'funciones-cliente.php';
	$listCarrito = obtenerCarrito($IDUsuarioCarrito);
	
	$IDUsuarioCliente = (isset($_SESSION['cliente_session'])) ? $_SESSION['cliente_session'] : null;
	$datosCliente = obtenerDatosUsuarioCliente($IDUsuarioCliente); 

    $IDEnvio = (isset($_GET['e'])) ? $_GET['e'] : null;

    $IDVentaAmigurumi = (isset($_GET['v'])) ? $_GET['v'] : null;

	if(isset($_SESSION['cliente_session']) && $cantCarrito!=null){ ?>

	<style>
		.tab-registrar{
			border-bottom: none;
		}

		.login-head{
			margin-top: 2rem;
		}

			.subtitulo-carrito{
				color: #4D4D4D;
				font-family: ls_sb;
				font-size: 1.5rem;
			}

			.form-label-registrar{
				font-family: ls_r;
				color: #4D4D4D;
				font-size: 1rem;
			}

	</style>

	<!-- 1 | Personalizar Compra -->
<?php
    if(isset($_GET['v']) && isset($_GET['e'])){ ?>
		<form name="frmPedidoF1" id="frmPedidoF1" action="<?=ROOTURL?>?accion=add-F1-Compra&v=<?=$IDVentaAmigurumi?>&e=<?=$IDEnvio?>" method="POST" >
<?php
    }elseif(isset($_GET['v']) && isset($_GET['e']) == null){ ?>
		<form name="frmPedidoF1" id="frmPedidoF1" action="<?=ROOTURL?>?accion=add-F1-Compra&v=<?=$IDVentaAmigurumi?>" method="POST" >
<?php
    }else{ ?>
		<form name="frmPedidoF1" id="frmPedidoF1" action="<?=ROOTURL?>?accion=add-F1-Compra" method="POST" >
<?php
    }?>
	<div class="tab-registrar">
		<div id="listCarrito-2">
			<section class="closing-info">
				<div class="c-i-btns" >
					<div class="cta-btn" >
					<?php
						if(isset($_GET['v']) && isset($_GET['e'])){ ?>
							<button type="button" class="c-c-btn" onclick=self.location="<?=ROOTURL?>?accion=listCarrito&v=<?=$IDVentaAmigurumi?>&e=<?=$IDEnvio?>&lc=ce" >Regresar</button>
					<?php
						}elseif(isset($_GET['v'])){ ?>
							<button type="button" class="c-c-btn" onclick=self.location="<?=ROOTURL?>?accion=listCarrito&v=<?=$IDVentaAmigurumi?>&lc=cv" >Regresar</button>
					<?php
						}else{ ?>
							<button type="button" class="c-c-btn" onclick=self.location="<?=ROOTURL?>?accion=listCarrito" >Regresar</button>
					<?php 
						} ?>
						<!-- <button type="button" class="c-btn" id="nextBtn" onclick="nextPrev(1)" >Continuar</button> -->
						<input type="submit" class="c-btn" name="btnPedidoF1" id="btnPedidoF1" value="Continuar"/>
					</div>
				</div>
			</section>

			<?php
				$subtotal = 0;
				$cantArticulos = 0;
			
				if ($listCarrito!=null){ ?>
			
			<section class="personalizar-compra-container" >
				<input type="hidden" name="accion" id="accion" value="add-F1-Compra" />
				<input type="hidden" name="IDUsuario" id="IDUsuario" value="<?=$_SESSION['cliente_session']?>" />
			
				<?php
					foreach($listCarrito as $campos){
						$IVA = 0;
						$importe = $campos['Precio']*$campos['Cantidad'];
						$subtotal += $importe;
						$IVA = $subtotal * 0.08;	
						$total = $subtotal + $IVA;
						$cantArticulos += $campos['Cantidad'];
						$Cant = $campos['Cantidad'];
						
						$IDUsuario = $_SESSION['cliente_session'];
						$infoAmigurumis = obtenerTodosInfoAmigurumis($campos['IDAmigurumi']);
				?>

						<input type="hidden" name="listArticulos[<?=$campos['IDAmigurumi']?>][IDAmigurumi]" id="listArticulos[<?=$campos['IDAmigurumi']?>][IDAmigurumi]" value="<?=$campos['IDAmigurumi']?>" />
						<input type="hidden" name="listArticulos[<?=$campos['IDAmigurumi']?>][Precio]" id="listArticulos[<?=$campos['IDAmigurumi']?>][Precio]" value="<?=$campos['Precio']?>" />
						<input type="hidden" name="listArticulos[<?=$campos['IDAmigurumi']?>][Cantidad]" id="listArticulos[<?=$campos['IDAmigurumi']?>][Cantidad]" value="<?=$campos['Cantidad']?>" />
						<input type="hidden" name="listArticulos[<?=$campos['IDAmigurumi']?>][Importe]" id="listArticulos[<?=$campos['IDAmigurumi']?>][Importe]" value="<?=$importe?>" />
						<section class="productos-carrito" >
							<div class="p-c-name-box">
							<?php
								if($infoAmigurumis['Existencias'] <= 5 && $infoAmigurumis['Producto'] != 'Patron'){ ?>
									<p class="p-c-name">Se envía en 5-8 d&iacute;as h&aacute;biles.</p>
							<?php
								}elseif($infoAmigurumis['Existencias'] >= 6 && $infoAmigurumis['Existencias'] <= 10 && $infoAmigurumis['Producto'] != 'Patron'){ ?>
								<p class="p-c-name">Se envía en 3-5 d&iacute;as h&aacute;biles.</p>
							<?php
								}elseif($infoAmigurumis['Existencias'] >= 11 && $infoAmigurumis['Producto'] != 'Patron'){ ?>
									<p class="p-c-name">En existencia y listo para enviarse.</p>
							<?php
								}elseif($infoAmigurumis['Producto'] == 'Patron'){ ?>
									<p class="p-c-name">Listo para enviarse.</p>
							<?php
								}else{ ?>
									<p class="p-c-name">No tenemos en existencias por el momento.</p>
							<?php
								}?>
							</div>
							<div class="info-p-c" >
								<div class="foto-box-p-c" >
									<img class="foto-p-c" src="<?=$campos['mostrarFoto']?>" />
								</div>
								<div class="product-info-carrito" >
									<div class="p-c-box" >
										<div class="p-compra">
											<p class="p-descripcion" ><?=$campos['NombreAmigurumi']?></p>
										</div>
										<div class="p-c-detalles" >
											<p class="p-c-descripcion" ><?php if($campos['Cantidad'] != 1){ echo "Cantidad: ".$campos['Cantidad']; } ?></p>
										</div>
									</div>
								</div>
							</div>
						</section>
			<?php   }
				} ?>
				
				<input type="hidden" name="cantArticulos" id="cantArticulos" value="<?=$cantArticulos?>"/>
				<input type="hidden" name="subtotal" id="subtotal" value="<?=$subtotal?>" />
				<input type="hidden" name="IVA" id="IVA" value="<?=$IVA?>" />
				<input type="hidden" name="total" id="total"value="<?=$total?>" />
			</section>
		
			<div id="title-box-p-c" >
				<p class="titulo-carrito">Personaliza tu Compra</p>
				<p class="titulo-p-c">$<?=number_format($total, 2, '.', ',')?></p>
			</div>
		</div>
	</div>
	</form>

<?php
	} ?>