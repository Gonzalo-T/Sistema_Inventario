<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario


$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
if ($conn->connect_error) {
    die(json_encode(array("success" => false, "message" => "Conexión fallida: " . $conn->connect_error)));
}

$data = json_decode(file_get_contents('php://input'), true);

$id_ot = $data['id_ot'];
$nombreCliente = $data['nombreCliente'];
$apellidoCliente = $data['apellidoCliente'];
$direccionCliente = $data['direccionCliente'];
$telefonoCliente = $data['telefonoCliente'];
$correoCliente = $data['correoCliente'];
$nombreMueble = $data['nombreMueble'];
$especificaciones = $data['especificaciones'];
$ancho = $data['ancho'];
$alto = $data['alto'];
$largo = $data['largo'];
$materiales = json_encode($data['materiales']); // Convertir a JSON

$stmt = $conn->prepare("CALL GestionarOT(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isssssssddds", $id_ot, $nombreCliente, $apellidoCliente, $direccionCliente, $telefonoCliente, $correoCliente, $nombreMueble, $especificaciones, $ancho, $alto, $largo, $materiales);

if (!$stmt->execute()) {
    $stmt->close();
    $conn->close();
    die(json_encode(array("success" => false, "message" => "Error al gestionar OT: " . $stmt->error)));
}
$stmt->close();
$conn->close();

echo json_encode(array("success" => true, "message" => "OT actualizada y materiales agregados correctamente."));
?>
