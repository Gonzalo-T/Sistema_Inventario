<?php
// session_start(); // Iniciar sesión en PHP

if (!isset($_SESSION['id_usuario'])) {
    echo "Usuario no logueado o no encontrado";
    exit;
}

$id_usuario = $_SESSION['id_usuario'];

// Incluir detalles de conexión de dbconfigUser.php
require_once __DIR__ . '/../conexion/dbconfigUser.php';

 // Ajusta la ruta según sea necesario

// Crear conexión con los detalles de dbconfigUser.php
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener el nombre del usuario y verificar si tiene permiso de administrador
$sql = "SELECT u.nombre, u.apellido, 
               (SELECT COUNT(*) FROM usuario_permiso WHERE id_usuario = u.id_usuario AND id_permiso = 2) AS es_admin
        FROM usuario u
        WHERE u.id_usuario = '$id_usuario'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombreCompleto = $row['nombre'] . ' ' . $row['apellido'];
    $rol = $row['es_admin'] > 0 ? 'Administrador' : 'Usuario';
} else {
    echo "Usuario no encontrado";
    exit;
}

$conn->close();
?>









