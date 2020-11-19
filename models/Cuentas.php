<?php

// models/Cuentas.php

	class Cuentas extends Model {



		public function getCuentasPorUsuario($idUsua){

			$estado = "'" . "A" . "'";
			$sentencia = 'SELECT * FROM public."CUENTAS_USUARIOS" WHERE "id_usuario" = ' . $idUsua . ' and "cod_estado" = ' . $estado;

			$this->db->query($sentencia);
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

			$estado = "'" . 'A' . "'";
			$sentencia = 'SELECT *, (saldo::float8::numeric::money) as saldo_moneda FROM public."CUENTAS" WHERE "cod_estado" = ' . $estado;

			$this->db->query($sentencia);
			return $this->db->fetchAll();

		}

		public function realizarBajaCuenta($idCuen){

			$estado = "'" . "B" . "'";
			$sentencia = 'UPDATE public."CUENTAS" set "cod_estado" = ' . $estado . ' WHERE "id_cuenta" = ' . $idCuen; 

			$this->db->query($sentencia);

		}

		public function realizarBajaRelacionClienteCuenta($idCuen){

			$estado = "'" . "B" . "'";
			$sentencia = 'UPDATE public."CUENTAS_USUARIOS" set "cod_estado" = ' . $estado . ' WHERE "id_cuenta" = ' . $idCuen; 

			$this->db->query($sentencia);

		}


		public function validarCuentasActivasPorCuenta($idCuen){

			$estado = "'" . "A" . "'";
			$sentencia = 'select * from public."CUENTAS_USUARIOS" 
						where "id_usuario" in (select "id_usuario" from public."CUENTAS_USUARIOS"
					    							where "id_cuenta" = ' . $idCuen . ')   
  						and "cod_estado" = ' . $estado;

			$this->db->query($sentencia);

			if($this->db->numRows() > 0){
				
				return TRUE;
			} else{
				
				return FALSE;
			}


		}





	}



?>