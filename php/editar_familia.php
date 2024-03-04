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

$response = array();

if ($data['form_type'] === 'familias' && isset($data['id_familia']) && isset($data['nombre_familia'])) {
    $id_familia = intval($data['id_familia']);
    $nombre_familia = $data['nombre_familia'];

    // Llamar al procedimiento almacenado para actualizar la familia
    $stmt = $conn->prepare("CALL ActualizarFamilia(?, ?)");
    $stmt->bind_param("is", $id_familia, $nombre_familia);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Familia actualizada con éxito.';
    } else {
        $response['success'] = false;
        $response['message'] = 'Error al actualizar la familia: ' . $stmt->error;
    }

    $stmt->close();
} else {
    $response['success'] = false;
    $response['message'] = 'Datos incorrectos o incompletos.';
}

$conn->close();

echo json_encode($response);
?>
