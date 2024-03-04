<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);


// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Preparar la llamada al procedimiento almacenado
$stmt = $conn->prepare("CALL GetOC()");

$stmt->execute();
$result = $stmt->get_result();

$response = array(); // Respuesta que se enviará al cliente

if ($result->num_rows > 0) {
    // Iterar sobre los resultados y agregarlos al array de respuesta
    while($row = $result->fetch_assoc()) {
        $response[] = $row;
    }
} else {
    $response = array("message" => "No se encontraron datos en la tabla OC.");
}

$stmt->close();
$conn->close();

// Enviar la respuesta como JSON
echo json_encode($response);
?>
