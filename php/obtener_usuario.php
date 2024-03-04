<?php
session_start(); // Iniciar sesión en PHP

require_once '../conexion/dbconfigUser.php'; // Ajusta la ruta según sea necesario

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id_usuario = $_GET['idUsuario'] ?? ''; // Obtén el ID del usuario de la URL

if (empty($id_usuario)) {
    echo json_encode(['error' => 'No se proporcionó el ID del usuario.']);
    exit;
}

// Consulta para obtener los datos del usuario
$query_usuario = "SELECT * FROM usuario WHERE id_usuario = '$id_usuario'";
$resultado_usuario = mysqli_query($conn, $query_usuario);
$usuario = mysqli_fetch_assoc($resultado_usuario);

// Verifica que los datos del usuario se hayan obtenido correctamente
if (!$usuario) {
    echo json_encode(['error' => "No se encontró el usuario con ID: $id_usuario"]);
    exit;
}

// Consulta para obtener los permisos asignados al usuario junto con detalles de la tabla usuario_permiso
$query_permisos_asignados = "SELECT permiso.*, usuario_permiso.id_usuario_permiso 
                             FROM permiso 
                             JOIN usuario_permiso ON permiso.id_permiso = usuario_permiso.id_permiso 
                             WHERE usuario_permiso.id_usuario = '$id_usuario'";
$resultado_permisos_asignados = mysqli_query($conn, $query_permisos_asignados);
$permisos_asignados = mysqli_fetch_all($resultado_permisos_asignados, MYSQLI_ASSOC);

// Consulta para obtener todos los permisos disponibles
$query_permisos_disponibles = "SELECT * FROM permiso";
$resultado_permisos_disponibles = mysqli_query($conn, $query_permisos_disponibles);
$permisos_disponibles = mysqli_fetch_all($resultado_permisos_disponibles, MYSQLI_ASSOC);

// Preparar y enviar la respuesta
echo json_encode([
    'usuario' => $usuario,
    'permisos_asignados' => $permisos_asignados,
    'permisos_disponibles' => $permisos_disponibles
]);
?>
