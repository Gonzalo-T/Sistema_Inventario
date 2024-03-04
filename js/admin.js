
$('#btn-agregar-permiso').click(function() {
    $('#lista-permisos-disponibles option:selected').each(function() {
        var permisoSeleccionado = $(this);
        permisoSeleccionado.remove();
        $('#lista-permisos-asignados').append(permisoSeleccionado);
    });
});

$('#btn-quitar-permiso').click(function() {
    $('#lista-permisos-asignados option:selected').each(function() {
        var permisoSeleccionado = $(this);
        permisoSeleccionado.remove();
        $('#lista-permisos-disponibles').append(permisoSeleccionado);
    });
});

$(document).ready(function() {
    function cargarPermisos() {
        $.ajax({
            type: "GET",
            url: "php/obtener_permisos.php",
            dataType: "json",
            success: function(response) {
                // Cargar permisos en la pestaña de crear usuario
                var selectorPermisosCrear = $('#lista-permisos-disponibles');
                selectorPermisosCrear.empty();
                response.permisos.forEach(function(permiso) {
                    selectorPermisosCrear.append(new Option(permiso.nombre, permiso.id_permiso));
                });

                // Cargar permisos en la pestaña de editar usuario
                var selectorPermisosEditar = $('#editarPermisosDisponibles');
                selectorPermisosEditar.empty();
                response.permisos.forEach(function(permiso) {
                    selectorPermisosEditar.append(new Option(permiso.nombre, permiso.id_permiso));
                });
            },
            error: function(error) {
                console.error("Error al cargar permisos:", error);
            }
        });
    }
    cargarPermisos();
    $('#entregar-btn').click(function(event) {
        event.preventDefault();

        var permisosSeleccionados = [];
        $('#lista-permisos-asignados option').each(function() {
            permisosSeleccionados.push($(this).val());
        });

        var datosUsuario = {
            id_usuario: $('#DNIAdmin').val(),
            nombre: $('#NameAdmin').val(),
            apellido: $('#LastNameAdmin').val(),
            cargo: $('#CargoAdmin').val(),
            contrasena: $('#passwordAdmin').val(),
            permisos: permisosSeleccionados
        };

        $.ajax({
            type: "POST",
            url: "php/crear_usuario.php",
            data: JSON.stringify(datosUsuario),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function(data) {
                if (data.success) {
                    Swal.fire({
                        title: 'Éxito',
                        text: 'Usuario creado con éxito',
                        icon: 'success',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#formulario-crear-usuario').find('input[type=text], input[type=password], select').val('');
                            $('#lista-permisos-asignados').empty();
                            cargarPermisos();
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'Error al crear el usuario',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                }
            },
            error: function(error) {
                console.error("Error al enviar datos del usuario:", error);
                Swal.fire({
                    title: 'Error',
                    text: 'Error al crear el usuario',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            }
        });
    });

    function cargarUsuarios() {
        $.ajax({
            type: "GET",
            url: "php/listar_usuarios.php",
            dataType: "json",
            success: function(response) {
                var listaUsuarios = $('#lista-usuarios');
                listaUsuarios.empty();
                response.usuarios.forEach(function(usuario) {
                    listaUsuarios.append(`<tr>
        <td>${usuario.id_usuario}</td>
        <td>${usuario.nombre}</td>
        <td>${usuario.apellido}</td>
        <td>${usuario.cargo}</td>
        <td>
            <button class="eliminar-usuario-btn" data-id="${usuario.id_usuario}">Eliminar</button>
        </td>
    </tr>`);
                });
            },
            error: function(error) {
                console.error("Error al cargar usuarios:", error);
            }
        });
    }

    $('.mdl-tabs__tab').click(function() {
        if ($(this).attr('href') === '#tabListAdmin') {
            cargarUsuarios();
        }
    });















    function cargarDatosUsuarioParaEditar(idUsuario) {
        $.ajax({
            type: "GET",
            url: `php/obtener_usuario.php?id=${idUsuario}`,
            dataType: "json",
            success: function(data) {
                $('#editarDNIAdmin').val(data.usuario.id_usuario);
                $('#editarNameAdmin').val(data.usuario.nombre);
                $('#editarLastNameAdmin').val(data.usuario.apellido);
                $('#editarCargoAdmin').val(data.usuario.cargo);
                $('#editarPasswordAdmin').val(data.usuario.contrasena);

                var permisosAsignadosSelect = $('#editarPermisosAsignados');
                var permisosDisponiblesSelect = $('#editarPermisosDisponibles');

                // Cargar todos los permisos disponibles
                cargarPermisosEditar(data.permisos_disponibles, permisosDisponiblesSelect, data.permisos_asignados);

                // Añadir los permisos asignados al usuario a la lista editarPermisosAsignados
                data.permisos_asignados.forEach(function(permiso) {
                    var option = new Option(permiso.nombre, permiso.id_permiso, false, true);
                    permisosAsignadosSelect.append(option);
                });

                $('.mdl-tabs__tab[href="#tabEditAdmin"]').click();
            },
            error: function(error) {
                console.error("Error al cargar datos del usuario:", error);
            }
        });
    }


    $('#btn-buscar-usuario').click(function(event) {
        event.preventDefault();
        var idUsuario = $('#buscarDNIAdmin').val();
        cargarDatosUsuarioParaEditar(idUsuario);
    });

    function cargarDatosUsuarioParaEditar(idUsuario) {
        $.ajax({
            type: "GET",
            url: `php/obtener_usuario.php?idUsuario=${idUsuario}`,
            dataType: "json",
            success: function(data) {
                if (data.usuario) {
                    // Llenar los campos del formulario con los datos del usuario
                    $('#editarDNIAdmin').val(data.usuario.id_usuario);
                    $('#editarNameAdmin').val(data.usuario.nombre);
                    $('#editarLastNameAdmin').val(data.usuario.apellido);
                    $('#editarCargoAdmin').val(data.usuario.cargo);
                    $('#editarPasswordAdmin').val(data.usuario.contrasena);

                    // Cargar permisos asignados y disponibles
                    cargarPermisosEnFormularioEditar(data);
                } else {
                    alert('Usuario no encontrado o error al cargar datos.');
                }
            },
            error: function(error) {
                console.error("Error al cargar datos del usuario:", error);
            }
        });
    }










    function cargarPermisosEnFormularioEditar(data) {
        var permisosAsignadosSelect = $('#editarPermisosAsignados');
        var permisosDisponiblesSelect = $('#editarPermisosDisponibles');

        permisosAsignadosSelect.empty();
        permisosDisponiblesSelect.empty();

        data.permisos_disponibles.forEach(function(permiso) {
            if (data.permisos_asignados.some(p => p.id_permiso === permiso.id_permiso)) {
                var optionAsignado = new Option(permiso.nombre, permiso.id_permiso, false, true);
                permisosAsignadosSelect.append(optionAsignado);
            } else {
                var optionDisponible = new Option(permiso.nombre, permiso.id_permiso);
                permisosDisponiblesSelect.append(optionDisponible);
            }
        });
    }










    $('#btn-actualizar-usuario').click(function(event) {
        event.preventDefault();

        var permisosOriginales = [];
        var permisosActuales = [];
        var permisosAñadidos = [];
        var permisosEliminados = [];

        // Obtener los permisos originales y los actuales
        $('#editarPermisosAsignados option').each(function() {
            permisosActuales.push($(this).val());
        });
        $('#editarPermisosDisponibles option').each(function() {
            permisosOriginales.push($(this).val());
        });

        // Determinar los permisos añadidos
        permisosAñadidos = permisosActuales.filter(function(permiso) {
            return !permisosOriginales.includes(permiso);
        });

        // Determinar los permisos eliminados
        permisosEliminados = permisosOriginales.filter(function(permiso) {
            return !permisosActuales.includes(permiso);
        });

        var datosUsuario = {
            id_usuario: $('#editarDNIAdmin').val(),
            nombre: $('#editarNameAdmin').val(),
            apellido: $('#editarLastNameAdmin').val(),
            cargo: $('#editarCargoAdmin').val(),
            contrasena: $('#editarPasswordAdmin').val(),
            permisosAñadidos: permisosAñadidos,
            permisosEliminados: permisosEliminados
        };

        // Enviar datos al servidor
        $.ajax({
            type: "POST",
            url: "php/actualizar_usuario.php",
            data: JSON.stringify(datosUsuario),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Éxito',
                        text: 'Usuario actualizado con éxito',
                        icon: 'success',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Limpiar los campos del formulario
                            $('#formulario-editar-usuario').find('input[type=text], input[type=password], select').val('');
                            $('#editarPermisosAsignados').empty();
                            // Recargar los permisos disponibles
                            cargarPermisos();
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'Error al actualizar el usuario',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                }
            },
            error: function(error) {
                console.error("Error al actualizar el usuario:", error);
                Swal.fire({
                    title: 'Error',
                    text: 'Error al actualizar el usuario',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            }
        });
    });
    $('#editarBtnAgregarPermiso').click(function() {
        $('#editarPermisosDisponibles option:selected').appendTo('#editarPermisosAsignados');
    });

    // Función para quitar un permiso
    $('#editarBtnQuitarPermiso').click(function() {
        $('#editarPermisosAsignados option:selected').appendTo('#editarPermisosDisponibles');
    });


    // Función para descargar datos como un archivo JSON
    function downloadJSON(datosUsuario) {
        var blob = new Blob([datosUsuario], {
            type: 'application/json'
        });
        var url = URL.createObjectURL(blob);
        var a = document.createElement('a');
        a.href = url;
        a.download = 'dataUsuario.json';
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
    }




    $(document).on('click', '.eliminar-usuario-btn', function() {
        var idUsuario = $(this).data('id');
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "php/eliminar_usuario.php",
                    data: {
                        id_usuario: idUsuario
                    },
                    success: function(response) {
                        cargarUsuarios(); // Recarga la lista de usuarios
                        Swal.fire('Eliminado', 'El usuario ha sido eliminado.', 'success');
                    },
                    error: function() {
                        Swal.fire('Error', 'No se pudo eliminar el usuario.', 'error');
                    }
                });
            }
        });
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

    var rotateIcon = document.getElementById('btn-menu');

    rotateIcon.addEventListener('click', function() {
        this.classList.toggle('rotate180');
    });

    
});
