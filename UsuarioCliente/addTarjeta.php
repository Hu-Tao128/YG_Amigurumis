<?php
require_once('../configuracion-cliente.php');
include_once('../MySqli_conexionDB.php');
$accion = $_POST['accion'];
$IDUsuario = $_POST['IDUsuario'];
$NombreTitular = $_POST['NombreTitular'];
$Numero = $_POST['Numero'];
$FechaVencimiento = $_POST['FechaVencimiento'];
$CVC = $_POST['CVC'];
$Estado = 1;

if($accion = "addTarjeta"){
	$query = "INSERT INTO tarjetas (IDUsuario,NombreTitular,Numero,FechaVencimiento,CVC,Estado) VALUES ('$IDUsuario','$NombreTitular','$Numero','$FechaVencimiento','$CVC','$Estado')";
	
	$resultado = mysqli_query($miConexion,$query);
	if(!$resultado){ ?>
		<div id="listCarrito">
            <p class="titulo-carrito" >Upss...</p>
            <p class="subtitulo-carrito" >Ocurrió un error de conexi&oacute;. Revisa que tu conexi&oacute;n.</p>
            <div class="cta-btn" >
				<input class="c-c-btn" type="button" value="Seguir Comprando" onclick=self.location="<?=ROOTURL?>" />
			</div>
        </div>  
<?php
	}else{ ?>
		<div class="loader">
			<div class="load"></div>
		</div>
		<meta http-equiv="refresh" content="0;url=<?=ROOTURL?>?accion=listTarjetas">
<?php
	} 
}else{ ?>
	<div class="loader">
		<div class="load"></div>
	</div>
	<meta http-equiv="refresh" content="0;url=<?=ROOTURL?>?accion=listTarjetas">
<?php
} ?>