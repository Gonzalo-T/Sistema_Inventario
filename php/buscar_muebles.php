<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$termino = isset($_GET['termino']) ? $conn->real_escape_string($_GET['termino']) : '';

$stmt = $conn->prepare("CALL BuscarMuebles(?)");
$stmt->bind_param("s", $termino);
$stmt->execute();
$result = $stmt->get_result();

$muebles = [];

while($row = $result->fetch_assoc()) {
    $muebles[] = $row;
}

echo json_encode($muebles);

$stmt->close();
$conn->close();
?>
