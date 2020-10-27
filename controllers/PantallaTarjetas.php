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
	$iE = 0;

	
	
	//se obtienen todas las tarjetas (principales y extensiones) de ese usuario
	$tarjetasUsuario = $t->getTarjetasPorUsuario($_SESSION['IdUsuario']);
	//var_dump($tarjetasUsuario);
	
	//obtengo los datos necesarios para armar la lista de tarjetas principales
	foreach($tarjetasUsuario as $tu){
		//si el estado de la relacion tarjeta-usuario es activo, busco el detalle
		if($tu['cod_estado'] == 'A'){
			//obtengo el detalle de esa tarjeta
			$auxDT = $t->getDetalleTarjeta($tu['id_tarjeta']);
			var_dump($auxDT);
			var_dump($auxDT['cod_estado']);
			//valido que el estado sea activo
			if($auxDT['cod_estado'] == 'A'){
				var_dump("entra1");

				//si es una tarjeta principal, informo al array el detalle de la tarjeta.
				//si es una tarjeta extensión, debo obtener los datos adicionales de dicha extensión, para luego informar al array correspondiente.
				if($auxDT['tipo_tarjeta'] == 'P'){
					var_dump("entra2");
					$listaPrincipales[$iP]['nro_tarjeta'] = $auxDT['nro_tarjeta'];
					$listaPrincipales[$iP]['cod_proveedor'] = $auxDT['cod_proveedor'];

					$iP++;
				} else{
					var_dump("entra3");
					$listaExtensiones[$iE]['nro_tarjeta'] = $auxDT['nro_tarjeta'];
					$auxEXT = $t->getDetalleExtension($tu['id_tarjeta']);
					$listaExtensiones[$iE]['nombre_ext'] = $auxEXT['nombre_ext'];
					$listaExtensiones[$iE]['apellido_ext'] = $auxEXT['apellido_ext'];

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