<?php
header('Content-Type: application/json');

require_once '../conexion/dbconfig.php'; // Asegúrate de que esta ruta sea correcta

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$idMaterial = $_GET['id_material'];
$stmt = $conn->prepare("CALL ObtenerMaterialPorId(?)");
$stmt->bind_param("s", $idMaterial);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

echo json_encode($data);

$stmt->close();
$conn->close();
?>
