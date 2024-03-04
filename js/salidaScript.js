document.addEventListener('DOMContentLoaded', function() {


    document.getElementById('nombre_material').addEventListener('input', function() {
        var nombre_material = this.value;
    
        if (nombre_material.length >= 3) {
            fetch('php/buscar_material_por_nombre.php?nombre=' + nombre_material)
                .then(response => response.json())
                .then(data => {
                    var listaResultados = document.getElementById('listaResultados');
                    listaResultados.innerHTML = '';
    
                    data.forEach(material => {
                        var div = document.createElement('div');
                        div.innerHTML = material.nombre;
                        div.style.cursor = 'pointer';
                        div.onclick = function() {
                            document.getElementById('nombre_material').value = material.nombre;
                            document.getElementById('id_material').value = material.id_material;
                            // Aquí puedes completar otros campos si es necesario
                            listaResultados.innerHTML = '';
                        };
                        listaResultados.appendChild(div);
                    });
                })
                .catch(error => {
                    console.error('Error en la solicitud:', error);
                });
        } else {
            document.getElementById('listaResultados').innerHTML = '';
        }
    });
            // Función para buscar información del material
            function buscarMaterial() {
                var idMaterial = document.getElementById('id_material').value;

                fetch('php/buscar_material.php?id_material=' + idMaterial)
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            // Manejar error
                        } else {
                            document.getElementById('nombreMaterial').textContent = data.nombre;
                            document.getElementById('valorMaterial').textContent = data.valor;
                            document.getElementById('unidadMedida').textContent = data.unidad_medida;
                            document.getElementById('familiaMaterial').textContent = data.familia;
                            document.getElementById('stockMaterial').textContent = data.stock;
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }

            // Función para registrar merma
            function registrarMerma() {
                var idMaterial = document.getElementById('id_material').value;
                var cantidadMerma = parseInt(document.getElementById('cantidad').value);
                var stockActual = parseInt(document.getElementById('stockMaterial').textContent);
                var descripcionMerma = document.getElementById('descripcion').value; // Obtener la descripción

                // Verificar que la merma no exceda el stock actual
                if (cantidadMerma > stockActual) {
                    Swal.fire({
                        title: 'Error',
                        text: 'La cantidad de merma no puede ser superior al stock actual.',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                    return; // Detener la ejecución si la cantidad de merma es inválida
                }

                // Realizar la actualización del stock
                fetch('php/actualizar_stock.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            id_material: idMaterial,
                            cantidad_merma: cantidadMerma,
                            descripcion: descripcionMerma // Enviar la descripción
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message === 'Merma registrada correctamente') {
                            Swal.fire({
                                title: 'Éxito',
                                text: 'Merma registrada correctamente.',
                                icon: 'success',
                                confirmButtonText: 'Aceptar'
                            }).then(() => {
                                limpiarCamposMerma(); // Llamar a la función para limpiar los campos
                            });
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: data.message, // Mostrar el mensaje de error real
                                icon: 'error',
                                confirmButtonText: 'Aceptar'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Error en la solicitud',
                            text: 'Error al realizar la solicitud al servidor.',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        });
                    });
            }

            function limpiarCamposMerma() {
                document.getElementById('id_material').value = '';
                document.getElementById('nombreMaterial').textContent = '';
                document.getElementById('valorMaterial').textContent = '';
                document.getElementById('unidadMedida').textContent = '';
                document.getElementById('familiaMaterial').textContent = '';
                document.getElementById('stockMaterial').textContent = '';
                document.getElementById('cantidad').value = '';
                document.getElementById('descripcion').value = '';
            }

            function limpiarCamposMerma() {
                document.getElementById('id_material').value = '';
                document.getElementById('nombreMaterial').textContent = '';
                document.getElementById('valorMaterial').textContent = '';
                document.getElementById('unidadMedida').textContent = '';
                document.getElementById('familiaMaterial').textContent = '';
                document.getElementById('stockMaterial').textContent = '';
                document.getElementById('cantidad').value = '';
                document.getElementById('descripcion').value = '';
            }

            document.getElementById('buscar-material-btn').addEventListener('click', function(event) {
                event.preventDefault();
                buscarMaterial();
            });

            document.getElementById('registrar-merma-btn').addEventListener('click', function(event) {
                event.preventDefault();
                registrarMerma();
            });

            var materialesAgregados = []; // Lista para almacenar los materiales agregados
            function buscarIdOT() {
                var id_ot = document.getElementById('id_ot').value;
                var mensajeElemento = document.getElementById('mensaje');
                mensajeElemento.textContent = 'Enviando datos al servidor...';

                fetch('php/busca_salida.php?id_ot=' + id_ot)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Respuesta del servidor no fue OK');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.error) {
                            // Usar Swal.fire para mostrar el mensaje de error
                            Swal.fire({
                                title: 'Error',
                                text: data.error,
                                icon: 'error',
                                confirmButtonText: 'Aceptar'
                            });
                            mensajeElemento.textContent = data.error;
                            mensajeElemento.style.color = 'red';
                        } else {
                            // Procesar datos si la OT se encuentra
                            document.getElementById('nombrelMueble').textContent = data.mueble;
                            document.getElementById('nombreCliente').textContent = data.cliente;
                            document.getElementById('apellidoCliente').textContent = data.apellido;

                            var materialesConsolidados = consolidarMateriales(data.materiales_utilizados);
                            actualizarTablaMateriales(materialesConsolidados);
                            mensajeElemento.textContent = 'Datos obtenidos correctamente.';
                            mensajeElemento.style.color = 'green';
                        }
                    })
                    .catch(error => {
                        // Manejar errores de la solicitud fetch
                        mensajeElemento.textContent = 'Error en la solicitud al servidor: ' + error.message;
                        mensajeElemento.style.color = 'red';
                        console.error('Error en la solicitud:', error);
                    });
            }

            function consolidarMateriales(materiales) {
                var materialesConsolidados = {};
                materiales.forEach(material => {
                    var cantidadUtilizada = parseInt(material.cantidad_utilizada, 10);

                    if (materialesConsolidados[material.id_material]) {
                        materialesConsolidados[material.id_material].cantidad_utilizada += cantidadUtilizada;
                    } else {
                        materialesConsolidados[material.id_material] = {
                            ...material,
                            cantidad_utilizada: cantidadUtilizada
                        };
                    }
                });
                return Object.values(materialesConsolidados);
            }

            function actualizarTablaMateriales(materiales) {
                var materialesUtilizadosTableBody = document.getElementById('materialesUtilizadosTableBody');
                materialesUtilizadosTableBody.innerHTML = ''; // Limpiar la tabla

                materiales.forEach((material, index) => {
                    if (material.id_material && material.nombre_material) { // Verificar que el material tenga ID y nombre
                        var checkboxDisabled = material.estado !== 'Pendiente' ? 'disabled' : '';
                        var row = document.createElement('tr');
                        row.innerHTML = `
                <td style="text-align: center;">
                    <input type="checkbox" id="material_${index}" name="material_${index}" value="${material.id_material}" ${checkboxDisabled}>
                </td>
                <td style="text-align: center;">${material.id_material}</td>
                <td style="text-align: center;">${material.nombre_material}</td>
                <td style="text-align: center;">${material.cantidad_utilizada}</td>
                <td style="text-align: center;">${material.cantidad_entregada}</td>
                <td style="text-align: center;">
                    <input type="number" id="cantidad_entregar_${index}" name="cantidad_entregar_${index}" min="0" max="${material.cantidad_utilizada - material.cantidad_entregada}" ${checkboxDisabled}>
                </td>
                <td style="text-align: center;">${material.estado}</td>
            `;
                        materialesUtilizadosTableBody.appendChild(row);
                    }
                });
            }

            document.getElementById('buscar-ot-btn').addEventListener('click', function(event) {
                event.preventDefault(); // Evitar que la página se actualice
                buscarIdOT();
            });

            function guardarMovimiento(event) {
                event.preventDefault();

                var id_ot = document.getElementById('id_ot').value;
                var filasTabla = document.getElementById('materialesUtilizadosTableBody').getElementsByTagName('tr');
                var entregaData = [];
                var error = false;

                for (var i = 0; i < filasTabla.length; i++) {
                    var checkbox = filasTabla[i].getElementsByTagName('input')[0];
                    var cantidadEntregarInput = document.getElementById(`cantidad_entregar_${i}`);
                    var cantidadEntregada = parseInt(filasTabla[i].getElementsByTagName('td')[4].textContent); // Obtiene la cantidad entregada

                    if (checkbox.checked) {
                        var id_material = filasTabla[i].getElementsByTagName('td')[1].textContent;
                        var cantidad_utilizada = parseInt(filasTabla[i].getElementsByTagName('td')[3].textContent);
                        var cantidad_entregar = parseInt(cantidadEntregarInput.value);
                        var totalEntregado = cantidadEntregada + cantidad_entregar; // Suma la cantidad ya entregada y la nueva entrega

                        if (totalEntregado > cantidad_utilizada) {
                            Swal.fire({
                                title: 'Error',
                                text: 'La cantidad total entregada no puede exceder la cantidad utilizada.',
                                icon: 'error',
                                confirmButtonText: 'Aceptar'
                            });
                            error = true;
                            break;
                        }

                        var materialData = {
                            id_ot: id_ot,
                            id_material: id_material,
                            cantidad_entregar: cantidad_entregar
                        };

                        entregaData.push(materialData);
                    }
                }

                if (!error && entregaData.length > 0) {
                    enviarDatosAlServidor(entregaData);
                } else if (!error) {
                    Swal.fire({
                        title: 'Advertencia',
                        text: 'No se han seleccionado materiales para entregar.',
                        icon: 'warning',
                        confirmButtonText: 'Aceptar'
                    });
                }
            }

            function downloadJSON(data) {
                var blob = new Blob([JSON.stringify(data)], {
                    type: 'application/json'
                });
                var url = URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.href = url;
                a.download = 'datos_entrega.json';
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
                document.body.removeChild(a);
            }

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

            function limpiarCampos() {
                // Limpiar los campos del formulario
                document.getElementById('id_ot').value = '';
                document.getElementById('nombrelMueble').textContent = '';
                document.getElementById('nombreCliente').textContent = '';
                document.getElementById('apellidoCliente').textContent = '';

                // Limpiar la tabla de materiales utilizados
                var tabla = document.getElementById('materialesUtilizadosTableBody');
                tabla.innerHTML = '';
            }

            function enviarDatosAlServidor(entregaData) {
                fetch('php/entrega_material.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(entregaData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: 'Éxito',
                                text: 'Las entregas se realizaron correctamente.',
                                icon: 'success',
                                confirmButtonText: 'Aceptar'
                            });
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: data.message, // Mensaje de error devuelto por el servidor
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
            }

            document.getElementById('entregar-btn').addEventListener('click', function(event) {
                guardarMovimiento(event);

                // Agregar un retraso para asegurarse de que la función se ejecute después de guardarMovimiento
                setTimeout(limpiarCampos, 1000); // Ajusta el tiempo según sea necesario
            });
            
        });