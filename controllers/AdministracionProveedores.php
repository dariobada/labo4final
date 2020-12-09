<?php

// controllers/AdministracionTipoCuenta.php
	
	
	require '../fw/fw.php';
	require '../models/Usuarios.php';
	require '../models/Roles.php';
	require '../models/Tarjetas.php';
	require '../models/Proveedores.php';
	require '../models/ValidacionException.php';
	require '../views/FormAdministracionCuentas.php';

	session_start();

	if(!isset($_SESSION['logueado'])){
		header("Location: inicio-sesion");
		exit;
	}


	$t = new Tarjetas();
	$tarjetasUsuario = $t->getTarjetasPorUsuario($_POST['usuario']);

	//------ se obtienen los tipos de cuenta --------
	$p = new Proveedores();
	$listaProveedores = $p->getTodosLosProveedores();

	$proveedoresDisponibles = [];
	foreach($listaProveedores as $proveedor){
		
		$objCliente = new stdclass();
		$flag = false;
		foreach($tarjetasUsuario as $tarjeta){
			
			
			$auxTarjeta = $t->getDetalleTarjeta($tarjeta['id_tarjeta']);
			
			/*echo 'codigo tarjeta: ';
			echo $auxTarjeta['cod_proveedor'];
			echo 'codigo proveedor: ';
			echo $proveedor['cod_proveedor'];
			echo 'estado: ';
			echo $auxTarjeta['cod_estado'];*/
			if(($auxTarjeta['cod_proveedor'] == $proveedor['cod_proveedor']) && ($auxTarjeta['cod_estado'] == 'A')){
			
				$flag = true;
			

			}
		}

		if(!$flag){
			
			//$tiposDisponibles = $tipo;
			$objCliente->idProveedor=$proveedor['cod_proveedor'];
			$objCliente->descProveedor=$proveedor['nombre_proveedor'];
			array_push($proveedoresDisponibles,$objCliente);
		}
	}

	/*$objCliente = new stdclass();
	$objCliente->nombre='dario';
	array_push($tiposDisponibles,$objCliente);
	*/
	$jsonDatosUsuario = json_encode($proveedoresDisponibles);

	echo $jsonDatosUsuario;

	//echo $listaTipoCuentas ;
	//$salidaJson = json_encode($tiposDisponibles);

	//echo $salidaJson;


?>