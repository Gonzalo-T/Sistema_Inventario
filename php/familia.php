<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario

$data = json_decode(file_get_contents('php://input'), true);

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$response = array();

if ($data['form_type'] === 'familias') {
    $nom_familia = htmlspecialchars($data['nom_familia']);
    $familiaExistente = false;
    $resultado = false;

    // Llamar al procedimiento almacenado
    $stmt = $conn->prepare("CALL InsertarFamilia(?, @familiaExistente, @resultado)");
    $stmt->bind_param("s", $nom_familia);
    $stmt->execute();

    // Obtener los resultados del procedimiento almacenado
    $select = $conn->query("SELECT @familiaExistente, @resultado");
    $result = $select->fetch_assoc();
    $familiaExistente = $result['@familiaExistente'];
    $resultado = $result['@resultado'];

    if ($familiaExistente) {
        $response = array("success" => false, "message" => "Ya existe una familia con ese nombre.");
    } else if ($resultado) {
        $response = array("success" => true, "message" => "Familia creada correctamente");
    } else {
        $response = array("success" => false, "message" => "Error al insertar familia en la base de datos");
    }

    $stmt->close();
}

$conn->close();

echo json_encode($response);
?>
