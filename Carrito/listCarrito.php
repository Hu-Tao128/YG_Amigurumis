<div id="listCarrito">
<?php

	$IDUsuarioCliente = (isset($_SESSION['cliente_session'])) ? $_SESSION['cliente_session'] : null;
    $CancelarPedido = (isset($_GET['lc'])) ? $_GET['lc'] : null;

    $IDEnvio = (isset($_GET['e'])) ? $_GET['e'] : null;
    $IDVentaAmigurumi = (isset($_GET['v'])) ? $_GET['v'] : null;

    if(isset($_GET['lc']) && $CancelarPedido == 'ce'){
        $DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');
        $query = "DELETE FROM envios WHERE IDEnvio='$IDEnvio' and IDUsuario=".$IDUsuarioCliente;
        $resultado = $DBConexion2->query($query);
    
        $DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');
        $query = "DELETE FROM pedidos_amigurumis WHERE IDVentaAmigurumi='$IDVentaAmigurumi' and IDUsuario=".$IDUsuarioCliente;
        $resultado = $DBConexion2->query($query);
    
        $DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');
        $query = "DELETE FROM venta_detalles_amigurumis WHERE IDVentaAmigurumi='$IDVentaAmigurumi'";
        $resultado = $DBConexion2->query($query);
    }elseif(isset($_GET['lc']) && $CancelarPedido == 'cv'){
        $DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');
        $query = "DELETE FROM pedidos_amigurumis WHERE IDVentaAmigurumi='$IDVentaAmigurumi' and IDUsuario=".$IDUsuarioCliente;
        $resultado = $DBConexion2->query($query);
    
        $DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');
        $query = "DELETE FROM venta_detalles_amigurumis WHERE IDVentaAmigurumi='$IDVentaAmigurumi'";
        $resultado = $DBConexion2->query($query);
    }

    if(isset($_SESSION['cliente_session'])){
        $DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');
        $query = "SELECT IDVentaAmigurumi FROM pedidos_amigurumis WHERE IDUsuario=".$IDUsuarioCliente." and MetodoPago='Indefinido' and InfoMetodoPago='Indefinido'";
        $resultado = $DBConexion2->query($query);
        $cleanVentaAmigurumi = $resultado->fetchColumn();
    
        if($cleanVentaAmigurumi != null){
            $DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');
            $query = "DELETE FROM envios WHERE IDVentaAmigurumi='$cleanVentaAmigurumi' and IDUsuario=".$IDUsuarioCliente;
            $resultado = $DBConexion2->query($query);

            $DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');
            $query = "DELETE FROM pedidos_amigurumis WHERE IDVentaAmigurumi='$cleanVentaAmigurumi' and IDUsuario=".$IDUsuarioCliente;
            $resultado = $DBConexion2->query($query);
        
            $DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');
            $query = "DELETE FROM venta_detalles_amigurumis WHERE IDVentaAmigurumi='$cleanVentaAmigurumi'";
            $resultado = $DBConexion2->query($query);
        }
    }


    if(isset($_SESSION['cliente_session'])){
    require_once 'funciones-cliente.php';
                
    $listCarrito = obtenerCarrito($IDUsuarioCarrito);

    if(isset($_SESSION['cliente_session']) && $cantCarrito!=null){
    ?>

    <p class="titulo-carrito"><img class="title-icon" src="<?=IMG?>Iconos-Titulos/carrito-fill.svg"/>Revisa tu carrito</p>
	<?php	if($cantCarrito == "0"){?>
		<p class="subtitulo-carrito" >No tienes ning&uacute;n art&iacute;culo en tu carrito</p>
	<?php } elseif($cantCarrito == "1"){ ?>
		<p class="subtitulo-carrito" >Tienes <?=$cantCarrito?> art&iacute;culo en tu carrito</p>
	<?php } else {?>
		<p class="subtitulo-carrito" >Tienes <?=$cantCarrito?> art&iacute;culos en tu carrito</p>
	<?php }	?>

    <?php
        $subtotal = 0;
	
        if ($listCarrito!=null){
			foreach($listCarrito as $campos){
				$IVA = 0;
				$importe = $campos['Precio']*$campos['Cantidad'];
				$subtotal += $importe;
				$IVA = $subtotal * 0.08;	
				$total = $subtotal + $IVA;
				$Cant = $campos['Cantidad'];

				include('MySqli_conexionDB.php');
				$accion = $_REQUEST['accion'];
				$IDUsuario = $_SESSION['cliente_session'];
				
				if($accion=='actualizar-carrito'){
					$IDAmigurumi = $_GET['IDAmigurumi'];
					$Cantidad = $_GET['value'];

					$query = "UPDATE carrito SET Cantidad='$Cantidad' WHERE IDUsuario='$IDUsuario' and IDAmigurumi='$IDAmigurumi'; ";
					
					if(!$resultado = mysqli_query($miConexion,$query)){	?>
					<center>
						<h3>Error</h3>
						<h4>Notificar a centros de servicio Emanuel Studios donde Emanuel Ahumada atenderá su llamada al +52 663 124 6327</h4>
						<h3><?=mysqli_error($miConexion)?></h3>
						<input type="button" value="Ir a la lista de usuarios" onclick=self.location="<?=ROOTURL?>?accion=listCarrito" />
					</center>			
				<?php
					}else{ ?>
				    <meta http-equiv="refresh" content="0;url=<?=ROOTURL?>?accion=listCarrito">
				<?php
					}
				}else{
					echo "";
				}
	?>
	<section class="productos-carrito" >
		<div class="info-carrito <?=$campos['IDCategoria']?> show" >
			<div class="foto-box-carrito" >
				<a href="<?=ROOTURL?>?accion=verProducto&IDAmigurumi=<?=$campos['IDAmigurumi']?>" ><img class="foto-carrito" src="<?=$campos['mostrarFoto']?>" /></a>
			</div>
			<div class="product-info-carrito" >
				<div class="p-i-c-guardados-box" >
					<div class="p-i-c-compra">
						<div class="carrito-p-name-box">
							<a class="carrito-p-name" href="<?=ROOTURL?>?accion=verProducto&IDAmigurumi=<?=$campos['IDAmigurumi']?>" ><p><?=$campos['NombreAmigurumi']?></p></a>
						</div>
						<div class="cant-btns-carrito" >
                            <?php
                                if($campos['Producto'] == 'Patron'){ ?>
                            <?php
                                }else{ ?>
                                    <input class="icons-carrito" type="image" alt="- Quitar uno" src="<?=IMG?>Carrito/eliminar-uno.svg" onclick=self.location="<?=ROOTURL?>?accion=uno-menos-Carrito&vista=enCarrito&IDAmigurumi=<?=$campos['IDAmigurumi']?>" 
                                        <?php	if($Cant == '1'){ ?>
                                            disabled
                                        <?php	}?> />
                            <?php
                                } ?>

                            <?php
                                if($campos['Producto'] == 'Patron'){ ?>
                            <?php
                                }else{ ?>
                                <p><?=$campos['Cantidad']?></p>
                            <?php
                                } ?>
							
							<!-- <p class="cant" >
								<div class="custom-select" >
									<select name="select-cantidad">
										<option selected hidden></?=$campos['Cantidad']?></option>
										<option value="1" onclick=self.location="</?=ROOTURL?>?accion=actualizar-carrito&vista=enCarrito&IDAmigurumi=</?=$campos['IDAmigurumi']?>&value=1"><p class="option-txt">1</p></option>
										<option class="option" value="2" onclick=self.location="</?=ROOTURL?>?accion=actualizar-carrito&vista=enCarrito&IDAmigurumi=</?=$campos['IDAmigurumi']?>&value=2"><p class="option-txt">2</p></option>
										<option class="option" value="3" onclick=self.location="</?=ROOTURL?>?accion=actualizar-carrito&vista=enCarrito&IDAmigurumi=</?=$campos['IDAmigurumi']?>&value=3"><p class="option-txt">3</p></option>
										<option class="option" value="4" onclick=self.location="</?=ROOTURL?>?accion=actualizar-carrito&vista=enCarrito&IDAmigurumi=</?=$campos['IDAmigurumi']?>&value=4"><p class="option-txt">4</p></option>
										<option class="option" value="5" onclick=self.location="</?=ROOTURL?>?accion=actualizar-carrito&vista=enCarrito&IDAmigurumi=</?=$campos['IDAmigurumi']?>&value=5"><p class="option-txt">5</p></option>
									</select>
								</div>
							</p> -->
                            <?php
                                if($campos['Producto'] == 'Patron'){ ?>
                            <?php
                                }else{ ?>
                                    <input class="icons-carrito" type="image" alt="+ Agregar uno" src="<?=IMG?>Carrito/agregar-uno.svg" onclick=self.location="<?=ROOTURL?>?accion=uno-mas-Carrito&vista=enCarrito&IDAmigurumi=<?=$campos['IDAmigurumi']?>"
                                        <?php	if($Cant >= '5'){ ?>
                                            disabled
                                        <?php	}?> />
                            <?php
                                } ?>
						</div>
						<p class="p-price-carrito" >$<?=number_format($importe, 2, '.', ',')?></p>
					</div>
					<div class="p-i-c-detalles" >
						<p class="p-descripcion" ><?=$campos['Descripcion']?></p>
					</div>
				</div>
				<div class="p-i-c-extra-info-guardados">
					<div class="search-link-box link-box">
						<a class="search-link link l-space" href="<?=ROOTURL?>?accion=verProducto&IDAmigurumi=<?=$campos['IDAmigurumi']?>" ><img class="search-link-icon icons" src="<?=IMG?>Iconos/info.svg"/> Ver detalles</a>
						<a class="search-link link l-space" href="<?=ROOTURL?>?accion=guardar-para-mas-tarde&IDAmigurumi=<?=$campos['IDAmigurumi']?>" ><img class="search-link-icon icons" src="<?=IMG?>Menu/carrito/guardados.svg"/>Guardar para m&aacute;s tarde</a>
						<a class="eliminar-link l-space" href="<?=ROOTURL?>?accion=eliminar-del-carrito&vista=enCarrito&IDAmigurumi=<?=$campos['IDAmigurumi']?>" ><img class="search-link-icon icons" src="<?=IMG?>Iconos/delete.svg"/>Eliminar</a>
					</div>
					<p class="search-tag p-categoria-02" ><?=$campos['Nombre']?></p>
				</div>
			</div>
		</div>
            <?php   }   }?>
	</section>
	<section class="closing-info">
		<div class="c-i-detalle" >
			<div class="c-i-subtotal">Subtotal</div>
			<div class="c-i-precio" >$<?=number_format($subtotal, 2, '.', ',')?></div>
		</div>
		<div class="c-i-detalle" >
			<div class="c-i-subtotal">IVA (8%)</div>
			<div class="c-i-precio" >$<?=number_format($IVA, 2, '.', ',')?></div>
		</div>
		<div class="c-i-detalle-02" >
			<div class="c-i-02-total">Total</div>
			<div class="c-i-02-precio" >$<?=number_format($total, 2, '.', ',')?></div>
		</div>
        <div class="c-i-btns" >
			<div class="cta-btn" >
                <button type="button" class="c-c-btn" onclick=self.location="<?=ROOTURL?>?accion=verTodo" >Seguir Comprando</button>
                <button type="button" class="c-btn" onclick=self.location="<?=ROOTURL?>?accion=personalizarCompra" >Pagar</button>
			</div>
		</div>
	</section>

    <div class="sugerencias-carrito">
        <p class="titulo-carrito-2">Lo m&aacute;s nuevo de YG</p>
        <p class="subtitulo-carrito" >Aprovecha nuestros amigurumis de temporada.</p>
        <section>
            <?php
            require_once 'funciones-cliente.php';
            $listTodosAmigurumis = obtenerTodosAmigurumis();
                if($listTodosAmigurumis!=null)
                {	
                    $exc = 0;
                    foreach($listTodosAmigurumis as $campo){
                        if($exc >= 3) {
                            break;
                        }else{?>
                        <div class="p-product-box" >
                            <div class="filterDiv <?=$campo['IDCategoria']?> show">
                                <div class="unit-body">
                                    <a title="<?=$campo['NombreAmigurumi']?>" href="<?=ROOTURL.'?accion=verProducto&IDAmigurumi='.$campo['IDAmigurumi']?>">
                                        <img class="foto" src="<?=$campo['mostrarFoto']?>"/>
                                    </a>
                                    <p class="product-title"><?=$campo['NombreAmigurumi']?></p>
                                    <div class="product-price-wrap">
                                        <div class="product-price">$<?=number_format($campo['Precio'], 2, '.', ',')?></div>
                                        <div class="iconos-product-box" >
                                            <input class="iconos-product" type="image" src="<?=IMG?>Menu/carrito/carrito-0.svg" onclick=self.location="<?=ROOTURL?>?accion=addCarrito&IDAmigurumi=<?=$campo['IDAmigurumi']?>" />
                                            <input class="iconos-product" type="image" src="<?=IMG?>Menu/carrito/guardados.svg" onclick=self.location="<?=ROOTURL?>?accion=addGuardados&IDAmigurumi=<?=$campo['IDAmigurumi']?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            <?php $exc++;   }   }	} ?>       
        </section>
    </div>
    
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

    <?php }elseif(isset($_SESSION['cliente_session']) && $cantCarrito==0 ){ ?>
        <p class="titulo-carrito"><img class="title-icon" src="<?=IMG?>Iconos-Titulos/carrito-fill.svg"/>Tu carrito est&aacute; vac&iacute;o</p>
        <p class="subtitulo-carrito" >Aprovecha nuestros amigurumis de temporada.</p>
        <div class="cta-btn" >
            <input class="c-c-btn" type="button" value="Seguir Comprando" onclick=self.location="<?=ROOTURL?>?accion=verTodo" />
        </div>
        <div class="sugerencias-carrito">
            <p class="titulo-carrito-2">Lo m&aacute;s nuevo de YG</p>
            <p class="subtitulo-carrito" >Aprovecha nuestros amigurumis de temporada.</p>
            <section>
                <?php
                require_once 'funciones-cliente.php';
                $listTodosAmigurumis = obtenerTodosAmigurumis();
                    if($listTodosAmigurumis!=null)
                    {	
                        $exc = 0;
                        foreach($listTodosAmigurumis as $campo){
                            if($exc >= 3) {
                                break;
                            }else{?>
                            <div class="p-product-box" >
                                <div class="filterDiv <?=$campo['IDCategoria']?> show">
                                    <div class="unit-body">
                                        <a title="<?=$campo['NombreAmigurumi']?>" href="<?=ROOTURL.'?accion=verProducto&IDAmigurumi='.$campo['IDAmigurumi']?>">
                                            <img class="foto" src="<?=$campo['mostrarFoto']?>"/>
                                        </a>
                                        <p class="product-title"><?=$campo['NombreAmigurumi']?></p>
                                        <div class="product-price-wrap">
                                            <div class="product-price">$<?=number_format($campo['Precio'], 2, '.', ',')?></div>
                                            <div class="iconos-product-box" >
                                                <input class="iconos-product" type="image" src="<?=IMG?>Menu/carrito/carrito-0.svg" onclick=self.location="<?=ROOTURL?>?accion=addCarrito&IDAmigurumi=<?=$campo['IDAmigurumi']?>" />
                                                <input class="iconos-product" type="image" src="<?=IMG?>Menu/carrito/guardados.svg" onclick=self.location="<?=ROOTURL?>?accion=addGuardados&IDAmigurumi=<?=$campo['IDAmigurumi']?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                <?php $exc++;   }   }	} ?>       
            </section>
        </div>

<?php   } }else{ ?>
    <p class="titulo-carrito"><img class="title-icon" src="<?=IMG?>Iconos-Titulos/carrito-fill.svg"/>Tu carrito est&aacute; vac&iacute;o</p>
    <p class="subtitulo-carrito" >Inicia sesi&oacute;n para poder ver tu carrito. O seguir comprando.</p>
    <div class="cta-btn" >
        <input class="c-c-btn" type="button" value="Seguir Comprando" onclick=self.location="<?=ROOTURL?>?accion=verTodo" />
        <input class="c-btn" type="button" value="Inicia Sesi&oacute;n" onclick=self.location="<?=ROOTURL?>?accion=formLogin" />
    </div>
    <div class="sugerencias-carrito">
        <p class="titulo-carrito-2">Lo m&aacute;s nuevo de YG</p>
        <p class="subtitulo-carrito" >Aprovecha nuestros amigurumis de temporada.</p>
        <section>
            <?php   require_once 'funciones-cliente.php';
            $listTodosAmigurumis = obtenerTodosAmigurumis();
                if($listTodosAmigurumis!=null)
                {	
                    $exc = 0;
                    foreach($listTodosAmigurumis as $campo){
                        if($exc >= 3) {
                            break;
                        }else{?>
                        <div class="p-product-box" >
                            <div class="filterDiv <?=$campo['IDCategoria']?> show">
                                <div class="unit-body">
                                    <a title="<?=$campo['NombreAmigurumi']?>" href="<?=ROOTURL.'?accion=verProducto&IDAmigurumi='.$campo['IDAmigurumi']?>">
                                        <img class="foto" src="<?=$campo['mostrarFoto']?>"/>
                                    </a>
                                    <p class="product-title"><?=$campo['NombreAmigurumi']?></p>
                                    <div class="product-price-wrap">
                                        <div class="product-price">$<?=number_format($campo['Precio'], 2, '.', ',')?></div>
                                        <div class="iconos-product-box" >
                                            <input class="iconos-product" type="image" src="<?=IMG?>Menu/carrito/carrito-0.svg" onclick=self.location="<?=ROOTURL?>?accion=addCarrito&IDAmigurumi=<?=$campo['IDAmigurumi']?>" />
                                            <input class="iconos-product" type="image" src="<?=IMG?>Menu/carrito/guardados.svg" onclick=self.location="<?=ROOTURL?>?accion=addGuardados&IDAmigurumi=<?=$campo['IDAmigurumi']?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            <?php $exc++;   }   }	} ?>       
        </section>
    </div>
<?php  } ?>

</div>









<!-- <script>
var x, i, j, l, ll, selElmnt, a, b, c;

x = document.getElementsByClassName("custom-select");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;

  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);

  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {

    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {

        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {

    e.stopPropagation();
    closeAllSelect(this);
    this.nextSibling.classList.toggle("select-hide");
    this.classList.toggle("select-arrow-active");
  });
}

function closeAllSelect(elmnt) {

  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}

document.addEventListener("click", closeAllSelect); -->
<!-- </script> -->