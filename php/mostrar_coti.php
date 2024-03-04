<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id_ot = htmlspecialchars($_GET['id_ot']);

$stmt = $conn->prepare("CALL ObtenerDetallesOTDOS(?)");
$stmt->bind_param("i", $id_ot);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $materialesUtilizados = [];
    while ($row = $result->fetch_assoc()) {
        if (!isset($response)) {
            $response = [
                'mueble' => $row['nombre_mueble'],
                'especificaciones_mueble' => $row['especificaciones'],
                'nombre_categoria' => $row['nombre_categoria'],
                'ancho' => $row['ancho'],
                'alto' => $row['alto'],
                'largo' => $row['largo'],
                'run' => $row['run'],
                'nombre_cliente' => $row['nombre_cliente'],
                'apellido_cliente' => $row['apellido_cliente'],
                'direccion_cliente' => $row['direccion_cliente'],
                'telefono_cliente' => $row['telefono_cliente'],
                'correo_cliente' => $row['correo_cliente'],
                'nombre_comuna' => $row['nombre_comuna'],
                'nombre_region' => $row['nombre_region'],
                'materiales_utilizados' => []
            ];
        }
        
        if ($row['id_material']) {
            $materialesUtilizados[] = [
                'id_material' => $row['id_material'],
                'cantidad_utilizada' => $row['cantidad_utilizada'],
                'nombre_material' => $row['nombre_material'],
                'valor' => $row['valor']
            ];
        }
    }

    $response['materiales_utilizados'] = $materialesUtilizados;

    echo json_encode($response);
} else {
    echo json_encode(['error' => 'OT no encontrada.']);
}

$stmt->close();
$conn->close();
?>
