<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
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
            min-height: 100vh;
            color: #2c3e50;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 30px;
            color: #f5f5f5;
            font-weight: 500;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }

        form {
            background: rgba(38, 50, 56, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 500px;
            margin-top: 20px;
        }

        label {
            color: #f5f5f5;
            margin-top: 15px;
            display: block;
            font-size: 1.1rem;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 8px 0;
            border: none;
            border-radius: 5px;
            background-color: #fff;
            font-size: 1rem;
        }

        input[type="radio"] {
            margin-right: 10px;
            margin-top: 10px;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }

        input[type="submit"] {
            background-color: #6d4c41;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        input[type="submit"]:hover {
            background-color: #4e342e;
        }

        a {
            background-color: #6d4c41;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1rem;
        }

        a:hover {
            background-color: #4e342e;
        }

        #matriculaError,
        #correo_electronicoError {
            color: red;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <h1>Completa los campos:</h1>

    <?php
    // Verifica si se ha pasado el parámetro 'actividad' por GET
    if (isset($_GET["actividad"])) {
        $actividad = $_GET["actividad"];
        
        // Incluye el archivo de conexión
        include '../conexion.php';

        // Consulta SQL para obtener horarios
        $sql_horarios = "SELECT horario1, horario2 FROM actividades WHERE nombre = ?";
        
        // Prepara la consulta
        if ($stmt_horarios = $conn->prepare($sql_horarios)) {
            $stmt_horarios->bind_param("s", $actividad);
            
            // Ejecuta la consulta
            if ($stmt_horarios->execute()) {
                // Vincula el resultado
                $stmt_horarios->bind_result($horario1, $horario2);
                $stmt_horarios->fetch(); // Obtiene los resultados
                $stmt_horarios->close(); // Cierra la consulta
            } else {
                die("Error al ejecutar la consulta: " . $stmt_horarios->error);
            }
        } else {
            die("Error en la preparación de la consulta: " . $conn->error);
        }
    } else {
        // Si no se ha seleccionado una actividad válida, muestra un mensaje de error
        echo "Error: Seleccione una actividad válida.";
    }
    ?>

    <!-- Formulario HTML -->
    <form action="procesar_formulario.php" method="post">
        <label for="matricula">Matrícula:</label>
        <input type="number" name="matricula" id="matricula" required maxlength="10" pattern="[0-9]+"><br>
        <div id="matriculaError"></div>
            
        <label for="apellido_paterno">Apellido Paterno:</label>
        <input type="text" name="apellido_paterno" id="apellido_paterno" required><br>

        <label for="apellido_materno">Apellido Materno:</label>
        <input type="text" name="apellido_materno" id="apellido_materno" required><br>

        <label for="nombres">Nombres:</label>
        <input type="text" name="nombres" id="nombres" required><br>

        <label for="correo_electronico">Correo electrónico:</label>
        <input type="text" name="correo_electronico" id="correo_electronico" required><br>
        <div id="correo_electronicoError"></div>
        
        <label for="carrera">Carrera:</label>
        <select id="carrera" name="carrera" required>
            <option value="Ingeniería en Software">Ingeniería de Software</option>
            <option value="Ingeniería Civil">Ingeniería Civil</option>
            <option value="Ingeniería en Redes y Telecomunicaciones">Ingeniería en Redes y Telecomunicaciones</option>
            <option value="Ingeniería en Tecnologías de Manufactura">Ingeniería en Tecnologías de Manufactura</option>
            <option value="Ingeniería en Tecnología Ambiental">Ingeniería en Tecnología Ambiental</option>
            <option value="Licenciatura en Administración y Gestión Empresarial">Licenciatura en Administración y Gestión Empresarial</option>
        </select><br><br>
        
        <label for="grupo">Grupo:</label>
        <select id="numero_grupo" name="numero_grupo" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
        </select>

        <select id="letra_grupo" name="letra_grupo" required>
            <option value="a">a</option>
            <option value="b">b</option>
            <option value="c">c</option>
        </select><br>

        <label for="horario">Selecciona un horario:</label><br>
        <input type="radio" name="horario" value="<?php echo $horario1; ?>" required> <?php echo $horario1; ?><br>
        <input type="radio" name="horario" value="<?php echo $horario2; ?>" required> <?php echo $horario2; ?><br>

        <input type="hidden" name="actividad" value="<?php echo $_GET['actividad']; ?>">
        
        <div class="buttons">
            <input type="submit" value="Guardar">
            <a href="alumnos.php">Volver</a>
        </div>
    </form>
</body>
</html>
