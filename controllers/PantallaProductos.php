<?php

// controllers/PantallaProductos.php
	
	require '../fw/fw.php';
	require '../models/Usuarios.php';
	require '../models/Proveedores.php';
	require '../models/Tarjetas.php';
	require '../models/Roles.php';
	require '../models/Cuentas.php';
	require '../models/TipoCuentas.php';
	require '../models/ValidacionException.php';
	require '../views/FormProductos.php';

	session_start();

	if(!isset($_SESSION['logueado'])){
		header("Location: inicio-sesion");
		exit;
	}

	if(count($_POST) > 0){

		if(!isset($_POST['usuario'])) die("Error 1");

		$usuarioElegido = $_POST['usuario'];

		//buscamos las cuentas del usuario ingresado
		$c = new Cuentas();
		$tc = new TipoCuentas();

		
		/////////!!!!!!!!!!!! HAY QUE VALIDAR QUE VENGA EL USUARIO !!!!!!!!!!////////////////////
		$cuentasUsua = $c->getCuentasPorUsuario($_POST['usuario']);

		//en este array guardamos las cuentas y sus detalles
		$respGetDetalle = array();
		$arrayCuentas = array();

		$i = 0;

		foreach($cuentasUsua as $cu){
		
			$respGetDetalle = $c->getDetalleDeCuenta($cu['id_cuenta']);
		
			$arrayCuentas[$i]['nro_cuenta'] = $respGetDetalle[0]['nro_cuenta'];
			$arrayCuentas[$i]['tipo_cuenta'] = $tc->getTipoCuenta($respGetDetalle[0]['id_tipo_cuenta']);
			$arrayCuentas[$i]['saldo'] = $respGetDetalle[0]['saldo_moneda'];
			if($cu['cod_estado'] == 'A'){
				$arrayCuentas[$i]['estado'] = 'Activa';
			} else {
				$arrayCuentas[$i]['estado'] = 'Inactiva';
			}		

			$i++;					

		}

		//buscamos las tarjetas del usuario ingresado

		$t = new Tarjetas();
		$p = new Proveedores();
		$u = new Usuarios();

		$tarjetasUsuario = array();

		$listaPrincipales = array();
		$listaExtensiones = array();
		$listaTarjetas = array();
		$auxDT = array();
		$auxEXT = array();
		$iP = 0;
		$iE = 0;
		
		//se obtienen todas las tarjetas (principales y extensiones) de ese usuario
		$tarjetasUsuario = $t->getTarjetasPorUsuario($_POST['usuario']);
			
		//obtengo los datos necesarios para armar la lista de tarjetas principales
		foreach($tarjetasUsuario as $tu){
			
			//obtengo el detalle de esa tarjeta
			$auxDT = $t->getDetalleTarjeta($tu['id_tarjeta']);			
			
			//obtengo el nombre del proveedor de tarjeta				
			$nombreProv = $p->getNombreProveedor($auxDT['cod_proveedor']);		

			//si es una tarjeta principal, informo al array el detalle de la tarjeta.
			//si es una tarjeta extensión, debo obtener los datos adicionales de dicha extensión, para luego informar al array correspondiente.
			
			$listaTarjetas[$iP]['id_tarjeta'] = $auxDT['id_tarjeta'];
			$listaTarjetas[$iP]['nro_tarjeta'] = $auxDT['nro_tarjeta'];
			$listaTarjetas[$iP]['nombre_proveedor'] = $nombreProv;

			if($auxDT['cod_estado'] == 'A'){
				$listaTarjetas[$iP]['estado'] = 'Activo';
			} else {
				$listaTarjetas[$iP]['estado'] = 'Inactivo';
			}
			


			if($auxDT['tipo_tarjeta'] == 'P'){
				
				$listaTarjetas[$iP]['tipo_tarjeta'] = 'Principal';

			} else{
		
				$listaTarjetas[$iP]['tipo_tarjeta'] = 'Extensión';
			}			
			
			$iP++;
			
		}

	}

	

	//------ se obtienen los usuarios --------
	$u = new Usuarios();
	$r = new Roles();
	$listaUsuarios = array();
	$aux = $u->getTodosLosUsuarios();
	// se recorren todos los usuarios para quedarse con los no administradores
	foreach($aux as $us){
		// obtengo la marca que indica si el usuario es administrador
	
		if(!$r->devolverMarcaAdministrador($us['id_usuario'])){
			$listaUsuarios[] = $us;
		}
	}


	$v = new FormProductos();
	$v->usuarios = $listaUsuarios;
	$v->cuentas = $arrayCuentas;
	$v->tarjetas = $listaTarjetas;
	$v->usuarioElegido = $usuarioElegido;
	
	$v->render();	


?>