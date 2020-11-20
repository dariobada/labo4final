<!-- html/ListadoCuentas.php-->

<!DOCTYPE html>

<html>



	<head>
		<title>Consulta de saldos</title>
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
				background-color:lightgreen;
				width:60%;
				height:55%;
				left:20%;
				position:absolute;
				top:30%;
				overflow-y:scroll;


			}
			div.interiorTitulo{
				background-color:green;
				width:12%;
				height:11%;
				left:20%;
				position:absolute;
				top:25%;
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

			
		</style>
	</head>

	<body background="../fondo.jpg">
		<div class="contenedorPrincipal" >
			<div class="menuSuperior">
				<div class="headerOpcionImpar"><img src="../logo.png"></div>
				<?php
				
					if(($this->operaCuentas) == "1"){									
				
						echo '<div class="headerOpcionPar" id="divConsultaSaldos">Cuentas</div>';
						echo '<div class="headerOpcionImpar" id="divTransferencias">Transferencias</div>';
				
					} else {
							

						echo '<div class="headerOpcionPar" title="No posee productos para utilizar esta funcionalidad.">Cuentas</div>';
						echo '<div class="headerOpcionImpar" title="No posee productos para utilizar esta funcionalidad.">Transferencias</div>';
				
					}
				
				
					if(($this->operaTarjetas) == "1"){									
				
						echo '<div class="headerOpcionPar" id="divTarjetas">Tarjetas</div>';
				
					} else {
				
						echo '<div class="headerOpcionPar" title="No posee productos para utilizar esta funcionalidad.">Tarjetas</div>';
				
					}
				?>
				
				<div class="headerOpcionImpar" id="divCerrarSesion">Cerrar sesión</div>
			</div>
			<div class="contenedorBody">
				<a>Usuario operando: <?= $this->usuario?></a>
			
				<div class="interiorTitulo">
					<a>Cuentas</a>
				</div>
				<div class="interiorBody">
					
					<?php
					
						echo '<table id="cuentas">';
						echo '<tr>';
						echo '<th campo-dato="c1">Número cuenta</th>';
						echo '<th campo-dato="c2">Tipo</th>';
						echo '<th campo-dato="c4">Saldo</th>';
						echo '</tr>';
						foreach($this->cuentas as $cu){
							echo '<tr>';
							echo '<td campo-dato="c1">' . $cu['nro_cuenta'] . '</td>';
							echo '<td campo-dato="c2">' . $cu['tipo_cuenta'] . '</td>';
							echo '<td campo-dato="c4">' . $cu['saldo'] . '</td>';
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