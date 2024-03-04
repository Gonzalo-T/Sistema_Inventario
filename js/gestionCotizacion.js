
        function buscarIdOT() {
            var id_ot = document.getElementById('id_ot').value;
            var mensajeElemento = document.getElementById('mensaje');
            mensajeElemento.textContent = 'Enviando datos al servidor...';
            fetch('php/mostrar_coti.php?id_ot=' + id_ot)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        Swal.fire({
                            title: 'Error',
                            text: data.error,
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        });
                        mensajeElemento.textContent = data.error;
                        mensajeElemento.style.color = 'red';
                        limpiarCamposCotizacion();
                    } else {
                        document.getElementById('nombreMueble').textContent = data.mueble;
                        document.getElementById('nombreCategoria').textContent = data.nombre_categoria;
                        document.getElementById('especificaciones').textContent = data.especificaciones_mueble;
                        document.getElementById('ancho').textContent = data.ancho || '';
                        document.getElementById('alto').textContent = data.alto || '';
                        document.getElementById('largo').textContent = data.largo || '';
                        document.getElementById('run').textContent = data.run;
                        document.getElementById('nombreCliente').textContent = data.nombre_cliente;
                        document.getElementById('apellidoCliente').textContent = data.apellido_cliente;
                        document.getElementById('direccionCliente').textContent = data.direccion_cliente;
                        document.getElementById('telefonoCliente').textContent = data.telefono_cliente;
                        document.getElementById('correoCliente').textContent = data.correo_cliente;
                        var totalValor = 0;
                        var materialesUtilizadosTableBody = document.getElementById('materialesUtilizadosTableBody');
                        materialesUtilizadosTableBody.innerHTML = '';
                        data.materiales_utilizados.forEach(material => {
                            var row = document.createElement('tr');
                            row.innerHTML = `<td class="mdl-data-table__cell--numeric">${material.id_material}</td><td class="mdl-data-table__cell--numeric">${material.nombre_material}</td><td class="mdl-data-table__cell--numeric">${material.cantidad_utilizada}</td><td class="mdl-data-table__cell--numeric">$${parseFloat(material.valor).toFixed(0)}</td>`;
                            materialesUtilizadosTableBody.appendChild(row);
                            totalValor += parseFloat(material.valor);
                        });
                        var totalRow = document.createElement('tr');
                        totalRow.innerHTML = `<td colspan="3" style="text-align: right;"><strong>Total</strong></td><td class="mdl-data-table__cell--numeric"><strong>$${Math.round(totalValor)}</strong></td>`;
                        materialesUtilizadosTableBody.appendChild(totalRow);
                        mensajeElemento.textContent = 'Datos obtenidos correctamente.';
                        mensajeElemento.style.color = 'green';
                    }
                })
                .catch(error => {
                    var mensajeElemento = document.getElementById('mensaje');
                    mensajeElemento.textContent = 'Error en la solicitud al servidor.';
                    mensajeElemento.style.color = 'red';
                    console.error('Error en la solicitud:', error);
                });
        }

        document.getElementById('buscar-ot-btn').addEventListener('click', function(event) {
            event.preventDefault();
            buscarIdOT();
        });

        function calcularTotalConManoObra(event) {
            event.preventDefault();
            var totalValor = 0;
            var porcentaje = parseFloat(document.getElementById('porcentajeManoObra').value);

            var materialesTable = document.getElementById('materialesUtilizadosTableBody');
            var rows = materialesTable.getElementsByTagName('tr');
            for (var i = 0; i < rows.length - 1; i++) {
                var celdaValor = rows[i].cells[3];
                if (celdaValor && !isNaN(parseFloat(celdaValor.textContent.replace('$', '')))) {
                    var valor = parseFloat(celdaValor.textContent.replace('$', ''));
                    totalValor += valor;
                }
            }

            var totalConManoObra = totalValor + (totalValor * porcentaje / 100);
            document.getElementById('nuevoTotalConManoObra').textContent = 'Nuevo Total con Mano de Obra: $' + totalConManoObra.toFixed(0);
            localStorage.setItem('nuevoTotalConManoObra', totalConManoObra);
        }

        function generarCotizacion() {
            var id_ot = document.getElementById('id_ot').value;
            var run = document.getElementById('run').textContent;
            var nombreCliente = document.getElementById('nombreCliente').textContent;
            var apellidoCliente = document.getElementById('apellidoCliente').textContent;
            var direccionCliente = document.getElementById('direccionCliente').textContent;
            var telefonoCliente = document.getElementById('telefonoCliente').textContent;
            var correoCliente = document.getElementById('correoCliente').textContent;
            var nombreMueble = document.getElementById('nombreMueble').textContent;
            var nombreCategoria = document.getElementById('nombreCategoria').textContent;
            var especificaciones = document.getElementById('especificaciones').textContent;
            var ancho = document.getElementById('ancho').textContent;
            var alto = document.getElementById('alto').textContent;
            var largo = document.getElementById('largo').textContent;
            var totalValor = parseFloat(localStorage.getItem('nuevoTotalConManoObra')) || 0;

            var datosCotizacion = {
                id_ot: id_ot,
                run: run,
                nombreCliente: nombreCliente,
                apellidoCliente: apellidoCliente,
                direccionCliente: direccionCliente,
                telefonoCliente: telefonoCliente,
                correoCliente: correoCliente,
                nombreMueble: nombreMueble,
                nombreCategoria: nombreCategoria,
                especificaciones: especificaciones,
                ancho: ancho,
                alto: alto,
                largo: largo,
                monto_total: Math.round(totalValor),
                fecha_cotizacion: new Date().toISOString().split('T')[0]
            };

            Swal.fire({
                title: 'Procesando...',
                text: 'Generando cotización. Por favor, espere.',
                icon: 'info',
                showConfirmButton: false,
                allowOutsideClick: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });

            fetch('php/guardar_coti.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(datosCotizacion)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Éxito',
                            text: 'Cotización generada y guardada correctamente.',
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        });
                        generarPDF(datosCotizacion);
                        limpiarCamposCotizacion();

                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'Error al guardar la cotización: ' + data.error,
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                })
                .catch(err => {
                    console.error('Error al guardar la cotización:', err);
                    Swal.fire({
                        title: 'Error',
                        text: 'Error al comunicarse con el servidor para generar la cotización.',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                });
        }


        function generarPDF(datosCotizacion) {
            fetch('TCPDF/examples/cotizacion_pdf.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(datosCotizacion),
                })
                .then(response => response.blob())
                .then(blob => {
                    var url = window.URL.createObjectURL(blob);
                    var a = document.createElement('a');
                    a.href = url;
                    a.download = 'Cotizacion.pdf';
                    document.body.appendChild(a);
                    a.click();
                    window.URL.revokeObjectURL(url);
                })
                .catch(err => {
                    console.error('Error al generar el PDF:', err);
                });
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


        function limpiarCamposCotizacion() {
            // Limpia los campos de texto y otros elementos de la interfaz
            document.getElementById('id_ot').value = '';
            document.getElementById('run').textContent = '';
            document.getElementById('nombreCliente').textContent = '';
            document.getElementById('apellidoCliente').textContent = '';
            document.getElementById('direccionCliente').textContent = '';
            document.getElementById('telefonoCliente').textContent = '';
            document.getElementById('correoCliente').textContent = '';
            document.getElementById('nombreMueble').textContent = '';
            document.getElementById('nombreCategoria').textContent = '';
            document.getElementById('especificaciones').textContent = '';
            document.getElementById('ancho').textContent = '';
            document.getElementById('alto').textContent = '';
            document.getElementById('largo').textContent = '';
            // Limpia la tabla de materiales utilizados
            var materialesUtilizadosTableBody = document.getElementById('materialesUtilizadosTableBody');
            materialesUtilizadosTableBody.innerHTML = '';
            // Limpia cualquier otro elemento que muestre información de la cotización
            // ...
        }

        document.getElementById('entregar-btn').addEventListener('click', function(event) {
            event.preventDefault();
            generarCotizacion();
        });
   