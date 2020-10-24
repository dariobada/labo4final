<?php

// models/Usuarios.php

	class Usuarios extends Model {



		public function getUsuario($usua){

			$cons = "'" . $usua . "'";
			$sentencia = 'SELECT * FROM public."USUARIOS" WHERE "nombre_usuario" = ';

			$this->db->query($sentencia . $const);
			return $this->db->fetch();

		}



	}



?>