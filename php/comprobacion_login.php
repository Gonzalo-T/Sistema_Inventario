<?php
session_start(); // Inicia la sesión PHP

// Comprueba si el usuario está logueado
if (!isset($_SESSION['usuario_logueado'])) {
    header('Location: index.php'); // Redirige al usuario al inicio de sesión si no está logueado
    exit; // Termina la ejecución del script
}
include 'info.php'; // Asegúrate de que la ruta a 'info.php' sea correcta según su ubicación
?>
