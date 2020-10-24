<?php

// controllers/listaEmpleados.php

	require '../fw/fw.php';
	require '../models/Empleados.php';
	require '../models/Cargos.php';
	require '../models/Adelantos.php';
	require '../views/formularioAdelantos.php';

	$a = new Adelantos();

	$fecha = $_POST['año'] . '-' . $_POST['mes'] . '-' . $_POST['dia'];

	$a->crearAdelanto($fecha, $_POST['empleado'], $_POST['monto']);
	header("Location: formularioAltaAdelantos.php");
	exit();

?>