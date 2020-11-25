<?php

// models/Usuarios.php

	class Usuarios extends Model {



		public function getUsuario($usua){

			if(strlen($usua)<1) throw new ValidacionException("Error usuarios 1");
			if(strlen($usua)>20) throw new ValidacionException("Error usuarios 2");
			$usua = $this->db->escape($usua);

			$cons = "'" . $usua . "'";
			$sentencia = 'SELECT * FROM public."USUARIOS" WHERE "id_login_usuario" = ';

			$this->db->query($sentencia . $cons);
			
			return $this->db->fetch();

		}

		public function getTodosLosUsuariosActivos(){

			$estado = "'" . 'A' . "'";
			$sentencia = 'SELECT * FROM public."USUARIOS" where "cod_estado" = ' . $estado;

			$this->db->query($sentencia);
			return $this->db->fetchAll();
		}

		public function getTodosLosUsuarios(){

			$sentencia = 'SELECT * FROM public."USUARIOS" ';

			$this->db->query($sentencia);
			return $this->db->fetchAll();
		}

		public function bajaDeUsuario($idUsua){

			if(!ctype_digit($idUsua)) throw new ValidacionException("Error usuarios 3");
			if($idUsua < 1) throw new ValidacionException("Error usuarios 4");

			$estado = "'" . 'B' . "'";
			$sentencia = 'UPDATE public."USUARIOS" set "cod_estado" = ' . $estado . ' WHERE "id_usuario" = ' . $idUsua;

			$this->db->query($sentencia);
			

		}

		public function validarExistenciaUsuario($idLoginUsua, $idUsua){

			if(!is_numeric($idUsua)) throw new ValidacionException("Error usuarios 5");
			if($idUsua < 0) throw new ValidacionException("Error usuarios 6");

			if(strlen($idLoginUsua)<1) throw new ValidacionException("Error usuarios 7");
			if(strlen($idLoginUsua)>20) throw new ValidacionException("Error usuarios 8");
			$idLoginUsua = $this->db->escape($idLoginUsua);

			$usua = "'" . $idLoginUsua . "'";

			$sentencia = 'SELECT * FROM public."USUARIOS" where "id_login_usuario" = ' . $usua . ' and "id_usuario" <> ' . $idUsua;

			$this->db->query($sentencia);
			
			if($this->db->numRows() == 1){
				
				return TRUE;
			} else{
				
				return FALSE;
			}


		}

		public function modificarUsuario($idUsua, $nombre, $apellido, $idLoginUsua){

			if(!is_numeric($idUsua)) throw new ValidacionException("Error usuarios 9");
			if($idUsua < 1) throw new ValidacionException("Error usuarios 10");

			if(strlen($idLoginUsua)<1) throw new ValidacionException("Error usuarios 11");
			if(strlen($idLoginUsua)>20) throw new ValidacionException("Error usuarios 12");
			$idLoginUsua = $this->db->escape($idLoginUsua);

			if(strlen($nombre)<1) throw new ValidacionException("Error usuarios 13");
			if(strlen($nombre)>50) throw new ValidacionException("Error usuarios 14");
			$nombre = $this->db->escape($nombre);

			if(strlen($apellido)<1) throw new ValidacionException("Error usuarios 15");
			if(strlen($apellido)>50) throw new ValidacionException("Error usuarios 16");
			$apellido = $this->db->escape($apellido);

			$usua = "'" . $idLoginUsua . "'";
			$nom = "'" . $nombre . "'";
			$ape = "'" . $apellido . "'";


			$sentencia = 'UPDATE public."USUARIOS" set "nombre" = ' . $nom . ', "apellido" = ' . $ape . ', "id_login_usuario" = ' . $usua . ' WHERE "id_usuario" = ' . $idUsua;
			$this->db->query($sentencia);

		}

		public function crearUsuario($nombre, $apellido, $idLoginUsua, $pass){

			if(strlen($nombre)<1) throw new ValidacionException("Error usuarios 17");
			if(strlen($nombre)>50) throw new ValidacionException("Error usuarios 18");
			$nombre = $this->db->escape($nombre);

			if(strlen($apellido)<1) throw new ValidacionException("Error usuarios 19");
			if(strlen($apellido)>50) throw new ValidacionException("Error usuarios 20");
			$apellido = $this->db->escape($apellido);

			if(strlen($idLoginUsua)<1) throw new ValidacionException("Error usuarios 21");
			if(strlen($idLoginUsua)>20) throw new ValidacionException("Error usuarios 22");
			$idLoginUsua = $this->db->escape($idLoginUsua);

			if(strlen($pass)<1) throw new ValidacionException("Error usuarios 23");
			if(strlen($pass)>40) throw new ValidacionException("Error usuarios 24");
			$pass = $this->db->escape($pass);

			$usua = "'" . $idLoginUsua . "'";
			$nom = "'" . $nombre . "'";
			$ape = "'" . $apellido . "'";
			$contras = "'" . $pass . "'";
			$estado = "'" . 'A' . "'";

			$sentencia = 'INSERT INTO public."USUARIOS"(
							pass, fecha_alta, fecha_modificacion, cod_estado, id_login_usuario, nombre, apellido)
							VALUES (' . $contras . ', CURRENT_DATE, null, ' . $estado . ', ' . $usua . ', ' . $nom . ', ' . $ape . ')';

			$this->db->query($sentencia);


		}



	}

	class ValidacionException extends Exception{}



?>