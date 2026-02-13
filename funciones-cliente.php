<?php

// --------------------------------------------- Nombre en la parte de arriba -----------------------------------------

function getDatosUsuarioCliente($IDUsuarioCliente){
	var_dump($IDUsuarioCliente);
	include("MySqli_conexionDB.php");
	$Nombre = "";
	$query = "SELECT IDUsuario,Nombre,APaterno FROM usuario_cliente WHERE IDUsuario=$IDUsuarioCliente";
    if(!$result = mysqli_query($miConexion,$query)){
        exit(mysqli_error($miConexion));
    }

    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $Nombre = $row['Nombre']." ".$row['APaterno'];
        }
    }
	return $Nombre;
} 

// -------------------------------------------- Usuarios ---------------------------------------

function obtenerListaUsuariosCliente()
{
	include('MySqli_conexionDB.php');
	
	$query = "SELECT IDUsuario,Nombre,APaterno,AMaterno,FotoPerfil,Telefono,Correo,NombreUsuarioCliente,ContrasenaCliente FROM usuario_cliente";
	
	if(!$resultado = mysqli_query($miConexion, $query)){
		exit(mysqli_error($miConexion));
	}

	$lista = array();

	if(mysqli_num_rows($resultado) > 0)
	{
		while($renglon =mysqli_fetch_assoc($resultado) )
		{
			if($renglon['FotoPerfil']=="")
        		$foto = IMAGES_ORIGEN.'UsuariosClientes/fotos/dft-perfil-v2.svg';
        	else
        		$foto = IMAGES_ORIGEN.'UsuariosClientes/fotos/'.$renglon['FotoPerfil'];
		
			$lista[] = array(
						'IDUsuario' => $renglon['IDUsuario'],
						'Nombre' => $renglon['Nombre'],
						'APaterno' => $renglon['APaterno'],
						'AMaterno' => $renglon['AMaterno'],
						'mostrarPerfil' => $foto,
						'FotoPerfil' => $renglon['FotoPerfil'],
						'Telefono' => $renglon['Telefono'],
						'Correo' => $renglon['Correo'],
						'NombreUsuarioCliente' => $renglon['NombreUsuarioCliente'],
						'ContrasenaCliente' => $renglon['ContrasenaCliente'] 
						
						);			
		}
	
	}
	return $lista;
}

						
function obtenerDatosUsuarioCliente($IDUsuarioCliente)
{
	include('MySqli_conexionDB.php');
	$folderRuta = "admin/UsuariosClientes/fotos/";
	
	$query = "SELECT IDUsuario,Nombre,APaterno,AMaterno,FotoPerfil,Telefono,Correo,NombreUsuarioCliente,ContrasenaCliente FROM usuario_cliente WHERE IDUsuario=$IDUsuarioCliente";
	
	if(!$resultado = mysqli_query($miConexion, $query)){
		exit(mysqli_error($miConexion));
	}

	$datosUsuarioCliente = array();
	
	if(mysqli_num_rows($resultado) > 0)
	{
		while($renglon =mysqli_fetch_assoc($resultado) )
		{
			if($renglon['FotoPerfil']=="")
        		$foto = IMAGES_ORIGEN.'UsuariosClientes/fotos/dft-perfil-morado.svg';
        	else
        		$foto = IMAGES_ORIGEN.'UsuariosClientes/fotos/'.$renglon['FotoPerfil'];
		
			$datosUsuarioCliente = array(
							'IDUsuario' => $renglon['IDUsuario'],
							'Nombre' => $renglon['Nombre'],
							'APaterno' => $renglon['APaterno'],
							'AMaterno' => $renglon['AMaterno'],
							'mostrarPerfil' => $foto,
							'FotoPerfil' => $renglon['FotoPerfil'],
							'Telefono' => $renglon['Telefono'],
							'Correo' => $renglon['Correo'],
							'NombreUsuarioCliente' => $renglon['NombreUsuarioCliente'],
							'ContrasenaCliente' => $renglon['ContrasenaCliente'] 
						);			
		}
	
	}
	return $datosUsuarioCliente;
}

//Mis Tarjetas

function getListTarjetas($IDUsuario){
	include('MySqli_conexionDB.php');
	
	$query = "SELECT IDTarjeta, IDUsuario, nombreTitular, Numero, FechaVencimiento, CVC, Estado FROM tarjetas WHERE Estado=1 AND IDUsuario='$IDUsuario'";
	if (!$result = mysqli_query($miConexion, $query)) {
        exit(mysqli_error($miConexion));
    }
    $lista = array();
    if(mysqli_num_rows($result) > 0) {
        while ($renglon = mysqli_fetch_assoc($result)) {
    
            $lista[] = array(
				'IDTarjeta' => $renglon['IDTarjeta'],
				'IDUsuario' => $renglon['IDUsuario'],
				'nombreTitular' => $renglon['nombreTitular'],
				'Numero' => $renglon['Numero'],
				'FechaVencimiento' => $renglon['FechaVencimiento'],
				'CVC' => $renglon['CVC'],
				'Estado' => $renglon['Estado']
				);
        }
    }
    return $lista;
}


//Mis Compras

function getListMisCompras($IDUsuario){
	include('MySqli_conexionDB.php');
	
	$query = "SELECT IDVentaAmigurumi, IDUsuario, Cantidad, Subtotal, IVA, Total, FechaRegistro, MetodoPago, infoMetodoPago, VentaEn, Estado FROM pedidos_amigurumis WHERE IDUsuario='$IDUsuario' order by FechaRegistro desc";
	if (!$result = mysqli_query($miConexion, $query)) {
        exit(mysqli_error($miConexion));
    }
    $lista = array();
    if(mysqli_num_rows($result) > 0) {
        while ($renglon = mysqli_fetch_assoc($result)) {
    
            $lista[] = array(
				'IDVentaAmigurumi' => $renglon['IDVentaAmigurumi'],
				'IDUsuario' => $renglon['IDUsuario'],
				'Cantidad' => $renglon['Cantidad'],
				'Subtotal' => $renglon['Subtotal'],
				'IVA' => $renglon['IVA'],
				'Total' => $renglon['Total'],
				'FechaRegistro' => $renglon['FechaRegistro'],
				'MetodoPago' => $renglon['MetodoPago'],
				'infoMetodoPago' => $renglon['infoMetodoPago'],
				'VentaEn' => $renglon['VentaEn'],
				'Estado' => $renglon['Estado']
				);
        }
    }
    return $lista;
}
function getListMisComprasDetalle($IDVentaAmigurumi){
	include('MySqli_conexionDB.php');
	
	$query = "SELECT IDVentaDetalle, IDVentaAmigurumi, IDAmigurumi, Cantidad, Precio, Importe FROM venta_detalles_amigurumis WHERE IDVentaAmigurumi='$IDVentaAmigurumi'";
	if (!$result = mysqli_query($miConexion, $query)) {
        exit(mysqli_error($miConexion));
    }
    $lista = array();
    if(mysqli_num_rows($result) > 0) {
        while ($renglon = mysqli_fetch_assoc($result)) {
    
            $lista[] = array(
				'IDVentaDetalle' => $renglon['IDVentaDetalle'],
				'IDVentaAmigurumi' => $renglon['IDVentaAmigurumi'],
				'IDAmigurumi' => $renglon['IDAmigurumi'],
				'Cantidad' => $renglon['Cantidad'],
				'Precio' => $renglon['Precio'],
				'Importe' => $renglon['Importe']
				);
        }
    }
    return $lista;
}

function obtenerTodosInfoAmigurumisMisPedidos($IDAmigurumi)
{
	include('MySqli_conexionDB.php');
	
	$query = "SELECT amigurumis.IDAmigurumi, amigurumis.NombreAmigurumi, amigurumis.Producto, amigurumis.Existencias, amigurumis.Descripcion, amigurumis.Precio, amigurumis.Estado, amigurumis.IDCategoria, amigurumis.Foto, categorias.Nombre, categorias.Estado FROM amigurumis INNER JOIN categorias on amigurumis.IDCategoria=categorias.IDCategoria WHERE amigurumis.IDAmigurumi=".$IDAmigurumi." order by amigurumis.IDAmigurumi desc ;";
	
	if(!$resultado = mysqli_query($miConexion, $query)){ 
		exit(mysqli_error($miConexion));
	}
	$datosAmigurumis = array();
	
	if(mysqli_num_rows($resultado) > 0)
	{
		while($renglon =mysqli_fetch_assoc($resultado) )
		{	
			if($renglon['Foto']==""){
        		$foto = IMAGES_ORIGEN.'Amigurumis/Fotos/v2.svg';
        	}else{
        		$foto = IMAGES_ORIGEN.'Amigurumis/Fotos/'.$renglon['Foto'];
			}
			$datosAmigurumis = array(
						'IDAmigurumi' => $renglon['IDAmigurumi'],
						'NombreAmigurumi' => $renglon['NombreAmigurumi'],
						'Producto' => $renglon['Producto'],
						'Existencias' => $renglon['Existencias'],
						'Descripcion' => $renglon['Descripcion'],
						'Precio' => $renglon['Precio'],
						'Estado' => $renglon['Estado'],
						'IDCategoria' => $renglon['IDCategoria'],		
						'mostrarFoto' => $foto,
						'Foto' => $renglon['Foto'],
						'Nombre' => $renglon['Nombre']
						);			
		}
	}
	return $datosAmigurumis;
}

?>

<!-- --------------------------------------------------------------------- Buscador --------------------------------------------------------------------------------->

<?php

// Buscador

function obtenerBusqueda($palabra)
{
	include ('MySqli_conexionDB.php');

	$orderBy = "amigurumis.IDAmigurumi";
	$order = "desc";
				
	if(!empty($_GET["orderby"])) {
		$orderBy = $_GET["orderby"];
	}
	if(!empty($_GET["order"])) {
		$order = $_GET["order"];
	}
	
	if($palabra!=null){
		$query ="SELECT amigurumis.IDAmigurumi, amigurumis.NombreAmigurumi, amigurumis.Producto, amigurumis.Descripcion, amigurumis.Precio, amigurumis.Estado, amigurumis.IDCategoria, amigurumis.Foto, categorias.Nombre, categorias.Estado FROM amigurumis INNER JOIN categorias on amigurumis.IDCategoria=categorias.IDCategoria WHERE amigurumis.Estado='DISPONIBLE' and categorias.Estado='DISPONIBLE' and amigurumis.NombreAmigurumi LIKE '%$palabra%' or amigurumis.Estado='DISPONIBLE' and categorias.Estado='DISPONIBLE' and amigurumis.Descripcion LIKE '%$palabra%' or amigurumis.Estado='DISPONIBLE' and categorias.Estado='DISPONIBLE' and amigurumis.Producto LIKE '%$palabra%' or amigurumis.Estado='DISPONIBLE' and categorias.Estado='DISPONIBLE' and amigurumis.Precio LIKE '%$palabra%' or amigurumis.Estado='DISPONIBLE' and categorias.Estado='DISPONIBLE' and categorias.Nombre LIKE '%$palabra%' order by ". $orderBy . " " . $order ;
	}
	
	if(!$resultado = mysqli_query($miConexion,$query))
		exit(mysqli_error($miConexion));
	$lista = array();
	if(mysqli_num_rows($resultado) > 0)
	{
		while($renglon = mysqli_fetch_assoc($resultado))
		{
			if($renglon['Foto']=="")
				$foto = IMAGES_ORIGEN.'Amigurumis/Fotos/v2.svg';
			else
				$foto = IMAGES_ORIGEN.'Amigurumis/Fotos/'.$renglon['Foto'];

			$lista[] = array(
				'IDAmigurumi' => $renglon['IDAmigurumi'],
				'NombreAmigurumi' => $renglon['NombreAmigurumi'],
				'Producto' => $renglon['Producto'],
				'Descripcion' => $renglon['Descripcion'],
				'Precio' => $renglon['Precio'],
				'Estado' => $renglon['Estado'],
				'IDCategoria' => $renglon['IDCategoria'],
				'Nombre' => $renglon['Nombre'],
				'mostrarFoto' => $foto,
				'Foto' => $renglon['Foto']);
		}
	}
	return $lista;
}

?>

<!-- ----------------------------------------------------------------- Fin de Buscador ------------------------------------------------------------------------------>
<!-- --------------------------------------------------------------- Divisor de carrito --------------------------------------------------------------------------->

<?php

// Carrito

function obtenerCarrito($IDUsuarioCarrito)
{
	include('MySqli_conexionDB.php');
	$query = "SELECT carrito.IDUsuario, carrito.IDAmigurumi, carrito.Cantidad, carrito.F_agregado, usuario_cliente.IDUsuario, amigurumis.IDAmigurumi, amigurumis.NombreAmigurumi, amigurumis.Producto, amigurumis.Descripcion, amigurumis.Precio, amigurumis.Estado, amigurumis.Foto, amigurumis.IDCategoria, categorias.IDCategoria, categorias.Nombre, categorias.Estado FROM carrito INNER JOIN usuario_cliente on usuario_cliente.IDUsuario=carrito.IDUsuario INNER JOIN amigurumis on amigurumis.IDAmigurumi=carrito.IDAmigurumi INNER JOIN categorias on amigurumis.IDCategoria=categorias.IDCategoria WHERE amigurumis.Estado='DISPONIBLE' and carrito.IDUsuario=$IDUsuarioCarrito and categorias.Estado='DISPONIBLE' order by F_agregado desc ;";

	if(!$resultado = mysqli_query($miConexion, $query))
		exit(mysqli_error($miConexion));

		$listaCarrito = array();
	
	if(mysqli_num_rows($resultado) > 0)
	{
		while($renglon =mysqli_fetch_assoc($resultado) )
		{
			if($renglon['Foto']=="") 
         		$foto = IMAGES_ORIGEN.'Amigurumis/Fotos/v2.svg';
         	else
         		$foto = IMAGES_ORIGEN.'Amigurumis/Fotos/'.$renglon['Foto'];

			$listaCarrito[] = array(
						'IDUsuario' => $renglon['IDUsuario'],
						'IDAmigurumi' => $renglon['IDAmigurumi'],
						'Cantidad' => $renglon['Cantidad'],
						'F_agregado' => $renglon['F_agregado'],
						'NombreAmigurumi' => $renglon['NombreAmigurumi'],
						'Descripcion' => $renglon['Descripcion'],
						'Producto' => $renglon['Producto'],
						'Precio' => $renglon['Precio'],
						'Estado' => $renglon['Estado'],
						'IDCategoria' => $renglon['IDCategoria'],
						'Nombre' => $renglon['Nombre'],
 						'mostrarFoto' => $foto,
 						'Foto' => $renglon['Foto']
						);			
		}	
	}
	return $listaCarrito;
}?>

<!------------------------------------------------------------------- Fin de divisor carrito ------------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- Divisor de guardados --------------------------------------------------------------------------->

<?php

// Guardados

function obtenerGuardados($IDUsuarioGuardados)
{
	include('MySqli_conexionDB.php');
	$query = "SELECT guardados.IDUsuario, guardados.IDAmigurumi, guardados.F_Guardado, usuario_cliente.IDUsuario, amigurumis.IDAmigurumi, amigurumis.NombreAmigurumi, amigurumis.Producto, amigurumis.Descripcion, amigurumis.Precio, amigurumis.Estado, amigurumis.Foto, amigurumis.IDCategoria, categorias.IDCategoria, categorias.Estado FROM guardados INNER JOIN usuario_cliente on usuario_cliente.IDUsuario=guardados.IDUsuario INNER JOIN amigurumis on amigurumis.IDAmigurumi=guardados.IDAmigurumi INNER JOIN categorias on amigurumis.IDCategoria=categorias.IDCategoria WHERE amigurumis.Estado='DISPONIBLE' and guardados.IDUsuario=$IDUsuarioGuardados and categorias.Estado='DISPONIBLE' order by F_Guardado desc ;";

	if(!$resultado = mysqli_query($miConexion, $query))
		exit(mysqli_error($miConexion));

		$listaGuardados = array();
	
	if(mysqli_num_rows($resultado) > 0)
	{
		while($renglon =mysqli_fetch_assoc($resultado) )
		{
			if($renglon['Foto']=="") 
         		$foto = IMAGES_ORIGEN.'Amigurumis/Fotos/v2.svg';
         	else
         		$foto = IMAGES_ORIGEN.'Amigurumis/Fotos/'.$renglon['Foto'];

			$listaGuardados[] = array(
						'IDUsuario' => $renglon['IDUsuario'],
						'IDAmigurumi' => $renglon['IDAmigurumi'],
						'F_Guardado' => $renglon['F_Guardado'],
						'NombreAmigurumi' => $renglon['NombreAmigurumi'],
						'Descripcion' => $renglon['Descripcion'],
						'Producto' => $renglon['Producto'],
						'Precio' => $renglon['Precio'],
						'Estado' => $renglon['Estado'],
						'IDCategoria' => $renglon['IDCategoria'],
 						'mostrarFoto' => $foto,
 						'Foto' => $renglon['Foto']
						);			
		}	
	}
	return $listaGuardados;
}?>

<!------------------------------------------------------------------- Fin de divisor guardados ------------------------------------------------------------------- -->

<!-- --------------------------------------------------------------- Divisor de amigurumis --------------------------------------------------------------------------->

<?php
function obtenerFotosAmigurumis($IDAmigurumi)
{
	include('MySqli_conexionDB.php');
	// $folderRuta = "admin/Amigurumis/Fotos/";

	$query = "SELECT amigurumis.IDAmigurumi, amigurumis.NombreAmigurumi, amigurumis.Producto, amigurumis.Descripcion, amigurumis.Precio, amigurumis.Estado, amigurumis.IDCategoria, amigurumis.Foto, fotos_amigurumis.NombreFoto, fotos_amigurumis.IDFoto, categorias.Nombre, categorias.Estado FROM amigurumis INNER JOIN fotos_amigurumis on amigurumis.IDAmigurumi=fotos_amigurumis.IDAmigurumi INNER JOIN categorias on amigurumis.IDCategoria=categorias.IDCategoria WHERE amigurumis.IDAmigurumi='$IDAmigurumi' and amigurumis.Estado='DISPONIBLE' and categorias.Estado='DISPONIBLE' order by IDAmigurumi desc ;";
	
	if(!$resultado = mysqli_query($miConexion, $query))
		exit(mysqli_error($miConexion));

		$lista = array();
	
	if(mysqli_num_rows($resultado) > 0)
	{
		while($renglon =mysqli_fetch_assoc($resultado) )
		{
			if($renglon['NombreFoto']=="") 
        		$foto = IMAGES_ORIGEN.'Amigurumis/Fotos/v2.svg';
        	else
        		$foto = IMAGES_ORIGEN.'Amigurumis/Galeria/'.$renglon['NombreFoto'];

			$lista[] = array(
						'IDAmigurumi' => $renglon['IDAmigurumi'],
						'NombreAmigurumi' => $renglon['NombreAmigurumi'],
						'Producto' => $renglon['Producto'],
						'Descripcion' => $renglon['Descripcion'],
						'Precio' => $renglon['Precio'],
						'Estado' => $renglon['Estado'],
						'IDCategoria' => $renglon['IDCategoria'],
						'IDFoto' => $renglon['IDFoto'],
						'mostrarFoto' => $foto,
						'NombreFoto' => $renglon['NombreFoto']
					);			
		}	
	}
	return $lista;
}

//Todos Amigurumis

function obtenerTodosAmigurumis()
{
	include('MySqli_conexionDB.php');
	// $folderRuta = "admin/Amigurumis/Fotos/";

	$orderBy = "amigurumis.IDAmigurumi";
	$order = "desc";
				
	if(!empty($_GET["orderby"])) {
		$orderBy = $_GET["orderby"];
	}
	if(!empty($_GET["order"])) {
		$order = $_GET["order"];
	}
	
	$query = "SELECT amigurumis.IDAmigurumi, amigurumis.NombreAmigurumi, amigurumis.Producto, amigurumis.Existencias, amigurumis.Descripcion, amigurumis.Precio, amigurumis.Estado, amigurumis.IDCategoria, amigurumis.Foto, categorias.Nombre, categorias.Estado FROM amigurumis INNER JOIN categorias on amigurumis.IDCategoria=categorias.IDCategoria WHERE amigurumis.Estado='DISPONIBLE' and categorias.Estado='DISPONIBLE' order by ". $orderBy . " " . $order ;

	if(!$resultado = mysqli_query($miConexion, $query))
		exit(mysqli_error($miConexion));

		$lista = array();
	
	if(mysqli_num_rows($resultado) > 0)
	{
		while($renglon =mysqli_fetch_assoc($resultado) )
		{
			if($renglon['Foto']=="") 
        		$foto = IMAGES_ORIGEN.'Amigurumis/Fotos/v2.svg';
        	else
        		$foto = IMAGES_ORIGEN.'Amigurumis/Fotos/'.$renglon['Foto'];

			$lista[] = array(
						'IDAmigurumi' => $renglon['IDAmigurumi'],
						'NombreAmigurumi' => $renglon['NombreAmigurumi'],
						'Producto' => $renglon['Producto'],
						'Existencias' => $renglon['Existencias'],
						'Descripcion' => $renglon['Descripcion'],
						'Precio' => $renglon['Precio'],
						'Estado' => $renglon['Estado'],
						'IDCategoria' => $renglon['IDCategoria'],
						'mostrarFoto' => $foto,
						'Foto' => $renglon['Foto']
					);			
		}	
	}
	return $lista;
}

function obtenerTodosInfoAmigurumis($IDAmigurumi)
{
	include('MySqli_conexionDB.php');
	
	$query = "SELECT amigurumis.IDAmigurumi, amigurumis.NombreAmigurumi, amigurumis.Producto, amigurumis.Existencias, amigurumis.Descripcion, amigurumis.Precio, amigurumis.Estado, amigurumis.IDCategoria, amigurumis.Foto, categorias.Nombre, categorias.Estado FROM amigurumis INNER JOIN categorias on amigurumis.IDCategoria=categorias.IDCategoria WHERE amigurumis.IDAmigurumi=".$IDAmigurumi." and amigurumis.Estado='DISPONIBLE' and categorias.Estado='DISPONIBLE' order by amigurumis.IDAmigurumi desc ;";
	
	if(!$resultado = mysqli_query($miConexion, $query)){ 
		exit(mysqli_error($miConexion));
	}
	$datosAmigurumis = array();
	
	if(mysqli_num_rows($resultado) > 0)
	{
		while($renglon =mysqli_fetch_assoc($resultado) )
		{	
			if($renglon['Foto']==""){
        		$foto = IMAGES_ORIGEN.'Amigurumis/Fotos/v2.svg';
        	}else{
        		$foto = IMAGES_ORIGEN.'Amigurumis/Fotos/'.$renglon['Foto'];
			}
			$datosAmigurumis = array(
						'IDAmigurumi' => $renglon['IDAmigurumi'],
						'NombreAmigurumi' => $renglon['NombreAmigurumi'],
						'Producto' => $renglon['Producto'],
						'Existencias' => $renglon['Existencias'],
						'Descripcion' => $renglon['Descripcion'],
						'Precio' => $renglon['Precio'],
						'Estado' => $renglon['Estado'],
						'IDCategoria' => $renglon['IDCategoria'],		
						'mostrarFoto' => $foto,
						'Foto' => $renglon['Foto'],
						'Nombre' => $renglon['Nombre']
						);			
		}
	}
	return $datosAmigurumis;
}
?>

<?php
//Amigurumi

function obtenerAmigurumis(){
	include('MySqli_conexionDB.php');
	// $folderRuta = "admin/Amigurumis/Fotos/";

	$orderBy = "amigurumis.IDAmigurumi";
	$order = "desc";
				
	if(!empty($_GET["orderby"])) {
		$orderBy = $_GET["orderby"];
	}
	if(!empty($_GET["order"])) {
		$order = $_GET["order"];
	}
	
	$query = "SELECT amigurumis.IDAmigurumi, amigurumis.NombreAmigurumi, amigurumis.Producto, amigurumis.Descripcion, amigurumis.Precio, amigurumis.Estado, amigurumis.IDCategoria, amigurumis.Foto, categorias.Nombre, categorias.Estado FROM amigurumis INNER JOIN categorias on amigurumis.IDCategoria=categorias.IDCategoria WHERE amigurumis.Producto='Amigurumi' and amigurumis.Estado='DISPONIBLE' and categorias.Estado='DISPONIBLE' order by ". $orderBy . " " . $order ;
	
	if(!$resultado = mysqli_query($miConexion, $query))
		exit(mysqli_error($miConexion));

		$lista = array();
	
	if(mysqli_num_rows($resultado) > 0)
	{
		while($renglon =mysqli_fetch_assoc($resultado) )
		{
			if($renglon['Foto']=="") 
        		$foto = IMAGES_ORIGEN.'Amigurumis/Fotos/v2.svg';
        	else
        		$foto = IMAGES_ORIGEN.'Amigurumis/Fotos/'.$renglon['Foto'];

			$lista[] = array(
						'IDAmigurumi' => $renglon['IDAmigurumi'],
						'NombreAmigurumi' => $renglon['NombreAmigurumi'],
						'Producto' => $renglon['Producto'],
						'Descripcion' => $renglon['Descripcion'],
						'Precio' => $renglon['Precio'],
						'Estado' => $renglon['Estado'],
						'IDCategoria' => $renglon['IDCategoria'],
						'mostrarFoto' => $foto,
						'Foto' => $renglon['Foto']
					);			
		}	
	}
	return $lista;
}?>

<?php
//Accesorios

function obtenerAccesorios(){
	include('MySqli_conexionDB.php');
	// $folderRuta = "admin/Amigurumis/Fotos/";

	$orderBy = "amigurumis.IDAmigurumi";
	$order = "desc";
				
	if(!empty($_GET["orderby"])) {
		$orderBy = $_GET["orderby"];
	}
	if(!empty($_GET["order"])) {
		$order = $_GET["order"];
	}
	
	$query = "SELECT amigurumis.IDAmigurumi, amigurumis.NombreAmigurumi, amigurumis.Producto, amigurumis.Descripcion, amigurumis.Precio, amigurumis.Estado, amigurumis.IDCategoria, amigurumis.Foto, categorias.Nombre, categorias.Estado FROM amigurumis INNER JOIN categorias on amigurumis.IDCategoria=categorias.IDCategoria WHERE amigurumis.Producto='Accesorio' and amigurumis.Estado='DISPONIBLE' and categorias.Estado='DISPONIBLE' order by ". $orderBy . " " . $order ;
	
	if(!$resultado = mysqli_query($miConexion, $query))
		exit(mysqli_error($miConexion));

		$lista = array();
	
	if(mysqli_num_rows($resultado) > 0)
	{
		while($renglon =mysqli_fetch_assoc($resultado) )
		{
			if($renglon['Foto']=="") 
        		$foto = IMAGES_ORIGEN.'Amigurumis/Fotos/v2.svg';
        	else
        		$foto = IMAGES_ORIGEN.'Amigurumis/Fotos/'.$renglon['Foto'];

			$lista[] = array(
						'IDAmigurumi' => $renglon['IDAmigurumi'],
						'NombreAmigurumi' => $renglon['NombreAmigurumi'],
						'Producto' => $renglon['Producto'],
						'Descripcion' => $renglon['Descripcion'],
						'Precio' => $renglon['Precio'],
						'Estado' => $renglon['Estado'],
						'IDCategoria' => $renglon['IDCategoria'],
						'mostrarFoto' => $foto,
						'Foto' => $renglon['Foto']
					);			
		}	
	}
	return $lista;
}?>


<?php

//Llavero

function obtenerLlavero(){
	include('MySqli_conexionDB.php');
	// $folderRuta = "admin/Amigurumis/Fotos/";

	$orderBy = "amigurumis.IDAmigurumi";
	$order = "desc";
				
	if(!empty($_GET["orderby"])) {
		$orderBy = $_GET["orderby"];
	}
	if(!empty($_GET["order"])) {
		$order = $_GET["order"];
	}
	
	$query = "SELECT amigurumis.IDAmigurumi, amigurumis.NombreAmigurumi, amigurumis.Producto, amigurumis.Descripcion, amigurumis.Precio, amigurumis.Estado, amigurumis.IDCategoria, amigurumis.Foto, categorias.Nombre, categorias.Estado FROM amigurumis INNER JOIN categorias on amigurumis.IDCategoria=categorias.IDCategoria WHERE amigurumis.Producto='Llavero' and amigurumis.Estado='DISPONIBLE' and categorias.Estado='DISPONIBLE' order by ". $orderBy . " " . $order ;
	
	if(!$resultado = mysqli_query($miConexion, $query))
		exit(mysqli_error($miConexion));

		$lista = array();
	
	if(mysqli_num_rows($resultado) > 0)
	{
		while($renglon =mysqli_fetch_assoc($resultado) )
		{
			if($renglon['Foto']=="") 
        		$foto = IMAGES_ORIGEN.'Amigurumis/Fotos/v2.svg';
        	else
        		$foto = IMAGES_ORIGEN.'Amigurumis/Fotos/'.$renglon['Foto'];

			$lista[] = array(
						'IDAmigurumi' => $renglon['IDAmigurumi'],
						'NombreAmigurumi' => $renglon['NombreAmigurumi'],
						'Producto' => $renglon['Producto'],
						'Descripcion' => $renglon['Descripcion'],
						'Precio' => $renglon['Precio'],
						'Estado' => $renglon['Estado'],
						'IDCategoria' => $renglon['IDCategoria'],
						'mostrarFoto' => $foto,
						'Foto' => $renglon['Foto']
					);		
		}	
	}
	return $lista;
}?>

<?php

//Peculiaridades

function obtenerPeculiaridades(){
	include('MySqli_conexionDB.php');
	$folderRuta = "admin/Amigurumis/Fotos/";

	$orderBy = "amigurumis.IDAmigurumi";
	$order = "desc";
				
	if(!empty($_GET["orderby"])) {
		$orderBy = $_GET["orderby"];
	}
	if(!empty($_GET["order"])) {
		$order = $_GET["order"];
	}
	
	$query = "SELECT amigurumis.IDAmigurumi, amigurumis.NombreAmigurumi, amigurumis.Producto, amigurumis.Descripcion, amigurumis.Precio, amigurumis.Estado, amigurumis.IDCategoria, amigurumis.Foto, categorias.Nombre, categorias.Estado FROM amigurumis INNER JOIN categorias on amigurumis.IDCategoria=categorias.IDCategoria WHERE amigurumis.Producto='Peculiaridad' and amigurumis.Estado='DISPONIBLE' and categorias.Estado='DISPONIBLE' order by ". $orderBy . " " . $order ;
	
	if(!$resultado = mysqli_query($miConexion, $query))
		exit(mysqli_error($miConexion));

		$lista = array();
	
	if(mysqli_num_rows($resultado) > 0)
	{
		while($renglon =mysqli_fetch_assoc($resultado) )
		{
			if($renglon['Foto']=="") 
        		$foto = IMAGES_ORIGEN.'Amigurumis/Fotos/v2.svg';
        	else
        		$foto = IMAGES_ORIGEN.'Amigurumis/Fotos/'.$renglon['Foto'];

			$lista[] = array(
						'IDAmigurumi' => $renglon['IDAmigurumi'],
						'NombreAmigurumi' => $renglon['NombreAmigurumi'],
						'Producto' => $renglon['Producto'],
						'Descripcion' => $renglon['Descripcion'],
						'Precio' => $renglon['Precio'],
						'Estado' => $renglon['Estado'],
						'IDCategoria' => $renglon['IDCategoria'],
						'mostrarFoto' => $foto,
						'Foto' => $renglon['Foto']
					);			
		}	
	}
	return $lista;
}?>

<!--------------------------------------------------------------- Fin de divisor de amigurumis -------------------------------------------------------------------- -->


<!------------------------------------------------------------------- Divisor de Patrones -------------------------------------------------------------------- -->

<?php

//Patrones

function obtenerPatrones(){
	include('MySqli_conexionDB.php');
	$folderRuta = "admin/Amigurumis/Fotos/";

	$orderBy = "amigurumis.IDAmigurumi";
	$order = "desc";
				
	if(!empty($_GET["orderby"])) {
		$orderBy = $_GET["orderby"];
	}
	if(!empty($_GET["order"])) {
		$order = $_GET["order"];
	}
	
	$query = "SELECT amigurumis.IDAmigurumi, amigurumis.NombreAmigurumi, amigurumis.Producto, amigurumis.Descripcion, amigurumis.Precio, amigurumis.Estado, amigurumis.IDCategoria, amigurumis.Foto, categorias.Nombre, categorias.Estado FROM amigurumis INNER JOIN categorias on amigurumis.IDCategoria=categorias.IDCategoria WHERE amigurumis.Producto='Patron' and amigurumis.Estado='DISPONIBLE' and categorias.Estado='DISPONIBLE' order by ". $orderBy . " " . $order ;
	
	if(!$resultado = mysqli_query($miConexion, $query))
		exit(mysqli_error($miConexion));

		$lista = array();
	
	if(mysqli_num_rows($resultado) > 0)
	{
		while($renglon =mysqli_fetch_assoc($resultado) )
		{
			if($renglon['Foto']=="") 
        		$foto = IMAGES_ORIGEN.'Amigurumis/Fotos/v2.svg';
        	else
        		$foto = IMAGES_ORIGEN.'Amigurumis/Fotos/'.$renglon['Foto'];

			$lista[] = array(
						'IDAmigurumi' => $renglon['IDAmigurumi'],
						'NombreAmigurumi' => $renglon['NombreAmigurumi'],
						'Producto' => $renglon['Producto'],
						'Descripcion' => $renglon['Descripcion'],
						'Precio' => $renglon['Precio'],
						'Estado' => $renglon['Estado'],
						'IDCategoria' => $renglon['IDCategoria'],
						'mostrarFoto' => $foto,
						'Foto' => $renglon['Foto']
					);			
		}	
	}
	return $lista;
}?>

<!---------------------------------------------------------------- Fin de divisor de Patrones -------------------------------------------------------------------- -->

<!--------------------------------------------------------------------- Divisor Categorias -------------------------------------------------------------------- -->

<?php

function obtenerListaCategorias()
{
	include('MySqli_conexionDB.php');
	
	$query = "SELECT IDCategoria, Nombre, Estado FROM categorias WHERE Estado='DISPONIBLE';";
	
	if(!$resultado = mysqli_query($miConexion, $query))
		exit(mysqli_error($miConexion));

	$lista = array();
	
	if(mysqli_num_rows($resultado) > 0)
	{
		while($renglon =mysqli_fetch_assoc($resultado) )
		{
			$lista[] = array(
						'IDCategoria' => $renglon['IDCategoria'],
						'Nombre' => $renglon['Nombre'],
						'Estado' => $renglon['Estado']
						);			
		}
	}
	return $lista;
}

function obtenerDatosCategorias($IDCategoria)
{
	include('MySqli_conexionDB.php');
	
	
	$query = "SELECT IDCategoria, Nombre, Estado FROM categorias WHERE IDCategoria=".$IDCategoria;
	
	if(!$resultado = mysqli_query($miConexion, $query))
		exit(mysqli_error($miConexion));
	
	$datosCategoria = array();
	
	if(mysqli_num_rows($resultado) > 0)
	{
		while($renglon =mysqli_fetch_assoc($resultado) )
		{
			$datosCategoria = array(
						'IDCategoria' => $renglon['IDCategoria'],
						'Nombre' => $renglon['Nombre'],
						'Estado' => $renglon['Estado']
						);			
		}
	}
	return $datosCategoria;
}
?>

<!--------------------------------------------------------------------- Fin divisor Categorias -------------------------------------------------------------------- -->

<!------------------------------------------------------------------- Divisor Pedidos Amigurumis -------------------------------------------------------------------- -->

<?php
function obtenerPedidosAmigurumis($IDUsuarioCliente)
{
	include('MySqli_conexionDB.php');
	$query = "SELECT IDVentaAmigurumi, IDUsuario, IDAmigurumi, Tamano, Precio, Cantidad, Descuento, Subtotal, IVA, TotalPagar, FechaRegistro, FechaPago, FechaCancelacion, MetodoPago, InfoMetodoPago, VentaEn, Estado FROM pedidos_amigurumis WHERE IDUsuario='$IDUsuarioCliente'";
	
	if(!$resultado = mysqli_query($miConexion, $query))
		exit(mysqli_error($miConexion));
	
	$lista = array();
	
	if(mysqli_num_rows($resultado) > 0)
	{
		while($renglon =mysqli_fetch_assoc($resultado))
		{
			$lista[] = array(
				'IDVentaAmigurumi' => $renglon['IDVentaAmigurumi'],
				'IDUsuario' => $renglon['IDUsuario'],
				'IDAmigurumi' => $renglon['IDAmigurumi'],
				'Tamano' => $renglon['Tamano'],
				'Precio' => $renglon['Precio'],
				'Cantidad' => $renglon['Cantidad'],
				'Descuento' => $renglon['Descuento'],
				'Subtotal' => $renglon['Subtotal'],
				'IVA' => $renglon['IVA'],
				'TotalPagar' => $renglon['TotalPagar'],
				'FechaRegistro' => $renglon['FechaRegistro'],
				'FechaPago' => $renglon['FechaPago'],
				'FechaCancelacion' => $renglon['FechaCancelacion'],
				'MetodoPago' => $renglon['MetodoPago'],
				'InfoMetodoPago' => $renglon['InfoMetodoPago'],
				'VentaEn' => $renglon['VentaEn'],
				'Estado' => $renglon['Estado']
			);			
		}
	}
	return $lista;
}
?>

<!----------------------------------------------------------------- Fin divisor Pedidos Amigurumis -------------------------------------------------------------------- -->

<!---------------------------------------------------------------- Divisor Venta Detalle Amigurumis -------------------------------------------------------------------- -->

<?php
function obtenerVentaDetalleAmigurumis($IDVentaAmigurumi)
{
	include('MySqli_conexionDB.php');
	$query = "SELECT IDVentaDetalle, IDVentaAmigurumi, IDAmigurumi, Tamano, Cantidad, Precio, Descuento, Importe FROM venta_detalles_amigurumis WHERE IDVentaAmigurumi='$IDVentaAmigurumi'";
	
	if(!$resultado = mysqli_query($miConexion, $query))
		exit(mysqli_error($miConexion));
	
	$lista = array();
	
	if(mysqli_num_rows($resultado) > 0)
	{
		while($renglon =mysqli_fetch_assoc($resultado) )
		{
			$lista[] = array(
				'IDVentaDetalle' => $renglon['IDVentaDetalle'],
				'IDVentaAmigurumi' => $renglon['IDVentaAmigurumi'],
				'IDAmigurumi' => $renglon['IDAmigurumi'],
				'Tamano' => $renglon['Tamano'],
				'Cantidad' => $renglon['Cantidad'],
				'Precio' => $renglon['Precio'],
				'Descuento' => $renglon['Descuento'],
				'Importe' => $renglon['Importe']
			);			
		}
	}
	return $lista;
}
?>

<!-------------------------------------------------------------- Fin divisor Venta Detalle Amigurumis -------------------------------------------------------------------- -->