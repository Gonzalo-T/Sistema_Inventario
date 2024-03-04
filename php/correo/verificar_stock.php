<?php
require_once __DIR__ . '/../../conexion/dbconfig.php';



$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);


// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener materiales con stock bajo
$sql = "SELECT stock.id_material, stock.cantidad, material.nombre 
        FROM stock 
        JOIN material ON stock.id_material = material.id_material 
        WHERE stock.cantidad < 10";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $body = "<h1>Notificación de Stock Bajo en Materiales</h1>";
    $body .= "<p>Estimado equipo de gestión de inventario,</p>";
    $body .= "<p>Por favor, presten atención al siguiente informe de materiales que han alcanzado un nivel de stock críticamente bajo. Es importante tomar medidas inmediatas para evitar posibles interrupciones en las operaciones.</p>";
    $body .= "<ul>";
    while ($row = $result->fetch_assoc()) {
        $id_material = $row['id_material'];
        $nombre_material = $row['nombre'];
        $cantidad = $row['cantidad'];
        $body .= "<li><b>$nombre_material (ID: $id_material):</b> Cantidad actual: $cantidad</li>";

        // Crear un aviso en la base de datos
        $descripcion = "Stock bajo para material $id_material. Cantidad actual: $cantidad";
        $fecha = date('Y-m-d');
        $hora = date('H:i:s');
        $sqlAviso = "INSERT INTO aviso (fecha, hora, descripcion, id_material) VALUES ('$fecha', '$hora', '$descripcion', '$id_material')";
        if (!$conn->query($sqlAviso)) {
            echo "Error al crear aviso: " . $conn->error;
        }
    }
    $body .= "</ul>";
    $body .= "<p>Se recomienda encarecidamente revisar y reabastecer estos materiales a la mayor brevedad posible para mantener la continuidad de las operaciones.</p>";
    $body .= "<p>Atentamente,</p>";
    $body .= "<p>Equipo de Administración de Inventario</p>";
    include 'enviar_aviso_email.php'; // Incluye el script para enviar el correo
} else {
    echo "No hay materiales con stock bajo.";
}

$conn->close();
?>