document.addEventListener('DOMContentLoaded', function() {
			var materialesAgregados = []; // Lista para almacenar los materiales 
			

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
				// Obtener el ID del material
				var id_material = document.getElementById('id_material').value;

				// Hacer la solicitud al servidor
				fetch('php/rescatar.php?id_material=' + id_material)
					.then(response => response.json())
					.then(data => {
						if (data.error) {
							// Manejar el error si el material no se encuentra
							alert(data.error);
						} else {
							// Mostrar los detalles del material con el signo "$" y espacio
							document.getElementById('nombreMaterial').textContent = data.nombre;
							document.getElementById('valorMaterial').textContent = '$ ' + data.valor;
							document.getElementById('unidadMedida').textContent = data.unidad_medida;
						}
					})
					.catch(error => {
						// Manejar errores de la solicitud
						console.error('Error en la solicitud:', error);
					});
			}

			// Función para agregar material a la lista
			function agregarMaterial() {
				// Obtener los valores de los campos
				var id_material = document.getElementById('id_material').value;
				var nombre_material = document.getElementById('nombreMaterial').textContent;
				var cantidad = parseInt(document.getElementById('cantidad').value);
				var unidad = document.getElementById('unidadMedida').textContent; // Obtener la unidad de medida

				// Verificar si se ha ingresado alguna cantidad
				if (isNaN(cantidad) || cantidad <= 0) {
					Swal.fire({
						icon: 'error',
						title: 'Error',
						text: 'Por favor, ingrese una cantidad válida.',
					});
					return;
				}

				// Agregar el material a la lista
				materialesAgregados.push({
					id_material: id_material,
					nombre_material: nombre_material,
					cantidad: cantidad,
					unidad: unidad // Agregar la unidad de medida al objeto del material
				});

				// Mostrar el material en la tabla
				var tableBody = document.getElementById('materialesUtilizadosTableBody');
				var newRow = tableBody.insertRow();
				var cell1 = newRow.insertCell(0);
				var cell2 = newRow.insertCell(1);
				var cell3 = newRow.insertCell(2);
				var cell4 = newRow.insertCell(3);
				var cell5 = newRow.insertCell(4);
				cell1.innerHTML = id_material;
				cell2.innerHTML = nombre_material;
				cell3.innerHTML = cantidad;
				cell4.innerHTML = unidad; // Mostrar la unidad en la tabla
				cell5.innerHTML += '<br><button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" onclick="eliminarFila(this)">Eliminar</button>';
			}

			// Función para eliminar una fila de material
			function eliminarFila(button) {
				var row = button.parentNode.parentNode;
				row.parentNode.removeChild(row);
				var materialId = row.cells[0].textContent;

				// Buscar el material en la lista de materiales agregados
				var materialEliminado = materialesAgregados.find(material => material.id_material === materialId);

				// Verificar si el material fue agregado previamente antes de eliminarlo
				if (materialEliminado) {
					// Eliminar el material de la lista de materiales agregados
					materialesAgregados = materialesAgregados.filter(material => material.id_material !== materialId);
					// Agregar el material eliminado a la lista de materiales eliminados
					materialesEliminados.push(materialEliminado);
				}
			}
			// Función para validar los campos antes de guardar la solicitud


			function guardarMovimiento(event) {
				event.preventDefault();
				// Validar los campos antes de continuar
				if (materialesAgregados.length === 0) {
					Swal.fire({
						title: 'Error',
						text: 'Debe agregar por lo menos un material.',
						icon: 'error',
						confirmButtonText: 'Aceptar'
					});
					return;
				}
				var descripcion = document.getElementById('descripcion').value; // Obtener el valor del campo de descripción
				var entregaData = {
					materiales: materialesAgregados,
					descripcion: descripcion
				};



				// Generar el PDF y descargarlo
				fetch('TCPDF/examples/generar_solicitud.php', {
						method: 'POST',
						headers: {
							'Content-Type': 'application/json',
						},
						body: JSON.stringify(entregaData),
					})
					.then(response => response.blob())
					.then(blob => {
						var url = window.URL.createObjectURL(blob);
						var a = document.createElement('a');
						a.href = url;
						a.download = 'Orden de compra.pdf';
						document.body.appendChild(a);
						a.click();
						window.URL.revokeObjectURL(url);
					})
					.catch(err => {
						console.error('Error al generar el PDF:', err);
					});

				//  Hacer la solicitud para guardar los datos en el servidor
				fetch('php/guardar_solicitud.php', {
						method: 'POST',
						headers: {
							'Content-Type': 'application/json'
						},
						body: JSON.stringify(entregaData)
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
			}
			function limpiarFormulario() {
    // Restablecer campos de entrada de texto y número
    document.getElementById('id_material').value = '';
    document.getElementById('nombreMaterial').textContent = '';
    document.getElementById('valorMaterial').textContent = '';
    document.getElementById('unidadMedida').textContent = '';
    document.getElementById('cantidad').value = '';
    document.getElementById('descripcion').value = '';

    // Limpiar la tabla de materiales agregados
    var tableBody = document.getElementById('materialesUtilizadosTableBody');
    tableBody.innerHTML = '';

    // Restablecer la lista de materiales agregados
    materialesAgregados = [];
}

			// Descargar la información como un archivo JSON
			function downloadJSON(data) {
				var jsonData = JSON.stringify(data);
				var blob = new Blob([jsonData], {
					type: 'application/json'
				});
				var url = URL.createObjectURL(blob);

				var a = document.createElement('a');
				a.href = url;
				a.download = 'datos_entrega.json';
				document.body.appendChild(a);
				a.click();

				// Liberar el objeto URL creado para evitar posibles pérdidas de memoria
				window.URL.revokeObjectURL(url);
				document.body.removeChild(a);
			}

			document.getElementById('buscar-material-btn').addEventListener('click', buscarMaterial);
			document.getElementById('agregar-material-btn').addEventListener('click', agregarMaterial);
			document.getElementById('guardar-movimiento-btn').addEventListener('click', guardarMovimiento);


			// Obtener referencia a la tabla en el DOM
			var solicitudesTable = document.getElementById('solicitudes-table').getElementsByTagName('tbody')[0];

			// Función para llenar la tabla con los datos de las solicitudes
			function llenarTablaSolicitudes(data) {
				// Limpiar cualquier contenido previo en la tabla
				solicitudesTable.innerHTML = '';

				// Iterar sobre los datos y agregar filas a la tabla
				data.forEach(function(solicitud) {
					var row = solicitudesTable.insertRow();
					var cell1 = row.insertCell(0);
					var cell2 = row.insertCell(1);
					var cell3 = row.insertCell(2);
					var cell4 = row.insertCell(3);
					var cell5 = row.insertCell(4);

					cell1.textContent = solicitud.id_oc;
					cell2.textContent = solicitud.fecha;
					cell3.textContent = solicitud.descripcion;
					cell4.textContent = solicitud.id_material;
					cell5.textContent = solicitud.nombre;
				});
			}

			// Hacer la solicitud al servidor para obtener los datos de las solicitudes
			fetch('php/mostrar_solicitud.php')
				.then(response => response.json())
				.then(data => {
					// Llenar la tabla con los datos obtenidos
					llenarTablaSolicitudes(data);
				})
				.catch(error => {
					// Manejar errores de la solicitud
					console.error('Error en la solicitud:', error);
				});
            });