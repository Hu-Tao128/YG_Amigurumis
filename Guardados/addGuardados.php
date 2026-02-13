<?php
include('MySqli_conexionDB.php');
require_once 'funciones-cliente.php';

if(isset($_SESSION['cliente_session'])){

    if(isset($_SERVER['HTTP_REFERER'])) {
        $URL = parse_url($_SERVER['HTTP_REFERER']);
        parse_str($URL['query'], $query);
    }

$URL = $query['accion'];
$IDUsuario = $_SESSION['cliente_session'];
$IDAmigurumi = $_GET['IDAmigurumi'];

    if(isset($query['palabra'])) {
        $palabra = $query['palabra'];
        $datosAmigurumi=obtenerBusqueda($palabra);
    }
    
    $query = "SELECT IDUsuario, IDAmigurumi FROM guardados WHERE IDUsuario='$IDUsuario' and IDAmigurumi='$IDAmigurumi' ";
    $resultado = mysqli_query($miConexion, $query);

    if (mysqli_num_rows($resultado) > 0) {
        $query = "UPDATE guardados SET F_Guardado=now() WHERE IDUsuario='$IDUsuario' and IDAmigurumi='$IDAmigurumi' ";
    } else {
        $query = "INSERT INTO guardados(IDUsuario,IDAmigurumi,F_Guardado) VALUES ('$IDUsuario','$IDAmigurumi',now())";
    }

	if(!$resultado = mysqli_query($miConexion,$query))
    { ?>
		<div id="listCarrito">
            <p class="titulo-carrito" >Upss...</p>
            <p class="subtitulo-carrito" >Ocurrió un error de conexi&oacute;. Revisa que tu conexi&oacute;n.</p>
            <div class="cta-btn" >
				<input class="c-c-btn" type="button" value="Seguir Comprando" onclick=self.location="<?=ROOTURL?>" />
			</div>
        </div>     
	    <?php   } else { ?>
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
                }else{ ?>
                <meta http-equiv="refresh" content="0;url=<?=ROOTURL?>listGuardados">
            <?php
                } ?>
<?php		}	
        }else{?>
            <div class="loader">
                <div class="load"></div>
            </div>
            <meta http-equiv="refresh" content="0;url=<?=ROOTURL?>?accion=listGuardados">
<?php   }?>