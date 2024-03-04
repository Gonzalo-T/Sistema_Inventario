<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id_ot = $_GET['id_ot'];

// Llamar al nuevo procedimiento almacenado
$stmt = $conn->prepare("CALL ConsultarDetallesOTDOS(?)");
$stmt->bind_param("i", $id_ot);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $response = [
        'nombre_mueble' => $row['nombre_mueble'],
        'id_cliente' => $row['id_cliente'],
        'nombre_cliente' => $row['nombre_cliente'],
        'apellido_cliente' => $row['apellido_cliente'],
        'fecha_inicio' => $row['fecha_inicio'],
        'estado_ot' => $row['nombre_estado'],
        'fecha_fin' => $row['fecha_fin']
    ];

    echo json_encode($response);
} else {
    echo json_encode(['error' => 'OT no encontrada']);
}

$stmt->close();
$conn->close();
?>
