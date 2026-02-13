<!DOCTYPE html>
<html lang="es">
    <head>
		<meta charset="UTF-8">
		<meta name="author" content="<?=AUTOR?>" >
        <meta name=”viewport” content="width=device-width, intial-scale=1.0">
        <?php
            $IDUsuario = (isset($_SESSION['cliente_session'])) ? $_SESSION['cliente_session'] : null;
            $IDUsuarioCarrito = (isset($_SESSION['cliente_session'])) ? $_SESSION['cliente_session'] : null;
            
            require_once 'funciones-cliente.php';
            $IDAmigurumi = (isset($_GET['IDAmigurumi'])) ? $_GET['IDAmigurumi'] : null;

            //btn Guardados

            $DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');
            $query = "SELECT guardados.IDUsuario FROM guardados INNER JOIN amigurumis on guardados.IDAmigurumi=amigurumis.IDAmigurumi INNER JOIN categorias on amigurumis.IDCategoria=categorias.IDCategoria WHERE amigurumis.Estado='DISPONIBLE' and categorias.Estado='DISPONIBLE' and guardados.IDUsuario='$IDUsuario' and guardados.IDAmigurumi='$IDAmigurumi' ";
	        $resultado = $DBConexion2->query($query);
            $btnGuardadosIDUsuario = $resultado->fetchColumn();

            $DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');
            $query = "SELECT guardados.IDAmigurumi FROM guardados INNER JOIN amigurumis on guardados.IDAmigurumi=amigurumis.IDAmigurumi INNER JOIN categorias on amigurumis.IDCategoria=categorias.IDCategoria WHERE amigurumis.Estado='DISPONIBLE' and categorias.Estado='DISPONIBLE' and guardados.IDUsuario='$IDUsuario' and guardados.IDAmigurumi='$IDAmigurumi' ";
	        $resultado = $DBConexion2->query($query);
            $btnGuardadosIDAmigurumis = $resultado->fetchColumn();

            $btnGuardados = $btnGuardadosIDUsuario . " " . $btnGuardadosIDAmigurumis;

            // Carrito 

            $DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');

            $query = "SELECT SUM(carrito.Cantidad) as total FROM carrito INNER JOIN amigurumis on carrito.IDAmigurumi=amigurumis.IDAmigurumi INNER JOIN categorias on amigurumis.IDCategoria=categorias.IDCategoria WHERE amigurumis.Estado='DISPONIBLE' and categorias.Estado='DISPONIBLE' and carrito.IDUsuario='$IDUsuario' ";
            $resultado = $DBConexion2->query($query);

            $cantCarrito = $resultado->fetchColumn();

            //Guardados

            $DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');

            $query = "SELECT COUNT(guardados.IDUsuario) as total FROM guardados INNER JOIN amigurumis on guardados.IDAmigurumi=amigurumis.IDAmigurumi INNER JOIN categorias on amigurumis.IDCategoria=categorias.IDCategoria WHERE amigurumis.Estado='DISPONIBLE' and categorias.Estado='DISPONIBLE' and guardados.IDUsuario='$IDUsuario' ";
            $resultado = $DBConexion2->query($query);

            $cantGuardados = $resultado->fetchColumn();

        ?>
		<title>
            <?php
                if($cantCarrito >= "1"){
                    echo "($cantCarrito)";
                }else{
                    echo "";
                }
            ?> 
        </title>
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	    <link rel="icon" href="favicon.ico" type="image/x-icon" />

		<!--		Diseño			-->
		<link rel="stylesheet" type="text/css" href="<?=CSS?>cliente-loading.css" />
		<link rel="stylesheet" type="text/css" href="<?=CSS?>cliente-menu-02.css" />
		<link rel="stylesheet" type="text/css" href="<?=CSS?>cliente-login.css" />
		<link rel="stylesheet" type="text/css" href="<?=CSS?>cliente-registrar-02.css" />
		<link rel="stylesheet" type="text/css" href="<?=CSS?>cliente-contenido-02.css" />
		<link rel="stylesheet" type="text/css" href="<?=CSS?>cliente-sobreYG.css" />
		<link rel="stylesheet" type="text/css" href="<?=CSS?>cliente-contacto.css" />
		<link rel="stylesheet" type="text/css" href="<?=CSS?>cliente-producto-detalle-02.css" />
		<link rel="stylesheet" type="text/css" href="<?=CSS?>cliente-carrito-03.css" />
		<link rel="stylesheet" type="text/css" href="<?=CSS?>cliente-guardados-02.css" />
		<link rel="stylesheet" type="text/css" href="<?=CSS?>cliente-tarjetas.css" />
		<link rel="stylesheet" type="text/css" href="<?=CSS?>cliente-perfil-02.css" />
		<link rel="stylesheet" type="text/css" href="<?=CSS?>cliente-modal.css" />
		<link rel="stylesheet" type="text/css" href="<?=CSS?>cliente-search-03.css" />
		<link rel="stylesheet" type="text/css" href="<?=CSS?>cliente-footer.css" />

		<!--		Paginas			-->
		<link rel="stylesheet" type="text/css" href="<?=CSS?>cliente_llaveros.css" />

		<!--		Fonts			-->
		<link rel="stylesheet" type="text/css" href="<?=CSS?>global_fonts.css" />

        <!--           JS           -->
        <script src="<?=JS?>filterProductos.js"></script>

        <style>
            .info-descripcion{
                white-space: pre-wrap;
            }

            .p-descripcion{
                display: -webkit-box;
                -webkit-box-orient: vertical;
                -webkit-line-clamp: 3;
                white-space: pre-wrap;
                overflow: hidden;
                overflow-wrap: anywhere;
            }

            .foto-p-c{
                object-fit: cover;
            }
        </style>

	</head>
	<body>
 <!----------------------- Variables ----------------------->

    <?php
        $opcion="";
        $accion="";
        if(isset($_GET['accion'])){
            $menuactivo="current-menu-item"; 
            $opcion = $accion=$_GET['accion'];
            if($accion=="addTarjetas" || $accion=="listTarjetas" || $accion=="misCompras" ){
                $opcion="miEspacio";
            }else{
                $menuactivo="";
            }
        }
    ?>

<!----------------------- Header ----------------------->
    <div id="navbar">
        <div class="nav-container">
            <div class="navbar_1stbox">
                <div class="firstbox-element-logo">
                    <a href="<?=ROOTURL?>"><img class="navbar_logo" src="<?=IMG?>Logo/yg - svg/yg_color.svg"></a>
                </div>
                <div class="firstbox-element-links">
                    <ul class="navbar_nav_box" >
                        <a href="<?=ROOTURL?>?accion=verTodo"><li class="action-btn" >Productos</li></a>
                        <a href="<?=ROOTURL?>?accion=amigurumis"><li class="action-btn" >Amigurumis</li></a>
                        <a href="<?=ROOTURL?>?accion=accesorios"><li class="action-btn" >Accesorios</li></a>
                        <!-- <li class="action-btn" >Amigurumis
                                <ul>
                                    <li class="action-btn" >Amigurumis</li>
                            </ul>
                        </li> -->
                                
                                <!-- <li class="</?=$opcion=="miEspacio"?$menuactivo:""?>"> <a href="</?=ROOTURL?>?accion=miEspacio">Mi espacio</a>
                                    <ul>
                                        <li><a href="</?=ROOTURL?>?accion=misCompras">Mis compras</a></li>
                                        <li><a href="</?=ROOTURL?>?accion=addTarjetas">Agregar Tarjetas </a></li>
                                        <li><a href="</?=ROOTURL?>?accion=listTarjetas">Lista de Tarjetas </a></li>
                                    </ul>
                                </li> -->

                        <!-- <a href="</?=ROOTURL?>?accion=personaliza_tu_amigurumi"><li class="action-btn" >Crea Tu Amigurumi</li></a> -->
                        <a href="<?=ROOTURL?>?accion=llaveros"><li class="action-btn" >Llaveros</li></a>
                        <a href="<?=ROOTURL?>?accion=peculiaridades"><li class="action-btn" >Peculiaridades</li></a>
                        <!-- <a href="</?=ROOTURL?>?accion=patrones"><li class="action-btn">Patrones</li></a> -->
                    </ul>
                </div>
                <div class="firstbox-element-action-btn">
                    <form id="search" action="<?=ROOTURL?>?accion=search" method="get">
                        <div class="search-box">
                            <button id="search" class="btn-search" type="search" name="accion" value="search" >
                                <img class="icon-carrito" src="<?=IMG?>Menu/search/search-v2.svg"/>
                            </button>
                            <input class="input-search" name="palabra" id="palabra" type="search" placeholder="Busca en YG" required autocomplete="off">
                        </div>
                    </form>

                    <a href="<?=ROOTURL?>?accion=listCarrito">
                        <div class="num-carrito-box" >
                            <?php 
                            if($cantCarrito != 0){ ?>
                            <div class="num-carrito" >
                                <div class="num-carrito-txt" >
                                    <?=$cantCarrito?>
                                </div>
                            </div>
                            <img class="icon-carrito" src="<?=IMG?>Menu/carrito/carrito-0-v2.svg"/>
                            <?php
                            }elseif($cantCarrito >= 99 ){ ?>
                            <div class="num-carrito" >
                                <div class="num-carrito-txt" >
                                    <?php echo "+99";?>
                                </div>
                            </div>
                            <img class="icon-carrito" src="<?=IMG?>Menu/carrito/carrito-0-v2.svg"/>
                            <?php
                            }else{ ?>
                                <?php echo "";?>
                                <img class="icon-carrito icon-carrito-vacio" src="<?=IMG?>Menu/carrito/carrito-0-v2.svg"/>
                            <?php
                            } ?>
                        </div>
                    </a>

    <!------------------------------------------------------ Aquí se muestra el menú de opciones de acuerdo si se que inició sesión o no ------------------------------------------------------------------------->

                    <?php if(isset($_SESSION['cliente_session'])){ ?>
                        <?php 
                            require_once 'funciones-cliente.php';

                            $IDUsuarioCliente = (isset($_SESSION['cliente_session'])) ? $_SESSION['cliente_session'] : null;
                            $datosFotoPerfil = obtenerDatosUsuarioCliente($IDUsuarioCliente);

                            if($datosFotoPerfil!=null){ 
                                $Perfil=$datosFotoPerfil['mostrarPerfil'];
                                $NombreUsuario=$datosFotoPerfil['Nombre'];
                                $ApellidoUsuario=$datosFotoPerfil['APaterno'];
                                ?>
                    <div class="first-action-btn"><img class="icons" src="<?=$Perfil?>" style="object-fit:cover; border-radius: 90px 90px 90px 90px; background-color: #EEEEEE;"/> <?=$NombreUsuario?> <?=$ApellidoUsuario?>
                            <?php	
                                }	
                            ?>
                        <ul class="hts-opt">
                            <a href="<?=ROOTURL?>?accion=perfil"><div class="hts-action-btn" ><img class="icons" src="<?=IMG?>Menu/perfil/perfil-v2.svg"/>Perfil</div></a>
                            <a href="<?=ROOTURL?>?accion=listGuardados"><div class="hts-action-btn" ><img class="icons" src="<?=IMG?>Menu/perfil/guardados-v2.svg">
                            Guardados
                            <?php if($cantGuardados != 0){
                                echo " ($cantGuardados)";
                            }else{
                                echo "";
                            }
                            ?></div></a>
                            <a href="<?=ROOTURL?>?accion=mis-pedidos"><div class="hts-action-btn" ><img class="icons" src="<?=IMG?>Menu/perfil/compra-v2.svg"/>Mis Pedidos</div></a>
                            <a href="<?=ROOTURL?>?accion=listTarjetas"><div class="hts-action-btn" ><img class="icons" src="<?=IMG?>Menu/perfil/tarjeta-v2.svg"/>Mis Tarjetas</div></a>
                            <a  href="IniciarSesion/logout-cliente.php" ><div class="hts-action-btn" ><img class="icons" src="<?=IMG?>Menu/perfil/salir.svg"/>Salir</div></a>
                        </ul>
                    </div>
                    
                    <?php } else { ?>       
                        <a href="<?=ROOTURL?>?accion=formLogin"><div class="first-action-btn-02"><img class="icons" src="<?=IMG?>Menu/perfil/dft-perfil-v3.svg"/><div style="margin-right: 0.3rem;">Iniciar Sesi&oacute;n</div></div></a>
                    <?php } ?>
                </div>            
            </div> 
        </div>    
    </div>

    <script src="<?=JS?>Menu-stickyNav.js"></script>
<!------------------------------------------------------------------------------------------ Contenido ------------------------------------------------------------------------------------------------------->
	<div id="contenido" >