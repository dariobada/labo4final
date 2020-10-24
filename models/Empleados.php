<?php

// models/Empleados.php

	class Empleados extends Model {



		public function getTodos(){
			$this->db->query("SELECT * FROM empleados");
			return $this->db->fetchAll();

		}



	}



?>