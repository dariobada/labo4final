<?php

// controllers/PantallaLogin.php

	require '../fw/fw.php';
	require '../models/Usuarios.php';
	require '../models/Roles.php';
	require '../views/FormLogin.php';
	require '../views/FormLoginError.php';


	session_start();

	if(count($_POST)>0){


		/////////////!!!!!!!!!!!!!!!!!!!! VALIDAR $_POST['usuario'] !!!!!!!!!!!!!!!!!!///////////////

		$u = new Usuarios();
				
		$usuario = $u->GetUsuario($_POST['usuario']);

		if (!$usuario) {
		
			$v = new FormLoginError();
			$v->ErrorLogin = "Usuario y/o contraseña incorrecta";
		    //render sería como decirle "dibujate"
			$v->render();
			exit();

		} else{

		
			if ($usuario['pass'] != sha1($_POST['pass'])){

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

			$_SESSION['logueado'] = true;
			$_SESSION['IdUsuario'] = $usuario['id_usuario'];
			$_SESSION['nombre'] = $_POST['usuario'];

			$r = new Roles();
		
			if($r->devolverMarcaAdministrador($usuario['id_usuario'])){

				header("Location: PantallaAdministracionProductos.php");
				

			} else {
			
				header("Location: PantallaSaldos.php");
	
			}

			exit();

		}



	} else {

		$v = new FormLogin();
	    //render sería como decirle "dibujate"
		$v->render();

	}


	


?>