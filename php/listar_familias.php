<?php
header('Content-Type: application/json');

require_once '../conexion/dbconfig.php'; // Asegúrate de que esta ruta sea correcta

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$query = "CALL ObtenerFamilias()";
$result = $conn->query($query);

$familias = [];
while($row = $result->fetch_assoc()) {
    $familias[] = $row;
}

echo json_encode(['familias' => $familias]);

$conn->close();
?>
