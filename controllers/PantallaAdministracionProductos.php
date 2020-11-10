<?php

// controllers/PantallaAdministracionProductos.php
	
	require '../fw/fw.php';
	require '../models/Usuarios.php';
	require '../models/Roles.php';
	require '../models/Monedas.php';
	require '../models/Cuentas.php';
	require '../models/TipoCuentas.php';
	require '../views/FormAdministracionProductos.php';

	session_start();

	if(!isset($_SESSION['logueado'])){
		header("Location: PantallaLogin.php");
		exit;
	}

	//------ se obtienen los usuarios --------
	$u = new Usuarios();
	$r = new Roles();
	$listaUsuarios = array();
	$aux = $u->getTodosLosUsuarios();
	// se recorren todos los usuarios para quedarse con los no administradores
	foreach($aux as $us){
		// obtengo los roles para validar que no sea administrador
		//$roles = $r->getRolesPorUsuario($us);


		if(!$r->devolverMarcaAdministrador($us['id_usuario'])){
			$listaUsuarios[] = $us;
		}
	}

	//------ se obtienen las monedas --------
	$m = new Monedas();
	$listaMonedas = $m->getTodasLasMonedas();

	//------ se obtienen los tipos de cuenta --------
	$tc = new TipoCuentas();
	$listaTipoCuentas = $tc->getTodosLosTiposCuenta();

	//------ se obtienen las cuentas --------
	$c = new Cuentas();
	$listaCuentas = $c->getTodasLasCuentas();


	$v = new FormAdministracionProductos();
	$v->usuarios = $listaUsuarios;
	$v->monedas = $listaMonedas;
	$v->tipoCuentas = $listaTipoCuentas;
	$v->cuentas = $listaCuentas;

	//render sería como decirle "dibujate"
	$v->render();	


?>