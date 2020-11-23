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

			div.headerOpcionParBloqueada{
				background-color:rgb(227, 225, 225);
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

			div.headerOpcionImparBloqueada{
				background-color:rgb(206, 206, 206);
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

			a.mensaje{

				color:red;
				font-size:25px;
				font-weight:bold;
				position:absolute;
				top:90%;

			}

			div.ventanaModal{
				
				width:70%;
				height:70%;		
				position:fixed;
				top:20%;
				left:25%;
				visibility:hidden;
				
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
				height:5%;
			}

			input.col2{
				position:fixed;
				margin-left:30%;
				width:15%;
				height:5%;
			}

			select.col1{
				position:fixed;
				margin-left:30%;
				width:15%;
				height:7%;
			}

			button.AltaFormulario{
				position:fixed;
				margin-left:35%;
				margin-top:1.5%;
				width: 200px;
				height: 50px;

			}

			[campo-dato='c1']{
			width:20%; 
			}
			[campo-dato='c2']{
			width:20%; 
			}
			[campo-dato='c3']{
			width:20%; 
			}
			[campo-dato='c4']{
			width:20%; 
			}
			[campo-dato='c5']{
			width:20%; 
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
				<input id="poseeCuentas" type="hidden" value="<?= $this->operaCuentas?>"></input>
				<input id="poseeTarjetas" type="hidden" value="<?= $this->operaTarjetas?>"></input>
				<div class="headerOpcionPar" id="divConsultaSaldos">Cuentas</div>
				<div class="headerOpcionImpar" id="divTransferencias">Transferencias</div>
				<div class="headerOpcionPar" id="divTarjetas">Tarjetas</div>				
				<div class="headerOpcionImpar" id="divCerrarSesion">Cerrar sesión</div>
			</div>
			
			<div class="contenedorBody">
				<a class="usuario">Usuario operando: <?= $this->usuario?></a>

				<div class="interiorTitulo1">
					<a class="usuario">Mis tarjetas (<?= $this->nombre . " " . $this->apellido?>)</a>
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
						echo '<th campo-dato="c5">Número documento</th>';
						echo '</tr>';
						foreach($this->tarjetasExtensiones as $te){
							echo '<tr>';
							echo '<td campo-dato="c1">' . $te['nro_tarjeta'] . '</td>';
							echo '<td campo-dato="c2">' . $te['nombre_proveedor'] . '</td>';
							echo '<td campo-dato="c3">' . $te['nombre_ext'] . '</td>';
							echo '<td campo-dato="c4">' . $te['apellido_ext'] . '</td>';
							echo '<td campo-dato="c5">' . $te['documento_ext'] . '</td>';
							echo '</tr>';								
						}
						echo '</table>';					
					?>
						
				</div>
				<?php
					if ($this->mensaje){
						echo '<a class="mensaje">' . $this->mensaje . '</a>';
					}
				?>

				
			</div>	
		</div>

		<!--Ventana modal de alta de extensión-->
		<div class="ventanaModal" id="modalModificacion">
			<div class="divHeader">
				<div class="divHeaderTexto" id="headerTextoMod"><a>Solicitud de alta de extensión de tarjeta</a></div>
				<div class="divHeaderCerrar" id="cerrarModi"><a>X</a></div>
			</div>

			<div class="centroModal" id="cuerpoModalModi">
				<form action="" method="post" id="formularioModi">
			
					<a class="col1">Ingrese los datos del destinatario de la extensión a solicitar</a><br/><br/><br/>
					
					<a class="col1">Nombre: </a>
					<a class="col2">Apellido: </a><br/><br/>

					<input class="col1" type="text" id="formNombre" name="formNombre" required="required" ></input>				
					<input class="col2" type="text" id="formApellido" name="formApellido" required="required" ></input><br/><br/>	<br/><br/>

					<a class="col1">Número de documento: </a><br/><br/>

					<input class="col1" type="number" id="formDocumento" name="formDocumento" required="required" ></input>
					<input name ="formIdTarjeta" id="formIdTarjeta" type="hidden"></input>
					

					<button type="submit"  id="enviarModi" class="AltaFormulario" >Solicitar extensión</button> <br/><br/>

				</form>

			</div>
		</div>

	<script src="../jquery.js"></script>
	<script type="text/javascript">
			

			function mostrarAltaExtension(id) {

  				$('#modalModificacion').css('visibility','visible');
  				$('#contenedorPrincipal').addClass("contenedorPrincipalInactivo");
				$('#contenedorPrincipal').removeClass("contenedorPrincipalActivo");
				//$("#formIdTarjeta").html(id);
				document.getElementById("formIdTarjeta").value = id;
				
			}

			document.getElementById("cerrarModi").onclick=function(){

				$('#contenedorPrincipal').removeClass("contenedorPrincipalInactivo");
				$('#contenedorPrincipal').addClass("contenedorPrincipalActivo");	
				$('#modalModificacion').css('visibility','hidden');
			}

			document.getElementById("cerrarModi").onmouseover=function(){
				document.getElementById("cerrarModi").className="divHeaderCerrarOver";
			}
			
			document.getElementById("cerrarModi").onmouseout=function(){
				document.getElementById("cerrarModi").className="divHeaderCerrar";
			}

			document.getElementById("divConsultaSaldos").onmouseover = function(){		

				if(document.getElementById("poseeCuentas").value == 1)	{
					document.getElementById("divConsultaSaldos").style.cursor = "pointer";
				} else {
					document.getElementById("divConsultaSaldos").setAttribute("title","No posee productos para utilizar esta funcionalidad.");

				}
			}

			document.getElementById("divConsultaSaldos").onmouseout = function(){			
				if(document.getElementById("poseeCuentas").value == 1)	{	
					document.getElementById("divConsultaSaldos").style.cursor = "auto";
				} else {
					document.getElementById("divConsultaSaldos").setAttribute("title","");
				}
			}


			document.getElementById("divCerrarSesion").onmouseover = function(){			
				document.getElementById("divCerrarSesion").style.cursor = "pointer";
			}

			document.getElementById("divCerrarSesion").onmouseout = function(){			
				document.getElementById("divCerrarSesion").style.cursor = "auto";
			}

			document.getElementById("divTarjetas").onmouseover = function(){			
				if(document.getElementById("poseeTarjetas").value == 1)	{
					document.getElementById("divTarjetas").style.cursor = "pointer";
				} else {
					document.getElementById("divTarjetas").setAttribute("title","No posee productos para utilizar esta funcionalidad.");

				}
			}

			document.getElementById("divTarjetas").onmouseout = function(){		
				if(document.getElementById("poseeTarjetas").value == 1)	{	
					document.getElementById("divTarjetas").style.cursor = "auto";
				} else {
					document.getElementById("divTarjetas").setAttribute("title","");
				}
			}

			document.getElementById("divTransferencias").onmouseover = function(){			
				if(document.getElementById("poseeCuentas").value == 1)	{
					document.getElementById("divTransferencias").style.cursor = "pointer";
				} else {
					document.getElementById("divTransferencias").setAttribute("title","No posee productos para utilizar esta funcionalidad.");

				}
			}

			document.getElementById("divTransferencias").onmouseout = function(){			
				if(document.getElementById("poseeCuentas").value == 1)	{	
					document.getElementById("divTransferencias").style.cursor = "auto";
				} else {
					document.getElementById("divTransferencias").setAttribute("title","");
				}
			}

			$(document).ready(function(){

				if(document.getElementById("poseeCuentas").value != 1){
					
					$('#divConsultaSaldos').removeClass("headerOpcionPar");	
					$('#divConsultaSaldos').addClass("headerOpcionParBloqueada");
					$('#divTransferencias').removeClass("headerOpcionImpar");	
					$('#divTransferencias').addClass("headerOpcionImparBloqueada");
				};
				

				if(document.getElementById("poseeTarjetas").value != 1){
				
					$('#divTarjetas').removeClass("headerOpcionPar");	
					$('#divTarjetas').addClass("headerOpcionParBloqueada");
		
				};

				$("#modalModificacion").css("visibility","hidden");
				
				$("#divConsultaSaldos").click(function(){
					
					if(document.getElementById("poseeCuentas").value == 1)	{
						window.location.href="PantallaSaldos.php";
					}

				});

				$("#divTarjetas").click(function(){
					
					if(document.getElementById("poseeTarjetas").value == 1)	{
						window.location.href="PantallaTarjetas.php";
					}

				});

				$("#divTransferencias").click(function(){
					
					if(document.getElementById("poseeCuentas").value == 1)	{
						window.location.href="PantallaTransferencias.php";
					}

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