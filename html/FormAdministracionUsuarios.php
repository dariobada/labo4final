<!-- html/FormAdministracionProductos.php-->

<!DOCTYPE html>
<html>
<head>
	<title>Administracion de usuarios</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	<style>
		html, body{
					height:100%;
					width:100%;
					margin:0%;
					
				}

				div.contenedorPrincipal{
					height:100%;
					width:100%;
					background: linear-gradient(0deg, black, pink, lightpink); 
				}

				div.menuSuperior{
					width:100%;
					height:10%;
					float:left;

				}	
			
				div.headerOpcionImpar{
					background-color:rgb(220, 94, 200);
					height:100%;
					width:16.666%;
					font-family: Helvetica;
					float:left;
					color:white;
					font-size:120%;
					font-weight: bold;
					justify-content:center;
					align-items:center;
					display:flex;
				
				}	

				div.headerOpcionPar{
					background-color:rgb(219, 109, 202 );
					width:16.666%;
					height:100%;
					float:left;
					color:white;
					font-family: Helvetica;
					font-size:120%;
					font-weight:bold;
					justify-content:center;
					align-items:center;
					display:flex;
		
				}

				div.contenedorBody{
					height:100%;
				}

				div.Alta{
					background-color:rgb(182, 123, 173 );
					width:37%;
					height:52%;
					left:10%;
					position:absolute;
					top:20%;
					padding-left: 2%;
					align-items: center;
					justify-content: center;

				}

				div.Modi{
					background-color:rgb(182, 123, 173 );
					width:36%;
					height:45%;
					left:51%;
					position:absolute;
					top:20%;
					padding-left: 2%;
					align-items: center;
					justify-content: center;

				}

				div.Baja{
					background-color:rgb(182, 123, 173 );
					width:36%;
					height:22%;
					left:51%;
					position:absolute;
					top:69%;
					padding-left: 2%;
					align-items: center;
					justify-content: center;

				}
				div.radio{
					top: 10%;
					left: 20%;
					align-items: center;
					justify-content: center;

				}

				img{
					height: 50%;
					width: 65%;
				}

				form.radio{
					position: absolute;
					left: 20%;
					top: 13%;
				}

				input.izq{
					position: absolute;
					left:40%;
				}

				select.usuario{
					position: absolute;
					left:40%;
				}

				select.cuenta{
					position: absolute;
					left:40%;
				}
				
				select.tipo_cuenta{
					position: absolute;
					left:40%;
				}
				
				a.mensaje{

				color:red;
				font-size:25px;
				font-weight:bold;
				position:absolute;
				top:11%;
				left:15%;

				}

				
				
				

	</style>

</head>
<body>
		<div class="contenedorPrincipal" >
			<div class="menuSuperior">
				<div class="headerOpcionImpar"><img src="../logo.png"></div>
				<div class="headerOpcionPar" id="divCuentas">Administración de cuentas</div>
				<div class="headerOpcionImpar" id="divTarjetas">Administración de tarjetas</div>
				<div class="headerOpcionPar" id="divUsuarios">Administración de usuarios</div>
				<div class="headerOpcionImpar" id="divProductos">Productos</div>
				<div class="headerOpcionPar" id="divCerrarSesion">Cerrar sesión</div>
				
			</div>



			<div class="contenedorBody">

				
				<div class="Alta">
					<form action="" method="post">

						<h2>Dar de alta usuario</h2>

						
						<label>Nombre: </label>
						<input class="izq" name="nombre" id="nombre" required="required">
						<br><br>
						<label>Apellido: </label>
						<input class="izq" name="apellido" id="apellido" required="required">
						<br><br>
						<label>Nombre de usuario: </label>
						<input class="izq" name="nombreUsuario" id="nombreUsuario" required="required" placeholder="Nombre para loguear">
						<br><br>
						<label>Contraseña: </label>
						<input class="izq" type="password" name="pass" id="pass" required="required">
						<br><br>
						<label>¿Es administrador?</label>
						<input type="radio" id="opcion" name="opcion" value="Si" required="required">Si
						<input type="radio" id="opcion" name="opcion" value="No" required="required">No
						<br><br><br><br>

						<button class="enviar" type="submit">Alta</button>

						
					</form>
				</div>

				<div class="Modi">
					
				<form action="" method="post">
					
					<h2>Modificar usuario</h2>

					<label>Seleccionar usuario:</label>
					<select class="usuario" name="usuario" required="required" id="usuario"> 
							<?php 
								foreach ($this->usuarios as $us){
									echo '<option value="' . $us['id_usuario'] . '">' . $us['id_login_usuario'] . ' ' . ' (' . $us['nombre'] . ' ' . $us['apellido'] . ')</option>';
								}

							 ?>
						</select>
						<br><br>
					<label>Nombre: </label>
					<input class="izq" name="nombre" id="nombre" required="required">
					<br><br>
					<label>Apellido: </label>
					<input class="izq" name="apellido" id="apellido" required="required">
					<br><br>
					<label>Nuevo nombre de usuario:</label>
					<input class="izq" name="nombreUsuario" id="nombreUsuario" required="required" placeholder="Nombre para Loguear">
					<br><br>
					<button class="enviar" type="submit">Modificar</button>

				</form>




				</div>

				<div class="Baja">
					<form action="" method="post">
						<h2>Baja de usuario</h2>
						<label>Seleccionar usuario: </label>
							<select class="usuario" name="usuario" id="usuario" required="required" id="usuario"> 
							<?php 
								foreach ($this->usuarios as $us){
									echo '<option value="' . $us['id_usuario'] . '">' . $us['id_login_usuario'] . ' ' . ' (' . $us['nombre'] . ' ' . $us['apellido'] . ')</option>';
								}

							 ?>
						</select>
						<br><br>

						<button class="enviar" type="submit">Eliminar</button>
					</form>

				</div>
				<?php
					if ($this->mensaje){
						echo '<a class="mensaje">' . $this->mensaje . '</a>';
					}
				?>


			</div>
		</div>

		<script src="../jquery.js"></script>
		<script type="text/javascript">

			document.getElementById("divCerrarSesion").onmouseover = function(){			
				document.getElementById("divCerrarSesion").style.cursor = "pointer";
			}

			document.getElementById("divCerrarSesion").onmouseout = function(){			
				document.getElementById("divCerrarSesion").style.cursor = "auto";
			}

			document.getElementById("divCuentas").onmouseover = function(){			
				document.getElementById("divCuentas").style.cursor = "pointer";
			}

			document.getElementById("divCuentas").onmouseout = function(){			
				document.getElementById("divCuentas").style.cursor = "auto";
			}

			document.getElementById("divTarjetas").onmouseover = function(){			
				document.getElementById("divTarjetas").style.cursor = "pointer";
			}

			document.getElementById("divTarjetas").onmouseout = function(){			
				document.getElementById("divTarjetas").style.cursor = "auto";
			}

			document.getElementById("divUsuarios").onmouseover = function(){			
				document.getElementById("divUsuarios").style.cursor = "pointer";
			}

			document.getElementById("divUsuarios").onmouseout = function(){			
				document.getElementById("divUsuarios").style.cursor = "auto";
			}

			document.getElementById("divProductos").onmouseover = function(){			
				document.getElementById("divProductos").style.cursor = "pointer";
			}

			document.getElementById("divProductos").onmouseout = function(){			
				document.getElementById("divProductos").style.cursor = "auto";
			}

			$(document).ready(function(){
				
				$("#divCuentas").click(function(){
					
					window.location.href="administracion-cuentas";

				});

				$("#divTarjetas").click(function(){
					
					window.location.href="administracion-tarjetas";

				});

				$("#divUsuarios").click(function(){
					
					window.location.href="administracion-usuarios";

				});

				$("#divProductos").click(function(){
					
					window.location.href="administracion-productos";

				});


				$("#divCerrarSesion").click(function(){
					
					$.ajax({
						type:"post",
						url:"cerrar-sesion",
						data:{},
						success:function(respuestaDelServer,estado){
							window.location.href="inicio-sesion";	
						}
					});



				});
			});
		</script>

</body>
</html>