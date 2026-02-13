<section class="productos-head" >
    <h2>Conoce nuestros productos</h2>
</section>
    <section id="ordenar-por-box">
        <div class="ordenar-select " >
        <?php
            require_once 'funciones-cliente.php';
            $DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');
            $query = "SELECT COUNT(IDAmigurumi) FROM amigurumis INNER JOIN categorias on amigurumis.IDCategoria=categorias.IDCategoria WHERE amigurumis.Estado='DISPONIBLE' and categorias.Estado='DISPONIBLE' ";
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
                <a href="<?=ROOTURL?>?accion=verTodo&orderby=amigurumis.IDAmigurumi&order=desc&option=mas-relevantes" >
                    <div class="ordenar-select-opts-btns" >M&aacute;s relevantes</div>
                </a>
                <a href="<?=ROOTURL?>?accion=verTodo&orderby=amigurumis.NombreAmigurumi&order=asc&option=nombres" >
                    <div class="ordenar-select-opts-btns" >Nombre</div>
                </a>
                <a href="<?=ROOTURL?>?accion=verTodo&orderby=amigurumis.Precio&order=desc&option=mayor-precio" >
                    <div class="ordenar-select-opts-btns" >Mayor Precio</div>
                </a>
                <a href="<?=ROOTURL?>?accion=verTodo&orderby=amigurumis.Precio&order=asc&option=menor-precio" >
                    <div class="ordenar-select-opts-btns" >Menor Precio</div>
                </a>
            </div>
        </div>
        <!-- <div class="ordenar-select-title" style="width: auto; padding: 0.5rem 1rem; margin: 0.3rem 0;" >Todos (</?=$amountProducts?>)</div> -->
    </section>


<div id="listProductos">
    <section id="productos-chips">
        <div id="myBtnContainer">
            <button class="btn active" onclick="filterSelection('all')"><p class="btn-text">Ver Todo (<?=$amountProducts?>)</p></button>
            <?php
                require_once 'funciones-cliente.php';
                $listCategorias = obtenerListaCategorias();
                if($listCategorias!=null)
                {	
                    foreach($listCategorias as $campo) {
                
                        require_once 'funciones-cliente.php';
                        $DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');
                        $query = "SELECT COUNT(IDAmigurumi) FROM amigurumis INNER JOIN categorias on amigurumis.IDCategoria=categorias.IDCategoria WHERE amigurumis.Estado='DISPONIBLE' and categorias.Estado='DISPONIBLE' and categorias.IDCategoria=".$campo['IDCategoria'];
                        $resultado = $DBConexion2->query($query);
                        $amountProductsCategory = $resultado->fetchColumn();
                ?>    
                        <button class="btn" onclick="filterSelection('<?='.', $campo['IDCategoria'], '.'?>')" ><p class="btn-text"><?=$campo['Nombre']?> (<?=$amountProductsCategory?>)</p></button>
                <?php   }	}?>        
        </div>
    </section>
    <section class="productos-todos">
        <?php
            $listTodosAmigurumis = obtenerTodosAmigurumis();
            if($listTodosAmigurumis!=null){	
                $roundCount = 12;
                $rounds = 0;
                $addRounds = (isset($_GET['r'])) ? $_GET['r'] : null;
                
                if($addRounds == 12){
                    $roundCount = 12;
                }elseif($addRounds == 18){
                    $roundCount = 18;
                }elseif($addRounds == 24){
                    $roundCount = 24;
                }elseif($addRounds == 30){
                    $roundCount = 30;
                }elseif($addRounds == 36){
                    $roundCount = 36;
                }elseif($addRounds == 42){
                    $roundCount = 42;
                }elseif($addRounds == 48){
                    $roundCount = 48;
                }elseif($addRounds == 54){
                    $roundCount = 54;
                }elseif($addRounds == 60){
                    $roundCount = 60;
                }elseif($addRounds == 66){
                    $roundCount = 66;
                }elseif($addRounds == 72){
                    $roundCount = 72;
                }elseif($addRounds == 78){
                    $roundCount = 78;
                }elseif($addRounds == 84){
                    $roundCount = 84;
                }elseif($addRounds == 90){
                    $roundCount = 90;
                }else{
                    $roundCount = 12;
                }

                foreach($listTodosAmigurumis as $campo) {
                
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
                    
                    if($rounds >= $roundCount){
                        break;
                    }else{
                ?>
                <div class="p-product-box" >
                    <div class="filterDiv <?='.', $campo['IDCategoria'], '.'?> show" >
                        <div class="unit-body">
                            <a title="<?=$campo['NombreAmigurumi']?>" href="<?=ROOTURL.'?accion=verProducto&IDAmigurumi='.$campo['IDAmigurumi']?>">
                                <img class="foto" src="<?=$campo['mostrarFoto']?>" loading="lazy"/>
                            </a>
                            <a title="<?=$campo['NombreAmigurumi']?>" href="<?=ROOTURL.'?accion=verProducto&IDAmigurumi='.$campo['IDAmigurumi']?>">
                                <p class="product-title"><?=$campo['NombreAmigurumi']?></p>
                            </a>
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
                <?php $rounds++;       
                    } 
                }
            } ?>
    </section> 
    <?php
    if($rounds != $amountProducts){?>                
        <section id="more" class="more-box">
            <button class="hero-h-btn more-btn" onclick=self.location="<?=ROOTURL?>?accion=verTodo&r=<?=$roundCount+6?>&#more">
                Ver M&aacute;s
            </button>
        </section>
    <?php
    }else{ ?>
        <section id="more">
        </section>
    <?php
    }?>
</div>