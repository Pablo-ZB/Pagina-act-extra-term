<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Registro</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: url('actividades.jpeg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: #2c3e50;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 30px;
            color: #f5f5f5;
            font-weight: 500;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }

        .message-container {
            background: rgba(38, 50, 56, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            text-align: center;
            max-width: 500px;
            width: 100%;
            margin-top: 20px;
        }

        p.message {
            font-size: 1.1rem;
            color: #e57373;
            margin-top: 20px;
        }

        a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #6d4c41;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #5e4237;
        }
    </style>
</head>
<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $matricula = $_POST["matricula"];
        $apellidoPaterno = $_POST["apellido_paterno"];
        $apellidoMaterno = $_POST["apellido_materno"];
        $nombre = $_POST["nombres"];
        $correoElectronico = $_POST["correo_electronico"];
        $carrera = $_POST["carrera"];
        $numeroGrupo = $_POST["numero_grupo"];
        $letraGrupo = $_POST["letra_grupo"];
        $grupo = $numeroGrupo . $letraGrupo;
        $actividad = $_POST["actividad"];
        $horarioElegido = $_POST["horario"];

        include '../conexion.php';

        $conn->begin_transaction();

        $sql_alumno = "INSERT INTO alumnos (Matricula, Nombre, Apellido_Paterno, Apellido_Materno, Carrera, Grupo, Actividad, Correo_Electronico, Horario)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt_alumno = $conn->prepare($sql_alumno)) {
            $stmt_alumno->bind_param("sssssssss", $matricula, $nombre, $apellidoPaterno, $apellidoMaterno, $carrera, $grupo, $actividad, $correoElectronico, $horarioElegido);

            if ($stmt_alumno->execute()) {

                $sql_inscritos = "SELECT Inscritos FROM actividades WHERE Nombre = ?";
                if ($stmt_inscritos = $conn->prepare($sql_inscritos)) {
                    $stmt_inscritos->bind_param("s", $actividad);
                    $stmt_inscritos->execute();
                    $stmt_inscritos->bind_result($inscritos);
                    $stmt_inscritos->fetch();
                    $stmt_inscritos->close();
                    
                    $inscritos++;

                    $sql_update = "UPDATE actividades SET Inscritos = ? WHERE Nombre = ?";
                    if ($stmt_update = $conn->prepare($sql_update)) {
                        $stmt_update->bind_param("ss", $inscritos, $actividad);

                        if ($stmt_update->execute()) {
                            $conn->commit();
                            echo '<div class="message-container">';
                            echo '<h1>Su registro ha sido exitoso.</h1>';
                            echo '<a href="alumnos.php">Volver</a>';
                            echo '</div>';
                        } else {
                            $conn->rollback(); 
                            echo '<div class="message-container">';
                            echo "Error al actualizar el número de inscritos: " . $stmt_update->error;
                            echo '</div>';
                        }

                        $stmt_update->close();
                    } else {
                        $conn->rollback(); 
                        echo '<div class="message-container">';
                        echo "Error en la preparación de la sentencia UPDATE: " . $conn->error;
                        echo '</div>';
                    }
                } else {
                    $conn->rollback(); 
                    echo '<div class="message-container">';
                    echo "Error en la preparación de la sentencia SELECT: " . $conn->error;
                    echo '</div>';
                }
            } else {
                $conn->rollback();
                echo '<div class="message-container">';
                echo "Error al guardar los datos del alumno: " . $stmt_alumno->error;
                echo '</div>';
            }

            $stmt_alumno->close();
        } else {
            $conn->rollback(); 
            echo '<div class="message-container">';
            echo "Error en la preparación de la sentencia INSERT: " . $conn->error;
            echo '</div>';
        }

        $conn->close();
    } else {
        echo '<div class="message-container">';
        echo "<p class='message'>Acceso no autorizado.</p>";
        echo '</div>';
    }
    ?>
</body>
</html>
