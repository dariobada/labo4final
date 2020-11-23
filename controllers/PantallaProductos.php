<?php

// controllers/PantallaProductos.php
	
	require '../fw/fw.php';
	require '../models/Usuarios.php';
	require '../models/Proveedores.php';
	require '../models/Tarjetas.php';
	require '../models/Roles.php';
	require '../models/Cuentas.php';
	require '../models/TipoCuentas.php';
	require '../views/FormProductos.php';

	session_start();

	if(!isset($_SESSION['logueado'])){
		header("Location: PantallaLogin.php");
		exit;
	}

	if(count($_POST) > 0){


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

	//esto singifica que eligió Eliminar
	/*if(count($_POST) == 1){
		
		//se da de baja la cuenta
		$c = new Cuentas();
		$c->realizarBajaCuenta($_POST['cuenta']);
		
		//se da de baja la relación cliente-cuenta
		$c->realizarBajaRelacionClienteCuenta($_POST['cuenta']);
		
		//se valida si el cliente conserva alguna cuenta activa, de lo contrario se debe quitar la relación persona-rol
		if(!$c->validarCuentasActivasPorCuenta($_POST['cuenta'])){
						//si ingresa acá significa que tenemos que quitar el rol de la persona
			$r = new Roles();
			$r->eliminarRolCuentas($_POST['cuenta']);

		}
		
		$mensaje = "Baja realizada correctamente";
		

	}*/

	//esto singifica que eligió Modificación
	/*if(count($_POST) == 2){
		$c = new Cuentas();
		$c->actualizarSaldo($_POST['cuenta'], $_POST['saldo']);
		
		$mensaje = "Modificación realizada correctamente";
	}*/

	//esto singifica que eligió Alta
	/*if(count($_POST) == 3){
		$c = new Cuentas();

		//se valida que el usuario no posea ya ese tipo de cuenta
		$aux = $c->getCuentasPorUsuario($_POST['usuario']);
		$flag = false;
	
		foreach($aux as $a){
			
			if($a['cod_estado'] == 'A'){
				$respGetDetalle = $c->getDetalleDeCuenta($a['id_cuenta']);
		
				if($respGetDetalle[0]['id_tipo_cuenta'] == $_POST['tipo_cuenta']){
					//si entra al IF significa que el usuario ya posee ese tipo de cuenta dado de alta
					$flag = true;
				}

			}
			
		}
	

		if($flag){
			$mensaje = "Error - el usuario ya posee una cuenta dada de alta con el tipo de cuenta seleccionado";
		} else {
			$c->realizarAltaCuenta($_POST['usuario'], $_POST['tipo_cuenta'], $_POST['saldo']);
		
			//se debe verificar si es necesario generar un rol para el usuario

			$r = new Roles();
			if(!$r->validarRolCuentas($_POST['usuario'])){
				$r->crearRolCuentas($_POST['usuario']);
			}

			$mensaje = "Alta realizada correctamente";
		}

		
	}*/

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


	//------ se obtienen los tipos de cuenta --------
	/*$tc = new TipoCuentas();
	$listaTipoCuentas = $tc->getTodosLosTiposCuenta();

	//------ se obtienen las cuentas --------
	$c = new Cuentas();
	$listaCuentas = $c->getTodasLasCuentas();*/


	$v = new FormProductos();
	$v->usuarios = $listaUsuarios;
	//$v->tipoCuentas = $listaTipoCuentas;
	$v->cuentas = $arrayCuentas;
	$v->tarjetas = $listaTarjetas;
	$v->usuarioElegido = $usuarioElegido;
	/*
	$v->mensaje = $mensaje;*/

	//render sería como decirle "dibujate"
	$v->render();	


?>