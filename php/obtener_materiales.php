<?php
header('Content-Type: application/json');

$pagina = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
$limite = isset($_GET['limite']) ? intval($_GET['limite']) : 10;
$inicio = ($pagina - 1) * $limite;
$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';

require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Llamada al procedimiento almacenado
$stmt = $conn->prepare("CALL ObtenerMaterialesConPaginacionYBusqueda(?, ?, ?)");
$stmt->bind_param("sii", $busqueda, $inicio, $limite);
$stmt->execute();
$result = $stmt->get_result();

$materiales = [];
while($row = $result->fetch_assoc()) {
    $materiales[] = $row;
}

echo json_encode(['materiales' => $materiales]);

$stmt->close();
$conn->close();
?>
