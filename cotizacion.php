<?php
include 'php/comprobacion_login.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cotizacion</title>
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
                <i class="zmdi zmdi-balance"></i>
            </div>
            <div class="full-width header-well-text">
                <p class="text-condensedLight">
                    En este espacio, puedes generar cotizaciones basadas en las órdenes de trabajo previamente creadas.<br>
                    ¡Haz de la cotización un proceso eficiente y personalizado para cada proyecto!
                </p>
            </div>
        </section>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--9-col-desktop mdl-cell--1-offset-desktop">
                <div class="full-width panel mdl-shadow--2dp">
                    <div class="full-width panel-tittle bg-primary text-center tittles">
                        Nueva Salida
                    </div>
                    <div class="full-width panel-content">
                        <form>
                            <h5 style="text-align: center;">Información de la OT</h5>
                            <div class="mdl-grid">
                                <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                    <!-- Campos para la búsqueda de OT -->
                                    <div style="display: flex; align-items: flex-start;">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                            <input class="mdl-textfield__input" type="text" id="id_ot" name="id_ot">
                                            <label class="mdl-textfield__label" for="id_ot">Num. OT</label>
                                        </div>
                                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary" id="buscar-ot-btn" style="margin: 3%;">Buscar OT</button>
                                    </div>
                                </div>
                            </div>
                            <div class="mdl-grid">
                                <div class="mdl-grid">
                                    <!-- Campo RUN (solo lectura) -->
                                    <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                        <p>RUN: <br><strong>
                                            <div><span class="readonly-field" id="run"></span></div>
                                        </strong></p>
                                    </div>

                                    <!-- Campo Cliente (editable) -->
                                    <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                        <p>Cliente: <strong>
                                                <div class="editable-field" id="nombreCliente"></div>
                                            </strong></p>
                                    </div>

                                    <!-- Campo Apellido (editable) -->
                                    <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                        <p>Apellido: <strong>
                                                <div class="editable-field" id="apellidoCliente"></div>
                                            </strong></p>
                                    </div>

                                    <!-- Campo Dirección (editable) -->
                                    <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                        <p>Dirección: <strong>
                                                <div class="editable-field" id="direccionCliente"></div>
                                            </strong></p>
                                    </div>

                                    <!-- Campo Teléfono (editable) -->
                                    <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                        <p>Teléfono: <strong>
                                                <div class="editable-field" id="telefonoCliente"></div>
                                            </strong></p>
                                    </div>

                                    <!-- Campo Correo Electrónico (editable) -->
                                    <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                        <p>Correo Electrónico: <strong>
                                                <div class="editable-field" id="correoCliente"></div>
                                            </strong></p>
                                    </div>

                                    <!-- Campo Nombre Mueble (editable) -->
                                    <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                        <p>Nombre Mueble: <strong>
                                                <div class="editable-field" id="nombreMueble"></div>
                                            </strong></p>
                                    </div>

                                    <!-- Campo Categoría (editable) -->
                                    <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                        <p>Categoría: <strong>
                                                <div class="editable-field" id="nombreCategoria"></div>
                                            </strong></p>
                                    </div>

                                    <!-- Campos de Dimensiones separados -->
                                    <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                        <p>Ancho (cm): <strong>
                                                <div class="editable-field" id="ancho"></div>
                                            </strong></p>
                                    </div>
                                    <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                        <p>Alto (cm): <strong>
                                                <div class="editable-field" id="alto"></div>
                                            </strong></p>
                                    </div>
                                    <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                        <p>Largo (cm): <strong>
                                                <div class="editable-field" id="largo"></div>
                                            </strong></p>
                                    </div>

                                    <!-- Campo Especificaciones (editable) -->
                                    <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                        <p>Especificaciones: <strong>
                                                <div class="editable-field" id="especificaciones"></div>
                                            </strong></p>
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
                                                <th class="mdl-data-table__cell--numeric">Valor</th>
                                            </tr>
                                        </thead>
                                        <tbody id="materialesUtilizadosTableBody">
                                            <!-- Aquí se llenarán los datos de la tabla mediante JavaScript -->
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                <!-- Campo para ingresar el porcentaje y botón para calcular -->
                                <div style="text-align: center; margin-top: 20px;">
                                    <div class="mdl-textfield mdl-js-textfield">
                                        <input class="mdl-textfield__input" type="number" id="porcentajeManoObra">
                                        <label class="mdl-textfield__label" for="porcentajeManoObra">Porcentaje de Mano de Obra (%)</label>
                                    </div>
                                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary" type="button" onclick="calcularTotalConManoObra(event)">
                                        Calcular
                                    </button>
                                </div>

                                <div style="text-align: center; margin-top: 10px;">
                                    <p id="nuevoTotalConManoObra">Nuevo Total con Mano de Obra: $0</p>
                                </div>

                                <!-- Botón para entregar materiales -->
                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary" id="entregar-btn">
                                    Generar cotizacion
                                </button>
                            </div>
                            <!-- Información Enviada al PHP -->
                            <div id="mensaje"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="js/gestionCotizacion.js"></script>
</body>

</html>