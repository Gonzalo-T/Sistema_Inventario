<?php
include 'php/comprobacion_login.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Categories</title>
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

	<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
				<i class="zmdi zmdi-label"></i>
			</div>
			<div class="full-width header-well-text">
				<p class="text-condensedLight">
					Aquí puedes crear nuevos materiales y familias según tus necesidades, brindándote flexibilidad para gestionar y organizar tu inventario de manera eficiente.<br>
					¡Explora la libertad de construir y organizar tus recursos de la manera que mejor se adapte a tus requerimientos!
				</p>
			</div>
		</section>
		<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
			<div class="mdl-tabs__tab-bar">
				<a href="#tabNewCategory" class="mdl-tabs__tab is-active">CREAR MATERIAL</a>
				<a href="#tabListCategory" class="mdl-tabs__tab">VER MATERIALES</a>
				<a href="#tabNewEditar" class="mdl-tabs__tab">Editar</a>
				<a href="#tabNewFamilia" class="mdl-tabs__tab">FAMILIAS</a>
				<a href="#tabNewcategoriaMat" class="mdl-tabs__tab">Crear Categoria</a>
			</div>
			<div class="mdl-tabs__panel is-active" id="tabNewCategory">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--8-col-desktop mdl-cell--2-offset-desktop">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-tittle bg-primary text-center tittles">
								CREACION DE MATERIAL
							</div>
							<div class="full-width panel-content">
								<form id="formulario-crear-material">
									<h5 class="text-condensedLight"><strong>Nuevo Material</strong></h5>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="text" id="id_material" name="id_material">
										<label class="mdl-textfield__label" for="id_material">Código de Material</label>
									</div>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="text" id="nombre" name="nombre">
										<label class="mdl-textfield__label" for="nombre">Nombre Material</label>
										<span class="mdl-textfield__error">Nombre Inválido</span>
									</div>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="number" id="valor" name="valor">
										<label class="mdl-textfield__label" for="valor">Valor Material</label>
										<span class="mdl-textfield__error">Ingresa un número válido</span>
									</div>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<label for="nombre_familia">Familia:</label>
										<select id="nombre_familia" name="nombre_familia" required>
											<!-- Opciones de familia se llenarán dinámicamente -->
										</select>
									</div>
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="text" id="unidad" name="unidad">
										<label class="mdl-textfield__label" for="unidad">Unidad</label>
										<span class="mdl-textfield__error">Unidad Inválida</span>
									</div>
									<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary" id="guardar-material-btn">
										Guardar Material
									</button>

									<!-- Información Enviada al PHP -->
									<div id="mensaje"></div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="mdl-tabs__panel" id="tabListCategory">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--8-col-desktop mdl-cell--2-offset-desktop">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-tittle bg-primary text-center tittles">
								Listado de Materiales Existentes
							</div>
							<div class="full-width panel-content">
								<form action="formulario">

									<h5 class="text-condensedLight" style="font-size: 30px;"><strong>Materiales</strong></h5>
									<!-- Formulario de búsqueda -->
									<div class="mdl-cell mdl-cell--4-col">
										<div class="mdl-textfield mdl-js-textfield">
											<input class="mdl-textfield__input" type="text" id="busqueda-material">
											<label class="mdl-textfield__label" for="busqueda-material">Buscar por Código o Nombre...</label>
										</div>
									</div>
									<div class="mdl-cell mdl-cell--4-col">
										<button id="buscar-material-btn" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" style="margin: 3%;">
											Buscar
										</button>
									</div>
									<div class="full-width panel-content" style="text-align: center; overflow-x: auto;">
										<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="margin: 0 auto; width: 60%;">
											<thead>
												<tr>
													<th>Código Material</th>
													<th>Nombre Material</th>
													<th>Valor</th>
													<th>Familia</th>
													<th>Unidad de Medida</th>
												</tr>
											</thead>
											<tbody id="tabla-materiales-bodydos">
												<!-- Aquí se llenarán los datos de la tabla dinámicamente -->
											</tbody>
										</table>
									</div>
									<br>
									<div style="text-align: center;">
										<!-- Botones de paginación -->
										<button id="anterior-material-btn" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary">Anterior</button>
										<button id="siguiente-material-btn" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary">Siguiente</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="mdl-tabs__panel" id="tabNewEditar">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--8-col-desktop mdl-cell--2-offset-desktop">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-tittle bg-primary text-center tittles">
								EDITAR MATERIALES
							</div>
							<h5 class="text-condensedLight" style="font-size: 30px;"><strong>Editar</strong></h5>
							<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
								<!-- Campos para la búsqueda de OT -->
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="nombre_material" name="nombre_material">
									<label class="mdl-textfield__label" for="nombre_material">Buscar Material Por Nombre</label>
								</div>
								<div id="listaResultados" style="position: absolute; z-index: 1000; background: white; width: 300px;">
									<!-- Los resultados de búsqueda se mostrarán aquí -->
								</div>
								<div style="display: flex; align-items: flex-start;">
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="text" id="id_materialdos" name="id_materialdos">
										<label class="mdl-textfield__label" for="id_materialdos">Codigo del Material</label>
									</div>
									<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary" id="buscar-materialdos-btn" style="margin: 3%;">Buscar Material</button>
								</div>
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="nombredos" name="nombredos">
									<label class="mdl-textfield__label" for="nombredos">Nombre Material</label>
									<span class="mdl-textfield__error">Nombre Inválido</span>
								</div>
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="number" id="valordos" name="valordos">
									<label class="mdl-textfield__label" for="valordos">Valor Material</label>
									<span class="mdl-textfield__error">Ingresa un número válido</span>
								</div>
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<label for="nombre_familiados">Familia:</label>
									<select id="nombre_familiados" name="nombre_familiados" required>
										<!-- Opciones de familia se llenarán dinámicamente -->
									</select>
								</div>
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="unidaddos" name="unidaddos">
									<label class="mdl-textfield__label" for="unidaddos">Unidad</label>
									<span class="mdl-textfield__error">Unidad Inválida</span>
								</div>
								<div style="text-align: center;">
									<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary" id="editar-materialdos-btn">
										Guardar cambios
									</button>
								</div>
								<br>
								<br>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="mdl-tabs__panel " id="tabNewFamilia">
				<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--8-col-desktop mdl-cell--2-offset-desktop">
					<div class="full-width panel mdl-shadow--2dp">
						<div class="full-width panel-tittle bg-primary text-center tittles">
							Creacion de Familias
						</div>
						<div class="mdl-grid">
							<h5 class="text-condensedLight"><strong>Nueva Familia</strong></h5>
							<div class="full-width panel-content">
								<form id="formulario-crear-familia">
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="text" id="nom_familia" name="nom_familia">
										<label class="mdl-textfield__label" for="nom_familia">Nombre de la
											Familia</label>
									</div>
									<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary" id="guardar-familia-btn">
										Guardar Familia
									</button>
									<br>
									<br>
									<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="text-align: center;">
										<thead>
											<tr>
												<th>Código familia</th>
												<th>Nombre familia</th>
												<th>Acciones</th>
											</tr>
										</thead>
										<tbody class="text-condensedLight" id="tabla-familia-body">
											<!-- Aquí se llenarán los datos de la tabla dinámicamente -->
										</tbody>
									</table>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="mdl-tabs__panel " id="tabNewcategoriaMat">
				<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--8-col-desktop mdl-cell--2-offset-desktop">
					<div class="full-width panel mdl-shadow--2dp">
						<div class="full-width panel-tittle bg-primary text-center tittles">
							Creación de Categorías
						</div>
						<div class="mdl-grid">
							<h5 class="text-condensedLight"><strong>Nueva Categoría</strong></h5>
							<div class="full-width panel-content">
								<form id="formulario-crear-categoria">
									<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
										<input class="mdl-textfield__input" type="text" id="nombre_categoria">
										<label class="mdl-textfield__label" for="nombre_categoria">Nombre de la Categoría</label>
									</div>
									<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary" id="guardar-categoria-btn">
										Guardar Categoría
									</button>
								</form>
								<br>
								<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="text-align: center;">
									<thead>
										<tr>
											<th>Código Categoría</th>
											<th>Nombre Categoría</th>
											<th>Acciones</th>
										</tr>
									</thead>
									<tbody id="tabla-categoria-body">
										<!-- Aquí se llenarán los datos de la tabla dinámicamente -->
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</section>
	<script src="js/gestionMateriales.js"></script>
</body>

</html>