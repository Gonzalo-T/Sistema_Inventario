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

if ($data['form_type'] === 'asignacion') {
    $conn->autocommit(FALSE);

    foreach ($data['materiales'] as $material) {
        $id_ot = htmlspecialchars($material['id_ot']);
        $id_material = htmlspecialchars($material['id_material']);
        $cantidadSolicitada = htmlspecialchars($material['cantidad']);

        $stmt = $conn->prepare("CALL AsignarMateriales(?, ?, ?, @resultado, @idMaterialInsuficiente, @cantidadDisponible)");
        $stmt->bind_param("iii", $id_ot, $id_material, $cantidadSolicitada);
        $stmt->execute();

        $stmt->close();
        $result = $conn->query("SELECT @resultado AS resultado, @idMaterialInsuficiente AS idMaterialInsuficiente, @cantidadDisponible AS cantidadDisponible");
        $res = $result->fetch_assoc();

        if (!$res['resultado']) {
            $conn->rollback();
            echo json_encode([
                "success" => false, 
                "message" => "Material insuficiente.",
                "idMaterial" => $res['idMaterialInsuficiente'],
                "cantidadDisponible" => $res['cantidadDisponible']
            ]);
            exit;
        }
    }

    $conn->commit();
    $conn->autocommit(TRUE);
    $response = ["success" => true, "message" => "Movimientos actualizados correctamente."];
}

$conn->close();
echo json_encode($response);
?>