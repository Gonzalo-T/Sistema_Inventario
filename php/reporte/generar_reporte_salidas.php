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


function obtenerSalidasMaterial($conn, $fechaInicio, $fechaFin) {
    $sql = "SELECT 
                material.id_material,
                movimiento.fecha,
                movimiento.hora,
                material.nombre AS nombre_material,
                movimiento.cantidad
            FROM 
                movimiento
            INNER JOIN 
                material ON movimiento.id_material = material.id_material
            WHERE 
                movimiento.tipo_movimiento = 'Salida'
                AND movimiento.fecha BETWEEN '$fechaInicio' AND '$fechaFin'";

    $result = $conn->query($sql);
    if (!$result) {
        die("Error en la consulta: " . $conn->error);
    }
    return $result;
}


function generarReporteSalidaMaterial($spreadsheet, $result) {
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Fecha');
    $sheet->setCellValue('B1', 'Hora');
    $sheet->setCellValue('C1', 'ID Material');
    $sheet->setCellValue('D1', 'Nombre Material');
    $sheet->setCellValue('E1', 'Cantidad');

    $row = 2;
    while ($row_data = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $row, $row_data['fecha']);
        $sheet->setCellValue('B' . $row, $row_data['hora']);
        $sheet->setCellValue('C' . $row, $row_data['id_material']);
        $sheet->setCellValue('D' . $row, $row_data['nombre_material']);
        $sheet->setCellValue('E' . $row, $row_data['cantidad']);
        $row++;
    }
}

function descargarArchivo($spreadsheet) {
    $filename = 'reporte_salidas_material.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . urlencode($filename) . '"');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
}

$conn = conectarBaseDatos();

if (isset($_POST['fechaInicioSalidas']) && isset($_POST['fechaFinSalidas'])) {
    $fechaInicio = $_POST['fechaInicioSalidas'];
    $fechaFin = $_POST['fechaFinSalidas'];

    $result = obtenerSalidasMaterial($conn, $fechaInicio, $fechaFin);

    $spreadsheet = new Spreadsheet();
    generarReporteSalidaMaterial($spreadsheet, $result);
    descargarArchivo($spreadsheet);
} else {
    // Manejar el caso en que no se proporcionen fechas
    // Puedes decidir qué hacer en este caso, como mostrar un mensaje de error o generar un reporte con todos los datos.
}

$conn->close();
?>
