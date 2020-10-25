<?php

// models/Monedas.php

	class Monedas extends Model {



		public function getDescripcionMoneda($idMone){

			$sentencia = 'SELECT * FROM public."MONEDAS" WHERE "cod_moneda" = ';
			$cons = "'" . $idMone . "'";

			$this->db->query($sentencia . $cons);
			$ret = $this->db->fetch();

			return $ret['descripcion'];

		}
		

	}

?>