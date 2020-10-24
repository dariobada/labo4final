<!-- html/listadoCargos.php-->

<!DOCTYPE html>
<html>
<head>
	<title>Listado de cargos</title>
</head>
<body>
	<h1>Listado de cargos</h1>

	<table>
		<tr><th>Id</th><th>Nombre</th></tr>

		<?php foreach($this->cargos as $c) {?>
		<tr> <td><?= $c['cargo_id']?></td> <td><?= $c['descripcion']?></td> </tr>
		<?php }?>
</body>
</html>