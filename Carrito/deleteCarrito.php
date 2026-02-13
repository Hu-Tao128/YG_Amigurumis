<?php
include('MySqli_conexionDB.php');

$IDUsuario = $_SESSION['cliente_session'];
$IDAmigurumi = $_GET['IDAmigurumi'];

$query = "DELETE FROM carrito WHERE IDAmigurumi=$IDAmigurumi and IDUsuario=$IDUsuario";

        if(!$resultado = mysqli_query($miConexion,$query))
		{	?>
            <center>
                <h3>Error al eliminar el registro</h3>
                <h3><?=mysqli_error($miConexion)?></h3>
                <input type="button" value="Ir a la lista de usuarios" onclick=self.location="<?=ROOTURL?>?accion=listCarrito" />
            </center>			
<?php   }else{	?>
            <div class="loader">
                <div class="load"></div>
            </div>
            <meta http-equiv="refresh" content="0;url=<?=ROOTURL?>?accion=listCarrito">
<?php   } ?>
