<?php

// controllers/PantallaLogin.php

	require '../fw/fw.php';
	require '../models/Usuarios.php';
	require '../views/FormLogin.php';

	//$e = new Empleados();
	//$todos = $e->getTodos();

	//session_start();
	var_dump("hola1");
	if(count($_POST)>0){
		var_dump("hola2");

		/////////////!!!!!!!!!!!!!!!!!!!! VALIDAR $_POST['usuario'] !!!!!!!!!!!!!!!!!!///////////////

		$u = new Usuarios();
		var_dump("hola3");
		$usuario = $u->GetUsuario($_POST['usuario']);
		var_dump("hola4");

		var_dump($usuario);

		if (!$usuario) {
			echo "Usuario o contraseña incorrecta";
			exit();
		} else{

		
			//$fila = pg_fetch_assoc($resultado);

			if ($usuario['pass'] != sha1($_POST['pass'])){

				echo "Usuario o contraseña incorrecta";
				exit();
			}

			if ($usuario['cod_estado'] != 'A'){

				echo "El usuario no se encuentra activo";
				exit();

			}

			echo "validado correctamente";
			//$_SESSION['logueado'] = true;
			//$_SESSION['usuario'] = $_POST['usuario'];
			//header("Location: consultaSaldos.php");
			//exit;
	
		}



/*











		include 'datosConexionBase.inc';

		 //establezco conexión con la base de datos
		$dbconn = pg_connect("host=" . HOST . " port=" . PORT . " dbname=" . BASE . " user=" . USUARIO . " password=" . PASS);

		//validar el usuario 
		$cons = "'" . $_POST['usuario'] . "'";
		$parte1 = 'SELECT * FROM public."USUARIOS" WHERE "nombre_usuario" = ';
		
		//realizo la consulta
		$resultado = pg_query($dbconn, $parte1 . $cons);

		 if (!$resultado) {
			echo "Se produjo un error\n";
			exit;
		} else{

			if (pg_num_rows($resultado) == 1){

				$fila = pg_fetch_assoc($resultado);

				if ($fila['pass'] != sha1($_POST['pass'])){

					echo "Usuario o contraseña incorrecta";
					exit();
				}

				if ($fila['cod_estado'] != 'A'){

					echo "El usuario no se encuentra activo";
					exit();

				}

				$_SESSION['logueado'] = true;
				$_SESSION['usuario'] = $_POST['usuario'];
				header("Location: consultaSaldos.php");
				exit;

			}else{

				echo "Usuario o contraseña incorrecta 2";

			}

	
		}


		//pg_close($dbconn);
		*/


	} else {

		$v = new FormLogin();
		//$v->empleados = $todos;
	    //render sería como decirle "dibujate"
		$v->render();

	}


	


?>