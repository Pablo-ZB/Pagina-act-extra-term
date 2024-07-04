<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "act_extraescolares";

include '../conexion.php';



$nombre_usuario = $_POST['nombre_usuario'];
$contrasena = $_POST['contrasena'];

$sql = "SELECT ID_Instructor, Nombre, Apellido_Paterno, Perfil, Contrasena FROM instructores WHERE Nombre_usuario = '$nombre_usuario' AND Perfil = 'Administrador'";
$result = $conn->query($sql);


if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $hashed_password = $row['Contrasena'];
    $perfil = $row['Perfil'];
    
    if (password_verify($contrasena, $hashed_password)) {
        session_start();
        $_SESSION['usuario'] = $nombre_usuario;
        $_SESSION['perfil'] = $perfil;
        header("Location: administradores.php");
    } else {
        echo "Credenciales inválidas. <a href='login.php'>Volver a intentar</a>";
    }
} else {
    echo "Perfil incorrecto o usuario no encontrado. <a href='login.php'>Volver a intentar</a>";
}

$conn->close();
?>

