<?php
require_once '../../conexion/dbconfig.php';
require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Crear conexión usando configuraciones de dbconfig.php
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);


// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los datos de los clientes, incluyendo comuna y región
$sql = "SELECT c.id_cliente, c.nombre, c.apellido, c.direccion, c.telefono, c.correo, com.nombre AS nombre_comuna, r.nombre AS nombre_region 
        FROM cliente c
        LEFT JOIN comuna com ON c.id_comuna = com.id_comuna
        LEFT JOIN region r ON c.id_region = r.id_region";
$result = $conn->query($sql);

// Crear un nuevo documento de PhpSpreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Establecer los títulos de las columnas
$sheet->setCellValue('A1', 'RUN');
$sheet->setCellValue('B1', 'Nombre');
$sheet->setCellValue('C1', 'Apellido');
$sheet->setCellValue('D1', 'Dirección');
$sheet->setCellValue('E1', 'Teléfono');
$sheet->setCellValue('F1', 'Correo');
$sheet->setCellValue('G1', 'Comuna');
$sheet->setCellValue('H1', 'Región');

// Rellenar datos en el documento
$row = 2;
while ($row_data = $result->fetch_assoc()) {
    $sheet->setCellValue('A' . $row, $row_data['id_cliente']);
    $sheet->setCellValue('B' . $row, $row_data['nombre']);
    $sheet->setCellValue('C' . $row, $row_data['apellido']);
    $sheet->setCellValue('D' . $row, $row_data['direccion']);
    $sheet->setCellValue('E' . $row, $row_data['telefono']);
    $sheet->setCellValue('F' . $row, $row_data['correo']);
    $sheet->setCellValue('G' . $row, $row_data['nombre_comuna']);
    $sheet->setCellValue('H' . $row, $row_data['nombre_region']);
    $row++;
}

// Preparar el archivo para la descarga
$filename = 'reporte_clientes.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'. urlencode($filename).'"');

// Escribir el archivo .xlsx directamente a la salida
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

// Cerrar la conexión de la base de datos
$conn->close();
?>
