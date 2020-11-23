<!DOCTYPE html>
<html>
<head>
	<title>Productos</title>

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

				div.interiorBody{
				background-color:lightgreen;
				width:60%;
				height:25%;
				left:20%;
				position:absolute;
				top:20%;
				overflow-y:scroll;

				}

				div.interiorBody2{
				background-color:lightgreen;
				width:60%;
				height:25%;
				left:20%;
				position: absolute;
				top:60%;
				overflow-y:scroll;

				}

				 div.interiorTitulo1{
				background-color:green;
				width:12%;
				height:11%;
				left:20%;
				position:absolute;
				top:15%;
				font-size:20px;
				font-weight:bold;
				border: 1px solid #ddd;


				}

				div.interiorTitulo2{
					background-color:green;
					width:12%;
					height:11%;
					left:20%;
					position:absolute;
					top:55%;
					font-size:20px;
					font-weight:bold;
					border: 1px solid #ddd;


				}

				a{

					color:white;
					font-size:20px;
					font-weight:bold;

				}

				img{
					height: 50%;
					width: 80%;
				}

				[campo-dato='c1']{
				width:25%; 
				}
				[campo-dato='c2']{
				width:25%; 
				}
				[campo-dato='c3']{
				width:25%; 
				}
				[campo-dato='c4']{
				width:25%; 
				}

				#cuentas{
					border-collapse: collapse;
	  				width: 100%;
				}

				#cuentas td, #cuentas th{
					border: 1px solid #ddd;
				}

				#cuentas tr:nth-child(even){background-color: #f2f2f2;}

				#cuentas tr:hover {background-color: #ddd;}

				#cuentas th {
				  padding-top: 12px;
				  padding-bottom: 12px;
				  text-align: left;
				  background-color: #4CAF50;
				  color: white;
				}

				.tooltip {
				  position: relative;
				  display: inline-block;
				  border-bottom: 1px dotted black;
				}

				.tooltip .tooltiptext {
				  visibility: hidden;
				  width: 120px;
				  background-color: black;
				  color: #fff;
				  text-align: center;
				  border-radius: 6px;
				  padding: 5px 0;

				  /* Position the tooltip */
				  position: absolute;
				  z-index: 1;
				}

				.tooltip:hover .tooltiptext {
				  visibility: visible;
				}

				img.logo2{
					height: 14px;
					width: 23px;
				

				}

				label{

					font-family: Helvetica;
					font-size:120%;
					font-weight:bold;


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

			<form action="" method="POST">
				<label>Seleccionar usuario: </label>
						<select class="usuario" name="usuario" required="required" id="usuario"> 
							<?php 
								foreach ($this->usuarios as $us){
									if($this->usuarioElegido == $us['id_usuario']){
										echo '<option value="' . $us['id_usuario'] . ' " selected>' . $us['id_login_usuario'] . ' ' . ' (' . $us['nombre'] . ' ' . $us['apellido'] . ')</option>';
									} else {
										echo '<option value="' . $us['id_usuario'] . '">' . $us['id_login_usuario'] . ' ' . ' (' . $us['nombre'] . ' ' . $us['apellido'] . ')</option>';
									}
								}

							 ?>
						</select>
				<button type="submit">Aceptar</button>
			</form>
			
				<div class="interiorTitulo1">
					<a>Cuentas</a>
				</div>
				<div class="interiorBody">
					
					<?php
					
						echo '<table id="cuentas">';
						echo '<tr>';
						echo '<th campo-dato="c1">Número cuenta</th>';
						echo '<th campo-dato="c2">Tipo</th>';
						echo '<th campo-dato="c3">Saldo</th>';
						echo '<th campo-dato="c4">Estado</th>';
						echo '</tr>';
						foreach($this->cuentas as $cu){
							echo '<tr>';
							echo '<td campo-dato="c1">' . $cu['nro_cuenta'] . '</td>';
							echo '<td campo-dato="c2">' . $cu['tipo_cuenta'] . '</td>';
							echo '<td campo-dato="c3">' . $cu['saldo'] . '</td>';
							echo '<td campo-dato="c4">' . $cu['estado'] . '</td>';
							echo '</tr>';								
						}
						echo '</table>';					
					?>

				</div>

				<div class="interiorTitulo2">
					<a class="usuario">Tarjetas</a>
				</div>
				<div class="interiorBody2">
					
					<?php
					
						echo '<table id="cuentas">';
						echo '<tr>';
						echo '<th campo-dato="c1">Número de tarjeta</th>';
						echo '<th campo-dato="c2">Proveedor</th>';
						echo '<th campo-dato="c3">Tipo de tarjeta</th>';
						echo '<th campo-dato="c4">Estado</th>';
						echo '</tr>';
						foreach($this->tarjetas as $tp){
							echo '<tr>';
							echo '<td campo-dato="c1">' . $tp['nro_tarjeta'] . '</td>';
							echo '<td campo-dato="c2">' . $tp['nombre_proveedor'] . '  <img class="logo2" src="../' . $tp['nombre_proveedor'] . '.png"></td>';
							echo '<td campo-dato="c3">' . $tp['tipo_tarjeta'] . '</td>';
							echo '<td campo-dato="c4">' . $tp['estado'] . '</td>';
							echo '</tr>';								
						}
						echo '</table>';					
					?>

				</div>	

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
					
					window.location.href="PantallaAdministracionCuentas.php";

				});

				$("#divTarjetas").click(function(){
					
					window.location.href="PantallaAdministracionTarjetas.php";

				});

				$("#divUsuarios").click(function(){
					
					window.location.href="PantallaAdministracionUsuarios.php";

				});

				$("#divProductos").click(function(){
					
					window.location.href="PantallaProductos.php";

				});

				$("#divCerrarSesion").click(function(){
					
					$.ajax({
						type:"post",
						url:"./CerrarSesion.php",
						data:{},
						success:function(respuestaDelServer,estado){
							window.location.href="PantallaLogin.php";	
						}
					});



				});
			});
		</script>




</body>
</html>