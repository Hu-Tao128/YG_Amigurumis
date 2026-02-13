<?php
    if(isset($_SESSION['cliente_session'])){
    include('MySqli_conexionDB.php');
    $IDUsuario = (isset($_SESSION['cliente_session'])) ? $_SESSION['cliente_session'] : null;
    $respuesta = isset($_GET['respuesta']) ? $_GET['respuesta']:null;
?>
<?php
	if(!$respuesta) { ?>
        <div class="form-eliminar tab-registrar">
            <div class="login-head" >
                <p class="titulo-carrito"><img class="title-icon" src="<?=IMG?>Iconos-Titulos/eliminar-mi-cuenta-title.svg"/>Eliminar Mi Cuenta</p>
                <p class="subtitulo-carrito">Si eliminas tu cuenta, toda tu informaci&oacute;n se eliminará para siempre y no podr&aacute;s recuperarla.</p>
            </div>
            <p class="pregunta-eliminar">¿Est&aacute;s seguro de eliminar tu cuenta YG?</p>
            <div class="eliminar-btns f-l-btns p-edit-btns" >
                <div class="cta-btn" >
                    <input type="button" class="c-c-btn" onclick=self.location="<?=ROOTURL?>?accion=perfil" value="Cancelar">
                    <input type="button" class="p-eliminar-btn btn-crear" onclick=self.location="<?=ROOTURL?>?accion=form-eliminar-cuenta&IDUsuario=<?=$IDUsuario?>&respuesta=Aceptar" value="Aceptar"/>
                </div>
            </div>
        </div>
<?php
    }else if($respuesta == "Aceptar"){
        $query = "DELETE FROM usuario_cliente WHERE IDUsuario=$IDUsuario";
        $resultado = mysqli_query($miConexion,$query);
        
        if(!$resultado){ ?>
            <center>	
				<h3>Upps... Ocurri&oacute; un error al intentar editar tu informaci&oacute;n</h3>
				<h3><?=mysqli_error($miconexion);?></h3>
				<input type="button" value="Volver a la p&aacute;gina" onclick=self.location="<?=ROOTURL?>" />
			</center>		
<?php
        }else{
	        unset($_SESSION['cliente_session']); ?>	
            <div class="loader">
                <div class="load"></div>
            </div>
            <meta http-equiv="refresh" content="0;url=<?=ROOTURL?>">
<?php
        }	
    }
}
?>