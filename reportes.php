<?php
include 'php/comprobacion_usuario.php';

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reportes</title>
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
    <script src="js/sweetalert2.min.js"></script>
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
                <i class="zmdi zmdi-accounts"></i>
            </div>
            <div class="full-width header-well-text">
                <p class="text-condensedLight">
                    En esta interfaz, puedes descargar informes con la información que necesitas al seleccionar fechas específicas. Esto te permite obtener datos precisos y personalizados según tus requerimientos.
                </p>
            </div>
        </section>
        <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
            <div class="mdl-tabs__tab-bar">
                <a href="#tabNewClient" class="mdl-tabs__tab is-active">REPORTES ORDEN DE TRABAJO</a>
                <a href="#tabListClient" class="mdl-tabs__tab">REPORTES MATERIALES</a>
            </div>
            <div class="mdl-tabs__panel is-active" id="tabNewClient">
                <div class="mdl-grid">
                    <!-- Primera fila con dos reportes -->
                    <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop mdl-cell--2-offset-desktop">
                        <div class="full-width panel mdl-shadow--2dp">
                            <div class="full-width panel-tittle bg-primary text-center tittles">
                                Reporte de Clientes
                            </div>
                            <div class="full-width panel-content">
                                <p>Descarga el reporte de clientes en formato Excel.</p>
                                <a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary" href="php/reporte/generar_reporte.php">Descargar Reporte</a>
                            </div>
                        </div>
                        <br>
                        <div class="full-width panel mdl-shadow--2dp">
                            <div class="full-width panel-tittle bg-primary text-center tittles">
                                Reporte Orden de Trabajo
                            </div>
                            <div class="full-width panel-content">
                                <p>Descarga el reporte de Orden de Trabajo en formato Excel.</p>
                                <form action="php/reporte/reporte_ot.php" method="post">
                                    <label for="fechaInicioOT">Fecha de Inicio:</label>
                                    <input type="date" id="fechaInicioOT" name="fechaInicioOT" required>
                                    <label for="fechaFinOT">Fecha de Fin:</label>
                                    <input type="date" id="fechaFinOT" name="fechaFinOT" required>
                                    <br>
                                    <br>
                                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary">Descargar Reporte</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mdl-tabs__panel" id="tabListClient">
                <div class="mdl-grid">
                    <!-- Primera fila con dos reportes -->
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="full-width panel mdl-shadow--2dp">
                            <div class="full-width panel-tittle bg-success text-center tittles">
                                Reporte de Materiales
                            </div>
                            <div class="full-width panel-content">
                                <p>Descarga el reporte de materiales en formato Excel.</p>
                                <a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary" href="php/reporte/generar_reporte_materiales.php">Descargar Reporte</a>
                            </div>
                        </div>
                        <br>
                        <div class="full-width panel mdl-shadow--2dp">
                            <div class="full-width panel-tittle bg-success text-center tittles">
                                Reporte de Entradas de Material
                            </div>
                            <div class="full-width panel-content">
                                <p>Descarga el reporte de Orden de Trabajo en formato Excel.</p>
                                <form action="php/reporte/generar_reporte_entradas.php" method="post">
                                    <label for="fechaInicioEntradas">Fecha de Inicio:</label>
                                    <input type="date" id="fechaInicioEntradas" name="fechaInicioEntradas" required>
                                    <label for="fechaFinEntradas">Fecha de Fin:</label>
                                    <input type="date" id="fechaFinEntradas" name="fechaFinEntradas" required>
                                    <br>
                                    <br>
                                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary">
                                    Descargar Reporte
                                    </button>
                                </form>
                            </div>
                        </div>
                        <br>
                        <div class="full-width panel mdl-shadow--2dp">
                            <div class="full-width panel-tittle bg-success text-center tittles">
                                Reporte de Salidas de Material
                            </div>
                            <div class="full-width panel-content">
                                <p>Descarga el reporte de salidas de material en formato Excel.</p>
                                <form action="php/reporte/generar_reporte_salidas.php" method="post">
                                    <label for="fechaInicioSalidas">Fecha de Inicio:</label>
                                    <input type="date" id="fechaInicioSalidas" name="fechaInicioSalidas" required>
                                    <label for="fechaFinSalidas">Fecha de Fin:</label>
                                    <input type="date" id="fechaFinSalidas" name="fechaFinSalidas" required>
                                    <br>
                                    <br>
                                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary">
                                    Descargar Reporte
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Segunda fila con dos reportes -->
                    <div class="mdl-cell mdl-cell--6-col">
                        <div class="full-width panel mdl-shadow--2dp">
                            <div class="full-width panel-tittle bg-success text-center tittles">
                                Reporte de Stock
                            </div>
                            <div class="full-width panel-content">
                                <p>Descarga el reporte de stock en formato Excel.</p>
                                <a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary" href="php/reporte/reporte_stock.php">Descargar Reporte</a>
                            </div>
                        </div>
                        <br>
                        <div class="full-width panel mdl-shadow--2dp">
                            <div class="full-width panel-tittle bg-success text-center tittles">
                                Reporte de Merma de Material
                            </div>
                            <div class="full-width panel-content">
                                <p>Descarga el reporte de merma de material en formato Excel.</p>
                                <form action="php/reporte/generar_reporte_merma.php" method="post">
                                    <label for="fechaInicioMerma">Fecha de Inicio:</label>
                                    <input type="date" id="fechaInicioMerma" name="fechaInicioMerma" required>

                                    <label for="fechaFinMerma">Fecha de Fin:</label>
                                    <input type="date" id="fechaFinMerma" name="fechaFinMerma" required>
                                    <br>
                                    <br>
                                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary">
                                    Descargar Reporte
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">

                        <div class="mdl-cell mdl-cell--6-col">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
</body>

</html>