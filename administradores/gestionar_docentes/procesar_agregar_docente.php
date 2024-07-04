<?php

include '../../conexion.php';

$nombre = $_POST["nombre"];
$apellidoPaterno = $_POST["apellido_paterno"];
$apellidoMaterno = $_POST["apellido_materno"];
$perfil = $_POST["perfil"];
$nombre_usuario = $_POST['nombre_usuario'];
$contrasena = $_POST['contrasena'];

$disciplina = "";
if ($perfil !== "Administrador") {
    $disciplina = $_POST["disciplina"];
}

$hash_contraseña = password_hash($contrasena, PASSWORD_DEFAULT);

$sql = "INSERT INTO instructores (Nombre, Apellido_Paterno, Apellido_Materno, Disciplina, Perfil, Nombre_usuario, Contrasena) VALUES ('$nombre', '$apellidoPaterno' , '$apellidoMaterno', '$disciplina', '$perfil','$nombre_usuario', '$hash_contraseña')";

if ($conn->query($sql) === TRUE) {
    $mensaje = "Se ha agregado correctamente.";
    $mensaje_tipo = "success";
} else {
    $mensaje = "Error al agregar el docente: " . $conn->error;
    $mensaje_tipo = "error";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ($mensaje_tipo === "success") ? "Éxito al Guardar Docente" : "Error al Guardar Docente"; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f2f2f2;
            color: #333;
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .success-icon, .error-icon {
            margin-bottom: 20px;
        }
        .button {
            background-color: #3f6f3f;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
        }
        .button:hover {
            background-color: #2e532e;
        }
        .error-message {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($mensaje_tipo === "success"): ?>
            <img src="../exito.gif" alt="Éxito" class="success-icon">
        <?php else: ?>
            <img src="../error.gif" alt="Error" class="error-icon">
        <?php endif; ?>
        <h2><?php echo $mensaje; ?></h2>
        <a href="gestionar_docentes.php" class="button">Volver</a>
    </div>
</body>
</html>
