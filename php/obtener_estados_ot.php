<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT id_estado, nombre FROM estado_ot";
$result = $conn->query($sql);

$estadosOT = array();

while ($row = $result->fetch_assoc()) {
    $estadosOT[] = $row;
}

echo json_encode(array("estadosOT" => $estadosOT));

$conn->close();
?>
