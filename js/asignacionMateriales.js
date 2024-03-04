var materialesAgregados = []; // Lista para almacenar los materiales agregados


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
			// Función para buscar material
			function buscarMaterial(event) {
				event.preventDefault();
				var id_material = document.getElementById('id_material').value;

				fetch('php/rescatar.php?id_material=' + id_material)
					.then(response => response.json())
					.then(data => {
						if (data.error) {
							alert(data.error);
						} else {
							document.getElementById('nombreMaterial').textContent = data.nombre;
							document.getElementById('unidadMedida').textContent = data.unidad_medida;
							document.getElementById('valorMaterial').textContent = data.valor;
						}
					})
					.catch(error => {
						console.error('Error en la solicitud:', error);
					});
			}

			// Función para agregar material a la lista
			function agregarMaterial() {
				var id_material = document.getElementById('id_material').value;
				var id_ot = document.getElementById('id_ot').value;
				var nombre_material = document.getElementById('nombreMaterial').textContent;
				var unidad_medida = document.getElementById('unidadMedida').textContent;
				var cantidad = parseInt(document.getElementById('cantidad').value);

				// Verificar que todas las casillas estén completas
				if (!id_material || !id_ot || !nombre_material || !unidad_medida || isNaN(cantidad) || cantidad <= 0) {
					Swal.fire({
						title: 'Error',
						text: 'Por favor, complete todas las casillas correctamente antes de agregar el material.',
						icon: 'error',
						confirmButtonText: 'Aceptar'
					});
					return;
				}

				// Agregar el material a la lista
				materialesAgregados.push({
					id_material: id_material,
					nombre_material: nombre_material,
					unidad_medida: unidad_medida,
					cantidad: cantidad,
					id_ot: id_ot
				});

				var tableBody = document.getElementById('materialesUtilizadosTableBody');
				var newRow = tableBody.insertRow();
				var cell1 = newRow.insertCell(0);
				var cell2 = newRow.insertCell(1);
				var cell3 = newRow.insertCell(2);
				var cell4 = newRow.insertCell(3);
				var cell5 = newRow.insertCell(4);
				cell1.innerHTML = id_material;
				cell2.innerHTML = nombre_material;
				cell3.innerHTML = unidad_medida;
				cell4.innerHTML = cantidad;
				cell5.innerHTML = '<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" onclick="eliminarFila(this, true)">Eliminar</button>';

				// Limpiar los campos después de agregar el material
				document.getElementById('id_material').value = '';
				document.getElementById('nombreMaterial').textContent = '';
				document.getElementById('unidadMedida').textContent = '';
				document.getElementById('cantidad').value = '';
			}

			// Función para eliminar una fila de material
			function eliminarFila(button, esMaterialAgregado) {
				if (esMaterialAgregado && confirm("¿Estás seguro de que deseas eliminar este material?")) {
					var row = button.parentNode.parentNode;
					var materialId = row.cells[0].textContent;
					row.parentNode.removeChild(row);
					// Eliminar de la lista de materiales agregados
					materialesAgregados = materialesAgregados.filter(material => material.id_material !== materialId);
				}
			}

			// Función para confirmar y eliminar un material de la base de datos
			function confirmarYEliminarMaterial(materialId, button) {
				if (confirm("¿Estás seguro de que deseas eliminar este material?")) {
					fetch('php/eliminar_material.php', {
							method: 'POST',
							headers: {
								'Content-Type': 'application/x-www-form-urlencoded',
							},
							body: 'id_material=' + encodeURIComponent(materialId)
						})
						.then(response => response.json())
						.then(data => {
							if (data.success) {
								// Eliminar la fila de la tabla si la eliminación es exitosa
								var row = button.parentNode.parentNode;
								row.parentNode.removeChild(row);
								alert("Material eliminado con éxito.");
							} else {
								// Mostrar un mensaje de error si no se pudo eliminar el material
								alert("Error al eliminar el material: " + data.message);
							}
						})
						.catch(error => {
							console.error('Error al realizar la solicitud:', error);
							alert("Error al comunicarse con el servidor para eliminar el material.");
						});
				}
			}

			// Función para guardar el movimiento
			function guardarMovimiento(event) {
				event.preventDefault();

				// Verificar si hay al menos un material agregado
				if (materialesAgregados.length === 0) {
					Swal.fire({
						title: 'Error',
						text: 'Debe agregar por lo menos un material.',
						icon: 'error',
						confirmButtonText: 'Aceptar'
					});
					return;
				}

				var data = {
					form_type: 'asignacion',
					materiales: materialesAgregados
				};

				fetch('php/guardar_asignacion.php', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json',
					},
					body: JSON.stringify(data)
				})
				.then(response => response.json())
				.then(data => {
					if (data.success) {
						Swal.fire({
							title: 'Éxito',
							text: 'Asignación correcta',
							icon: 'success',
							confirmButtonText: 'Aceptar'
						}).then((result) => {
							if (result.isConfirmed) {
								limpiarFormulario();
							}
						});
					} else {
						if (data.idMaterial && data.cantidadDisponible != null) {
							Swal.fire({
								title: 'Error',
								text: `Material insuficiente. Material: ${data.idMaterial}, Cantidad disponible: ${data.cantidadDisponible}`,
								icon: 'error',
								confirmButtonText: 'Aceptar'
							});
						} else {
							Swal.fire({
								title: 'Error',
								text: 'Error al guardar los datos: ' + data.message,
								icon: 'error',
								confirmButtonText: 'Aceptar'
							});
						}
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
			// Función para limpiar el formulario y la tabla
			function limpiarFormulario() {
				// Limpia los campos de entrada
				document.getElementById('id_ot').value = '';
				document.getElementById('id_material').value = '';
				document.getElementById('cantidad').value = '';
				document.getElementById('nombreMaterial').textContent = '';
				document.getElementById('unidadMedida').textContent = '';
				document.getElementById('nombrelMueble').textContent = '';
				document.getElementById('nombreCliente').textContent = '';

				// Limpia la tabla de materiales agregados
				var tableBody = document.getElementById('materiales-table').getElementsByTagName('tbody')[0];
				tableBody.innerHTML = '';

				// Reinicia la lista de materiales agregados
				materialesAgregados = [];
			}

			// Función para descargar datos como un archivo JSON
			function downloadJSON(data) {
				var blob = new Blob([data], {
					type: 'application/json'
				});
				var url = URL.createObjectURL(blob);
				var a = document.createElement('a');
				a.href = url;
				a.download = 'data.json';
				document.body.appendChild(a);
				a.click();
				window.URL.revokeObjectURL(url);
			}

			// Event listeners para los botones y acciones
			function buscarIdOT() {
				var id_ot = document.getElementById('id_ot').value;
				var mensajeElemento = document.getElementById('mensaje');
				mensajeElemento.textContent = 'Enviando datos al servidor...';

				fetch('php/rescatar_asignacion.php?id_ot=' + id_ot)
					.then(response => response.json())
					.then(data => {
						if (data.error) {
							Swal.fire({
								title: 'Error',
								text: 'OT no encontrada.',
								icon: 'error',
								confirmButtonText: 'Aceptar'
							});
							mensajeElemento.textContent = 'OT no encontrada.';
							mensajeElemento.style.color = 'red';
						} else {
							document.getElementById('nombrelMueble').textContent = data.mueble;
							document.getElementById('nombreCliente').textContent = data.cliente;

							var materialesUtilizadosTableBody = document.getElementById('materialesUtilizadosTableBody');
							materialesUtilizadosTableBody.innerHTML = '';

							data.materiales_utilizados.forEach(material => {
								var row = document.createElement('tr');
								row.innerHTML = `
                        <td class="mdl-data-table__cell--numeric">${material.id_material}</td>
                        <td class="mdl-data-table__cell--numeric">${material.nombre_material}</td>
                        <td class="mdl-data-table__cell--numeric">${material.unidad_medida}</td>
                        <td class="mdl-data-table__cell--numeric">${material.cantidad_utilizada}</td>
                        <td><button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" onclick="confirmarYEliminarMaterial('${material.id_material}', this)">Eliminar</button></td>`;
								materialesUtilizadosTableBody.appendChild(row);
							});

							mensajeElemento.textContent = 'Datos obtenidos correctamente.';
							mensajeElemento.style.color = 'green';
						}
					})
					.catch(error => {
						mensajeElemento.textContent = 'Error en la solicitud al servidor.';
						mensajeElemento.style.color = 'red';
						console.error('Error en la solicitud:', error);
					});
			}

			document.getElementById('buscar-ot-btn').addEventListener('click', function(event) {
				event.preventDefault(); // Evitar que la página se actualice
				buscarIdOT();
			});
			document.getElementById('buscar-material-btn').addEventListener('click', buscarMaterial);
			document.getElementById('guardar-movimiento-btn').addEventListener('click', guardarMovimiento);
			document.getElementById('agregar-material-btn').addEventListener('click', agregarMaterial);
			document.getElementById('nombre_material').addEventListener('input', function() {
    var nombre_material = this.value;

   
});