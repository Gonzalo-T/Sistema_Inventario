<?php
require_once '../../conexion/dbconfig.php'; // Incluye la configuración de la base de datos
require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Crear conexión usando las constantes de dbconfig.php
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los datos de los materiales y su stock
$sql = "SELECT m.id_material, m.nombre, m.valor, m.unidad_medida, s.cantidad 
        FROM material m
        JOIN stock s ON m.id_material = s.id_material";
$result = $conn->query($sql);

// Crear un nuevo documento de PhpSpreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Establecer los títulos de las columnas
$sheet->setCellValue('A1', 'ID Material');
$sheet->setCellValue('B1', 'Nombre');
$sheet->setCellValue('C1', 'Valor');
$sheet->setCellValue('D1', 'Unidad de Medida');
$sheet->setCellValue('E1', 'Cantidad en Stock');

// Rellenar datos en el documento
$row = 2;
while ($row_data = $result->fetch_assoc()) {
    $sheet->setCellValue('A' . $row, $row_data['id_material']);
    $sheet->setCellValue('B' . $row, $row_data['nombre']);
    $sheet->setCellValue('C' . $row, $row_data['valor']);
    $sheet->setCellValue('D' . $row, $row_data['unidad_medida']);
    $sheet->setCellValue('E' . $row, $row_data['cantidad']);
    $row++;
}

// Preparar el archivo para la descarga
$filename = 'reporte_materiales_stock.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'. urlencode($filename).'"');

// Escribir el archivo .xlsx directamente a la salida
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

// Cerrar la conexión de la base de datos
$conn->close();
?>
