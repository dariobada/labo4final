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
			$sentencia = 'SELECT max("nro_tarjeta") from public."TARJETAS"';
			$this->db->query($sentencia);

			$maximo = $this->db->fetch();

			//obtengo los datos que faltan para dar de alta la nueva tarjeta
			$datosFaltantes = $this->getDetalleTarjeta($idTarj);

			//realizo el insert de la nueva tarjeta
			$nroTarjeta = "'" . ($maximo["max"] + "1") . "'";
			$tipoTarjeta = "'" . "E" . "'";
			$codProveedor =  "'" . $datosFaltantes['cod_proveedor'] . "'" ;
			$codEstado = "'" . "A" . "'";
			$sentencia = 'INSERT INTO public."TARJETAS"( nro_tarjeta, tipo_tarjeta, cod_proveedor, fecha_alta, cod_estado)
	                           VALUES (' . $nroTarjeta . ', ' . $tipoTarjeta . ', ' . $codProveedor . ', CURRENT_DATE, ' . $codEstado . ')';

	        $this->db->query($sentencia);
			
			//var_dump($datosFaltantes);
			//var_dump($maximo["max"] + "1");
			//var_dump($maximo["max"] + 1);
			
		}



	}



?>