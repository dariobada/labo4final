<?php

// controllers/PantallaAdministracionTarjetas.php
	
	require '../fw/fw.php';
	require '../models/Usuarios.php';
	require '../models/Roles.php';
	require '../models/Tarjetas.php';
	require '../models/Proveedores.php';
	require '../views/FormAdministracionTarjetas.php';

	session_start();

	if(!isset($_SESSION['logueado'])){
		header("Location: PantallaLogin.php");
		exit;
	}

	//esto singifica que eligió Eliminar
	if(count($_POST) == 1){
		
		//se da de baja la tarjeta
		$t = new Tarjetas();
		$t->realizarBajaTarjeta($_POST['tarjeta']);
		
		//se valida si el cliente conserva alguna tarjeta activa, de lo contrario se debe quitar la relación persona-rol
		if(!$t->validarTarjetasActivasPorTarjeta($_POST['tarjeta'])){
			//si ingresa acá significa que tenemos que quitar el rol de la persona
			$r = new Roles();
			$r->eliminarRolTarjetas($_POST['tarjeta']);

		}
		
		$mensaje = "Baja realizada correctamente";		

	}


	//esto singifica que eligió Alta
	if(count($_POST) == 2){
		$t = new Tarjetas();
		//se debe verificar que el usuario no posea ya una tarjeta para ese proveedor
		$aux = $t->getTarjetasPorUsuario($_POST['usuario']);
		$flag = true;
		
		foreach($aux as $a){
			if($a['cod_estado'] == 'A'){
				$auxDT = $t->getDetalleTarjeta($a['id_tarjeta']);

				if($auxDT['cod_proveedor'] == $_POST['proveedor']){
					$flag = false;
				}
			}
			
		}

		if($flag){
			$t->realizarAltaTarjeta($_POST['usuario'], $_POST['proveedor']);
		
			//se debe verificar si es necesario generar un rol para el usuario

			$r = new Roles();
			if(!$r->validarRolTarjetas($_POST['usuario'])){
				$r->crearRolTarjetas($_POST['usuario']);
			}

			$mensaje = "Alta realizada correctamente";
		} else {
			$mensaje = "Error - El usuario ya posee una tarjeta para ese proveedor";
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


	//------ se obtienen los codigos de proveedor --------
	$p = new Proveedores();
	$listaProveedores = $p->getTodosLosProveedores();

	//------ se obtienen las tarjetas --------
	$t = new Tarjetas();
	
	$todastarjetas = $t->getTodasLasTarjetas();
	$listatarjetas = array();

	var_dump("todas: " . $todastarjetas);
	foreach($todasTarjetas as $tarjeta){
		if($tarjeta[0]['cod_estado'] == 'A'){
			var_dump("entra");
			$listatarjetas[] = $tarjeta;
		}
	}

	$v = new FormAdministracionTarjetas();
	$v->usuarios = $listaUsuarios;
	$v->proveedores = $listaProveedores;
	$v->tarjetas = $listaTarjetas;
	$v->mensaje = $mensaje;

	//render sería como decirle "dibujate"
	$v->render();	


?>