<?php

// controllers/listaEmpleados.php

	require '../fw/fw.php';
	require '../models/Empleados.php';
	require '../models/Cargos.php';
	require '../views/formularioAdelantos.php';

	$e = new Empleados();
	$todosE = $e->getTodos();

	$c = new Cargos();
	$todosC = $c->getTodos();

	$v = new formularioAdelantos();
	
	//recorro los empleados y busco sus cargos
	$aux = array();
	$ind = 0;
	
	foreach($todosE as $emp){
		foreach($todosC as $car){
			if($emp['cargo_id'] == $car['cargo_id']){
				
				$aux[$ind]['empleado_id'] = $emp['empleado_id'];
				$aux[$ind]['nombre'] = $emp['nombre'];
				$aux[$ind]['descripcion'] = $car['descripcion'];
				$ind++;
			}
		}
	}


	$v->empleycargos = $aux;
    //render sería como decirle "dibujate"
	$v->render();


?>