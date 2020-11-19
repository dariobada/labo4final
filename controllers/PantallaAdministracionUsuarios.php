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
			$u->bajaDeUsuario($_POST['usuario']):
			//se realiza la baja del rol de administrador para ese usuario
			$r->eliminarRolAdministrador($_POST['usuario']);

		} else {
			//si no es administrador, se debe verificar que no posea productos activos
			if($r->validarRolCuentas($_POST['usuario']) or $r->validarRolTarjetas($_POST['usuario'])){
				//si ingresa significa que posee productos activos, por lo tanto no se permite la baja
				$mensaje = 'Error - No se puede realizar la baja ya que el usuario posee productos activos.'
			} else{
				//el usuario no posee productos activos, por lo tanto se procede a realizar la baja
				$u->bajaDeUsuario($_POST['usuario']);
			}

		}

	}

	//esto singifica que eligió Modificación
	if(count($_POST) == 4){
		$c = new Cuentas();
		$c->actualizarSaldo($_POST['cuenta'], $_POST['saldo']);
		
		$mensaje = "Modificación realizada correctamente";
	}

	//esto singifica que eligió Alta
	/*if(count($_POST) == 5){
		$t = new Tarjetas();
		$t->realizarAltaTarjeta($_POST['usuario'], $_POST['proveedor']);
		
		//se debe verificar si es necesario generar un rol para el usuario

		$r = new Roles();
		if(!$r->validarRolTarjetas($_POST['usuario'])){
			$r->crearRolTarjetas($_POST['usuario']);
		}

		$mensaje = "Alta realizada correctamente";
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
}

?>