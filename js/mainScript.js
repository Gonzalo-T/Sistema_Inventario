document.addEventListener('DOMContentLoaded', function() {
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