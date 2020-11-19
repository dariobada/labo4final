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
			$sentencia = 'UPDATE public."USUARIOS" set "cod_estado" = ' . $estado . ' WHERE "id_usuario" = ' . $idUsua;

			$this->db->query($sentencia);
			

		}

		public function validarExistenciaUsuario($idLoginUsua){

			$usua = "'" . $idLoginUsua . "'";

			$sentencia = 'SELECT * FROM public."USUARIOS" where "id_login_usuario" = ' . $usua;

			$this->db->query($sentencia);
			
			if($this->db->numRows() == 1){
				
				return TRUE;
			} else{
				
				return FALSE;
			}


		}

		public function modificarUsuario($idUsua, $nombre, $apellido, $idLoginUsua){

			$usua = "'" . $idLoginUsua . "'";
			$nom = "'" . $nombre . "'";
			$ape = "'" . $apellido . "'";

			$sentencia = 'UPDATE public."USUARIOS" set "nombre" = ' . $nom . ', "apellido" = ' . $ape . ', "id_login_usuario" = ' . $usua . ' WHERE "id_usuario" = ' . $idUsua;
			$this->db->query($sentencia);

		}



	}



?>