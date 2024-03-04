<?php
header('Content-Type: application/json');

require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$input = json_decode(file_get_contents('php://input'), true);

$stmt = $conn->prepare("CALL ActualizarMaterialdos(?, ?, ?, ?, ?)");
$stmt->bind_param("ssiss", $input['id_material'], $input['nombre'], $input['valor'], $input['id_familia'], $input['unidad_medida']);
$success = $stmt->execute();

echo json_encode(['success' => $success]);

$stmt->close();
$conn->close();
?>
