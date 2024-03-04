<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$conn->set_charset("utf8");

$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$limite = 15;
$offset = ($pagina - 1) * $limite;

// Llamar al procedimiento almacenado
$stmt = $conn->prepare("CALL ObtenerOTsPaginadas(?, ?)");
$stmt->bind_param("ii", $limite, $offset);
$stmt->execute();
$resultOT = $stmt->get_result();
$ots = array();

while ($rowOT = $resultOT->fetch_assoc()) {
    $ots[] = $rowOT;
}

$data = array("ots" => $ots);
echo json_encode($data);

$conn->close();
?>
