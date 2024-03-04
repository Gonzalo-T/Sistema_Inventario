<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario

$data = json_decode(file_get_contents('php://input'), true);
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($data['form_type'] === 'materiales') {
    $id_material = htmlspecialchars($data['id_material']);
    $nombre = htmlspecialchars($data['nombre']);
    $valor = htmlspecialchars($data['valor']);
    $idFamilia = htmlspecialchars($data['familia']);
    $unidad = htmlspecialchars($data['unidad']);

    $stmt = $conn->prepare("CALL ActualizarMaterial(?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdis", $id_material, $nombre, $valor, $idFamilia, $unidad);

    if ($stmt->execute()) {
        $response = array("success" => true, "message" => "Material actualizado correctamente.");
    } else {
        $response = array("success" => false, "message" => "Error al actualizar material: " . $stmt->error);
    }

    $stmt->close();
}

$conn->close();
echo json_encode($response);
?>
