<?php
header('Content-Type: application/json');
require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

$data = json_decode(file_get_contents('php://input'), true);
$id_categoria = $data['id_categoria'];
$nombre = $data['nombre'];

$stmt = $conn->prepare("CALL ActualizarCategoria(?, ?)");
$stmt->bind_param('is', $id_categoria, $nombre);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Categoría actualizada exitosamente']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar la categoría: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
