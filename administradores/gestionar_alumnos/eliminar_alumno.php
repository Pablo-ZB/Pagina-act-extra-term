<?php
if (isset($_GET['id'])) {
    $idAlumno = $_GET['id'];

    include '../../conexion.php';

    $sql_get_actividad = "SELECT Actividad FROM alumnos WHERE Matricula = $idAlumno";
    $resultado_actividad = $conn->query($sql_get_actividad);

    if ($resultado_actividad->num_rows == 1) {
        $fila_actividad = $resultado_actividad->fetch_assoc();
        $actividad = $fila_actividad['Actividad'];

        $sql_actualizar_actividad = "UPDATE actividades SET inscritos = inscritos - 1 WHERE Nombre = '$actividad'";
        if ($conn->query($sql_actualizar_actividad) === TRUE) {
            $sql_eliminar_alumno = "DELETE FROM alumnos WHERE Matricula = $idAlumno";
            if ($conn->query($sql_eliminar_alumno) === TRUE) {
                $mensaje = "Alumno eliminado con éxito.";
                $mensaje_tipo = "success";
            } else {
                $mensaje = "Error al eliminar el alumno: " . $conn->error;
                $mensaje_tipo = "error";
            }
        } else {
            $mensaje = "Error al actualizar la actividad: " . $conn->error;
            $mensaje_tipo = "error";
        }
    } else {
        $mensaje = "No se encontró la actividad del alumno.";
        $mensaje_tipo = "error";
    }

    $conn->close();
} else {
    $mensaje = "ID de alumno no proporcionado.";
    $mensaje_tipo = "error";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ($mensaje_tipo === "success") ? "Éxito al Eliminar Alumno" : "Error al Eliminar Alumno"; ?></title>
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
        <a href="gestionar_alumnos.php" class="button">Volver</a>
    </div>
</body>
</html>
