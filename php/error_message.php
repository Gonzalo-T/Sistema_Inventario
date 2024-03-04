<?php
session_start();

if (isset($_SESSION['error'])) {
    echo $_SESSION['error'];
    unset($_SESSION['error']); // Limpiar el mensaje de error de la sesión
} else {
    echo ""; // No hay mensaje de error
}
?>
