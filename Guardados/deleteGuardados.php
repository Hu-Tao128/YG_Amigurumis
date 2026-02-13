<?php
include('MySqli_conexionDB.php');
require_once 'funciones-cliente.php';

if(isset($_SERVER['HTTP_REFERER'])) {
    $URL = parse_url($_SERVER['HTTP_REFERER']);
    parse_str($URL['query'], $query);
}

$URL = $query['accion'];

if(isset($query['palabra'])) {
    $palabra = $query['palabra'];
    $datosAmigurumi=obtenerBusqueda($palabra);
}

$IDUsuario = $_SESSION['cliente_session'];
$IDAmigurumi = $_GET['IDAmigurumi'];

$query = "DELETE FROM guardados WHERE IDAmigurumi=$IDAmigurumi and IDUsuario=$IDUsuario";

        if(!$resultado = mysqli_query($miConexion,$query))
		{	?>
            <center>
                <h3>Error al eliminar el registro</h3>
                <h3><?=mysqli_error($miConexion)?></h3>
                <input type="button" value="Ir a la lista de usuarios" onclick=self.location="<?=ROOTURL?>?accion=listGuardados" />
            </center>			
<?php   }else{	?>
            <div class="loader">
                <div class="load"></div>
            </div>
            <?php
                if($URL == 'verProducto'){ ?>
                <!-- <meta http-equiv="refresh" content="0;url=</?=$URL?>"> -->
                <meta http-equiv="refresh" content="0;url=<?=ROOTURL?>?accion=verProducto&IDAmigurumi=<?=$IDAmigurumi?>">
            <?php
                }elseif($URL == 'verTodo'){ ?>
                <meta http-equiv="refresh" content="0;url=<?=ROOTURL?>?accion=verTodo">    
            <?php
                }elseif($URL == 'search'){ ?>
                <meta http-equiv="refresh" content="0;url=<?=ROOTURL?>?accion=search&palabra=<?=$palabra?>">    
            <?php
                }elseif($URL == 'patrones'){ ?>
                <meta http-equiv="refresh" content="0;url=<?=ROOTURL?>?accion=patrones">    
            <?php
                }elseif($URL == 'amigurumis'){ ?>
                <meta http-equiv="refresh" content="0;url=<?=ROOTURL?>?accion=amigurumis">    
            <?php
                }elseif($URL == 'llaveros'){ ?>
                <meta http-equiv="refresh" content="0;url=<?=ROOTURL?>?accion=llaveros">    
            <?php
                }elseif($URL == 'peculiaridades'){ ?>
                <meta http-equiv="refresh" content="0;url=<?=ROOTURL?>?accion=peculiaridades">    
            <?php
                }elseif($URL == 'listGuardados'){ ?>
                <meta http-equiv="refresh" content="0;url=<?=ROOTURL?>?accion=listGuardados">    
            <?php
                }else{ ?>
                <meta http-equiv="refresh" content="0;url=<?=ROOTURL?>listGuardados">
            <?php
                } ?>
<?php   } ?>
