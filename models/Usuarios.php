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

			$estado = "'" . 'A' . "'";
			$sentencia = 'SELECT * FROM public."USUARIOS" where "cod_estado" = ' . $estado;

			$this->db->query($sentencia);
			return $this->db->fetchAll();
		}

		public function bajaDeUsuario($idUsua){

			$estado = "'" . 'B' . "'";
			$sentencia = 'UPDATE public."USUARIOS" set "cod_estado" = ' . $estado ' WHERE "id_usuario" = ' . $idUsua;

			$this->db->query($sentencia);
			

		}



	}



?>