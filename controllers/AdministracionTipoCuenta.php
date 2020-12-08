<?php

// controllers/AdministracionTipoCuenta.php
	
	
	require '../fw/fw.php';
	require '../models/Usuarios.php';
	require '../models/Roles.php';
	require '../models/Cuentas.php';
	require '../models/TipoCuentas.php';
	require '../models/ValidacionException.php';
	require '../views/FormAdministracionCuentas.php';

	session_start();

	if(!isset($_SESSION['logueado'])){
		header("Location: inicio-sesion");
		exit;
	}


	$c = new Cuentas();
	$cuentasUsuario = $c->getCuentasPorUsuario($_POST['usuario']);

	//------ se obtienen los tipos de cuenta --------
	$tc = new TipoCuentas();
	$listaTipoCuentas = $tc->getTodosLosTiposCuenta();

	$tiposDisponibles = array();
	/*foreach($listaTipoCuentas as $tipo){
		$flag = false;
		foreach($cuentasUsuario as $cuenta){
			if(($cuenta['id_tipo_cuenta'] == $tipo['id_tipo_cuenta']) || ($cuenta['cod_estado'] == 'A')){
				$flag = true;
			}
		}

		if($flag == false){
			$tiposDisponibles[] = $tipo;
		}
	}*/
	$tiposDisponibles[0]['nombre'] = 'dario';

	echo $tiposDisponibles;
	$salidaJson = json_encode($tiposDisponibles);

	//echo $salidaJson;


?>