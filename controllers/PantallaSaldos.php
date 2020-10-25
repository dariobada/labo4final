<?php

// controllers/PantallaSaldos.php
	
	require '../fw/fw.php';
	require '../models/Cuentas.php';
	require '../models/Monedas.php';
	require '../views/ListadoCuentas.php';

	session_start();

	$c = new Cuentas();
	$m = new Monedas();
	
	/////////!!!!!!!!!!!! HAY QUE VALIDAR QUE VENGA EL USUARIO !!!!!!!!!!////////////////////
	$cuentasUsua = $c->getCuentasPorUsuario($_SESSION['IdUsuario']);

	//en este array guardamos las cuentas y sus detalles
	$respGetDetalle = array();
	$arrayCuentas = array();

	$i = 0;

	foreach($cuentasUsua as $cu){
				
		$respGetDetalle = $c->getDetalleDeCuenta($cu['id_cuenta']);

		
		$arrayCuentas[i]['nro_cuenta'] = $respGetDetalle[0]['nro_cuenta'];
		$arrayCuentas[i]['tipo_cuenta'] = $respGetDetalle[0]['tipo_cuenta'];
		$arrayCuentas[i]['saldo'] = $respGetDetalle[0]['saldo'];
		$arrayCuentas[i]['moneda'] = $m->getDescripcionMoneda($respGetDetalle[0]['cod_moneda']);
		var_dump($m->getDescripcionMoneda($respGetDetalle[0]['cod_moneda']));

		$i++;

	}

	$v = new ListadoCuentas();
	$v->cuentas = $arrayCuentas;
	var_dump("----");
	var_dump($v->cuentas);
	//render sería como decirle "dibujate"
	//$v->render();	


?>