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
	/*if(count($_POST) == 1){
		
		//antes de dar la baja es necesario verificar si
		$t = new Tarjetas();
		$t->realizarBajaTarjeta($_POST['tarjeta']);
		
		//se valida si el cliente conserva alguna tarjeta activa, de lo contrario se debe quitar la relación persona-rol
		if(!$t->validarTarjetasActivasPorTarjeta($_POST['tarjeta'])){
			//si ingresa acá significa que tenemos que quitar el rol de la persona
			$r = new Roles();
			$r->eliminarRolTarjetas($_POST['tarjeta']);

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
	/*if(count($_POST) == 2){
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
	if(COUNT($_POST) > 0){
		var_dump("cantidad: " . count($_POST));
	} else 
	{
	$v->render();	
}

?>