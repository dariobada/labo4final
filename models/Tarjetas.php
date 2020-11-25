<?php

// models/Tarjetas.php

	class Tarjetas extends Model {



		public function getTarjetasPorUsuario($idUsua){

			if(!ctype_digit($idUsua)) throw new ValidacionException("Error tarjetas 1");
			if($idUsua < 1) throw new ValidacionException("Error tarjetas 2");

			$sentencia = 'SELECT * FROM public."TARJETAS_USUARIOS" WHERE "id_usuario" = ' . $idUsua;

			$this->db->query($sentencia);
			return $this->db->fetchAll();

		}

		public function getDetalleTarjeta($idTarj){

			if(!ctype_digit($idTarj)) throw new ValidacionException("Error tarjetas 3");
			if($idTarj < 1) throw new ValidacionException("Error tarjetas 4");

			$sentencia = 'SELECT * FROM public."TARJETAS" WHERE "id_tarjeta" = ';

			$this->db->query($sentencia . $idTarj);
			return $this->db->fetch();

		}

		public function getDetalleTarjetaPorNumero($nroTarj){

			if(!ctype_digit($nroTarj)) throw new ValidacionException("Error tarjetas 5");
			if(strlen($nroTarj)<1) throw new ValidacionException("Error tarjetas 6");
			if(strlen($nroTarj)>16) throw new ValidacionException("Error tarjetas 7");

			$tarjeta = "'" . $nroTarj . "'";
			$sentencia = 'SELECT * FROM public."TARJETAS" WHERE "nro_tarjeta" = ';

			$this->db->query($sentencia . $tarjeta);
			return $this->db->fetch();

		}

		public function getDetalleExtension($idTarj){

			if(!ctype_digit($idTarj)) throw new ValidacionException("Error tarjetas 8");
			if($idTarj < 1) throw new ValidacionException("Error tarjetas 9");

			$sentencia = 'SELECT * FROM public."EXTENSIONES_TARJETA" WHERE "id_tarjeta_extension" = ';

			$this->db->query($sentencia . $idTarj);
			return $this->db->fetch();

		}

		public function validarExtension($idTarj, $nroDocumento){

			if(!ctype_digit($idTarj)) throw new ValidacionException("Error tarjetas 10");
			if($idTarj < 1) throw new ValidacionException("Error tarjetas 11");

			if(!ctype_digit($nroDocumento)) throw new ValidacionException("Error tarjetas 12");
			if($nroDocumento < 1) throw new ValidacionException("Error tarjetas 13");

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

			if(!ctype_digit($idTarj)) throw new ValidacionException("Error tarjetas 14");
			if($idTarj < 1) throw new ValidacionException("Error tarjetas 15");

			if(!ctype_digit($idUsuario)) throw new ValidacionException("Error tarjetas 16");
			if($idUsuario < 1) throw new ValidacionException("Error tarjetas 17");

			if(!ctype_digit($nroDocumento)) throw new ValidacionException("Error tarjetas 18");
			if($nroDocumento < 1) throw new ValidacionException("Error tarjetas 19");

			if(strlen($nombre)<1) throw new ValidacionException("Error tarjetas 20");
			if(strlen($nombre)>50) throw new ValidacionException("Error tarjetas 21");
			$nombre = $this->db->escape($nombre);

			if(strlen($apellido)<1) throw new ValidacionException("Error tarjetas 22");
			if(strlen($apellido)>50) throw new ValidacionException("Error tarjetas 23");
			$apellido = $this->db->escape($apellido);

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

		public function getTodasLasTarjetasActivas(){

			$estado = "'" . "A" . "'";
			$sentencia = 'SELECT * FROM public."TARJETAS" where "cod_estado" = ' . $estado;

			$this->db->query($sentencia);

			return $this->db->fetchAll();
		}

		public function realizarBajaTarjeta($idTarj){

			if(!ctype_digit($idTarj)) throw new ValidacionException("Error tarjetas 24");
			if($idTarj < 1) throw new ValidacionException("Error tarjetas 25");

			$estado = "'" . 'B' . "'";
			//se da de baja la tarjeta
			$sentencia = 'UPDATE public."TARJETAS" set "cod_estado" = ' . $estado . ' WHERE "id_tarjeta" = ' . $idTarj;

			$this->db->query($sentencia);

			//se deben dar de baja las extensiones de esa tarjeta
			$sentencia = 'UPDATE public."TARJETAS" set "cod_estado" = ' . $estado . ' WHERE "id_tarjeta" in ( SELECT "id_tarjeta_extension" from public."EXTENSIONES_TARJETA"
			                WHERE "id_tarjeta_principal" = ' . $idTarj . ')';

			$this->db->query($sentencia);

			//se dan de baja las relaciones entre las tarjetas y sus extensiones
			$sentencia = 'UPDATE public."EXTENSIONES_TARJETA" set "cod_estado" = ' . $estado . ' WHERE ("id_tarjeta_principal" = ' . $idTarj . ') OR ("id_tarjeta_extension" = ' . $idTarj . ')';

			$this->db->query($sentencia);

			//se da de baja la relación entre la persona y la tarjeta
			$sentencia = 'UPDATE public."TARJETAS_USUARIOS" set "cod_estado" = ' . $estado . ' WHERE "id_tarjeta" = ' . $idTarj;

			$this->db->query($sentencia);

			//se da de baja la relación entre la persona y las extensiones de la tarjeta dada de baja
			$sentencia = 'UPDATE public."TARJETAS_USUARIOS" set "cod_estado" = ' . $estado . ' WHERE "id_tarjeta" in ( SELECT "id_tarjeta_extension" FROM public."EXTENSIONES_TARJETA"
			               WHERE "id_tarjeta_principal" = ' . $idTarj . ')';

			$this->db->query($sentencia);

		}

		public function validarTarjetasActivasPorTarjeta($idTarj){

			if(!ctype_digit($idTarj)) throw new ValidacionException("Error tarjetas 26");
			if($idTarj < 1) throw new ValidacionException("Error tarjetas 27");

			$estado = "'" . "A" . "'";
			$sentencia = 'select * from public."TARJETAS_USUARIOS" 
						where "id_usuario" in (select "id_usuario" from public."TARJETAS_USUARIOS"
					    							where "id_tarjeta" = ' . $idTarj . ')   
  						and "cod_estado" = ' . $estado;

			$this->db->query($sentencia);

			if($this->db->numRows() > 0){
				
				return TRUE;
			} else{
				
				return FALSE;
			}


		}

		public function realizarAltaTarjeta($idUsua, $proveedor){

			if(!ctype_digit($idUsua)) throw new ValidacionException("Error tarjetas 28");
			if($idUsua < 1) throw new ValidacionException("Error tarjetas 29");

			if(strlen($proveedor)<1) throw new ValidacionException("Error tarjetas 30");
			if(strlen($proveedor)>3) throw new ValidacionException("Error tarjetas 31");

			//primero obtengo el mayor numero de tarjeta
			$sentencia = 'SELECT max("nro_tarjeta") from public."TARJETAS"';
			$this->db->query($sentencia);

			$maximo = $this->db->fetch();
			$nroTarjetaNueva = $maximo["max"] + "1";
			$tarjeta = "'" . $nroTarjetaNueva . "'";
			$codProveedor = "'" . $proveedor . "'";
			$estado = "'" . 'A' . "'";
			$tipoTarjeta = "'" . "P" . "'";


			$sentencia = 'INSERT into public."TARJETAS" ( nro_tarjeta, tipo_tarjeta, cod_proveedor, fecha_alta, "fecha_modificación", cod_estado)
			               VALUES (' . $tarjeta . ', ' . $tipoTarjeta . ', ' . $codProveedor . ', CURRENT_DATE, null, ' . $estado . ')';

			$this->db->query($sentencia);

			//se vincula la nueva tarjeta a la persona

			$nuevoIdTarjeta = $this->getDetalleTarjetaPorNumero($nroTarjetaNueva);

			$sentencia = 'INSERT INTO public."TARJETAS_USUARIOS" VALUES('. $nuevoIdTarjeta['id_tarjeta'] . ', ' . $idUsua . ', CURRENT_DATE, null, ' . $estado . ')';

			$this->db->query($sentencia);			


		}



	}



?>