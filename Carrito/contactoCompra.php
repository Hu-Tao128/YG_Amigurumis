<?php
    require_once 'configuracion-cliente.php';
    include 'MySqli_conexionDB.php';
	require_once 'funciones-cliente.php';

    // $query = "DELETE FROM carrito WHERE IDUsuario=".$IDUsuario;

    $ultimoIDregistrado = mysqli_insert_id($miConexion); 
    $IDVentaAmigurumi = $ultimoIDregistrado;

    $IDUsuarioCliente = (isset($_SESSION['cliente_session'])) ? $_SESSION['cliente_session'] : null;
	$datosCliente = obtenerDatosUsuarioCliente($IDUsuarioCliente);

    $IDVentaAmigurumi = (isset($_GET['v'])) ? $_GET['v'] : null;

    $IDEnvio = (isset($_GET['e'])) ? $_GET['e'] : null;
    
    $DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');    
    $query = "SELECT Total FROM pedidos_amigurumis WHERE IDUsuario=".$IDUsuarioCliente." and IDVentaAmigurumi=".$IDVentaAmigurumi;
    $resultado = $DBConexion2->query($query);
    $totalVentaPagar = $resultado->fetchColumn();


if(isset($_SESSION['cliente_session'])){ ?>
	<style>
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

    <!-- 3 | ¿Cual es tu informacion de contacto? -->
<?php
    if(isset($_GET['e'])){ ?>
        <form name="frmPedidoF3" id="frmPedidoF3" action="<?=ROOTURL?>?accion=add-F3-Compra&v=<?=$IDVentaAmigurumi?>&e=<?=$IDEnvio?>" method="POST" >
<?php
    }else{ ?>
        <form name="frmPedidoF3" id="frmPedidoF3" action="<?=ROOTURL?>?accion=add-F3-Compra&v=<?=$IDVentaAmigurumi?>" method="POST" >
<?php
    }?>
    <div class="">
		<div id="listCarrito-2">
			<section class="closing-info">
				<div class="c-i-btns" >
					<div class="cta-btn" >
						<button type="button" class="c-c-btn" id="prevBtn" onclick=self.location="<?=ROOTURL?>?accion=direccion-de-envio&v=<?=$IDVentaAmigurumi?>&e=<?=$IDEnvio?>">Regresar</button>
						<!-- <a class="c-btn" href="</?=ROOTURL?>?accion=confirmarCompra" ><p>Confirmar Compra</p></a> -->
						<input type="submit" class="c-btn" name="btnPedidoF2" id="btnPedidoF2" value="Met&oacute;do de pago"/>
					</div>
				</div>
			</section>
			
			<section class="personalizar-compra-container" >
				<input type="hidden" name="accion" id="accion" value="add-F3-Compra" />
				<input type="hidden" name="txtCorreo" id="txtCorreo" value="<?=$datosCliente['Correo']?>" />

				<div class="login-head" ><p class="subtitulo-carrito"></p></div>
				<div class="tab-form-registrar" >
					<div class="input-registrar">
						<label class="form-label-registrar" >Telefono</label>
						<input class="form-input-registrar" type="tel" pattern="[0-9]{10}" name="txtTelefono" id="txtTelefono" value="<?=$datosCliente['Telefono']?>" maxlength="10" required/>
					</div>
					<div class="input-registrar">
						<label class="form-label-registrar" >Correo</label>
						<input class="form-input-registrar" type="email" value="<?=$datosCliente['Correo']?>" readonly disabled />
					</div>
				</div>
			</section>
				
			<div id="title-box-p-c" >
				<p class="titulo-carrito">¿Cu&aacute;l es tu informaci&oacute;n de contacto?</p>
				<p class="titulo-p-c">$<?=number_format($totalVentaPagar, 2, '.', ',')?></p>
			</div>
		</div>
	</div>
    </form>

<?php
} ?>