<?php
session_start(); // Iniciar sesión en PHP

require_once '../conexion/dbconfigUser.php'; // Ajusta la ruta según sea necesario

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nombreUsuario = $_POST['userName'];
$contrasena = $_POST['pass'];

$stmt = $conn->prepare("SELECT * FROM usuario WHERE id_usuario = ? AND contrasena = ?");
$stmt->bind_param("ss", $nombreUsuario, $contrasena);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $_SESSION['usuario_logueado'] = true;
    $_SESSION['id_usuario'] = $user['id_usuario'];

    // Obtener permisos del usuario
    $stmtPermisos = $conn->prepare("
        SELECT p.id_permiso 
        FROM permiso p 
        JOIN usuario_permiso up ON p.id_permiso = up.id_permiso 
        WHERE up.id_usuario = ?
    ");
    $stmtPermisos->bind_param("s", $user['id_usuario']);
    $stmtPermisos->execute();
    $resultPermisos = $stmtPermisos->get_result();

    $_SESSION['permisos'] = [];
    while ($permiso = $resultPermisos->fetch_assoc()) {
        $_SESSION['permisos'][] = $permiso['id_permiso'];
    }

    header("Location: /home.php");
    exit;
} else {
    $_SESSION['error'] = "Usuario o contraseña incorrectos";
    header("Location: /index.php");
    exit;
}

$stmt->close();
$conn->close();
?>
