<?php
include 'php/comprobacion_login.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ingreso de Materiales</title>
	<link rel="website icon" type="png" href="assets/icons/icon.barra.png">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/material.min.css">
	<link rel="stylesheet" href="css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
	<link rel="stylesheet" href="css/main.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>
		window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')
	</script>
	<script src="js/material.min.js"></script>
	<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="js/main.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="js/nuevoIngresoMaterialScript.js"></script>


</head>

<body>
	<!-- navBar -->
	<div class="full-width navBar">
		<div class="full-width navBar-options">
			<i class="zmdi zmdi-long-arrow-left btn-menu rotate-icon" id="btn-menu" style="margin: 1%; font-size: 24px;"></i>
			<div class="mdl-tooltip" for="btn-menu">Menu</div>
			<nav class="navBar-options-list">
				<ul class="list-unstyle">
					<li class="btn-exit" id="btn-exit">
						<i class="zmdi zmdi-power"></i>
						<div class="mdl-tooltip" for="btn-exit">Cerrar Sesion</div>
					</li>
					<?php echo htmlspecialchars($nombreCompleto); ?>
					<li class="noLink">
						<figure>
							<img src="assets/img/avatar-male.png" alt="Avatar" class="img-responsive">
						</figure>
					</li>
				</ul>
			</nav>
		</div>
	</div>


	<!-- navLateral -->
	<section class="full-width navLateral">
		<div class="full-width navLateral-bg btn-menu"></div>
		<div class="full-width navLateral-body">
			<div class="full-width navLateral-body-logo text-center tittles">
				<i class="zmdi zmdi-close btn-menu"></i> MuebleTech
			</div>
			<!-- Sección del nombre y rol del usuario -->
			<figure class="full-width" style="height: 77px;">
				<div class="navLateral-body-cl">
					<img src="assets/img/avatar-male.png" alt="Avatar" class="img-responsive">
				</div>
				<figcaption class="navLateral-body-cr hide-on-tablet">
					<span>
						<?php echo htmlspecialchars($nombreCompleto); ?>
						<br>
						<small><?php echo htmlspecialchars($rol); ?></small>
					</span>
				</figcaption>
			</figure>
			<div class="full-width tittles navLateral-body-tittle-menu">
				<i class="zmdi zmdi-desktop-mac"></i><span class="hide-on-tablet">&nbsp; Tablero</span>
			</div>
			<nav class="full-width">
				<ul class="full-width list-unstyle menu-principal">
					<li class="full-width">
						<a href="home.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-view-dashboard mover"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								HOME
							</div>
						</a>
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="#!" class="full-width btn-subMenu">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-washing-machine mover"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								ORDENES DE TRABAJO
							</div>
							<span class="zmdi zmdi-chevron-left"></span>
						</a>
						<ul class="full-width menu-principal sub-menu-options">
							<li class="full-width">
								<a href="crear_ot.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-accounts mover"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										CREACION DE OT
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="editar.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi material-symbols-outlined mover"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										EDITAR OT
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="asignacion_material.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-store mover"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										ASIGNACION DE MATERIAL
									</div>
								</a>
							</li>
						</ul>
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="#!" class="full-width btn-subMenu">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-store mover"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								INVENTARIO
							</div>
							<span class="zmdi zmdi-chevron-left"></span>
						</a>
						<ul class="full-width menu-principal sub-menu-options">
							<li class="full-width">
								<a href="Salida.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-truck mover"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										SALIDA DE MATERIAL
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="Ingreso.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-truck reverso mover"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										INGRESO DE MATERIAL
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="stock.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-widgets"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										STOCK
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="crear.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-label mover"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										CREAR MATERIAL - FAMILIA
									</div>
								</a>
							</li>
						</ul>
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="cotizacion.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-shopping-cart mover"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								COTIZACION
							</div>
						</a>
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="Solicitud_compra.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-balance mover"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								SOLICITUD DE COMPRA
							</div>
						</a>
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="#!" class="full-width btn-subMenu">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-face mover"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								ADMINISTRADOR
							</div>
							<span class="zmdi zmdi-chevron-left"></span>
						</a>
						<ul class="full-width menu-principal sub-menu-options">
							<li class="full-width">
								<a href="admin.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-account mover"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										NUEVO USUARIO
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="reportes.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-label mover"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										REPORTES
									</div>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
		</div>
	</section>
	<!-- pageContent -->
	<section class="full-width pageContent">
		<section class="full-width header-well">
			<div class="full-width header-well-icon">
				<i class="zmdi zmdi-truck reverso"></i>
			</div>
			<div class="full-width header-well-text">
				<p class="text-condensedLight" style="width: 90%;">
					Aquí se realizarán las asignaciones y salidas de materiales para cada orden de trabajo
					correspondiente.
				</p>
			</div>
		</section>
		<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
			<div class="mdl-tabs__tab-bar">
				<a href="#tabNewIngreso" class="mdl-tabs__tab is-active">NUEVO</a>
				<!-- <a href="#tabListIngreso" class="mdl-tabs__tab">HISTORICO</a> -->
			</div>
			<div class="mdl-tabs__panel is-active" id="tabNewIngreso">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--8-col-desktop mdl-cell--2-offset-desktop">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-tittle bg-primary text-center tittles">
								Nuevo Ingreso de Material
							</div>
							<div class="full-width panel-content">
								<form id="formulario-movimiento-material">
									<div class="mdl-grid">
										<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
											<!-- Campos para la búsqueda de Codigo de Material -->
											<div style="display: flex; align-items: flex-start;">
												<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
													<input class="mdl-textfield__input" type="text" id="id_material" name="id_material">
													<label class="mdl-textfield__label" for="id_material">Codigo de Material</label>
												</div>
												<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary" id="buscar-material-btn" style="margin: 3%;">Buscar Material</button>
											</div>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="text" id="nombre_material" name="nombre_material">
												<label class="mdl-textfield__label" for="nombre_material">Nombre del Material</label>
											</div>
											<div id="listaResultados" style="position: absolute; z-index: 1000; background: white; width: 300px;">
												<!-- Los resultados de búsqueda se mostrarán aquí -->
											</div>
										</div>
										<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="text" id="numero_factura" name="numero_factura">
												<label class="mdl-textfield__label" for="numero_factura">Número de Factura</label>
												<span class="mdl-textfield__error">Por favor, ingrese un dato valido</span>
											</div>
										</div>
									</div>
									<!-- Campos para visualizar informacion -->
									<div class="mdl-grid">
										<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
											<p>Nombre: <strong><span id="nombreMaterial" contenteditable="true"></strong></span> </p>
										</div>
										<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
											<p>Valor: <strong><span id="valorMaterial" contenteditable="true"></strong></span></p>
										</div>
										<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
											<p>Unidad de Medida: <strong><span id="unidadMedida" contenteditable="true"></strong></span></p>
										</div>
									</div>

									<!-- Otros campos del formulario -->
									<div class="mdl-grid">
										<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="number" step="1" id="cantidad" name="cantidad">
												<label class="mdl-textfield__label" for="cantidad">Cantidad</label>
												<span class="mdl-textfield__error">Por favor, ingrese un número entero.</span>
											</div>
										</div>
										<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="text" id="descripcion" name="descripcion">
												<label class="mdl-textfield__label" for="descripcion">Descripción</label>
											</div>
										</div>
									</div>
									<div class="mdl-grid">
										<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
											<!-- Botón para agregar más materiales -->
											<button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary" id="agregar-material-btn">
												Agregar Material
											</button>
										</div>
									</div>
									<!-- Tabla para mostrar los materiales agregados -->
									<h4 style="text-align: center;">Materiales Agregados</h4>
									<div style="text-align: center; overflow-x: auto;">
										<table border="1" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" id="materiales-table" style="margin: 0 auto; width: 60%;">
											<thead>
												<tr>
													<th style="text-align: center;">Código de Material</th>
													<th style="text-align: center;">Nombre</th>
													<th style="text-align: center;">Cantidad</th>
													<th style="text-align: center;">Acciones</th>
												</tr>
											</thead>
											<tbody>
												<!-- Aquí se llenarán los materiales agregados dinámicamente -->
											</tbody>
										</table>
									</div>
									<br>
									<!-- Botón para guardar el movimiento -->
									<div style="text-align: center;">
										<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary" id="guardar-movimiento-btn">
											Guardar Movimiento
										</button>
									</div>
									<!-- Información Enviada al PHP -->
									<div id="mensaje"></div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


</body>


</html>