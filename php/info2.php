<?php
// No es necesario iniciar sesión aquí si ya se inició en comprobacion_usuario.php

if (!isset($_SESSION['id_usuario'])) {
    echo "Usuario no logueado o no encontrado";
    exit;
}

$id_usuario = $_SESSION['id_usuario'];

require_once __DIR__ . '/../conexion/dbconfigUser.php';

// Crear conexión
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta segura utilizando sentencias preparadas
$sql = "SELECT u.nombre, u.apellido, 
               (SELECT COUNT(*) FROM usuario_permiso WHERE id_usuario = ? AND id_permiso = 2) AS es_admin
        FROM usuario u
        WHERE u.id_usuario = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id_usuario, $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombreCompleto = $row['nombre'] . ' ' . $row['apellido'];
    $esAdmin = $row['es_admin'] > 0;

    if (!$esAdmin) {
        $_SESSION['permiso_insuficiente'] = true;
        header('Location: home.php');
        exit;
    }

    $rol = 'Administrador';
} else {
    echo "Usuario no encontrado";
    exit;
}

$conn->close();
?>

