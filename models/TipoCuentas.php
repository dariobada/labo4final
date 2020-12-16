<?php

// models/TipoCuentas.php

	class TipoCuentas extends Model {



		public function getTipoCuenta($idTipoCuenta){

			if(!isset($idTipoCuenta)) throw new ValidacionException("Error tipoCuentas 1");
			if(strlen($idTipoCuenta)<1) throw new ValidacionException("Error tipoCuentas 2");
			if(strlen($idTipoCuenta)>3) throw new ValidacionException("Error tipoCuentas 3");
			$idTipoCuenta = $this->db->escape($idTipoCuenta);

			$cons = "'" . $idTipoCuenta . "'";
			$sentencia = 'SELECT * FROM public."TIPO_CUENTAS" WHERE "id_tipo_cuenta" = ';

			$this->db->query($sentencia . $cons);
			$ret = $this->db->fetch();

			return $ret['desc_tipo_cuenta'];

		}

		public function getTodosLosTiposCuenta(){

			$sentencia = 'SELECT * FROM public."TIPO_CUENTAS"  ';

			$this->db->query($sentencia);
			return $this->db->fetchAll();

		}



	}



?>