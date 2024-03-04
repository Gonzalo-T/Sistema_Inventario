<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);

$id_ot = $data['id_ot'];
$fecha_fin = $data['fecha_fin'];
$estadoId = $data['estadoId'];

$stmt = $conn->prepare("CALL ActualizarOT(?, ?, ?, @resultado)");
$stmt->bind_param("isi", $id_ot, $fecha_fin, $estadoId);
$stmt->execute();

// Obtener el resultado del procedimiento almacenado
$resultQuery = $conn->query("SELECT @resultado AS resultado");
$resultado = $resultQuery->fetch_assoc();

if ($resultado['resultado']) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar OT']);
}

$stmt->close();
$conn->close();
?>
