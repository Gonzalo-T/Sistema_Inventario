<?php
require_once '../../conexion/dbconfig.php'; // Ajusta la ruta según sea necesario
require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function conectarBaseDatos() {
    // Utilizar las constantes de dbconfig.php para la conexión
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    return $conn;
}


function obtenerMermaMaterial($conn, $fechaInicio, $fechaFin) {
    $sql = "SELECT 
                movimiento.fecha,
                movimiento.hora,
                movimiento.id_material,
                material.nombre AS nombre_material,
                movimiento.cantidad,
                movimiento.descripcion
            FROM 
                movimiento
            INNER JOIN 
                material ON movimiento.id_material = material.id_material
            WHERE 
                movimiento.tipo_movimiento = 'Merma'
                AND movimiento.fecha BETWEEN '$fechaInicio' AND '$fechaFin'";

    $result = $conn->query($sql);
    if (!$result) {
        die("Error en la consulta: " . $conn->error);
    }
    return $result;
}

function generarReporteMermaMaterial($spreadsheet, $result) {
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Fecha');
    $sheet->setCellValue('B1', 'Hora');
    $sheet->setCellValue('C1', 'ID Material');
    $sheet->setCellValue('D1', 'Nombre Material');
    $sheet->setCellValue('E1', 'Cantidad');
    $sheet->setCellValue('F1', 'Descripción');

    $row = 2;
    while ($row_data = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $row, $row_data['fecha']);
        $sheet->setCellValue('B' . $row, $row_data['hora']);
        $sheet->setCellValue('C' . $row, $row_data['id_material']);
        $sheet->setCellValue('D' . $row, $row_data['nombre_material']);
        $sheet->setCellValue('E' . $row, $row_data['cantidad']);
        $sheet->setCellValue('F' . $row, $row_data['descripcion']);
        $row++;
    }
}

function descargarArchivo($spreadsheet) {
    $filename = 'reporte_merma_material.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . urlencode($filename) . '"');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
}

$conn = conectarBaseDatos();

if (isset($_POST['fechaInicioMerma']) && isset($_POST['fechaFinMerma'])) {
    $fechaInicio = $_POST['fechaInicioMerma'];
    $fechaFin = $_POST['fechaFinMerma'];

    $result = obtenerMermaMaterial($conn, $fechaInicio, $fechaFin);

    $spreadsheet = new Spreadsheet();
    generarReporteMermaMaterial($spreadsheet, $result);
    descargarArchivo($spreadsheet);
} else {
    // Manejar el caso en que no se proporcionen fechas
    echo "Por favor, proporciona un rango de fechas.";
}

$conn->close();
?>
