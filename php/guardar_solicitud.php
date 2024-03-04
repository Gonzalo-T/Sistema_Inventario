<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Establecer la zona horaria de Santiago de Chile
date_default_timezone_set('America/Santiago');

require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario

// Obtener datos del cuerpo de la solicitud
$data = json_decode(file_get_contents('php://input'), true);

// Crear una conexión a la base de datos

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$response = array(); // Respuesta que se enviará al cliente

if (!empty($data['materiales'])) {
    $fecha = date("Y-m-d"); // Fecha actual en Santiago de Chile
    $descripcion = isset($data['descripcion']) ? htmlspecialchars($data['descripcion']) : '';

    // Preparar la llamada al procedimiento almacenado
    $stmt = $conn->prepare("CALL InsertarOC(?, ?, ?)");

    foreach ($data['materiales'] as $material) {
        $id_material = htmlspecialchars($material['id_material']);
        $stmt->bind_param("sss", $fecha, $descripcion, $id_material);

        if ($stmt->execute()) {
            $response = array("success" => true, "message" => "Datos guardados correctamente en la tabla oc.");
        } else {
            $response = array("success" => false, "message" => "Error al insertar datos en la tabla oc: " . $stmt->error);
            break; // Salir del bucle si hay un error
        }
    }

    $stmt->close();
} else {
    $response = array("success" => false, "message" => "Datos incompletos enviados desde el cliente.");
}

$conn->close();

echo json_encode($response);
?>
