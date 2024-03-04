<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario

try {
    $data = json_decode(file_get_contents('php://input'), true);
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

    if ($conn->connect_error) {
        throw new Exception("Conexión fallida: " . $conn->connect_error);
    }

    $response = array();

    if ($data['form_type'] === 'materiales') {
        $id_material = htmlspecialchars($data['id_material']);
        $nombre = htmlspecialchars($data['nombre']);
        $valor = doubleval($data['valor']);
        $idFamilia = intval($data['familia']);
        $unidad = htmlspecialchars($data['unidad']);

        $stmt = $conn->prepare("CALL InsertarMaterial(?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdis", $id_material, $nombre, $valor, $idFamilia, $unidad);

        if ($stmt->execute()) {
            $response = array("success" => true, "message" => "Material insertado correctamente en la base de datos.");
        } else {
            http_response_code(400);
            if ($conn->errno == 1644) {
                $response = array("success" => false, "message" => "Error: Codigo de material ya existe.");
            } else {
                $response = array("success" => false, "message" => "Error al insertar material: " . $stmt->error);
            }
        }
        $stmt->close();
    }

    $conn->close();
    echo json_encode($response);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(array("success" => false, "message" => $e->getMessage()));
    exit;
}
?>
