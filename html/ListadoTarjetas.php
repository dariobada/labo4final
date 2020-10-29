<!DOCTYPE html>

<html>



	<head>
		<title>Listado de tarjetas</title>
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
			
			}

			div.menuSuperior{
				width:100%;
				height:10%;
				float:left;

			}	
		
			div.headerOpcionImpar{
				background-color:rgb(47, 92, 215);
				height:100%;
				width:20%;
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
				background-color:rgb(74, 112, 215);
				width:20%;
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

			div.contenedorMarca{
		    position: absolute; 
		    font-family: Helvetica;
		    color: white;
		    top: 15%;
		    width: 10%;
		    height: 80%;
		    font-size: 6.5px;
		    background: linear-gradient(0deg, darkblue, darkcyan); 
			}

			div.contenedorBody{
				height:100%;
			}

			div.interiorBody{
				background-color:lightblue;
				width:60%;
				height:25%;
				left:20%;
				position:absolute;
				top:20%;

			}

			div.interiorBody2{
				background-color:lightblue;
				width:60%;
				height:25%;
				left:20%;
				position: absolute;
				top:60%;

			}
			img{
				height: 50%;
				width: 80%;
			}
			img.logo{
				height: 10%;
				width: 60%;
				left: 15%;
				position: absolute;

			}

			img.logo2{
				height: 12px;
				width: 20px;
				

			}

			button{
                width: 13%;
                height: 30%;   
                float: left;  
                position: absolute;
                left: 110%;
                top: 30%;
         
            }
            label.mistarjetas{

            	margin-left: 20%;
            	
            	font-family: Helvetica;
		   		color: white;
		   		font-size: 150%;
		   		font-weight:bold;

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

			#principales{
				border-collapse: collapse;
  				width: 100%;
			}

			#principales td, #principales th{
				border: 1px solid #ddd;
			}

			#principales tr:nth-child(even){background-color: #f2f2f2;}

			#principales tr:hover {background-color: #ddd;}

			#principales th {
			  padding-top: 12px;
			  padding-bottom: 12px;
			  text-align: left;
			  background-color: #4CAF50;
			  color: white;
			}

			#extensiones{
				border-collapse: collapse;
  				width: 100%;
			}

			#extensiones td, #extensiones th{
				border: 1px solid #ddd;
			}

			#extensiones tr:nth-child(even){background-color: #f2f2f2;}

			#extensiones tr:hover {background-color: #ddd;}

			#extensiones th {
			  padding-top: 12px;
			  padding-bottom: 12px;
			  text-align: left;
			  background-color: #4CAF50;
			  color: white;
			}

			
		</style>
	</head>

	<body background="../fondo.jpg">
		<div class="contenedorPrincipal" >
			<div class="menuSuperior">
				<div class="headerOpcionImpar"><img src="../logo.png"></div>
				<div class="headerOpcionPar" id="divConsultaSaldos">Consulta de saldos</div>
				<div class="headerOpcionImpar" id="divTarjetas">Tarjetas</div>
				<div class="headerOpcionPar">Transferencias</div>
				<div class="headerOpcionImpar" id="divCerrarSesion">Cerrar sesión</div>
			</div>
			
			<div class="contenedorBody">
				<div class="contenedorMarca">
					<h1>&nbsp; Nuestros Proveedores</h1>
					<br><br><br><br><br><br>
					<img class="logo" src="../visa.png">
					<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
					<img class="logo" src="../master.png">
					<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
					<img class="logo" src="../cabal.png">
					<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
					<img class="logo" src="../american.png">
				</div>

				<label class="mistarjetas">Mis Tarjetas</label>
				<div class="interiorBody">
					
					<?php
					
						echo '<table id="principales">';
						echo '<tr>';
						echo '<th campo-dato="c1">Número de tarjeta</th>';
						echo '<th campo-dato="c2">Proveedor</th>';
						echo '<th campo-dato="c3">Imagen</th>';
						echo '</tr>';
						foreach($this->tarjetasPrincipales as $tp){
							echo '<tr>';
							echo '<td campo-dato="c1">' . $tp['nro_tarjeta'] . '</td>';
							echo '<td campo-dato="c2">' . $tp['nombre_proveedor'] . '</td>';
							echo '<td campo-dato="c3"><img class="logo2" src="../visa.png"></td>';
							echo '</tr>';								
						}
						echo '</table>';					
					?>
				<!--	<button type="submit">Solicitar Extensión</button>-->

				</div>	
				

				<div class="interiorBody2">
					
					<?php
					
						echo '<table id="extensiones">';
						echo '<tr>';
						echo '<th campo-dato="c1">Número de tarjeta</th>';
						echo '<th campo-dato="c2">Proveedor</th>';
						echo '<th campo-dato="c3">Nombre</th>';
						echo '<th campo-dato="c4">Apellido</th>';
						echo '</tr>';
						foreach($this->tarjetasExtensiones as $te){
							echo '<tr>';
							echo '<td campo-dato="c1">' . $te['nro_tarjeta'] . '</td>';
							echo '<td campo-dato="c2">' . $te['nombre_proveedor'] . '</td>';
							echo '<td campo-dato="c3">' . $te['nombre_ext'] . '</td>';
							echo '<td campo-dato="c4">' . $te['apellido_ext'] . '</td>';
							echo '</tr>';								
						}
						echo '</table>';					
					?>
						
				</div>

				
			</div>	
		</div>

	<script src="../jquery.js"></script>
	<script type="text/javascript">
			
			document.getElementById("divConsultaSaldos").onmouseover = function(){			
				document.getElementById("divConsultaSaldos").style.cursor = "pointer";
			}

			document.getElementById("divConsultaSaldos").onmouseout = function(){			
				document.getElementById("divConsultaSaldos").style.cursor = "auto";
			}


			document.getElementById("divCerrarSesion").onmouseover = function(){			
				document.getElementById("divCerrarSesion").style.cursor = "pointer";
			}

			document.getElementById("divCerrarSesion").onmouseout = function(){			
				document.getElementById("divCerrarSesion").style.cursor = "auto";
			}

			document.getElementById("divTarjetas").onmouseover = function(){			
				document.getElementById("divTarjetas").style.cursor = "pointer";
			}

			document.getElementById("divTarjetas").onmouseout = function(){			
				document.getElementById("divTarjetas").style.cursor = "auto";
			}

			$(document).ready(function(){
				
				$("#divConsultaSaldos").click(function(){
					
					window.location.href="PantallaSaldos.php";

				});

				$("#divTarjetas").click(function(){
					
					window.location.href="PantallaTarjetas.php";

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