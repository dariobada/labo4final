<?php

// models/Cuentas.php

	class Cuentas extends Model {



		public function getCuentasPorUsuario($idUsua){

			$sentencia = 'SELECT * FROM public."CUENTAS_USUARIOS" WHERE "id_usuario" = ';

			$this->db->query($sentencia . $idUsua);
			return $this->db->fetchAll();

		}

		public function getDetalleDeCuenta($idCuen){

			$sentencia = 'SELECT * FROM public."CUENTAS" WHERE "id_cuenta" = ';

			$this->db->query($sentencia . $idCuen);
			return $this->db->fetchAll();

		}



	}



?>