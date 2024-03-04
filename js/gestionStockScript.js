document.addEventListener('DOMContentLoaded', function() {
    // Variables para controlar la paginación
    let paginaActual = 1;
    const materialesPorPagina = 15;

    // Función para cargar los materiales con búsqueda opcional
    function cargarMateriales(busqueda = '') {
        fetch(`php/obtener_materiales.php?busqueda=${encodeURIComponent(busqueda)}&pagina=${paginaActual}&limite=${materialesPorPagina}`)
            .then(response => response.json())
            .then(data => {
                if (data.materiales.length === 0) {
                    Swal.fire({
                        icon: 'info',
                        title: 'No se encontraron similitudes',
                        text: 'No se encontraron materiales que coincidan con la búsqueda.',
                    });
                }
                mostrarMateriales(data);
            })
            .catch(error => console.error('Error:', error));
    }

    // Función para mostrar los materiales en la tabla
    function mostrarMateriales(data) {
        const tbody = document.getElementById('tbody-stock');
        tbody.innerHTML = '';
        data.materiales.forEach(material => {
            const stock = material.cantidad === null ? 0 : material.cantidad;
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${material.id_material}</td>
                <td>${material.nombre}</td>
                <td>${material.familia}</td>
                <td>${stock}</td>
                <td>${material.unidad_medida}</td>
            `;
            tbody.appendChild(tr);
        });
    }

    // Evento para el botón de búsqueda
    document.getElementById('buscar-btn').addEventListener('click', (event) => {
        event.preventDefault(); // Previene la recarga de la página
        const busqueda = document.getElementById('busqueda').value;
        paginaActual = 1; // Reinicia la paginación al buscar
        cargarMateriales(busqueda);
    });

    // Eventos para botones de paginación
    document.getElementById('anterior-btn').addEventListener('click', (event) => {
        event.preventDefault();
        if (paginaActual > 1) {
            paginaActual--;
            cargarMateriales();
        }
    });

    document.getElementById('siguiente-btn').addEventListener('click', (event) => {
        event.preventDefault();
        paginaActual++;
        cargarMateriales();
    });

    // Cargar la primera página al iniciar
    cargarMateriales();


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