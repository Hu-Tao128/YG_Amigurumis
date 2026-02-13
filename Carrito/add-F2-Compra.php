<?php
require_once 'configuracion-cliente.php';
include 'MySqli_conexionDB.php';

$IDUsuario = (isset($_SESSION['cliente_session'])) ? $_SESSION['cliente_session'] : null;

$accion = $_POST['accion'];
$Nombre = $_POST['txtNombre'];
$Apellido = $_POST['txtAPaterno'];
$Calle = $_POST['txtCalle'];
$Colonia = $_POST['txtColonia'];
$CodigoPostal = $_POST['txtCP'];
$Ciudad = $_POST['txtCiudad'];
$Estado = $_POST['txtEstado'];
$FechaPedido = date("Y-m-d H:i:s");
$FechaEntrega = date("Y-m-d H:i:s");

$IDVentaAmigurumi = $_GET['v'];
$IDEnvio = (isset($_GET['e'])) ? $_GET['e'] : null;

    if( $accion = "add-F2-Compra"){ 
        if($IDEnvio == null){
            $query = "INSERT INTO envios (IDVentaAmigurumi, IDUsuario, Nombre, Apellido, Calle, Colonia, CodigoPostal, Ciudad, Estado, FechaPedido, FechaEntrega) VALUES ('$IDVentaAmigurumi', '$IDUsuario', '$Nombre', '$Apellido', '$Calle', '$Colonia', '$CodigoPostal', '$Ciudad', '$Estado', '$FechaPedido', '$FechaEntrega')";
        }else{
            $query = "UPDATE envios SET Nombre='$Nombre', Apellido='$Apellido', Calle='$Calle', Colonia='$Colonia', CodigoPostal='$CodigoPostal', Ciudad='$Ciudad', Estado='$Estado', FechaPedido='$FechaPedido', FechaEntrega='$FechaEntrega' WHERE IDUsuario=".$IDUsuario." and IDVentaAmigurumi=".$IDVentaAmigurumi;
        }

        if(!$resultado = mysqli_query($miConexion, $query)){ ?>
        <center>
            <br>
            <h2 class="fs-title">Error al intentar comprar los articulos<?=mysqli_error($miConexion)?></h2>
            <input type="button" value="Intentar de nuevo" onclick=self.location="<?=ROOTURL?>?accion=listCarrito" />
        </center>		
<?php 	
        }else{
            if($IDEnvio == null){  
                $DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');
        
                $query = "SELECT IDEnvio FROM envios WHERE IDUsuario=".$IDUsuarioCliente." and IDVentaAmigurumi=".$IDVentaAmigurumi;
                $resultado = $DBConexion2->query($query);
            
                $IDEnvio = $resultado->fetchColumn();    
            } ?>
            
            <div class="loader">
                <div class="load"></div>
            </div>
            <meta http-equiv="refresh" content="0;url=<?=ROOTURL?>?accion=informacion-de-contacto&v=<?=$IDVentaAmigurumi?>&e=<?=$IDEnvio?>">
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