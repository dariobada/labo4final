<?php

// controllers/PantallaAdministracionProductos.php
	
	require '../fw/fw.php';
	require '../models/Usuarios.php';
	require '../models/Roles.php';
	require '../models/Cuentas.php';
	require '../models/TipoCuentas.php';
	require '../views/FormAdministracionProductos.php';

	session_start();

	if(!isset($_SESSION['logueado'])){
		header("Location: PantallaLogin.php");
		exit;
	}

	//esto singifica que eligió Eliminar
	if(count($_POST) == 1){
		var_dump("entra1");

		//se da de baja la cuenta
		$c = new Cuentas();
		$c->realizarBajaCuenta($_POST['cuenta']);
		var_dump("entra2");

		//se da de baja la relación cliente-cuenta
		$c->realizarBajaRelacionClienteCuenta($_POST['cuenta']);
		var_dump("entra3");

		//se valida si el cliente conserva alguna cuenta activa, de lo contrario se debe quitar la relación persona-rol
		if(!$c->validarCuentasActivasPorCuenta($_POST['cuenta'])){
			var_dump("entra4");
			//si ingresa acá significa que tenemos que quitar el rol de la persona
			$r = new Roles();
			$r->eliminarRolCuentas($_POST['cuenta']);

		}
		
		$mensaje = "Baja realizada correctamente";
		var_dump("entra5");
		exit();
		

	}

	//esto singifica que eligió Modificación
	if(count($_POST) == 2){
		

	}

	//esto singifica que eligió Alta
	if(count($_POST) == 3){
		

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


	$v = new FormAdministracionProductos();
	$v->usuarios = $listaUsuarios;
	$v->tipoCuentas = $listaTipoCuentas;
	$v->cuentas = $listaCuentas;
	$v->mensaje = $mensaje;

	//render sería como decirle "dibujate"
	$v->render();	


?>