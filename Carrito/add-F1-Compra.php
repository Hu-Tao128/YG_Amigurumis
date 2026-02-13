<?php
require_once 'configuracion-cliente.php';
include 'MySqli_conexionDB.php';

require_once 'funciones-cliente.php';
$listCarrito = obtenerCarrito($IDUsuarioCarrito);

$IDEnvio = (isset($_GET['e'])) ? $_GET['e'] : null;
$IDVentaAmigurumi = (isset($_GET['v'])) ? $_GET['v'] : null;

$accion = $_POST['accion'];
$listArticulos = $_POST['listArticulos'];
$IDUsuario = $_POST['IDUsuario'];
$cantArticulos = $_POST['cantArticulos'];
$Subtotal = $_POST['subtotal'];
$IVA = $_POST['IVA'];
$total = $_POST['total'];
$FechaRegistro = date("Y-m-d H:i:s");
$VentaEn = "WEB";
$Estado = "PROCESO";

    if( $accion = "add-F1-Compra"){ 
        if(isset($_GET['v']) && isset($_GET['e'])){
            $query = "UPDATE pedidos_amigurumis SET FechaRegistro='$FechaRegistro' WHERE IDUsuario=".$IDUsuario." and IDVentaAmigurumi=".$IDVentaAmigurumi;
        }elseif(isset($_GET['v']) && isset($_GET['e']) == null){
            $query = "UPDATE pedidos_amigurumis SET FechaRegistro='$FechaRegistro' WHERE IDUsuario=".$IDUsuario." and IDVentaAmigurumi=".$IDVentaAmigurumi;
        }else{
            $query = "INSERT INTO pedidos_amigurumis (IDUsuario, Cantidad, Subtotal, IVA, Total, FechaRegistro, MetodoPago, InfoMetodoPago, VentaEn, Estado) VALUES ('$IDUsuario', '$cantArticulos', '$Subtotal', '$IVA', '$total', '$FechaRegistro', 'Indefinido', 'Indefinido', '$VentaEn', '$Estado')";
        }

        if(!$resultado = mysqli_query($miConexion, $query)){ ?>
        <center>
            <br>
            <h2 class="fs-title">Error al intentar comprar los articulos<?=mysqli_error($miConexion)?></h2>
            <input type="button" value="Intentar de nuevo" onclick=self.location="<?=ROOTURL?>?accion=listCarrito" />
        </center>		
<?php 	
        }else{		
            $ultimoIDregistrado = mysqli_insert_id($miConexion); 
            $IDVentaAmigurumi = $ultimoIDregistrado;
            
            foreach($listArticulos as $campos)
            {
                $IDAmigurumi = $campos['IDAmigurumi'];
                $Cantidad = $campos['Cantidad'];
                $Precio = $campos['Precio'];
                $Importe = $campos['Importe'];
                $query = "INSERT INTO venta_detalles_amigurumis(IDVentaAmigurumi, IDAmigurumi, Cantidad, Precio, Importe) VALUES ('$IDVentaAmigurumi', '$IDAmigurumi', '$Cantidad', '$Precio', '$Importe')";
                mysqli_query($miConexion,$query);
            }
		} ?>
        <div class="loader">
            <div class="load"></div>
        </div>
        <meta http-equiv="refresh" content="0;url=<?=ROOTURL?>?accion=direccion-de-envio&v=<?=$IDVentaAmigurumi?>">
<?php
    }else{ ?>
        <center>
            <br>
            <h2 class="fs-title">Opci&oacute;n incorrecta</h2>
            <input type="button" value="Ir al Carrito" onclick=self.location="<?=ROOTURL?>?accion=listCarrito" />
        </center>    
<?php
    } ?>