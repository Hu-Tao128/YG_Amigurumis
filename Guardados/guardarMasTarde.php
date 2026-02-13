<?php
include('MySqli_conexionDB.php');

if(isset($_SESSION['cliente_session'])){

    $IDUsuario = $_SESSION['cliente_session'];
    $IDAmigurumi = $_GET['IDAmigurumi'];
    $accion = $_REQUEST['accion'];

    $query = "SELECT IDUsuario, IDAmigurumi FROM guardados WHERE IDUsuario='$IDUsuario' and IDAmigurumi='$IDAmigurumi' ";
    $resultado = mysqli_query($miConexion, $query);
    
    if(mysqli_num_rows($resultado) > 0) {
        $query = "UPDATE guardados SET F_Guardado=now() WHERE IDUsuario='$IDUsuario' and IDAmigurumi='$IDAmigurumi';";
    }else{
        $query = "INSERT INTO guardados(IDUsuario,IDAmigurumi,F_Guardado) VALUES ('$IDUsuario','$IDAmigurumi',now()); ";
    }


    if(!$resultado = mysqli_query($miConexion,$query)){ ?>
        <div id="listCarrito">
            <p class="titulo-carrito" >Upss...</p>
            <p class="subtitulo-carrito" >Ocurrió un error de conexi&oacute;. Revisa que tu conexi&oacute;n.</p>
            <div class="cta-btn" >
                <input class="c-c-btn" type="button" value="Seguir Comprando" onclick=self.location="<?=ROOTURL?>?accion=verTodo" />
            </div>
        </div> 
    <?php
    }else{
    ?>
        <div class="loader">
            <div class="load"></div>
        </div>
        <meta http-equiv="refresh" content="0;url=<?=ROOTURL?>?accion=eliminar-del-carrito&vista=enCarrito&IDAmigurumi=<?=$IDAmigurumi?>">
    <?php
    }
}else{ ?>
    <div class="loader">
        <div class="load"></div>
    </div>
    <meta http-equiv="refresh" content="0;url=<?=ROOTURL?>?accion=listGuardados">
<?php } ?>