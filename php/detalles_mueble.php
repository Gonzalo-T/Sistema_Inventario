<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$idMueble = isset($_GET['id']) ? intval($_GET['id']) : 0;

$stmt = $conn->prepare("CALL ObtenerDetallesMueble(?)");
$stmt->bind_param("i", $idMueble);
$stmt->execute();
$result = $stmt->get_result();

if ($mueble = $result->fetch_assoc()) {
    echo json_encode($mueble);
} else {
    echo json_encode([]);
}

$stmt->close();
$conn->close();
?>
