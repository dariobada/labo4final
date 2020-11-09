<?php

// models/Roles.php

	class Roles extends Model {



		public function getRolesPorUsuario($idUsua){


			$sentencia = 'SELECT "id_usuario", "desc_rol" FROM public."ROLES_USUARIOS" a
						  join public."ROLES" b on a."id_rol" = b."id_rol"
						  WHERE "id_usuario" = ';

			//$sentencia = 'SELECT * FROM public."ROLES_USUARIOS" WHERE "id_usuario" = ';

			$this->db->query($sentencia . $idUsua);
			return $this->db->fetchAll();

		}

		// este metodo devuelve un TRUE si el usuario tiene rol de administrador
		public function devolverMarcaAdministrador($idUsua){

			$sentencia = 'SELECT * FROM public."ROLES_USUARIOS" 
						   WHERE "id_rol" = 3 and "id_usuario" = ';

			$this->db->query($sentencia . $idUsua);

			var_dump($sentencia . $idUsua);
			var_dump($this->db->numRows());
			if($this->db->numRows() == 1){
				var_dump("entra al true");
				return TRUE;
			} else{
				var_dump("entra al false");
				return FALSE;
			}


		}

	


	}



?>