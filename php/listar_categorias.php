<?php
header('Content-Type: application/json');
require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$stmt = $conn->prepare("CALL ObtenerCategorias()");
$stmt->execute();
$result = $stmt->get_result();

$categorias = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $categorias[] = $row;
    }
}

echo json_encode(['categorias' => $categorias]);

$stmt->close();
$conn->close();
?>
