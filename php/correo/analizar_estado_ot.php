<?php


require_once '../../conexion/dbconfig.php'; // Sube dos niveles en la estructura de directorios


$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener las OTs con estado 1 o 2
$sql = "SELECT ot.id_ot, ot.fecha_fin, DATEDIFF(ot.fecha_fin, CURDATE()) AS dias_restantes, 
               cliente.id_cliente, CONCAT(cliente.nombre, ' ', cliente.apellido) AS nombre_cliente, 
               detalles_mueble.nombre AS nombre_mueble, ot.id_estado
        FROM ot 
        JOIN cliente ON ot.id_cliente = cliente.id_cliente
        JOIN detalles_mueble ON ot.id_ot = detalles_mueble.id_ot
        WHERE ot.fecha_fin IS NOT NULL AND ot.id_estado IN (1, 2)";
$result = $conn->query($sql);

$ots = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $diasRestantes = intval($row['dias_restantes']);
        $mensaje = "";
        if ($diasRestantes <= 0 || $diasRestantes == 2) {
            if ($diasRestantes == -1) {
                $mensaje = 'Se ha atrasado un día en la entrega.';
            } elseif ($diasRestantes == 0) {
                $mensaje = 'Hoy se debe entregar.';
            } elseif ($diasRestantes == 2) {
                $mensaje = 'Faltan 2 días para la fecha de finalización.';
            }

            // Crear un aviso en la base de datos para la OT
            $descripcionOT = "Orden de Trabajo ID: " . $row['id_ot'] . ". " . $mensaje;
            $fechaOT = date('Y-m-d');
            $horaOT = date('H:i:s');
            $idOT = $row['id_ot'];
            $sqlAvisoOT = "INSERT INTO aviso (fecha, hora, descripcion, id_ot) VALUES ('$fechaOT', '$horaOT', '$descripcionOT', $idOT)";
            if (!$conn->query($sqlAvisoOT)) {
                echo "Error al crear aviso para OT: " . $conn->error;
            }

            $ots[] = [
                'id_ot' => $row['id_ot'],
                'fecha_fin' => $row['fecha_fin'],
                'dias_restantes' => $diasRestantes,
                'id_cliente' => $row['id_cliente'],
                'nombre_cliente' => $row['nombre_cliente'],
                'nombre_mueble' => $row['nombre_mueble'],
                'mensaje' => $mensaje
            ];
        }
    }
}

$conn->close();

if (!empty($ots)) {
    include 'enviar_notificaciones_ot.php';
} else {
    echo "No hay órdenes de trabajo atrasadas o en estado pendiente.";
}
?>
