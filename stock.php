<?php
include 'php/comprobacion_login.php';
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stock</title>
    <link rel="website icon" type="png" href="assets/icons/icon.barra.png">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/material.min.css">
    <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')
    </script>
    <script src="js/material.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/gestionStockScript.js"></script>


    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .mdl-textfield__input {
            color: #000;
            /* O cualquier otro color oscuro que prefieras */
        }
    </style>

    <style>
        /* Estilo para simular texto ingresado manualmente */
        .mdl-textfield__input.loaded,
        .mdl-select__input.loaded {
            color: #000;
            /* Cambia el color a negro o cualquier color que desees */
            opacity: 1;
            /* Asegúrate de que el texto no esté atenuado */
        }
    </style>

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
                <i class="zmdi zmdi-widgets"></i>
            </div>
            <div class="full-width header-well-text">
                <p class="text-condensedLight">
                    Aquí puedes consultar el stock real de tus materiales e insumos a través del sistema, obteniendo información actualizada sobre la disponibilidad de tus recursos.
                </p>
            </div>
        </section>
        <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
            <div class="mdl-tabs__tab-bar">
                <!-- <a href="#tabNewProduct" class="mdl-tabs__tab is-active">NUEVO</a> -->
            </div>
            <div class="mdl-tabs__panel is-active" id="tabNewProduct">
                <div class="mdl-grid">
                    <div class="full-width panel-content">
                        <form id="formulario-primer-contacto">
                            <div class="mdl-grid">
                                <div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--2-offset-desktop" id="tabListProducts">
                                    <div class="full-width panel mdl-shadow--2dp">
                                        <div class="full-width panel-tittle bg-primary text-center tittles">
                                            STOCK
                                        </div>
                                        <div class="full-width panel-content" style="text-align: center; overflow-x: auto;">
                                            <!-- Formulario de búsqueda -->
                                            <div class="mdl-grid">
                                                <div class="mdl-cell mdl-cell--4-col">
                                                    <div class="mdl-textfield mdl-js-textfield">
                                                        <input class="mdl-textfield__input" type="text" id="busqueda">
                                                        <label class="mdl-textfield__label" for="busqueda">Buscar por Código o Nombre...</label>
                                                    </div>
                                                </div>
                                                <div class="mdl-cell mdl-cell--4-col">
                                                    <button id="buscar-btn" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" style="margin: 3%;">
                                                        Buscar
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- Tabla de stock -->
                                            <table id="tabla-stock" style="margin: 0 auto; width: 70%;">
                                                <thead>
                                                    <tr>
                                                        <th>Código Material</th>
                                                        <th>Nombre</th>
                                                        <th>Familia</th>
                                                        <th>Stock</th>
                                                        <th>Unidad de Medida</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody-stock">
                                                    <!-- Los datos se cargarán aquí mediante JS -->
                                                </tbody>
                                            </table>
                                            <br>
                                            <div>
                                                <button id="anterior-btn" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary">Anterior</button>
                                                <button id="siguiente-btn" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary">Siguiente</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="mensaje"></div>
        </div>
    </section>

</body>

</html>