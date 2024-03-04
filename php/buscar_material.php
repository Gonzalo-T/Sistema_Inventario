<?php
// buscar_material.php
header('Content-Type: application/json');

require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

if ($conn->connect_error) {
    echo json_encode(['error' => 'Conexión fallida: ' . $conn->connect_error]);
    exit;
}

$idMaterial = $_GET['id_material'];

// Llamar al procedimiento almacenado
$stmt = $conn->prepare("CALL BuscarMaterial(?)");
$stmt->bind_param("s", $idMaterial);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode(['error' => 'Material no encontrado']);
}

$conn->close();
?>
