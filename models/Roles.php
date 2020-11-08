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

	


	}



?>