document.addEventListener('DOMContentLoaded', function () {
	var materialesAgregados = []; // Lista para almacenar los materiales agregados
	document.getElementById('nombre_material').addEventListener('input', function () {
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
						div.onclick = function () {
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
					// Mostrar los detalles del material
					document.getElementById('nombreMaterial').textContent = data.nombre;
					document.getElementById('valorMaterial').textContent = data.valor;
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
		// Obtener referencias a los campos
		var cantidadInput = document.getElementById('cantidad');
		var numero_facturaInput = document.getElementById('numero_factura');

		// Validar los campos obligatorios
		var cantidad = cantidadInput.value.trim();
		var numero_factura = numero_facturaInput.value.trim();

		if (cantidad === '') {
			// Marcar en rojo el campo Cantidad
			cantidadInput.classList.add('campo-invalido');
		} else {
			// Limpiar la marca de campo Cantidad si está presente
			cantidadInput.classList.remove('campo-invalido');
		}

		if (numero_factura === '') {
			// Marcar en rojo el campo Número de Factura
			numero_facturaInput.classList.add('campo-invalido');
		} else {
			// Limpiar la marca de campo Número de Factura si está presente
			numero_facturaInput.classList.remove('campo-invalido');
		}

		// Verificar si alguno de los campos obligatorios está vacío
		if (cantidad === '' || numero_factura === '') {
			Swal.fire({
				icon: 'error',
				title: 'Error',
				text: 'Por favor, complete los campos obligatorios: Cantidad y Número de Factura.',
			});
			return; // Detener la ejecución si la validación falla
		}
		// Validar los campos obligatorios
		var cantidad = document.getElementById('cantidad').value.trim();
		var numero_factura = document.getElementById('numero_factura').value.trim();

		if (cantidad === '' || numero_factura === '') {
			alert('Por favor, complete los campos obligatorios: Cantidad y Número de Factura.');
			return; // Detener la ejecución si la validación falla
		}

		var id_material = document.getElementById('id_material').value;
		var nombre_material = document.getElementById('nombreMaterial').textContent;
		cantidad = parseInt(cantidad); // Convertir la cantidad a un número entero


		var id_material = document.getElementById('id_material').value;
		var nombre_material = document.getElementById('nombreMaterial').textContent;
		var cantidad = parseInt(document.getElementById('cantidad').value);


		// Agregar el material a la lista
		materialesAgregados.push({
			id_material: id_material,
			nombre_material: nombre_material,
			cantidad: cantidad,
			numero_factura: numero_factura
		});

		// Mostrar el material en la tabla
		var tableBody = document.getElementById('materiales-table').getElementsByTagName('tbody')[0];
		var newRow = tableBody.insertRow();
		var cellId = newRow.insertCell(0); // Celda para el ID del material
		var cellNombre = newRow.insertCell(1); // Celda para el nombre del material
		var cellCantidad = newRow.insertCell(2); // Celda para la cantidad
		var cellAcciones = newRow.insertCell(3); // Celda para acciones

		cellId.innerHTML = id_material;
		cellNombre.innerHTML = nombre_material;
		cellCantidad.innerHTML = cantidad;
		cellAcciones.innerHTML = '<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" onclick="eliminarFila(this)">Eliminar</button>';

		Swal.fire({
			icon: 'success',
			title: 'Material Agregado',
			text: 'El material se agregó correctamente.',
		});

		// Limpiar los campos de entrada y las marcas de estilo
		cantidadInput.value = '';
		cantidadInput.classList.remove('campo-invalido');
		numero_facturaInput.classList.remove('campo-invalido');
		document.getElementById('id_material').value = '';
		document.getElementById('nombreMaterial').textContent = '';
		document.getElementById('valorMaterial').textContent = '';
		document.getElementById('unidadMedida').textContent = '';
	}


	function eliminarFila(button) {
		var row = button.parentNode.parentNode;
		row.parentNode.removeChild(row);
		// También elimina el material de la lista
		var materialId = row.cells[0].textContent;
		materialesAgregados = materialesAgregados.filter(material => material.id_material !== materialId);
	}

	function guardarMovimiento(event) {
		event.preventDefault();

		// Verificar si hay materiales agregados
		if (materialesAgregados.length === 0) {
			Swal.fire({
				icon: 'warning',
				title: 'Advertencia',
				text: 'No hay materiales agregados. Agregue al menos un material antes de guardar el movimiento.',
			});
			return; // Detener la ejecución si no hay materiales
		}

		// Obtener los valores de los campos
		var id_material = document.getElementById('id_material').value;
		var cantidad = parseInt(document.getElementById('cantidad').value);
		var numero_factura = document.getElementById('numero_factura').value;
		var descripcion = document.getElementById('descripcion').value;

		// Crear el objeto con los datos a enviar
		var data = {
			form_type: 'agregar',
			materiales: materialesAgregados,

			tipo_movimiento: 'Entrada',
			numero_factura: numero_factura,
			descripcion: descripcion
		};

		// Mostrar la información enviada al PHP en el elemento pre


		// Enviar la solicitud al servidor
		fetch('php/ingresar.php', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
			},
			body: JSON.stringify(data)
		})
			.then(response => response.json())
			.then(data => {
				if (data.success) {
					// Mostrar mensaje de éxito
					Swal.fire({
						title: '¡Éxito!',
						text: 'Datos guardados correctamente.',
						icon: 'success',
						confirmButtonText: 'Aceptar'
					});
					// Limpiar la tabla y el arreglo de materiales agregados
					materialesAgregados = [];
					limpiarTablaMateriales();
					limpiarCamposEntrada();
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
				// Mostrar mensaje de error en la solicitud
				Swal.fire({
					title: 'Error',
					text: 'Error al realizar la solicitud al servidor.',
					icon: 'error',
					confirmButtonText: 'Aceptar'
				});
				console.error('Error en la solicitud:', err);
				// Limpiar la tabla y los campos de entrada incluso si hay un error


			});
	}

	function limpiarTablaMateriales() {
		var tableBody = document.getElementById('materiales-table').getElementsByTagName('tbody')[0];
		tableBody.innerHTML = '';
	}

	function limpiarCamposEntrada() {
		document.getElementById('numero_factura').value = '';
		document.getElementById('descripcion').value = '';
	}

	function downloadJSON(data) {
		// Convertir el objeto data a una cadena JSON
		var jsonData = JSON.stringify(data);
		var blob = new Blob([jsonData], {
			type: 'application/json'
		});
		var url = URL.createObjectURL(blob);
		var a = document.createElement('a');
		a.href = url;
		a.download = 'data.json';
		document.body.appendChild(a);
		a.click();
		window.URL.revokeObjectURL(url);
		document.body.removeChild(a);
	}
	// Asociar funciones a los botones
	document.getElementById('buscar-material-btn').addEventListener('click', buscarMaterial);
	document.getElementById('guardar-movimiento-btn').addEventListener('click', guardarMovimiento);
	// Asociar la función agregarMateria al botón "Agregar Material"
	document.getElementById('agregar-material-btn').addEventListener('click', agregarMaterial);
});