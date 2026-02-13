<?php
require_once 'configuracion-cliente.php';
include 'MySqli_conexionDB.php';

$IDUsuario = (isset($_SESSION['cliente_session'])) ? $_SESSION['cliente_session'] : null;

$accion = $_POST['accion'];

// $FechaVenta = date("Y-m-d H:i:s");
$metodoPago = $_POST['metodoPago'];

if($metodoPago == "Efectivo"){
    $infoMetodoPago = "Efectivo";
}else{
    $infoMetodoPago = $_POST['infoMetodoPago'];
}

$Estado = "PAGADO";

$IDVentaAmigurumi = $_GET['v'];
$IDEnvio = (isset($_GET['e'])) ? $_GET['e'] : null;

    if( $accion = "add-F4-Compra"){
        $query = "UPDATE envios SET FechaPedido=now() WHERE IDEnvio=".$IDEnvio." and IDVentaAmigurumi=".$IDVentaAmigurumi;
        if(!$resultado = mysqli_query($miConexion, $query)){ ?>
        <center>
            <br>
            <h2 class="fs-title">Error al intentar comprar los articulos<?=mysqli_error($miConexion)?></h2>
            <input type="button" value="Intentar de nuevo" onclick=self.location="<?=ROOTURL?>?accion=listCarrito" />
        </center>		
<?php 	
        }else{
            $DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');
            $query = "SELECT DATE_ADD(FechaPedido, INTERVAL 8 DAY) AS later_date FROM envios WHERE IDEnvio=".$IDEnvio." and IDVentaAmigurumi=".$IDVentaAmigurumi;
            $resultado = $DBConexion2->query($query);
            $FechaEntrega = $resultado->fetchColumn();

            $query = "UPDATE envios SET FechaEntrega='$FechaEntrega' WHERE IDEnvio=".$IDEnvio." and IDVentaAmigurumi=".$IDVentaAmigurumi;
            if(!$resultado = mysqli_query($miConexion, $query)){ 
                
            }else{
                $query = "UPDATE pedidos_amigurumis SET FechaRegistro=now() , MetodoPago='$metodoPago', InfoMetodoPago='$infoMetodoPago', Estado='$Estado' WHERE IDVentaAmigurumi=".$IDVentaAmigurumi;
                
                if(!$resultado = mysqli_query($miConexion, $query)){ 
            
                }else{
                    require_once 'funciones-cliente.php';
                    $listCarrito = obtenerCarrito($IDUsuarioCarrito);
                    
                    if ($listCarrito!=null){
                        foreach($listCarrito as $campos){
                            $DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');
                            $query = "SELECT Existencias FROM amigurumis WHERE IDAmigurumi=".$campos['IDAmigurumi'] ;
                            $resultado = $DBConexion2->query($query);
                            $amountStock = $resultado->fetchColumn();

                            $DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');
                            $query = "SELECT Cantidad FROM venta_detalles_amigurumis WHERE IDAmigurumi=".$campos['IDAmigurumi']." and IDVentaAmigurumi=".$IDVentaAmigurumi;
                            $resultado = $DBConexion2->query($query);
                            $updateStock = $resultado->fetchColumn();

                            $upToDateStock = $amountStock - $updateStock;

                            $DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');
                            $query = "UPDATE amigurumis SET Existencias='$upToDateStock' WHERE IDAmigurumi=".$campos['IDAmigurumi'];
                            $resultado = $DBConexion2->query($query);
                        }
                    }

                    $DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');
                    $query = "SELECT DATE_ADD(FechaPedido, INTERVAL 8 DAY) AS later_date FROM envios WHERE IDEnvio=".$IDEnvio." and IDVentaAmigurumi=".$IDVentaAmigurumi;
                    $resultado = $DBConexion2->query($query);
                    $FechaEntregaRecibir = $resultado->fetchColumn();

                    $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                    $months_es_MX = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                    $monthName = str_replace($months, $months_es_MX, date("F", strtotime($FechaEntregaRecibir)));

                    $dateEntrega = date_create($FechaEntregaRecibir);

                    $DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');
                    $query = "DELETE FROM carrito WHERE IDUsuario=".$IDUsuarioCliente;
                    $resultado = $DBConexion2->query($query);

                    ?>

                    <div id="listCarrito">
                        <div class="sugerencias-carrito">
                            <p class="titulo-carrito">Tu compra fue un &eacute;xito</p>
                            <p class="subtitulo-carrito" style="margin-bottom: 0.5rem; margin-top: 3rem; color: #4D4D4D; font-family: ls_sb; font-size: 1.5rem; " >Recibiras tu pedido el <?=date_format($dateEntrega,"j");?> de <?=$monthName?> de <?=date_format($dateEntrega,"Y");?>.</p>
                            <p class="subtitulo-carrito" >Pod&aacute;s encontrar el link de descarga para tu patr&oacute;n en el apartado de "<a class="search-link" style="display:unset;" href="<?=ROOTURL?>?accion=mis-pedidos" >Mis Pedidos</a>".</p>
                            <div style="justify-content: center; margin-top:3rem;" class="c-i-btns" >
                                <div class="cta-btn" >
                                    <input class="c-c-btn" type="button" value="Seguir viendo" onclick=self.location="<?=ROOTURL?>" />
                                    <input class="c-btn" type="button" value="Ver mis pedidos" onclick=self.location="<?=ROOTURL?>?accion=mis-pedidos" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <meta http-equiv="refresh" content="0;url=</?=ROOTURL?>?accion=mis-compras"> -->
            <?php
                }
            }        
            
		} 
    }else{ ?>
        <center>
            <br>
            <h2 class="fs-title">Opci&oacute;n incorrecta</h2>
            <input type="button" value="Ir al Carrito" onclick=self.location="<?=ROOTURL?>?accion=listCarrito" />
        </center>    
<?php
    } ?>