<div id="listGuardados">
    <?php
    if(isset($_SESSION['cliente_session'])){
    ?>
    <p class="titulo-carrito" ><img class="title-icon" src="<?=IMG?>Iconos-Titulos/guardados-fill.svg"/>Tus guardados</p>
    <?php
    if($cantGuardados == 0){ ?>
        <p class="subtitulo-carrito" >Guarda los art&iacute;culos que te gusten y encu&eacute;ntralos f&aacute;cilmente aqu&iacute; en cualquier momento.</p>
        <div class="cta-btn" style="border-bottom: solid 1px #AAAAAA; width: 100%;" >
            <input class="c-c-btn" type="button" value="Seguir Comprando" onclick=self.location="<?=ROOTURL?>" />
        </div>
    <?php }elseif($cantGuardados == 1){ ?>
        <p class="subtitulo-carrito" >Tienes un art&iacute;culo guardado.</p>
    <?php }else{ ?>
        <p class="subtitulo-carrito" >Tienes <?=$cantGuardados?> art&iacute;culos guardados.</p>
    <?php } ?>
    <!-- <div id="listProductos"> -->
        <section class="productos-todos">
            <?php
                require_once 'funciones-cliente.php';
                $IDUsuario = $_SESSION['cliente_session'];
                $IDUsuarioGuardados = (isset($_SESSION['cliente_session'])) ? $_SESSION['cliente_session'] : null;
                $listGuardados = obtenerGuardados($IDUsuarioGuardados);
           
                if($listGuardados!=null){	
                    foreach($listGuardados as $campo) { ?>
                        <div class="info-carrito show" >
                            <div class="foto-box-carrito" >
                                <a href="<?=ROOTURL?>?accion=verProducto&IDAmigurumi=<?=$campo['IDAmigurumi']?>" ><img class="foto-carrito" src="<?=$campo['mostrarFoto']?>" /></a>
                            </div>
                            <div class="product-info-carrito" >
                                <div class="p-i-c-guardados-box" >
                                    <div class="p-i-c-compra">
                                        <div class="carrito-p-name-box">
                                            <a class="carrito-p-name" href="<?=ROOTURL?>?accion=verProducto&IDAmigurumi=<?=$campo['IDAmigurumi']?>" ><p><?=$campo['NombreAmigurumi']?></p></a>
                                        </div>
                                        <p class="p-price-carrito" >$<?=number_format($campo['Precio'], 2, '.', ',')?></p>
                                    </div>
                                    <div class="p-i-c-detalles detalles-guardados" >
                                        <p class="p-descripcion" ><?=$campo['Descripcion']?></p>
                                    </div>
                                </div>
                                <div class="p-i-c-extra-info-guardados">
                                    <div class="search-link-box link-box" >
                                        <a class="search-link link l-space" href="<?=ROOTURL?>?accion=verProducto&IDAmigurumi=<?=$campo['IDAmigurumi']?>" ><img class="search-link-icon icons" src="<?=IMG?>Iconos/info.svg"/> Ver detalles</a>
                						<a class="search-link link l-space" href="<?=ROOTURL?>?accion=addCarrito&IDAmigurumi=<?=$campo['IDAmigurumi']?>" ><img class="search-link-icon icons" src="<?=IMG?>Menu/carrito/carrito-0.svg"/> Agregar a tu Carrito</a>
                                        <a class="eliminar-link l-space" href="<?=ROOTURL?>?accion=deleteGuardados&IDAmigurumi=<?=$campo['IDAmigurumi']?>" ><img class="search-link-icon icons" src="<?=IMG?>Iconos/delete.svg"/>Eliminar</a>
                                    </div>
                                    <?php
                                        $months = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
                                        $months_es_MX = array("Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic");
                                        $monthName = str_replace($months, $months_es_MX, date("M", strtotime($campo['F_Guardado'])));

                                        $date=date_create($campo['F_Guardado']);
                                    ?>
                                    <p class="search-tag p-categoria-02" >Agregado el <?=date_format($date,"j");?> de <?=$monthName?> de <?=date_format($date,"Y");?></p>
                                </div>
                            </div>
                        </div>
                    </section>
            <?php   }   }?>        
        </section>
        <section class="m-p-p-g-box g-box">
            <div class="m-p-p-guardados" >
                <div class="mockup-p-p-guardados"></div>
                <div class="mockup-p-p-txt-guardados">
                    <p class="mockup-p-p-txt-title-guardados" >Aprovecha nuestros env&iacute;os a toda la rep&uacute;blica</p>
                    <p class="mockup-p-p-txt-text-guardados" >Env&iacute;os a toda hora sin costo alguno. <b>¡Solo por tiempo limitado!</b></p>
                    <a href="<?=ROOTURL?>?accion=verTodo" >
                        <button class="hero-h-btn">Ver productos</button>
                    </a>
                </div>
            </div>
        </section>
    <!-- </div> -->

<?php   }else{ ?>
    
    <p class="titulo-carrito" ><img class="title-icon" src="<?=IMG?>Iconos-Titulos/guardados-fill.svg"/>Tus guardados</p>
    <p class="subtitulo-carrito" >Inicia sesi&oacute;n y agrega tu primer art&iacute;culo.</p>
    <div class="cta-btn" >
        <input class="c-c-btn" type="button" value="Seguir Comprando" onclick=self.location="<?=ROOTURL?>?accion=verTodo" />
        <input class="c-btn" type="button" value="Inicia Sesi&oacute;n" onclick=self.location="<?=ROOTURL?>?accion=formLogin" />
    </div>

<section class="m-p-p-g-box">
    <section class="m-p-p-guardados" >
        <div class="mockup-p-p-guardados"></div>
        <div class="mockup-p-p-txt-guardados">
            <p class="mockup-p-p-txt-title-guardados" >Aprovecha nuestros env&iacute;os a toda la rep&uacute;blica</p>
            <p class="mockup-p-p-txt-text-guardados" >Env&iacute;os a toda hora sin costo alguno. <b>¡Solo por tiempo limitado!</b></p>
            <a href="<?=ROOTURL?>?accion=verTodo" >
                <button class="hero-h-btn">Ver productos</button>
            </a>
        </div>
    </section>
</section>


<?php   } ?>

</div>
