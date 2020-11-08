<?php

// models/Usuarios.php

	class Usuarios extends Model {



		public function getUsuario($usua){

			$cons = "'" . $usua . "'";
			$sentencia = 'SELECT * FROM public."USUARIOS" WHERE "id_login_usuario" = ';

			$this->db->query($sentencia . $cons);
			return $this->db->fetch();

		}

		public function getTodosLosUsuarios(){

			$sentencia = 'SELECT * FROM public."USUARIOS"';

			$this->db->query($sentencia);
			return $this->db->fetchAll();
		}



	}



?>