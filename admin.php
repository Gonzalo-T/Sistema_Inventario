<?php
include 'php/comprobacion_usuario.php';

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrators</title>
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

    <style>
        .container-permisos {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .permisos-asignados,
        .permisos-disponibles {
            flex-grow: 1;
            margin: 10px;
        }

        .lista-permisos {
            height: 200px;
            overflow-y: auto;
            border: 1px solid #ccc;
        }

        .botones-permisos {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
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
                <i class="zmdi zmdi-account"></i>
            </div>
            <div class="full-width header-well-text">
                <p class="text-condensedLight" style="width: 90%;">
                    En esta interfaz, tienes la capacidad de crear usuarios, asignar roles y revisar el listado de usuarios existentes. Además, puedes editar la información de aquellos que ya han sido creados. <br>Queremos brindarte un control total sobre la gestión de usuarios.
                </p>
            </div>
        </section>
        <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
            <div class="mdl-tabs__tab-bar">
                <a href="#tabNewAdmin" class="mdl-tabs__tab is-active">USUARIO</a>
                <a href="#tabListAdmin" class="mdl-tabs__tab">LISTA DE USUARIOS</a>
                <a href="#tabEditAdmin" class="mdl-tabs__tab">EDITAR USUARIO</a>
            </div>
            <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
                <div class="mdl-tabs__panel is-active" id="tabNewAdmin">
                    <div class="mdl-grid">
                        <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--10-col-desktop mdl-cell--1-offset-desktop">
                            <div class="full-width panel mdl-shadow--2dp">
                                <div class="full-width panel-tittle bg-primary text-center tittles">
                                    Nuevo Usuario
                                </div>
                                <div class="full-width panel-content">
                                    <form id="formulario-crear-usuario">
                                        <div class="mdl-grid">
                                            <div class="mdl-cell mdl-cell--6-col-desktop">
                                                <h5 class="text-condensedLight"><strong>Datos del Usuario</strong></h5>
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                    <input class="mdl-textfield__input" type="text" id="DNIAdmin">
                                                    <label class="mdl-textfield__label" for="DNIAdmin">RUN</label>
                                                    <span class="mdl-textfield__error">RUN Invalido</span>
                                                </div>
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                    <input class="mdl-textfield__input" type="text" id="NameAdmin">
                                                    <label class="mdl-textfield__label" for="NameAdmin">Nombre usuario</label>
                                                    <span class="mdl-textfield__error">Nombre Invalido</span>
                                                </div>
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                    <input class="mdl-textfield__input" type="text" id="LastNameAdmin">
                                                    <label class="mdl-textfield__label" for="LastNameAdmin">Apellido usuario</label>
                                                    <span class="mdl-textfield__error">Apellido Invalido</span>
                                                </div>
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                    <input class="mdl-textfield__input" type="text" id="CargoAdmin">
                                                    <label class="mdl-textfield__label" for="CargoAdmin">Cargo</label>
                                                    <span class="mdl-textfield__error">Cargo Invalido</span>
                                                </div>
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                    <input class="mdl-textfield__input" type="password" id="passwordAdmin">
                                                    <label class="mdl-textfield__label" for="passwordAdmin">Contraseña</label>
                                                    <span class="mdl-textfield__error">Contraseña Invalida</span>
                                                </div>
                                            </div>
                                            <div class="mdl-cell mdl-cell--6-col-desktop">
                                                <h5 class="text-condensedLight"><strong>Permisos</strong></h5>
                                                <div class="container-permisos">
                                                    <div class="permisos-disponibles">
                                                        <h6>Roles Disponibles</h6>
                                                        <select multiple id="lista-permisos-disponibles" class="lista-permisos">
                                                            <!-- Las opciones de permisos se cargarán aquí -->
                                                        </select>
                                                    </div>
                                                    <div class="botones-permisos">
                                                        <button type="button" id="btn-agregar-permiso">&gt;</button>
                                                        <button type="button" id="btn-quitar-permiso">&lt;</button>
                                                    </div>
                                                    <div class="permisos-asignados">
                                                        <h6>Roles Asignados</h6>
                                                        <select multiple id="lista-permisos-asignados" class="lista-permisos">
                                                            <!-- Lista de permisos asignados -->
                                                        </select>
                                                    </div>
                                                </div>
                                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary" id="entregar-btn">
                                                    Crear Usuario
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="mdl-tabs__panel" id="tabListAdmin">
                    <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--8-col-desktop mdl-cell--2-offset-desktop">
                        <div class="full-width panel mdl-shadow--2dp">
                            <div class="full-width panel-tittle bg-primary text-center tittles">
                                Listado de Usuarios
                            </div>
                            <div class="mdl-grid">
                                <div style="overflow-x: auto;" class="full-width panel-content">
                                    <table border="1" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width">
                                        <thead style="text-align: center;">
                                            <tr>
                                                <th style="font-size: 14px; text-align: center;">RUN</th>
                                                <th style="font-size: 14px; text-align: center;">Nombre</th>
                                                <th style="font-size: 14px; text-align: center;">Apellido</th>
                                                <th style="font-size: 14px; text-align: center;">Cargo</th>
                                                <th style="font-size: 14px; text-align: center;">Acciones</th>

                                            </tr>
                                        </thead>
                                        <tbody id="lista-usuarios">
                                            <!-- Los usuarios se cargarán aquí -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="mdl-tabs__panel" id="tabEditAdmin">
                    <div class="mdl-grid">
                        <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--10-col-desktop mdl-cell--1-offset-desktop">
                            <div class="full-width panel mdl-shadow--2dp">
                                <div class="full-width panel-tittle bg-primary text-center tittles">
                                    Editar Usuario
                                </div>
                                <div class="full-width panel-content">
                                    <form id="formulario-buscar-usuario">
                                        <div class="mdl-grid">
                                            <div class="mdl-cell mdl-cell--6-col-desktop">
                                                <h5 class="text-condensedLight"><strong>Buscar Usuario</strong></h5>
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                    <input class="mdl-textfield__input" type="text" id="buscarDNIAdmin">
                                                    <label class="mdl-textfield__label" for="buscarDNIAdmin">RUN</label>
                                                    <span class="mdl-textfield__error">RUN Invalido</span>
                                                </div>
                                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary" id="btn-buscar-usuario">Buscar Usuario</button>
                                            </div>
                                        </div>
                                    </form>
                                    <form id="formulario-editar-usuario">
                                        <div class="mdl-grid">
                                            <div class="mdl-cell mdl-cell--6-col-desktop">
                                                <h5 class="text-condensedLight"><strong>Datos del Usuario</strong></h5>
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                    <input class="mdl-textfield__input" type="text" id="editarDNIAdmin">
                                                    <label class="mdl-textfield__label" for="editarDNIAdmin">RUN</label>
                                                    <span class="mdl-textfield__error">RUN Invalido</span>
                                                </div>
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                    <input class="mdl-textfield__input" type="text" id="editarNameAdmin">
                                                    <label class="mdl-textfield__label" for="editarNameAdmin">Nombre usuario</label>
                                                    <span class="mdl-textfield__error">Nombre Invalido</span>
                                                </div>
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                    <input class="mdl-textfield__input" type="text" id="editarLastNameAdmin">
                                                    <label class="mdl-textfield__label" for="editarLastNameAdmin">Apellido usuario</label>
                                                    <span class="mdl-textfield__error">Apellido Invalido</span>
                                                </div>
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                    <input class="mdl-textfield__input" type="text" id="editarCargoAdmin">
                                                    <label class="mdl-textfield__label" for="editarCargoAdmin">Cargo</label>
                                                    <span class="mdl-textfield__error">Cargo Invalido</span>
                                                </div>
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                    <input class="mdl-textfield__input" type="password" id="editarPasswordAdmin">
                                                    <label class="mdl-textfield__label" for="editarPasswordAdmin">Contraseña</label>
                                                    <span class="mdl-textfield__error">Contraseña Invalida</span>
                                                </div>
                                            </div>
                                            <div class="mdl-cell mdl-cell--6-col-desktop">
                                                <h5 class="text-condensedLight"><strong>Permisos</strong></h5>
                                                <div class="container-permisos">
                                                    <div class="permisos-disponibles">
                                                        <h6>Roles Disponibles</h6>
                                                        <select multiple id="editarPermisosDisponibles" class="lista-permisos">
                                                            <!-- Opciones de permisos disponibles -->
                                                        </select>
                                                    </div>
                                                    <div class="botones-permisos">
                                                        <button type="button" id="editarBtnAgregarPermiso">&gt;</button>
                                                        <button type="button" id="editarBtnQuitarPermiso">&lt;</button>
                                                    </div>
                                                    <div class="permisos-asignados">
                                                        <h6>Roles Asignados</h6>
                                                        <select multiple id="editarPermisosAsignados" class="lista-permisos">
                                                            <!-- Lista de permisos asignados -->
                                                        </select>
                                                    </div>
                                                </div>
                                                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary" id="btn-actualizar-usuario">
                                                    Actualizar Usuario
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              
             
                    <!-- Resto del contenido HTML -->

    <!-- Vinculación del archivo JavaScript externo -->
    <script src="js/admin.js"></script>
</body>
</html>

</body>

</html>