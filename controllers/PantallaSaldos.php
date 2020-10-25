<?php

// controllers/PantallaSaldos.php
	
	require '../fw/fw.php';
	require '../models/Cuentas.php';
	//require '../views/ListadoCuentas.php';



	var_dump("hola1");
	session_start();
	var_dump("hola2");

	$c = new Cuentas();
	var_dump("hola3");
	var_dump($_SESSION['IdUsuario']);
	
	/////////!!!!!!!!!!!! HAY QUE VALIDAR QUE VENGA EL USUARIO !!!!!!!!!!////////////////////
	$cuentasUsua = $c->getCuentasPorUsuario($_SESSION['IdUsuario']);
	var_dump("hola4");
	var_dump($cuentasUsua);

	//en este array guardamos las cuentas y sus detalles
	$aux = array();
	var_dump("hola5");
	$i = 0;

	//foreach($cuentasUsua as $cu){
		//$aux[i] = $c->getDetalleDeCuenta($cuentasUsua['id_usuario'][i]);
		//var_dump($cuentasUsua[i]['id_usuario']);

	//	i++;

	//}

	


?>