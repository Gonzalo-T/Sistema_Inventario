<?php
session_start(); // Inicia la sesión PHP

// Comprueba si el usuario está logueado
if (!isset($_SESSION['usuario_logueado'])) {
    header('Location: index.php'); // Redirige al inicio de sesión si no está logueado
    exit; // Termina la ejecución del script
}

// Incluye el archivo info2.php (Asegúrate de que la ruta sea correcta)
include 'info2.php';
?>
