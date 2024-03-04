<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$response = array(); 
$data = json_decode(file_get_contents('php://input'), true);

if($data['form_type'] === 'agregar') {
    $tipo_movimiento = htmlspecialchars($data['tipo_movimiento']);
    $numero_factura = htmlspecialchars($data['numero_factura']);
    $descripcion = htmlspecialchars($data['descripcion']);

    $conn->autocommit(FALSE); 

    foreach($data['materiales'] as $material) {
        $id_material = htmlspecialchars($material['id_material']);
        $cantidad = htmlspecialchars($material['cantidad']);

        $stmt = $conn->prepare("CALL AgregarMovimientoActualizarStock(?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $tipo_movimiento, $numero_factura, $descripcion, $id_material, $cantidad);

        if (!$stmt->execute()) {
            $conn->rollback();
            $response = array("success" => false, "message" => "Error al guardar el movimiento o actualizar el stock.");
            $stmt->close();
            $conn->close();
            echo json_encode($response);
            exit;
        }

        $stmt->close();
    }

    $conn->commit();
    $conn->autocommit(TRUE); 
    $response = array("success" => true, "message" => "Movimientos y stock actualizados correctamente.");
} else {
    $response = array("success" => false, "message" => "Formulario incorrecto.");
}

$conn->close();
echo json_encode($response);
?>
