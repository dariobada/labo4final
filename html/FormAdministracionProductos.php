<!-- html/FormAdministracionProductos.php-->

<!DOCTYPE html>
<html>
<head>
	<title>Administracion productos</title>
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
					width:25%;
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
					width:25%;
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
					height:27%;
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
					top:50%;
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
				
				
				

	</style>

</head>
<body>
		<div class="contenedorPrincipal" >
			<div class="menuSuperior">
				<div class="headerOpcionImpar"><img src="../logo.png"></div>
				<div class="headerOpcionPar" id="divAltaProductos">Alta de productos</div>
				<div class="headerOpcionImpar" id="divUsuarios">Administración de usuarios</div>
				<div class="headerOpcionPar" id="divCerrarSesion">Cerrar sesión</div>
			</div>



			<div class="contenedorBody">

				<!--<form class="radio" action="" method="post">-->
				<label>Cuentas</label>
				<input type="radio" id="cuentas" name="opcion" value="c" checked="checked">
          	 	<label>Tarjetas</label>
           	 	<input type="radio" id="tarjetas" name="opcion" value="t">
				<!--</form>-->
				
				<div class="Alta">
					<form action="" method="post">

						<h2>Dar de alta</h2>

						
						<label>Seleccionar usuario: </label>
						<select name="cuenta" required="required" id="cuenta"> 
							<?php 
								foreach ($this->usuarios as $us){
									echo '<option value="' . $us['id_usuario'] . '">' . $us['id_login_usuario'] . ' ' . ' (' . $us['nombre'] . ' ' . $us['apellido'] . ')</option>';
								}

							 ?>
						</select>
						<br><br>

						<label>Seleccionar tipo de cuenta: </label>
						<select class="tipo_cuenta" name="tipo_cuenta" required="required"> 
							<?php 
								foreach ($this->tipoCuentas as $tc){
									echo '<option value="' . $tc['id_tipo_cuenta'] . '">' . $tc['desc_tipo_cuenta'] . '</option>';
								}

							 ?>


						</select>
						
						<br><br><br>

						<label>Ingresar saldo: </label>
						<input class="saldo" type="number" name="saldo" id="saldo" required="required" step="any">
						<br><br><br><br>

						<button class="enviar" type="submit">Confirmar</button>

						
					</form>
				</div>

				<div class="Modi">
					<h2>Modificar</h2>
					<label>Seleccionar cuenta: </label>
						<select name="cuenta" required="required" id="cuenta"> 
							<?php 
								foreach ($this->cuentas as $cu){
									echo '<option value="' . $cu['id_cuenta'] . '">' . $cu['tipo_cuenta'] . ' ' . $cu['nro_cuenta'] . ' (' . $cu['saldo'] . ')</option>';
								}

							 ?>
						</select>

					<br>

						<label>Ingresar saldo: </label>
						<input class="saldo" type="number" name="saldo" id="saldo" required="required" step="any">
						<br><br>

						<button class="enviar" type="submit">Confirmar</button>


				</div>

				<div class="Baja">
					<h2>Baja</h2>
					<label>Seleccionar cuenta: </label>
						<select name="cuenta" required="required" id="cuenta"> 
							<?php 
								foreach ($this->cuentas as $cu){
									echo '<option value="' . $cu['id_cuenta'] . '">' . $cu['tipo_cuenta'] . ' ' . $cu['nro_cuenta'] . ' (' . $cu['saldo'] . ')</option>';
								}

							 ?>
						</select>
					<br><br>

					<button class="enviar" type="submit">Eliminar</button>

				</div>

			</div>
		</div>

</body>
</html>