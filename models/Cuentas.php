<?php

// models/Cuentas.php

	class Cuentas extends Model {



		public function getCuentasPorUsuario($idUsua){

			$sentencia = 'SELECT * FROM public."CUENTAS_USUARIOS" WHERE "id_usuario" = ';

			$this->db->query($sentencia . $idUsua);
			return $this->db->fetchAll();

		}

		public function getDetalleDeCuenta($idCuen){

			$sentencia = 'SELECT *, (saldo::float8::numeric::money) as saldo_moneda FROM public."CUENTAS" WHERE "id_cuenta" = ';

			$this->db->query($sentencia . $idCuen);
			return $this->db->fetchAll();

		}

		public function actualizarSaldo($idCuen, $saldo){

			$sentencia = 'UPDATE public."CUENTAS" SET "saldo" = ' . $saldo . ' WHERE "id_cuenta" = ' . $idCuen; 

			$this->db->query($sentencia);
		}

		public function getTodasLasCuentas(){

			$sentencia = 'SELECT * FROM public."CUENTAS" ';

			$this->db->query($sentencia);
			return $this->db->fetchAll();

		}






	}



?>