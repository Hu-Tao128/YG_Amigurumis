<?php
    require_once 'configuracion-cliente.php';
    include 'MySqli_conexionDB.php';
    require_once 'funciones-cliente.php';

    $IDUsuarioCliente = (isset($_SESSION['cliente_session'])) ? $_SESSION['cliente_session'] : null;
	$datosCliente = obtenerDatosUsuarioCliente($IDUsuarioCliente);

    $IDVentaAmigurumi = (isset($_GET['v'])) ? $_GET['v'] : null;

    $IDEnvio = (isset($_GET['e'])) ? $_GET['e'] : null;

    $MetodoPago = (isset($_GET['d'])) ? $_GET['d'] : null;
    
    $DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');    
    $query = "SELECT Total FROM pedidos_amigurumis WHERE IDUsuario=".$IDUsuarioCliente." and IDVentaAmigurumi=".$IDVentaAmigurumi;
    $resultado = $DBConexion2->query($query);
    $totalVentaPagar = $resultado->fetchColumn();

    // if(isset($_SERVER['HTTP_REFERER'])) {
    //     $URL = parse_url($_SERVER['HTTP_REFERER']);
    //     parse_str($URL['query'], $query);
    // }

    // $URL2 = $_SERVER['REQUEST_URI'];

    if(isset($_SERVER['REQUEST_URI'])) {
        $URL = parse_url($_SERVER['REQUEST_URI']);
        parse_str($URL['query'], $query);
    }

    $URL2 = (isset($query['d'])) ? $query['d'] : null;
    

	if(isset($_SESSION['cliente_session'])){ ?>

	<style>
		.tab{
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

    <!-- 4 | Metodo de pago -->
    <?php
    if(isset($_GET['e'])){ ?>
        <form name="frmPedidoF4" id="frmPedidoF4" action="<?=ROOTURL?>?accion=add-F4-Compra&v=<?=$IDVentaAmigurumi?>&e=<?=$IDEnvio?>" method="POST" >
<?php
    }else{ ?>
        <form name="frmPedidoF4" id="frmPedidoF4" action="<?=ROOTURL?>?accion=add-F4-Compra&v=<?=$IDVentaAmigurumi?>" method="POST" >
<?php
    }?>
    <div class="">
		<div id="listCarrito-2">
			<section class="closing-info">
				<div class="c-i-btns" >
					<div class="cta-btn" >
                        <button type="button" class="c-c-btn" id="prevBtn" onclick=self.location="<?=ROOTURL?>?accion=informacion-de-contacto&v=<?=$IDVentaAmigurumi?>&e=<?=$IDEnvio?>">Regresar</button>
						<!-- <a class="c-btn" href="</?=ROOTURL?>?accion=confirmarCompra" ><p>Confirmar Compra</p></a> -->
						<input type="submit" class="c-btn" name="btnPedidoF4" id="btnPedidoF4" value="Finalizar"/>
					</div>
				</div>
			</section>

			<section class="personalizar-compra-container" >
            <input type="hidden" name="accion" id="accion" value="add-F4-Compra" />
            <div class="login-head" >
                <p class="subtitulo-carrito">Selecciona el met&oacute;do de pago.</p>
            </div>
			<!-- <div class="login-head" ><p class="subtitulo-carrito"></p></div> -->
				<div class="tab-form-registrar" >
                    <div class="input-registrar">
                        <label class="form-label-registrar" title="Selecciona tu met&oacute;do de pago">Met&oacute;do de Pago</label>
                        <select class="form-input-registrar" name="metodoPago" id="metodoPago" required style="background-color: #FFFFFF;">
                            <option onclick=self.location="<?php
                                if($URL2 != null){
                                    echo ROOTURL."?accion=metodo-de-pago&v=".$IDVentaAmigurumi."&e=".$IDEnvio;
                                }else{
                                    echo ROOTURL."?accion=metodo-de-pago&v=".$IDVentaAmigurumi."&e=".$IDEnvio;
                                } ?>" value="" <?php
                                if($URL2 == null){
                                    echo "selected";
                                }else{
                                    echo "";
                                } ?> >Selecciona tu m&eacute;todo de pago</option>
                            <option onclick=self.location="<?php
                                if($URL2 == "efectivo"){
                                    echo ROOTURL."?accion=metodo-de-pago&v=".$IDVentaAmigurumi."&e=".$IDEnvio."&d=efectivo";
                                }else{
                                    echo ROOTURL."?accion=metodo-de-pago&v=".$IDVentaAmigurumi."&e=".$IDEnvio."&d=efectivo";
                                } ?>" value="Efectivo" <?php
                                if($URL2 == "efectivo"){
                                    echo "selected";
                                }else{
                                    echo "";
                                } ?> >Efectivo</option>			
                            <option onclick=self.location="<?php
                                if($URL2 == "tcredito"){
                                    echo ROOTURL."?accion=metodo-de-pago&v=".$IDVentaAmigurumi."&e=".$IDEnvio."&d=tcredito";
                                }else{
                                    echo ROOTURL."?accion=metodo-de-pago&v=".$IDVentaAmigurumi."&e=".$IDEnvio."&d=tcredito";
                                } ?>" value="Credito" <?php
                                if($URL2 == "tcredito"){
                                    echo "selected";
                                }else{
                                    echo "";
                                } ?> > Tarjeta de Cr&eacute;dito</option>
                            <option onclick=self.location="<?php
                                if($URL2 == "tdebito"){
                                    echo ROOTURL."?accion=metodo-de-pago&v=".$IDVentaAmigurumi."&e=".$IDEnvio."&d=tdebito";
                                }else{
                                    echo ROOTURL."?accion=metodo-de-pago&v=".$IDVentaAmigurumi."&e=".$IDEnvio."&d=tdebito";
                                } ?>" value="Debito" <?php
                                if($URL2 == "tdebito"){
                                    echo "selected";
                                }else{
                                    echo "";
                                } ?> > Tarjeta de D&eacute;bito</option>			
                        </select>
                    </div>
                    
                <?php
                    $listTarjetas = getListTarjetas($IDUsuarioCliente);
                    if($MetodoPago == "tcredito"){ 
                        if($listTarjetas != null ){ ?>
                        <div class="input-registrar">
                            <label class="form-label-registrar" title="Selecciona tu tarjeta">Tu tarjeta</label>
                            <select class="form-input-registrar" name="infoMetodoPago" id="infoMetodoPago" required style="background-color: #FFFFFF;">
                                <option value="">Selecciona tu tarjeta</option>
                        <?php foreach($listTarjetas as $renglon=>$campos){ ?>
                                <option value="<?=$campos['IDTarjeta']?>" title="<?=$campos['nombreTitular']?>" ><?=substr_replace($campos['Numero'],"**** **** **** ",0,12)?></option>
                        <?php } ?>
                            </select>
                        </div>
                    <?php   
                        }else{ ?>
                            <div id="listCarrito">
                                <div class="sugerencias-carrito">
                                    <p class="subtitulo-carrito" style="font-size: 1rem; font-family: ls_r; color: #aaaaaa;" >Vaya, parece que no tienes ninguna tarjeta registrada. <a class="search-link" style="display:unset;" href="<?=ROOTURL?>?accion=agregar-tarjeta" >Registra Tu tarjeta</a>.</p>
                                </div>
                            </div>
                    <?php
                        }
                    }elseif($MetodoPago == "tdebito"){
                        if($listTarjetas != null ){ ?>
                        <div class="input-registrar">
                            <label class="form-label-registrar" title="Selecciona tu tarjeta">Tu tarjeta</label>
                            <select class="form-input-registrar" name="infoMetodoPago" id="infoMetodoPago" required style="background-color: #FFFFFF;">
                                <option value="">Selecciona tu tarjeta</option>
                        <?php foreach($listTarjetas as $renglon=>$campos){ ?>
                                <option value="<?=$campos['IDTarjeta']?>" title="<?=$campos['nombreTitular']?>" ><?=substr_replace($campos['Numero'],"**** **** **** ",0,12)?></option>
                        <?php } ?>
                            </select>
                        </div>
                    <?php   
                        }else{ ?>
                            <div id="listCarrito">
                                <div class="sugerencias-carrito">
                                    <p class="subtitulo-carrito" style="font-size: 1rem; font-family: ls_r; color: #aaaaaa;" >Vaya, parece que no tienes ninguna tarjeta registrada. <a class="search-link" style="display:unset;" href="<?=ROOTURL?>?accion=agregar-tarjeta" >Registra Tu tarjeta</a>.</p>
                                </div>
                            </div>
                    <?php
                        }
                    }else{
                        echo "";
                    } ?>
				</div>
			</section>
				
			<div id="title-box-p-c" >
				<p class="titulo-carrito">¿C&oacute;mo quieres pagar?</p>
				<p class="titulo-p-c">$<?=number_format($totalVentaPagar, 2, '.', ',')?></p>
			</div>
		</div>
	</div>
    </form>

<?php
    } ?>