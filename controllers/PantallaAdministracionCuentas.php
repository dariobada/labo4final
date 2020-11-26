<?php

// controllers/PantallaAdministracionCuentas.php
	
	require '../fw/fw.php';
	require '../models/Usuarios.php';
	require '../models/Roles.php';
	require '../models/Cuentas.php';
	require '../models/TipoCuentas.php';
	require '../models/ValidacionException.php';
	require '../views/FormAdministracionCuentas.php';

	session_start();

	if(!isset($_SESSION['logueado'])){
		header("Location: PantallaLogin.php");
		exit;
	}

	//esto singifica que eligió Eliminar
	if(count($_POST) == 1){
		if(!isset($_POST['cuenta'])) die("Error 1");
		
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
		

	}

	//esto singifica que eligió Modificación
	if(count($_POST) == 2){
		if(!isset($_POST['cuenta'])) die("Error 2");
		if(!isset($_POST['saldo'])) die("Error 3");
		$c = new Cuentas();
		$c->actualizarSaldo($_POST['cuenta'], $_POST['saldo']);
		
		$mensaje = "Modificación realizada correctamente";
	}

	//esto singifica que eligió Alta
	if(count($_POST) == 3){

		if(!isset($_POST['usuario'])) die("Error 4");
		if(!isset($_POST['tipo_cuenta'])) die("Error 5");
		if(!isset($_POST['saldo'])) die("Error 6");

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


	//------ se obtienen los tipos de cuenta --------
	$tc = new TipoCuentas();
	$listaTipoCuentas = $tc->getTodosLosTiposCuenta();

	//------ se obtienen las cuentas --------
	$c = new Cuentas();
	$listaCuentas = $c->getTodasLasCuentas();


	$v = new FormAdministracionCuentas();
	$v->usuarios = $listaUsuarios;
	$v->tipoCuentas = $listaTipoCuentas;
	$v->cuentas = $listaCuentas;
	$v->mensaje = $mensaje;

	//render sería como decirle "dibujate"
	$v->render();	


?>