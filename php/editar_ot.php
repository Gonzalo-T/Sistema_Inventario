<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario

$id_ot = htmlspecialchars($_GET['id_ot']);

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Preparar y ejecutar el procedimiento almacenado
$stmt = $conn->prepare("CALL ConsultarDetallesOT(?)");
$stmt->bind_param("i", $id_ot);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Obtener el primer resultado para los detalles de la OT
    $row = $result->fetch_assoc();

    // Agregar los materiales utilizados al array de respuesta
    $materialesUtilizados = [];
    do {
        if (isset($row['id_material']) && $row['id_material']) {
            $materialesUtilizados[] = [
                'id_material' => $row['id_material'],
                'cantidad_utilizada' => $row['cantidad_utilizada'],
                'nombre_material' => $row['nombre_material']
            ];
        }
    } while ($row = $result->fetch_assoc());

    // Mover el puntero del resultado al principio
    $result->data_seek(0);
    $row = $result->fetch_assoc();

    // Construir el array de respuesta con todos los campos
    $response = [
        'id_ot' => $row['id_ot'],
        'nombre_mueble' => $row['nombre_mueble'],
        'especificaciones_mueble' => $row['especificaciones'],
        'ancho' => $row['ancho'],
        'alto' => $row['alto'],
        'largo' => $row['largo'],
        'nombre_categoria' => $row['nombre_categoria'],
        'run' => $row['run'],
        'nombre_cliente' => $row['nombre_cliente'],
        'apellido_cliente' => $row['apellido_cliente'],
        'direccion_cliente' => $row['direccion_cliente'],
        'telefono_cliente' => $row['telefono_cliente'],
        'correo_cliente' => $row['correo_cliente'],
        'nombre_comuna' => $row['nombre_comuna'],
        'nombre_region' => $row['nombre_region'],
        'materiales_utilizados' => $materialesUtilizados
    ];

    // Devolver la respuesta como JSON
    echo json_encode($response);
} else {
    echo json_encode(["success" => false, "message" => "No se encontró la OT"]);
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
