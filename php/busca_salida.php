<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario

$id_ot = htmlspecialchars($_GET['id_ot']);

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$stmt = $conn->prepare("CALL ObtenerInfoDetalladaOT(?)");
$stmt->bind_param("i", $id_ot);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $materialesUtilizados = [];
    $infoOT = null;

    while ($materialRow = $result->fetch_assoc()) {
        if (!$infoOT) {
            $infoOT = [
                'mueble' => $materialRow['nombre_mueble'],
                'cliente' => $materialRow['nombre_cliente'] . ' ' . $materialRow['apellido_cliente']
            ];
        }

        $materialesUtilizados[] = [
            'id_material' => $materialRow['id_material'],
            'cantidad_utilizada' => $materialRow['cantidad_utilizada'],
            'nombre_material' => $materialRow['nombre_material'],
            'estado' => $materialRow['estado'],
            'cantidad_entregada' => $materialRow['cantidad_entregada']
        ];
    }

    $response = [
        'mueble' => $infoOT['mueble'],
        'cliente' => $infoOT['cliente'],
        'materiales_utilizados' => $materialesUtilizados
    ];

    echo json_encode($response);
} else {
    echo json_encode(["error" => "OT no encontrada."]);
}

$stmt->close();
$conn->close();
?>
