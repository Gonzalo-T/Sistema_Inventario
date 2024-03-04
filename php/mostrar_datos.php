<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once '../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);


// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Establecer el conjunto de caracteres a utf8
$conn->set_charset("utf8");
$id_ot = $_GET['id_ot']; // Obtén el parámetro id_ot de la URL

$sqlOT = "SELECT ot.id_ot, ot.fecha, ot.hora, estado_ot.nombre AS estado, ot.id_cliente, 
                cliente.id_region, cliente.id_comuna,
                region.nombre AS nombre_region, comuna.nombre AS nombre_comuna,
                detalles_mueble.id_detalle_mueble, detalles_mueble.nombre AS nombre_mueble, 
                detalles_mueble.especificaciones, detalles_mueble.ancho, detalles_mueble.largo, detalles_mueble.alto
          FROM ot 
          INNER JOIN estado_ot ON ot.id_estado = estado_ot.id_estado
          INNER JOIN cliente ON ot.id_cliente = cliente.id_cliente
          LEFT JOIN region ON cliente.id_region = region.id_region
          LEFT JOIN comuna ON cliente.id_comuna = comuna.id_comuna
          LEFT JOIN detalles_mueble ON ot.id_ot = detalles_mueble.id_ot
          WHERE ot.id_ot = $id_ot"; // Filtra por id_ot


$resultOT = $conn->query($sqlOT);

// Inicializar arrays para almacenar datos de OT, clientes, detalles de mueble y estados de OT
$ots = array();

// Obtener datos de OT
while ($rowOT = $resultOT->fetch_assoc()) {
    $ots[] = $rowOT;
}

// Crear un array asociativo para enviar los conjuntos de datos al cliente
$data = array(
    "ots" => $ots
);

// Imprimir los resultados como JSON
echo json_encode($data);

// Cerrar la conexión
$conn->close();
?>
