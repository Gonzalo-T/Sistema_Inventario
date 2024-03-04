<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario



// Obtener el ID del material desde la consulta GET
$id_material = htmlspecialchars($_GET['id_material']);
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$response = array(); // Respuesta que se enviará al cliente

// Preparar la llamada al procedimiento almacenado
$stmtMaterial = $conn->prepare("CALL GetMaterialPorID(?)");
$stmtMaterial->bind_param("s", $id_material);

// Ejecutar la consulta
$stmtMaterial->execute();
$resultMaterial = $stmtMaterial->get_result();

// Verificar si se encontró el material
if ($resultMaterial->num_rows > 0) {
    $material = $resultMaterial->fetch_assoc();
    $response = array(
        "id_material" => $material['id_material'],
        "nombre" => $material['nombre'],
        "valor" => $material['valor'],
        "unidad_medida" => $material['unidad_medida']
    );
} else {
    $response = array(
        "error" => "Material no encontrado."
    );
}

$stmtMaterial->close();
$conn->close();

echo json_encode($response);
?>
