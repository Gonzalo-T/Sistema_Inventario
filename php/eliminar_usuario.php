<?php
session_start(); // Iniciar sesión en PHP
require_once '../conexion/dbconfigUser.php'; // Ajusta la ruta según sea necesario

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idUsuario = $_POST['id_usuario'];

    // Iniciar transacción
    $conn->begin_transaction();

    // Primero, eliminar las entradas en usuario_permiso
    $queryPermiso = "DELETE FROM usuario_permiso WHERE id_usuario = ?";
    $stmtPermiso = $conn->prepare($queryPermiso);
    $stmtPermiso->bind_param("s", $idUsuario);
    if (!$stmtPermiso->execute()) {
        // Si falla, hacer rollback y mostrar error
        $conn->rollback();
        echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
        $stmtPermiso->close();
        $conn->close();
        return;
    }
    $stmtPermiso->close();

    // Luego, eliminar el usuario de la tabla usuario
    $queryUsuario = "DELETE FROM usuario WHERE id_usuario = ?";
    $stmtUsuario = $conn->prepare($queryUsuario);
    $stmtUsuario->bind_param("s", $idUsuario);
    if ($stmtUsuario->execute()) {
        // Si la eliminación es exitosa, confirmar la transacción
        $conn->commit();
        echo json_encode(['success' => true]);
    } else {
        // Si hay un error, revertir la transacción
        $conn->rollback();
        echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
    }
    $stmtUsuario->close();
    $conn->close();
}

?>
