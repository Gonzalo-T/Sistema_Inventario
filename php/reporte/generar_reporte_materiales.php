<?php
require_once '../../conexion/dbconfig.php'; // Incluye la configuración de la base de datos
require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function obtenerDatosMateriales($conn) {
    $sql = "SELECT id_material, nombre, valor, unidad_medida FROM material";
    $result = $conn->query($sql);

    if (!$result) {
        die("Error en la consulta: " . $conn->error);
    }

    return $result;
}

function generarReporteExcel($spreadsheet, $result) {
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->setCellValue('A1', 'ID Material');
    $sheet->setCellValue('B1', 'Nombre');
    $sheet->setCellValue('C1', 'Valor');
    $sheet->setCellValue('D1', 'Unidad de Medida');

    $row = 2;
    while ($row_data = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $row, $row_data['id_material']);
        $sheet->setCellValue('B' . $row, $row_data['nombre']);
        $sheet->setCellValue('C' . $row, $row_data['valor']);
        $sheet->setCellValue('D' . $row, $row_data['unidad_medida']);
        $row++;
    }
}

function descargarArchivo($spreadsheet) {
    $filename = 'reporte_materiales.xlsx';
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

// Obtener datos de materiales
$result = obtenerDatosMateriales($conn);

// Crear un nuevo documento de PhpSpreadsheet
$spreadsheet = new Spreadsheet();

// Generar el reporte en Excel
generarReporteExcel($spreadsheet, $result);

// Descargar el archivo
descargarArchivo($spreadsheet);

// Cerrar la conexión de la base de datos
$conn->close();
?>
