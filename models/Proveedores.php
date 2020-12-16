<?php

// models/Proveedores.php

	class Proveedores extends Model {


		public function getNombreProveedor($idProv){

			if(strlen($idProv)<1) throw new ValidacionException("Error proveedores 1");
			if(strlen($idProv)>3) throw new ValidacionException("Error proveedores 2");
			$idProv = $this->db->escape($idProv);

			$sentencia = 'SELECT * FROM public."PROVEEDORES_TARJETA" WHERE "cod_proveedor" = ';
			$cons = "'" . $idProv . "'";


			$this->db->query($sentencia . $cons);
			$nombre = $this->db->fetch();
		

			return $nombre['nombre_proveedor'];

		}

		public function getTodosLosProveedores(){
			$sentencia = 'SELECT * from public."PROVEEDORES_TARJETA"';

			$this->db->query($sentencia);
			return $this->db->fetchAll();
		}

	



	}



?>