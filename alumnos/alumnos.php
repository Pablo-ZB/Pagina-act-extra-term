<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selecciona una actividad</title>
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

        ul {
            list-style: none;
            padding: 0;
            width: 100%;
            max-width: 500px;
            background: rgba(38, 50, 56, 0.8);
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        li {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        li:last-child {
            border-bottom: none;
        }

        a {
            display: block;
            padding: 15px 20px;
            text-decoration: none;
            color: #f5f5f5;
            font-size: 1.1rem;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        a:hover {
            background-color: #6d4c41;
            color: #ffffff;
        }

        .message {
            font-size: 1.1rem;
            color: #e57373;
            margin-top: 20px;
            background: rgba(38, 50, 56, 0.8);
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <h1>Actividades disponibles:</h1>
    <ul>
        <?php
        include '../conexion.php';

        if ($conn->connect_error) {
            die("<p class='message'>Error en la conexión a la base de datos: " . $conn->connect_error . "</p>");
        }

        $sql = "SELECT nombre FROM actividades WHERE inscritos < 50";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<li><a href="procesar_seleccion.php?actividad=' . $row['nombre'] . '">' . $row['nombre'] . '</a></li>';
            }
        } else {
            echo "<p class='message'>No se encontraron actividades en la base de datos.</p>";
        }

        $conn->close();
        ?>
    </ul>
</body>
</html>
