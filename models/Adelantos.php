<?php

// models/Adelantos.php

	class Adelantos extends Model {



		//public function getTodos(){
		//	$this->db->query("SELECT * FROM empleados");
		//	return $this->db->fetchAll();
		//}

		public function crearAdelanto($fecha, $empleado_id, $monto){
			$this->db->query("INSERT INTO adelantos (fecha, empleado_id, monto)
				              VALUES ('" . $fecha . "', $empleado_id, $monto)");
		}



	}



?>