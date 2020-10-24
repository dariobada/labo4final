<?php

// controllers/listaCargos.php

	require '../fw/fw.php';
	require '../models/Cargos.php';
	require '../views/listadoCargos.php';

	$m = new Cargos();
	$cargos = $m->getTodos();

	$v = new listadoCargos();
	$v->cargos = $cargos;
    //render sería como decirle "dibujate"
	$v->render();


?>