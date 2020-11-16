<?php

// models/Tarjetas.php

	class Tarjetas extends Model {



		public function getTarjetasPorUsuario($idUsua){

			$sentencia = 'SELECT * FROM public."TARJETAS_USUARIOS" WHERE "id_usuario" = ';

			$this->db->query($sentencia . $idUsua);
			return $this->db->fetchAll();

		}

		public function getDetalleTarjeta($idTarj){

			$sentencia = 'SELECT * FROM public."TARJETAS" WHERE "id_tarjeta" = ';

			$this->db->query($sentencia . $idTarj);
			return $this->db->fetch();

		}

		public function getDetalleExtension($idTarj){

			$sentencia = 'SELECT * FROM public."EXTENSIONES_TARJETA" WHERE "id_tarjeta_extension" = ';

			$this->db->query($sentencia . $idTarj);
			return $this->db->fetch();

		}

		public function validarExtension($idTarj, $nroDocumento){

			$estado = "'" . 'A' . "'";
			$sentencia = 'SELECT * FROM public."EXTENSIONES_TARJETA" WHERE "id_tarjeta_principal" = ' . $idTarj . ' and "documento_ext" = ' . $nroDocumento . ' and cod_estado = ';

			$this->db->query($sentencia . $estado);

			if($this->db->numRows() == 1){
				
				return FALSE;
			} else{
				
				return TRUE;
			}
		}

		public function realizarAltaExtension($idTarj, $nombre, $apellido, $nroDocumento){
			//primero obtengo el mayor numero de tarjeta
			$sentencia = 'SELECT max("nro_tarjeta") as ultimatarjeta from public."TARJETAS"';
			$this->db->query($sentencia);

			$maximo = $this->db->fetch();
			var_dump($maximo);
			var_dump("Ultima tarjeta: " . $maximo[0]);
			var_dump("Ultima tarjeta: " . $maximo[1]);
		}



	}



?>