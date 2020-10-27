<?php

// models/Proveedores.php

	class Proveedores extends Model {


		public function getNombreProveedor($idProv){

			$sentencia = 'SELECT * FROM public."PROVEEDORES_TARJETA" WHERE "cod_proveedor" = ';
			$cons = "'" . $idProv . "'";


			$this->db->query($sentencia . $cons);
			$nombre = $this->db->fetch();
			var_dump($nombre);

			return $nombre['nombre_proveedor'];

		}

	



	}



?>