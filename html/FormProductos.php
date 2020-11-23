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
					width:15%;
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
					width:15%;
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





</body>
</html>