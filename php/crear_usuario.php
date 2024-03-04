<?php

// Datos de conexión a la base de datos
require_once '../conexion/dbconfigUser.php'; // Ajusta la ruta según sea necesario

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener los datos del POST
$input = file_get_contents('php://input');
$data = json_decode($input, true);

$id_usuario = $data['id_usuario'];
$nombre = $data['nombre'];
$apellido = $data['apellido'];
$cargo = $data['cargo'];
$contrasena = $data['contrasena'];
$permisos = $data['permisos'];

// Preparar y ejecutar la consulta para insertar el usuario
$stmt = $conn->prepare("INSERT INTO usuario (id_usuario, nombre, apellido, cargo, contrasena) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $id_usuario, $nombre, $apellido, $cargo, $contrasena);

if ($stmt->execute()) {
    // Si el usuario se inserta correctamente, insertar los permisos
    foreach ($permisos as $id_permiso) {
        $stmt_permiso = $conn->prepare("INSERT INTO usuario_permiso (id_usuario, id_permiso) VALUES (?, ?)");
        $stmt_permiso->bind_param("si", $id_usuario, $id_permiso);
        $stmt_permiso->execute();
        $stmt_permiso->close();
    }

    echo json_encode(array("success" => true, "message" => "Usuario creado correctamente."));
} else {
    echo json_encode(array("success" => false, "message" => "Error al crear el usuario."));
}

$stmt->close();
$conn->close();
?>
