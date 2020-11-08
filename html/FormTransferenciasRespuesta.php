<!-- html/FormTransferenciasRespuesta.php-->

<!DOCTYPE html>

<html>



	<head>
		<title>Transferencia</title>
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

			div.contenedorBody{
				height:100%;
			}

			div.interiorBody{
				background-color:lightblue;
				width:58%;
				height:30%;
				left:20%;
				position:absolute;
				top:25%;
				padding-top: 3%;
				padding-left: 2%;
				align-items: center;
				justify-content: center;


			}
			img{
				height: 50%;
				width: 80%;
			}

			select{
				height: 7%;
				width: 50%;
			}
			input.destino{
				height: 6%;
				width: 25%;
			}

			input.monto{
				height: 6%;
				width: 20%;
			}
			button.enviar{
				height: 20%;
				width: 30%;
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

			
		</style>
	</head>

	<body background="../fondo.jpg">
		<div class="contenedorPrincipal" >
			<div class="menuSuperior">
				<div class="headerOpcionImpar"><img src="../logo.png"></div>
				<div class="headerOpcionPar" id="divConsultaSaldos">Consulta de saldos</div>
				<div class="headerOpcionImpar" id="divTarjetas">Tarjetas</div>
				<div class="headerOpcionPar" id="divTransferencias">Transferencias</div>
				<div class="headerOpcionImpar" id="divCerrarSesion">Cerrar sesión</div>
			</div>
			<div class="contenedorBody">
				<div class="interiorBody">
					<form action="" method="post">
						
						<label>Seleccionar cuenta remitente: </label>
						<select name="cuenta" required="required"> 
							<?php 
								foreach ($this->cuentas as $cu){
									echo '<option value="' . $cu['id_cuenta'] . '">' . $cu['tipo_cuenta'] . ' ' . $cu['nro_cuenta'] . ' (' . $cu['saldo'] . ')</option>';
								}

							 ?>


						</select>
						<br><br><br>

						<label>Ingresar cuenta destino: </label>
						<input class="form" type="number" name="destino" required="required">
						<br><br><br>

						<label>Ingresar monto: </label>
						<input class="form" type="number" name="monto" required="required" step="any">
						<br><br>

						<button class="enviar" type="submit">Realizar Transferencia</button>
					</form>
					
					<label style="color:red"><?= $this->mensaje ?></label>


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

			document.getElementById("divTransferencias").onmouseover = function(){			
				document.getElementById("divTransferencias").style.cursor = "pointer";
			}

			document.getElementById("divTransferencias").onmouseout = function(){			
				document.getElementById("divTransferencias").style.cursor = "auto";
			}

			$(document).ready(function(){
				
				$("#divConsultaSaldos").click(function(){
					
					window.location.href="PantallaSaldos.php";

				});

				$("#divTarjetas").click(function(){
					
					window.location.href="PantallaTarjetas.php";

				});

				$("#divTransferencias").click(function(){
					
					window.location.href="PantallaTransferencias.php";


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