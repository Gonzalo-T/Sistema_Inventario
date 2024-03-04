<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario
$data = json_decode(file_get_contents('php://input'), true);

$idCliente = htmlspecialchars($data['id_Cliente']);
$nombre = htmlspecialchars($data['nombre']);
$apellido = htmlspecialchars($data['apellido']);
$telefono = htmlspecialchars($data['telefono']);
$correo = htmlspecialchars($data['correo']);
$telefonos = htmlspecialchars($data['telefonos']);
$regionId = htmlspecialchars($data['regionId']);
$comunaId = htmlspecialchars($data['comunaId']);
$direccion = htmlspecialchars($data['direccion']);
$nombreMueble = htmlspecialchars($data['nombreMueble']);
$categoriaId = htmlspecialchars($data['categoriaId']);
$especificaciones = htmlspecialchars($data['especificaciones']);
$ancho = htmlspecialchars($data['ancho']);
$largo = htmlspecialchars($data['largo']);
$alto = htmlspecialchars($data['alto']);
$fechaFin = htmlspecialchars($data['fechaFin']);

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$response = array();

if ($data['form_type'] === 'primer_contacto') {
    $queryVerificarCliente = "SELECT id_Cliente FROM cliente WHERE id_Cliente = ?";
    $stmtVerificarCliente = $conn->prepare($queryVerificarCliente);
    $stmtVerificarCliente->bind_param("s", $idCliente);
    $stmtVerificarCliente->execute();
    $resultVerificarCliente = $stmtVerificarCliente->get_result();
    $clienteExiste = $resultVerificarCliente->num_rows > 0;
    $stmtVerificarCliente->close();

    if ($clienteExiste) {
        $queryActualizarCliente = "UPDATE cliente SET nombre = ?, apellido = ?, direccion = ?, telefono = ?, correo = ?, id_region = ?, id_comuna = ?, telefono2 = ? WHERE id_Cliente = ?";
        $stmtActualizarCliente = $conn->prepare($queryActualizarCliente);
        $stmtActualizarCliente->bind_param("sssssisss", $nombre, $apellido, $direccion, $telefono, $correo, $regionId, $comunaId, $telefonos, $idCliente);
        $stmtActualizarCliente->execute();
        $stmtActualizarCliente->close();
    } else {
        $queryCliente = "INSERT INTO cliente (id_Cliente, nombre, apellido, direccion, telefono, correo, id_region, id_comuna, telefono2) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmtCliente = $conn->prepare($queryCliente);
        $stmtCliente->bind_param("ssssssiss", $idCliente, $nombre, $apellido, $direccion, $telefono, $correo, $regionId, $comunaId, $telefonos);
        $stmtCliente->execute();
        $stmtCliente->close();
    }
// Establecer la zona horaria de Santiago de Chile
date_default_timezone_set('America/Santiago');

    // Proceso para insertar en la tabla OT y detalles del mueble
    $fecha = date("Y-m-d");
    $hora = date("H:i:s");
    $idEstado = 1; // Estado "iniciado"

    // Asegúrate de que la fechaFin tenga un formato adecuado o sea nula
    if (!$fechaFin) {
        $fechaFin = NULL;
    }

    $queryOT = "INSERT INTO ot (fecha, hora, id_estado, id_cliente, fecha_fin) VALUES (?, ?, ?, ?, ?)";
    $stmtOT = $conn->prepare($queryOT);
    $stmtOT->bind_param("ssiss", $fecha, $hora, $idEstado, $idCliente, $fechaFin);

    if ($stmtOT->execute()) {
        $idOt = $stmtOT->insert_id;

        $queryDetallesMueble = "INSERT INTO detalles_mueble (nombre, especificaciones, id_ot, id_categoria, ancho, largo, alto) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmtDetallesMueble = $conn->prepare($queryDetallesMueble);
        $stmtDetallesMueble->bind_param("ssiiddd", $nombreMueble, $especificaciones, $idOt, $categoriaId, $ancho, $largo, $alto);

        if ($stmtDetallesMueble->execute()) {
            $response = array("success" => true, "message" => "Datos de primer contacto y detalles del mueble guardados correctamente.");
        } else {
            $response = array("success" => false, "message" => "Error al guardar los detalles del mueble: " . $stmtDetallesMueble->error);
        }
        $stmtDetallesMueble->close();
    } else {
        $response = array("success" => false, "message" => "Error al guardar los datos de OT: " . $stmtOT->error);
    }
    $stmtOT->close();
}

$conn->close();
echo json_encode($response);
?>
