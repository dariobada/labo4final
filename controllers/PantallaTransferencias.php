<?php

// controllers/PantallaTransferencias.php
	
	require '../fw/fw.php';
	require '../models/Cuentas.php';
	require '../models/TipoCuentas.php';
	require '../models/ValidacionException.php';
	require '../views/FormTransferencias.php';
	require '../views/FormTransferenciasRespuesta.php';

	session_start();

	if(!isset($_SESSION['logueado'])){
		header("Location: inicio-sesion");
		exit;
	}

	if(count($_POST)>0){

		if(!isset($_POST['cuenta'])) die("Error 1");
		if(!isset($_POST['monto'])) die("Error 2");

		//obtenemos el saldo de la cuenta
		
		$c = new Cuentas();
		$respGetDetalle = $c->getDetalleDeCuenta($_POST['cuenta']);

		if($_POST['monto'] > $respGetDetalle[0]['saldo']){
			//no posee saldo suficiente para realizar la transferencia
			
			$mensaje = 'No posee saldo suficiente para realizar esta transferencia.';	
			
		} else{
			$nuevoSaldo = $respGetDetalle[0]['saldo'] - $_POST['monto'];
			$c->actualizarSaldo($_POST['cuenta'], $nuevoSaldo);
			$mensaje = "La transferencia se ha realizado exitosamente.";
		}

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

			$arrayCuentas[$i]['id_cuenta'] = $cu['id_cuenta'];
			$arrayCuentas[$i]['nro_cuenta'] = $respGetDetalle[0]['nro_cuenta'];
			$arrayCuentas[$i]['tipo_cuenta'] = $tc->getTipoCuenta($respGetDetalle[0]['id_tipo_cuenta']);
			$arrayCuentas[$i]['saldo'] = $respGetDetalle[0]['saldo_moneda'];
		

			$i++;

		}		

	}


	if($mensaje){
		//significa que hay un mensaje para mostrar
		$v = new FormTransferenciasRespuesta();
		$v->cuentas = $arrayCuentas;
		$v->mensaje = $mensaje;
		$v->usuario = $_SESSION['nombre'];
		$v->operaCuentas = $_SESSION['tieneCuentas'];
		$v->operaTarjetas = $_SESSION['tieneTarjetas'];

		//render sería como decirle "dibujate"
		$v->render();	
	} else{
		$v = new FormTransferencias();
		$v->cuentas = $arrayCuentas;
		$v->usuario = $_SESSION['nombre'];
		$v->operaCuentas = $_SESSION['tieneCuentas'];
		$v->operaTarjetas = $_SESSION['tieneTarjetas'];

		//render sería como decirle "dibujate"
		$v->render();	
	}
	

	
		


?>