<!-- html/formularioAdelantos.php-->

<!DOCTYPE html>
<html>
<head>
	<title>Alta adelanto</title>
</head>
<body>
	<h1>Alta adelanto</h1>

	<form action="../controllers/altaAdelantos.php" method="post">

		<label for="empleado">Quien: </label>
		<select name="empleado" id="empleado">

			<?php
				foreach($this->empleycargos as $aux){
			?>
			<option value="<?= $aux['empleado_id'] ?>"> 
				<?= $aux['nombre'] . ' (' . $aux['descripcion'] . ')'?>
			</option>	
			<?php
			}
			?>				

		</select>

		<br/><br/>

		<label for="monto">Monto: $</label>
		<input type="text" name="monto" id="monto"></input>

		<br/><br/>

		<label for="fechaHoy">Fecha: </label>
		<input type="checkbox" id="fechaHoy" name="fechaHoy" value="hoy">Hoy</input>
		<label for="dia">    dd: </label>
		<input type="text" name="dia" id="dia" style="width:15px"></input>
		<label for="mes">mm: </label>
		<input type="text" name="mes" id="mes" style="width:15px"></input>
		<label for="año">yyyy: </label>
		<input type="text" name="año" id="año" style="width:35px"></input>

		<br/><br/>

		<input type="submit" value="Crear"></input>
	</form>




</html>