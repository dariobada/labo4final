<?php

// models/TipoCuentas.php

	class TipoCuentas extends Model {



		public function getTipoCuenta($idTipoCuenta){

			$cons = "'" . $idTipoCuenta . "'";
			$sentencia = 'SELECT * FROM public."TIPO_CUENTAS" WHERE "id_tipo_cuenta" = ';

			var_dump($idTipoCuenta);
			$this->db->query($sentencia . $cons);
			$ret = $this->db->fetch();
			var_dump($ret);
			return $ret['desc_tipo_cuenta'];

		}



	}



?>