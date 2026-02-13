
<?php
include("configuracion-cliente.php");

	$accion = (isset($_POST['accion'])) ? $_POST['accion'] : null;
	$accion = (isset($_GET['accion'])) ? $_GET['accion'] : $accion;
	
		include_once(HEADERCLIENTE);

		switch($accion){
			
			// Paginas
			
			case "verTodo":
				?><script>
					document.title += " Productos - <?=SITENAME?>";
				</script><?php
				include("Productos/productos.php");
			break;

			case "verProducto":
				include("Productos/detalleTodos.php");
			break;

			case "amigurumis":
				?><script>
					document.title += " Amigurumis - <?=SITENAME?>";
				</script><?php
				include("Productos/amigurumis-cliente.php");
			break;

			case "accesorios":
				?><script>
					document.title += " Accesorios - <?=SITENAME?>";
				</script><?php
				include("Productos/accesorios-cliente.php");
			break;
			
			case "llaveros":
				?><script>
					document.title += " Llaveros - <?=SITENAME?>";
				</script><?php
				include("Productos/llaveros-cliente.php");
			break;
			
			case "peculiaridades":
				?><script>
					document.title += " Peculiaridades - <?=SITENAME?>";
				</script><?php
				include("Productos/peculiaridades-cliente.php");
			break;
			
			case "personaliza_tu_amigurumi":
				?><script>
					document.title += " Personaliza Tu Amigurumi - <?=SITENAME?>";
				</script><?php
				include("Productos/personaliza_tu_amigurumi-cliente.php");
			break;
			
			case "patrones":
				?><script>
					document.title += " Patrones - <?=SITENAME?>";
				</script><?php
				include("Productos/patrones-cliente.php");
			break;
			
			// Ajustes
			
			case "formEditAjustes":
				?><script>
					document.title += " Mi Información - <?=SITENAME?>";
				</script><?php
				include("Perfil/formEditAjustes-cliente.php");
			break;

			case "formEditCuenta":
				?><script>
					document.title += " Mi Cuenta - <?=SITENAME?>";
				</script><?php
				include("Perfil/formEditCuenta-cliente.php");
			break;
			
			case "form-eliminar-cuenta":
				?><script>
					document.title += " Eliminar Mi Cuenta - <?=SITENAME?>";
				</script><?php
				include("Perfil/formEliminarCuenta-cliente.php");
			break;

			case "updateAjustes":
				?><script>
					document.title += " Mi Información - <?=SITENAME?>";
				</script><?php
				include("Perfil/updateAjustes-cliente.php");
			break;
			
			// Buscador

			case "search":
				include("Buscador/search.php");
			break;

			// Carrito V2

			case "listCarrito":
				?><script>
					document.title += " Tu Carrito - <?=SITENAME?>";
				</script><?php
				include("Carrito/listCarrito.php");
			break;

			case "addCarrito":
				include("Carrito/addCarrito.php");
			break;

			case "actualizar-carrito":
				?><script>
					document.title += " Tu Carrito - <?=SITENAME?>";
				</script><?php
				include("Carrito/listCarrito.php");
			break;

			case "eliminar-del-carrito":
				include("Carrito/deleteCarrito.php");
			break;

			case "uno-mas-Carrito":
				include("Carrito/accionesCarritoCantidad.php");
			break;
			
			case "uno-menos-Carrito":
				include("Carrito/accionesCarritoCantidad.php");
			break;

			case "personalizarCompra":
				?><script>
					document.title += " Personaliza Tu Compra - <?=SITENAME?>";
				</script><?php
				include("Carrito/personalizarCompra.php");
			break;

			case "add-F1-Compra":
				?><script>
					document.title += " <?=SITENAME?>";
				</script><?php
				include("Carrito/add-F1-Compra.php");
			break;

			case "direccion-de-envio":
				?><script>
					document.title += " Dirección de envío - <?=SITENAME?>";
				</script><?php
				include("Carrito/direccionCompra.php");
			break;

			case "add-F2-Compra":
				?><script>
					document.title += " <?=SITENAME?>";
				</script><?php
				include("Carrito/add-F2-Compra.php");
			break;

			case "informacion-de-contacto":
				?><script>
					document.title += " Información de Contacto - <?=SITENAME?>";
				</script><?php
				include("Carrito/contactoCompra.php");
			break;

			case "add-F3-Compra":
				?><script>
					document.title += " <?=SITENAME?>";
				</script><?php
				include("Carrito/add-F3-Compra.php");
			break;

			case "metodo-de-pago":
				?><script>
					document.title += " Metódo de pago - <?=SITENAME?>";
				</script><?php
				include("Carrito/pagoCompra.php");
			break;

			case "add-F4-Compra":
				?><script>
					document.title += " <?=SITENAME?>";
				</script><?php
				include("Carrito/add-F4-Compra.php");
			break;

			// Carrito
			
			case "accionesCarritoPersonalizar":
				include("Carrito/accionesCarritoPersonalizar.php");
			break;
			
			case "addCompra":
				include("Carrito/addCompra.php");
			break;

			case "confirmarCompra":
				include("Carrito/confirmarCompra.php");
			break;
			
			case "personalizarCompra":
				include("Carrito/personalizarCompra.php");
			break;

			// Guardados

			case "addGuardados":
				include("Guardados/addGuardados.php");
			break;

			case "deleteGuardados":
				include("Guardados/deleteGuardados.php");
			break;

			case "guardar-para-mas-tarde":
				include("Guardados/guardarMasTarde.php");
			break;
			
			case "listGuardados":
				?><script>
					document.title += " Tus Guardados - <?=SITENAME?>";
				</script><?php
				include("Guardados/listGuardados.php");
			break;

			// Iniciar Sesion

			case "formLogin":
				?><script>
					document.title += " Inicia Sesión - <?=SITENAME?>";
				</script><?php
				include("IniciarSesion/formLogin-cliente.php");
			break;
			
			case "loginProcess":
				?><script>
					document.title += " <?=SITENAME?>";
				</script><?php
				include("IniciarSesion/loginProcess-cliente.php");
			break;

			case "logout":
				include("IniciarSesion/logout-cliente.php");
			break;

			// Perfil

			case "perfil":
				?><script>
					document.title += " Mi Perfil - <?=SITENAME?>";
				</script><?php
				include("Perfil/perfil-cliente.php");
			break;
			
			case "formEditUsuario":
				include("Perfil/formEditUsuario-cliente.php");
			break;

			case "updateUsuario":
				include("Perfil/updateUsuario-cliente.php");
			break;

			case "deleteUsuario":
				include("Perfil/deleteUsuario-cliente.php");
			break;

			// Usuario Cliente

			case "listTarjetas":
				?><script>
					document.title += " Mis Tarjetas - <?=SITENAME?>";
				</script><?php
				include("UsuarioCliente/listTarjetas.php");
			break;
			
			case "agregar-tarjeta":
				?><script>
					document.title += " Agrega una Tarjeta - <?=SITENAME?>";
				</script><?php
				include("UsuarioCliente/formTarjetas.php");
			break;

			case "addTarjeta":
				?><script>
					document.title += " Agregando Tarjeta - <?=SITENAME?>";
				</script><?php
				include("UsuarioCliente/addTarjeta.php");
			break;

			case "deleteTarjeta":
				?><script>
					document.title += " Eliminando Tarjeta - <?=SITENAME?>";
				</script><?php
				include("UsuarioCliente/deleteTarjeta.php");
			break;

			case "mis-pedidos":
				?><script>
					document.title += " Mis Pedidos - <?=SITENAME?>";
				</script><?php
				include("UsuarioCliente/misCompras.php");
			break;

			// Registrar

			case "addUsuarios":
				?><script>
					document.title += " Crea Tu Cuenta YG - <?=SITENAME?>";
				</script><?php
				include("Registrar/addUsuarios-cliente.php");
			break;

			case "formUsuario":
				?><script>
					document.title += " Crea Tu Cuenta YG - <?=SITENAME?>";
				</script><?php
				include("Registrar/formUsuario-cliente.php");
			break;

			case "agregarFoto":
				include("Registrar/formAgregarFoto.php");
			break;

			case "subirFotoPerfil":
				include("Registrar/subirFotoPerfil.php");
			break;

			// Nosotros

			case "sobre_yg":
				?><script>
					document.title += " Acerca de YG - <?=SITENAME?>";
				</script><?php
				include("Nosotros/SobreYG/sobreYG.php");
			break;
			
			case "contacto":
				?><script>
					document.title += " Contáctanos - <?=SITENAME?>";
				</script><?php
				include("Nosotros/Contacto/contacto.php");
			break;

			//ESPECIAL - Creditos

			case "BahiaGroup":
				?><script>
					document.title += " Sobre Bahía Group - <?=SITENAME?>";
				</script><?php
				include("Nosotros/BahiaGroup.php");
			break;

			//Inicio

			default:
				?><script>
					document.title += " <?=SITENAME?>";
				</script><?php
				include("home-cliente.php");
			break;

		}

		include_once(FOOTERCLIENTE);

?>