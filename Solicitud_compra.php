<?php
include 'php/comprobacion_login.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Solicitud de Compra</title>
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
    <script src="js/nuevaSolicitudScript.js"></script>

</head>

<body>

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
                        <li class="text-condensedLight noLink"><small><?php echo htmlspecialchars($nombreCompleto); ?></small></li>
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
                    <i class="zmdi zmdi-shopping-cart"></i>
                </div>
                <div class="full-width header-well-text">
                    <p class="text-condensedLight" style="width: 90%;">
                        En este sitio o página, puedes realizar solicitudes de compra de materiales que se encuentren bajo en stock o que sean necesarios para algún proyecto.
                    </p>
                </div>
            </section>
            <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
                <div class="mdl-tabs__tab-bar">
                    <a href="#tabNewProvider" class="mdl-tabs__tab is-active">SOLICITUD DE COMPRA</a>
                </div>
                <div class="mdl-tabs__panel is-active" id="tabNewProvider">
                    <div class="mdl-grid">
                        <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--9-col-desktop mdl-cell--1-offset-desktop">
                            <div class="full-width panel mdl-shadow--2dp">
                                <div class="full-width panel-tittle bg-primary text-center tittles">
                                    Nueva Solicitud
                                </div>
                                <div class="full-width panel-content">
                                    <form>
                                        <div class="full-width panel-content">
                                            <form id="formulario-movimiento-material">
                                                <div class="mdl-grid">
                                                    <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                                        <!-- Campos para la búsqueda de OT -->
                                                        <div style="display: flex; align-items: flex-start;">
                                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                                <input class="mdl-textfield__input" type="text" id="id_material" name="id_material">
                                                                <label class="mdl-textfield__label" for="id_material">Codigo de Material</label>
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
                                                        <p>Nombre: <strong><u><span id="nombreMaterial" style="font-size: 17px;"></u></strong></span>
                                                        </p>
                                                    </div>
                                                    <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                                        <p>Valor: <strong><u><span id="valorMaterial" style="font-size: 17px;"></u></strong></span></p>
                                                    </div>
                                                </div>
                                                <div class="mdl-grid">
                                                    <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                                        <p>Unidad de Medida: <strong><u><span id="unidadMedida" style="font-size: 17px;"></u></strong></span></p>
                                                    </div>
                                                </div>
                                                <!-- agregar material -->
                                                <div class="mdl-grid">
                                                    <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                                        <!-- Campos para la búsqueda de OT -->
                                                        <div style="display: flex; align-items: flex-start;">
                                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                                <input class="mdl-textfield__input" type="number" id="cantidad" name="cantidad" min="0" step="1" oninput="validarNumero(this)">
                                                                <label class="mdl-textfield__label" for="cantidad">Cantidad</label>
                                                            </div>
                                                            <script>
                                                                function validarNumero(input) {
                                                                    // Eliminar cualquier carácter que no sea un dígito
                                                                    input.value = input.value.replace(/\D/g, '');

                                                                    // Asegurarse de que el valor sea un número entero
                                                                    if (input.value < 0) {
                                                                        input.value = 0;
                                                                    }
                                                                }
                                                            </script>
                                                            <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored  bg-primary" id="agregar-material-btn" style="margin: 3%;">Agregar Material
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p style="text-align: center;">
                                                    *************************************************************************************************************
                                                </p>
                                                <div style="text-align: center;">
                                                    <div style="text-align: center; overflow-x: auto;">
                                                        <h5 class="text-condensedLight"><strong>Materiales Solicitados</strong></h5>
                                                        <table border="1" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" id="materiales-table" style="margin: 0 auto; width: 60%;">
                                                            <thead style="text-align: center;">
                                                                <tr>
                                                                    <th style="font-size: 13px; text-align: center;">Código Material</th>
                                                                    <th style="font-size: 13px; text-align: center;">Nombre Material</th>
                                                                    <th style="font-size: 13px; text-align: center;">Cantidad Solicitada</th>
                                                                    <th style="text-align: center;">Unidad</th>
                                                                    <th style="text-align: center;">Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="materialesUtilizadosTableBody">
                                                                <!-- Aquí se llenarán los datos de la tabla mediante JavaScript -->
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                        <textarea class="mdl-textfield__input" type="text" id="descripcion" name="descripcion"></textarea>
                                                        <label class="mdl-textfield__label" for="descripcion">Descripción</label>
                                                    </div>

                                                    <!-- Botón para entregar materiales -->
                                                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary" id="guardar-movimiento-btn">
                                                        Guardar Solicitud
                                                    </button>
                                                </div>

                                                <!-- Información Enviada al PHP -->
                                                <div id="mensaje"></div>
                                            </form>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </body>

</html>