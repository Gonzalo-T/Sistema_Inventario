document.getElementById('buscador_mueble').addEventListener('input', function () {
    var termino = this.value;
    fetch('php/buscar_muebles.php?termino=' + termino)
        .then(response => response.json())
        .then(data => {
            mostrarResultados(data);
        })
        .catch(error => console.error('Error:', error));
});

function mostrarResultados(muebles) {
    var listaResultados = document.getElementById('listaResultados');
    listaResultados.innerHTML = '';
    muebles.forEach(mueble => {
        var opcion = document.createElement('option');
        opcion.value = mueble.id_detalle_mueble;
        opcion.textContent = mueble.nombre;
        listaResultados.appendChild(opcion);
    });
}
// Función para cargar los detalles del mueble seleccionado
function cargarDetallesMueble(idMueble) {
    fetch('php/detalles_mueble.php?id=' + idMueble)
        .then(response => response.json())
        .then(data => {
            if (data) {
                document.getElementById('nombre_mueble').value = data.nombre || '';
                document.getElementById('especificaciones').value = data.especificaciones || '';
                document.getElementById('ancho').value = data.ancho || '';
                document.getElementById('largo').value = data.largo || '';
                document.getElementById('alto').value = data.alto || '';

                // Actualizar la categoría
                var selectCategoria = document.getElementById('categoria');
                for (var i = 0; i < selectCategoria.options.length; i++) {
                    if (selectCategoria.options[i].value == data.id_categoria) {
                        selectCategoria.selectedIndex = i;
                        break;
                    }
                }
            }
        })
        .catch(error => console.error('Error:', error));
}
// No olvides agregar un event listener al select listaResultados
document.getElementById('listaResultados').addEventListener('change', function () {
    cargarDetallesMueble(this.value);
});

document.getElementById('btn-exit').addEventListener('click', function () {
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

document.addEventListener("DOMContentLoaded", function () {
    var regionDropdown = document.getElementById("region");
    var comunaDropdown = document.getElementById("comuna");
    var categoriaDropdown = document.getElementById("categoria");

    // Función para habilitar o deshabilitar campos
    function toggleFormFields(enable) {
        document.querySelectorAll('#formulario-primer-contacto input, #formulario-primer-contacto select')
            .forEach(function (input) {
                if (input.id !== 'id_Cliente') { // Excluir el campo RUN
                    input.disabled = !enable;
                }
            });
    }

    // Deshabilitar todos los campos al cargar la página, excepto el RUN
    toggleFormFields(false);

    // Manejador para cuando se presione Enter en el campo RUN
    document.getElementById('id_Cliente').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            var run = e.target.value;

            fetch('php/buscar_cliente.php?run=' + run)
                .then(response => response.json())
                .then(data => {
                    // Limpiar campos antes de llenarlos con nueva información
                    clearFormFields(run); // Pasar el RUN para no borrarlo

                    if (data.encontrado) {
                        // Cliente encontrado: llenar campos
                        document.getElementById('nombre').value = data.cliente.nombre;
                        document.getElementById('apellido').value = data.cliente.apellido;
                        document.getElementById('telefono').value = data.cliente.telefono;
                        document.getElementById('correo').value = data.cliente.correo;
                        document.getElementById('telefonos').value = data.cliente.telefono2;
                        document.getElementById('direccion').value = data.cliente.direccion;
                        document.getElementById('region').value = data.cliente.id_region;
                        cargarYSeleccionarComuna(data.cliente.id_region, data.cliente.id_comuna);

                    } else {
                        // Cliente no encontrado: los campos ya están limpios
                    }

                    toggleFormFields(true); // Habilitar campos
                })
                .catch(err => {
                    console.error('Error al buscar cliente:', err);
                    toggleFormFields(true); // Habilitar campos en caso de error
                });
        }
    });

    function cargarYSeleccionarComuna(idRegion, idComuna) {
        var comunaDropdown = document.getElementById('comuna');
        fetch('php/conexion.php?region=' + idRegion)
            .then(response => response.json())
            .then(data => {
                comunaDropdown.innerHTML = '';
                data.comunas.forEach(comuna => {
                    var option = document.createElement('option');
                    option.value = comuna.id_comuna;
                    option.text = comuna.nombre_comuna;
                    comunaDropdown.appendChild(option);
                });
                comunaDropdown.value = idComuna;
            });
    }

    function clearFormFields(runValue) {
        // Función para limpiar todos los campos del formulario, excepto RUN
        document.querySelectorAll('#formulario-primer-contacto input[type="text"], #formulario-primer-contacto input[type="number"], #formulario-primer-contacto input[type="email"], #formulario-primer-contacto select').forEach(function (input) {
            if (input.id !== 'id_Cliente') { // Excluir el campo RUN
                input.value = '';
            }
        });
        // Restablecer el valor de RUN
        document.getElementById('id_Cliente').value = runValue;

        // Restablecer los valores predeterminados para los dropdowns, si es necesario
        regionDropdown.selectedIndex = 0;
        comunaDropdown.innerHTML = '';
    }

    fetch('php/conexion.php')
        .then(response => response.json())
        .then(data => {
            data.regiones.forEach(region => {
                var option = document.createElement('option');
                option.value = region.id_region;
                option.text = region.nombre_region;
                regionDropdown.appendChild(option);
            });

            regionDropdown.addEventListener('change', function () {
                var regionId = regionDropdown.value;
                comunaDropdown.innerHTML = '';
                var url = 'php/conexion.php?region=' + regionId;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        data.comunas.sort((a, b) => a.nombre_comuna.localeCompare(b.nombre_comuna));
                        data.comunas.forEach(comuna => {
                            var option = document.createElement('option');
                            option.value = comuna.id_comuna;
                            option.text = comuna.nombre_comuna;
                            comunaDropdown.appendChild(option);
                        });
                    });
            });

            fetch('php/conexion.php?categorias=true')
                .then(response => response.json())
                .then(data => {
                    data.categorias.forEach(categoria => {
                        var option = document.createElement('option');
                        option.value = categoria.id_categoria;
                        option.text = categoria.nombre;
                        categoriaDropdown.appendChild(option);
                    });
                })
                .catch(err => {
                    console.error('Error en la solicitud de categorías:', err);
                });
        })
        .catch(err => {
            console.error('Error en la solicitud:', err);
        });


    document.getElementById('guardar-contacto-btn').addEventListener('click', function (event) {
        event.preventDefault(); // Evitar que el formulario se envíe automáticamente

        // Validar campos aquí (puedes agregar más validaciones según tus necesidades)
        var camposValidos = validarCampos();

        // Mostrar alerta si los campos no son válidos
        if (!camposValidos) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Por favor, complete todos los campos antes de guardar.',
            });
            return;
        }

        // Obtener valores de los campos para el envío
        var idCliente = document.getElementById('id_Cliente').value;
        var nombre = document.getElementById('nombre').value;
        var apellido = document.getElementById('apellido').value;
        var telefono = document.getElementById('telefono').value;
        var correo = document.getElementById('correo').value;
        var telefonos = document.getElementById('telefonos').value;
        var regionId = parseInt(regionDropdown.value);
        var comunaId = parseInt(comunaDropdown.value);
        var direccion = document.getElementById('direccion').value;
        var nombreMueble = document.getElementById('nombre_mueble').value;
        var categoriaId = parseInt(categoriaDropdown.value);
        var especificaciones = document.getElementById('especificaciones').value;
        var ancho = parseFloat(document.getElementById('ancho').value);
        var largo = parseFloat(document.getElementById('largo').value);
        var alto = parseFloat(document.getElementById('alto').value);
        var nombreComuna = comunaDropdown.options[comunaDropdown.selectedIndex].text;
        var nombreRegion = regionDropdown.options[regionDropdown.selectedIndex].text;
        var nombreCategoria = categoriaDropdown.options[categoriaDropdown.selectedIndex].text;
        var fechaFin = document.getElementById('fecha_fin').value;

        var formData = {
            form_type: 'primer_contacto',
            id_Cliente: idCliente,
            nombre: nombre,
            apellido: apellido,
            telefono: telefono,
            correo: correo,
            telefonos: telefonos,
            regionId: regionId,
            comunaId: comunaId,
            direccion: direccion,
            nombreMueble: nombreMueble,
            categoriaId: categoriaId,
            especificaciones: especificaciones,
            ancho: ancho,
            largo: largo,
            alto: alto,
            nombreComuna: nombreComuna,
            nombreRegion: nombreRegion,
            nombreCategoria: nombreCategoria,
            fechaFin: fechaFin
        };

        // Enviar datos para generar PDF
        fetch('TCPDF/examples/generar_pdf.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData),
        })
            .then(response => response.blob())
            .then(blob => {
                var url = window.URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.href = url;
                a.download = 'Orden de trabajo.pdf';
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
            })
            .catch(err => {
                console.error('Error al generar el PDF:', err);
            });

        // Enviar datos para guardar en la base de datos
        fetch('php/guardar_datos.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData),
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Mostrar mensaje de éxito
                    Swal.fire({
                        title: 'Éxito',
                        text: 'OT generada correctamente',
                        icon: 'success',
                        confirmButtonText: 'Aceptar'
                    });
                    limpiarCamposFormulario();
                } else {
                    // Mostrar mensaje de error
                    Swal.fire({
                        title: 'Error',
                        text: 'Error al guardar los datos: ' + data.message,
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                }
            })
            .catch(err => {
                console.error('Error en la solicitud:', err);
                Swal.fire({
                    title: 'Error',
                    text: 'Error al realizar la solicitud al servidor.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            });
    });

    function validarCampos() {
        // Lista de IDs de campos que quieres validar
        var camposAValidar = ['id_Cliente', 'apellido', 'telefono', 'region', 'direccion', 'nombre_mueble', 'especificaciones', 'categoria', 'nombre', 'correo', 'comuna', 'ancho', 'largo', 'alto', 'fecha_fin'];

        var camposValidos = true;

        for (var i = 0; i < camposAValidar.length; i++) {
            var campo = document.getElementById(camposAValidar[i]);

            // Verificar si el campo es el campo de teléfono
            if (camposAValidar[i] === 'telefono' && !/^-?[0-9- ]*(\.[0-9]+)?$/.test(campo.value)) {
                camposValidos = false; // Campo de teléfono no válido si no cumple con el patrón
            }

            // Verificar si el campo está vacío
            if (!campo.value) {
                camposValidos = false; // Campo no válido si está vacío
                // Resaltar en rojo los campos que faltan por llenar
                campo.classList.add('campo-no-llenado');
            } else {
                // Quitar la clase de resaltado si el campo está lleno
                campo.classList.remove('campo-no-llenado');
            }
        }

        return camposValidos; // Todos los campos son válidos
    }


    document.querySelector('[href="#tabListProducts"]').addEventListener('click', function () {
        cargarOTs(1); // Comenzar en la página 1
    });

    let paginaActual = 1;
    const limite = 15;

    function cargarOTs(pagina) {
        fetch('php/obtener_ots_paginado.php?pagina=' + pagina)
            .then(response => response.json())
            .then(data => {
                const tabla = document.getElementById('tabla-ot').getElementsByTagName('tbody')[0];
                tabla.innerHTML = ''; // Limpiar la tabla para nuevos datos

                data.ots.forEach(ot => {
                    const fila = tabla.insertRow();
                    const celdaId = fila.insertCell(0);
                    const celdaFechaInicio = fila.insertCell(1);
                    const celdaFechaFin = fila.insertCell(2);
                    const celdaHora = fila.insertCell(3);
                    const celdaEstado = fila.insertCell(4);
                    const celdaCliente = fila.insertCell(5);

                    celdaId.textContent = ot.id_ot;
                    celdaFechaInicio.textContent = ot.fecha;
                    celdaFechaFin.textContent = ot.fecha_fin;
                    celdaHora.textContent = ot.hora;
                    celdaEstado.textContent = ot.estado;
                    celdaCliente.textContent = ot.cliente;
                });

                // Actualizar el estado de los botones de navegación
                paginaActual = pagina;
                document.getElementById('anterior-btn').disabled = paginaActual === 1;
                document.getElementById('siguiente-btn').disabled = data.ots.length < limite;
            })
            .catch(error => {
                console.error('Error al obtener datos de la tabla OT:', error);
            });
    }

    // Event listeners para los botones de paginación
    document.getElementById('anterior-btn').addEventListener('click', function () {
        if (paginaActual > 1) {
            cargarOTs(paginaActual - 1);
        }
    });

    document.getElementById('siguiente-btn').addEventListener('click', function () {
        cargarOTs(paginaActual + 1);
    });



    // Llamada para cargar los estados de OT
    cargarEstadosOT();
});

function limpiarCamposFormulario() {
    document.getElementById('id_Cliente').value = '';
    document.getElementById('nombre').value = '';
    document.getElementById('apellido').value = '';
    document.getElementById('telefono').value = '';
    document.getElementById('correo').value = '';
    document.getElementById('telefonos').value = '';
    document.getElementById('direccion').value = '';
    document.getElementById('nombre_mueble').value = '';
    document.getElementById('especificaciones').value = '';
    document.getElementById('ancho').value = '';
    document.getElementById('largo').value = '';
    document.getElementById('alto').value = '';
    // Restablecer los selectores
    document.getElementById('region').selectedIndex = 0;
    document.getElementById('comuna').selectedIndex = 0;
    document.getElementById('categoria').selectedIndex = 0;
}

document.getElementById('buscar-ot-btn').addEventListener('click', function (event) {
    event.preventDefault(); // Evitar que la página se actualice
    var id_ot = document.getElementById('id_ot').value;

    // Validación simple para asegurarse de que id_ot contiene solo números
    if (!/^\d+$/.test(id_ot)) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Por favor, ingrese un número de OT válido.',
        });
        return;
    }

    fetch('php/rescatar_fecha.php?id_ot=' + id_ot)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                Swal.fire({
                    title: 'Error',
                    text: 'OT no encontrada.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            } else {
                // Rellenar los campos con los datos obtenidos
                document.getElementById('run').innerText = data.id_cliente;
                document.getElementById('nombreMueble').innerText = data.nombre_mueble;
                document.getElementById('nombreCliente').innerText = data.nombre_cliente + " " + data.apellido_cliente;
                document.getElementById('fechaInicio').innerText = data.fecha_inicio; // Asegúrate de que este ID exista en tu HTML
                document.getElementById('fechaFin').value = data.fecha_fin; // Asegúrate de que este ID exista en tu HTML
                // Seleccionar el estado de la OT en el dropdown
                let selectEstadoOT = document.getElementById('estadosOT');
                for (let i = 0; i < selectEstadoOT.options.length; i++) {
                    if (selectEstadoOT.options[i].text === data.estado_ot) {
                        selectEstadoOT.selectedIndex = i;
                        break;
                    }
                }
            }
        })
        .catch(error => {
            console.error('Error en la solicitud:', error);
            alert('Hubo un error al procesar la solicitud.');
        });
});

function cargarEstadosOT() {
    fetch('php/obtener_estados_ot.php')
        .then(response => response.json())
        .then(data => {
            const selectEstadoOT = document.getElementById('estadosOT');
            selectEstadoOT.innerHTML = '<option value="">Seleccione un estado</option>'; // Opción por defecto
            data.estadosOT.forEach(estado => {
                let option = document.createElement('option');
                option.value = estado.id_estado;
                option.textContent = estado.nombre;
                selectEstadoOT.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al cargar los estados de OT.');


        });


    document.getElementById('editar-btn').addEventListener('click', function (event) {
        event.preventDefault(); // Prevenir la recarga de la página

        // Recoger los datos necesarios
        var id_ot = document.getElementById('id_ot').value;
        var fechaFin = document.getElementById('fechaFin').value;
        var estadoDropdown = document.getElementById('estadosOT');
        var estadoId = parseInt(estadoDropdown.value);

        if (!id_ot || !fechaFin || isNaN(estadoId)) {
            Swal.fire({
                title: 'Campos Incompletos',
                text: 'Por favor, complete todos los campos necesarios.',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            });
            return;
        }

        // Crear el objeto con los datos a enviar
        var datosActualizar = {
            id_ot: id_ot,
            fecha_fin: fechaFin,
            estadoId: estadoId,
        };

        // Enviar la solicitud POST a actualizar_fecha.php
        fetch('php/actualizar_fecha.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(datosActualizar),
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Mostrar mensaje de éxito
                    Swal.fire({
                        title: 'Éxito',
                        text: 'Datos actualizados correctamente',
                        icon: 'success',
                        confirmButtonText: 'Aceptar'
                    });

                    // Limpiar los campos del formulario
                    limpiarCamposFormulario();
                } else {
                    // Mostrar mensaje de error
                    Swal.fire({
                        title: 'Error',
                        text: 'Error al actualizar los datos: ' + data.message,
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                }
            })
            .catch(err => {
                console.error('Error en la solicitud:', err);
                Swal.fire({
                    title: 'Error',
                    text: 'Error al realizar la solicitud al servidor.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            });
    });

    function limpiarCamposFormulario() {
        // Limpiar el campo de número de OT y fecha fin
        document.getElementById('id_ot').value = '';
        document.getElementById('fechaFin').value = '';

        // Limpiar los campos específicos de la OT
        document.getElementById('run').innerText = ''; // Limpiar RUN
        document.getElementById('nombreCliente').innerText = ''; // Limpiar Nombre Cliente
        document.getElementById('nombreMueble').innerText = ''; // Limpiar Nombre Mueble
        document.getElementById('fechaInicio').innerText = ''; // Limpiar Fecha Inicio

        // Restablecer el selector de Estado a su valor por defecto
        var estadoDropdown = document.getElementById('estadosOT');
        estadoDropdown.selectedIndex = 0; // Esto asume que el primer índice es el valor por defecto
    }

}