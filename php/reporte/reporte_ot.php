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

function obtenerDatosOT($conn, $fechaInicio = null, $fechaFin = null) {
    $sql = "SELECT 
                ot.id_ot,
                ot.fecha,
                ot.fecha_fin,
                ot.hora,
                cliente.nombre AS nombre_cliente,
                cliente.apellido,
                cliente.direccion,
                cliente.telefono,
                cliente.correo,
                comuna.nombre AS nombre_comuna,
                region.nombre AS nombre_region,
                GROUP_CONCAT(detalles_mueble.nombre SEPARATOR ', ') AS nombres_muebles,
                GROUP_CONCAT(detalles_mueble.especificaciones SEPARATOR ', ') AS especificaciones_muebles,
                GROUP_CONCAT(detalles_mueble.ancho SEPARATOR ', ') AS anchos_muebles,
                GROUP_CONCAT(detalles_mueble.largo SEPARATOR ', ') AS largos_muebles,
                GROUP_CONCAT(detalles_mueble.alto SEPARATOR ', ') AS altos_muebles,
                estado_ot.nombre AS estado_ot
            FROM 
                ot
            INNER JOIN 
                cliente ON ot.id_cliente = cliente.id_cliente
            INNER JOIN 
                comuna ON cliente.id_comuna = comuna.id_comuna
            INNER JOIN 
                region ON cliente.id_region = region.id_region
            INNER JOIN 
                detalles_mueble ON ot.id_ot = detalles_mueble.id_ot
            INNER JOIN 
                estado_ot ON ot.id_estado = estado_ot.id_estado";

    if ($fechaInicio && $fechaFin) {
        $sql .= " WHERE ot.fecha BETWEEN '$fechaInicio' AND '$fechaFin'";
    }

    $sql .= " GROUP BY ot.id_ot ORDER BY ot.id_ot;";
    $result = $conn->query($sql);

    if (!$result) {
        die("Error en la consulta: " . $conn->error);
    }

    return $result;
}

function generarReporteExcel($spreadsheet, $result) {
    $sheet = $spreadsheet->getActiveSheet();

    // Encabezados de las columnas
    $sheet->setCellValue('A1', 'ID OT');
    $sheet->setCellValue('B1', 'Fecha Inicio');
    $sheet->setCellValue('C1', 'Fecha Fin'); // Nueva columna para Fecha Fin
    $sheet->setCellValue('D1', 'Hora');
    $sheet->setCellValue('E1', 'Nombre Cliente');
    $sheet->setCellValue('F1', 'Apellido');
    $sheet->setCellValue('G1', 'Dirección');
    $sheet->setCellValue('H1', 'Teléfono');
    $sheet->setCellValue('I1', 'Correo');
    $sheet->setCellValue('J1', 'Comuna');
    $sheet->setCellValue('K1', 'Región');
    $sheet->setCellValue('L1', 'Nombres Muebles');
    $sheet->setCellValue('M1', 'Especificaciones Muebles');
    $sheet->setCellValue('N1', 'Anchos Muebles');
    $sheet->setCellValue('O1', 'Largos Muebles');
    $sheet->setCellValue('P1', 'Altos Muebles');
    $sheet->setCellValue('Q1', 'Estado OT');

    $row = 2;
    while ($row_data = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $row, $row_data['id_ot']);
        $sheet->setCellValue('B' . $row, $row_data['fecha']);
        $sheet->setCellValue('C' . $row, $row_data['fecha_fin']); // Agregar Fecha Fin
        $sheet->setCellValue('D' . $row, $row_data['hora']);
        $sheet->setCellValue('E' . $row, $row_data['nombre_cliente']);
        $sheet->setCellValue('F' . $row, $row_data['apellido']);
        $sheet->setCellValue('G' . $row, $row_data['direccion']);
        $sheet->setCellValue('H' . $row, $row_data['telefono']);
        $sheet->setCellValue('I' . $row, $row_data['correo']);
        $sheet->setCellValue('J' . $row, $row_data['nombre_comuna']);
        $sheet->setCellValue('K' . $row, $row_data['nombre_region']);
        $sheet->setCellValue('L' . $row, $row_data['nombres_muebles']);
        $sheet->setCellValue('M' . $row, $row_data['especificaciones_muebles']);
        $sheet->setCellValue('N' . $row, $row_data['anchos_muebles']);
        $sheet->setCellValue('O' . $row, $row_data['largos_muebles']);
        $sheet->setCellValue('P' . $row, $row_data['altos_muebles']);
        $sheet->setCellValue('Q' . $row, $row_data['estado_ot']);
        $row++;
    }
}











function descargarArchivo($spreadsheet) {
    $filename = 'reporte_ot.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . urlencode($filename) . '"');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
}

// Detalles de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "proyecto";

// Conectar a la base de datos
$conn = conectarBaseDatos($servername, $username, $password, $dbname);

// Verificar si se han enviado las fechas
if (isset($_POST['fechaInicioOT']) && isset($_POST['fechaFinOT'])) {
    $fechaInicio = $_POST['fechaInicioOT'];
    $fechaFin = $_POST['fechaFinOT'];

    // Obtener datos de OT
    $result = obtenerDatosOT($conn, $fechaInicio, $fechaFin);

    // Crear un nuevo documento de PhpSpreadsheet
    $spreadsheet = new Spreadsheet();

    // Generar el reporte en Excel
    generarReporteExcel($spreadsheet, $result);

    // Descargar el archivo
    descargarArchivo($spreadsheet);
} else {
    // Obtener todos los datos de OT si no se especifica un rango de fechas
    $result = obtenerDatosOT($conn);

    // Crear un nuevo documento de PhpSpreadsheet
    $spreadsheet = new Spreadsheet();

    // Generar el reporte en Excel
    generarReporteExcel($spreadsheet, $result);

    // Descargar el archivo
    descargarArchivo($spreadsheet);
}

// Cerrar la conexión de la base de datos
$conn->close();
?>
