<?php

// controllers/PantallaTarjetas.php
	
	require '../fw/fw.php';
	require '../models/Tarjetas.php';
	require '../models/Usuarios.php';
	require '../models/Proveedores.php';
	require '../models/ValidacionException.php';
	require '../views/ListadoTarjetas.php';

	session_start();

	if(!isset($_SESSION['logueado'])){
		header("Location: inicio-sesion");
		exit;
	}

	$t = new Tarjetas();
	$p = new Proveedores();
	$u = new Usuarios();

	//obtenemos el nombre y apellido del usuario
	$usua = $u->getUsuario($_SESSION['nombre']);

	if(count($_POST)>0){

		if(!isset($_POST['formIdTarjeta'])) die("Error 1");
		if(!isset($_POST['formDocumento'])) die("Error 2");
		if(!isset($_POST['formNombre'])) die("Error 3");
		if(!isset($_POST['formApellido'])) die("Error 4");

		//circuito de alta de extensión
		//debemos validar que la persona a la que se le solicita la extensión no posea otra extensión de esa misma tarjeta
	
		if($t->validarExtension($_POST['formIdTarjeta'], $_POST['formDocumento'])){
			//si ingresa, significa que se debe realizar el alta de la extensión
			$t->realizarAltaExtension($_POST['formIdTarjeta'], $_POST['formNombre'], $_POST['formApellido'], $_POST['formDocumento'], $_SESSION['IdUsuario']);
			$mensaje = "Se ha aprobado la solicitud de alta de extensión";
		} else
		{
			//var_dump("no permitir");
			$mensaje = "Se ha rechazado la solicitud de alta de extensión - Ya existe una extensión de la tarjeta principal para la persona ingresada";
		}
	}
	

	$tarjetasUsuario = array();

	$listaPrincipales = array();
	$listaExtensiones = array();
	$auxDT = array();
	$auxEXT = array();
	$iP = 0;
	$iE = 0;

	
	
	//se obtienen todas las tarjetas (principales y extensiones) de ese usuario
	$tarjetasUsuario = $t->getTarjetasPorUsuario($_SESSION['IdUsuario']);
		
	//obtengo los datos necesarios para armar la lista de tarjetas principales
	foreach($tarjetasUsuario as $tu){
		//si el estado de la relacion tarjeta-usuario es activo, busco el detalle
		if($tu['cod_estado'] == 'A'){
			//obtengo el detalle de esa tarjeta
			$auxDT = $t->getDetalleTarjeta($tu['id_tarjeta']);
			
			//valido que el estado sea activo
			if($auxDT['cod_estado'] == 'A'){
				//obtengo el nombre del proveedor de tarjeta				
				$nombreProv = $p->getNombreProveedor($auxDT['cod_proveedor']);
			

				//si es una tarjeta principal, informo al array el detalle de la tarjeta.
				//si es una tarjeta extensión, debo obtener los datos adicionales de dicha extensión, para luego informar al array correspondiente.
				if($auxDT['tipo_tarjeta'] == 'P'){
					
					$listaPrincipales[$iP]['id_tarjeta'] = $auxDT['id_tarjeta'];
					$listaPrincipales[$iP]['nro_tarjeta'] = $auxDT['nro_tarjeta'];
					$listaPrincipales[$iP]['nombre_proveedor'] = $nombreProv;

					$iP++;
				} else{
			
					$listaExtensiones[$iE]['nro_tarjeta'] = $auxDT['nro_tarjeta'];
					$auxEXT = $t->getDetalleExtension($tu['id_tarjeta']);
					$listaExtensiones[$iE]['nombre_ext'] = $auxEXT['nombre_ext'];
					$listaExtensiones[$iE]['apellido_ext'] = $auxEXT['apellido_ext'];
					$listaExtensiones[$iE]['nombre_proveedor'] = $nombreProv;
					$listaExtensiones[$iE]['documento_ext'] = $auxEXT['documento_ext'];

					$iE++;
				}
				
			}
		}
	}

	$v = new ListadoTarjetas();
	$v->tarjetasPrincipales = $listaPrincipales;
	$v->tarjetasExtensiones = $listaExtensiones;
	$v->usuario = $_SESSION['nombre'];
	$v->mensaje = $mensaje;
	$v->operaCuentas = $_SESSION['tieneCuentas'];
	$v->operaTarjetas = $_SESSION['tieneTarjetas'];
	$v->nombre = $usua['nombre'];
	$v->apellido = $usua['apellido'];

	//render sería como decirle "dibujate"
	$v->render();	


?>