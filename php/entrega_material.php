<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario

$data = json_decode(file_get_contents('php://input'), true);

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

if ($conn->connect_error) {
    echo json_encode(["error" => "Conexión fallida: " . $conn->connect_error]);
    exit();
}

$response = array();

if ($data && is_array($data)) {
    $conn->autocommit(FALSE);

    date_default_timezone_set('America/Santiago');
    $fechaActual = date('Y-m-d');
    $horaActual = date('H:i:s');

    foreach ($data as $item) {
        $id_material = htmlspecialchars($item['id_material']);
        $cantidad_entregar = htmlspecialchars($item['cantidad_entregar']);
        $id_ot = htmlspecialchars($item['id_ot']);
        $resultado = "";

        $stmt = $conn->prepare("CALL ActualizarEntregaMaterial(?, ?, ?, ?, ?, @resultado)");
        $stmt->bind_param("siiss", $id_material, $cantidad_entregar, $id_ot, $fechaActual, $horaActual);
        $stmt->execute();
        $stmt->close();

        $res = $conn->query("SELECT @resultado AS resultado");
        $row = $res->fetch_assoc();
        if ($row['resultado'] !== 'OK') {
            $conn->rollback();
            $response = array("success" => false, "message" => $row['resultado']);
            break;
        }
    }

    if (empty($response)) {
        $conn->commit();
        $response = array("success" => true, "message" => "Las entregas se realizaron correctamente.");
    }
} else {
    $response = array("error" => "Datos no válidos.");
}

$conn->close();
echo json_encode($response);
?>
