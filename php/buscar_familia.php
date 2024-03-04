<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Llamar al procedimiento almacenado para obtener familias
$resultFamilias = $conn->query("CALL GetFamilias()");
$familias = array();
while ($rowFamilia = $resultFamilias->fetch_assoc()) {
    $familias[] = $rowFamilia;
}

// Liberar los resultados del primer procedimiento
$resultFamilias->close();
$conn->next_result();

// Llamar al procedimiento almacenado para obtener materiales
$resultMateriales = $conn->query("CALL GetMateriales()");
$materiales = array();
while ($rowMaterial = $resultMateriales->fetch_assoc()) {
    $materiales[] = $rowMaterial;
}

// Crear un array asociativo para enviar los datos al cliente
$data = array(
    "familias" => $familias,
    "materiales" => $materiales
);

// Imprimir los resultados como JSON
echo json_encode($data);

// Cerrar la conexión
$conn->close();
?>
