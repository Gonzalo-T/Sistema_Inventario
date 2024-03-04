<?php
session_start(); // Inicia la sesión PHP

// Comprueba si el usuario está logueado
if (!isset($_SESSION['usuario_logueado'])) {
	header('Location: index.php'); // Redirige al usuario al inicio de sesión si no está logueado
	exit; // Termina la ejecución del script
}
include 'php/info.php';
?>


<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Asignacion de Material</title>
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
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
	<script>
		document.getElementById('btn-exit').addEventListener('click', function() {
			Swal.fire({
				title: '¿Estás seguro?',
				text: "¿Deseas cerrar la sesión?",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Sí, cerrar sesión',
				cancelButtonText: 'No'
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = 'php/logout.php'; // Redirige a logout.php si el usuario confirma
				}
			});
		});

		var rotateIcon = document.getElementById('btn-menu');

		rotateIcon.addEventListener('click', function() {
			this.classList.toggle('rotate180');
		});
	</script>
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
				<i class="zmdi zmdi-truck"></i>
			</div>
			<div class="full-width header-well-text">
				<p class="text-condensedLight">
					Aquí se realizarán las asignaciones de materiales necesarios para cada orden de trabajo segun
					corresponda.
				</p>
			</div>
		</section>
		<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
			<div class="mdl-tabs__tab-bar"></div>
			<div class="mdl-tabs__panel is-active" id="tabNewIngreso">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--8-col-desktop mdl-cell--2-offset-desktop">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-tittle bg-primary text-center tittles">
								Asignacion de Materiales
							</div>
							<div class="full-width panel-content">
								<form id="formulario-movimiento-material">
									<div class="mdl-grid">
										<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
											<!-- Campos para la búsqueda de OT -->
											<div style="display: flex; align-items: flex-start;">
												<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
													<input class="mdl-textfield__input" type="number" pattern="^[0-9]+$" id="id_ot" name="id_ot">
													<label class="mdl-textfield__label" for="id_ot">Num. OT</label>
													<span class="mdl-textfield__error">Ingrese solo números</span>
													
												</div>
												<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary" id="buscar-ot-btn" style="margin: 3%;">Buscar OT</button>
											</div>
										</div>
										
									</div>
									<div class="mdl-grid">
										<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
											<p>Nombre Mueble: <strong><u><span id="nombrelMueble" style="font-size: 17px;"></u></strong></span></p>
										</div>
										<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
											<p>Nombre Cliente: <strong><u><span id="nombreCliente" style="font-size: 17px;"></u></strong></span></p>
										</div>
									</div>
									<p style="text-align: center;">
										*************************************************************************************************************
									</p>
									<h5 class="text-condensedLight" style="text-align: center;"><strong>Detalle de la
											Asignacion</strong></h5>
									<div class="mdl-grid">
										<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
											<!-- Campos para la búsqueda de OT -->
											<div style="display: flex; align-items: flex-start;">
												<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
													<input class="mdl-textfield__input" type="text" id="id_material" name="id_material">
													<label class="mdl-textfield__label" for="id_material">Codigo del Material</label>
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
										
									</div>
									<div class="mdl-grid">
										<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
											<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
												<p>Material: <strong><u><span id="nombreMaterial" style="font-size: 16px;"></u></strong></span></p>
											</div>
											<div class="mdl-cell mdl-cell--12-col-tablet mdl-cell--12-col-desktop">
												<div style="display: flex;">
													<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="flex: 1;">
														<input class="mdl-textfield__input" type="number" step="1" id="cantidad" name="cantidad">
														<label class="mdl-textfield__label" for="cantidad">Cantidad</label>
														<span class="mdl-textfield__error">Por favor, ingrese un número
															entero.</span>
													</div>
													<button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary" id="agregar-material-btn" style="margin: 3%;">Agregar</button>
												</div>
											</div>
										</div>
										<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
											<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
												<p>Unidad de Medida: <strong><u><span id="unidadMedida" style="font-size: 15px;"></u></strong></span></p>
											</div>
										</div>
									</div>
									<p><span id="unidadMedida"></span></p>
									<p style="text-align: center;">
										*************************************************************************************************************
									</p>
									<!-- Tabla para mostrar los materiales agregados -->
									<div style="text-align: center;">
										<h5 class="text-condensedLight"><strong>Materiales Agregados</strong></h5>
										<div style="overflow-x: auto;">
											<table border="1" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" id="materiales-table" style="margin: 0 auto; width: 60%;">
												<thead style="text-align: center;">
													<tr>
														<th style="font-size: 13px;">Código de Material</th>
														<th style="font-size: 13px;">Nombre</th>
														<th style="font-size: 13px;">Unidad</th>
														<th style="font-size: 13px;">Cantidad</th>
														<th style="text-align: center;">Acciones</th>
													</tr>
												</thead>
												<tbody id="materialesUtilizadosTableBody">
													<!-- Aquí se llenarán los datos de la tabla mediante JavaScript -->
												</tbody>
											</table>
										</div>
										<br>
										<!-- Botón para guardar el movimiento -->
										<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary" id="guardar-movimiento-btn">
											Guardar
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

		
		
<script src="js/asignacionMateriales.js"></script>

</body>

</html>