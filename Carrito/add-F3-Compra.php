<?php
require_once 'configuracion-cliente.php';
include 'MySqli_conexionDB.php';

$IDUsuario = (isset($_SESSION['cliente_session'])) ? $_SESSION['cliente_session'] : null;

$accion = $_POST['accion'];
$Telefono = $_POST['txtTelefono'];
$Correo = $_POST['txtCorreo'];

$IDVentaAmigurumi = $_GET['v'];
$IDEnvio = (isset($_GET['e'])) ? $_GET['e'] : null;

    if( $accion = "add-F3-Compra"){
        if($IDEnvio == null){    
            $query = "UPDATE envios SET Telefono='$Telefono', Correo='$Correo' WHERE IDVentaAmigurumi=".$IDVentaAmigurumi;
        }else{
            $query = "UPDATE envios SET Telefono='$Telefono', Correo='$Correo' WHERE IDEnvio=".$IDEnvio." and IDVentaAmigurumi=".$IDVentaAmigurumi;
        }
        if(!$resultado = mysqli_query($miConexion, $query)){ ?>
        <center>
            <br>
            <h2 class="fs-title">Error al intentar comprar los articulos<?=mysqli_error($miConexion)?></h2>
            <input type="button" value="Intentar de nuevo" onclick=self.location="<?=ROOTURL?>?accion=listCarrito" />
        </center>		
<?php 	
        }else{ ?>
            <div class="loader">
                <div class="load"></div>
            </div>
            <meta http-equiv="refresh" content="0;url=<?=ROOTURL?>?accion=metodo-de-pago&v=<?=$IDVentaAmigurumi?>&e=<?=$IDEnvio?>">
<?php
		} 
    }else{ ?>
        <center>
            <br>
            <h2 class="fs-title">Opci&oacute;n incorrecta</h2>
            <input type="button" value="Ir al Carrito" onclick=self.location="<?=ROOTURL?>?accion=listCarrito" />
        </center>    
<?php
    } ?>