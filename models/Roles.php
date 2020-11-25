<?php

// models/Roles.php

	class Roles extends Model {


		// este metodo devuelve un TRUE si el usuario tiene rol de administrador
		public function devolverMarcaAdministrador($idUsua){

			if(!ctype_digit($idUsua)) throw new ValidacionException("Error roles 1");
			if($idUsua < 1) throw new ValidacionException("Error roles 2");

			$sentencia = 'SELECT * FROM public."ROLES_USUARIOS" 
						   WHERE "id_rol" = 3 and "id_usuario" = ';

			$this->db->query($sentencia . $idUsua);

			if($this->db->numRows() == 1){
				
				return TRUE;
			} else{
				
				return FALSE;
			}


		}

		public function validarRolCuentas($idUsua){

			if(!ctype_digit($idUsua)) throw new ValidacionException("Error roles 3");
			if($idUsua < 1) throw new ValidacionException("Error roles 4");

			$estado = "'" . 'A' . "'";
			$sentencia = 'SELECT * FROM public."ROLES_USUARIOS" 
						   WHERE "id_rol" = 1 and "id_usuario" = ' . $idUsua . ' and "cod_estado" = ' . $estado;

			$this->db->query($sentencia);

			if($this->db->numRows() == 1){
				
				return TRUE;
			} else{
				
				return FALSE;
			}
		}

		public function validarRolTarjetas($idUsua){

			if(!ctype_digit($idUsua)) throw new ValidacionException("Error roles 5");
			if($idUsua < 1) throw new ValidacionException("Error roles 6");

			$estado = "'" . 'A' . "'";
			$sentencia = 'SELECT * FROM public."ROLES_USUARIOS" 
						   WHERE "id_rol" = 2 and "id_usuario" = ' . $idUsua . ' and "cod_estado" = ' . $estado;

			$this->db->query($sentencia);

			if($this->db->numRows() == 1){
				
				return TRUE;
			} else{
				
				return FALSE;
			}
		}

		public function eliminarRolCuentas($idCuen){

			if(!ctype_digit($idCuen)) throw new ValidacionException("Error roles 7");
			if($idCuen < 1) throw new ValidacionException("Error roles 8");

			$estado = "'" . "B" . "'";
			$sentencia = 'UPDATE public."ROLES_USUARIOS" 
							 SET "cod_estado" = ' . $estado . ' WHERE "id_usuario" in (select "id_usuario" from public."CUENTAS_USUARIOS"
					    							                                    where "id_cuenta" = ' . $idCuen . ')   
  							and "id_rol" = 1';

			$this->db->query($sentencia);

			

		}

		public function eliminarRolTarjetas($idTarj){

			if(!ctype_digit($idTarj)) throw new ValidacionException("Error roles 9");
			if($idTarj < 1) throw new ValidacionException("Error roles 10");

			$estado = "'" . "B" . "'";
			$sentencia = 'UPDATE public."ROLES_USUARIOS" 
							 SET "cod_estado" = ' . $estado . ' WHERE "id_usuario" in (select "id_usuario" from public."TARJETAS_USUARIOS"
					    							                                    where "id_tarjeta" = ' . $idTarj . ')   
  							and "id_rol" = 2';

			$this->db->query($sentencia);			

		}

		public function eliminarRolAdministrador($idUsua){

			if(!ctype_digit($idUsua)) throw new ValidacionException("Error roles 11");
			if($idUsua < 1) throw new ValidacionException("Error roles 12");

			$estado = "'" . "B" . "'";
			$sentencia = 'UPDATE public."ROLES_USUARIOS" 
							 SET "cod_estado" = ' . $estado . ' WHERE "id_usuario" = ' . $idUsua . ' and "id_rol" = 3';

			$this->db->query($sentencia);			

		}

		public function crearRolCuentas($idUsua){

			if(!ctype_digit($idUsua)) throw new ValidacionException("Error roles 13");
			if($idUsua < 1) throw new ValidacionException("Error roles 14");

			//primero se verifica si el usuario no posee un estado dado de baja
			$estado = "'" . 'B' . "'";
			$sentencia = 'SELECT * FROM public."ROLES_USUARIOS" 
						   WHERE "id_rol" = 1 and "id_usuario" = ' . $idUsua . ' and "cod_estado" = ' . $estado;

			$this->db->query($sentencia);

			if($this->db->numRows() == 1){
				//si ingresa significa que tiene el rol dado de baja, por lo tanto se actualiza el estado
				$estado = "'" . 'A' . "'";
				$sentencia = 'UPDATE public."ROLES_USUARIOS" SET "cod_estado" = ' . $estado . ' WHERE "id_rol" = 1 and "id_usuario" = ' . $idUsua;

				$this->db->query($sentencia);				
				
			} else{
				//si ingresa significa que no posee rol, por lo tanto se inserta uno
				
				$estado = "'" . 'A' . "'";
				$sentencia = 'INSERT into public."ROLES_USUARIOS" values(1, ' . $idUsua . ', ' . $estado . ')';

				$this->db->query($sentencia);
			}



		}

		public function crearRolTarjetas($idUsua){

			if(!ctype_digit($idUsua)) throw new ValidacionException("Error roles 15");
			if($idUsua < 1) throw new ValidacionException("Error roles 16");

			//primero se verifica si el usuario no posee un estado dado de baja
			$estado = "'" . 'B' . "'";
			$sentencia = 'SELECT * FROM public."ROLES_USUARIOS" 
						   WHERE "id_rol" = 2 and "id_usuario" = ' . $idUsua . ' and "cod_estado" = ' . $estado;

			$this->db->query($sentencia);

			if($this->db->numRows() == 1){
				//si ingresa significa que tiene el rol dado de baja, por lo tanto se actualiza el estado
				$estado = "'" . 'A' . "'";
				$sentencia = 'UPDATE public."ROLES_USUARIOS" SET "cod_estado" = ' . $estado . ' WHERE "id_rol" = 2 and "id_usuario" = ' . $idUsua;

				$this->db->query($sentencia);				
				
			} else{
				//si ingresa significa que no posee rol, por lo tanto se inserta uno
				
				$estado = "'" . 'A' . "'";
				$sentencia = 'INSERT into public."ROLES_USUARIOS" values(2, ' . $idUsua . ', ' . $estado . ')';

				$this->db->query($sentencia);
			}



		}

		public function crearRolAdministrador($idUsua){

			if(!ctype_digit($idUsua)) throw new ValidacionException("Error roles 17");
			if($idUsua < 1) throw new ValidacionException("Error roles 18");			
				
			$estado = "'" . 'A' . "'";
			$sentencia = 'INSERT into public."ROLES_USUARIOS" values(3, ' . $idUsua . ', ' . $estado . ')';

			$this->db->query($sentencia);

		}

	


	}



?>