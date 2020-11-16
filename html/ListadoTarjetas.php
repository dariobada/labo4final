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

			div.contenedorPrincipalActivo{
				height:100%;
				width:100%;
				opacity:1;
				pointer-events:auto;
			
			}

			div.contenedorPrincipalInactivo{
				height:100%;
				width:100%;
				pointer-events:none;
				opacity:0.3;
			
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
				background-color:lightgreen;
				width:60%;
				height:25%;
				left:20%;
				position:absolute;
				top:20%;

			}

			div.interiorBody2{
				background-color:lightgreen;
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
				height: 14px;
				width: 23px;
				

			}
/*
			button{
                width: 13%;
                height: 30%;   
                float: left;  
                position: absolute;
                left: 110%;
                top: 30%;
         
            }*/
            label.mistarjetas{

            	margin-left: 20%;
            	
            	font-family: Helvetica;
		   		color: white;
		   		font-size: 150%;
		   		font-weight:bold;

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

			a.usuario{

				color:white;
				font-size:20px;
				font-weight:bold;

			}

			div.ventanaModal{
				
				width:70%;
				height:70%;		
				position:fixed;
				top:20%;
				left:25%;
				
			}

			div.divHeader{
				background-color: red;
				height: 5%;
				width:80%;
				float:left;
				justify-content:center;
				align-items:center;

			}

			div.divHeaderTexto{
				background-color: lightblue;
				height:100%;
				width:95%;
				display:flex;
				float:left;
				justify-content:center;
				align-items:center;
				

			}

			div.divHeaderCerrar{
				background-color: lightpink;
				height:100%;
				width:5%;
				display:flex;
				justify-content:center;
				align-items:center;
				float:left;	
			}
			div.divHeaderCerrarOver{
				background-color: grey;
				height:100%;
				width:5%;
				display:flex;
				justify-content:center;
				align-items:center;
				float:left;	
			}

			div.centroModal{
				
				float:left;
				background-color:lightgrey;
				width:80%;
				height: 65%;
				
			}

			a.col1{
				position:fixed;
				margin-left:2%;
				font-size:20px;
			}

			a.col2{
				position:fixed;
				margin-left:30%;
				font-size:20px;
			}

			input.col1{
				position:fixed;
				margin-left:2%;
				width:15%;
				height:7%;
			}

			input.col2{
				position:fixed;
				margin-left:30%;
				width:15%;
				height:7%;
			}

			select.col1{
				position:fixed;
				margin-left:30%;
				width:15%;
				height:7%;
			}

			button.AltaFormulario{
				position:fixed;
				margin-left:15%;
				margin-top:1.5%;
				width: 300px;
				height: 60px;

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
		<div class="contenedorPrincipalActivo" id="contenedorPrincipal" >
			<div class="menuSuperior">
				<div class="headerOpcionImpar"><img src="../logo.png"></div>
				<div class="headerOpcionPar" id="divConsultaSaldos">Cuentas</div>
				<div class="headerOpcionImpar" id="divTarjetas">Tarjetas</div>
				<div class="headerOpcionPar" id="divTransferencias">Transferencias</div>
				<div class="headerOpcionImpar" id="divCerrarSesion">Cerrar sesión</div>
			</div>
			
			<div class="contenedorBody">
				<a class="usuario">Usuario operando: <?= $this->usuario?></a>
				<div class="contenedorMarca">
					<h1>Nuestros Proveedores</h1>
					<br><br><br><br><br><br>
					<img class="logo" src="../VISA.png">
					<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
					<img class="logo" src="../MASTERCARD.png">
					<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
					<img class="logo" src="../CABAL.png">
					<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
					<img class="logo" src="../AMERICAN.png">
				</div>

				<!--<label class="mistarjetas">Mis Tarjetas</label>-->
				<div class="interiorTitulo1">
					<a class="usuario">Mis tarjetas</a>
				</div>
				<div class="interiorBody">
					
					<?php
					
						echo '<table id="principales">';
						echo '<tr>';
						echo '<th campo-dato="c1">Número de tarjeta</th>';
						echo '<th campo-dato="c2">Proveedor</th>';
						echo '<th campo-dato="c3">Solicitar extensión</th>';
						echo '</tr>';
						foreach($this->tarjetasPrincipales as $tp){
							echo '<tr>';
							echo '<td campo-dato="c1">' . $tp['nro_tarjeta'] . '</td>';
							echo '<td campo-dato="c2">' . $tp['nombre_proveedor'] . '  <img class="logo2" src="../' . $tp['nombre_proveedor'] . '.png"></td>';
							echo '<td campo-dato="c3"><button onclick="mostrarAltaExtension(' . $tp['id_tarjeta'] . ')">Solicitar</button></td>';
							echo '</tr>';								
						}
						echo '</table>';					
					?>

				</div>	
				
				<div class="interiorTitulo2">
					<a class="usuario">Mis extensiones</a>
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

		<!--Ventana modal de Modificación-->
		<div class="ventanaModal" id="modalModificacion">
			<div class="divHeader">
				<div class="divHeaderTexto" id="headerTextoMod"><a>Encabezado modal Formulario de modificación</a></div>
				<div class="divHeaderCerrar" id="cerrarModi"><a>X</a></div>
			</div>

			<div class="centroModal" id="cuerpoModalModi">
				<form id="formularioModi">
					<a class="col1">Nombre cliente: </a>
					<a class="col2">Nacionalidad: </a><br/><br/>				
					
					<input class="col1" type="text" id="formNombreModi" name="formNombreModi" required="required" ></input>
					<select class="col1" id="formNacionalidadesModi" name="formNacionalidadesModi" required="required"></select><br/><br/>	<br/><br/>	
					
					<a class="col1">Estado: </a>
					<a class="col2">Fecha alta: </a><br/><br/>		

					<input class="col1" type="text" id="formEstadoModi" name="formEstadoModi" required="required" ></input>
					<input class="col2" type="date" id="formFechaModi" name="formFechaModi" required="required"> <br/><br/>	<br/><br/>
					<input id="formIdClienteModi" type="hidden"></input>

					
					<button type="button"  id="enviarModi" class="AltaFormulario" disabled="true">Enviar modificación</button> <br/><br/>	


				</form>

			</div>
		</div>

	<script src="../jquery.js"></script>
	<script type="text/javascript">
			

			function mostrarAltaExtension($id) {
  				alert("entra a funcion");
  				alert("id: " );
  				alert($id);

  				$('#modalModificacion').css('visibility','visible');
  				$('#contenedorPrincipal').addClass("contenedorPrincipalInactivo");
				$('#contenedorPrincipal').removeClass("contenedorPrincipalActivo");
			}

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

			document.getElementById("divTransferencias").onmouseover = function(){			
				document.getElementById("divTransferencias").style.cursor = "pointer";
			}

			document.getElementById("divTransferencias").onmouseout = function(){			
				document.getElementById("divTransferencias").style.cursor = "auto";
			}

			$(document).ready(function(){

				$("#modalModificacion").css("visibility","hidden");
				
				$("#divConsultaSaldos").click(function(){
					
					window.location.href="PantallaSaldos.php";

				});

				$("#divTarjetas").click(function(){
					
					window.location.href="PantallaTarjetas.php";

				});

				$("#divTransferencias").click(function(){
					
					window.location.href="PantallaTransferencias.php";

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