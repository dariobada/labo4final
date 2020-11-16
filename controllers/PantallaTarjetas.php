<?php

// controllers/PantallaTarjetas.php
	
	require '../fw/fw.php';
	require '../models/Tarjetas.php';
	require '../models/Proveedores.php';
	require '../views/ListadoTarjetas.php';

	session_start();

	if(!isset($_SESSION['logueado'])){
		header("Location: PantallaLogin.php");
		exit;
	}

	if(count($_POST)>0){
		//circuito de alta de extensión
		//debemos validar que la persona a la que se le solicita la extensión no posea otra extensión de esa misma tarjeta
		alert("id original: " . $_POST['formIdTarjeta']);
	}

	$t = new Tarjetas();
	$p = new Proveedores();

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

					$iE++;
				}
				
			}
		}
	}

	$v = new ListadoTarjetas();
	$v->tarjetasPrincipales = $listaPrincipales;
	$v->tarjetasExtensiones = $listaExtensiones;
	$v->usuario = $_SESSION['nombre'];

	//render sería como decirle "dibujate"
	$v->render();	


?>