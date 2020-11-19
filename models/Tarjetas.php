<?php

// models/Tarjetas.php

	class Tarjetas extends Model {



		public function getTarjetasPorUsuario($idUsua){

			$estado = "'" . "A" . "'";
			$sentencia = 'SELECT * FROM public."TARJETAS_USUARIOS" WHERE "id_usuario" = ' . $idUsua . ' and "cod_estado" = ' . $estado;

			$this->db->query($sentencia);
			return $this->db->fetchAll();

		}

		public function getDetalleTarjeta($idTarj){

			$sentencia = 'SELECT * FROM public."TARJETAS" WHERE "id_tarjeta" = ';

			$this->db->query($sentencia . $idTarj);
			return $this->db->fetch();

		}

		public function getDetalleTarjetaPorNumero($nroTarj){

			$tarjeta = "'" . $nroTarj . "'";
			$sentencia = 'SELECT * FROM public."TARJETAS" WHERE "nro_tarjeta" = ';

			$this->db->query($sentencia . $tarjeta);
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

		public function realizarAltaExtension($idTarj, $nombre, $apellido, $nroDocumento, $idUsuario){
			//primero obtengo el mayor numero de tarjeta
			$sentencia = 'SELECT max("nro_tarjeta") from public."TARJETAS"';
			$this->db->query($sentencia);

			$maximo = $this->db->fetch();
			$nroTarjetaExtension = $maximo["max"] + "1";

			//obtengo los datos que faltan para dar de alta la nueva tarjeta
			$datosFaltantes = $this->getDetalleTarjeta($idTarj);

			//realizo el insert de la nueva tarjeta
			$nroTarjeta = "'" . $nroTarjetaExtension . "'";
			$tipoTarjeta = "'" . "E" . "'";
			$codProveedor =  "'" . $datosFaltantes['cod_proveedor'] . "'" ;
			$codEstado = "'" . "A" . "'";
			$sentencia = 'INSERT INTO public."TARJETAS"( nro_tarjeta, tipo_tarjeta, cod_proveedor, fecha_alta, cod_estado)
	                           VALUES (' . $nroTarjeta . ', ' . $tipoTarjeta . ', ' . $codProveedor . ', CURRENT_DATE, ' . $codEstado . ')';
	        $this->db->query($sentencia);

	        //se vincula la extensión a la tarjeta principal
	        $idExtension = $this->getDetalleTarjetaPorNumero($nroTarjetaExtension);

	        $nom = "'" . $nombre . "'";
	        $ape = "'" . $apellido . "'";
	        $sentencia = 'INSERT INTO public."EXTENSIONES_TARJETA" 
	        VALUES (' . $idTarj . ', ' . $idExtension['id_tarjeta'] . ', CURRENT_DATE, null, ' . $codEstado . ', ' . $nom . ', ' . $ape . ', ' . $nroDocumento . ')';
	        
	        $this->db->query($sentencia);

	        //se vincula la nueva tarjeta a la persona

	        $sentencia = 'INSERT INTO public."TARJETAS_USUARIOS" VALUES (' . $idExtension['id_tarjeta'] . ', ' . $idUsuario . ', CURRENT_DATE, null, ' . $codEstado . ')';
			$this->db->query($sentencia);

			//var_dump($datosFaltantes);
			//var_dump($maximo["max"] + "1");
			//var_dump($maximo["max"] + 1);
			
		}

		public function getTodasLasTarjetas(){

			$estado = "'" . 'A' . "'";
			$sentencia = 'SELECT * FROM public."TARJETAS" WHERE "cod_estado" = ' . $estado;

			$this->db->query($sentencia);

			return $this->db->fetchAll();
		}



	}



?>