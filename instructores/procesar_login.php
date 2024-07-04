<?php
include '../conexion.php';

$nombre_usuario = $_POST['nombre_usuario'];
$contrasena = $_POST['contrasena'];

$query = "SELECT * FROM instructores WHERE Nombre_usuario = ? AND Perfil = 'Instructor'";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $nombre_usuario);
$stmt->execute();
$result = $stmt->get_result();
$instructor = $result->fetch_assoc();

if ($instructor && password_verify($contrasena, $instructor['Contrasena'])) {
    session_start();
    $_SESSION['actividad'] = $instructor['Disciplina'];
    $_SESSION['nombre_docente'] = $instructor['Nombre'];
    header("Location: pagina_docentes.php");
    exit();
} else {
    header("Location: login.php?error=1");
    exit();
}

$stmt->close();
$conn->close();
?>

