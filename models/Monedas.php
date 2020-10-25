<?php

// models/Monedas.php

	class Monedas extends Model {



		public function getDescripcionMoneda($idMone){

			$sentencia = 'SELECT * FROM public."MONEDAS" WHERE "cod_moneda" = ';

			$this->db->query($sentencia . $idMone);
			$ret = $this->db->fetch();

			return $ret['descripcion'];

		}
		

	}



?>