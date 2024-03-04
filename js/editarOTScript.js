document.addEventListener("DOMContentLoaded", function () {
    document
        .getElementById("nombre_material")
        .addEventListener("input", function () {
            var nombre_material = this.value;

            if (nombre_material.length >= 3) {
                fetch("php/buscar_material_por_nombre.php?nombre=" + nombre_material)
                    .then((response) => response.json())
                    .then((data) => {
                        var listaResultados = document.getElementById("listaResultados");
                        listaResultados.innerHTML = "";

                        data.forEach((material) => {
                            var div = document.createElement("div");
                            div.innerHTML = material.nombre;
                            div.style.cursor = "pointer";
                            div.onclick = function () {
                                document.getElementById("nombre_material").value =
                                    material.nombre;
                                document.getElementById("id_material").value =
                                    material.id_material;
                                // Aquí puedes completar otros campos si es necesario
                                listaResultados.innerHTML = "";
                            };
                            listaResultados.appendChild(div);
                        });
                    })
                    .catch((error) => {
                        console.error("Error en la solicitud:", error);
                    });
            } else {
                document.getElementById("listaResultados").innerHTML = "";
            }
        });
    function validarSoloLetras(element) {
        // Obtén el contenido actual del div editable
        var contenido = element.textContent || element.innerText;

        // Elimina cualquier carácter que no sea una letra
        contenido = contenido.replace(/[^a-zA-ZáéíóúÁÉÍÓÚ ]/g, "");

        // Actualiza el contenido del div editable
        element.textContent = contenido;
    }

    var materialesAgregados = []; // Lista para almacenar los materiales agregados
    var materialesEliminados = [];

    // Función para buscar material
    function buscarMaterial(event) {
        event.preventDefault();
        // Obtener el ID del material
        var id_material = document.getElementById("id_material").value;

        // Hacer la solicitud al servidor
        fetch("php/rescatar.php?id_material=" + id_material)
            .then((response) => response.json())
            .then((data) => {
                if (data.error) {
                    // Manejar el error si el material no se encuentra
                    alert(data.error);
                } else {
                    // Mostrar los detalles del material
                    document.getElementById("nombreMaterial").textContent = data.nombre;
                    document.getElementById("valorMaterial").textContent = data.valor;
                    document.getElementById("unidadMedida").textContent =
                        data.unidad_medida;
                }
            })
            .catch((error) => {
                // Manejar errores de la solicitud
                console.error("Error en la solicitud:", error);
            });
    }

    // Función para agregar material a la lista
    // Función para agregar material a la lista
    function agregarMaterial() {
        var id_material = document.getElementById("id_material").value;
        var nombre_material = document.getElementById("nombreMaterial").textContent;
        var cantidad = parseInt(document.getElementById("cantidad").value);

        // Agregar el material a la lista
        materialesAgregados.push({
            id_material: id_material,
            nombre_material: nombre_material,
            cantidad: cantidad,
        });

        // Mostrar el material en la tabla
        var tableBody = document.getElementById("materialesUtilizadosTableBody");
        var newRow = tableBody.insertRow();
        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        var cell3 = newRow.insertCell(2);
        var cell4 = newRow.insertCell(3);
        cell1.innerHTML = id_material;
        cell2.innerHTML = nombre_material;
        cell3.innerHTML = cantidad;
        cell4.innerHTML =
            '<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" onclick="eliminarFila(this, true)">Eliminar</button>';

        // Limpiar los campos después de agregar el material
        document.getElementById("id_material").value = ""; // Limpia el campo de ID de material
        document.getElementById("nombreMaterial").textContent = "";
        document.getElementById("valorMaterial").textContent = "";
        document.getElementById("unidadMedida").textContent = "";
        document.getElementById("cantidad").value = "";
    }

    // Función para eliminar una fila de material
    function eliminarFila(button, esMaterialAgregado) {
        if (
            esMaterialAgregado &&
            confirm("¿Estás seguro de que deseas eliminar este material?")
        ) {
            var row = button.parentNode.parentNode;
            var materialId = row.cells[0].textContent;
            row.parentNode.removeChild(row);
            // Eliminar de la lista de materiales agregados
            materialesAgregados = materialesAgregados.filter(
                (material) => material.id_material !== materialId
            );
        }
    }
    // Función para confirmar y eliminar un material de la base de datos
    // Función para confirmar y eliminar un material de la base de datos
    // Función para confirmar y eliminar un material de la base de datos
    function confirmarYEliminarMaterial(materialId, button, event) {
        event.preventDefault();

        Swal.fire({
            title: "¿Estás seguro?",
            text: "¿Deseas eliminar este material?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("php/eliminar_material.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: "id_material=" + encodeURIComponent(materialId),
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            var row = button.parentNode.parentNode;
                            row.parentNode.removeChild(row);
                            Swal.fire(
                                "Eliminado!",
                                "El material ha sido eliminado.",
                                "success"
                            );
                        } else {
                            Swal.fire(
                                "Error",
                                "Error al eliminar el material: " + data.message,
                                "error"
                            );
                        }
                    })
                    .catch((error) => {
                        console.error("Error en la solicitud:", error);
                        Swal.fire(
                            "Error",
                            "Error al comunicarse con el servidor para eliminar el material.",
                            "error"
                        );
                    });
            }
        });
    }

    function buscarIdOT() {
        var id_ot = document.getElementById("id_ot").value;
        var mensajeElemento = document.getElementById("mensaje");
        mensajeElemento.textContent = "Enviando datos al servidor...";

        fetch("php/editar_ot.php?id_ot=" + id_ot)
            .then((response) => response.json())
            .then((data) => {
                if (data.success === false) {
                    // Verificar si el servidor responde con éxito falso
                    Swal.fire({
                        title: "Error",
                        text: "OT no encontrada.",
                        icon: "error",
                        confirmButtonText: "Aceptar",
                    });
                    mensajeElemento.textContent = "OT no encontrada.";
                    mensajeElemento.style.color = "red";
                } else {
                    // Procesar y mostrar datos de la OT
                    document.getElementById("nombreMueble").textContent =
                        data.nombre_mueble;
                    document.getElementById("nombreCategoria").textContent =
                        data.nombre_categoria;
                    document.getElementById("especificaciones").textContent =
                        data.especificaciones_mueble;
                    document.getElementById("ancho").textContent = data.ancho || "";
                    document.getElementById("alto").textContent = data.alto || "";
                    document.getElementById("largo").textContent = data.largo || "";
                    document.getElementById("run").textContent = data.run;
                    document.getElementById("nombreCliente").textContent =
                        data.nombre_cliente;
                    document.getElementById("apellidoCliente").textContent =
                        data.apellido_cliente;
                    document.getElementById("direccionCliente").textContent =
                        data.direccion_cliente;
                    document.getElementById("telefonoCliente").textContent =
                        data.telefono_cliente;
                    document.getElementById("correoCliente").textContent =
                        data.correo_cliente;

                    // Procesar materiales utilizados
                    if (
                        data.materiales_utilizados &&
                        data.materiales_utilizados.length > 0
                    ) {
                        actualizarTablaMaterialesUtilizados(data.materiales_utilizados);
                    } else {
                        mensajeElemento.textContent =
                            "No se encontraron materiales utilizados.";
                        mensajeElemento.style.color = "red";
                    }

                    mensajeElemento.textContent = "Datos obtenidos correctamente.";
                    mensajeElemento.style.color = "green";
                }
            })
            .catch((error) => {
                mensajeElemento.textContent =
                    "Error en la solicitud al servidor: " + error.message;
                mensajeElemento.style.color = "red";
                console.error("Error en la solicitud:", error);
            });
    }

    document
        .getElementById("buscar-ot-btn")
        .addEventListener("click", function (event) {
            event.preventDefault(); // Evitar que la página se actualice
            buscarIdOT();
        });

    function actualizarTablaMaterialesUtilizados(materiales) {
        var materialesUtilizadosTableBody = document.getElementById(
            "materialesUtilizadosTableBody"
        );
        materialesUtilizadosTableBody.innerHTML = ""; // Limpiar la tabla

        materiales.forEach((material) => {
            if (material.id_material && material.nombre_material) {
                // Verificar que el material tenga ID y nombre
                var row = document.createElement("tr");
                row.innerHTML = `
                <td class="mdl-data-table__cell--numeric">${material.id_material}</td>
                <td class="mdl-data-table__cell--numeric">${material.nombre_material}</td>
                <td class="mdl-data-table__cell--numeric">${material.cantidad_utilizada}</td>
                <td><button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" onclick="confirmarYEliminarMaterial('${material.id_material}', this, event)">Eliminar</button>
</td>
            `;
                materialesUtilizadosTableBody.appendChild(row);
            }
        });
    }
    z;

    function guardarMovimiento(event) {
        event.preventDefault();

        var id_ot = document.getElementById("id_ot").value;
        var nombreMueble = document.getElementById("nombreMueble").textContent;
        var nombreCategoria =
            document.getElementById("nombreCategoria").textContent;
        var especificaciones =
            document.getElementById("especificaciones").textContent;
        var ancho = document.getElementById("ancho").textContent;
        var alto = document.getElementById("alto").textContent;
        var largo = document.getElementById("largo").textContent;

        var run = document.getElementById("run").textContent;
        var nombreCliente = document.getElementById("nombreCliente").textContent;
        var apellidoCliente =
            document.getElementById("apellidoCliente").textContent;
        var direccionCliente =
            document.getElementById("direccionCliente").textContent;
        var telefonoCliente =
            document.getElementById("telefonoCliente").textContent;
        var correoCliente = document.getElementById("correoCliente").textContent;

        var entregaData = {
            id_ot: id_ot,
            nombreMueble: nombreMueble,
            nombreCategoria: nombreCategoria,
            especificaciones: especificaciones,
            ancho: ancho,
            alto: alto,
            largo: largo,
            run: run,
            nombreCliente: nombreCliente,
            apellidoCliente: apellidoCliente,
            direccionCliente: direccionCliente,
            telefonoCliente: telefonoCliente,
            correoCliente: correoCliente,
            materiales: materialesAgregados, // Solo incluir materiales agregados recientemente
        };

        fetch("php/guardar_editar.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(entregaData),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    Swal.fire({
                        title: "Éxito",
                        text: "Los cambios se han guardado correctamente.",
                        icon: "success",
                    }).then(() => {
                        limpiarFormulario(); // Llamada a la función para limpiar el formulario
                    });
                } else {
                    Swal.fire({
                        title: "Error",
                        text: data.message,
                        icon: "error",
                    });
                }
            })
            .catch((err) => {
                console.error("Error en la solicitud:", err);
                Swal.fire({
                    title: "Error",
                    text: "Error al realizar la solicitud al servidor.",
                    icon: "error",
                });
            });
    }

    document.getElementById("btn-exit").addEventListener("click", function () {
        Swal.fire({
            title: "¿Estás seguro?",
            text: "¿Deseas cerrar la sesión?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, cerrar sesión",
            cancelButtonText: "No",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "php/logout.php"; // Redirige a logout.php si el usuario confirma
            }
        });
    });

    // Descargar la información como un archivo JSON
    function downloadJSON(data) {
        var jsonData = JSON.stringify(data);
        var blob = new Blob([jsonData], {
            type: "application/json",
        });
        var url = URL.createObjectURL(blob);

        var a = document.createElement("a");
        a.href = url;
        a.download = "datos_entrega.json";
        document.body.appendChild(a);
        a.click();

        // Liberar el objeto URL creado para evitar posibles pérdidas de memoria
        window.URL.revokeObjectURL(url);
        document.body.removeChild(a);
    }

    function limpiarFormulario() {
        // Limpiar campos de texto y áreas editables
        document.getElementById("id_ot").value = "";
        document.getElementById("run").textContent = "";
        document.getElementById("nombreCliente").textContent = "";
        document.getElementById("apellidoCliente").textContent = "";
        document.getElementById("direccionCliente").textContent = "";
        document.getElementById("telefonoCliente").textContent = "";
        document.getElementById("correoCliente").textContent = "";
        document.getElementById("nombreMueble").textContent = "";
        document.getElementById("nombreCategoria").textContent = "";
        document.getElementById("especificaciones").textContent = "";
        document.getElementById("ancho").textContent = "";
        document.getElementById("alto").textContent = "";
        document.getElementById("largo").textContent = "";
        document.getElementById("id_material").value = "";
        document.getElementById("nombreMaterial").textContent = "";
        document.getElementById("valorMaterial").textContent = "";
        document.getElementById("unidadMedida").textContent = "";
        document.getElementById("cantidad").value = "";

        // Limpiar la tabla de materiales utilizados
        var materialesUtilizadosTableBody = document.getElementById(
            "materialesUtilizadosTableBody"
        );
        materialesUtilizadosTableBody.innerHTML = "";

        // Resetear la lista de materiales agregados
        materialesAgregados = [];
        materialesEliminados = [];
    }

    document
        .getElementById("entregar-btn")
        .addEventListener("click", guardarMovimiento);
    document
        .getElementById("buscar-material-btn")
        .addEventListener("click", buscarMaterial);
    document
        .getElementById("agregar-material-btn")
        .addEventListener("click", agregarMaterial);
});
