<?php

// controllers/PantallaTransferencias.php
	
	require '../fw/fw.php';
	require '../models/Cuentas.php';
	require '../models/Monedas.php';
	require '../models/TipoCuentas.php';
	require '../views/FormTransferencias.php';
	require '../views/FormTransferenciasRespuesta.php';

	session_start();

	if(count($_POST)>0){

		//obtenemos el saldo de la cuenta
		
		$c = new Cuentas();
		$respGetDetalle = $c->getDetalleDeCuenta($_POST['cuenta']);

		if($_POST['monto'] > $respGetDetalle[0]['saldo']){
			//no posee saldo suficiente para realizar la transferencia
			
			$mensaje = 'No posee saldo suficiente para realizar esta transferencia.';
			
		} else{
			var_dump("posee saldo");
		}

	}

	$c = new Cuentas();
	$m = new Monedas();
	$tc = new TipoCuentas();
	
	/////////!!!!!!!!!!!! HAY QUE VALIDAR QUE VENGA EL USUARIO !!!!!!!!!!////////////////////
	$cuentasUsua = $c->getCuentasPorUsuario($_SESSION['IdUsuario']);

	//en este array guardamos las cuentas y sus detalles
	$respGetDetalle = array();
	$arrayCuentas = array();

	$i = 0;

	foreach($cuentasUsua as $cu){
				
		$respGetDetalle = $c->getDetalleDeCuenta($cu['id_cuenta']);

		$arrayCuentas[$i]['id_cuenta'] = $cu['id_cuenta'];
		$arrayCuentas[$i]['nro_cuenta'] = $respGetDetalle[0]['nro_cuenta'];
		$arrayCuentas[$i]['tipo_cuenta'] = $tc->getTipoCuenta($respGetDetalle[0]['id_tipo_cuenta']);
		$arrayCuentas[$i]['saldo'] = $respGetDetalle[0]['saldo'];
		$arrayCuentas[$i]['moneda'] = $m->getDescripcionMoneda($respGetDetalle[0]['cod_moneda']);
	

		$i++;

	}


	if($mensaje){
		//significa que hay un mensaje para mostrar
		$v = new FormTransferenciasRespuesta();
		$v->cuentas = $arrayCuentas;
		$v->mensaje = $mensaje;

		//render sería como decirle "dibujate"
		$v->render();	
	} else{
		$v = new FormTransferencias();
		$v->cuentas = $arrayCuentas;

		//render sería como decirle "dibujate"
		$v->render();	
	}
	

	
		


?>