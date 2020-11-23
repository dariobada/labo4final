<?php

// models/Cuentas.php

	class Cuentas extends Model {



		public function getCuentasPorUsuario($idUsua){

			
			$sentencia = 'SELECT * FROM public."CUENTAS_USUARIOS" WHERE "id_usuario" = ' . $idUsua;

			$this->db->query($sentencia);
			return $this->db->fetchAll();

		}

		public function getDetalleDeCuenta($idCuen){

			$sentencia = 'SELECT *, (saldo::float8::numeric::money) as saldo_moneda FROM public."CUENTAS" WHERE "id_cuenta" = ';

			$this->db->query($sentencia . $idCuen);
			return $this->db->fetchAll();

		}

		public function getDetalleDeCuentaPorCuenta($nroCuen){

			$cuenta = "'" . $nroCuen . "'";
			$sentencia = 'SELECT * FROM public."CUENTAS" WHERE "nro_cuenta" = ' . $cuenta;

			$this->db->query($sentencia);
			return $this->db->fetch();

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

		public function realizarAltaCuenta($idUsua, $tipoCuenta, $saldo){

			//primero obtengo el mayor numero de cuenta
			$sentencia = 'SELECT ("nro_cuenta") from public."CUENTAS" order by 1 desc limit 1';
			$this->db->query($sentencia);

			//armo el insert de la nueva cuenta
			$maximo = $this->db->fetch();
			$nroCuenta = "'" . ($maximo["nro_cuenta"] + 1) . "'";
			$idTipoCuenta = "'" . $tipoCuenta . "'";
			$estado = "'" . 'A' . "'";


			$sentencia = 'INSERT into public."CUENTAS" ( nro_cuenta, id_tipo_cuenta, fecha_alta, fecha_modificacion, cod_estado, saldo)
			               VALUES (' . $nroCuenta . ', ' . $idTipoCuenta . ', CURRENT_DATE, null, ' . $estado . ', ' . $saldo  . ')';

			$this->db->query($sentencia);

			//se vincula la nueva cuenta a la persona

			$nuevaCuenta = $this->getDetalleDeCuentaPorCuenta($maximo["nro_cuenta"] + 1);

			$sentencia = 'INSERT INTO public."CUENTAS_USUARIOS" VALUES('. $nuevaCuenta['id_cuenta'] . ', ' . $idUsua . ', CURRENT_DATE, null, ' . $estado . ')';

			$this->db->query($sentencia);			


		}





	}



?>