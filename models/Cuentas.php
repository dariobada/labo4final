<?php

// models/Cuentas.php

	class Cuentas extends Model {



		public function getCuentasPorUsuario($idUsua){

			$sentencia = 'SELECT * FROM public."CUENTAS_USUARIOS" WHERE "id_usuario" = ';

			$this->db->query($sentencia . $idUsua);
			return $this->db->fetchAll();

		}



	}



?>