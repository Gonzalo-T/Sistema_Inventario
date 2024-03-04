<?php
require_once '../conexion/dbconfig.php'; // Asegúrate de que la ruta es correcta
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$datos = json_decode(file_get_contents("php://input"), true);
$nombre = $datos['nombre'];

// Preparar y ejecutar el procedimiento almacenado
$stmt = $conn->prepare("CALL InsertarCategoria(?)");
$stmt->bind_param("s", $nombre);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
