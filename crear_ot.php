<?php
include 'php/comprobacion_login.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Creacion de Orden de Trabajo</title>
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



    <style>
        .campo-no-llenado {
            border: 1px solid red;
            /* Cambia el borde a rojo */
        }

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
                    Aquí podrás realizar la creación de una nueva orden de trabajo y también podrás visualizar las
                    existentes.
                </p>
            </div>
        </section>
        <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
            <div class="mdl-tabs__tab-bar">
                <a href="#tabNewProduct" class="mdl-tabs__tab is-active">NUEVO</a>
                <a href="#tabListProducts" class="mdl-tabs__tab">LISTA</a>
                <a href="#tabSearchOT" class="mdl-tabs__tab">BUSCAR OT</a>
            </div>
            <div class="mdl-tabs__panel is-active" id="tabNewProduct">
                <div class="mdl-grid">
                    <div class="dl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--10-col-desktop mdl-cell--1-offset-desktop">
                        <div class="full-width panel mdl-shadow--2dp">
                            <div class="full-width panel-tittle bg-primary text-center tittles">
                                Nueva Orden de Trabajo
                            </div>
                            <div class="full-width panel-content">
                                <form id="formulario-primer-contacto">
                                    <div class="mdl-grid">
                                        <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                            <h5 class="text-condensedLight"><strong>INFORMACION DE CONTACTO</strong><h5>                                                
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                        <input class="mdl-textfield__input" type="text" pattern="-?[0-9- ]*(\.[0-9]+)?" id="id_Cliente" name="id_Cliente">
                                                        <label class="mdl-textfield__label" for="id_Cliente">RUN</label>
                                                        <span class="mdl-textfield__error">RUN Inválido</span>
                                                    </div>
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                        <input class="mdl-textfield__input" type="text" pattern="[A-Za-záéíóúñÁÉÍÓÚÑ ]+" id="apellido" name="apellido">
                                                        <label class="mdl-textfield__label" for="apellido">Apellido</label>
                                                        <span class="mdl-textfield__error">Apellido Inválido, solo debe ingresar letras</span>
                                                    </div>
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                        <input class="mdl-textfield__input" type="number" pattern="-?[0-9- ]*(\.[0-9]+)?" id="telefono" name="telefono">
                                                        <label class="mdl-textfield__label" for="telefono">Telefono 1</label>
                                                        <span class="mdl-textfield__error">Invalido, solo debe ingesar numeros</span>
                                                    </div>
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                        <label for="region">Región:</label>
                                                        <select id="region" name="region" required>
                                                            <!-- Opciones de la región se llenarán dinámicamente -->
                                                        </select>
                                                    </div>
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                        <input class="mdl-textfield__input" type="text" id="direccion" name="direccion">
                                                        <label class="mdl-textfield__label" for="direccion">Direccion</label>
                                                        <span class="mdl-textfield__error">Invalid Mark</span>
                                                    </div>
                                                    <h5 class="text-condensedLight"><strong>DETALLE DEL MUEBLE</strong></h5>

                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                        <input class="mdl-textfield__input" type="text" id="buscador_mueble" name="buscador_mueble">
                                                        <label class="mdl-textfield__label" for="buscador_mueble">Buscar Mueble</label>
                                                    </div>
                                                    <select id="listaResultados" style="width: 100%;"></select>
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                        <input class="mdl-textfield__input" type="text" pattern="-?[A-Za-z0-9áéíóúñÁÉÍÓÚÑ ]*(\.[0-9]+)?" id="nombre_mueble" name="nombre_mueble">
                                                        <label class="mdl-textfield__label" for="nombre_mueble">Nombre del Mueble</label>
                                                        <span class="mdl-textfield__error">Nombre inválido</span>
                                                    </div>
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                        <input class="mdl-textfield__input" type="text" pattern="-?[A-Za-z0-9áéíóúñÁÉÍÓÚÑ ]*(\.[0-9]+)?" id="especificaciones" name="especificaciones">
                                                        <label class="mdl-textfield__label" for="especificaciones">Especificaciones</label>
                                                        <span class="mdl-textfield__error">Nombre inválido</span>
                                                    </div>
                                                    <div class="mdl-textfield mdl-js-textfield">
                                                        <label for="categoria">Categoría:</label>
                                                        <select id="categoria" name="categoria" required>
                                                            <!-- Opciones de la categoría se llenarán dinámicamente -->
                                                        </select>
                                                    </div>
                                        </div>
                                        <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                            <h5 class="text-condensedLight">.<h5>
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                        <input class="mdl-textfield__input" type="text" pattern="[A-Za-záéíóúÁÉÍÓÚ ]+" id="nombre" name="nombre">
                                                        <label class="mdl-textfield__label" for="nombre">Nombre</label>
                                                        <span class="mdl-textfield__error">Invalido, solo debe ingresar letras</span>
                                                    </div>
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                        <input class="mdl-textfield__input" type="email" id="correo" name="correo">
                                                        <label class="mdl-textfield__label" for="correo">email</label>
                                                        <span class="mdl-textfield__error">Correo Invalido</span>
                                                    </div>
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                        <input class="mdl-textfield__input" type="number" pattern="-?[0-9- ]*(\.[0-9]+)?" id="telefonos" name="telefonos">
                                                        <label class="mdl-textfield__label" for="telefonos">Telefono 2</label>
                                                        <span class="mdl-textfield__error">Invalido, solo debe ingesar numeros</span>
                                                    </div>
                                                    <br>
                                                    <br>
                                                    <div>
                                                        <label for="comuna">Comuna:</label>
                                                        <select id="comuna" name="comuna" required>
                                                            <!-- Opciones de la comuna se llenarán dinámicamente -->
                                                        </select>
                                                    </div>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                        <input class="mdl-textfield__input" type="number" pattern="-?[0-9- ]*(\.[0-9]+)?" id="ancho" name="ancho">
                                                        <label class="mdl-textfield__label" for="ancho">Ancho</label>
                                                        <span class="mdl-textfield__error">Ancho Invalido</span>
                                                    </div>
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                        <input class="mdl-textfield__input" type="number" pattern="-?[0-9- ]*(\.[0-9]+)?" id="largo" name="largo">
                                                        <label class="mdl-textfield__label" for="largo">Largo</label>
                                                        <span class="mdl-textfield__error">Largo Invalido</span>
                                                    </div>
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                        <input class="mdl-textfield__input" type="number" pattern="-?[0-9- ]*(\.[0-9]+)?" id="alto" name="alto">
                                                        <label class="mdl-textfield__label" for="alto">Alto</label>
                                                        <span class="mdl-textfield__error">Alto Invalido</span>
                                                    </div>
                                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                        <input class="mdl-textfield__input" type="date" id="fecha_fin" name="fecha_fin" placeholder="dd-mm-aaaa">
                                                        <label class="mdl-textfield__label" for="fecha_fin">Fecha de Finalización</label>
                                                    </div>
                                                    <!-- <div class="mdl-textfield mdl-js-textfield">
													<input type="file">
												</div> -->
                                        </div>
                                    </div>
                                    <p class="text-center">
                                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary" id="guardar-contacto-btn">
                                            Guardar
                                        </button>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mdl-tabs__panel" id="tabListProducts">
                <div class="mdl-grid">
                    <div class="ml-cell mdl-cell--4-col-phone mdl-cell--6-col-tablet mdl-cell--10-col-desktop mdl-cell--1-offset-desktop" id="tabListProducts">
                        <div class="full-width panel mdl-shadow--2dp">
                            <div class="full-width panel-tittle bg-primary text-center tittles">
                                LISTADO HISTORICO
                            </div>
                            <div class="full-width panel-content" style="text-align: center; overflow-x: auto;">
                                <table id="tabla-ot" style="margin: 0 auto; width: 85%;">
                                    <thead>
                                        <tr>
                                            <th>OT</th>
                                            <th>Fecha</th>
                                            <th>Fecha Termino</th>
                                            <th>Hora</th>
                                            <th>Estado</th>
                                            <th>Cliente</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
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
            </div>
            <div class="mdl-tabs__panel" id="tabSearchOT">
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--9-col-desktop mdl-cell--1-offset-desktop">
                        <div class="full-width panel mdl-shadow--2dp">
                            <div class="full-width panel-tittle bg-primary text-center tittles">

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
                                        <!-- Campo RUN (solo lectura) -->
                                        <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                            <p>RUN:<strong><span class="readonly-field" id="run"></span></strong></p>
                                        </div>
                                        <!-- Campo Nombre Mueble (editable) -->
                                        <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                            <p>Nombre Mueble: <strong><span class="readonly-field" id="nombreMueble"></span></strong></p>
                                        </div>
                                        <!-- Campo Cliente (editable) -->
                                        <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                            <p>Nombre Cliente: <strong> <span class="readonly-field" id="nombreCliente"></span></strong></p>
                                        </div>
                                        <!-- Campo Fecha Inicio (solo lectura) -->
                                        <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                            <p>Fecha Inicio: <strong><span class="readonly-field" id="fechaInicio"></span></strong></p>
                                        </div>
                                    </div>
                                    <!-- Campo Fecha Fin (editable) -->
                                    <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                        <p>Fecha Fin: <strong><input class="mdl-textfield__input" type="date" id="fechaFin" name="fechaFin"></strong></p>
                                    </div>
                                    <div class="mdl-textfield mdl-js-textfield">
                                        <label for="estadosOT">Estado:</label>
                                        <select id="estadosOT" name="estadosOT" required>
                                            <!-- Opciones de la categoría se llenarán dinámicamente -->
                                        </select>
                                    </div>
                                    <div>
                                        <!-- Botón para entregar materiales -->
                                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored bg-primary" id="editar-btn">
                                            Guardar Cambios
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Información Enviada al PHP -->
        <div id="mensaje"></div>
    </section>

    <script src="js/gestionGeneral.js"></script>

</body>

</html>