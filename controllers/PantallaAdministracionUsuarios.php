<?php

// controllers/PantallaAdministracionTarjetas.php
	
	require '../fw/fw.php';
	require '../models/Usuarios.php';
	require '../models/Roles.php';
	require '../models/Tarjetas.php';
	require '../models/Proveedores.php';
	require '../views/FormAdministracionUsuarios.php';

	session_start();

	if(!isset($_SESSION['logueado'])){
		header("Location: PantallaLogin.php");
		exit;
	}



	//esto singifica que eligió Eliminar
	if(count($_POST) == 1){
		
		$r = new Roles();
		$u = new Usuarios();

		//antes de dar la baja es necesario verificar si el usuario es cliente o administrador
		if($r->devolverMarcaAdministrador($_POST['usuario'])){
			//si es administrador, se procede a realizar la baja
			$u->bajaDeUsuario($_POST['usuario']);
			//se realiza la baja del rol de administrador para ese usuario
			$r->eliminarRolAdministrador($_POST['usuario']);

		} else {
			//si no es administrador, se debe verificar que no posea productos activos
			if($r->validarRolCuentas($_POST['usuario']) or $r->validarRolTarjetas($_POST['usuario'])){
				//si ingresa significa que posee productos activos, por lo tanto no se permite la baja
				$mensaje = 'Error - No se puede realizar la baja ya que el usuario posee productos activos.';
			} else{
				//el usuario no posee productos activos, por lo tanto se procede a realizar la baja
				$u->bajaDeUsuario($_POST['usuario']);
				$mensaje = 'Baja realizada correctamente.';
			}

		}

	}

	//esto singifica que eligió Modificación
	if(count($_POST) == 4){
		//se valida que no exista el nuevo nombre de usuario para loguear
		$u = new Usuarios();
		if($u->validarExistenciaUsuario($_POST['nombreUsuario'], $_POST['usuario'])){
			$mensaje = 'Error - Ya existe un cliente con el Nombre de Usuario ingresado.';

		} else {
			$u->modificarUsuario($_POST['usuario'], $_POST['nombre'], $_POST['apellido'], $_POST['nombreUsuario']);
			$mensaje = "Modificación realizada correctamente";
		}
		

		
	}

	//esto singifica que eligió Alta
	if(count($_POST) == 5){
		

		//se valida que no exista el nombre de usuario para loguear
		$u = new Usuarios();
		if($u->validarExistenciaUsuario($_POST['nombreUsuario'], 0)){
			$mensaje = 'Error - Ya existe un cliente con el Nombre de Usuario ingresado.';

		} else {
			//se crea el usuario
			$u->crearUsuario($_POST['nombre'], $_POST['apellido'], $_POST['nombreUsuario'], sha1($_POST['pass']));
			exit();
			//si el usuario generado es administrador, se genera el rol para el usuario
			if($_POST['opcion'] == 'Si'){

				//se tiene que obtener el id de usuario generado en la creación
				$aux = $u->getUsuario($_POST['nombreUsuario']);
				
				$r = new Roles();
				$r->crearRolAdministrador($aux['id_usuario']);
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


	//------ se obtienen los codigos de proveedor --------
	$p = new Proveedores();
	$listaProveedores = $p->getTodosLosProveedores();

	//------ se obtienen las tarjetas --------
	$t = new Tarjetas();
	$listaTarjetas = $t->getTodasLasTarjetas();


	$v = new FormAdministracionUsuarios();
	$v->usuarios = $listaUsuarios;
	$v->proveedores = $listaProveedores;
	$v->tarjetas = $listaTarjetas;
	$v->mensaje = $mensaje;

	//render sería como decirle "dibujate"
	
	$v->render();	


?>