<?php
    require_once 'configuracion-cliente.php';
    include 'MySqli_conexionDB.php';
	require_once 'funciones-cliente.php';


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

    if((isset($_GET['v'])) != null){
        function obtenerVentaAmigurumis($IDVentaAmigurumi){
            include('MySqli_conexionDB.php');
            
            $query = "SELECT Nombre, Apellido, Calle, Colonia, CodigoPostal, Ciudad, Estado FROM envios WHERE IDUsuario=".$_SESSION['cliente_session']." and IDVentaAmigurumi=".$IDVentaAmigurumi;
            
            if(!$resultado = mysqli_query($miConexion, $query)){ 
                exit(mysqli_error($miConexion));
            }
            $datosVentaAmigurumi = array();
            
            if(mysqli_num_rows($resultado) > 0)
            {
                while($renglon =mysqli_fetch_assoc($resultado) )
                {	
                    $datosVentaAmigurumi = array(
                                'Nombre' => $renglon['Nombre'],
                                'Apellido' => $renglon['Apellido'],
                                'Calle' => $renglon['Calle'],
                                'Colonia' => $renglon['Colonia'],
                                'CodigoPostal' => $renglon['CodigoPostal'],
                                'Ciudad' => $renglon['Ciudad'],
                                'Estado' => $renglon['Estado']
                                );			
                }
            }
            return $datosVentaAmigurumi;
        }

        $datosVenta = obtenerVentaAmigurumis($IDVentaAmigurumi);
    }


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

	<!-- 2 | ¿A donde enviamos tu pedido? -->
<?php
    if(isset($_GET['e'])){ ?>
        <form name="frmPedidoF2" id="frmPedidoF2" action="<?=ROOTURL?>?accion=add-F2-Compra&v=<?=$IDVentaAmigurumi?>&e=<?=$IDEnvio?>" method="POST" >
<?php
    }else{ ?>
        <form name="frmPedidoF2" id="frmPedidoF2" action="<?=ROOTURL?>?accion=add-F2-Compra&v=<?=$IDVentaAmigurumi?>" method="POST" >
<?php
    }?>
    <div class="">
		<div id="listCarrito-2">

			<section class="closing-info">
				<div class="c-i-btns" >
					<div class="cta-btn" >
                    <?php
                        if(isset($_SESSION['cliente_session']) && $cantCarrito!=null){ 
                            if(isset($_GET['e'])){?>
						        <button type="button" class="c-c-btn" id="prevBtn" onclick=self.location="<?=ROOTURL?>?accion=personalizarCompra&v=<?=$IDVentaAmigurumi?>&e=<?=$IDEnvio?>">Regresar</button>
                    <?php   
                            }else{ ?>
						        <button type="button" class="c-c-btn" id="prevBtn" onclick=self.location="<?=ROOTURL?>?accion=personalizarCompra&v=<?=$IDVentaAmigurumi?>">Regresar</button>   
                    <?php   
                            }
                        }else{ ?>
						    <button type="button" class="c-c-btn" id="prevBtn" onclick=self.location="<?=ROOTURL?>?accion=listCarrito">Cancelar Proceso</button>
                    <?php
                        } ?>
                        <input type="submit" class="c-btn" name="btnPedidoF2" id="btnPedidoF2" value="Detalles de contacto"/>
					</div>
				</div>
			</section>
			
			<section class="personalizar-compra-container" >
				<input type="hidden" name="accion" id="accion" value="add-F2-Compra" />
				<input type="hidden" name="txtNombre" id="txtNombre" value="<?php
                            if($datosVenta != null){
                                echo $datosVenta['Nombre'];
                            }else{
                                echo $datosCliente['Nombre'];
                            }
                        ?>" />
				<input type="hidden" name="txtAPaterno" id="txtAPaterno" value="<?php
                            if($datosVenta != null){
                                echo $datosVenta['Apellido'];
                            }else{
                                echo $datosCliente['APaterno'];
                            }
                        ?>" />

				<div class="login-head" >
					<p class="subtitulo-carrito">Ingresa tu informaci&oacute;n de domicilio.</p>
				</div>
				<div class="tab-form-registrar" >
					<div class="input-registrar">
						<label class="form-label-registrar" >Nombre</label>
						<input class="form-input-registrar" type="text" value="<?php
                            if($datosVenta != null){
                                echo $datosVenta['Nombre'];
                            }else{
                                echo $datosCliente['Nombre'];
                            }
                        ?>" readonly disabled/>
					</div>
					<div class="input-registrar">
						<label class="form-label-registrar" >Primer Apellido</label>
						<input class="form-input-registrar" type="text" value="<?php
                            if($datosVenta != null){
                                echo $datosVenta['Apellido'];
                            }else{
                                echo $datosCliente['APaterno'];
                            }
                        ?>" readonly disabled/>
					</div>
					<div class="input-registrar">
						<label class="form-label-registrar" >Calle</label>
						<input class="form-input-registrar" type="text" name="txtCalle" id="txtCalle" value="<?php
                            if($datosVenta != null){
                                echo $datosVenta['Calle'];
                            }else{
                                echo "";
                            }
                        ?>" required <?php
                            if($datosVenta == null){
                                echo "autofocus";
                            }else{
                                echo "";
                            }
                        ?> />
					</div>
                    <div class="input-registrar">
						<label class="form-label-registrar" >Colonia</label>
						<input class="form-input-registrar" type="text" name="txtColonia" id="txtColonia" value="<?php
                            if($datosVenta != null){
                                echo $datosVenta['Colonia'];
                            }else{
                                echo "";
                            }
                        ?>" required />
					</div>
					<div class="input-registrar">
						<label class="form-label-registrar" title="C&oacute;digo Postal" >C.P.</label>
						<input class="form-input-registrar" type="text" name="txtCP" id="txtCP" value="<?php
                            if($datosVenta != null){
                                echo $datosVenta['CodigoPostal'];
                            }else{
                                echo "";
                            }
                        ?>" required maxlength="5"/>
					</div>
					<div class="input-registrar">
						<label class="form-label-registrar" >Ciudad</label>
						<input class="form-input-registrar" type="text" name="txtCiudad" id="txtCiudad" value="<?php
                            if($datosVenta != null){
                                echo $datosVenta['Ciudad'];
                            }else{
                                echo "";
                            }
                        ?>" required />
					</div>
					<div class="input-registrar">
						<label class="form-label-registrar" >Estado</label>
						<input class="form-input-registrar" type="text" name="txtEstado" id="txtEstado" value="<?php
                            if($datosVenta != null){
                                echo $datosVenta['Estado'];
                            }else{
                                echo "";
                            }
                        ?>" required />
					</div>  
				</div>
			</section>
				
			<div id="title-box-p-c" >
				<p class="titulo-carrito">¿A d&oacute;nde enviamos tu pedido?</p>
				<p class="titulo-p-c">$<?=number_format($totalVentaPagar, 2, '.', ',')?></p>
			</div>
		</div>
	</div>
    </form>

<?php
	} ?>

<!-- <input type="submit" class="c-btn btn-crear" name="btnRegistrarUsuario" id="btnRegistrarUsuario" value="Crear Cuenta"/> -->


