<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');


require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario

$id_ot = htmlspecialchars($_GET['id_ot']);
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Llamar al procedimiento almacenado para obtener los detalles de la OT
$stmt = $conn->prepare("CALL ObtenerDetallesOT(?)");
$stmt->bind_param("i", $id_ot);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $response = [
        'mueble' => '',
        'cliente' => '',
        'materiales_utilizados' => [],
    ];

    while ($row = $result->fetch_assoc()) {
        $response['mueble'] = $row['nombre_mueble'];
        $response['cliente'] = $row['nombre_cliente'];

        if ($row['id_material'] != null) {
            $response['materiales_utilizados'][] = [
                'id_material' => $row['id_material'],
                'nombre_material' => $row['nombre_material'],
                'cantidad_utilizada' => $row['cantidad_utilizada'],
                'unidad_medida' => $row['unidad_medida']
            ];
        }
    }

    echo json_encode($response);
} else {
    echo json_encode(['error' => 'OT no encontrada.']);
}

$stmt->close();
$conn->close();
?>
