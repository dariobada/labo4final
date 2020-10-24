<!-- html/listadoEmpleados.php-->

<!DOCTYPE html>
<html>
<head>
	<title>Listado de empleados</title>
</head>
<body>
	<h1>Listado de empleados</h1>

	<table>
		<tr><th>Id</th><th>Nombre</th></tr>

		<?php foreach($this->empleados as $e) {?>
		<tr> <td><?= $e['empleado_id']?></td> <td><?= $e['nombre']?></td> </tr>
		<?php }?>
</body>
</html>