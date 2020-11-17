<?php

// models/Roles.php

	class Roles extends Model {



		public function getRolesPorUsuario($idUsua){


			$sentencia = 'SELECT "id_usuario", "desc_rol" FROM public."ROLES_USUARIOS" a
						  join public."ROLES" b on a."id_rol" = b."id_rol"
						  WHERE "id_usuario" = ';

			var_dump("muestro uno: " . $this->db->fetch());
			var_dump("muestro todos: " . $this->db->fetchAll());

			$this->db->query($sentencia . $idUsua);
			return $this->db->fetchAll();

		}

		// este metodo devuelve un TRUE si el usuario tiene rol de administrador
		public function devolverMarcaAdministrador($idUsua){

			$sentencia = 'SELECT * FROM public."ROLES_USUARIOS" 
						   WHERE "id_rol" = 3 and "id_usuario" = ';

			$this->db->query($sentencia . $idUsua);

			if($this->db->numRows() == 1){
				
				return TRUE;
			} else{
				
				return FALSE;
			}


		}

	


	}



?>