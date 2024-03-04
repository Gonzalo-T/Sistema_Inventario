<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario
// Conectar a la base de datos
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID del material desde el cuerpo de la solicitud POST
$id_material = $_POST['id_material'];

// Llamar al procedimiento almacenado para eliminar el material
$stmt = $conn->prepare("CALL EliminarMaterial(?)");
$stmt->bind_param("s", $id_material);
$stmt->execute();

// Obtener los resultados del procedimiento almacenado
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Preparar la respuesta
if ($row['filasAfectadas'] > 0) {
    $response = array("success" => true, "message" => "Material eliminado correctamente de material_utilizado.");
} else {
    $response = array("success" => false, "message" => "No se encontró un material con el ID proporcionado en material_utilizado.");
}

// Cerrar la declaración y la conexión
$stmt->close();
$conn->close();

// Enviar respuesta
echo json_encode($response);
?>
