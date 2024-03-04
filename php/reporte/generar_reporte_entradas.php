<?php
require_once '../../conexion/dbconfig.php'; // Incluye la configuración de la base de datos
require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function obtenerEntradasMaterial($conn, $fechaInicio, $fechaFin) {
    $sql = "SELECT 
                movimiento.fecha,
                movimiento.hora,
                movimiento.descripcion,
                material.nombre AS nombre_material,
                movimiento.numero_factura,
                movimiento.cantidad
            FROM 
                movimiento
            INNER JOIN 
                material ON movimiento.id_material = material.id_material
            WHERE 
                movimiento.tipo_movimiento = 'Entrada'
                AND movimiento.fecha BETWEEN '$fechaInicio' AND '$fechaFin'";

    $result = $conn->query($sql);
    if (!$result) {
        die("Error en la consulta: " . $conn->error);
    }
    return $result;
}

function generarReporteEntradaMaterial($spreadsheet, $result) {
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Fecha');
    $sheet->setCellValue('B1', 'Hora');
    $sheet->setCellValue('C1', 'Descripción');
    $sheet->setCellValue('D1', 'Nombre Material');
    $sheet->setCellValue('E1', 'Número Factura');
    $sheet->setCellValue('F1', 'Cantidad');

    $row = 2;
    while ($row_data = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $row, $row_data['fecha']);
        $sheet->setCellValue('B' . $row, $row_data['hora']);
        $sheet->setCellValue('C' . $row, $row_data['descripcion']);
        $sheet->setCellValue('D' . $row, $row_data['nombre_material']);
        $sheet->setCellValue('E' . $row, $row_data['numero_factura']);
        $sheet->setCellValue('F' . $row, $row_data['cantidad']);
        $row++;
    }
}

function descargarArchivo($spreadsheet) {
    $filename = 'reporte_entradas_material.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . urlencode($filename) . '"');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
}

// Crear conexión usando las constantes de dbconfig.php
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se han enviado las fechas
if (isset($_POST['fechaInicioEntradas']) && isset($_POST['fechaFinEntradas'])) {
    $fechaInicio = $_POST['fechaInicioEntradas'];
    $fechaFin = $_POST['fechaFinEntradas'];

    $result = obtenerEntradasMaterial($conn, $fechaInicio, $fechaFin);

    $spreadsheet = new Spreadsheet();
    generarReporteEntradaMaterial($spreadsheet, $result);
    descargarArchivo($spreadsheet);
} else {
    // Manejar el caso en que no se proporcionen fechas
    // Puedes decidir qué hacer en este caso.
}

$conn->close();
?>
