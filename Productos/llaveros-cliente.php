<section class="productos-head-2" >
    <h2>Llaveros</h2>
</section>
<section id="ordenar-por-box">
    <div class="ordenar-select " >
    <?php
        require_once 'funciones-cliente.php';
        $DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');
        $query = "SELECT COUNT(IDAmigurumi) FROM amigurumis INNER JOIN categorias on amigurumis.IDCategoria=categorias.IDCategoria WHERE amigurumis.Estado='DISPONIBLE' and categorias.Estado='DISPONIBLE' and amigurumis.Producto='Llavero' ";
        $resultado = $DBConexion2->query($query);
        $amountProducts = $resultado->fetchColumn();

        $option = "";
        $option=(isset($_GET['option']))?$_GET['option']:null;

        if($option == "mas-relevantes"){ ?>
            <div class="ordenar-select-title" >Ordenar por: M&aacute;s relevantes<img class="down-icon" src="<?=IMG?>Home/deslizar-abajo.svg"/></div>
    <?php
        }elseif($option == "nombres"){ ?>
            <div class="ordenar-select-title" >Ordenar por: Nombre<img class="down-icon" src="<?=IMG?>Home/deslizar-abajo.svg"/></div>
    <?php
        }elseif($option == "mayor-precio"){ ?>
            <div class="ordenar-select-title" >Ordenar por: Mayor Precio<img class="down-icon" src="<?=IMG?>Home/deslizar-abajo.svg"/></div>
    <?php
        }elseif($option == "menor-precio"){ ?>
            <div class="ordenar-select-title" >Ordenar por: Menor Precio<img class="down-icon" src="<?=IMG?>Home/deslizar-abajo.svg"/></div>
    <?php
        }else{ ?>
            <div class="ordenar-select-title" >Ordenar por: M&aacute;s relevantes<img class="down-icon" src="<?=IMG?>Home/deslizar-abajo.svg"/></div>
    <?php
        }?>
        <div class="ordenar-select-opts" >
            <a href="<?=ROOTURL?>?accion=llaveros&orderby=amigurumis.IDAmigurumi&order=desc&option=mas-relevantes" >
                <div class="ordenar-select-opts-btns" >M&aacute;s relevantes</div>
            </a>
            <a href="<?=ROOTURL?>?accion=llaveros&orderby=amigurumis.NombreAmigurumi&order=asc&option=nombres" >
                <div class="ordenar-select-opts-btns" >Nombre</div>
            </a>
            <a href="<?=ROOTURL?>?accion=llaveros&orderby=amigurumis.Precio&order=desc&option=mayor-precio" >
                <div class="ordenar-select-opts-btns" >Mayor Precio</div>
            </a>
            <a href="<?=ROOTURL?>?accion=llaveros&orderby=amigurumis.Precio&order=asc&option=menor-precio" >
                <div class="ordenar-select-opts-btns" >Menor Precio</div>
            </a>
        </div>
    </div>
    <div class="ordenar-select-title" style="width: auto; padding: 0.5rem 1rem; margin: 0.3rem 0;" >Todos (<?=$amountProducts?>)</div>
</section>
<div id="listProductos">
    <section class="productos-todos">
    <?php
        require_once 'funciones-cliente.php';
        $listAmigurumis = obtenerLlavero();
        if($listAmigurumis!=null)
        {	
            foreach($listAmigurumis as $campo) {
            
                require_once 'funciones-cliente.php';
                //btn Guardados
                if(isset($_SESSION['cliente_session'])){
                    $DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');
                    $query = "SELECT guardados.IDUsuario FROM guardados INNER JOIN amigurumis on guardados.IDAmigurumi=amigurumis.IDAmigurumi INNER JOIN categorias on amigurumis.IDCategoria=categorias.IDCategoria WHERE amigurumis.Estado='DISPONIBLE' and categorias.Estado='DISPONIBLE' and guardados.IDUsuario=".$IDUsuario." and guardados.IDAmigurumi=".$campo['IDAmigurumi'];
                    $resultado = $DBConexion2->query($query);
                    $btnGuardadosIDUsuario = $resultado->fetchColumn();

                    $DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');
                    $query = "SELECT guardados.IDAmigurumi FROM guardados INNER JOIN amigurumis on guardados.IDAmigurumi=amigurumis.IDAmigurumi INNER JOIN categorias on amigurumis.IDCategoria=categorias.IDCategoria WHERE amigurumis.Estado='DISPONIBLE' and categorias.Estado='DISPONIBLE' and guardados.IDUsuario=".$IDUsuario." and guardados.IDAmigurumi=".$campo['IDAmigurumi'];
                    $resultado = $DBConexion2->query($query);
                    $btnGuardadosIDAmigurumis = $resultado->fetchColumn();

                    $btnGuardados = $btnGuardadosIDUsuario." ".$btnGuardadosIDAmigurumis;
                }
            ?>
            <div class="p-product-box" >
                <div class="filterDiv show">
                    <div class="unit-body">
                        <a title="<?=$campo['NombreAmigurumi']?>" href="<?=ROOTURL.'?accion=verProducto&IDAmigurumi='.$campo['IDAmigurumi']?>">
                            <img class="foto" src="<?=$campo['mostrarFoto']?>" />
                        </a>         
                        <p class="product-title"><?=$campo['NombreAmigurumi']?></p>
                        <div class="product-price-wrap">
                            <div class="product-price">$<?=number_format($campo['Precio'], 2, '.', ',')?></div>
                            <div class="iconos-product-box" >
                                <input class="iconos-product" type="image" src="<?=IMG?>Menu/carrito/carrito-0.svg" onclick=self.location="<?=ROOTURL?>?accion=addCarrito&IDAmigurumi=<?=$campo['IDAmigurumi']?>" />
                                <?php
                                if(isset($_SESSION['cliente_session'])){
                                    if($btnGuardados == $IDUsuario." ".$campo['IDAmigurumi']) { ?>
                                        <input class="iconos-product" type="image" src="<?=IMG?>Iconos-Titulos/guardados-fill.svg" onclick=self.location="<?=ROOTURL?>?accion=deleteGuardados&IDAmigurumi=<?=$campo['IDAmigurumi']?>" />
                                    <?php
                                    }else{ ?>
                                        <input class="iconos-product" type="image" src="<?=IMG?>Menu/carrito/guardados.svg" onclick=self.location="<?=ROOTURL?>?accion=addGuardados&IDAmigurumi=<?=$campo['IDAmigurumi']?>" />
                                    <?php
                                    }
                                }else{ ?>
                                    <input class="iconos-product" type="image" src="<?=IMG?>Menu/carrito/guardados.svg" onclick=self.location="<?=ROOTURL?>?accion=addGuardados&IDAmigurumi=<?=$campo['IDAmigurumi']?>" />
                                <?php
                                }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php   }   }?>
    </section> 
</div>