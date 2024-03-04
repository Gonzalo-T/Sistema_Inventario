<?php
header('Content-Type: application/json');


require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);
$id_ot = $data['id_ot'];
$monto_total = $data['monto_total'];
$fecha_cotizacion = $data['fecha_cotizacion'];

$stmt = $conn->prepare("CALL InsertarCotizacionCliente(?, ?, ?, @exitoso)");
$stmt->bind_param("dsi", $monto_total, $fecha_cotizacion, $id_ot);
$stmt->execute();

// Consultar el valor de retorno del procedimiento almacenado
$result = $conn->query("SELECT @exitoso AS exitoso");
$row = $result->fetch_assoc();
$exitoso = $row['exitoso'];

if ($exitoso) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $conn->error]);
}

$stmt->close();
$conn->close();
?>
