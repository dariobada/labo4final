<?php

// controllers/PantallaTarjetas.php
	
	require '../fw/fw.php';
	//require '../models/Cuentas.php';
	//require '../models/Monedas.php';
	require '../models/Tarjetas.php';
	//require '../views/ListadoCuentas.php';
	//require '../views/ListadoTarjetas.php';

	session_start();

	$t = new Tarjetas();

	$tarjetasUsuario = array();

	$listaPrincipales = array();
	$listaExtensiones = array();
	$auxDT = array();
	$auxEXT = array();
	$iP = 0;
	var_dump("pepe");
	
	/*
	//se obtienen todas las tarjetas (principales y extensiones) de ese usuario
	$tarjetasUsuario = $t->getTarjetasPorUsuario(($_SESSION['IdUsuario']);

	//obtengo los datos necesarios para armar la lista de tarjetas principales
	foreach($tarjetasUsuario as $tu){
		//si el estado de la relacion tarjeta-usuario es activo, busco el detalle
		if($tu['cod_estado'] == 'A'){
			//obtengo el detalle de esa tarjeta
			$auxDT = $t->getDetalleTarjeta($tu['id_tarjeta']);
			//valido que el estado sea activo
			if($auxDT[0]['cod_estado'] == 'A'){

				//si es una tarjeta principal, informo al array el detalle de la tarjeta.
				//si es una tarjeta extensión, debo obtener los datos adicionales de dicha extensión, para luego informar al array correspondiente.
				if($auxDT[0]['tipo_tarjeta'] == 'P'){

					$listaPrincipales[$iP]['nro_tarjeta'] = $auxDT[0]['nro_tarjeta'];
					$listaPrincipales[$iP]['cod_proveedor'] = $auxDT[0]['cod_proveedor'];

					$iP++;
				} else{
					$listaExtensiones[$iE]['nro_tarjeta'] = $auxDT[0]['nro_tarjeta'];
					$auxEXT = $t->getDetalleExtension($tu['id_tarjeta']);
					$listaExtensiones[$iE]['nombre_ext'] = $auxEXT[0]['nombre_ext'];
					$listaExtensiones[$iE]['apellido_ext'] = $auxEXT[0]['apellido_ext'];

					$iE++;
				}
				
			}
		}
	}

	var_dump("principales: ");
	var_dump($listaPrincipales);

	var_dump("extensiones: ");
	var_dump($listaExtensiones);
	/*

	$v = new ListadoCuentas();
	$v->cuentas = $arrayCuentas;

	//render sería como decirle "dibujate"
	$v->render();	
*/

?>