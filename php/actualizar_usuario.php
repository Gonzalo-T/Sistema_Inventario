<?php
session_start(); // Iniciar sesión en PHP

require_once '../conexion/dbconfigUser.php'; // Ajusta la ruta según sea necesario

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
// Verificar la conexión

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
$permisosAñadidos = $data['permisosAñadidos'] ?? [];
$permisosEliminados = $data['permisosEliminados'] ?? [];

// Actualizar información del usuario
$stmt = $conn->prepare("UPDATE usuario SET nombre = ?, apellido = ?, cargo = ?, contrasena = ? WHERE id_usuario = ?");
$stmt->bind_param("sssss", $nombre, $apellido, $cargo, $contrasena, $id_usuario);
$stmt->execute();
$stmt->close();

// Eliminar permisos específicos
if (!empty($permisosEliminados)) {
    foreach ($permisosEliminados as $id_permiso) {
        $delete_stmt = $conn->prepare("DELETE FROM usuario_permiso WHERE id_usuario = ? AND id_permiso = ?");
        $delete_stmt->bind_param("si", $id_usuario, $id_permiso);
        $delete_stmt->execute();
        $delete_stmt->close();
    }
}

// Insertar permisos añadidos
if (!empty($permisosAñadidos)) {
    foreach ($permisosAñadidos as $id_permiso) {
        $insert_stmt = $conn->prepare("INSERT INTO usuario_permiso (id_usuario, id_permiso) VALUES (?, ?)");
        $insert_stmt->bind_param("si", $id_usuario, $id_permiso);
        $insert_stmt->execute();
        $insert_stmt->close();
    }
}

echo json_encode(array("success" => true, "message" => "Usuario actualizado correctamente."));

$conn->close();
?>
