<?php
require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nombre_material = $_GET['nombre'] ?? '';

$stmt = $conn->prepare("CALL BuscarMaterialNombre(?)");
$stmt->bind_param("s", $nombre_material);
$stmt->execute();
$result = $stmt->get_result();

$materiales = [];
while ($row = $result->fetch_assoc()) {
    $materiales[] = $row;
}

$stmt->close();
$conn->close();

echo json_encode($materiales);
?>
