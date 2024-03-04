<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$run = isset($_GET['run']) ? $conn->real_escape_string($_GET['run']) : '';

$stmt = $conn->prepare("CALL ObtenerDetallesCliente(?)");
$stmt->bind_param("s", $run);
$stmt->execute();
$result = $stmt->get_result();

$response = array();

if ($result->num_rows > 0) {
    $cliente = $result->fetch_assoc();
    $response = [
        'encontrado' => true,
        'cliente' => $cliente
    ];
} else {
    $response = ['encontrado' => false];
}

$stmt->close();
$conn->close();

echo json_encode($response);
?>
