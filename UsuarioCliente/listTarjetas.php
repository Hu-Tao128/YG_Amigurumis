<div id="listCarrito">
<?php
	$IDUsuario = (isset($_SESSION['cliente_session'])) ? $_SESSION['cliente_session'] : null;
	$listTarjetas = getListTarjetas($IDUsuario);

	// Tarjetas

	$DBConexion2 = new PDO('mysql:host=localhost;dbname=yg_crochet', 'root', '');

	$query = "SELECT COUNT(IDUsuario) as total FROM tarjetas WHERE IDUsuario='$IDUsuario' ";
	$resultado = $DBConexion2->query($query);

	$cantTarjetas = $resultado->fetchColumn();

	if($listTarjetas!=null){
?>
	    <p class="titulo-carrito"><img class="title-icon" src="<?=IMG?>Iconos-Titulos/mis-tarjetas-title.svg"/>Mis Tarjetas</p>
		
		<?php	if($cantTarjetas == "0"){?>
			<p class="subtitulo-carrito" >No tienes ninguna tarjeta agregada</p>
		<?php } elseif($cantTarjetas == "1"){ ?>
			<p class="subtitulo-carrito" >Tienes <?=$cantTarjetas?> tarjeta agregada.</p>
		<?php } else {?>
			<p class="subtitulo-carrito" >Tienes <?=$cantTarjetas?> tarjetas agregadas.</p>
		<?php }	?>

		<div class="tarjeta-box">
		<?php
			foreach($listTarjetas as $campos){ ?>
				<div class="tarjeta">
					<div class="tarjeta-container">
						<div class="t-nombre">
							<p><?=$campos['nombreTitular']?></p>
							<a href="<?=ROOTURL?>?accion=deleteTarjeta&IDTarjeta=<?=$campos['IDTarjeta']?>"><img class="delete-icon" src="<?=IMG?>Tarjetas/x-delete.svg"/></a>
						</div>
						<div class="t-numero">
							<p><?=substr_replace($campos['Numero'],"**** **** **** ",0,12)?></p>
						</div>
						<div class="t-cvc-venci">
							<p>cvc <?=substr_replace($campos['CVC'],"***",0,3)?></p>
							<?php $date = date_create($campos['FechaVencimiento']);?>
							<p><?=date_format($date, "m/y")?></p>
						</div>
					</div>
				</div>
				<?php
			} ?>
			<a href="<?=ROOTURL?>?accion=agregar-tarjeta">
				<div class="tarjeta">
					<div class="add-tarjeta-box">
						<img class="add-tarjeta-icon" src="<?=IMG?>Tarjetas/+-agregar-tarjeta.svg"/>
					</div>
				</div>
			</a>
		</div>
		
<?php
	}else{ ?>
		<p class="titulo-carrito"><img class="title-icon" src="<?=IMG?>Iconos-Titulos/mis-tarjetas-title.svg"/>Mis Tarjetas</p>
		<p class="subtitulo-carrito" >No tienes ninguna tarjeta agregada</p>
		<div class="tarjeta-box">
			<a href="<?=ROOTURL?>?accion=agregar-tarjeta">
				<div class="tarjeta">
					<div class="add-tarjeta-box">
						<img class="add-tarjeta-icon" src="<?=IMG?>Tarjetas/+-agregar-tarjeta.svg"/>
					</div>
				</div>
			</a>
		</div>
<?php
	} ?>
</div>