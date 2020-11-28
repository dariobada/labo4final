<?php

// models/Cuentas.php

	class Cuentas extends Model {



		public function getCuentasPorUsuario($idUsua){

			if(!ctype_digit($idUsua)) throw new ValidacionException("Error cuentas 1");
			if($idUsua < 1) throw new ValidacionException("Error cuentas 2");
			
			$sentencia = 'SELECT * FROM public."CUENTAS_USUARIOS" WHERE "id_usuario" = ' . $idUsua;

			$this->db->query($sentencia);
			return $this->db->fetchAll();

		}

		public function getDetalleDeCuenta($idCuen){

			if(!ctype_digit($idCuen)) throw new ValidacionException("Error cuentas 3");
			if($idCuen < 1) throw new ValidacionException("Error cuentas 4");

			$sentencia = 'SELECT *, (saldo::float8::numeric::money) as saldo_moneda FROM public."CUENTAS" WHERE "id_cuenta" = ';

			$this->db->query($sentencia . $idCuen);
			return $this->db->fetchAll();

		}

		public function getDetalleDeCuentaPorCuenta($nroCuen){

			if(!ctype_digit($nroCuen)) throw new ValidacionException("Error cuentas 5");
			if(strlen($nroCuen)<1) throw new ValidacionException("Error cuentas 6");
			if(strlen($nroCuen)>22) throw new ValidacionException("Error cuentas 7");

			$cuenta = "'" . $nroCuen . "'";
			$sentencia = 'SELECT * FROM public."CUENTAS" WHERE "nro_cuenta" = ' . $cuenta;

			$this->db->query($sentencia);
			return $this->db->fetch();

		}

		public function actualizarSaldo($idCuen, $saldo){

			if(!ctype_digit($idCuen)) throw new ValidacionException("Error cuentas 8");
			if($idCuen < 1) throw new ValidacionException("Error cuentas 9");

			if(!is_numeric($saldo)) throw new ValidacionException("Error cuentas 10");
			if($saldo < 0) throw new ValidacionException("Error cuentas 11");

			$sentencia = 'UPDATE public."CUENTAS" SET "saldo" = ' . $saldo . ' WHERE "id_cuenta" = ' . $idCuen; 

			$this->db->query($sentencia);
		}

		public function getTodasLasCuentasActivas(){

			$estado = "'" . 'A' . "'";
			$sentencia = 'SELECT *, (saldo::float8::numeric::money) as saldo_moneda FROM public."CUENTAS" WHERE "cod_estado" = ' . $estado . ' order by "nro_cuenta"';

			$this->db->query($sentencia);
			return $this->db->fetchAll();

		}

		public function getTodasLasCuentas(){

			$sentencia = 'SELECT *, (saldo::float8::numeric::money) as saldo_moneda FROM public."CUENTAS" order by "nro_cuenta"';

			$this->db->query($sentencia);
			return $this->db->fetchAll();

		}

		public function realizarBajaCuenta($idCuen){

			if(!ctype_digit($idCuen)) throw new ValidacionException("Error cuentas 12");
			if($idCuen < 1) throw new ValidacionException("Error cuentas 13");

			$estado = "'" . "B" . "'";
			$sentencia = 'UPDATE public."CUENTAS" set "cod_estado" = ' . $estado . ' WHERE "id_cuenta" = ' . $idCuen; 

			$this->db->query($sentencia);

		}

		public function realizarBajaRelacionClienteCuenta($idCuen){

			if(!ctype_digit($idCuen)) throw new ValidacionException("Error cuentas 14");
			if($idCuen < 1) throw new ValidacionException("Error cuentas 15");

			$estado = "'" . "B" . "'";
			$sentencia = 'UPDATE public."CUENTAS_USUARIOS" set "cod_estado" = ' . $estado . ' WHERE "id_cuenta" = ' . $idCuen; 

			$this->db->query($sentencia);

		}


		public function validarCuentasActivasPorCuenta($idCuen){

			if(!ctype_digit($idCuen)) throw new ValidacionException("Error cuentas 16");
			if($idCuen < 1) throw new ValidacionException("Error cuentas 17");

			$estado = "'" . "A" . "'";
			$sentencia = 'SELECT * from public."CUENTAS_USUARIOS" 
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

			if(!ctype_digit($idUsua)) throw new ValidacionException("Error cuentas 18");
			if($idUsua < 1) throw new ValidacionException("Error cuentas 19");

			if(!is_numeric($saldo)) throw new ValidacionException("Error cuentas 20");
			if($saldo < 0) throw new ValidacionException("Error cuentas 21");

			if(strlen($tipoCuenta)<1) throw new ValidacionException("Error cuentas 22");
			if(strlen($tipoCuenta)>3) throw new ValidacionException("Error cuentas 23");
			$tipoCuenta = $this->db->escape($tipoCuenta);

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