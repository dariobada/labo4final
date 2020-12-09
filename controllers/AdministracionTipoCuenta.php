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

	$tiposDisponibles = [];
	foreach($listaTipoCuentas as $tipo){
		echo 'entra1';
		$objCliente = new stdclass();
		$flag = false;
		foreach($cuentasUsuario as $cuenta){
			echo 'entra2';
			if(($cuenta['id_tipo_cuenta'] == $tipo['id_tipo_cuenta']) || ($cuenta['cod_estado'] == 'A')){
				echo 'entra3';
				$flag = true;


			}
		}

		if(!$flag){
			echo 'entra4';
			//$tiposDisponibles = $tipo;
			$objCliente->idTipoCuenta=$tipo['id_tipo_cuenta'];
			$objCliente->descTipoCuenta=$tipo['desc_tipo_cuenta'];
			array_push($tiposDisponibles,$objCliente);
		}
	}

	/*$objCliente = new stdclass();
	$objCliente->nombre='dario';
	array_push($tiposDisponibles,$objCliente);
	*/
	$jsonDatosUsuario = json_encode($tiposDisponibles);

	echo $jsonDatosUsuario;

	//echo $listaTipoCuentas ;
	//$salidaJson = json_encode($tiposDisponibles);

	//echo $salidaJson;


?>