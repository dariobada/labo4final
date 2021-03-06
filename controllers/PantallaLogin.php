<?php

// controllers/PantallaLogin.php

	require '../fw/fw.php';
	require '../models/Usuarios.php';
	require '../models/Roles.php';
	require '../models/ValidacionException.php';
	require '../views/FormLogin.php';
	require '../views/FormLoginError.php';


	session_start();

	if(count($_POST)>0){

		if(!isset($_POST['usuario'])) die("Error 1");
		if(!isset($_POST['pass'])) die("Error 2");

		$u = new Usuarios();
				
		$usuario = $u->GetUsuario($_POST['usuario']);

		if (!$usuario) {
		
			$v = new FormLoginError();
			$v->ErrorLogin = "Usuario y/o contraseña incorrecta";
		    //render sería como decirle "dibujate"
			$v->render();
			exit();

		} else{

			$pas = sha1($_POST['pass']);

		
			if ($usuario['pass'] != $pas){

				$v = new FormLoginError();
				$v->ErrorLogin = "Usuario y/o contraseña incorrecta";
			    //render sería como decirle "dibujate"
				$v->render();
				exit();
			}

			if ($usuario['cod_estado'] != 'A'){

				$v = new FormLoginError();
				$v->ErrorLogin = "Usuario inactivo";
			    //render sería como decirle "dibujate"
				$v->render();
				exit();

			}			

			$r = new Roles();
		
			if($r->devolverMarcaAdministrador($usuario['id_usuario'])){

				$_SESSION['logueado'] = true;
				$_SESSION['IdUsuario'] = $usuario['id_usuario'];
				$_SESSION['nombre'] = $_POST['usuario'];
				header("Location: administracion-cuentas");
				exit();
				

			} else {
				
				
				//busco rol de cuentas				
				if($r->validarRolCuentas($usuario['id_usuario'])){
					//var_dump("entra cuentas");
					$tieneCuentas = 1;
					$_SESSION['tieneCuentas'] = 1;
				} else{
					$tieneCuentas = 0;
					$_SESSION['tieneCuentas'] = 0;
				}

				if($r->validarRolTarjetas($usuario['id_usuario'])){
					//var_dump("entra tarjetas");
					$tieneTarjetas = 1;
					$_SESSION['tieneTarjetas'] = 1;
				} else{
					$tieneTarjetas = 0;
					$_SESSION['tieneTarjetas'] = 0;
				}				
				//var_dump("cuentas: " . $_SESSION['tieneCuentas']);
				//var_dump("tarjetas: " . $_SESSION['tieneTarjetas']);

				if($tieneCuentas){
					//si entra significa que opera con cuentas, entonces redirecciona a la consulta de cuentas
					$_SESSION['logueado'] = true;
					$_SESSION['IdUsuario'] = $usuario['id_usuario'];
					$_SESSION['nombre'] = $_POST['usuario'];
					header("Location: consulta-cuentas");
					exit();

				}

				if($tieneTarjetas){
					//si entra significa que opera con tarjetas pero no con cuentas, por lo tanto redirecciona al listado de tarjetas
					$_SESSION['logueado'] = true;
					$_SESSION['IdUsuario'] = $usuario['id_usuario'];
					$_SESSION['nombre'] = $_POST['usuario'];
					header("Location: consulta-tarjetas");
					exit();
				}

				//si llega acá, singifica que el usuario no tiene vinculado ningún rol, por lo tanto se muestra error
				$v = new FormLoginError();
				$v->ErrorLogin = "El usuario no tiene vinculado ningún rol para operar";
			    //render sería como decirle "dibujate"
				$v->render();
				exit();
				
	
			}

			

		}



	} else {

		$v = new FormLogin();
	    //render sería como decirle "dibujate"
		$v->render();

	}


	


?>