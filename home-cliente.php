<?php
require_once 'funciones-cliente.php';
?>
<section class="hero-head" >
	<div class="head-box"></div>
	<div class="head-box">
		<h1 class="head-title" >Un amigo hecho para ti</h1>
		<button type="button" class="hero-h-btn" onclick=self.location="<?=ROOTURL?>?accion=verTodo" >Ver Productos</button>
	</div>
	<img class="deslizar-icon" src="<?=IMG?>Home/deslizar-abajo.svg" />
</section>

<style>
	.background-img{
		position: absolute;
		user-select: none;
		z-index: 0;
		width: 100%;
		height: 40em;
		left: 0;
	}

	.background-img-blur{
		height: 100%;
		width: 100%;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		background-color: rgba(255, 255, 255, 0.1);
		backdrop-filter: blur(30rem);
	}

	.product-info-odd{
		height: 100%;
		margin-left: 4rem;
		display: flex;
		flex-direction: column;
		align-items: flex-start;
		justify-content: space-between;
		padding-right: 4rem;
	}

	.products-foto{
		height: 25rem;
		object-fit: cover;
		background-color: rgba(238, 238, 238, 0.1);
	}

	.p-product-description{
		display: -webkit-box;
		-webkit-box-orient: vertical;
		-webkit-line-clamp: 3;
		white-space: pre-wrap;
		overflow: hidden;
		overflow-wrap: anywhere;
		font-size: 1.75rem;
		color: #FFFFFF;
	}
</style>

<?php
//Amigurumis

$amigurumisIMG = obtenerAmigurumis();
if($amigurumisIMG!=null){	
	$exc = 0;
	foreach($amigurumisIMG as $campo){
		if($exc >= 1) {
			break;
		}else{
?>
	<section class="products" >
		<div>
			<img class="background-img" src="<?=$campo['mostrarFoto']?>"/>
		</div>
		<div class="background-img-blur" >
			<div class="product-box" >
				<a title="<?=$campo['NombreAmigurumi']?>" href="<?=ROOTURL.'?accion=verProducto&IDAmigurumi='.$campo['IDAmigurumi']?>">
					<img class="products-foto" src="<?=$campo['mostrarFoto']?>"/>
				</a>
				<div class="product-info" >
					<div class="product-info-container" >
						<p class="p-product-title odd-p-p-title" >Amigurumis</p>
						<?php
							if($campo['Descripcion'] != null){ ?>
								<p class="p-product-description odd-p-p-description" ><?=$campo['Descripcion']?></p>
						<?php
							}else{ ?>
								<p class="p-product-description odd-p-p-description" >Aporvecha! Solo por tiempo limitado.</p>
						<?php
							}
						?>
					</div>
					<button type="button" class="hero-h-btn btn-margin-buttom" onclick=self.location="<?=ROOTURL?>?accion=amigurumis" >Ver Amigurumis</button>
				</div>
			</div>
		</div>
	</section>
<?php
			$exc++;
		}
	}
}
?>

<?php
//Llaveros

$llaverosIMG = obtenerLlavero();
if($llaverosIMG!=null){	
	$exc = 0;
	foreach($llaverosIMG as $campo){
		if($exc >= 1) {
			break;
		}else{
?>
	<section class="products odd-products" >
		<div>
			<img class="background-img" src="<?=$campo['mostrarFoto']?>"/>
		</div>
		<div class="background-img-blur" >
			<div class="product-box odd-p-box" >
				<div class="product-info-odd" >
					<div class="product-info-container" >
						<p class="p-product-title odd-p-p-title" >Llaveros</p>
						<?php
							if($campo['Descripcion'] != null){ ?>
								<p style="color:#FFF;" class="p-product-description odd-p-p-description" ><?=$campo['Descripcion']?></p>
						<?php
							}else{ ?>
								<p class="p-product-description odd-p-p-description" >Aporvecha! Solo por tiempo limitado.</p>
						<?php
							}
						?>
					</div>
					<button type="button" class="hero-h-btn btn-margin-buttom" onclick=self.location="<?=ROOTURL?>?accion=llaveros" >Ver Llaveros</button>
				</div>
				<a title="<?=$campo['NombreAmigurumi']?>" href="<?=ROOTURL.'?accion=verProducto&IDAmigurumi='.$campo['IDAmigurumi']?>">
					<img class="products-foto" src="<?=$campo['mostrarFoto']?>"/>
				</a>
			</div>
		</div>
	</section>
<?php
			$exc++;
		}
	}
}
?>

<?php
//Peculiaridades

$peculiaridadesIMG = obtenerPeculiaridades();
if($peculiaridadesIMG!=null){	
	$exc = 0;
	foreach($peculiaridadesIMG as $campo){
		if($exc >= 1) {
			break;
		}else{
?>
	<section class="products" >
		<div>
			<img class="background-img" src="<?=$campo['mostrarFoto']?>"/>
		</div>
		<div class="background-img-blur" >
			<div class="product-box" >
				<a title="<?=$campo['NombreAmigurumi']?>" href="<?=ROOTURL.'?accion=verProducto&IDAmigurumi='.$campo['IDAmigurumi']?>">
					<img class="products-foto" src="<?=$campo['mostrarFoto']?>"/>
				</a>
				<div class="product-info" >
					<div class="product-info-container" >
						<p class="p-product-title odd-p-p-title" >Peculiaridades</p>
						<?php
							if($campo['Descripcion'] != null){ ?>
								<p class="p-product-description odd-p-p-description" ><?=$campo['Descripcion']?></p>
						<?php
							}else{ ?>
								<p class="p-product-description odd-p-p-description" >Aporvecha! Solo por tiempo limitado.</p>
						<?php
							}
						?>
						</div>
					<button type="button" class="hero-h-btn btn-margin-buttom" onclick=self.location="<?=ROOTURL?>?accion=peculiaridades" >Ver Peculiaridades</button>
				</div>
			</div>
		</div>
	</section>
<?php
			$exc++;
		}
	}
}
?>

<section class="mas-yg" >
	<div class="about-us" >
		<div class="a-us-promo">
			<img class="mas-yg-logo" src="<?=IMG?>Logo/yg - svg/yg_white.svg"/>
			<p>x</p>
			<p>un mundo unido</p>
		</div>
		<div class="msg-box" >
			<img class="mundo-unido-icon" src="<?=IMG?>Home/x-mundo-unido.svg"/>
			<div class="msg-yg" >
				<p>Buscamos conectar familiares y amigos</p>
				<p>a travez de un amigurumi.</p>
				<p>Es mucho m&aacute;s que juguete, es un</p>
				<p class="msg-impact" >recuerdo de vida.</p>
			</div>
		</div>
	</div>
	<div class="mas-yg-circle-1"></div>
	<div class="mas-yg-circle-2"></div>
	<div class="mas-yg-circle-3"></div>
</section>

<!-- <section class="mockup-product-packaging" >
	<div class="mockup-p-p"></div>
	<div class="mockup-p-p-txt">
		<p class="mockup-p-p-txt-title" >Aprovecha nuestros env&iacute;os a toda la rep&uacute;blica</p>
		<p class="mockup-p-p-txt-text" >Env&iacute;os a toda hora sin costo alguno. <b>¡Solo por tiempo limitado!</b></p>
		<a href="</?=ROOTURL?>?accion=verTodo" >
			<button class="hero-h-btn">Ver productos</button>
		</a>
	</div>
</section> -->

<!-- <section class="products" >
	<div class="product-box" >
		<div class="product-info" >
			<div class="product-info-container" >
				<p class="p-product-title" >Testimonios</p>
				<p class="p-product-description" >Se pasan de Pro</p>
			</div>
			<p class="p-product-description" >Emanuel Ahumada</p>
		</div>
	</div>
	<p class="background-title">Testmonios</p>
</section> -->

<section class="sponsers" >
	<p class="s-txt" >Nuestros patrocinadores</p>
	<div class="s-logo-box" >
		<img class="s-logo" src="<?=IMG?>Home/yg-amigurumis.png" />
		<img class="s-logo" src="<?=IMG?>Home/bahia-group.png" />
		<img class="s-logo" src="<?=IMG?>Home/emanuel-studios.png" />
		<img class="s-logo" src="<?=IMG?>Home/cetis-58.png" />
	</div>
</section>