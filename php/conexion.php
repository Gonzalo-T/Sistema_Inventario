<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$conn->set_charset("utf8");

$regionId = isset($_GET['region']) ? $_GET['region'] : null;

$stmt = $conn->prepare("CALL ObtenerDatosGenerales(?)");
$stmt->bind_param("i", $regionId);
$stmt->execute();

// Procesar cada conjunto de resultados
do {
    if ($result = $stmt->get_result()) {
        $data[] = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
    }
} while ($stmt->more_results() && $stmt->next_result());

$stmt->close();
$conn->close();

echo json_encode(array(
    "regiones" => $data[0],
    "comunas" => $data[1],
    "categorias" => $data[2],
    "ots" => $data[3],
    "clientes" => $data[4],
    "estadosOT" => $data[5],
    "detallesMueble" => $data[6]
));
?>
