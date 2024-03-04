document.getElementById('buscar-materialdos-btn').addEventListener('click', function(event) {
    event.preventDefault();
    var idMaterial = document.getElementById('id_materialdos').value;

    fetch(`php/buscar_materialdos.php?id_material=${idMaterial}`)
        .then(response => response.json())
        .then(data => {
            if (data) {
                document.getElementById('nombredos').value = data.nombre || '';
                document.getElementById('valordos').value = data.valor || '';
                cargarFamilias(data.id_familia);
                document.getElementById('unidaddos').value = data.unidad_medida || '';
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se encontraron datos para el material con el código proporcionado.'
                });
            }
        })
        .catch(error => {
            console.error('Error al buscar la información del material:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Ocurrió un error al buscar la información del material.'
            });
        });
});

function cargarFamilias(idFamiliaSeleccionada) {
    fetch('php/listar_familias.php')
        .then(response => response.json())
        .then(data => {
            var selectFamilia = document.getElementById('nombre_familiados');
            selectFamilia.innerHTML = '';

            data.familias.forEach(familia => {
                var opcion = document.createElement('option');
                opcion.value = familia.id_familia;
                opcion.text = familia.nombre;
                opcion.selected = familia.id_familia.toString() === idFamiliaSeleccionada.toString(); // Compara como strings
                selectFamilia.appendChild(opcion);
            });
        })
        .catch(error => {
            console.error('Error al cargar las familias:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Ocurrió un error al cargar las familias.'
            });
        });
}

document.getElementById('editar-materialdos-btn').addEventListener('click', function(event) {
    event.preventDefault();
    var idMaterial = document.getElementById('id_materialdos').value;
    var nombre = document.getElementById('nombredos').value;
    var valor = document.getElementById('valordos').value;
    var familia = document.getElementById('nombre_familiados').value; // Asegúrate de que este es el ID de la familia
    var unidad = document.getElementById('unidaddos').value;

    fetch('php/editar_materialdos.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({id_material: idMaterial, nombre: nombre, valor: valor, id_familia: familia, unidad_medida: unidad})
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: 'Material actualizado con éxito.'
            }).then((result) => {
                if (result.isConfirmed || result.dismiss === Swal.DismissReason.backdrop) {
                    location.reload(); // Recarga la página después de cerrar el Swal
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al actualizar el material.'
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Ocurrió un error al actualizar el material.'
        });
    });
});




    document.addEventListener('DOMContentLoaded', function() {
        let paginaActualMaterial = 1;
        const materialesPorPagina = 10; // Ajusta según la cantidad deseada
    
        function cargarMaterialesdos(busqueda = '') {
            fetch(`php/obtener_materialesdos.php?busqueda=${encodeURIComponent(busqueda)}&pagina=${paginaActualMaterial}&limite=${materialesPorPagina}`)
                .then(response => response.json())
                .then(data => {
                    mostrarMateriales(data.materiales);
                })
                .catch(error => console.error('Error:', error));
        }
    
        function mostrarMateriales(materiales) {
            const tbody = document.getElementById('tabla-materiales-bodydos');
            tbody.innerHTML = '';
            materiales.forEach(material => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${material.id_material}</td>
                    <td>${material.nombre}</td>
                    <td>${material.valor}</td>
                    <td>${material.nombre_familia}</td>
                    <td>${material.unidad_medida}</td>
                `;
                tbody.appendChild(tr);
            });
        }
    
        document.getElementById('buscar-material-btn').addEventListener('click', (event) => {
            event.preventDefault();
            const busqueda = document.getElementById('busqueda-material').value;
            paginaActualMaterial = 1;
            cargarMaterialesdos(busqueda);
        });
    
        document.getElementById('anterior-material-btn').addEventListener('click', (event) => {
            event.preventDefault();
            if (paginaActualMaterial > 1) {
                paginaActualMaterial--;
                cargarMaterialesdos();
            }
        });
    
        document.getElementById('siguiente-material-btn').addEventListener('click', (event) => {
            event.preventDefault();
            paginaActualMaterial++;
            cargarMaterialesdos();
        });
    
        cargarMaterialesdos();
    });
    


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
                           
                            document.getElementById('id_materialdos').value = material.id_material;
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







    var familiaDropdown; // Declarar la variable fuera de la función
    $(document).ready(function () {
        function llenarDropdownFamilias() {
            $.ajax({
                type: "POST",
                url: "php/buscar_familia.php",
                contentType: "application/x-www-form-urlencoded",
                dataType: "json",
                success: function (response) {
                    if (response.familias) {
                        familiaDropdown = $("#nombre_familia");
                        familiaDropdown.empty(); // Limpiar el dropdown existente
                        response.familias.forEach(function (familia) {
                            var option = $("<option></option>")
                                .attr("value", familia.id_familia)
                                .text(familia.nombre);
                            familiaDropdown.append(option);
                        });
                    } else {
                        console.error("Error: No se encontraron familias en la respuesta del servidor.");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error en la solicitud AJAX: " + error);
                }
            });
        }

        function llenarDropdownFamiliasEdit(familiaDropdownEdit, idFamiliaActual, familiaActual) {
            $.ajax({
                type: "POST",
                url: "php/buscar_familia.php",
                dataType: "json",
                success: function (response) {
                    if (response.familias) {
                        familiaDropdownEdit.empty(); // Limpiar el dropdown
                        response.familias.forEach(function (familia) {
                            var option = $("<option></option>")
                                .attr("value", familia.id_familia)
                                .text(familia.nombre);
                            familiaDropdownEdit.append(option);
                        });
                        familiaDropdownEdit.val(idFamiliaActual); // Establecer el valor actual
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error en la solicitud AJAX: " + error);
                }
            });
        }

        $("#tabla-materiales-body").on("click", ".editar-material-btn", function () {
            var row = $(this).closest('tr');
            var familiaActual = row.find('.familia-material').text();
            var idFamiliaActual = row.find('.familia-material').data('id-familia'); // Asegúrate de que el Código de la familia esté disponible en el DOM
            var familiaDropdownEdit = $("<select class='familia-material-edit'></select>");
            llenarDropdownFamiliasEdit(familiaDropdownEdit, idFamiliaActual, familiaActual);
            row.find('.familia-material').replaceWith(familiaDropdownEdit);
            // Resto del código para activar la edición
        });

        $("#tabla-materiales-body").on("click", ".guardar-cambios-btn", function () {
            var row = $(this).closest('tr');
            var id_material = row.find('td:eq(0)').text();
            var nombre = row.find('.nombre-material').val();
            var valor = parseInt(row.find('.valor-material').val());
            var familia = parseInt(row.find('.familia-material-edit').val());
            var unidad = row.find('.unidad-material').val();

            var formData = {
                form_type: 'materiales',
                id_material: id_material,
                nombre: nombre,
                valor: valor,
                familia: familia,
                unidad: unidad
            };

            fetch('php/editar_material.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formData),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Éxito',
                            text: 'Material actualizado correctamente.',
                            icon: 'success'
                        });
                        // Actualizar el texto de la fila con los nuevos datos del material
                        row.find('.nombre-material').val(nombre);
                        row.find('.valor-material').val(valor);

                        // Obtener el nombre de la familia seleccionada y reemplazar el dropdown por un texto
                        var familiaNombre = row.find(".familia-material-edit option:selected").text();
                        var familiaSpan = $("<span></span>").text(familiaNombre).addClass('familia-material');
                        row.find('.familia-material-edit').replaceWith(familiaSpan);

                        row.find('.unidad-material').val(unidad);

                        // Ocultar el botón de guardar y mostrar el de editar
                        row.find('.guardar-cambios-btn').hide();
                        row.find('.editar-material-btn').show();
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: data.message,
                            icon: 'error'
                        });
                    }
                })
                .catch(err => {
                    Swal.fire({
                        title: 'Error',
                        text: 'Error al realizar la solicitud al servidor.',
                        icon: 'error'
                    });
                });
        });

        $("#tabla-familia-body").on("click", ".editar-familia-btn", function (event) {
            event.preventDefault();
            var row = $(this).closest('tr');
            var nombreFamilia = row.find('.nombre-familia').text();
            row.find('.nombre-familia').html('<input type="text" class="nombre-familia-edit" value="' + nombreFamilia + '">');
            $(this).hide();
            row.find('.guardar-familia2-btn').show();
        });

        $("#tabla-familia-body").on("click", ".guardar-familia2-btn", function (event) {
            event.preventDefault();
            var row = $(this).closest('tr');
            var idFamilia = row.find('td:eq(0)').text();
            var nombreFamiliaEditado = row.find('.nombre-familia-edit').val();

            var formData = {
                form_type: 'familias',
                id_familia: idFamilia,
                nombre_familia: nombreFamiliaEditado
            };

            fetch('php/editar_familia.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formData),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Éxito',
                            text: 'Familia actualizada correctamente.',
                            icon: 'success'
                        });
                        // Actualizar el texto de la fila con el nuevo nombre de familia
                        row.find('.nombre-familia').html(nombreFamiliaEditado);
                        // Ocultar el botón de guardar y mostrar el de editar
                        row.find('.guardar-familia2-btn').hide();
                        row.find('.editar-familia-btn').show();
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: data.message,
                            icon: 'error'
                        });
                    }
                })
                .catch(err => {
                    Swal.fire({
                        title: 'Error',
                        text: 'Error al realizar la solicitud al servidor.',
                        icon: 'error'
                    });
                });
        });

        function guardarMaterial(event) {
            event.preventDefault();
        
            var id_material = document.getElementById('id_material').value;
            var nombre = document.getElementById('nombre').value;
            var valor = parseInt(document.getElementById('valor').value);
            var familia = parseInt(familiaDropdown.val());
            var unidad = document.getElementById('unidad').value;
        
            var formData = {
                form_type: 'materiales',
                id_material: id_material,
                nombre: nombre,
                valor: valor,
                familia: familia,
                unidad: unidad
            };
        
            fetch('php/crear_material.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formData),
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => {
                        throw new Error(err.message || 'Error en el servidor');
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Éxito',
                        text: 'Material guardado correctamente.',
                        icon: 'success'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    // Mostrar solo el mensaje de error
                    Swal.fire({
                        title: 'Error',
                        text: data.message, // Aquí se muestra solo el mensaje de error
                        icon: 'error'
                    });
                }
            })
            .catch(err => {
                console.error('Error en la solicitud:', err);
                // Mostrar solo el mensaje de error
                Swal.fire({
                    title: 'Error',
                    text: err.message, // Aquí se muestra solo el mensaje de error
                    icon: 'error'
                });
            });
        }
        
        document.getElementById('guardar-material-btn').addEventListener('click', guardarMaterial);
        
       
        
      


        function actualizarFamilia(response) {
            var tablaBody = $("#tabla-familia-body");
            tablaBody.empty(); // Limpiar la tabla

            if (response.familias) {
                response.familias.forEach(function (familia) {
                    var row = $("<tr></tr>");
                    row.append("<td>" + familia.id_familia + "</td>");
                    row.append("<td class='nombre-familia'>" + familia.nombre + "</td>");

                    // Agregar botones de editar y guardar en la misma celda
                    var btnCell = $("<td></td>");
                    var editarBtn = $("<button class='editar-familia-btn'>Editar</button>");
                    var guardarBtn = $("<button class='guardar-familia2-btn' style='display:none;'>Guardar</button>");

                    btnCell.append(editarBtn).append(guardarBtn);
                    row.append(btnCell);

                    tablaBody.append(row);
                });
            } else {
                console.error("Error: No se encontraron familias.");
            }
        }


        // Llamar a la función de actualizarFamilia después de recibir los datos del servidor
        $.ajax({
            type: "POST",
            url: "php/buscar_familia.php",
            contentType: "application/x-www-form-urlencoded",
            dataType: "json",
            success: function (response) {
                llenarDropdownFamilias(); // Llenar el dropdown de familias
                actualizarFamilia(response); // Actualizar la tabla de familias
            },
            error: function (xhr, status, error) {
                consoeventle.error("Error en la solicitud AJAX: " + error);
            }
        });
    });


    function guardarFamilia(event) {
        event.preventDefault();

        var nom_familia = document.getElementById('nom_familia').value;

        var formData = {
            form_type: 'familias',
            nom_familia: nom_familia
        };

        fetch('php/familia.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData),
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Éxito',
                        text: data.message, // Mensaje de éxito
                        icon: 'success'
                    }).then(() => {
                        // Recargar la página después de un breve retraso
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: data.message, // Mensaje de error
                        icon: 'error'
                    });
                }
            })
            .catch(err => {
                Swal.fire({
                    title: 'Error',
                    text: 'Error al realizar la solicitud al servidor.',
                    icon: 'error'
                });
            });
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

    function validarFormularioFamilia() {
        var nomFamilia = document.getElementById('nom_familia').value.trim();
        if (nomFamilia === '') {
            Swal.fire({
                title: 'Campo Obligatorio',
                text: 'Por favor, ingresa el nombre de la familia.',
                icon: 'warning',
                confirmButtonText: 'Aceptar'
            });
            return false;
        }
        return true;
    }

    document.getElementById('guardar-familia-btn').addEventListener('click', function (event) {
        event.preventDefault();
        if (validarFormularioFamilia()) {
            guardarFamilia(event);
        }
    });



    function cargarCategorias() {
        fetch('php/listar_categorias.php')
            .then(response => response.json())
            .then(data => actualizarTablaCategorias(data))
            .catch(error => console.error('Error:', error));
    }

    function actualizarTablaCategorias(data) {
        const tablaBody = document.getElementById('tabla-categoria-body');
        tablaBody.innerHTML = '';
        data.categorias.forEach(categoria => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${categoria.id_categoria}</td>
                <td>${categoria.nombre}</td>
                <td>
                    <button onclick="activarEdicion(${categoria.id_categoria}, this)">Editar</button>
                    <button onclick="editarCategoria(${categoria.id_categoria}, this)" style="display: none;">Guardar Cambios</button>
                </td>
            `;
            tablaBody.appendChild(tr);
        });
    }

    window.activarEdicion = (id, btn) => {
        const row = btn.closest('tr');
        const cell = row.cells[1];
        cell.contentEditable = true;
        cell.focus();
        btn.style.display = 'none';
        row.querySelector('button[onclick^="editarCategoria"]').style.display = '';
    };



    window.editarCategoria = (id, btn) => {
        const row = btn.closest('tr');
        const nombre = row.cells[1].textContent;
        fetch('php/editar_categoria.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id_categoria: id, nombre: nombre })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire("Éxito", "Categoría actualizada correctamente", "success");
                    cargarCategorias();
                } else {
                    Swal.fire("Error", data.message, "error");
                }
            })
            .catch(error => console.error('Error:', error));
    };

    document.getElementById('guardar-categoria-btn').addEventListener('click', (event) => {
        event.preventDefault();

        // Obtener el valor del campo Nombre de la Categoría
        const nombreCategoria = document.getElementById('nombre_categoria').value.trim();

        // Verificar si el campo está vacío
        if (nombreCategoria === '') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Por favor, ingrese un nombre de categoría.',
            });
            return; // Detener la ejecución si el campo está vacío
        }

        // Resto del código para enviar la solicitud al servidor
        fetch('php/crear_categoria.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ nombre: nombreCategoria })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire("Éxito", "Categoría creada correctamente", "success");
                    cargarCategorias();
                }
            })
            .catch(error => console.error('Error:', error));
    });

    cargarCategorias();

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

    var rotateIcon = document.getElementById('btn-menu');

    rotateIcon.addEventListener('click', function () {
        this.classList.toggle('rotate180');
    });
