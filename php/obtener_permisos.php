<?php
// Configuración de la base de datos
require_once '../conexion/dbconfigUser.php'; // Ajusta la ruta según sea necesario

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Llamar al procedimiento almacenado
$stmt = $conn->prepare("CALL ObtenerPermisos()");
$stmt->execute();
$result = $stmt->get_result();

// Preparar el array para la respuesta
$permisos = [];

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Recorrer cada fila y agregarla al array de permisos
    while($row = $result->fetch_assoc()) {
        array_push($permisos, array("id_permiso" => $row["id_permiso"], "nombre" => $row["nombre"]));
    }
    echo json_encode(array("success" => true, "permisos" => $permisos));
} else {
    echo json_encode(array("success" => false, "message" => "No se encontraron permisos"));
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
