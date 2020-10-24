<?php

// controllers/listaEmpleados.php

	require '../fw/fw.php';
	require '../models/Empleados.php';
	require '../views/listadoEmpleados.php';

	$e = new Empleados();
	$todos = $e->getTodos();

	$v = new listadoEmpleados();
	$v->empleados = $todos;
    //render sería como decirle "dibujate"
	$v->render();


?>