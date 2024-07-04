<?php
include '../../conexion.php';

$nombre = $_POST["nombre"];
$tipo = $_POST["tipo"];
$horario1_dias = implode(", ", $_POST["horario1_dias"]);
$horario1_hora = $_POST["horario1_hora"];
$horario2_dias = implode(", ", $_POST["horario2_dias"]);
$horario2_hora = $_POST["horario2_hora"];
$sedes = $_POST["sedes"];

$sql = "INSERT INTO actividades (Nombre, Tipo, Horario1, Horario2, Sedes) VALUES ('$nombre', '$tipo', '$horario1_dias $horario1_hora', '$horario2_dias $horario2_hora', '$sedes')";

if ($conn->query($sql) === TRUE) {
    $mensaje = "La actividad se ha agregado correctamente.";
    $mensaje_tipo = "success";
} else {
    $mensaje = "Error al agregar la actividad: " . $conn->error;
    $mensaje_tipo = "error";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ($mensaje_tipo === "success") ? "Éxito al Guardar Actividad" : "Error al Guardar Actividad"; ?></title>
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
        .success-icon {
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
            <img src="../error.gif" alt="Error" class="success-icon">
        <?php endif; ?>
        <h2><?php echo $mensaje; ?></h2>
        <a href="gestionar_actividades.php" class="button">Volver</a>
    </div>
</body>
</html>
