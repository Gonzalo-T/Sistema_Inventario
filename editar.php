<?php
include 'php/comprobacion_login.php';
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar OT</title>
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
    <script src="js/editarOTScript.js"></script>



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
                <i class="zmdi material-symbols-outlined" style="margin: 1%;"></i>
            </div>
            <div class="full-width header-well-text">
                <p class="text-condensedLight parrafo" style="width: 90%;">
                    En este espacio, tienes la capacidad de editar toda la información relacionada con la orden de trabajo, incluyendo los materiales asignados, entre otros aspectos. <br>¡Tu control total está a solo unos clics de distancia!<br>
                </p>
            </div>
        </section>
        <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
            <div class="mdl-tabs__tab-bar">
                <!-- <a href="#tabNewProvider" class="mdl-tabs__tab is-active"></a> -->
                <!-- <a href="#tabListProvider" class="mdl-tabs__tab">HISTORICO</a> -->
            </div>
            <div class="mdl-tabs__panel is-active" id="tabNewProvider">
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--9-col-desktop mdl-cell--1-offset-desktop">
                        <div class="full-width panel mdl-shadow--2dp">
                            <div class="full-width panel-tittle bg-primary text-center tittles">
                                Editar OT
                            </div>
                            <div class="full-width panel-content">
                                <form>
                                    <h5 style="text-align: center;">Información de la OT</h5>
                                    <div class="mdl-grid">
                                        <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                            <!-- Campos para la búsqueda de OT -->
                                            <div style="display: flex; align-items: flex-start;">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                    <input class="mdl-textfield__input" type="text" pattern="^[0-9]+$" id="id_ot" name="id_ot">
                                                    <label class="mdl-textfield__label" for="id_ot">Num. OT</label>
                                                    <span class="mdl-textfield__error">Ingrese solo números</span>
                                                </div>
                                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary" id="buscar-ot-btn" style="margin: 3%;">Buscar OT</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mdl-grid">
                                        <div class="mdl-grid">
                                            <!-- Campo RUN (solo lectura) -->
                                            <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                                <p>RUN: <br><strong><span class="readonly-field" id="run"></span></strong></p>
                                            </div>

                                            <!-- Campo Cliente (editable) -->
                                            <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                                <p>Nombre Cliente: <strong>
                                                        <div class="editable-field" contenteditable="true" id="nombreCliente" oninput="validarSoloLetras(this)"></div>
                                                    </strong></p>
                                            </div>

                                            <!-- Campo Apellido (editable) -->
                                            <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                                <p>Apellido: <strong>
                                                        <div class="editable-field" contenteditable="true" id="apellidoCliente" oninput="validarSoloLetras(this)"></div>
                                                    </strong></p>
                                            </div>

                                            <!-- Campo Dirección (editable) -->
                                            <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                                <p>Dirección: <strong>
                                                        <div class="editable-field" contenteditable="true" id="direccionCliente"></div>
                                                    </strong></p>
                                            </div>

                                            <!-- Campo Teléfono (editable) -->
                                            <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                                <p>Teléfono: <strong>
                                                        <div class="editable-field" contenteditable="true" id="telefonoCliente"></div>
                                                    </strong></p>
                                            </div>

                                            <!-- Campo Correo Electrónico (editable) -->
                                            <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                                <p>Correo Electrónico: <strong>
                                                        <div class="editable-field" contenteditable="true" id="correoCliente"></div>
                                                    </strong></p>
                                            </div>

                                            <!-- Campo Nombre Mueble (editable) -->
                                            <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                                <p>Nombre Mueble: <strong>
                                                        <div class="editable-field" contenteditable="true" id="nombreMueble"></div>
                                                    </strong></p>
                                            </div>

                                            <!-- Campo Categoría (editable) -->
                                            <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                                <p>Categoría: <strong>
                                                        <div class="editable-field" contenteditable="true" id="nombreCategoria"></div>
                                                    </strong></p>
                                            </div>

                                            <!-- Campos de Dimensiones separados -->
                                            <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                                <p>Ancho (cm): <strong>
                                                        <div class="editable-field" contenteditable="true" id="ancho"></div>
                                                    </strong></p>
                                            </div>
                                            <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                                <p>Alto (cm): <strong>
                                                        <div class="editable-field" contenteditable="true" id="alto"></div>
                                                    </strong></p>
                                            </div>
                                            <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                                <p>Largo (cm): <strong>
                                                        <div class="editable-field" contenteditable="true" id="largo"></div>
                                                    </strong></p>
                                            </div>

                                            <!-- Campo Especificaciones (editable) -->
                                            <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                                <p>Especificaciones: <strong>
                                                        <div class="editable-field" contenteditable="true" id="especificaciones"></div>
                                                    </strong></p>
                                            </div>
                                        </div>
                                    </div>
                                    <p style="text-align: center;">
                                        *************************************************************************************************************
                                    </p>

                                    <div class="mdl-grid">
                                        <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                            <!-- Campos para la búsqueda de OT -->
                                            <div style="display: flex; align-items: flex-start;">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                    <input class="mdl-textfield__input" type="number" id="id_material" name="id_material">
                                                    <label class="mdl-textfield__label" for="id_material">Codigo de Material</label>
                                                    <span class="mdl-textfield__error" id="error-id-material">Ingrese solo números</span>
                                                </div>
                                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary" id="buscar-material-btn" style="margin: 3%;">Buscar Material
                                                </button>
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
                                            <p>Nombre: <strong><span id="nombreMaterial" style="font-size: 17px;"></strong></span>
                                            </p>
                                        </div>
                                        <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                            <p>Valor: <strong><span id="valorMaterial" style="font-size: 17px;"></strong></span></p>
                                        </div>
                                        <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                            <p>Unidad de Medida: <strong><span id="unidadMedida" style="font-size: 17px;"></strong></span></p>
                                        </div>
                                    </div>
                                    <div class="mdl-grid">
                                        <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                            <div class="material-info" style="display: flex; align-items: flex-start;">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                    <input class="mdl-textfield__input" type="text" pattern="^\d+(,\d{1})?$" id="cantidad" name="cantidad" step="0.1">
                                                    <label class="mdl-textfield__label" for="cantidad">Cantidad</label>
                                                    <span class="mdl-textfield__error" id="error-cantidad">Por favor, ingrese un número entero o con un decimal.</span>
                                                </div>
                                                <!-- Botón para Agregar Material -->
                                                <div class="agregar-material" style="margin-left: 10px;">
                                                    <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary" id="agregar-material-btn" style="margin: 3%;">Agregar Material</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p style="text-align: center;">
                                        *************************************************************************************************************
                                    </p>
                                    <div style="text-align: center;">
                                        <h5>Materiales Utilizados:</h5>
                                        <div style="text-align: center; overflow-x: auto;">
                                            <table border="1" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" id="materiales-table" style="margin: 0 auto; width: 60%;">
                                                <thead>
                                                    <tr>
                                                        <th class="mdl-data-table__cell--numeric">Código Material</th>
                                                        <th class="mdl-data-table__cell--numeric">Nombre Material</th>
                                                        <th class="mdl-data-table__cell--numeric">Cantidad Utilizada</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="materialesUtilizadosTableBody">
                                                    <!-- Aquí se llenarán los datos de la tabla mediante JavaScript -->
                                                </tbody>
                                            </table>
                                        </div>
                                        <br>
                                        <!-- Botón para entregar materiales -->
                                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary" id="entregar-btn">
                                            Guardar Cambios
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