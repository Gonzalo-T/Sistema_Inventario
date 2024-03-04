<?php
// Datos de conexión a la base de datos
require_once '../conexion/dbconfigUser.php'; // Ajusta la ruta según sea necesario

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Llamar al procedimiento almacenado
$stmt = $conn->prepare("CALL ObtenerUsuarios()");
$stmt->execute();
$resultado = $stmt->get_result();

$usuarios = array();
while ($row = $resultado->fetch_assoc()) {
    $usuarios[] = $row;
}

echo json_encode(array("usuarios" => $usuarios));

$conn->close();
?>
