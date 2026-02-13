<?php
include('MySqli_conexionDB.php');

$IDUsuario = $_SESSION['cliente_session'];
$IDTarjeta = $_GET['IDTarjeta'];

$query = "DELETE FROM tarjetas WHERE IDTarjeta='$IDTarjeta' and IDUsuario='$IDUsuario'";

        if(!$resultado = mysqli_query($miConexion,$query))
		{	?>
            <center>
                <h3>Error al eliminar el registro</h3>
                <h3><?=mysqli_error($miConexion)?></h3>
                <input type="button" value="Volver a Tus Tarjetas" onclick=self.location="<?=ROOTURL?>?accion=listTarjetas" />
            </center>			
<?php   }else{	?>
            <div class="loader">
                <div class="load"></div>
            </div>
            <meta http-equiv="refresh" content="0;url=<?=ROOTURL?>?accion=listTarjetas">
<?php   } ?>
