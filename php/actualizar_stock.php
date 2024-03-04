<?php
header('Content-Type: application/json');
date_default_timezone_set('America/Santiago');

require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);
$idMaterial = $data['id_material'];
$cantidadMerma = $data['cantidad_merma'];
$descripcionMerma = $data['descripcion'];

// Llamar al procedimiento almacenado
$stmt = $conn->prepare("CALL RegistrarMerma(?, ?, ?, @resultado)");
$stmt->bind_param("sis", $idMaterial, $cantidadMerma, $descripcionMerma);
$stmt->execute();

// Obtener el resultado del procedimiento almacenado
$select = $conn->query("SELECT @resultado AS resultado");
$result = $select->fetch_assoc();

echo json_encode(array("message" => $result['resultado']));

$stmt->close();
$conn->close();
?>
