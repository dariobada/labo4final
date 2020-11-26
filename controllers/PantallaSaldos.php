<?php

// controllers/PantallaSaldos.php
	
	require '../fw/fw.php';
	require '../models/Cuentas.php';
	require '../models/TipoCuentas.php';
	require '../models/ValidacionException.php';
	require '../views/ListadoCuentas.php';

	session_start();

	if(!isset($_SESSION['logueado'])){
		header("Location: inicio-sesion");
		exit;
	}

	$c = new Cuentas();
	$tc = new TipoCuentas();
	
	$cuentasUsua = $c->getCuentasPorUsuario($_SESSION['IdUsuario']);

	//en este array guardamos las cuentas y sus detalles
	$respGetDetalle = array();
	$arrayCuentas = array();

	$i = 0;

	foreach($cuentasUsua as $cu){

		if($cu['cod_estado'] == 'A'){

			$respGetDetalle = $c->getDetalleDeCuenta($cu['id_cuenta']);
		
			$arrayCuentas[$i]['nro_cuenta'] = $respGetDetalle[0]['nro_cuenta'];
			$arrayCuentas[$i]['tipo_cuenta'] = $tc->getTipoCuenta($respGetDetalle[0]['id_tipo_cuenta']);
			$arrayCuentas[$i]['saldo'] = $respGetDetalle[0]['saldo_moneda'];
		

			$i++;
		}					

	}
	
	$v = new ListadoCuentas();
	
	$v->cuentas = $arrayCuentas;
	$v->usuario = $_SESSION['nombre'];
	//le paso a la vista los indicadores para que habiliten o no los botones de las funcionalidades según el rol
	$v->operaCuentas = $_SESSION['tieneCuentas'];
	$v->operaTarjetas = $_SESSION['tieneTarjetas'];
	//render sería como decirle "dibujate"
	
	$v->render();	
	


?>